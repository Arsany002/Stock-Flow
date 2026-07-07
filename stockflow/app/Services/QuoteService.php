<?php

namespace App\Services;

use App\Enums\QuoteStatus;
use App\Enums\UserRole;
use App\Exceptions\InvalidStateTransitionException;
use App\Models\BusinessAccount;
use App\Models\Product;
use App\Models\Quote;
use App\Models\QuoteItem;
use App\Models\User;
use App\Repositories\Contracts\QuoteRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

/**
 * B2B RFQ state machine: draft -> sent -> accepted | rejected | expired.
 *
 *   request()  draft   — Business Buyer submits desired products/quantities,
 *                         no prices yet (quote_items.unit_price defaults to
 *                         0.00 until priced).
 *   price()    draft -> sent — Vendor/Inventory Manager sets a unit_price
 *                         per line and the quote is sent with an expiry.
 *   accept()   sent -> accepted — Business Buyer accepts (guarded against
 *                         expiry). Never called directly by a controller —
 *                         PurchaseOrderService::createFromQuote() calls it
 *                         inside its own transaction, so "accept the quote"
 *                         and "create the PO" either both happen or neither
 *                         does. See docs/project/canonical-decisions.md §2.
 *   reject()   sent -> rejected — Business Buyer declines.
 *
 * This class never touches stock or purchase_orders — that's
 * PurchaseOrderService's job (see its class docblock for the full
 * accept -> PO -> approve -> reserve -> settle chain).
 */
class QuoteService
{
    /**
     * How long a sent quote stays valid before it's no longer acceptable.
     * Not specified at the exact-days level by the PRD, so 14 days is an
     * interpretive default — long enough for a buyer to review, short
     * enough that stale B2B pricing doesn't linger indefinitely.
     */
    private const VALIDITY_DAYS = 14;

    public function __construct(
        private readonly QuoteRepositoryInterface $quotes,
        private readonly CatalogService $catalog,
    ) {}

    public function find(string $id): ?Quote
    {
        return $this->quotes->find($id);
    }

    /**
     * Read-only listing for whichever role is viewing: a Business Buyer
     * sees only their own account's quotes; a Vendor sees only quotes
     * containing a product they supply ("own pricing context"); staff
     * (Inventory Manager/SuperAdmin, `quote.price`/`po.approve` holders)
     * see every quote.
     */
    public function listForViewer(User $user, ?BusinessAccount $businessAccount, int $perPage = 15): LengthAwarePaginator
    {
        if ($businessAccount !== null) {
            return $this->quotes->paginateForBusinessAccount($businessAccount->id, $perPage);
        }

        if ($user->hasRole(UserRole::VendorSupplier->value)) {
            return $this->quotes->paginateForVendor($user->id, $perPage);
        }

        return $this->quotes->paginateAll($perPage);
    }

    /**
     * @param  list<array{product_id: string, quantity: int}>  $lines
     */
    public function request(BusinessAccount $businessAccount, array $lines): Quote
    {
        if ($lines === []) {
            throw new InvalidArgumentException('An RFQ must include at least one line.');
        }

        return DB::transaction(function () use ($businessAccount, $lines) {
            $quote = $this->quotes->create([
                'business_account_id' => $businessAccount->id,
                'status' => QuoteStatus::Draft,
                'subtotal' => '0.00',
                'tax' => '0.00',
                'total' => '0.00',
                'expires_at' => null,
            ]);

            foreach ($lines as $line) {
                $quantity = (int) $line['quantity'];

                if ($quantity < 1) {
                    throw new InvalidArgumentException('Line quantity must be at least 1.');
                }

                $product = Product::query()->findOrFail($line['product_id']);

                QuoteItem::query()->create([
                    'quote_id' => $quote->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    // Not priced yet — set by price() below.
                    'unit_price' => '0.00',
                ]);
            }

            return $quote;
        });
    }

    /**
     * draft -> sent: sets a unit_price per line and starts the clock on
     * the quote's validity window.
     *
     * @param  array<string, string>  $unitPricesByItemId  quote_item_id => unit_price
     */
    public function price(Quote $quote, array $unitPricesByItemId): Quote
    {
        if ($quote->status !== QuoteStatus::Draft) {
            throw InvalidStateTransitionException::make('Quote.status', $quote->status->value, QuoteStatus::Sent->value);
        }

        return DB::transaction(function () use ($quote, $unitPricesByItemId) {
            $items = $quote->items()->get();
            $subtotal = '0.00';

            foreach ($items as $item) {
                if (! array_key_exists($item->id, $unitPricesByItemId)) {
                    throw new InvalidArgumentException("Missing a unit_price for quote item [{$item->id}].");
                }

                $unitPrice = (string) $unitPricesByItemId[$item->id];
                $item->update(['unit_price' => $unitPrice]);

                $subtotal = bcadd($subtotal, bcmul($unitPrice, (string) $item->quantity, 2), 2);
            }

            $tax = bcmul($subtotal, '0.14', 2);
            $total = bcadd($subtotal, $tax, 2);

            return $this->quotes->update($quote, [
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $total,
                'status' => QuoteStatus::Sent,
                'expires_at' => now()->addDays(self::VALIDITY_DAYS)->toDateString(),
            ]);
        });
    }

    /**
     * sent -> accepted. Not exposed on a route directly — see the class
     * docblock; PurchaseOrderService::createFromQuote() is the only caller,
     * so acceptance and PO creation are always atomic together.
     */
    public function accept(Quote $quote): Quote
    {
        if ($quote->status !== QuoteStatus::Sent) {
            throw InvalidStateTransitionException::make('Quote.status', $quote->status->value, QuoteStatus::Accepted->value);
        }

        if ($this->isExpired($quote)) {
            throw InvalidStateTransitionException::make('Quote.status', $quote->status->value, QuoteStatus::Expired->value);
        }

        return $this->quotes->update($quote, ['status' => QuoteStatus::Accepted]);
    }

    /**
     * sent -> rejected.
     */
    public function reject(Quote $quote): Quote
    {
        if ($quote->status !== QuoteStatus::Sent) {
            throw InvalidStateTransitionException::make('Quote.status', $quote->status->value, QuoteStatus::Rejected->value);
        }

        return $this->quotes->update($quote, ['status' => QuoteStatus::Rejected]);
    }

    public function isExpired(Quote $quote): bool
    {
        return $quote->expires_at !== null && $quote->expires_at->isPast();
    }

    /**
     * Suggested starting price for a quote line, from the active B2B tier
     * price list — the Vendor/Inventory Manager pricing the quote can
     * still submit any unit_price they choose (see price() above).
     */
    public function suggestedTierPrice(string $productId, int $quantity): ?string
    {
        $item = $this->catalog->tierPriceFor($productId, $quantity);

        return $item !== null ? (string) $item->unit_price : null;
    }
}
