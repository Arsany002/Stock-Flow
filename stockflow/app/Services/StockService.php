<?php

namespace App\Services;

use App\Enums\MovementType;
use App\Exceptions\InvalidStateTransitionException;
use App\Exceptions\OutOfStockException;
use App\Models\Product;
use App\Models\StockLevel;
use App\Models\StockMovement;
use App\Models\User;
use App\Models\Warehouse;
use App\Repositories\Contracts\StockRepositoryInterface;
use App\Repositories\Contracts\WarehouseRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

/**
 * The stock engine — the only place stock_movements/stock_levels are ever
 * written. See docs/project/canonical-decisions.md §6.
 *
 * Every mutation:
 *   1. runs inside DB::transaction() (this class owns the transaction
 *      boundary — repositories never open their own, controllers never
 *      touch stock directly);
 *   2. locks the affected stock_levels row(s) via lockForUpdate()
 *      (transfer() locks both rows, in a deterministic warehouse-id order,
 *      so two opposite-direction concurrent transfers between the same
 *      pair of warehouses can never deadlock each other);
 *   3. appends exactly one immutable stock_movements row (transfer()
 *      appends two: a paired transfer_out + transfer_in);
 *   4. updates the stock_levels projection to match.
 *
 * Ledger sign convention — `stock_movements.quantity` is signed relative to
 * on_hand for the types that affect on_hand, and relative to `reserved` for
 * the types that affect reserved:
 *   - purchase_in:    +qty on_hand
 *   - transfer_in:    +qty on_hand
 *   - transfer_out:   -qty on_hand
 *   - adjustment:     ±qty on_hand (caller-supplied signed delta)
 *   - reservation:    +qty reserved (on_hand untouched)
 *   - release:        -qty reserved (on_hand untouched)
 *   - sale_out:       -qty on_hand AND -qty reserved — a single ledger row
 *     represents converting an existing reservation into a completed sale;
 *     no separate `release` row is written for it.
 *
 * This lets reconcile() prove two independent invariants from the same
 * ledger: on_hand == SUM(quantity) over the on-hand-affecting types, and
 * reserved == SUM(quantity) over the reserved-affecting types. See
 * StockRepository::ledgerTotals().
 */
class StockService
{
    public function __construct(
        private readonly StockRepositoryInterface $stock,
        private readonly WarehouseRepositoryInterface $warehouses,
    ) {}

    /**
     * Read-only pass-throughs for the Stock/Levels and Stock/Movements
     * index pages — controllers depend on this service, never on the
     * repository directly, per docs/project/canonical-decisions.md §2.
     *
     * @param  array<string, mixed>  $filters
     */
    public function listLevels(int $perPage, array $filters = []): LengthAwarePaginator
    {
        return $this->stock->paginateLevels($perPage, $filters);
    }

    /**
     * @param  array<string, mixed>  $filters
     */
    public function listMovements(int $perPage, array $filters = []): LengthAwarePaginator
    {
        return $this->stock->paginateMovements($perPage, $filters);
    }

    /**
     * @return Collection<int, Warehouse>
     */
    public function listActiveWarehouses(): Collection
    {
        return $this->warehouses->active();
    }

    /**
     * Picks a fulfillment warehouse for a B2C order line: the active
     * warehouse with the most available (on_hand - reserved) stock for this
     * product, as long as it can cover the full requested quantity. Read
     * -only placement heuristic, not a stock mutation — the caller (
     * OrderService) still must reserve the chosen warehouse's row through
     * reserve() below, which does the real lockForUpdate() check. Returns
     * null if no single warehouse can fulfill the full quantity.
     */
    public function bestWarehouseFor(Product $product, int $quantity): ?Warehouse
    {
        return $this->stock
            ->levelsForProductOrderedByAvailability($product->id)
            ->first(fn (StockLevel $level) => $level->available >= $quantity)
            ?->warehouse;
    }

    public function purchaseIn(
        Product $product,
        Warehouse $warehouse,
        int $quantity,
        ?User $actor,
        ?Model $reference = null,
        ?string $reason = null,
    ): StockLevel {
        $this->assertPositive($quantity);

        return DB::transaction(function () use ($product, $warehouse, $quantity, $actor, $reference, $reason) {
            $level = $this->stock->lockOrCreateLevel($product->id, $warehouse->id);

            $this->recordMovement(MovementType::PurchaseIn, $product, $warehouse, $quantity, $actor, $reference, $reason);

            return $this->stock->updateLevel($level, [
                'on_hand' => $level->on_hand + $quantity,
            ]);
        });
    }

