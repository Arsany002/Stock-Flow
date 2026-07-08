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

    /**
     * Paginated, filterable listing for the Sales report.
     *
     * @param  array<string, mixed>  $filters  status, user_id, product_id, warehouse_id, date_from, date_to
     */
    public function paginateForSalesReport(int $perPage, array $filters = []): LengthAwarePaginator;

    /**
     * Sum of `total` for confirmed/fulfilled orders created since
     * $since — the dashboard's "today's sales" KPI.
     */
    public function salesTotalSince(\DateTimeInterface $since): string;
}
