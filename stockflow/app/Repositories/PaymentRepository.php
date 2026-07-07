<?php

namespace App\Repositories;

use App\Models\Payment;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PaymentRepository implements PaymentRepositoryInterface
{
    public function find(string $id): ?Payment
    {
        return Payment::query()->find($id);
    }

    public function findByGatewayRef(string $gatewayRef): ?Payment
    {
        return Payment::query()->where('gateway_ref', $gatewayRef)->first();
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
}
