import { Head, Link, useForm } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';
import Breadcrumbs from '@/Components/Breadcrumbs';
import Input from '@/Components/Input';
import Button from '@/Components/Button';

export default function BankTransferReview({ purchaseOrder }) {
    const { data, setData, post, processing, errors } = useForm({ reference: '' });

    function submit(event) {
        event.preventDefault();
        post(`/procurement/purchase-orders/${purchaseOrder.id}/bank-transfer`);
    }

    return (
        <AppLayout>
            <Head title="Bank transfer review" />

            <div className="flex flex-col gap-4">
                <Breadcrumbs
                    items={[
                        { label: 'Procurement' },
                        { label: 'Purchase orders', href: '/procurement/purchase-orders' },
                        { label: purchaseOrder.id.slice(0, 8), href: `/procurement/purchase-orders/${purchaseOrder.id}` },
                        { label: 'Bank transfer' },
                    ]}
                />

                <h1 className="text-xl font-semibold text-gray-900">Bank transfer review</h1>

                <div className="rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    <div className="text-sm text-gray-500">Purchase order</div>
                    <div className="mt-1 font-medium text-gray-900">{purchaseOrder.id}</div>
                    <div className="mt-4 text-sm text-gray-500">Amount due</div>
                    <div className="mt-1 text-lg font-semibold text-gray-900">{purchaseOrder.total}</div>
                </div>

                <form onSubmit={submit} className="flex flex-col gap-4 rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    <Input
                        label="Bank reference"
                        name="reference"
                        value={data.reference}
                        error={errors.reference}
                        onChange={(e) => setData('reference', e.target.value)}
                        placeholder="Transfer confirmation number"
                    />

                    <div className="flex items-center gap-3">
                        <Button type="submit" disabled={processing}>
                            Confirm received
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
