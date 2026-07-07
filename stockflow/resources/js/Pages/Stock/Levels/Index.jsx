import { Head, Link, router } from '@inertiajs/react';
import { useState } from 'react';
import AppLayout from '@/Layouts/AppLayout';
import Breadcrumbs from '@/Components/Breadcrumbs';
import Table from '@/Components/Table';
import Pagination from '@/Components/Pagination';
import Select from '@/Components/Select';
import Button from '@/Components/Button';
import PermissionGate from '@/Components/PermissionGate';

export default function Index({ levels, filters, products, warehouses }) {
    const [productId, setProductId] = useState(filters.product_id ?? '');
    const [warehouseId, setWarehouseId] = useState(filters.warehouse_id ?? '');

    function applyFilters(event) {
        event.preventDefault();
        router.get(
            '/stock/levels',
            { product_id: productId || undefined, warehouse_id: warehouseId || undefined },
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
            render: (row) => (
                <span className={row.available <= 0 ? 'font-semibold text-red-600' : 'text-gray-700'}>{row.available}</span>
            ),
        },
    ];

    return (
        <AppLayout>
            <Head title="Stock levels" />

            <div className="flex flex-col gap-4">
                <Breadcrumbs items={[{ label: 'Stock' }, { label: 'Levels' }]} />

                <div className="flex items-center justify-between">
                    <h1 className="text-xl font-semibold text-gray-900">Stock levels</h1>
                    <div className="flex gap-2">
                        <PermissionGate permission="stock.move">
                            <Button as={Link} href="/stock/adjustments/create" variant="secondary">
                                Adjust stock
                            </Button>
                        </PermissionGate>
                        <PermissionGate permission="stock.transfer">
                            <Button as={Link} href="/stock/transfers/create" variant="secondary">
                                Transfer stock
                            </Button>
                        </PermissionGate>
                        <PermissionGate any={['stock.move', 'audit.read']}>
                            <Button as={Link} href="/stock/reconcile">
                                Reconcile
                            </Button>
                        </PermissionGate>
                    </div>
                </div>

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
                </form>

                <Table columns={columns} rows={levels.data} emptyMessage="No stock levels found." />

                <Pagination links={levels.links} />
            </div>
        </AppLayout>
    );
}
