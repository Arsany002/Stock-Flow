import { Head, Link, router } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';
import Breadcrumbs from '@/Components/Breadcrumbs';
import Table from '@/Components/Table';
import Button from '@/Components/Button';

export default function Show({ purchaseOrder, canApprove, canReject, canSettle }) {
    function close() {
        if (confirm('Close this purchase order?')) {
            router.post(`/procurement/purchase-orders/${purchaseOrder.id}/close`);
        }
    }

    const itemColumns = [
        { key: 'product', label: 'Product', render: (row) => `${row.product.name} (${row.product.sku})` },
        { key: 'warehouse', label: 'Warehouse', render: (row) => row.warehouse.name },
        { key: 'quantity', label: 'Quantity' },
        { key: 'unit_price', label: 'Unit price' },
    ];

    const approvalColumns = [
        { key: 'decision', label: 'Decision' },
        { key: 'approver', label: 'By', render: (row) => row.approver.name },
        { key: 'note', label: 'Note', render: (row) => row.note ?? '—' },
        { key: 'created_at', label: 'When', render: (row) => new Date(row.created_at).toLocaleString() },
    ];

    return (
        <AppLayout>
            <Head title={`Purchase order ${purchaseOrder.id.slice(0, 8)}`} />

            <div className="flex flex-col gap-4">
                <Breadcrumbs
                    items={[
                        { label: 'Procurement' },
                        { label: 'Purchase orders', href: '/procurement/purchase-orders' },
                        { label: purchaseOrder.id.slice(0, 8) },
                    ]}
                />

                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-xl font-semibold text-gray-900">Purchase order {purchaseOrder.id.slice(0, 8)}</h1>
                        <p className="text-sm text-gray-500">
                            {purchaseOrder.business_account.company_name} — {purchaseOrder.status_label}
                        </p>
                    </div>

                    <div className="flex gap-2">
                        {canApprove && purchaseOrder.status === 'pending_approval' && (
                            <Button as={Link} href={`/procurement/purchase-orders/${purchaseOrder.id}/approve`}>
                                Review approval
                            </Button>
                        )}
                        {canSettle && purchaseOrder.status === 'approved' && (
                            <Button as={Link} href={`/procurement/purchase-orders/${purchaseOrder.id}/bank-transfer`}>
                                Bank transfer settlement
                            </Button>
                        )}
                        {canSettle && purchaseOrder.status === 'fulfilled' && (
                            <Button variant="secondary" onClick={close}>
                                Close order
                            </Button>
                        )}
                    </div>
                </div>

                <div className="rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    <h2 className="mb-3 text-sm font-semibold text-gray-900">Items</h2>
                    <Table columns={itemColumns} rows={purchaseOrder.items} emptyMessage="No items." />
                </div>

                <div className="flex flex-col items-end gap-1 rounded-lg bg-white p-4 shadow-sm ring-1 ring-gray-200">
                    <div className="flex w-64 justify-between text-sm text-gray-600">
                        <span>Subtotal</span>
                        <span>{purchaseOrder.subtotal}</span>
                    </div>
                    <div className="flex w-64 justify-between text-sm text-gray-600">
                        <span>VAT (14%)</span>
                        <span>{purchaseOrder.tax}</span>
                    </div>
                    <div className="flex w-64 justify-between text-base font-semibold text-gray-900">
                        <span>Total</span>
                        <span>{purchaseOrder.total}</span>
                    </div>
                </div>

                {purchaseOrder.approvals.length > 0 && (
                    <div className="rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-200">
                        <h2 className="mb-3 text-sm font-semibold text-gray-900">Approval history</h2>
                        <Table columns={approvalColumns} rows={purchaseOrder.approvals} emptyMessage="No approvals yet." />
                    </div>
                )}

                {purchaseOrder.payments.length > 0 && (
                    <div className="rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-200">
                        <h2 className="mb-3 text-sm font-semibold text-gray-900">Payments</h2>
                        <ul className="divide-y divide-gray-100">
                            {purchaseOrder.payments.map((payment) => (
                                <li key={payment.id} className="flex justify-between py-2 text-sm">
                                    <span>{payment.method_label} — {payment.status_label}</span>
                                    <span>{payment.amount}</span>
                                </li>
                            ))}
                        </ul>
                    </div>
                )}
            </div>
        </AppLayout>
    );
}
