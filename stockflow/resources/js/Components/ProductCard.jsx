import { Link } from '@inertiajs/react';
import StockBadge from '@/Components/StockBadge';
import PriceLabel from '@/Components/PriceLabel';
import AddToCartButton from '@/Components/AddToCartButton';

/**
 * Expects the public-safe product payload from
 * StorefrontCatalogService::presentProduct().
 */
export default function ProductCard({ product }) {
    return (
        <div className="flex flex-col gap-3 rounded-lg bg-white p-4 shadow-sm ring-1 ring-gray-200">
            <Link href={`/products/${product.sku}`} className="flex flex-col gap-1">
                <h3 className="text-sm font-semibold text-gray-900 hover:underline">{product.name}</h3>
                <p className="text-xs text-gray-500">SKU: {product.sku}</p>
            </Link>

            <div className="flex items-center justify-between">
                <PriceLabel price={product.price} />
                <StockBadge status={product.stock_status} label={product.stock_label} />
            </div>

            <AddToCartButton productId={product.id} canAddToCart={product.can_add_to_cart} showQuantity={false} />
        </div>
    );
}
