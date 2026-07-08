import { Head, Link, router } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';
import Breadcrumbs from '@/Components/Breadcrumbs';
import Button from '@/Components/Button';

export default function Show({ payment, canSettle, canUseFakeGateway }) {
    function settle() {
        router.post(`/payments/${payment.id}/settle`, {}, { preserveScroll: true });
    }

    const payableCrumb = payment.payable
        ? [{ label: payment.payable.type === 'order' ? 'Order' : 'Purchase order', href: payment.payable.href }]
        : [];

    return (
        <AppLayout>
            <Head title={`Payment ${payment.id.slice(0, 8)}`} />

            <div className="flex flex-col gap-4">
                <Breadcrumbs items={[{ label: 'Payments', href: '/payments' }, ...payableCrumb, { label: payment.id.slice(0, 8) }]} />

                <div className="flex flex-wrap items-center justify-between gap-3">
                    <h1 className="text-xl font-semibold text-gray-900">Payment {payment.id.slice(0, 8)}</h1>
                    <div className="flex gap-2">
                        {canUseFakeGateway && (
                            <Button as={Link} href={`/payments/${payment.id}/fake-gateway`} variant="secondary">
                                Fake gateway
                            </Button>
                        )}
                        {canSettle && payment.status === 'pending' && (
                            <Button onClick={settle}>Settle payment</Button>
                        )}
                    </div>
                </div>

                <dl className="grid grid-cols-1 gap-4 rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-200 sm:grid-cols-2">
                    <Field label="Method" value={payment.method_label} />
                    <Field label="Status" value={payment.status_label} />
                    <Field label="Amount" value={payment.amount} />
                    <Field label="Gateway ref" value={payment.gateway_ref ?? 'None'} />
                    <Field label="Created" value={new Date(payment.created_at).toLocaleString()} />
                    {payment.payable && (
                        <div>
                            <dt className="text-xs font-medium uppercase tracking-wide text-gray-500">Payable</dt>
                            <dd className="mt-1 text-sm text-gray-900">
                                <Link href={payment.payable.href} className="underline">
                                    {payment.payable.type === 'order' ? 'Order' : 'Purchase order'} {payment.payable.id.slice(0, 8)}
                                </Link>
                            </dd>
                        </div>
                    )}
                    {payment.meta?.note && <Field label="Note" value={payment.meta.note} className="sm:col-span-2" />}
                    {payment.meta?.last_event && (
                        <div className="sm:col-span-2">
                            <dt className="text-xs font-medium uppercase tracking-wide text-gray-500">Last event</dt>
                            <dd className="mt-1 overflow-x-auto rounded-md bg-gray-50 p-3 font-mono text-xs text-gray-700">
                                <pre>{JSON.stringify(payment.meta.last_event, null, 2)}</pre>
                            </dd>
                        </div>
                    )}
                </dl>

                {payment.is_placeholder && payment.status === 'pending' && (
                    <p className="rounded-md bg-amber-50 px-3 py-2 text-sm text-amber-800 ring-1 ring-inset ring-amber-200">
                        This provider is a placeholder. Only a signed webhook or authorized manual settlement can confirm it.
                    </p>
                )}
            </div>
        </AppLayout>
    );
}

function Field({ label, value, className = '' }) {
    return (
        <div className={className}>
            <dt className="text-xs font-medium uppercase tracking-wide text-gray-500">{label}</dt>
            <dd className="mt-1 text-sm text-gray-900">{value}</dd>
        </div>
    );
}