    public function reserve(
        Product $product,
        Warehouse $warehouse,
        int $quantity,
        ?User $actor,
        ?Model $reference = null,
    ): StockLevel {
        $this->assertPositive($quantity);

        return DB::transaction(function () use ($product, $warehouse, $quantity, $actor, $reference) {
            $level = $this->stock->lockOrCreateLevel($product->id, $warehouse->id);

            $available = $level->on_hand - $level->reserved;

            if ($available < $quantity) {
                throw OutOfStockException::forProduct($product->id, $warehouse->id, $quantity, $available);
            }

            $this->recordMovement(MovementType::Reservation, $product, $warehouse, $quantity, $actor, $reference);

            return $this->stock->updateLevel($level, [
                'reserved' => $level->reserved + $quantity,
            ]);
        });
    }

    public function release(
        Product $product,
        Warehouse $warehouse,
        int $quantity,
        ?User $actor,
        ?Model $reference = null,
    ): StockLevel {
        $this->assertPositive($quantity);

        return DB::transaction(function () use ($product, $warehouse, $quantity, $actor, $reference) {
            $level = $this->stock->lockOrCreateLevel($product->id, $warehouse->id);

            if ($quantity > $level->reserved) {
                throw InvalidStateTransitionException::make(
                    'StockLevel.reserved',
                    (string) $level->reserved,
                    "release {$quantity}"
                );
            }

            $this->recordMovement(MovementType::Release, $product, $warehouse, -$quantity, $actor, $reference);

            return $this->stock->updateLevel($level, [
                'reserved' => $level->reserved - $quantity,
            ]);
        });
    }

    public function confirmSale(
        Product $product,
        Warehouse $warehouse,
        int $quantity,
        ?User $actor,
        ?Model $reference = null,
    ): StockLevel {
        $this->assertPositive($quantity);

        return DB::transaction(function () use ($product, $warehouse, $quantity, $actor, $reference) {
            $level = $this->stock->lockOrCreateLevel($product->id, $warehouse->id);

            if ($quantity > $level->reserved) {
                throw InvalidStateTransitionException::make(
                    'StockLevel.reserved',
                    (string) $level->reserved,
                    "confirmSale {$quantity}"
                );
            }

            // Defensive: reserve() never lets reserved exceed on_hand, so
            // this should be unreachable in practice. Guards rule #9 (no
            // negative stock) against any future ledger drift.
            if ($quantity > $level->on_hand) {
                throw OutOfStockException::forProduct($product->id, $warehouse->id, $quantity, $level->on_hand);
            }

            $this->recordMovement(MovementType::SaleOut, $product, $warehouse, -$quantity, $actor, $reference);

            return $this->stock->updateLevel($level, [
                'reserved' => $level->reserved - $quantity,
                'on_hand' => $level->on_hand - $quantity,
            ]);
        });
    }

    /**
     * Paired transfer_out (source) / transfer_in (destination) in one
     * atomic transaction — either both commit or neither does.
     *
     * @return array{from: StockLevel, to: StockLevel}
     */
    public function transfer(
        Product $product,
        Warehouse $fromWarehouse,
        Warehouse $toWarehouse,
        int $quantity,
        ?User $actor,
        ?Model $reference = null,
    ): array {
        $this->assertPositive($quantity);

        if ($fromWarehouse->id === $toWarehouse->id) {
            throw new InvalidArgumentException('Cannot transfer stock to the same warehouse.');
        }

        return DB::transaction(function () use ($product, $fromWarehouse, $toWarehouse, $quantity, $actor, $reference) {
            // Lock both rows in a deterministic (sorted warehouse id) order
            // regardless of transfer direction, so a concurrent transfer of
            // the same product the *other* way between these two
            // warehouses always acquires locks in the same order and can't
            // deadlock against this one.
            $lockOrder = collect([$fromWarehouse->id, $toWarehouse->id])->sort()->values();

            $levels = $lockOrder->mapWithKeys(
                fn (string $warehouseId) => [$warehouseId => $this->stock->lockOrCreateLevel($product->id, $warehouseId)]
            );

            $sourceLevel = $levels[$fromWarehouse->id];
            $destLevel = $levels[$toWarehouse->id];

            // Capped by *available* (on_hand - reserved), not just on_hand:
            // moving already-reserved stock out from under a pending
            // reservation at the source warehouse would oversell it.
            $available = $sourceLevel->on_hand - $sourceLevel->reserved;

            if ($available < $quantity) {
                throw OutOfStockException::forProduct($product->id, $fromWarehouse->id, $quantity, $available);
            }

            $this->recordMovement(MovementType::TransferOut, $product, $fromWarehouse, -$quantity, $actor, $reference);
            $sourceLevel = $this->stock->updateLevel($sourceLevel, [
                'on_hand' => $sourceLevel->on_hand - $quantity,
            ]);

            $this->recordMovement(MovementType::TransferIn, $product, $toWarehouse, $quantity, $actor, $reference);
            $destLevel = $this->stock->updateLevel($destLevel, [
                'on_hand' => $destLevel->on_hand + $quantity,
            ]);

            return ['from' => $sourceLevel, 'to' => $destLevel];
        });
    }

