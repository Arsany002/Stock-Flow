<?php

namespace App\Repositories;

use App\Enums\MovementType;
use App\Models\StockLevel;
use App\Models\StockMovement;
use App\Repositories\Contracts\StockRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class StockRepository implements StockRepositoryInterface
{
    /**
     * Movement types that affect on_hand.
     */
    private const ON_HAND_TYPES = [
        MovementType::PurchaseIn->value,
        MovementType::SaleOut->value,
        MovementType::Adjustment->value,
        MovementType::TransferIn->value,
        MovementType::TransferOut->value,
    ];

    /**
     * Movement types that affect reserved.
     */
    private const RESERVED_TYPES = [
        MovementType::Reservation->value,
        MovementType::Release->value,
        MovementType::SaleOut->value,
    ];

    public function findLevel(string $productId, string $warehouseId): ?StockLevel
    {
        return StockLevel::query()
            ->where('product_id', $productId)
            ->where('warehouse_id', $warehouseId)
            ->first();
    }

    public function lockLevelForUpdate(string $productId, string $warehouseId): ?StockLevel
    {
        return StockLevel::query()
            ->where('product_id', $productId)
            ->where('warehouse_id', $warehouseId)
            ->lockForUpdate()
            ->first();
    }

    public function lockOrCreateLevel(string $productId, string $warehouseId): StockLevel
    {
        $level = $this->lockLevelForUpdate($productId, $warehouseId);

        if ($level !== null) {
            return $level;
        }

        try {
            return $this->createLevel([
                'product_id' => $productId,
                'warehouse_id' => $warehouseId,
                'on_hand' => 0,
                'reserved' => 0,
            ]);
        } catch (QueryException $exception) {
            // A concurrent transaction won the race to create this pair
            // (unique constraint on product_id+warehouse_id). Fall back to
            // locking its row — this blocks until that transaction commits.
            $level = $this->lockLevelForUpdate($productId, $warehouseId);

            if ($level === null) {
                throw $exception;
            }

            return $level;
        }
    }

    public function createLevel(array $attributes): StockLevel
    {
        return StockLevel::query()->create($attributes);
    }

    public function updateLevel(StockLevel $level, array $attributes): StockLevel
    {
        $level->update($attributes);

        return $level;
    }

    public function createMovement(array $attributes): StockMovement
    {
        return StockMovement::query()->create($attributes);
    }

    public function movementsFor(string $productId, string $warehouseId): Collection
    {
        return StockMovement::query()
            ->where('product_id', $productId)
            ->where('warehouse_id', $warehouseId)
            ->orderBy('created_at')
            ->get();
    }

    public function paginateLevels(int $perPage, array $filters = []): LengthAwarePaginator
    {
        return StockLevel::query()
            ->with(['product:id,name,sku', 'warehouse:id,name,code'])
            ->when($filters['product_id'] ?? null, fn ($query, $id) => $query->where('product_id', $id))
            ->when($filters['warehouse_id'] ?? null, fn ($query, $id) => $query->where('warehouse_id', $id))
            ->orderBy('updated_at', 'desc')
            ->paginate($perPage)
            ->withQueryString();
    }

    public function paginateMovements(int $perPage, array $filters = []): LengthAwarePaginator
    {
        return StockMovement::query()
            ->with(['product:id,name,sku', 'warehouse:id,name,code', 'actor:id,name'])
            ->when($filters['product_id'] ?? null, fn ($query, $id) => $query->where('product_id', $id))
            ->when($filters['warehouse_id'] ?? null, fn ($query, $id) => $query->where('warehouse_id', $id))
            ->when($filters['type'] ?? null, fn ($query, $type) => $query->where('type', $type))
            // actor_id ("user") and date_from/date_to power the Stock
            // Movement report's filters — additive, the Stock/Movements
            // page itself only ever passes product_id/warehouse_id/type.
            ->when($filters['actor_id'] ?? null, fn ($query, $id) => $query->where('actor_id', $id))
            ->when($filters['date_from'] ?? null, fn ($query, $date) => $query->where('created_at', '>=', $date))
            ->when($filters['date_to'] ?? null, fn ($query, $date) => $query->where('created_at', '<=', $date))
            ->orderBy('created_at', 'desc')
            ->paginate($perPage)
            ->withQueryString();
    }

    /**
     * Stock levels whose available (on_hand - reserved) is at or below
     * $threshold — the Low Stock report. Uses the existing
     * (product_id, warehouse_id) unique index for the product/warehouse
     * filters; `available` isn't a stored column so the threshold
     * comparison itself is necessarily a computed-expression filter, not
     * an index seek — acceptable at this table's scale (one row per
     * product/warehouse pair, never per-movement).
     */
    public function paginateLowStockLevels(int $threshold, int $perPage, array $filters = []): LengthAwarePaginator
    {
        return StockLevel::query()
            ->with(['product:id,name,sku', 'warehouse:id,name,code'])
            ->whereRaw('(on_hand - reserved) <= ?', [$threshold])
            ->when($filters['product_id'] ?? null, fn ($query, $id) => $query->where('product_id', $id))
            ->when($filters['warehouse_id'] ?? null, fn ($query, $id) => $query->where('warehouse_id', $id))
            ->orderByRaw('(on_hand - reserved) asc')
            ->paginate($perPage)
            ->withQueryString();
    }

    public function allLevels(?string $productId = null, ?string $warehouseId = null): Collection
    {
        return StockLevel::query()
            ->when($productId, fn ($query) => $query->where('product_id', $productId))
            ->when($warehouseId, fn ($query) => $query->where('warehouse_id', $warehouseId))
            ->get();
    }

    public function ledgerTotals(?string $productId = null, ?string $warehouseId = null): Collection
    {
        $onHandTypes = collect(self::ON_HAND_TYPES)->map(fn ($type) => "'{$type}'")->implode(',');
        $reservedTypes = collect(self::RESERVED_TYPES)->map(fn ($type) => "'{$type}'")->implode(',');

        return DB::table('stock_movements')
            ->select('product_id', 'warehouse_id')
            ->selectRaw("SUM(CASE WHEN type IN ({$onHandTypes}) THEN quantity ELSE 0 END) as ledger_on_hand")
            ->selectRaw("SUM(CASE WHEN type IN ({$reservedTypes}) THEN quantity ELSE 0 END) as ledger_reserved")
            ->when($productId, fn ($query) => $query->where('product_id', $productId))
            ->when($warehouseId, fn ($query) => $query->where('warehouse_id', $warehouseId))
            ->groupBy('product_id', 'warehouse_id')
            ->get()
            ->map(fn ($row) => (object) [
                'product_id' => $row->product_id,
                'warehouse_id' => $row->warehouse_id,
                'ledger_on_hand' => (int) $row->ledger_on_hand,
                'ledger_reserved' => (int) $row->ledger_reserved,
            ]);
    }

    public function levelsForProductOrderedByAvailability(string $productId): Collection
    {
        return StockLevel::query()
            ->where('product_id', $productId)
            ->whereHas('warehouse', fn ($query) => $query->where('is_active', true))
            ->with('warehouse')
            ->get()
            ->sortByDesc(fn (StockLevel $level) => $level->available)
            ->values();
    }

    public function countLowStockLevels(int $threshold): int
    {
        return StockLevel::query()
            ->whereRaw('(on_hand - reserved) <= ?', [$threshold])
            ->count();
    }
}
