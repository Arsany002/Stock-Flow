<?php

namespace App\Services;

use App\Enums\ApprovalDecision;
use App\Enums\PurchaseOrderStatus;
use App\Exceptions\CreditLimitExceededException;
use App\Exceptions\InvalidStateTransitionException;
use App\Exceptions\OutOfStockException;
use App\Models\BusinessAccount;
use App\Models\PoApproval;
use App\Models\PoItem;
use App\Models\PurchaseOrder;
use App\Models\Quote;
use App\Models\User;
use App\Repositories\Contracts\BusinessAccountRepositoryInterface;
use App\Repositories\Contracts\PurchaseOrderRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * B2B Purchase Order state machine: pending_approval -> approved -> fulfilled
 * -> closed; pending_approval -> rejected.
 *
 *   createFromQuote()  (none) -> pending_approval — accepts the source quote
 *       (QuoteService::accept(), atomically — see that class's docblock) and
 *       copies its lines into po_items, picking a fulfillment warehouse per
 *       line (StockService::bestWarehouseFor() — same best-available-stock
 *       heuristic as B2C checkout). Deliberately does NOT reserve stock yet
 *       — that's approve()'s job, per requirement #5/#8 of this module
 *       (creating the PO and reserving stock are distinct steps).
 *
 *   approve()  pending_approval -> approved — checks
 *       outstanding_balance + PO total <= credit_limit (locked, so two
 *       concurrent approvals against the same account can't both pass
 *       against the same stale balance — see BusinessAccountRepository::
 *       lockForUpdate()), then reserves every line via StockService::
 *       reserve() (never re-implemented here), then adds the PO total to
 *       outstanding_balance (the buyer now owes it under net terms).
 *
 *   reject()  pending_approval -> rejected — no stock effect at all.
 *
 *   settle()  approved -> fulfilled — Bank Transfer settlement converts
 *       every line's reservation into a completed sale
 *       (StockService::confirmSale()) and removes the total from
 *       outstanding_balance (the debt is paid).
 *
 *   close()  fulfilled -> closed — final archival step, no stock/credit
 *       effect (goods and payment are already settled).
 *
 * Every stock mutation goes through StockService; every payment record
 * mutation goes through PaymentService (called from the controller, not
 * here — see Web/Procurement/PurchaseOrderController). This class only
 * ever touches `purchase_orders`, `po_items`, `po_approvals`, and
 * `business_accounts.outstanding_balance`.
 */
class PurchaseOrderService
{
    public function __construct(
        private readonly PurchaseOrderRepositoryInterface $purchaseOrders,
        private readonly BusinessAccountRepositoryInterface $businessAccounts,
        private readonly StockService $stock,
        private readonly QuoteService $quotes,
    ) {}

    public function find(string $id): ?PurchaseOrder
    {
        return $this->purchaseOrders->find($id);
    }

    /**
     * Read-only listing: a Business Buyer sees only their own account's
     * POs; staff (`po.approve`/`payment.settle` holders) see every PO.
     */
    public function listForViewer(?BusinessAccount $businessAccount, int $perPage = 15): LengthAwarePaginator
    {
        if ($businessAccount !== null) {
            return $this->purchaseOrders->paginateForBusinessAccount($businessAccount->id, $perPage);
        }

        return $this->purchaseOrders->paginateAll($perPage);
    }

    public function createFromQuote(Quote $quote, User $actor): PurchaseOrder
    {
        return DB::transaction(function () use ($quote) {
            // Accepting the quote and creating its PO are atomic together
            // — if anything below fails, the quote must not end up
            // Accepted with no PO to show for it.
            $quote = $this->quotes->accept($quote);

            $purchaseOrder = $this->purchaseOrders->create([
                'quote_id' => $quote->id,
                'business_account_id' => $quote->business_account_id,
                'status' => PurchaseOrderStatus::PendingApproval,
                'subtotal' => $quote->subtotal,
                'tax' => $quote->tax,
                'total' => $quote->total,
                'due_date' => null,
            ]);

            foreach ($quote->items()->with('product')->get() as $quoteItem) {
                $warehouse = $this->stock->bestWarehouseFor($quoteItem->product, $quoteItem->quantity);

                if ($warehouse === null) {
                    throw OutOfStockException::noWarehouseAvailable($quoteItem->product_id, $quoteItem->quantity);
                }

                PoItem::query()->create([
                    'purchase_order_id' => $purchaseOrder->id,
                    'product_id' => $quoteItem->product_id,
                    'warehouse_id' => $warehouse->id,
                    'quantity' => $quoteItem->quantity,
                    'unit_price' => $quoteItem->unit_price,
                ]);
            }

            return $purchaseOrder;
        });
    }

    public function approve(PurchaseOrder $purchaseOrder, User $approver, ?string $note = null): PurchaseOrder
    {
        if ($purchaseOrder->status !== PurchaseOrderStatus::PendingApproval) {
            throw InvalidStateTransitionException::make(
                'PurchaseOrder.status',
                $purchaseOrder->status->value,
                PurchaseOrderStatus::Approved->value
            );
        }

        return DB::transaction(function () use ($purchaseOrder, $approver, $note) {
            $account = $this->businessAccounts->lockForUpdate($purchaseOrder->business_account_id);

            $projectedBalance = bcadd($account->outstanding_balance, $purchaseOrder->total, 2);

            if (bccomp($projectedBalance, $account->credit_limit, 2) > 0) {
                throw CreditLimitExceededException::forBusinessAccount(
                    $account->id,
                    (float) $account->credit_limit,
                    (float) $projectedBalance
                );
            }

            PoApproval::query()->create([
                'purchase_order_id' => $purchaseOrder->id,
                'approver_id' => $approver->id,
                'decision' => ApprovalDecision::Approved,
                'note' => $note,
            ]);

            foreach ($purchaseOrder->items()->with(['product', 'warehouse'])->get() as $item) {
                $this->stock->reserve($item->product, $item->warehouse, $item->quantity, $approver, $purchaseOrder);
            }

            $this->businessAccounts->update($account, ['outstanding_balance' => $projectedBalance]);

            return $this->purchaseOrders->update($purchaseOrder, ['status' => PurchaseOrderStatus::Approved]);
        });
    }

    public function reject(PurchaseOrder $purchaseOrder, User $approver, ?string $note = null): PurchaseOrder
    {
        if ($purchaseOrder->status !== PurchaseOrderStatus::PendingApproval) {
            throw InvalidStateTransitionException::make(
                'PurchaseOrder.status',
                $purchaseOrder->status->value,
                PurchaseOrderStatus::Rejected->value
            );
        }

        return DB::transaction(function () use ($purchaseOrder, $approver, $note) {
            PoApproval::query()->create([
                'purchase_order_id' => $purchaseOrder->id,
                'approver_id' => $approver->id,
                'decision' => ApprovalDecision::Rejected,
                'note' => $note,
            ]);

            return $this->purchaseOrders->update($purchaseOrder, ['status' => PurchaseOrderStatus::Rejected]);
        });
    }

    /**
     * Bank Transfer settlement: converts every line's reservation into a
     * completed sale and pays down the account's outstanding balance.
     * Called by PurchaseOrderController after PaymentService confirms the
     * transfer — see that controller for the Payment-row side of this.
     */
    public function settle(PurchaseOrder $purchaseOrder, ?User $actor = null): PurchaseOrder
    {
        if ($purchaseOrder->status !== PurchaseOrderStatus::Approved) {
            throw InvalidStateTransitionException::make(
                'PurchaseOrder.status',
                $purchaseOrder->status->value,
                PurchaseOrderStatus::Fulfilled->value
            );
        }

        return DB::transaction(function () use ($purchaseOrder, $actor) {
            foreach ($purchaseOrder->items()->with(['product', 'warehouse'])->get() as $item) {
                $this->stock->confirmSale($item->product, $item->warehouse, $item->quantity, $actor, $purchaseOrder);
            }

            $account = $this->businessAccounts->lockForUpdate($purchaseOrder->business_account_id);
            $newBalance = bcsub($account->outstanding_balance, $purchaseOrder->total, 2);
            // Clamp at zero — defensive against any rounding drift, never negative debt.
            $newBalance = bccomp($newBalance, '0.00', 2) < 0 ? '0.00' : $newBalance;
            $this->businessAccounts->update($account, ['outstanding_balance' => $newBalance]);

            return $this->purchaseOrders->update($purchaseOrder, ['status' => PurchaseOrderStatus::Fulfilled]);
        });
    }

    /**
     * fulfilled -> closed: final archival step, no stock/credit effect.
     */
    public function close(PurchaseOrder $purchaseOrder): PurchaseOrder
    {
        if ($purchaseOrder->status !== PurchaseOrderStatus::Fulfilled) {
            throw InvalidStateTransitionException::make(
                'PurchaseOrder.status',
                $purchaseOrder->status->value,
                PurchaseOrderStatus::Closed->value
            );
        }

        return $this->purchaseOrders->update($purchaseOrder, ['status' => PurchaseOrderStatus::Closed]);
    }
}
