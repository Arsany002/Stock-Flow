import { Head, Link } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';
import Breadcrumbs from '@/Components/Breadcrumbs';
import Table from '@/Components/Table';
import Pagination from '@/Components/Pagination';

const STATUS_STYLES = {
    pending_approval: 'bg-amber-50 text-amber-700',
    approved: 'bg-blue-50 text-blue-700',
    rejected: 'bg-red-50 text-red-700',
    fulfilled: 'bg-green-50 text-green-700',
    closed: 'bg-gray-100 text-gray-600',
};

export default function Index({ purchaseOrders }) {
    const columns = [
        {
            key: 'id',
            label: 'PO',
            render: (row) => (
                <Link href={`/procurement/purchase-orders/${row.id}`} className="font-medium text-gray-900 underline">
                    {row.id.slice(0, 8)}
                </Link>
            ),
        },
        {
            key: 'status',
            label: 'Status',
            render: (row) => (
                <span className={`rounded-full px-2 py-0.5 text-xs font-medium ${STATUS_STYLES[row.status] ?? 'bg-gray-100 text-gray-600'}`}>
                    {row.status_label}
                </span>
            ),
        },
        { key: 'total', label: 'Total' },
        { key: 'created_at', label: 'Created', render: (row) => new Date(row.created_at).toLocaleString() },
    ];

    return (
        <AppLayout>
            <Head title="Purchase orders" />

            <div className="flex flex-col gap-4">
                <Breadcrumbs items={[{ label: 'Procurement' }, { label: 'Purchase orders' }]} />

                <h1 className="text-xl font-semibold text-gray-900">Purchase orders</h1>

                <Table columns={columns} rows={purchaseOrders.data} emptyMessage="No purchase orders found." />

                <Pagination links={purchaseOrders.links} />
            </div>
        </AppLayout>
    );
}
