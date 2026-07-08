import { Head, router } from '@inertiajs/react';
import { useState } from 'react';
import AppLayout from '@/Layouts/AppLayout';
import Table from '@/Components/Table';
import Pagination from '@/Components/Pagination';
import Select from '@/Components/Select';
import Input from '@/Components/Input';
import Button from '@/Components/Button';

export default function LowStock({ levels, filters, products, warehouses }) {
    const [productId, setProductId] = useState(filters.product_id ?? '');
    const [warehouseId, setWarehouseId] = useState(filters.warehouse_id ?? '');
    const [threshold, setThreshold] = useState(filters.threshold ?? 10);

    function applyFilters(e) {
        e.preventDefault();
        router.get(
            '/reports/low-stock',
            {
                product_id: productId || undefined,
                warehouse_id: warehouseId || undefined,
                threshold: threshold || undefined,
            },
            { preserveState: true, replace: true }
        );
    }

    const columns = [
        { key: 'product', label: 'Product', render: (row) => `${row.product?.name ?? '—'} (${row.product?.sku ?? '—'})` },
        { key: 'warehouse', label: 'Warehouse', render: (row) => row.warehouse?.name ?? '—' },
        { key: 'on_hand', label: 'On hand' },
        { key: 'reserved', label: 'Reserved' },
        {
            key: 'available',
            label: 'Available',
            render: (row) => <span className="font-semibold text-red-600">{row.available}</span>,
        },
    ];

    return (
        <AppLayout>
            <Head title="Low stock report" />

            <div className="flex flex-col gap-4">
                <h1 className="text-xl font-semibold text-gray-900">Low stock report</h1>
                <p className="text-sm text-gray-500">
                    Products whose available (on hand − reserved) stock is at or below the threshold.
                </p>

                <form onSubmit={applyFilters} className="flex flex-wrap items-end gap-3 rounded-lg bg-white p-4 shadow-sm ring-1 ring-gray-200">
                    <div className="w-64">
                        <Select
                            label="Product"
                            name="product_id"
                            placeholder="All products"
                            value={productId}
                            onChange={(e) => setProductId(e.target.value)}
                            options={products.map((p) => ({ value: p.id, label: `${p.name} (${p.sku})` }))}
                        />
                    </div>
                    <div className="w-56">
                        <Select
                            label="Warehouse"
                            name="warehouse_id"
                            placeholder="All warehouses"
                            value={warehouseId}
                            onChange={(e) => setWarehouseId(e.target.value)}
                            options={warehouses.map((w) => ({ value: w.id, label: w.name }))}
                        />
                    </div>
                    <div className="w-32">
                        <Input
                            label="Threshold"
                            name="threshold"
                            type="number"
                            min="0"
                            value={threshold}
                            onChange={(e) => setThreshold(e.target.value)}
                        />
                    </div>
                    <Button type="submit" variant="secondary">
                        Filter
                    </Button>
                </form>

                <Table columns={columns} rows={levels.data} emptyMessage="No low-stock items found." />

                <Pagination links={levels.links} />
            </div>
        </AppLayout>
    );
}
