<?php

namespace App\Http\Controllers\Web\Sales;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sales\AddToCartRequest;
use App\Http\Requests\Sales\UpdateCartItemRequest;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class CartController extends Controller
{
    /**
     * Same flat 14% VAT as OrderService — this is a display-only estimate
     * for the cart page; the authoritative total is always recomputed
     * server-side by OrderService::checkout() at checkout time.
     */
    private const VAT_RATE = 0.14;

    public function __construct(private readonly CartService $cart) {}

    public function show(): Response
    {
        $lines = $this->cart->lines();
        $subtotal = $this->cart->subtotal();
        $tax = bcmul($subtotal, (string) self::VAT_RATE, 2);
        $total = bcadd($subtotal, $tax, 2);

        return Inertia::render('Sales/Cart/Show', [
            'lines' => $lines->map(fn (array $line) => [
                'product' => $line['product']->only(['id', 'name', 'sku']),
                'quantity' => $line['quantity'],
                'unit_price' => $line['unit_price'],
                'line_total' => $line['line_total'],
            ]),
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
        ]);
    }

    public function store(AddToCartRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $this->cart->add($data['product_id'], (int) $data['quantity']);

        return redirect()->route('cart.show')->with('flash.success', 'Added to cart.');
    }

    public function update(UpdateCartItemRequest $request, string $product): RedirectResponse
    {
        $this->cart->updateQuantity($product, (int) $request->validated('quantity'));

        return redirect()->route('cart.show')->with('flash.success', 'Cart updated.');
    }

    public function destroy(string $product): RedirectResponse
    {
        $this->cart->remove($product);

        return redirect()->route('cart.show')->with('flash.success', 'Removed from cart.');
    }
}
