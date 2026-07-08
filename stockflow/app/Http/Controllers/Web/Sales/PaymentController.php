<?php

namespace App\Http\Controllers\Web\Sales;

use App\Enums\PaymentMethod;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\PurchaseOrder;
use App\Services\PaymentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class PaymentController extends Controller
{
    public function __construct(private readonly PaymentService $payments) {}

    public function index(): Response
    {
        $payments = $this->payments->listAll()->through(fn (Payment $payment) => $this->paymentSummary($payment));

        return Inertia::render('Payments/Index', [
            'payments' => $payments,
        ]);
    }

    public function show(Payment $payment): Response
    {
        $this->authorize('view', $payment);

        $payment->load('payable');

        return Inertia::render('Payments/Show', [
            'payment' => $this->paymentDetail($payment),
            'canSettle' => Auth::user()->can('settle', $payment),
            'canUseFakeGateway' => $payment->method === PaymentMethod::FakeGateway
                && $payment->status->value === 'pending'
                && Auth::user()->can('view', $payment),
        ]);
    }

    public function fakeGateway(Payment $payment): Response
    {
        $this->authorize('view', $payment);

        abort_unless($payment->method === PaymentMethod::FakeGateway, 404);

        return Inertia::render('Payments/FakeGateway', [
            'payment' => $this->paymentDetail($payment->load('payable')),
        ]);
    }

    public function simulateFakeGateway(Request $request, Payment $payment): RedirectResponse
    {
        $this->authorize('view', $payment);

        abort_unless($payment->method === PaymentMethod::FakeGateway, 404);

        $data = $request->validate([
            'outcome' => ['required', Rule::in(['succeed', 'fail'])],
        ]);

        $this->payments->simulateFakeGateway($payment, $data['outcome']);

        return redirect()->route('payments.show', $payment)
            ->with('flash.success', 'Fake gateway callback processed.');
    }

    public function settle(Payment $payment): RedirectResponse
    {
        $this->authorize('settle', $payment);

        $this->payments->settleManually($payment, Auth::user());

        return redirect()->route('payments.show', $payment)
            ->with('flash.success', 'Payment settled.');
    }

    /**
     * @return array<string, mixed>
     */
    private function paymentSummary(Payment $payment): array
    {
        $payable = $payment->payable;

        return [
            'id' => $payment->id,
            'method' => $payment->method->value,
            'method_label' => $payment->method->label(),
            'status' => $payment->status->value,
            'status_label' => $payment->status->label(),
            'amount' => $payment->amount,
            'gateway_ref' => $payment->gateway_ref,
            'created_at' => $payment->created_at,
            'payable' => $this->payableSummary($payable),
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function paymentDetail(Payment $payment): array
    {
        return [
            ...$this->paymentSummary($payment),
            'is_placeholder' => $payment->method->isPlaceholder(),
            'meta' => $payment->meta,
        ];
    }

    /**
     * @return array<string, mixed>|null
     */
    private function payableSummary(mixed $payable): ?array
    {
        if ($payable instanceof Order) {
            return [
                'type' => 'order',
                'id' => $payable->id,
                'status' => $payable->status->value,
                'href' => route('orders.show', $payable, absolute: false),
            ];
        }

        if ($payable instanceof PurchaseOrder) {
            return [
                'type' => 'purchase_order',
                'id' => $payable->id,
                'status' => $payable->status->value,
                'href' => route('procurement.purchase-orders.show', $payable, absolute: false),
            ];
        }

        return null;
    }
}
