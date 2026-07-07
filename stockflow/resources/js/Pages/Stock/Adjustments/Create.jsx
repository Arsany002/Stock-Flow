import { Head, Link, useForm } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';
import Breadcrumbs from '@/Components/Breadcrumbs';
import Input from '@/Components/Input';
import Select from '@/Components/Select';
import Button from '@/Components/Button';

export default function Create({ products, warehouses }) {
    const { data, setData, post, processing, errors } = useForm({
        product_id: '',
        warehouse_id: '',
        quantity: '',
        reason: '',
    });

    function submit(event) {
        event.preventDefault();
        post('/stock/adjustments');
    }

    return (
        <AppLayout>
            <Head title="Adjust stock" />

            <div className="flex flex-col gap-4">
                <Breadcrumbs
                    items={[{ label: 'Stock' }, { label: 'Levels', href: '/stock/levels' }, { label: 'Adjust' }]}
                />

                <h1 className="text-xl font-semibold text-gray-900">Adjust stock</h1>

                <form onSubmit={submit} className="flex flex-col gap-4 rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    <Select
                        label="Product"
                        name="product_id"
                        placeholder="Select a product"
                        value={data.product_id}
                        error={errors.product_id}
                        onChange={(e) => setData('product_id', e.target.value)}
                        options={products.map((product) => ({ value: product.id, label: `${product.name} (${product.sku})` }))}
                        required
                    />

                    <Select
                        label="Warehouse"
                        name="warehouse_id"
                        placeholder="Select a warehouse"
                        value={data.warehouse_id}
                        error={errors.warehouse_id}
                        onChange={(e) => setData('warehouse_id', e.target.value)}
                        options={warehouses.map((warehouse) => ({ value: warehouse.id, label: warehouse.name }))}
                        required
                    />

                    <Input
                        label="Quantity (signed — negative to remove stock)"
                        name="quantity"
                        type="number"
                        value={data.quantity}
                        error={errors.quantity}
                        onChange={(e) => setData('quantity', e.target.value)}
                        placeholder="e.g. -5 or 20"
                        required
                    />

                    <Input
                        label="Reason"
                        name="reason"
                        value={data.reason}
                        error={errors.reason}
                        onChange={(e) => setData('reason', e.target.value)}
                        placeholder="e.g. Cycle count correction"
                        required
                    />

                    <div className="flex items-center gap-3">
                        <Button type="submit" disabled={processing}>
                            Apply adjustment
                        </Button>
                        <Link href="/stock/levels" className="text-sm text-gray-500 underline">
                            Cancel
                        </Link>
                    </div>
                </form>
            </div>
        </AppLayout>
    );
}
