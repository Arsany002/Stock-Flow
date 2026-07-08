import { Head, Link, router } from '@inertiajs/react';
import { useState } from 'react';
import AppLayout from '@/Layouts/AppLayout';
import Table from '@/Components/Table';
import Pagination from '@/Components/Pagination';
import Select from '@/Components/Select';
import Input from '@/Components/Input';
import Button from '@/Components/Button';

export default function Imports({ batches, filters, statuses, entities, users }) {
    const [status, setStatus] = useState(filters.status ?? '');
    const [entity, setEntity] = useState(filters.entity ?? '');
    const [uploaderId, setUploaderId] = useState(filters.uploader_id ?? '');
    const [dateFrom, setDateFrom] = useState(filters.date_from ?? '');
    const [dateTo, setDateTo] = useState(filters.date_to ?? '');

    function applyFilters(e) {
        e.preventDefault();
        router.get(
            '/reports/imports',
            {
                status: status || undefined,
                entity: entity || undefined,
                uploader_id: uploaderId || undefined,
                date_from: dateFrom || undefined,
                date_to: dateTo || undefined,
            },
            { preserveState: true, replace: true }
        );
    }

    const columns = [
        {
            key: 'id',
            label: 'Batch',
            render: (row) => (
                <Link href={`/imports/${row.id}`} className="font-medium text-gray-900 underline">
                    {row.id.slice(0, 8)}
                </Link>
            ),
        },
        { key: 'entity_label', label: 'Entity' },
        { key: 'status_label', label: 'Status' },
        { key: 'total_rows', label: 'Total rows' },
        { key: 'success_rows', label: 'Success' },
        { key: 'failed_rows', label: 'Failed' },
        { key: 'uploader', label: 'Uploaded by', render: (row) => row.uploader?.name ?? '—' },
        { key: 'created_at', label: 'Uploaded', render: (row) => new Date(row.created_at).toLocaleString() },
    ];

    return (
        <AppLayout>
            <Head title="Import history" />

            <div className="flex flex-col gap-4">
                <h1 className="text-xl font-semibold text-gray-900">Import history</h1>

                <form onSubmit={applyFilters} className="flex flex-wrap items-end gap-3 rounded-lg bg-white p-4 shadow-sm ring-1 ring-gray-200">
                    <div className="w-40">
                        <Select
                            label="Status"
                            name="status"
                            placeholder="All statuses"
                            value={status}
                            onChange={(e) => setStatus(e.target.value)}
                            options={statuses.map((s) => ({ value: s.value, label: s.label }))}
                        />
                    </div>
                    <div className="w-40">
                        <Select
                            label="Entity"
                            name="entity"
                            placeholder="All entities"
                            value={entity}
                            onChange={(e) => setEntity(e.target.value)}
                            options={entities.map((en) => ({ value: en.value, label: en.label }))}
                        />
                    </div>
                    <div className="w-48">
                        <Select
                            label="Uploaded by"
                            name="uploader_id"
                            placeholder="All users"
                            value={uploaderId}
                            onChange={(e) => setUploaderId(e.target.value)}
                            options={users.map((u) => ({ value: u.id, label: u.name }))}
                        />
                    </div>
                    <div className="w-40">
                        <Input label="From" name="date_from" type="date" value={dateFrom} onChange={(e) => setDateFrom(e.target.value)} />
                    </div>
                    <div className="w-40">
                        <Input label="To" name="date_to" type="date" value={dateTo} onChange={(e) => setDateTo(e.target.value)} />
                    </div>
                    <Button type="submit" variant="secondary">
                        Filter
                    </Button>
                </form>

                <Table columns={columns} rows={batches.data} emptyMessage="No import batches found." />

                <Pagination links={batches.links} />
            </div>
        </AppLayout>
    );
}
