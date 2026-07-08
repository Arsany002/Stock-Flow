import { Head, Link } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';
import Breadcrumbs from '@/Components/Breadcrumbs';
import Table from '@/Components/Table';
import Pagination from '@/Components/Pagination';

export default function Index({ payments }) {
    const columns = [
        {
            key: 'id',
            label: 'Payment',
            render: (row) => (
                <Link href={`/payments/${row.id}`} className="font-medium text-gray-900 underline">
                    {row.id.slice(0, 8)}
                </Link>
            ),
        },
        { key: 'method_label', label: 'Method' },
        { key: 'status_label', label: 'Status' },
        { key: 'amount', label: 'Amount' },
        {
            key: 'payable',
            label: 'Payable',
            render: (row) =>
                row.payable ? (
                    <Link href={row.payable.href} className="underline">
                        {row.payable.type === 'order' ? 'Order' : 'PO'} {row.payable.id.slice(0, 8)}
                    </Link>
                ) : (
                    'Unknown'
                ),
        },
        {
            key: 'created_at',
            label: 'Created',
            render: (row) => new Date(row.created_at).toLocaleString(),
        },
    ];

    return (
        <AppLayout>
            <Head title="Payments" />

            <div className="flex flex-col gap-4">
                <Breadcrumbs items={[{ label: 'Payments' }]} />
                <h1 className="text-xl font-semibold text-gray-900">Payments</h1>

                <Table columns={columns} rows={payments.data} emptyMessage="No payments found." />
                <Pagination links={payments.links} />
            </div>
        </AppLayout>
    );
}
