<?php

namespace App\Repositories\Contracts;

use App\Models\Order;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface OrderRepositoryInterface
{
    public function find(string $id): ?Order;

    public function paginateForUser(int $userId, int $perPage = 15): LengthAwarePaginator;

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function create(array $attributes): Order;

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function update(Order $order, array $attributes): Order;

    /**
     * `reserved` orders whose `reserved_until` has passed — unpaid
     * reservations due for release. Used by
     * OrderService::releaseExpiredReservations() /
     * `stock:release-expired-reservations`.
     *
     * @return Collection<int, Order>
     */
    public function expiredReservations(): Collection;
}
