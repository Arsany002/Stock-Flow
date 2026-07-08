import { Head, Link } from '@inertiajs/react';
import StorefrontLayout from '@/Layouts/StorefrontLayout';
import Breadcrumbs from '@/Components/Breadcrumbs';
import StockBadge from '@/Components/StockBadge';
import PriceLabel from '@/Components/PriceLabel';
import AddToCartButton from '@/Components/AddToCartButton';

export default function Show({ product }) {
    return (
        <StorefrontLayout>
            <Head title={product.name} />

            <div className="flex flex-col gap-4">
                <Breadcrumbs
                    items={[
                        { label: 'Products', href: '/products' },
                        ...(product.category ? [{ label: product.category.name, href: `/categories/${product.category.slug}` }] : []),
                        { label: product.name },
                    ]}
                />

                <div className="rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    <div className="flex items-start justify-between gap-4">
                        <div>
                            <h1 className="text-xl font-semibold text-gray-900">{product.name}</h1>
                            <p className="mt-1 text-sm text-gray-500">SKU: {product.sku}</p>
                        </div>
                        <StockBadge status={product.stock_status} label={product.stock_label} />
                    </div>

                    <div className="mt-4">
                        <PriceLabel price={product.price} className="text-2xl" />
                    </div>

                    {product.description && <p className="mt-4 text-sm text-gray-700">{product.description}</p>}

                    <div className="mt-6">
                        <AddToCartButton productId={product.id} canAddToCart={product.can_add_to_cart} />
                    </div>

                    <Link href="/cart" className="mt-4 inline-block text-sm text-gray-500 underline">
                        View cart
                    </Link>
                </div>
            </div>
        </StorefrontLayout>
    );
}
