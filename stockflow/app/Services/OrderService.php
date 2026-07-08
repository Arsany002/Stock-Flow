<?php

namespace App\Services;

use App\Enums\OrderChannel;
use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Exceptions\InvalidStateTransitionException;
use App\Exceptions\OutOfStockException;
use App\Exceptions\PricingUnavailableException;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

/**
 * B2C checkout / payment-confirmation / cancellation state machine:
 *
 *   pending -> reserved -> confirmed -> fulfilled
 *                  \-> cancelled       (payment failed / reservation expired)
 *
 * Every stock mutation goes through StockService (reserve/confirmSale/
 * release) — this class never writes stock_movements or stock_levels
 * itself, per docs/project/canonical-decisions.md §2/§6. Every payment
 * record mutation goes through PaymentService; this class decides what a
 * payment outcome *means* for the order (confirm vs. cancel) but never
 * touches the `payments` table directly either.
 */
class OrderService
{
    /**
     * Flat 14% VAT — see docs/project/canonical-decisions.md §1 ("VAT: flat
     * 14% on all taxable lines, not per-category"). Not configurable.
     */
    private const VAT_RATE = 0.14;

    /**
     * How long a reservation is held before it's eligible for release by
     * `stock:release-expired-reservations`. Not specified by the PRD at the
     * exact-minutes level, so 30 minutes is an interpretive default —
     * generous enough for COD/placeholder gateways to be settled by staff,
     * short enough that abandoned carts don't lock stock indefinitely.
     */
    private const RESERVATION_TTL_MINUTES = 30;

    public function __construct(
        private readonly OrderRepositoryInterface $orders,
        private readonly StockService $stock,
        private readonly CatalogService $catalog,
        private readonly PaymentService $payments,
    ) {}

    /**
     * Read-only pass-throughs for the Sales/Orders pages — controllers
     * depend on this service, never on the repository directly.
     */
    public function listForUser(int $userId, int $perPage = 15): LengthAwarePaginator
    {
        return $this->orders->paginateForUser($userId, $perPage);
    }

    public function find(string $id): ?Order
    {
        return $this->orders->find($id);
    }

