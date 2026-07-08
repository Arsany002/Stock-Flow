import { Head, Link } from '@inertiajs/react';
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
    }[status] ?? 'bg-gray-100 text-gray-700';
}

export default function Index({ batches }) {
    const columns = [
        {
            key: 'entity',
            label: 'Import',
            render: (row) => (
                <Link href={`/imports/${row.id}`} className="font-medium text-gray-900 underline">
                    {row.entity_label}
                </Link>
            ),
        },
        { key: 'original_filename', label: 'File', render: (row) => row.original_filename ?? '—' },
        {
            key: 'status',
            label: 'Status',
            render: (row) => (
                <span className={`rounded-full px-2 py-0.5 text-xs font-medium ${statusClass(row.status)}`}>
                    {row.status_label}
                </span>
            ),
        },
        {
            key: 'progress',
            label: 'Rows',
            render: (row) => `${row.success_rows}/${row.total_rows} imported, ${row.failed_rows} failed`,
        },
        { key: 'uploader', label: 'Uploaded by', render: (row) => row.uploader?.name ?? '—' },
        { key: 'created_at', label: 'Created', render: (row) => row.created_at ?? '—' },
    ];

    return (
        <AppLayout>
            <Head title="Imports" />

            <div className="flex flex-col gap-4">
                <Breadcrumbs items={[{ label: 'Imports' }]} />

                <div className="flex items-center justify-between">
                    <h1 className="text-xl font-semibold text-gray-900">Imports</h1>
                    <Button as={Link} href="/imports/create">
                        New import
                    </Button>
                </div>

                <Table columns={columns} rows={batches.data} emptyMessage="No imports found." />
                <Pagination links={batches.links} />
            </div>
        </AppLayout>
    );
}
