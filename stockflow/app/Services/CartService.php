<?php

namespace App\Services;

use App\Exceptions\OutOfStockException;
use App\Exceptions\ProductUnavailableException;
use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
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
 *
 * Deliberately never touches StockService: adding to (or updating) the
 * cart only ever writes to the session. No stock_movements row, no
 * reservation, is ever created here — that only happens once an
 * authenticated checkout calls OrderService::checkout(), which delegates
 * to StockService. This is what makes a guest cart safe to expose with no
 * login at all. Because it's plain Laravel session state, it survives a
 * login/logout transition for free — Laravel regenerates the session ID
 * on login (AuthService::login()) but keeps the session's data, so a
 * guest's cart is still there once they authenticate.
 */
class CartService
{
    private const SESSION_KEY = 'cart';

    public function __construct(
        private readonly CatalogService $catalog,
        private readonly ProductRepositoryInterface $products,
        private readonly StockAvailabilityService $availability,
    ) {}

    public function add(string $productId, int $quantity): void
    {
        $cart = $this->raw();
        $desiredQuantity = ($cart[$productId] ?? 0) + $quantity;

        $this->assertAvailableForCart($productId, $desiredQuantity);

        $cart[$productId] = $desiredQuantity;

        $this->put($cart);
    }

    public function updateQuantity(string $productId, int $quantity): void
    {
        $cart = $this->raw();

        if ($quantity < 1) {
            unset($cart[$productId]);
        } else {
            $this->assertAvailableForCart($productId, $quantity);

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
     * Total item count across all lines (sum of quantities, not distinct
     * line count) — shared on every Inertia response as `cart.count` for
     * the storefront header badge.
     */
    public function count(): int
    {
        return array_sum($this->raw());
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
     * Live, public-safe availability check for session cart mutations.
     * This is not a reservation: checkout still re-prices and re-checks
     * stock inside OrderService's authenticated transaction.
     *
     * @throws ProductUnavailableException
     * @throws OutOfStockException
     */
    private function assertAvailableForCart(string $productId, int $desiredQuantity): void
    {
        $product = $this->products->find($productId);

        if ($product === null || ! $product->is_active) {
            throw ProductUnavailableException::forProduct($productId);
        }

        $available = $this->availability->totalAvailableFor($productId);

        if ($desiredQuantity > $available) {
            throw OutOfStockException::forCartAddition($productId, $desiredQuantity, $available);
        }
    }

    /**
     * @param  array<string, int>  $cart
     */
    private function put(array $cart): void
    {
        Session::put(self::SESSION_KEY, $cart);
    }
}