    /**
     * Creates the order, prices and reserves every line, then initiates
     * payment. Requirement #5/#6 of the B2C checkout module: all lines are
     * reserved in one DB transaction, and if any line is unavailable
     * (OutOfStockException) or unpriced (PricingUnavailableException) the
     * whole transaction rolls back — no Order, OrderItem, or stock_movements
     * row is left behind. StockService::reserve() itself also runs inside
     * this same transaction (Laravel nests it as a SAVEPOINT), so a mid-loop
     * failure unwinds every reservation already made in this checkout too.
     *
     * Payment is initiated *after* the reservation transaction commits —
     * a gateway call is an external side effect and doesn't belong inside
     * the reservation DB transaction. FakeGateway then immediately dispatches
     * its simulated verified callback so manual tests can exercise success
     * and failure without a real provider.
     *
     * @param  list<array{product_id: string, quantity: int}>  $lines
     * @param  array<string, mixed>  $paymentOptions
     */
    public function checkout(User $user, array $lines, PaymentMethod $method, array $paymentOptions = []): Order
    {
        if ($lines === []) {
            throw new InvalidArgumentException('Cannot checkout an empty cart.');
        }

        $order = DB::transaction(function () use ($user, $lines) {
            $order = $this->orders->create([
                'user_id' => $user->id,
                'channel' => OrderChannel::B2C,
                'status' => OrderStatus::Pending,
                'subtotal' => 0,
                'tax' => 0,
                'total' => 0,
                'reserved_until' => null,
            ]);

            $subtotal = '0';

            foreach ($lines as $line) {
                $quantity = (int) $line['quantity'];

                if ($quantity < 1) {
                    throw new InvalidArgumentException('Line quantity must be at least 1.');
                }

                $product = Product::query()->findOrFail($line['product_id']);

                $priceItem = $this->catalog->retailPriceFor($product->id, $quantity);

                if ($priceItem === null) {
                    throw PricingUnavailableException::forProduct($product->id);
                }

                $warehouse = $this->stock->bestWarehouseFor($product, $quantity);

                if ($warehouse === null) {
                    throw OutOfStockException::noWarehouseAvailable($product->id, $quantity);
                }

                $unitPrice = (string) $priceItem->unit_price;
                $lineTotal = bcmul($unitPrice, (string) $quantity, 2);
                $subtotal = bcadd($subtotal, $lineTotal, 2);

                OrderItem::query()->create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'warehouse_id' => $warehouse->id,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'line_total' => $lineTotal,
                ]);

                // StockService owns every stock mutation — reservation is
                // never re-implemented here.
                $this->stock->reserve($product, $warehouse, $quantity, $user, $order);
            }

            $tax = bcmul($subtotal, (string) self::VAT_RATE, 2);
            $total = bcadd($subtotal, $tax, 2);

            return $this->orders->update($order, [
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $total,
                'status' => OrderStatus::Reserved,
                'reserved_until' => now()->addMinutes(self::RESERVATION_TTL_MINUTES),
            ]);
        });

        $payment = $this->payments->initiate($order, $method, (string) $order->total, $paymentOptions);

        if ($method === PaymentMethod::FakeGateway) {
            $payment = $this->payments->simulateFakeGateway($payment, $paymentOptions['outcome'] ?? 'succeed');

            return $order->fresh(['items', 'payments']);
        }

        return match ($payment->status) {
            PaymentStatus::Paid => $this->confirmPayment($order->fresh(['items', 'payments']), $user),
            PaymentStatus::Failed => $this->cancel($order->fresh(['items', 'payments']), 'Payment failed at checkout.', $user),
            default => $order->fresh(['items', 'payments']),
        };
    }

    /**
     * reserved -> confirmed: converts every line's reservation into a
     * completed sale (StockService::confirmSale()). Called either
     * synchronously from checkout() (Fake gateway success) or later by a
     * staff `payment.settle` action (Cod / Paymob / Fawry placeholder,
     * after PaymentService::settleManually()).
     */
    public function confirmPayment(Order $order, ?User $actor = null): Order
    {
        if ($order->status !== OrderStatus::Reserved) {
            throw InvalidStateTransitionException::make('Order.status', $order->status->value, OrderStatus::Confirmed->value);
        }

        return DB::transaction(function () use ($order, $actor) {
            foreach ($order->items()->with(['product', 'warehouse'])->get() as $item) {
                $this->stock->confirmSale($item->product, $item->warehouse, $item->quantity, $actor, $order);
            }

            return $this->orders->update($order, ['status' => OrderStatus::Confirmed]);
        });
    }

    /**
     * pending/reserved -> cancelled: releases every line's reservation
     * (StockService::release()) and marks any still-pending payment
     * failed. Used for checkout-time payment failure, staff-initiated
     * cancellation, and expired unpaid reservations.
     * (releaseExpiredReservations() below).
     */
    public function cancel(Order $order, ?string $reason = null, ?User $actor = null): Order
    {
        if (! in_array($order->status, [OrderStatus::Pending, OrderStatus::Reserved], true)) {
            throw InvalidStateTransitionException::make('Order.status', $order->status->value, OrderStatus::Cancelled->value);
        }

        return DB::transaction(function () use ($order, $actor) {
            foreach ($order->items()->with(['product', 'warehouse'])->get() as $item) {
                $this->stock->release($item->product, $item->warehouse, $item->quantity, $actor, $order);
            }

            $payment = $order->payments()->where('status', PaymentStatus::Pending)->latest()->first();

            if ($payment !== null) {
                $this->payments->markFailed($payment);
            }

            return $this->orders->update($order, ['status' => OrderStatus::Cancelled]);
        });
    }

    /**
     * confirmed -> fulfilled: no stock effect (the sale was already
     * recorded at confirmPayment() time) — just the final delivery/pickup
     * status.
     */
    public function markFulfilled(Order $order): Order
    {
        if ($order->status !== OrderStatus::Confirmed) {
            throw InvalidStateTransitionException::make('Order.status', $order->status->value, OrderStatus::Fulfilled->value);
        }

        return $this->orders->update($order, ['status' => OrderStatus::Fulfilled]);
    }

    /**
     * Releases every `reserved` order whose `reserved_until` has passed —
     * the counterpart to StockService's "no oversell" guarantee: an
     * abandoned/unpaid checkout can't hold stock hostage forever. Driven by
     * `stock:release-expired-reservations` (see requirement #6 — a
     * scheduled job is allowed to stay a skeleton if not fully wired, but
     * the release logic itself is fully implemented here).
     */
    public function releaseExpiredReservations(): int
    {
        $expired = $this->orders->expiredReservations();

        foreach ($expired as $order) {
            $this->cancel($order, 'Reservation expired unpaid.');
        }

        return $expired->count();
    }
}
