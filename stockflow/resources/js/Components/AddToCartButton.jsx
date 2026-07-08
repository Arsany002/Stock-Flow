import { useState } from 'react';
import { router } from '@inertiajs/react';
import Button from '@/Components/Button';
import QuantitySelector from '@/Components/QuantitySelector';

/**
 * Posts to POST /cart/items — guest-accessible, never reserves stock (see
 * CartService's docblock). `canAddToCart` mirrors StorefrontCatalogService::
 * presentProduct()'s `can_add_to_cart` (false once stock_status is
 * out_of_stock) — server-side CartService::add() is the real gate; this is
 * just avoiding a pointless round trip for an obviously-blocked action.
 */
export default function AddToCartButton({ productId, canAddToCart = true, showQuantity = true }) {
    const [quantity, setQuantity] = useState(1);
    const [processing, setProcessing] = useState(false);

    function addToCart(event) {
        event.preventDefault();
        setProcessing(true);
        router.post(
            '/cart/items',
            { product_id: productId, quantity },
            { preserveScroll: true, onFinish: () => setProcessing(false) }
        );
    }

    if (!canAddToCart) {
        return (
            <Button variant="secondary" disabled>
                Out of stock
            </Button>
        );
    }

    return (
        <form onSubmit={addToCart} className="flex items-center gap-2">
            {showQuantity && <QuantitySelector value={quantity} onChange={setQuantity} />}
            <Button type="submit" disabled={processing}>
                Add to cart
            </Button>
        </form>
    );
}
