<?php

namespace App\Http\Controllers\Web\Storefront;

use App\Http\Controllers\Controller;
use App\Http\Requests\Storefront\AddToCartRequest;
use App\Http\Requests\Storefront\UpdateCartItemRequest;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

/**
 * Guest-accessible: the cart is session state, not a Model, so there's no
 * login/permission gate here at all (see routes/web.php). Never reserves
 * stock or writes anything but the session — see CartService's docblock.
 */
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
        return Inertia::render('Storefront/Cart/Show', $this->cartProps());
    }

    public function store(AddToCartRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $this->cart->add($data['product_id'], (int) $data['quantity']);

        return redirect()->route('cart.show')->with('flash.success', 'Added to cart.');
    }

    public function update(UpdateCartItemRequest $request, string $item): RedirectResponse
    {
        $this->cart->updateQuantity($item, (int) $request->validated('quantity'));

        return redirect()->route('cart.show')->with('flash.success', 'Cart updated.');
    }

    public function destroy(string $item): RedirectResponse
    {
        $this->cart->remove($item);

        return redirect()->route('cart.show')->with('flash.success', 'Removed from cart.');
    }

    public function clear(): RedirectResponse
    {
        $this->cart->clear();

        return redirect()->route('cart.show')->with('flash.success', 'Cart cleared.');
    }

    /**
     * @return array<string, mixed>
     */
    private function cartProps(): array
    {
        $lines = $this->cart->lines();
        $subtotal = $this->cart->subtotal();
        $tax = bcmul($subtotal, (string) self::VAT_RATE, 2);
        $total = bcadd($subtotal, $tax, 2);

        return [
            'lines' => $lines->map(fn (array $line) => [
                'product' => $line['product']->only(['id', 'name', 'sku']),
                'quantity' => $line['quantity'],
                'unit_price' => $line['unit_price'],
                'line_total' => $line['line_total'],
            ]),
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
        ];
    }
}
