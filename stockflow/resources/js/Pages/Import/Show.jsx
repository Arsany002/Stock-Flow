import { Head, Link, router } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';
import Breadcrumbs from '@/Components/Breadcrumbs';
import Button from '@/Components/Button';
import Pagination from '@/Components/Pagination';
import Table from '@/Components/Table';

function statusClass(status) {
    return {
        pending: 'bg-gray-100 text-gray-700',
        processing: 'bg-blue-50 text-blue-700',
        completed: 'bg-green-50 text-green-700',
        failed: 'bg-red-50 text-red-700',
        imported: 'bg-green-50 text-green-700',
    }[status] ?? 'bg-gray-100 text-gray-700';
}

function Payload({ value }) {
    return (
        <code className="block max-w-lg truncate rounded bg-gray-50 px-2 py-1 text-xs text-gray-700">
            {JSON.stringify(value)}
        </code>
    );
}

export default function Show({ batch, rows }) {
    const columns = [
        { key: 'row_number', label: 'Row' },
        {
            key: 'status',
            label: 'Status',
            render: (row) => (
                <span className={`rounded-full px-2 py-0.5 text-xs font-medium ${statusClass(row.status)}`}>
                    {row.status_label}
                </span>
            ),
        },
        { key: 'error', label: 'Error', render: (row) => row.error ?? '—' },
        { key: 'payload', label: 'Payload', render: (row) => <Payload value={row.payload} /> },
    ];

    return (
        <AppLayout>
            <Head title={`Import ${batch.entity_label}`} />

            <div className="flex flex-col gap-4">
                <Breadcrumbs items={[{ label: 'Imports', href: '/imports' }, { label: batch.entity_label }]} />

                <div className="flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <h1 className="text-xl font-semibold text-gray-900">{batch.entity_label}</h1>
                        <p className="text-sm text-gray-500">{batch.original_filename ?? batch.id}</p>
                    </div>
                    <div className="flex gap-3">
                        {batch.failed_rows > 0 && (
                            <Button as={Link} href={`/imports/${batch.id}/errors`} variant="secondary">
                                Errors
                            </Button>
                        )}
                        <Button variant="secondary" onClick={() => router.reload({ only: ['batch', 'rows'] })}>
                            Refresh
                        </Button>
                    </div>
                </div>

                <div className="grid gap-3 sm:grid-cols-4">
                    {[
                        ['Status', batch.status_label],
                        ['Rows', batch.total_rows],
                        ['Imported', batch.success_rows],
                        ['Failed', batch.failed_rows],
                    ].map(([label, value]) => (
                        <div key={label} className="rounded-lg bg-white p-4 shadow-sm ring-1 ring-gray-200">
                            <div className="text-xs font-medium uppercase tracking-wide text-gray-500">{label}</div>
                            <div className="mt-1 text-lg font-semibold text-gray-900">{value}</div>
                        </div>
                    ))}
                </div>

                <Table columns={columns} rows={rows.data} emptyMessage="No rows tracked yet." />
                <Pagination links={rows.links} />
            </div>
        </AppLayout>
    );
}
