import { Head, Link, useForm } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';
import Breadcrumbs from '@/Components/Breadcrumbs';
import Table from '@/Components/Table';
import Select from '@/Components/Select';
import Button from '@/Components/Button';

export default function Create({ lines, subtotal, tax, total, paymentMethods }) {
    const { data, setData, post, processing, errors } = useForm({
        payment_method: paymentMethods[0]?.value ?? '',
        outcome: 'succeed',
    });

    function submit(event) {
        event.preventDefault();
        post('/checkout');
    }

    const selectedMethod = paymentMethods.find((m) => m.value === data.payment_method);

    const columns = [
        { key: 'product', label: 'Product', render: (row) => `${row.product.name} (${row.product.sku})` },
        { key: 'quantity', label: 'Quantity' },
        { key: 'unit_price', label: 'Unit price' },
        { key: 'line_total', label: 'Line total' },
    ];

    return (
        <AppLayout>
            <Head title="Checkout" />

            <div className="flex flex-col gap-4">
                <Breadcrumbs items={[{ label: 'Cart', href: '/cart' }, { label: 'Checkout' }]} />

                <h1 className="text-xl font-semibold text-gray-900">Checkout</h1>

                <Table columns={columns} rows={lines} emptyMessage="Your cart is empty." />

                <div className="flex flex-col items-end gap-1 rounded-lg bg-white p-4 shadow-sm ring-1 ring-gray-200">
                    <div className="flex w-64 justify-between text-sm text-gray-600">
                        <span>Subtotal</span>
                        <span>{subtotal}</span>
                    </div>
                    <div className="flex w-64 justify-between text-sm text-gray-600">
                        <span>VAT (14%)</span>
                        <span>{tax}</span>
                    </div>
                    <div className="flex w-64 justify-between text-base font-semibold text-gray-900">
                        <span>Total</span>
                        <span>{total}</span>
                    </div>
                </div>

                <form onSubmit={submit} className="flex flex-col gap-4 rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    <Select
                        label="Payment method"
                        name="payment_method"
                        value={data.payment_method}
                        error={errors.payment_method}
                        onChange={(e) => setData('payment_method', e.target.value)}
                        options={paymentMethods.map((m) => ({ value: m.value, label: m.label }))}
                        required
                    />

                    {selectedMethod?.is_placeholder && (
                        <p className="rounded-md bg-amber-50 px-3 py-2 text-sm text-amber-800 ring-1 ring-inset ring-amber-200">
                            {selectedMethod.label} isn't integrated yet — your order will be reserved and the payment left
                            pending for manual settlement.
                        </p>
                    )}

                    {data.payment_method === 'fake' && (
                        <Select
                            label="Simulate outcome (demo gateway only)"
                            name="outcome"
                            value={data.outcome}
                            onChange={(e) => setData('outcome', e.target.value)}
                            options={[
                                { value: 'succeed', label: 'Succeed' },
                                { value: 'fail', label: 'Fail' },
                            ]}
                        />
                    )}

                    <div className="flex items-center gap-3">
                        <Button type="submit" disabled={processing || lines.length === 0}>
                            Place order
                        </Button>
                        <Link href="/cart" className="text-sm text-gray-500 underline">
                            Back to cart
                        </Link>
                    </div>
                </form>
            </div>
        </AppLayout>
    );
}
