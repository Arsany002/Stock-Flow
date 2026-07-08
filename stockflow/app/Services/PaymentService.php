<?php

namespace App\Services;

use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Exceptions\InvalidStateTransitionException;
use App\Exceptions\PaymentVerificationException;
use App\Models\Order;
use App\Models\Payment;
use App\Models\PurchaseOrder;
use App\Models\User;
use App\Payments\BankTransferGateway;
use App\Payments\CodGateway;
use App\Payments\FakeGateway;
use App\Payments\FawryGateway;
use App\Payments\PaymentGateway;
use App\Payments\PaymobGateway;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Payment lifecycle and idempotency boundary.
 *
 * Gateways never mutate database state. This service creates payments, verifies
 * callbacks through the gateway drivers, locks the payment row, updates status,
 * and converts the payable reservation to sale_out inside the same transaction.
 */
class PaymentService
{
    public function __construct(
        private readonly PaymentRepositoryInterface $payments,
        private readonly AuditService $audit,
    ) {}

    public function listAll(int $perPage = 15): LengthAwarePaginator
    {
        return $this->payments->paginateAll($perPage);
    }

    public function listForViewer(User $user, int $perPage = 15): LengthAwarePaginator
    {
        $businessAccount = $user->businessAccount;

        if ($businessAccount !== null && ! $user->isAbleTo('payment.settle')) {
            return $this->payments->paginateForBusinessAccount($businessAccount->id, $perPage);
        }

        return $this->payments->paginateAll($perPage);
    }

    /**
     * @param  array<string, mixed>  $options
     */
    public function initiate(Model $payable, PaymentMethod $method, float|string $amount, array $options = []): Payment
    {
        $payment = $this->payments->create([
            'payable_type' => $payable->getMorphClass(),
            'payable_id' => $payable->getKey(),
            'method' => $method,
            'status' => PaymentStatus::Pending,
            'amount' => $amount,
        ]);

        $result = $this->resolveGateway($method)->initiate($payment, $options);

        $attributes = [
            'meta' => $result['meta'] ?? null,
        ];

        if (array_key_exists('gateway_ref', $result) && $result['gateway_ref'] !== null) {
            $attributes['gateway_ref'] = $result['gateway_ref'];
        }

        return $this->payments->update($payment, $attributes);
    }

    /**
     * @param  array<string, mixed>  $payload
     * @param  array<string, mixed>  $headers
     */
    public function verifyWebhook(PaymentMethod|string $method, array $payload, array $headers = []): Payment
    {
        $method = $method instanceof PaymentMethod ? $method : PaymentMethod::from($method);
        $event = $this->resolveGateway($method)->verifyWebhook($payload, $headers);

        return $event['successful']
            ? $this->confirmVerifiedPaymentEvent($event)
            : $this->failVerifiedPaymentEvent($event);
    }

    public function simulateFakeGateway(Payment $payment, string $outcome = 'succeed'): Payment
    {
        if ($payment->method !== PaymentMethod::FakeGateway) {
            throw InvalidStateTransitionException::make('Payment.method', $payment->method->value, PaymentMethod::FakeGateway->value);
        }

        $gatewayRef = $payment->gateway_ref ?? "fake_gateway:{$payment->id}";
        $gateway = new FakeGateway;

        return $this->verifyWebhook(PaymentMethod::FakeGateway, [
            'payment_id' => $payment->id,
            'gateway_ref' => $gatewayRef,
            'outcome' => $outcome,
        ], [
            'x-fake-gateway-signature' => $gateway->signatureFor($gatewayRef, $outcome),
        ]);
    }

    public function settleManually(Payment $payment, ?User $actor = null): Payment
    {
        if ($payment->status !== PaymentStatus::Pending) {
            return $payment->fresh(['payable']);
        }

        $gatewayRef = $payment->gateway_ref ?: "manual:{$payment->id}";

        return $this->confirmVerifiedPayment(
            payment: $payment,
            gatewayRef: $gatewayRef,
            meta: ['provider' => 'manual', 'actor_id' => $actor?->id],
            actor: $actor,
        );
    }

    public function markFailed(Payment $payment): Payment
    {
        if ($payment->status !== PaymentStatus::Pending) {
            return $payment->fresh(['payable']);
        }

        return $this->failVerifiedPayment(
            payment: $payment,
            gatewayRef: $payment->gateway_ref ?: "manual-failure:{$payment->id}",
            meta: ['provider' => 'system'],
            releasePayable: false,
        );
    }

    /**
     * @param  array{
     *     payment_id?: string|null,
     *     gateway_ref: string,
     *     successful: bool,
     *     meta?: array<string, mixed>
     * }  $event
     */
    private function confirmVerifiedPaymentEvent(array $event): Payment
    {
        $payment = $this->paymentForEvent($event);

        return $this->confirmVerifiedPayment(
            payment: $payment,
            gatewayRef: $event['gateway_ref'],
            meta: $event['meta'] ?? [],
        );
    }

