import { Head, router } from '@inertiajs/react';
import { useState } from 'react';
import AppLayout from '@/Layouts/AppLayout';
import Table from '@/Components/Table';
import Pagination from '@/Components/Pagination';
import Select from '@/Components/Select';
import Input from '@/Components/Input';
import Button from '@/Components/Button';

export default function Index({ logs, filters, events, users }) {
    const [event, setEvent] = useState(filters.event ?? '');
    const [causerId, setCauserId] = useState(filters.causer_id ?? '');
    const [dateFrom, setDateFrom] = useState(filters.date_from ?? '');
    const [dateTo, setDateTo] = useState(filters.date_to ?? '');

    function applyFilters(e) {
        e.preventDefault();
        router.get(
            '/admin/audit-log',
            {
                event: event || undefined,
                causer_id: causerId || undefined,
                date_from: dateFrom || undefined,
                date_to: dateTo || undefined,
            },
            { preserveState: true, replace: true }
        );
    }

    const columns = [
        { key: 'created_at', label: 'When', render: (row) => new Date(row.created_at).toLocaleString() },
        { key: 'event', label: 'Event' },
        { key: 'causer', label: 'By', render: (row) => row.causer?.name ?? 'System' },
        { key: 'subject_type', label: 'Subject', render: (row) => (row.subject_type ? row.subject_type.split('\\').pop() : '—') },
        {
            key: 'properties',
            label: 'Details',
            render: (row) => (
                <code className="text-xs text-gray-500">{JSON.stringify(row.properties)}</code>
            ),
        },
    ];

    return (
        <AppLayout>
            <Head title="Audit log" />

            <div className="flex flex-col gap-4">
                <h1 className="text-xl font-semibold text-gray-900">Audit log</h1>

                <form onSubmit={applyFilters} className="flex flex-wrap items-end gap-3 rounded-lg bg-white p-4 shadow-sm ring-1 ring-gray-200">
                    <div className="w-56">
                        <Select
                            label="Event"
                            name="event"
                            placeholder="All events"
                            value={event}
                            onChange={(e) => setEvent(e.target.value)}
                            options={events.map((e) => ({ value: e, label: e }))}
                        />
                    </div>
                    <div className="w-56">
                        <Select
                            label="User"
                            name="causer_id"
                            placeholder="All users"
                            value={causerId}
                            onChange={(e) => setCauserId(e.target.value)}
                            options={users.map((u) => ({ value: u.id, label: u.name }))}
                        />
                    </div>
                    <div className="w-44">
                        <Input label="From" name="date_from" type="date" value={dateFrom} onChange={(e) => setDateFrom(e.target.value)} />
                    </div>
                    <div className="w-44">
                        <Input label="To" name="date_to" type="date" value={dateTo} onChange={(e) => setDateTo(e.target.value)} />
                    </div>
                    <Button type="submit" variant="secondary">
                        Filter
                    </Button>
                </form>

                <Table columns={columns} rows={logs.data} emptyMessage="No audit entries found." />

                <Pagination links={logs.links} />
            </div>
        </AppLayout>
    );
}
