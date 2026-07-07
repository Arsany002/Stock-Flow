<?php

namespace App\Repositories\Contracts;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface PaymentRepositoryInterface
{
    public function find(string $id): ?Payment;

    /**
     * Used for webhook idempotency — dedupe by gateway_ref.
     */
    public function findByGatewayRef(string $gatewayRef): ?Payment;

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
}