    /**
     * @param  array{
     *     payment_id?: string|null,
     *     gateway_ref: string,
     *     successful: bool,
     *     meta?: array<string, mixed>
     * }  $event
     */
    private function failVerifiedPaymentEvent(array $event): Payment
    {
        $payment = $this->paymentForEvent($event);

        return $this->failVerifiedPayment(
            payment: $payment,
            gatewayRef: $event['gateway_ref'],
            meta: $event['meta'] ?? [],
            releasePayable: true,
        );
    }

    /**
     * @param  array<string, mixed>  $meta
     */
    private function confirmVerifiedPayment(Payment $payment, string $gatewayRef, array $meta = [], ?User $actor = null): Payment
    {
        return DB::transaction(function () use ($payment, $gatewayRef, $meta, $actor) {
            $locked = $this->payments->lockForUpdate($payment->id);

            if ($locked === null) {
                throw new PaymentVerificationException('Payment no longer exists.');
            }

            if ($locked->gateway_ref !== null && $locked->gateway_ref !== $gatewayRef) {
                throw InvalidStateTransitionException::make('Payment.gateway_ref', $locked->gateway_ref, $gatewayRef);
            }

            if ($locked->status === PaymentStatus::Paid) {
                return $locked->fresh(['payable']);
            }

            if ($locked->status === PaymentStatus::Failed) {
                return $locked->fresh(['payable']);
            }

            $locked = $this->payments->update($locked, [
                'status' => PaymentStatus::Paid,
                'gateway_ref' => $gatewayRef,
                'meta' => $this->mergeMeta($locked, $meta),
            ]);

            $this->settlePayable($locked->payable()->first(), $actor);

            // Requirement #2 of the admin/audit module: "payment
            // settlement" is an audited event category — recorded once,
            // right where status actually transitions to Paid, so it
            // covers manual settlement, webhook confirmation, and the
            // Fake Gateway simulator uniformly (all three funnel through
            // this method) without triple-logging idempotent no-ops.
            $this->audit->record('payment.settled', $locked, $actor, [
                'method' => $locked->method->value,
                'amount' => $locked->amount,
                'gateway_ref' => $gatewayRef,
            ]);

            return $locked->fresh(['payable']);
        });
    }

    /**
     * @param  array<string, mixed>  $meta
     */
    private function failVerifiedPayment(Payment $payment, string $gatewayRef, array $meta = [], bool $releasePayable = true): Payment
    {
        return DB::transaction(function () use ($payment, $gatewayRef, $meta, $releasePayable) {
            $locked = $this->payments->lockForUpdate($payment->id);

            if ($locked === null) {
                throw new PaymentVerificationException('Payment no longer exists.');
            }

            if ($locked->gateway_ref !== null && $locked->gateway_ref !== $gatewayRef) {
                throw InvalidStateTransitionException::make('Payment.gateway_ref', $locked->gateway_ref, $gatewayRef);
            }

            if ($locked->status !== PaymentStatus::Pending) {
                return $locked->fresh(['payable']);
            }

            $locked = $this->payments->update($locked, [
                'status' => PaymentStatus::Failed,
                'gateway_ref' => $gatewayRef,
                'meta' => $this->mergeMeta($locked, $meta),
            ]);

            if ($releasePayable) {
                $this->failPayable($locked->payable()->first());
            }

            return $locked->fresh(['payable']);
        });
    }

    /**
     * @param  array{
     *     payment_id?: string|null,
     *     gateway_ref: string,
     *     successful: bool,
     *     meta?: array<string, mixed>
     * }  $event
     */
    private function paymentForEvent(array $event): Payment
    {
        $existing = $this->payments->findByGatewayRef($event['gateway_ref']);

        if ($existing !== null) {
            return $existing;
        }

        $paymentId = $event['payment_id'] ?? null;

        if (is_string($paymentId) && $paymentId !== '') {
            $payment = $this->payments->find($paymentId);

            if ($payment !== null) {
                return $payment;
            }
        }

        throw new PaymentVerificationException('Webhook did not match a known payment.');
    }

    private function settlePayable(?Model $payable, ?User $actor): void
    {
        if ($payable instanceof Order) {
            app(OrderService::class)->confirmPayment($payable, $actor);

            return;
        }

        if ($payable instanceof PurchaseOrder) {
            app(PurchaseOrderService::class)->settle($payable, $actor);
        }
    }

    private function failPayable(?Model $payable): void
    {
        if ($payable instanceof Order) {
            app(OrderService::class)->cancel($payable, 'Payment failed.');
        }
    }

    /**
     * @param  array<string, mixed>  $meta
     * @return array<string, mixed>
     */
    private function mergeMeta(Payment $payment, array $meta): array
    {
        $existing = $payment->meta ?? [];

        return [
            ...$existing,
            'last_event' => $meta,
        ];
    }

    private function resolveGateway(PaymentMethod $method): PaymentGateway
    {
        return match ($method) {
            PaymentMethod::Cod => new CodGateway,
            PaymentMethod::FakeGateway => new FakeGateway,
            PaymentMethod::Paymob => new PaymobGateway,
            PaymentMethod::Fawry => new FawryGateway,
            PaymentMethod::BankTransfer => new BankTransferGateway,
        };
    }
}
