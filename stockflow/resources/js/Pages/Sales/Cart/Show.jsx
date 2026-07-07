import { Head, Link, router } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';
import Breadcrumbs from '@/Components/Breadcrumbs';
import Table from '@/Components/Table';
import Button from '@/Components/Button';
import Input from '@/Components/Input';

export default function Show({ lines, subtotal, tax, total }) {
    function updateQuantity(productId, quantity) {
        const parsed = parseInt(quantity, 10);
        router.put(`/cart/${productId}`, { quantity: Number.isNaN(parsed) ? 0 : parsed }, { preserveScroll: true });
    }

    function remove(productId) {
        router.delete(`/cart/${productId}`, { preserveScroll: true });
    }

    const columns = [
        { key: 'product', label: 'Product', render: (row) => `${row.product.name} (${row.product.sku})` },
        {
            key: 'quantity',
            label: 'Quantity',
            render: (row) => (
                <Input
                    type="number"
                    min="1"
                    defaultValue={row.quantity}
                    className="w-20"
                    onBlur={(e) => updateQuantity(row.product.id, e.target.value)}
                />
            ),
        },
        { key: 'unit_price', label: 'Unit price' },
        { key: 'line_total', label: 'Line total' },
        {
            key: 'actions',
            label: '',
            render: (row) => (
                <Button variant="danger" onClick={() => remove(row.product.id)}>
                    Remove
                </Button>
            ),
        },
    ];

    return (
        <AppLayout>
            <Head title="Cart" />

            <div className="flex flex-col gap-4">
                <Breadcrumbs items={[{ label: 'Cart' }]} />

                <h1 className="text-xl font-semibold text-gray-900">Your cart</h1>

                <Table columns={columns} rows={lines} emptyMessage="Your cart is empty. Browse the catalog to add products." />

                {lines.length > 0 && (
                    <div className="flex flex-col items-end gap-1 rounded-lg bg-white p-4 shadow-sm ring-1 ring-gray-200">
                        <div className="flex w-64 justify-between text-sm text-gray-600">
                            <span>Subtotal</span>
                            <span>{subtotal}</span>
                        </div>
                        <div className="flex w-64 justify-between text-sm text-gray-600">
                            <span>VAT (14%)</span>
                            <span>{tax}</span>
                        </div>
                        <div className="flex w-64 justify-between text-base font-semibold text-gray-900">
                            <span>Total</span>
                            <span>{total}</span>
                        </div>

                        <Button as={Link} href="/checkout" className="mt-3">
                            Proceed to checkout
                        </Button>
                    </div>
                )}

                <Link href="/catalog/products" className="text-sm text-gray-500 underline">
                    Continue shopping
                </Link>
            </div>
        </AppLayout>
    );
}
