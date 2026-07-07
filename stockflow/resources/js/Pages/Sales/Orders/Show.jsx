import { Head, Link, router } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';
import Breadcrumbs from '@/Components/Breadcrumbs';
import Table from '@/Components/Table';
import Button from '@/Components/Button';

export default function Show({ order, canFulfill }) {
    function fulfill() {
        router.post(`/orders/${order.id}/fulfill`, {}, { preserveScroll: true });
    }

    const itemColumns = [
        { key: 'product', label: 'Product', render: (row) => `${row.product.name} (${row.product.sku})` },
        { key: 'warehouse', label: 'Warehouse', render: (row) => row.warehouse.name },
        { key: 'quantity', label: 'Quantity' },
        { key: 'unit_price', label: 'Unit price' },
        { key: 'line_total', label: 'Line total' },
    ];

    const paymentColumns = [
        {
            key: 'method_label',
            label: 'Method',
            render: (row) => (
                <Link href={`/payments/${row.id}`} className="underline">
                    {row.method_label}
                </Link>
            ),
        },
        { key: 'status_label', label: 'Status' },
        { key: 'amount', label: 'Amount' },
        { key: 'created_at', label: 'Initiated', render: (row) => new Date(row.created_at).toLocaleString() },
    ];

    return (
        <AppLayout>
            <Head title={`Order ${order.id.slice(0, 8)}`} />

            <div className="flex flex-col gap-4">
                <Breadcrumbs items={[{ label: 'Orders', href: '/orders' }, { label: order.id.slice(0, 8) }]} />

                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-xl font-semibold text-gray-900">Order {order.id.slice(0, 8)}</h1>
                        <p className="text-sm text-gray-500">{order.status_label}</p>
                    </div>

                    {canFulfill && order.status === 'confirmed' && (
                        <Button onClick={fulfill}>Mark fulfilled</Button>
                    )}
                </div>

                {order.status === 'reserved' && order.reserved_until && (
                    <p className="rounded-md bg-amber-50 px-3 py-2 text-sm text-amber-800 ring-1 ring-inset ring-amber-200">
                        Stock is reserved until {new Date(order.reserved_until).toLocaleString()}. It will be released
                        automatically if payment isn't settled before then.
                    </p>
                )}

                <div className="rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    <h2 className="mb-3 text-sm font-semibold text-gray-900">Items</h2>
                    <Table columns={itemColumns} rows={order.items} emptyMessage="No items." />
                </div>

                <div className="flex flex-col items-end gap-1 rounded-lg bg-white p-4 shadow-sm ring-1 ring-gray-200">
                    <div className="flex w-64 justify-between text-sm text-gray-600">
                        <span>Subtotal</span>
                        <span>{order.subtotal}</span>
                    </div>
                    <div className="flex w-64 justify-between text-sm text-gray-600">
                        <span>VAT (14%)</span>
                        <span>{order.tax}</span>
                    </div>
                    <div className="flex w-64 justify-between text-base font-semibold text-gray-900">
                        <span>Total</span>
                        <span>{order.total}</span>
                    </div>
                </div>

                <div className="rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    <h2 className="mb-3 text-sm font-semibold text-gray-900">Payments</h2>
                    <Table columns={paymentColumns} rows={order.payments} emptyMessage="No payments yet." />
                </div>
            </div>
        </AppLayout>
    );
}
