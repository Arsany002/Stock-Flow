import { Head, router } from '@inertiajs/react';
import { useState } from 'react';
import StorefrontLayout from '@/Layouts/StorefrontLayout';
import ProductCard from '@/Components/ProductCard';
import Pagination from '@/Components/Pagination';
import Input from '@/Components/Input';
import Button from '@/Components/Button';

export default function Search({ query, products }) {
    const [q, setQ] = useState(query ?? '');

    function submit(event) {
        event.preventDefault();
        router.get('/search', { q: q || undefined }, { preserveState: true, replace: true });
    }

    return (
        <StorefrontLayout>
            <Head title="Search" />

            <div className="flex flex-col gap-4">
                <h1 className="text-xl font-semibold text-gray-900">Search products</h1>

                <form onSubmit={submit} className="flex flex-wrap items-end gap-3 rounded-lg bg-white p-4 shadow-sm ring-1 ring-gray-200">
                    <div className="w-72">
                        <Input label="Search" name="q" value={q} onChange={(e) => setQ(e.target.value)} />
                    </div>
                    <Button type="submit">Search</Button>
                </form>

                {products === null ? (
                    <p className="text-sm text-gray-500">Enter a search term to find products.</p>
                ) : products.data.length === 0 ? (
                    <p className="text-sm text-gray-500">No products matched &quot;{query}&quot;.</p>
                ) : (
                    <div className="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                        {products.data.map((product) => (
                            <ProductCard key={product.id} product={product} />
                        ))}
                    </div>
                )}

                {products !== null && <Pagination links={products.links} />}
            </div>
        </StorefrontLayout>
    );
}
