import { Head, router, useForm } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';
import Breadcrumbs from '@/Components/Breadcrumbs';
import Input from '@/Components/Input';
import Select from '@/Components/Select';
import Button from '@/Components/Button';
import Pagination from '@/Components/Pagination';
import PermissionGate from '@/Components/PermissionGate';

function AddItemForm({ priceListId }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        product_id: '',
        unit_price: '',
        min_qty: 1,
    });

    function submit(event) {
        event.preventDefault();
        post(`/catalog/price-lists/${priceListId}/items`, { onSuccess: () => reset() });
    }

    return (
        <form onSubmit={submit} className="flex flex-wrap items-end gap-2 border-t border-gray-100 pt-3">
            <div className="w-56">
                <Input
                    label="Product ID"
                    name="product_id"
                    placeholder="Paste product ID"
                    value={data.product_id}
                    error={errors.product_id}
                    onChange={(e) => setData('product_id', e.target.value)}
                    required
                />
            </div>
            <div className="w-32">
                <Input
                    label="Unit price"
                    name="unit_price"
                    type="number"
                    step="0.01"
                    min="0"
                    value={data.unit_price}
                    error={errors.unit_price}
                    onChange={(e) => setData('unit_price', e.target.value)}
                    required
                />
            </div>
            <div className="w-24">
                <Input
                    label="Min qty"
                    name="min_qty"
                    type="number"
                    min="1"
                    value={data.min_qty}
                    error={errors.min_qty}
                    onChange={(e) => setData('min_qty', e.target.value)}
                    required
                />
            </div>
            <Button type="submit" variant="secondary" disabled={processing}>
                Add item
            </Button>
        </form>
    );
}

function ItemRow({ item }) {
    const { data, setData, put, processing } = useForm({
        unit_price: item.unit_price,
        min_qty: item.min_qty,
    });

    function save(event) {
        event.preventDefault();
        put(`/catalog/price-list-items/${item.id}`);
    }

    function destroy() {
        if (confirm(`Remove ${item.product.name} from this price list?`)) {
            router.delete(`/catalog/price-list-items/${item.id}`);
        }
    }

    return (
        <form onSubmit={save} className="flex flex-wrap items-center gap-3 py-2 text-sm">
            <span className="w-56 truncate text-gray-700">
                {item.product.name} <span className="text-gray-400">({item.product.sku})</span>
            </span>
            <input
                type="number"
                step="0.01"
                min="0"
                value={data.unit_price}
                onChange={(e) => setData('unit_price', e.target.value)}
                className="w-28 rounded-md border-0 px-2 py-1 ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-900"
            />
            <input
                type="number"
                min="1"
                value={data.min_qty}
                onChange={(e) => setData('min_qty', e.target.value)}
                className="w-20 rounded-md border-0 px-2 py-1 ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-900"
            />
            <PermissionGate permission="pricelist.manage">
                <button type="submit" disabled={processing} className="text-gray-900 underline">
                    Save
                </button>
                <button type="button" onClick={destroy} className="text-red-600 underline">
                    Remove
                </button>
            </PermissionGate>
        </form>
    );
}

export default function Index({ priceLists, canManagePriceLists }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        name: '',
        type: 'b2c_retail',
        is_active: true,
    });

    function submit(event) {
        event.preventDefault();
        post('/catalog/price-lists', { onSuccess: () => reset() });
    }

    return (
        <AppLayout>
            <Head title="Price lists" />

            <div className="flex flex-col gap-4">
                <Breadcrumbs items={[{ label: 'Catalog' }, { label: 'Price lists' }]} />

                <h1 className="text-xl font-semibold text-gray-900">Price lists</h1>

                <div className="flex flex-col gap-4">
                    {priceLists.data.map((priceList) => (
                        <div key={priceList.id} className="rounded-lg bg-white p-4 shadow-sm ring-1 ring-gray-200">
                            <div className="flex items-center justify-between">
                                <h2 className="font-semibold text-gray-900">{priceList.name}</h2>
                                <span className="rounded-full bg-gray-100 px-2 py-0.5 text-xs font-medium text-gray-600">
                                    {priceList.type}
                                </span>
                            </div>

                            <div className="mt-2 divide-y divide-gray-50">
                                {priceList.items.length === 0 ? (
                                    <p className="py-2 text-sm text-gray-500">No items yet.</p>
                                ) : (
                                    priceList.items.map((item) => <ItemRow key={item.id} item={item} />)
                                )}
                            </div>

                            <PermissionGate permission="pricelist.manage">
                                <AddItemForm priceListId={priceList.id} />
                            </PermissionGate>
                        </div>
                    ))}
                </div>

                <Pagination links={priceLists.links} />

                {canManagePriceLists && (
                    <form onSubmit={submit} className="flex flex-wrap items-end gap-3 rounded-lg bg-white p-4 shadow-sm ring-1 ring-gray-200">
                        <div className="w-56">
                            <Input
                                label="Name"
                                name="name"
                                value={data.name}
                                error={errors.name}
                                onChange={(e) => setData('name', e.target.value)}
                                required
                            />
                        </div>
                        <div className="w-56">
                            <Select
                                label="Type"
                                name="type"
                                value={data.type}
                                error={errors.type}
                                onChange={(e) => setData('type', e.target.value)}
                                options={[
                                    { value: 'b2c_retail', label: 'B2C retail' },
                                    { value: 'b2b_tier', label: 'B2B tier' },
                                ]}
                            />
                        </div>
                        <Button type="submit" disabled={processing}>
                            New price list
                        </Button>
                    </form>
                )}
            </div>
        </AppLayout>
    );
}
