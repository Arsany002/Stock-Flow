import { Head, router } from '@inertiajs/react';
import { useState } from 'react';
import AppLayout from '@/Layouts/AppLayout';
import Table from '@/Components/Table';
import Pagination from '@/Components/Pagination';
import Select from '@/Components/Select';
import Input from '@/Components/Input';
import Button from '@/Components/Button';

export default function Sales({ orders, filters, statuses, users, products, warehouses }) {
    const [status, setStatus] = useState(filters.status ?? '');
    const [userId, setUserId] = useState(filters.user_id ?? '');
    const [productId, setProductId] = useState(filters.product_id ?? '');
    const [warehouseId, setWarehouseId] = useState(filters.warehouse_id ?? '');
    const [dateFrom, setDateFrom] = useState(filters.date_from ?? '');
    const [dateTo, setDateTo] = useState(filters.date_to ?? '');

    function applyFilters(e) {
        e.preventDefault();
        router.get(
            '/reports/sales',
            {
                status: status || undefined,
                user_id: userId || undefined,
                product_id: productId || undefined,
                warehouse_id: warehouseId || undefined,
                date_from: dateFrom || undefined,
                date_to: dateTo || undefined,
            },
            { preserveState: true, replace: true }
        );
    }

    const columns = [
        { key: 'id', label: 'Order', render: (row) => row.id.slice(0, 8) },
        { key: 'user', label: 'Customer', render: (row) => row.user?.name ?? '—' },
        { key: 'status_label', label: 'Status' },
        { key: 'subtotal', label: 'Subtotal' },
        { key: 'tax', label: 'VAT' },
        { key: 'total', label: 'Total' },
        { key: 'created_at', label: 'Placed', render: (row) => new Date(row.created_at).toLocaleString() },
    ];

    return (
        <AppLayout>
            <Head title="Sales report" />

            <div className="flex flex-col gap-4">
                <h1 className="text-xl font-semibold text-gray-900">Sales report</h1>

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
                    <div className="w-48">
                        <Select
                            label="Customer"
                            name="user_id"
                            placeholder="All customers"
                            value={userId}
                            onChange={(e) => setUserId(e.target.value)}
                            options={users.map((u) => ({ value: u.id, label: u.name }))}
                        />
                    </div>
                    <div className="w-56">
                        <Select
                            label="Product"
                            name="product_id"
                            placeholder="All products"
                            value={productId}
                            onChange={(e) => setProductId(e.target.value)}
                            options={products.map((p) => ({ value: p.id, label: `${p.name} (${p.sku})` }))}
                        />
                    </div>
                    <div className="w-48">
                        <Select
                            label="Warehouse"
                            name="warehouse_id"
                            placeholder="All warehouses"
                            value={warehouseId}
                            onChange={(e) => setWarehouseId(e.target.value)}
                            options={warehouses.map((w) => ({ value: w.id, label: w.name }))}
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

                <Table columns={columns} rows={orders.data} emptyMessage="No orders found." />

                <Pagination links={orders.links} />
            </div>
        </AppLayout>
    );
}
