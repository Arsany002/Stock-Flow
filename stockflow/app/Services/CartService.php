<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

/**
 * Session-backed cart — requirement #1 of the B2C checkout module allows
 * either a database-backed or session-backed cart, as long as order
 * creation itself is database-backed (which it is: OrderService::checkout()
 * writes the real `orders`/`order_items` rows and reserves stock). Storing
 * `[product_id => quantity]` in the session keeps this simple and avoids a
 * cart table + cleanup job for what is, until checkout, disposable state.
 * Prices are always looked up fresh (never cached in the session), so a
 * price-list change is reflected immediately.
 */
class CartService
{
    private const SESSION_KEY = 'cart';

    public function __construct(private readonly CatalogService $catalog) {}

    public function add(string $productId, int $quantity): void
    {
        $cart = $this->raw();
        $cart[$productId] = ($cart[$productId] ?? 0) + $quantity;

        $this->put($cart);
    }

    public function updateQuantity(string $productId, int $quantity): void
    {
        $cart = $this->raw();

        if ($quantity < 1) {
            unset($cart[$productId]);
        } else {
            $cart[$productId] = $quantity;
        }

        $this->put($cart);
    }

    public function remove(string $productId): void
    {
        $cart = $this->raw();
        unset($cart[$productId]);

        $this->put($cart);
    }

    public function clear(): void
    {
        Session::forget(self::SESSION_KEY);
    }

    public function isEmpty(): bool
    {
        return $this->raw() === [];
    }

    /**
     * Priced cart lines for display — looks up the current product and
     * retail price for every line, silently dropping lines whose product
     * no longer exists (e.g. deleted after being added to the cart).
     *
     * @return Collection<int, array{product: Product, quantity: int, unit_price: string, line_total: string}>
     */
    public function lines(): Collection
    {
        return collect($this->raw())
            ->map(function (int $quantity, string $productId) {
                $product = Product::query()->find($productId);

                if ($product === null) {
                    return null;
                }

                $priceItem = $this->catalog->retailPriceFor($productId, $quantity);
                $unitPrice = $priceItem !== null ? (string) $priceItem->unit_price : '0.00';

                return [
                    'product' => $product,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'line_total' => bcmul($unitPrice, (string) $quantity, 2),
                ];
            })
            ->filter()
            ->values();
    }

    public function subtotal(): string
    {
        return $this->lines()->reduce(
            fn (string $carry, array $line) => bcadd($carry, $line['line_total'], 2),
            '0.00'
        );
    }

    /**
     * The shape OrderService::checkout() expects.
     *
     * @return list<array{product_id: string, quantity: int}>
     */
    public function toCheckoutLines(): array
    {
        return collect($this->raw())
            ->map(fn (int $quantity, string $productId) => ['product_id' => $productId, 'quantity' => $quantity])
            ->values()
            ->all();
    }

    /**
     * @return array<string, int>
     */
    private function raw(): array
    {
        return Session::get(self::SESSION_KEY, []);
    }

    /**
     * @param  array<string, int>  $cart
     */
    private function put(array $cart): void
    {
        Session::put(self::SESSION_KEY, $cart);
    }
}
