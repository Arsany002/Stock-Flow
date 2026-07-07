import { Head, Link, router } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';
import Breadcrumbs from '@/Components/Breadcrumbs';
import Table from '@/Components/Table';
import Button from '@/Components/Button';

export default function Show({ quote, canPrice, canAccept, canReject }) {
    function accept() {
        if (confirm('Accept this quote? This will create a purchase order.')) {
            router.post(`/procurement/quotes/${quote.id}/accept`);
        }
    }

    function reject() {
        if (confirm('Reject this quote?')) {
            router.post(`/procurement/quotes/${quote.id}/reject`);
        }
    }

    const columns = [
        { key: 'product', label: 'Product', render: (row) => `${row.product.name} (${row.product.sku})` },
        { key: 'quantity', label: 'Quantity' },
        { key: 'unit_price', label: 'Unit price' },
    ];

    return (
        <AppLayout>
            <Head title={`Quote ${quote.id.slice(0, 8)}`} />

            <div className="flex flex-col gap-4">
                <Breadcrumbs
                    items={[
                        { label: 'Procurement' },
                        { label: 'Quotes', href: '/procurement/quotes' },
                        { label: quote.id.slice(0, 8) },
                    ]}
                />

                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-xl font-semibold text-gray-900">Quote {quote.id.slice(0, 8)}</h1>
                        <p className="text-sm text-gray-500">
                            {quote.business_account.company_name} — {quote.status_label}
                        </p>
                    </div>

                    <div className="flex gap-2">
                        {canPrice && quote.status === 'draft' && (
                            <Button as={Link} href={`/procurement/quotes/${quote.id}/price`}>
                                Price quote
                            </Button>
                        )}
                        {canAccept && quote.status === 'sent' && !quote.is_expired && (
                            <Button onClick={accept}>Accept</Button>
                        )}
                        {canReject && quote.status === 'sent' && (
                            <Button variant="danger" onClick={reject}>
                                Reject
                            </Button>
                        )}
                    </div>
                </div>

                {quote.status === 'sent' && quote.is_expired && (
                    <p className="rounded-md bg-red-50 px-3 py-2 text-sm text-red-800 ring-1 ring-inset ring-red-200">
                        This quote expired on {quote.expires_at} and can no longer be accepted.
                    </p>
                )}

                <div className="rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    <h2 className="mb-3 text-sm font-semibold text-gray-900">Lines</h2>
                    <Table columns={columns} rows={quote.items} emptyMessage="No lines." />
                </div>

                <div className="flex flex-col items-end gap-1 rounded-lg bg-white p-4 shadow-sm ring-1 ring-gray-200">
                    <div className="flex w-64 justify-between text-sm text-gray-600">
                        <span>Subtotal</span>
                        <span>{quote.subtotal}</span>
                    </div>
                    <div className="flex w-64 justify-between text-sm text-gray-600">
                        <span>VAT (14%)</span>
                        <span>{quote.tax}</span>
                    </div>
                    <div className="flex w-64 justify-between text-base font-semibold text-gray-900">
                        <span>Total</span>
                        <span>{quote.total}</span>
                    </div>
                </div>

                {quote.purchase_orders.length > 0 && (
                    <div className="rounded-lg bg-white p-4 shadow-sm ring-1 ring-gray-200">
                        <h2 className="mb-2 text-sm font-semibold text-gray-900">Purchase orders</h2>
                        <ul className="flex flex-col gap-1">
                            {quote.purchase_orders.map((po) => (
                                <li key={po.id}>
                                    <Link href={`/procurement/purchase-orders/${po.id}`} className="text-sm underline">
                                        {po.id.slice(0, 8)} — {po.status}
                                    </Link>
                                </li>
                            ))}
                        </ul>
                    </div>
                )}
            </div>
        </AppLayout>
    );
}
