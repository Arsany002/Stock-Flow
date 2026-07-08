import { Head, Link, router, useForm } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';
import Breadcrumbs from '@/Components/Breadcrumbs';
import Button from '@/Components/Button';
import Input from '@/Components/Input';
import PermissionGate from '@/Components/PermissionGate';

export default function Show({ product }) {
    const { data, setData, post, processing, errors } = useForm({
        product_id: product.id,
        quantity: 1,
    });

    function destroy() {
        if (confirm(`Delete product "${product.name}"? This cannot be undone.`)) {
            router.delete(`/catalog/products/${product.id}`);
        }
    }

    function addToCart(event) {
        event.preventDefault();
        post('/cart/items', { preserveScroll: true });
    }

    return (
        <AppLayout>
            <Head title={product.name} />

            <div className="flex flex-col gap-4">
                <Breadcrumbs
                    items={[
                        { label: 'Catalog' },
                        { label: 'Products', href: '/catalog/products' },
                        { label: product.name },
                    ]}
                />

                <div className="flex items-start justify-between">
                    <div>
                        <h1 className="text-xl font-semibold text-gray-900">{product.name}</h1>
                        <p className="text-sm text-gray-500">SKU: {product.sku}</p>
                    </div>

                    <PermissionGate permission="product.manage">
                        <div className="flex items-center gap-3">
                            <Button as={Link} href={`/catalog/products/${product.id}/edit`} variant="secondary">
                                Edit
                            </Button>
                            <Button variant="danger" onClick={destroy}>
                                Delete
                            </Button>
                        </div>
                    </PermissionGate>
                </div>

                <PermissionGate permission="sale.create">
                    <form onSubmit={addToCart} className="flex items-end gap-3 rounded-lg bg-white p-4 shadow-sm ring-1 ring-gray-200">
                        <div className="w-24">
                            <Input
                                label="Quantity"
                                name="quantity"
                                type="number"
                                min="1"
                                value={data.quantity}
                                error={errors.quantity}
                                onChange={(e) => setData('quantity', e.target.value)}
                            />
                        </div>
                        <Button type="submit" disabled={processing}>
                            Add to cart
                        </Button>
                        <Link href="/cart" className="text-sm text-gray-500 underline">
                            View cart
                        </Link>
                    </form>
                </PermissionGate>

                <div className="grid grid-cols-1 gap-4 rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-200 sm:grid-cols-2">
                    <div>
                        <dt className="text-xs font-medium uppercase tracking-wide text-gray-500">Category</dt>
                        <dd className="mt-1 text-sm text-gray-900">{product.category?.name ?? '—'}</dd>
                    </div>
                    <div>
                        <dt className="text-xs font-medium uppercase tracking-wide text-gray-500">Supplier</dt>
                        <dd className="mt-1 text-sm text-gray-900">{product.supplier?.name ?? '—'}</dd>
                    </div>
                    <div>
                        <dt className="text-xs font-medium uppercase tracking-wide text-gray-500">Status</dt>
                        <dd className="mt-1 text-sm text-gray-900">{product.is_active ? 'Active' : 'Inactive'}</dd>
                    </div>
                    {product.description && (
                        <div className="sm:col-span-2">
                            <dt className="text-xs font-medium uppercase tracking-wide text-gray-500">Description</dt>
                            <dd className="mt-1 text-sm text-gray-900">{product.description}</dd>
                        </div>
                    )}
                </div>

                <div className="rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    <h2 className="mb-3 text-sm font-semibold text-gray-900">Price list entries</h2>
                    {product.price_list_items.length === 0 ? (
                        <p className="text-sm text-gray-500">Not listed on any price list yet.</p>
                    ) : (
                        <ul className="divide-y divide-gray-100">
                            {product.price_list_items.map((item) => (
                                <li key={item.id} className="flex items-center justify-between py-2 text-sm">
                                    <span className="text-gray-700">{item.price_list.name}</span>
                                    <span className="text-gray-900">
                                        {item.unit_price} (min qty {item.min_qty})
                                    </span>
                                </li>
                            ))}
                        </ul>
                    )}
                </div>
            </div>
        </AppLayout>
    );
}