    public function adjust(
        Product $product,
        Warehouse $warehouse,
        int $signedQuantity,
        ?User $actor,
        string $reason,
    ): StockLevel {
        if ($signedQuantity === 0) {
            throw new InvalidArgumentException('Adjustment quantity must not be zero.');
        }

        return DB::transaction(function () use ($product, $warehouse, $signedQuantity, $actor, $reason) {
            $level = $this->stock->lockOrCreateLevel($product->id, $warehouse->id);

            $newOnHand = $level->on_hand + $signedQuantity;

            if ($newOnHand < 0) {
                throw OutOfStockException::forProduct($product->id, $warehouse->id, abs($signedQuantity), $level->on_hand);
            }

            $this->recordMovement(MovementType::Adjustment, $product, $warehouse, $signedQuantity, $actor, null, $reason);

            return $this->stock->updateLevel($level, ['on_hand' => $newOnHand]);
        });
    }

    /**
     * Read-only: proves (or disproves) that stock_levels matches what the
     * immutable ledger says it should be, per (product, warehouse) pair.
     * No mutation, so no transaction/locking is needed.
     *
     * @return Collection<int, array{
     *     product_id: string, warehouse_id: string,
     *     on_hand: int, ledger_on_hand: int, on_hand_matches: bool,
     *     reserved: int, ledger_reserved: int, reserved_matches: bool,
     * }>
     */
    public function reconcile(?Product $product = null, ?Warehouse $warehouse = null): Collection
    {
        $productId = $product?->id;
        $warehouseId = $warehouse?->id;

        $levels = $this->stock->allLevels($productId, $warehouseId)
            ->keyBy(fn (StockLevel $level) => "{$level->product_id}:{$level->warehouse_id}");

        $ledgerTotals = $this->stock->ledgerTotals($productId, $warehouseId)
            ->keyBy(fn ($row) => "{$row->product_id}:{$row->warehouse_id}");

        return $levels->keys()
            ->merge($ledgerTotals->keys())
            ->unique()
            ->map(function (string $key) use ($levels, $ledgerTotals) {
                [$rowProductId, $rowWarehouseId] = explode(':', $key, 2);

                $level = $levels->get($key);
                $ledger = $ledgerTotals->get($key);

                $onHand = $level->on_hand ?? 0;
                $reserved = $level->reserved ?? 0;
                $ledgerOnHand = $ledger->ledger_on_hand ?? 0;
                $ledgerReserved = $ledger->ledger_reserved ?? 0;

                return [
                    'product_id' => $rowProductId,
                    'warehouse_id' => $rowWarehouseId,
                    'on_hand' => $onHand,
                    'ledger_on_hand' => $ledgerOnHand,
                    'on_hand_matches' => $onHand === $ledgerOnHand,
                    'reserved' => $reserved,
                    'ledger_reserved' => $ledgerReserved,
                    'reserved_matches' => $reserved === $ledgerReserved,
                ];
            })
            ->values();
    }

    private function recordMovement(
        MovementType $type,
        Product $product,
        Warehouse $warehouse,
        int $quantity,
        ?User $actor,
        ?Model $reference = null,
        ?string $reason = null,
    ): StockMovement {
        return $this->stock->createMovement([
            'product_id' => $product->id,
            'warehouse_id' => $warehouse->id,
            'type' => $type,
            'quantity' => $quantity,
            'actor_id' => $actor?->id,
            'reason' => $reason,
            'reference_type' => $reference?->getMorphClass(),
            'reference_id' => $reference?->getKey(),
        ]);
    }

    private function assertPositive(int $quantity): void
    {
        if ($quantity <= 0) {
            throw new InvalidArgumentException('Quantity must be greater than zero.');
        }
    }
}
