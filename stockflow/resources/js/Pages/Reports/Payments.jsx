import { Head, router } from '@inertiajs/react';
import { useState } from 'react';
import AppLayout from '@/Layouts/AppLayout';
import Table from '@/Components/Table';
import Pagination from '@/Components/Pagination';
import Select from '@/Components/Select';
import Input from '@/Components/Input';
import Button from '@/Components/Button';

export default function Payments({ payments, filters, statuses, methods, users }) {
    const [status, setStatus] = useState(filters.status ?? '');
    const [method, setMethod] = useState(filters.method ?? '');
    const [userId, setUserId] = useState(filters.user_id ?? '');
    const [dateFrom, setDateFrom] = useState(filters.date_from ?? '');
    const [dateTo, setDateTo] = useState(filters.date_to ?? '');

    function applyFilters(e) {
        e.preventDefault();
        router.get(
            '/reports/payments',
            {
                status: status || undefined,
                method: method || undefined,
                user_id: userId || undefined,
                date_from: dateFrom || undefined,
                date_to: dateTo || undefined,
            },
            { preserveState: true, replace: true }
        );
    }

    const columns = [
        { key: 'id', label: 'Payment', render: (row) => row.id.slice(0, 8) },
        { key: 'payable_type', label: 'For' },
        { key: 'method_label', label: 'Method' },
        { key: 'status_label', label: 'Status' },
        { key: 'amount', label: 'Amount' },
        { key: 'created_at', label: 'Initiated', render: (row) => new Date(row.created_at).toLocaleString() },
    ];

    return (
        <AppLayout>
            <Head title="Payments report" />

            <div className="flex flex-col gap-4">
                <h1 className="text-xl font-semibold text-gray-900">Payments report</h1>

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
                            label="Method"
                            name="method"
                            placeholder="All methods"
                            value={method}
                            onChange={(e) => setMethod(e.target.value)}
                            options={methods.map((m) => ({ value: m.value, label: m.label }))}
                        />
                    </div>
                    <div className="w-48">
                        <Select
                            label="User"
                            name="user_id"
                            placeholder="All users"
                            value={userId}
                            onChange={(e) => setUserId(e.target.value)}
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

                <Table columns={columns} rows={payments.data} emptyMessage="No payments found." />

                <Pagination links={payments.links} />
            </div>
        </AppLayout>
    );
}
