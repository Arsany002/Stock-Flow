<?php

namespace App\Repositories;

use App\Enums\PaymentStatus;
use App\Models\Order;
use App\Models\Payment;
use App\Models\PurchaseOrder;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PaymentRepository implements PaymentRepositoryInterface
{
    public function find(string $id): ?Payment
    {
        return Payment::query()->find($id);
    }

    public function lockForUpdate(string $id): ?Payment
    {
        return Payment::query()
            ->whereKey($id)
            ->lockForUpdate()
            ->first();
    }

    public function findByGatewayRef(string $gatewayRef): ?Payment
    {
        return Payment::query()->where('gateway_ref', $gatewayRef)->first();
    }

    public function paginateAll(int $perPage = 15): LengthAwarePaginator
    {
        return Payment::query()
            ->with('payable')
            ->latest()
            ->paginate($perPage);
    }

    public function paginateForBusinessAccount(string $businessAccountId, int $perPage = 15): LengthAwarePaginator
    {
        return Payment::query()
            ->with('payable')
            ->where('payable_type', (new PurchaseOrder)->getMorphClass())
            ->whereHasMorph('payable', [PurchaseOrder::class], fn ($query) => $query
                ->where('business_account_id', $businessAccountId))
            ->latest()
            ->paginate($perPage);
    }

    public function create(array $attributes): Payment
    {
        return Payment::query()->create($attributes);
    }

    public function update(Payment $payment, array $attributes): Payment
    {
        $payment->update($attributes);

        return $payment;
    }

    public function forPayable(Model $payable): Collection
    {
        return Payment::query()
            ->where('payable_type', $payable->getMorphClass())
            ->where('payable_id', $payable->getKey())
            ->get();
    }

    public function paginateForReport(int $perPage, array $filters = []): LengthAwarePaginator
    {
        return Payment::query()
            ->with('payable')
            ->when($filters['status'] ?? null, fn ($query, $status) => $query->where('status', $status))
            ->when($filters['method'] ?? null, fn ($query, $method) => $query->where('method', $method))
            ->when($filters['date_from'] ?? null, fn ($query, $date) => $query->where('created_at', '>=', $date))
            ->when($filters['date_to'] ?? null, fn ($query, $date) => $query->where('created_at', '<=', $date))
            ->when($filters['user_id'] ?? null, function ($query, $userId) {
                $query->where(function ($query) use ($userId) {
                    $query
                        ->whereHasMorph('payable', [Order::class], fn ($q) => $q->where('user_id', $userId))
                        ->orWhereHasMorph('payable', [PurchaseOrder::class], fn ($q) => $q
                            ->whereHas('businessAccount', fn ($q) => $q->where('user_id', $userId)));
                });
            })
            ->orderByDesc('created_at')
            ->paginate($perPage)
            ->withQueryString();
    }

    public function countByStatus(PaymentStatus $status): int
    {
        return Payment::query()->where('status', $status)->count();
    }
}
