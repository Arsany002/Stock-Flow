import { Head, router } from '@inertiajs/react';
import { useState } from 'react';
import AppLayout from '@/Layouts/AppLayout';
import Breadcrumbs from '@/Components/Breadcrumbs';
import Table from '@/Components/Table';
import Select from '@/Components/Select';
import Button from '@/Components/Button';

export default function Show({ results, filters, products, warehouses }) {
    const [productId, setProductId] = useState(filters.product_id ?? '');
    const [warehouseId, setWarehouseId] = useState(filters.warehouse_id ?? '');
    const [processing, setProcessing] = useState(false);

    function applyFilters(event) {
        event.preventDefault();
        router.get(
            '/stock/reconcile',
            { product_id: productId || undefined, warehouse_id: warehouseId || undefined },
            { preserveState: true, replace: true }
        );
    }

    function runReconciliation() {
        router.post(
            '/stock/reconcile',
            { product_id: productId || undefined, warehouse_id: warehouseId || undefined },
            {
                preserveScroll: true,
                onStart: () => setProcessing(true),
                onFinish: () => setProcessing(false),
            }
        );
    }

    const mismatchCount = results.filter((row) => !row.on_hand_matches || !row.reserved_matches).length;

    const columns = [
        { key: 'product_id', label: 'Product ID' },
        { key: 'warehouse_id', label: 'Warehouse ID' },
        { key: 'on_hand', label: 'stock_levels.on_hand' },
        { key: 'ledger_on_hand', label: 'Ledger on_hand' },
        {
            key: 'on_hand_matches',
            label: 'On hand OK?',
            render: (row) => (row.on_hand_matches ? '✓' : '✗ mismatch'),
        },
        { key: 'reserved', label: 'stock_levels.reserved' },
        { key: 'ledger_reserved', label: 'Ledger reserved' },
        {
            key: 'reserved_matches',
            label: 'Reserved OK?',
            render: (row) => (row.reserved_matches ? '✓' : '✗ mismatch'),
        },
    ];

    return (
        <AppLayout>
            <Head title="Stock reconciliation" />

            <div className="flex flex-col gap-4">
                <Breadcrumbs items={[{ label: 'Stock' }, { label: 'Reconciliation' }]} />

                <h1 className="text-xl font-semibold text-gray-900">Stock reconciliation</h1>

                <p className="text-sm text-gray-600">
                    Proves that <code>stock_levels</code> matches what the immutable <code>stock_movements</code> ledger says it
                    should be, per (product, warehouse) pair.{' '}
                    {mismatchCount === 0 ? (
                        <span className="font-medium text-green-700">All {results.length} row(s) match.</span>
                    ) : (
                        <span className="font-medium text-red-600">
                            {mismatchCount} of {results.length} row(s) mismatch.
                        </span>
                    )}
                </p>

                <form onSubmit={applyFilters} className="flex flex-wrap items-end gap-3 rounded-lg bg-white p-4 shadow-sm ring-1 ring-gray-200">
                    <div className="w-64">
                        <Select
                            label="Product"
                            name="product_id"
                            placeholder="All products"
                            value={productId}
                            onChange={(e) => setProductId(e.target.value)}
                            options={products.map((product) => ({ value: product.id, label: `${product.name} (${product.sku})` }))}
                        />
                    </div>
                    <div className="w-56">
                        <Select
                            label="Warehouse"
                            name="warehouse_id"
                            placeholder="All warehouses"
                            value={warehouseId}
                            onChange={(e) => setWarehouseId(e.target.value)}
                            options={warehouses.map((warehouse) => ({ value: warehouse.id, label: warehouse.name }))}
                        />
                    </div>
                    <Button type="submit" variant="secondary">
                        Filter
                    </Button>
                    <Button type="button" onClick={runReconciliation} disabled={processing}>
                        Run reconciliation
                    </Button>
                </form>

                <Table columns={columns} rows={results} emptyMessage="No (product, warehouse) pairs to reconcile." />
            </div>
        </AppLayout>
    );
}
