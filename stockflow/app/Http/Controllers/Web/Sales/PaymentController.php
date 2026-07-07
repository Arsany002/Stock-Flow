<?php

namespace App\Http\Controllers\Web\Sales;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Services\OrderService;
use App\Services\PaymentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class PaymentController extends Controller
{
    public function __construct(
        private readonly PaymentService $payments,
        private readonly OrderService $orders,
    ) {}

    public function show(Payment $payment): Response
    {
        $this->authorize('view', $payment);

        $payment->load('payable');

        return Inertia::render('Sales/Payments/Show', [
            'payment' => [
                'id' => $payment->id,
                'method' => $payment->method->value,
                'method_label' => $payment->method->label(),
                'is_placeholder' => $payment->method->isPlaceholder(),
                'status' => $payment->status->value,
                'status_label' => $payment->status->label(),
                'amount' => $payment->amount,
                'meta' => $payment->meta,
                'created_at' => $payment->created_at,
                'order' => $payment->payable instanceof Order ? [
                    'id' => $payment->payable->id,
                    'status' => $payment->payable->status->value,
                ] : null,
            ],
            'canSettle' => Auth::user()->can('settle', $payment),
        ]);
    }

    /**
     * Staff-only (`payment.settle`): settles a pending Cod/Paymob/Fawry
     * payment and converts the order's reservation into a confirmed sale.
     */
    public function settle(Payment $payment): RedirectResponse
    {
        $this->authorize('settle', $payment);

        $payment = $this->payments->settleManually($payment);

        if ($payment->payable instanceof Order) {
            $this->orders->confirmPayment($payment->payable, Auth::user());
        }

        return redirect()->route('payments.show', $payment)->with('flash.success', 'Payment settled — order confirmed.');
    }
}
