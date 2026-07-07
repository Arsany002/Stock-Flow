import { Head, Link, useForm } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';
import Breadcrumbs from '@/Components/Breadcrumbs';
import Button from '@/Components/Button';

export default function Approve({ purchaseOrder, projectedBalance, withinCreditLimit }) {
    const { data, setData, post, processing, errors } = useForm({ note: '' });

    function approve(event) {
        event.preventDefault();
        post(`/procurement/purchase-orders/${purchaseOrder.id}/approve`);
    }

    function reject(event) {
        event.preventDefault();
        post(`/procurement/purchase-orders/${purchaseOrder.id}/reject`);
    }

    const account = purchaseOrder.business_account;

    return (
        <AppLayout>
            <Head title="Approve purchase order" />

            <div className="flex flex-col gap-4">
                <Breadcrumbs
                    items={[
                        { label: 'Procurement' },
                        { label: 'Purchase orders', href: '/procurement/purchase-orders' },
                        { label: purchaseOrder.id.slice(0, 8), href: `/procurement/purchase-orders/${purchaseOrder.id}` },
                        { label: 'Approve' },
                    ]}
                />

                <h1 className="text-xl font-semibold text-gray-900">Approve purchase order {purchaseOrder.id.slice(0, 8)}</h1>

                <div className="grid grid-cols-2 gap-4 rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-200 sm:grid-cols-4">
                    <div>
                        <dt className="text-xs font-medium uppercase tracking-wide text-gray-500">PO total</dt>
                        <dd className="mt-1 text-sm text-gray-900">{purchaseOrder.total}</dd>
                    </div>
                    <div>
                        <dt className="text-xs font-medium uppercase tracking-wide text-gray-500">Credit limit</dt>
                        <dd className="mt-1 text-sm text-gray-900">{account.credit_limit}</dd>
                    </div>
                    <div>
                        <dt className="text-xs font-medium uppercase tracking-wide text-gray-500">Outstanding balance</dt>
                        <dd className="mt-1 text-sm text-gray-900">{account.outstanding_balance}</dd>
                    </div>
                    <div>
                        <dt className="text-xs font-medium uppercase tracking-wide text-gray-500">Projected balance</dt>
                        <dd className="mt-1 text-sm text-gray-900">{projectedBalance}</dd>
                    </div>
                </div>

                {withinCreditLimit ? (
                    <p className="rounded-md bg-green-50 px-3 py-2 text-sm text-green-800 ring-1 ring-inset ring-green-200">
                        Within credit limit — approving will reserve stock for every line.
                    </p>
                ) : (
                    <p className="rounded-md bg-red-50 px-3 py-2 text-sm text-red-800 ring-1 ring-inset ring-red-200">
                        This would exceed the account's credit limit. Approval will be rejected by the server.
                    </p>
                )}

                <form className="flex flex-col gap-4 rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    <div className="flex flex-col gap-1">
                        <label htmlFor="note" className="text-sm font-medium text-gray-700">
                            Note (optional)
                        </label>
                        <textarea
                            id="note"
                            rows={3}
                            value={data.note}
                            onChange={(e) => setData('note', e.target.value)}
                            className="block w-full rounded-md border-0 px-3 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 sm:text-sm"
                        />
                        {errors.note && <p className="text-sm text-red-600">{errors.note}</p>}
                    </div>

                    <div className="flex items-center gap-3">
                        <Button type="submit" onClick={approve} disabled={processing}>
                            Approve
                        </Button>
                        <Button type="submit" variant="danger" onClick={reject} disabled={processing}>
                            Reject
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
