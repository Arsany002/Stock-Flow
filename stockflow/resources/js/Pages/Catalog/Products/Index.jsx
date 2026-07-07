import { Head, Link, router } from '@inertiajs/react';
import { useState } from 'react';
import AppLayout from '@/Layouts/AppLayout';
import Breadcrumbs from '@/Components/Breadcrumbs';
import Table from '@/Components/Table';
import Pagination from '@/Components/Pagination';
import Input from '@/Components/Input';
import Select from '@/Components/Select';
import Button from '@/Components/Button';
import PermissionGate from '@/Components/PermissionGate';

export default function Index({ products, filters, categories }) {
    const [search, setSearch] = useState(filters.search ?? '');
    const [categoryId, setCategoryId] = useState(filters.category_id ?? '');

    function applyFilters(event) {
        event.preventDefault();
        router.get(
            '/catalog/products',
            { search: search || undefined, category_id: categoryId || undefined },
            { preserveState: true, replace: true }
        );
    }

    const columns = [
        { key: 'sku', label: 'SKU' },
        {
            key: 'name',
            label: 'Name',
            render: (row) => (
                <Link href={`/catalog/products/${row.id}`} className="font-medium text-gray-900 underline">
                    {row.name}
                </Link>
            ),
        },
        { key: 'category', label: 'Category', render: (row) => row.category ?? '—' },
        {
            key: 'is_active',
            label: 'Status',
            render: (row) => (
                <span
                    className={
                        row.is_active
                            ? 'rounded-full bg-green-50 px-2 py-0.5 text-xs font-medium text-green-700'
                            : 'rounded-full bg-gray-100 px-2 py-0.5 text-xs font-medium text-gray-500'
                    }
                >
                    {row.is_active ? 'Active' : 'Inactive'}
                </span>
            ),
        },
    ];

    return (
        <AppLayout>
            <Head title="Products" />

            <div className="flex flex-col gap-4">
                <Breadcrumbs items={[{ label: 'Catalog' }, { label: 'Products' }]} />

                <div className="flex items-center justify-between">
                    <h1 className="text-xl font-semibold text-gray-900">Products</h1>
                    <PermissionGate permission="product.manage">
                        <Button as={Link} href="/catalog/products/create">
                            New product
                        </Button>
                    </PermissionGate>
                </div>

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
                            options={categories.map((category) => ({ value: category.id, label: category.name }))}
                        />
                    </div>
                    <Button type="submit" variant="secondary">
                        Filter
                    </Button>
                </form>

                <Table columns={columns} rows={products.data} emptyMessage="No products found." />

                <Pagination links={products.links} />
            </div>
        </AppLayout>
    );
}
