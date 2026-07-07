import { Head, Link, useForm } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';
import Breadcrumbs from '@/Components/Breadcrumbs';
import Input from '@/Components/Input';
import Select from '@/Components/Select';
import Button from '@/Components/Button';

export default function Edit({ product, categories, suppliers }) {
    const { data, setData, put, processing, errors } = useForm({
        category_id: product.category_id ?? '',
        supplier_id: product.supplier_id ?? '',
        sku: product.sku,
        name: product.name,
        description: product.description ?? '',
        is_active: product.is_active,
    });

    function submit(event) {
        event.preventDefault();
        put(`/catalog/products/${product.id}`);
    }

    return (
        <AppLayout>
            <Head title={`Edit — ${product.name}`} />

            <div className="flex flex-col gap-4">
                <Breadcrumbs
                    items={[
                        { label: 'Catalog' },
                        { label: 'Products', href: '/catalog/products' },
                        { label: product.name, href: `/catalog/products/${product.id}` },
                        { label: 'Edit' },
                    ]}
                />

                <h1 className="text-xl font-semibold text-gray-900">Edit {product.name}</h1>

                <form onSubmit={submit} className="flex flex-col gap-4 rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    <Input
                        label="SKU"
                        name="sku"
                        value={data.sku}
                        error={errors.sku}
                        onChange={(e) => setData('sku', e.target.value)}
                        autoFocus
                        required
                    />

                    <Input
                        label="Name"
                        name="name"
                        value={data.name}
                        error={errors.name}
                        onChange={(e) => setData('name', e.target.value)}
                        required
                    />

                    <Select
                        label="Category"
                        name="category_id"
                        placeholder="Select a category"
                        value={data.category_id}
                        error={errors.category_id}
                        onChange={(e) => setData('category_id', e.target.value)}
                        options={categories.map((category) => ({ value: category.id, label: category.name }))}
                        required
                    />

                    <Select
                        label="Supplier"
                        name="supplier_id"
                        placeholder="No supplier"
                        value={data.supplier_id}
                        error={errors.supplier_id}
                        onChange={(e) => setData('supplier_id', e.target.value)}
                        options={suppliers.map((supplier) => ({ value: supplier.id, label: supplier.name }))}
                    />

                    <div className="flex flex-col gap-1">
                        <label htmlFor="description" className="text-sm font-medium text-gray-700">
                            Description
                        </label>
                        <textarea
                            id="description"
                            name="description"
                            rows={4}
                            value={data.description}
                            onChange={(e) => setData('description', e.target.value)}
                            className="block w-full rounded-md border-0 px-3 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 sm:text-sm"
                        />
                        {errors.description && <p className="text-sm text-red-600">{errors.description}</p>}
                    </div>

                    <label className="flex items-center gap-2 text-sm text-gray-700">
                        <input
                            type="checkbox"
                            checked={data.is_active}
                            onChange={(e) => setData('is_active', e.target.checked)}
                            className="rounded border-gray-300"
                        />
                        Active
                    </label>

                    <div className="flex items-center gap-3">
                        <Button type="submit" disabled={processing}>
                            Save changes
                        </Button>
                        <Link href={`/catalog/products/${product.id}`} className="text-sm text-gray-500 underline">
                            Cancel
                        </Link>
                    </div>
                </form>
            </div>
        </AppLayout>
    );
}
