import { Head, router } from '@inertiajs/react';
import { useState } from 'react';
import StorefrontLayout from '@/Layouts/StorefrontLayout';
import Breadcrumbs from '@/Components/Breadcrumbs';
import ProductCard from '@/Components/ProductCard';
import Pagination from '@/Components/Pagination';
import Input from '@/Components/Input';
import Button from '@/Components/Button';

export default function Show({ category, products, filters }) {
    const [search, setSearch] = useState(filters.search ?? '');

    function applyFilters(event) {
        event.preventDefault();
        router.get(`/categories/${category.slug}`, { search: search || undefined }, { preserveState: true, replace: true });
    }

    return (
        <StorefrontLayout>
            <Head title={category.name} />

            <div className="flex flex-col gap-4">
                <Breadcrumbs items={[{ label: 'Products', href: '/products' }, { label: category.name }]} />

                <h1 className="text-xl font-semibold text-gray-900">{category.name}</h1>

                <form onSubmit={applyFilters} className="flex flex-wrap items-end gap-3 rounded-lg bg-white p-4 shadow-sm ring-1 ring-gray-200">
                    <div className="w-56">
                        <Input
                            label="Search in this category"
                            name="search"
                            value={search}
                            onChange={(e) => setSearch(e.target.value)}
                        />
                    </div>
                    <Button type="submit" variant="secondary">
                        Filter
                    </Button>
                </form>

                {products.data.length === 0 ? (
                    <p className="text-sm text-gray-500">No products found in this category.</p>
                ) : (
                    <div className="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                        {products.data.map((product) => (
                            <ProductCard key={product.id} product={product} />
                        ))}
                    </div>
                )}

                <Pagination links={products.links} />
            </div>
        </StorefrontLayout>
    );
}
