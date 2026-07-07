import { Head, Link, router } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';
import Breadcrumbs from '@/Components/Breadcrumbs';
import Button from '@/Components/Button';

export default function Show({ payment, canSettle }) {
    function settle() {
        router.post(`/payments/${payment.id}/settle`, {}, { preserveScroll: true });
    }

    return (
        <AppLayout>
            <Head title={`Payment ${payment.id.slice(0, 8)}`} />

            <div className="flex flex-col gap-4">
                <Breadcrumbs
                    items={[
                        { label: 'Orders', href: '/orders' },
                        ...(payment.order ? [{ label: payment.order.id.slice(0, 8), href: `/orders/${payment.order.id}` }] : []),
                        { label: 'Payment' },
                    ]}
                />

                <h1 className="text-xl font-semibold text-gray-900">Payment {payment.id.slice(0, 8)}</h1>

                <div className="grid grid-cols-1 gap-4 rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-200 sm:grid-cols-2">
                    <div>
                        <dt className="text-xs font-medium uppercase tracking-wide text-gray-500">Method</dt>
                        <dd className="mt-1 text-sm text-gray-900">{payment.method_label}</dd>
                    </div>
                    <div>
                        <dt className="text-xs font-medium uppercase tracking-wide text-gray-500">Status</dt>
                        <dd className="mt-1 text-sm text-gray-900">{payment.status_label}</dd>
                    </div>
                    <div>
                        <dt className="text-xs font-medium uppercase tracking-wide text-gray-500">Amount</dt>
                        <dd className="mt-1 text-sm text-gray-900">{payment.amount}</dd>
                    </div>
                    <div>
                        <dt className="text-xs font-medium uppercase tracking-wide text-gray-500">Initiated</dt>
                        <dd className="mt-1 text-sm text-gray-900">{new Date(payment.created_at).toLocaleString()}</dd>
                    </div>
                    {payment.meta?.note && (
                        <div className="sm:col-span-2">
                            <dt className="text-xs font-medium uppercase tracking-wide text-gray-500">Note</dt>
                            <dd className="mt-1 text-sm text-gray-900">{payment.meta.note}</dd>
                        </div>
                    )}
                </div>

                {payment.is_placeholder && payment.status === 'pending' && (
                    <p className="rounded-md bg-amber-50 px-3 py-2 text-sm text-amber-800 ring-1 ring-inset ring-amber-200">
                        This gateway isn't integrated yet — settle it manually once payment is confirmed out-of-band.
                    </p>
                )}

                {canSettle && payment.status === 'pending' && (
                    <div>
                        <Button onClick={settle}>Settle payment</Button>
                    </div>
                )}

                {payment.order && (
                    <Link href={`/orders/${payment.order.id}`} className="text-sm text-gray-500 underline">
                        View order
                    </Link>
                )}
            </div>
        </AppLayout>
    );
}
