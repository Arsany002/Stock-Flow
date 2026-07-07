import { Head, Link, useForm } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';
import Breadcrumbs from '@/Components/Breadcrumbs';
import Input from '@/Components/Input';
import Select from '@/Components/Select';
import Button from '@/Components/Button';

export default function Create({ products, warehouses }) {
    const { data, setData, post, processing, errors } = useForm({
        product_id: '',
        from_warehouse_id: '',
        to_warehouse_id: '',
        quantity: '',
    });

    function submit(event) {
        event.preventDefault();
        post('/stock/transfers');
    }

    const warehouseOptions = warehouses.map((warehouse) => ({ value: warehouse.id, label: warehouse.name }));

    return (
        <AppLayout>
            <Head title="Transfer stock" />

            <div className="flex flex-col gap-4">
                <Breadcrumbs
                    items={[{ label: 'Stock' }, { label: 'Levels', href: '/stock/levels' }, { label: 'Transfer' }]}
                />

                <h1 className="text-xl font-semibold text-gray-900">Transfer stock</h1>

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
                        label="From warehouse"
                        name="from_warehouse_id"
                        placeholder="Select source warehouse"
                        value={data.from_warehouse_id}
                        error={errors.from_warehouse_id}
                        onChange={(e) => setData('from_warehouse_id', e.target.value)}
                        options={warehouseOptions}
                        required
                    />

                    <Select
                        label="To warehouse"
                        name="to_warehouse_id"
                        placeholder="Select destination warehouse"
                        value={data.to_warehouse_id}
                        error={errors.to_warehouse_id}
                        onChange={(e) => setData('to_warehouse_id', e.target.value)}
                        options={warehouseOptions}
                        required
                    />

                    <Input
                        label="Quantity"
                        name="quantity"
                        type="number"
                        min="1"
                        value={data.quantity}
                        error={errors.quantity}
                        onChange={(e) => setData('quantity', e.target.value)}
                        required
                    />

                    <div className="flex items-center gap-3">
                        <Button type="submit" disabled={processing}>
                            Transfer stock
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
