<?php

namespace App\Http\Controllers\Web\Sales;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class OrderController extends Controller
{
    public function __construct(private readonly OrderService $orders) {}

    public function index(): Response
    {
        $orders = $this->orders->listForUser(Auth::id())->through(fn (Order $order) => [
            'id' => $order->id,
            'status' => $order->status->value,
            'status_label' => $order->status->label(),
            'total' => $order->total,
            'created_at' => $order->created_at,
        ]);

        return Inertia::render('Sales/Orders/Index', [
            'orders' => $orders,
        ]);
    }

    public function show(Order $order): Response
    {
        $this->authorize('view', $order);

        $order->load(['items.product', 'items.warehouse', 'payments']);

        return Inertia::render('Sales/Orders/Show', [
            'order' => [
                'id' => $order->id,
                'status' => $order->status->value,
                'status_label' => $order->status->label(),
                'subtotal' => $order->subtotal,
                'tax' => $order->tax,
                'total' => $order->total,
                'reserved_until' => $order->reserved_until,
                'created_at' => $order->created_at,
                'items' => $order->items->map(fn ($item) => [
                    'id' => $item->id,
                    'product' => $item->product->only(['id', 'name', 'sku']),
                    'warehouse' => $item->warehouse->only(['id', 'name']),
                    'quantity' => $item->quantity,
                    'unit_price' => $item->unit_price,
                    'line_total' => $item->line_total,
                ]),
                'payments' => $order->payments->map(fn ($payment) => [
                    'id' => $payment->id,
                    'method' => $payment->method->value,
                    'method_label' => $payment->method->label(),
                    'status' => $payment->status->value,
                    'status_label' => $payment->status->label(),
                    'amount' => $payment->amount,
                    'created_at' => $payment->created_at,
                ]),
            ],
            'canSettlePayment' => Auth::user()->can('settlePayment', $order),
            'canFulfill' => Auth::user()->can('fulfill', $order),
        ]);
    }

    /**
     * Staff-only: confirmed -> fulfilled (delivered/picked up).
     */
    public function fulfill(Order $order): RedirectResponse
    {
        $this->authorize('fulfill', $order);

        $this->orders->markFulfilled($order);

        return redirect()->route('orders.show', $order)->with('flash.success', 'Order marked fulfilled.');
    }
}
