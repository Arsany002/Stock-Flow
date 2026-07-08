import { Head } from '@inertiajs/react';
import StorefrontLayout from '@/Layouts/StorefrontLayout';
import ProductCard from '@/Components/ProductCard';

export default function Home({ featuredProducts }) {
    return (
        <StorefrontLayout>
            <Head title="Welcome" />

            <div className="flex flex-col gap-6">
                <div className="rounded-lg bg-white p-8 shadow-sm ring-1 ring-gray-200">
                    <h1 className="text-2xl font-semibold text-gray-900">Welcome to StockFlow</h1>
                    <p className="mt-2 text-sm text-gray-600">
                        Browse our catalog, add items to your cart, and check out once you&apos;re signed in.
                    </p>
                </div>

                <div>
                    <h2 className="mb-3 text-lg font-semibold text-gray-900">Featured products</h2>
                    {featuredProducts.length === 0 ? (
                        <p className="text-sm text-gray-500">No products available yet.</p>
                    ) : (
                        <div className="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                            {featuredProducts.map((product) => (
                                <ProductCard key={product.id} product={product} />
                            ))}
                        </div>
                    )}
                </div>
            </div>
        </StorefrontLayout>
    );
}
