<?php

namespace App\Http\Controllers\Web\Sales;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Http\Controllers\Controller;
use App\Http\Requests\Sales\StoreCheckoutRequest;
use App\Models\Order;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class CheckoutController extends Controller
{
    /** Methods a B2C customer can actually pick at checkout — see requirement #7. */
    private const CHECKOUT_METHODS = [
        PaymentMethod::Cod,
        PaymentMethod::Fake,
        PaymentMethod::Paymob,
        PaymentMethod::Fawry,
    ];

    private const VAT_RATE = 0.14;

    public function __construct(
        private readonly CartService $cart,
        private readonly OrderService $orders,
    ) {}

    public function create(): Response|RedirectResponse
    {
        $this->authorize('create', Order::class);

        if ($this->cart->isEmpty()) {
            return redirect()->route('cart.show')->with('flash.error', 'Your cart is empty.');
        }

        $lines = $this->cart->lines();
        $subtotal = $this->cart->subtotal();
        $tax = bcmul($subtotal, (string) self::VAT_RATE, 2);
        $total = bcadd($subtotal, $tax, 2);

        return Inertia::render('Sales/Checkout/Create', [
            'lines' => $lines->map(fn (array $line) => [
                'product' => $line['product']->only(['id', 'name', 'sku']),
                'quantity' => $line['quantity'],
                'unit_price' => $line['unit_price'],
                'line_total' => $line['line_total'],
            ]),
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
            'paymentMethods' => collect(self::CHECKOUT_METHODS)->map(fn (PaymentMethod $m) => [
                'value' => $m->value,
                'label' => $m->label(),
                'is_placeholder' => $m->isPlaceholder(),
            ]),
        ]);
    }

    public function store(StoreCheckoutRequest $request): RedirectResponse
    {
        if ($this->cart->isEmpty()) {
            return redirect()->route('cart.show')->with('flash.error', 'Your cart is empty.');
        }

        $data = $request->validated();
        $method = PaymentMethod::from($data['payment_method']);
        $paymentOptions = $method === PaymentMethod::Fake
            ? ['outcome' => $data['outcome'] ?? 'succeed']
            : [];

        $order = $this->orders->checkout(Auth::user(), $this->cart->toCheckoutLines(), $method, $paymentOptions);

        $this->cart->clear();

        return redirect()->route('orders.show', $order)->with('flash.success', $this->flashMessageFor($order));
    }

    private function flashMessageFor(Order $order): string
    {
        return match ($order->status) {
            OrderStatus::Confirmed => 'Payment successful — your order is confirmed.',
            OrderStatus::Cancelled => 'Payment failed — your reservation was released.',
            default => 'Order placed — awaiting payment.',
        };
    }
}
