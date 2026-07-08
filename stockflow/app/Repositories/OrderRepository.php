<?php

namespace App\Repositories;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class OrderRepository implements OrderRepositoryInterface
{
    public function find(string $id): ?Order
    {
        return Order::query()->find($id);
    }

    public function paginateForUser(int $userId, int $perPage = 15): LengthAwarePaginator
    {
        return Order::query()
            ->where('user_id', $userId)
            ->latest()
            ->paginate($perPage);
    }

    public function create(array $attributes): Order
    {
        return Order::query()->create($attributes);
    }

    public function update(Order $order, array $attributes): Order
    {
        $order->update($attributes);

        return $order;
    }

    public function expiredReservations(): Collection
    {
        return Order::query()
            ->where('status', OrderStatus::Reserved)
            ->whereNotNull('reserved_until')
            ->where('reserved_until', '<', now())
            ->get();
    }

    /**
     * Paginated, filterable listing for the Sales report. product_id/
     * warehouse_id live on order_items, not orders, so those two filters
     * go through a whereHas() — the (status, created_at) index on `orders`
     * still serves the status/date filters directly.
     */
    public function paginateForSalesReport(int $perPage, array $filters = []): LengthAwarePaginator
    {
        return Order::query()
            ->with('user:id,name')
            ->when($filters['status'] ?? null, fn ($query, $status) => $query->where('status', $status))
            ->when($filters['user_id'] ?? null, fn ($query, $userId) => $query->where('user_id', $userId))
            ->when($filters['date_from'] ?? null, fn ($query, $date) => $query->where('created_at', '>=', $date))
            ->when($filters['date_to'] ?? null, fn ($query, $date) => $query->where('created_at', '<=', $date))
            ->when(
                $filters['product_id'] ?? null,
                fn ($query, $productId) => $query->whereHas('items', fn ($q) => $q->where('product_id', $productId))
            )
            ->when(
                $filters['warehouse_id'] ?? null,
                fn ($query, $warehouseId) => $query->whereHas('items', fn ($q) => $q->where('warehouse_id', $warehouseId))
            )
            ->orderByDesc('created_at')
            ->paginate($perPage)
            ->withQueryString();
    }

    public function salesTotalSince(\DateTimeInterface $since): string
    {
        return (string) Order::query()
            ->whereIn('status', [OrderStatus::Confirmed, OrderStatus::Fulfilled])
            ->where('created_at', '>=', $since)
            ->sum('total');
    }
}
