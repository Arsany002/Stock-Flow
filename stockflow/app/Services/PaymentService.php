<?php

namespace App\Services;

use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Exceptions\InvalidStateTransitionException;
use App\Models\Payment;
use App\Payments\CodGateway;
use App\Payments\FakeGateway;
use App\Payments\FawryGateway;
use App\Payments\ManualSettlementGateway;
use App\Payments\PaymentGatewayInterface;
use App\Payments\PaymobGateway;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Payment record lifecycle — creates/updates `payments` rows and delegates
 * the actual "did it succeed" decision to a per-method gateway driver
 * (app/Payments). This class never touches stock; OrderService decides
 * what a payment outcome means for an order (confirm the sale vs. release
 * the reservation) and calls StockService itself. Real gateway integration
 * (Paymob/Fawry webhooks under /webhooks/v1) is future work — see
 * verifyWebhook().
 */
class PaymentService
{
    public function __construct(private readonly PaymentRepositoryInterface $payments) {}

    /**
     * Creates a `pending` Payment row for $payable, then immediately asks
     * the method's gateway driver to initiate it. For Cod/Paymob/Fawry
     * that leaves it `pending` (settled later, manually or via a future
     * webhook); for Fake it resolves synchronously to paid/failed right
     * here, based on $options['outcome'].
     *
     * @param  array<string, mixed>  $options
     */
    public function initiate(Model $payable, PaymentMethod $method, float $amount, array $options = []): Payment
    {
        $payment = $this->payments->create([
            'payable_type' => $payable->getMorphClass(),
            'payable_id' => $payable->getKey(),
            'method' => $method,
            'status' => PaymentStatus::Pending,
            'amount' => $amount,
        ]);

        $result = $this->resolveGateway($method)->initiate($payment, $options);

        return $this->payments->update($payment, [
            'status' => $result['status'],
            'meta' => $result['meta'],
        ]);
    }

    /**
     * Real Paymob/Fawry webhook handling — signature verification and
     * idempotent (by gateway_ref) status updates under /webhooks/v1. Not
     * built yet: neither gateway has a real integration (see
     * app/Payments/PaymobGateway.php, FawryGateway.php), and the
     * /webhooks/v1 route group doesn't exist yet either. When it is,
     * this must verify the signature (throwing
     * PaymentVerificationException::invalidSignature() on failure) and
     * dedupe by `payments.gateway_ref` before touching anything.
     */
    public function verifyWebhook(string $method, array $payload, string $signature): void
    {
        throw new \LogicException(__METHOD__.' is not implemented yet — no real Paymob/Fawry integration exists.');
    }

    /**
     * Staff-triggered settlement (`payment.settle`) for a payment that
     * can't resolve itself: Cod (cash collected on delivery), Paymob/Fawry
     * placeholders, or Bank transfer. Only moves the Payment row itself —
     * OrderService::confirmPayment() is what converts the order's
     * reservation to a sale afterward.
     */
    public function settleManually(Payment $payment): Payment
    {
        if ($payment->status !== PaymentStatus::Pending) {
            throw InvalidStateTransitionException::make('Payment.status', $payment->status->value, PaymentStatus::Paid->value);
        }

        return $this->payments->update($payment, ['status' => PaymentStatus::Paid]);
    }

    /**
     * Marks a payment failed — used when a reservation expires unpaid or
     * checkout's synchronous (Fake) gateway reports failure.
     */
    public function markFailed(Payment $payment): Payment
    {
        if ($payment->status !== PaymentStatus::Pending) {
            throw InvalidStateTransitionException::make('Payment.status', $payment->status->value, PaymentStatus::Failed->value);
        }

        return $this->payments->update($payment, ['status' => PaymentStatus::Failed]);
    }

    private function resolveGateway(PaymentMethod $method): PaymentGatewayInterface
    {
        return match ($method) {
            PaymentMethod::Cod => new CodGateway,
            PaymentMethod::Fake => new FakeGateway,
            PaymentMethod::Paymob => new PaymobGateway,
            PaymentMethod::Fawry => new FawryGateway,
            PaymentMethod::BankTransfer => new ManualSettlementGateway,
        };
    }
}
