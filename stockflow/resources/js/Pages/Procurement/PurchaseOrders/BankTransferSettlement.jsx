import { Head, Link, useForm } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';
import Breadcrumbs from '@/Components/Breadcrumbs';
import Input from '@/Components/Input';
import Button from '@/Components/Button';

export default function BankTransferSettlement({ purchaseOrder }) {
    const { data, setData, post, processing, errors } = useForm({ reference: '' });

    function submit(event) {
        event.preventDefault();
        post(`/procurement/purchase-orders/${purchaseOrder.id}/bank-transfer`);
    }

    return (
        <AppLayout>
            <Head title="Bank transfer settlement" />

            <div className="flex flex-col gap-4">
                <Breadcrumbs
                    items={[
                        { label: 'Procurement' },
                        { label: 'Purchase orders', href: '/procurement/purchase-orders' },
                        { label: purchaseOrder.id.slice(0, 8), href: `/procurement/purchase-orders/${purchaseOrder.id}` },
                        { label: 'Bank transfer' },
                    ]}
                />

                <h1 className="text-xl font-semibold text-gray-900">
                    Confirm bank transfer for {purchaseOrder.id.slice(0, 8)}
                </h1>
                <p className="text-sm text-gray-500">
                    Amount due: <span className="font-medium text-gray-900">{purchaseOrder.total}</span>
                </p>

                <p className="rounded-md bg-amber-50 px-3 py-2 text-sm text-amber-800 ring-1 ring-inset ring-amber-200">
                    Confirm only once the transfer has been verified as received. This converts the reserved stock
                    into a completed sale and marks the order fulfilled.
                </p>

                <form onSubmit={submit} className="flex flex-col gap-4 rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    <Input
                        label="Bank reference (optional)"
                        name="reference"
                        value={data.reference}
                        error={errors.reference}
                        onChange={(e) => setData('reference', e.target.value)}
                        placeholder="e.g. transfer confirmation number"
                    />

                    <div className="flex items-center gap-3">
                        <Button type="submit" disabled={processing}>
                            Confirm settlement
                        </Button>
                        <Link href={`/procurement/purchase-orders/${purchaseOrder.id}`} className="text-sm text-gray-500 underline">
                            Cancel
                        </Link>
                    </div>
                </form>
            </div>
        </AppLayout>
    );
}
