import { Head, router } from '@inertiajs/react';
import { useState } from 'react';
import AppLayout from '@/Layouts/AppLayout';
import Table from '@/Components/Table';
import Pagination from '@/Components/Pagination';
import Select from '@/Components/Select';
import Input from '@/Components/Input';
import Button from '@/Components/Button';

export default function StockMovements({ movements, filters, products, warehouses, types, users }) {
    const [productId, setProductId] = useState(filters.product_id ?? '');
    const [warehouseId, setWarehouseId] = useState(filters.warehouse_id ?? '');
    const [type, setType] = useState(filters.type ?? '');
    const [actorId, setActorId] = useState(filters.actor_id ?? '');
    const [dateFrom, setDateFrom] = useState(filters.date_from ?? '');
    const [dateTo, setDateTo] = useState(filters.date_to ?? '');

    function applyFilters(e) {
        e.preventDefault();
        router.get(
            '/reports/stock-movements',
            {
                product_id: productId || undefined,
                warehouse_id: warehouseId || undefined,
                type: type || undefined,
                actor_id: actorId || undefined,
                date_from: dateFrom || undefined,
                date_to: dateTo || undefined,
            },
            { preserveState: true, replace: true }
        );
    }

    const columns = [
        { key: 'created_at', label: 'When', render: (row) => new Date(row.created_at).toLocaleString() },
        { key: 'product', label: 'Product', render: (row) => `${row.product?.name ?? '—'} (${row.product?.sku ?? '—'})` },
        { key: 'warehouse', label: 'Warehouse', render: (row) => row.warehouse?.name ?? '—' },
        { key: 'type_label', label: 'Type' },
        {
            key: 'quantity',
            label: 'Quantity',
            render: (row) => (
                <span className={row.quantity < 0 ? 'text-red-600' : 'text-green-700'}>
                    {row.quantity > 0 ? `+${row.quantity}` : row.quantity}
                </span>
            ),
        },
        { key: 'actor', label: 'User', render: (row) => row.actor?.name ?? 'System' },
    ];

    return (
        <AppLayout>
            <Head title="Stock movement report" />

            <div className="flex flex-col gap-4">
                <h1 className="text-xl font-semibold text-gray-900">Stock movement report</h1>

                <form onSubmit={applyFilters} className="flex flex-wrap items-end gap-3 rounded-lg bg-white p-4 shadow-sm ring-1 ring-gray-200">
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
                        <Select
                            label="Type"
                            name="type"
                            placeholder="All types"
                            value={type}
                            onChange={(e) => setType(e.target.value)}
                            options={types.map((t) => ({ value: t.value, label: t.label }))}
                        />
                    </div>
                    <div className="w-48">
                        <Select
                            label="User"
                            name="actor_id"
                            placeholder="All users"
                            value={actorId}
                            onChange={(e) => setActorId(e.target.value)}
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

                <Table columns={columns} rows={movements.data} emptyMessage="No stock movements found." />

                <Pagination links={movements.links} />
            </div>
        </AppLayout>
    );
}
