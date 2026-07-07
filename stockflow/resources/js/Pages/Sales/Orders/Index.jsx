import { Head, Link } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';
import Breadcrumbs from '@/Components/Breadcrumbs';
import Table from '@/Components/Table';
import Pagination from '@/Components/Pagination';

const STATUS_STYLES = {
    pending: 'bg-gray-100 text-gray-600',
    reserved: 'bg-amber-50 text-amber-700',
    confirmed: 'bg-green-50 text-green-700',
    cancelled: 'bg-red-50 text-red-700',
    fulfilled: 'bg-blue-50 text-blue-700',
};

export default function Index({ orders }) {
    const columns = [
        {
            key: 'id',
            label: 'Order',
            render: (row) => (
                <Link href={`/orders/${row.id}`} className="font-medium text-gray-900 underline">
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
        { key: 'created_at', label: 'Placed', render: (row) => new Date(row.created_at).toLocaleString() },
    ];

    return (
        <AppLayout>
            <Head title="My orders" />

            <div className="flex flex-col gap-4">
                <Breadcrumbs items={[{ label: 'Orders' }]} />

                <h1 className="text-xl font-semibold text-gray-900">My orders</h1>

                <Table columns={columns} rows={orders.data} emptyMessage="You haven't placed any orders yet." />

                <Pagination links={orders.links} />
            </div>
        </AppLayout>
    );
}
