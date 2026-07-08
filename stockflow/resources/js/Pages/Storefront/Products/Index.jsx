import { Head, router, usePage } from '@inertiajs/react';
import { useState } from 'react';
import StorefrontLayout from '@/Layouts/StorefrontLayout';
import ProductCard from '@/Components/ProductCard';
import Pagination from '@/Components/Pagination';
import Input from '@/Components/Input';
import Select from '@/Components/Select';
import Button from '@/Components/Button';

export default function Index({ products, filters }) {
    const { publicCategories } = usePage().props;
    const [search, setSearch] = useState(filters.search ?? '');
    const [categoryId, setCategoryId] = useState(filters.category_id ?? '');

    function applyFilters(event) {
        event.preventDefault();
        router.get(
            '/products',
            { search: search || undefined, category_id: categoryId || undefined },
            { preserveState: true, replace: true }
        );
    }

    return (
        <StorefrontLayout>
            <Head title="Products" />

            <div className="flex flex-col gap-4">
                <h1 className="text-xl font-semibold text-gray-900">Products</h1>

                <form onSubmit={applyFilters} className="flex flex-wrap items-end gap-3 rounded-lg bg-white p-4 shadow-sm ring-1 ring-gray-200">
                    <div className="w-56">
                        <Input
                            label="Search"
                            name="search"
                            placeholder="Product name"
                            value={search}
                            onChange={(e) => setSearch(e.target.value)}
                        />
                    </div>
                    <div className="w-56">
                        <Select
                            label="Category"
                            name="category_id"
                            placeholder="All categories"
                            value={categoryId}
                            onChange={(e) => setCategoryId(e.target.value)}
                            options={(publicCategories ?? []).map((category) => ({ value: category.id, label: category.name }))}
                        />
                    </div>
                    <Button type="submit" variant="secondary">
                        Filter
                    </Button>
                </form>

                {products.data.length === 0 ? (
                    <p className="text-sm text-gray-500">No products found.</p>
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
