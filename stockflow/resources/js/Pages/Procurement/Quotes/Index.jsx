import { Head, Link } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';
import Breadcrumbs from '@/Components/Breadcrumbs';
import Table from '@/Components/Table';
import Pagination from '@/Components/Pagination';
import Button from '@/Components/Button';
import PermissionGate from '@/Components/PermissionGate';

const STATUS_STYLES = {
    draft: 'bg-gray-100 text-gray-600',
    sent: 'bg-amber-50 text-amber-700',
    accepted: 'bg-green-50 text-green-700',
    rejected: 'bg-red-50 text-red-700',
    expired: 'bg-red-50 text-red-700',
};

export default function Index({ quotes }) {
    const columns = [
        {
            key: 'id',
            label: 'Quote',
            render: (row) => (
                <Link href={`/procurement/quotes/${row.id}`} className="font-medium text-gray-900 underline">
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
        { key: 'expires_at', label: 'Expires', render: (row) => row.expires_at ?? '—' },
        { key: 'created_at', label: 'Requested', render: (row) => new Date(row.created_at).toLocaleString() },
    ];

    return (
        <AppLayout>
            <Head title="Quotes" />

            <div className="flex flex-col gap-4">
                <Breadcrumbs items={[{ label: 'Procurement' }, { label: 'Quotes' }]} />

                <div className="flex items-center justify-between">
                    <h1 className="text-xl font-semibold text-gray-900">Quotes</h1>
                    <PermissionGate permission="quote.request">
                        <Button as={Link} href="/procurement/quotes/create">
                            Request a quote
                        </Button>
                    </PermissionGate>
                </div>

                <Table columns={columns} rows={quotes.data} emptyMessage="No quotes found." />

                <Pagination links={quotes.links} />
            </div>
        </AppLayout>
    );
}
