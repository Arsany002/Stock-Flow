<?php

namespace App\Repositories\Contracts;

use App\Enums\PaymentStatus;
use App\Models\Payment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface PaymentRepositoryInterface
{
    public function find(string $id): ?Payment;

    public function lockForUpdate(string $id): ?Payment;

    /**
     * Used for webhook idempotency — dedupe by gateway_ref.
     */
    public function findByGatewayRef(string $gatewayRef): ?Payment;

    public function paginateAll(int $perPage = 15): LengthAwarePaginator;

    public function paginateForBusinessAccount(string $businessAccountId, int $perPage = 15): LengthAwarePaginator;

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function create(array $attributes): Payment;

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function update(Payment $payment, array $attributes): Payment;

    /**
     * @return Collection<int, Payment>
     */
    public function forPayable(Model $payable): Collection;

    /**
     * Paginated, filterable listing for the Payments report. No product/
     * warehouse filter — payments have no product dimension. "user" means
     * the payable's owner: Order.user_id for B2C, or
     * PurchaseOrder.businessAccount.user_id for B2B.
     *
     * @param  array<string, mixed>  $filters  status, method, user_id, date_from, date_to
     */
    public function paginateForReport(int $perPage, array $filters = []): LengthAwarePaginator;

    /**
     * Cheap COUNT for dashboard KPIs — e.g. "pending settlement" for staff.
     */
    public function countByStatus(PaymentStatus $status): int;
}
