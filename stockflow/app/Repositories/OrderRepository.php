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
}
