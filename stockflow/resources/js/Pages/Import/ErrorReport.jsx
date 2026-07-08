import { Head, Link } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';
import Breadcrumbs from '@/Components/Breadcrumbs';
import Button from '@/Components/Button';
import Table from '@/Components/Table';

function Payload({ value }) {
    return (
        <code className="block max-w-lg truncate rounded bg-gray-50 px-2 py-1 text-xs text-gray-700">
            {JSON.stringify(value)}
        </code>
    );
}

export default function ErrorReport({ batch, rows }) {
    const columns = [
        { key: 'row_number', label: 'Row' },
        { key: 'error', label: 'Error' },
        { key: 'payload', label: 'Payload', render: (row) => <Payload value={row.payload} /> },
    ];

    return (
        <AppLayout>
            <Head title="Import errors" />

            <div className="flex flex-col gap-4">
                <Breadcrumbs
                    items={[
                        { label: 'Imports', href: '/imports' },
                        { label: batch.entity_label, href: `/imports/${batch.id}` },
                        { label: 'Errors' },
                    ]}
                />

                <div className="flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <h1 className="text-xl font-semibold text-gray-900">Import errors</h1>
                        <p className="text-sm text-gray-500">{batch.original_filename ?? batch.id}</p>
                    </div>
                    <div className="flex gap-3">
                        <Button as={Link} href={`/imports/${batch.id}`} variant="secondary">
                            Back
                        </Button>
                        <Button as="a" href={`/imports/${batch.id}/errors/download`}>
                            Download CSV
                        </Button>
                    </div>
                </div>

                <Table columns={columns} rows={rows} emptyMessage="No failed rows." />
            </div>
        </AppLayout>
    );
}
