import { Head, Link, usePage } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';
import PermissionGate from '@/Components/PermissionGate';

function Card({ label, value }) {
    return (
        <div className="rounded-lg bg-white p-4 shadow-sm ring-1 ring-gray-200">
            <dt className="text-xs font-medium uppercase tracking-wide text-gray-500">{label}</dt>
            <dd className="mt-1 text-2xl font-semibold text-gray-900">{value}</dd>
        </div>
    );
}

function QuickLink({ href, label }) {
    return (
        <Link
            href={href}
            className="rounded-lg bg-white p-4 text-sm font-medium text-gray-900 shadow-sm ring-1 ring-gray-200 hover:bg-gray-50"
        >
            {label}
        </Link>
    );
}

export default function Dashboard({ kpis }) {
    const { auth } = usePage().props;

    return (
        <AppLayout>
            <Head title="Dashboard" />

            <div className="flex flex-col gap-6">
                <div className="rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    <h1 className="text-xl font-semibold text-gray-900">
                        Welcome{auth?.user ? `, ${auth.user.name}` : ''}
                    </h1>
                </div>

                {kpis.scope === 'staff' && (
                    <div className="grid grid-cols-2 gap-4 sm:grid-cols-4">
                        <Card label="Low stock items" value={kpis.low_stock_count} />
                        <Card label="Pending PO approvals" value={kpis.pending_po_approvals} />
                        <Card label="Pending payments" value={kpis.pending_payments} />
                        <Card label="Today's sales" value={kpis.todays_sales_total} />
                    </div>
                )}

                {kpis.scope === 'business_buyer' && (
                    <div className="grid grid-cols-2 gap-4 sm:grid-cols-3">
                        <Card label="Pending PO approvals" value={kpis.pending_po_approvals} />
                        <Card label="Credit limit" value={kpis.credit_limit} />
                        <Card label="Outstanding balance" value={kpis.outstanding_balance} />
                    </div>
                )}

                {kpis.scope === 'staff' && kpis.recent_activity.length > 0 && (
                    <div className="rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-200">
                        <h2 className="mb-3 text-sm font-semibold text-gray-900">Recent activity</h2>
                        <ul className="divide-y divide-gray-100">
                            {kpis.recent_activity.map((entry) => (
                                <li key={entry.id} className="flex items-center justify-between py-2 text-sm">
                                    <span className="text-gray-700">{entry.event}</span>
                                    <span className="text-gray-500">
                                        {entry.causer ?? 'System'} — {new Date(entry.created_at).toLocaleString()}
                                    </span>
                                </li>
                            ))}
                        </ul>
                    </div>
                )}

                <div>
                    <h2 className="mb-3 text-sm font-semibold text-gray-900">Quick links</h2>
                    <div className="grid grid-cols-2 gap-3 sm:grid-cols-4">
                        <PermissionGate permission="catalog.read">
                            <QuickLink href="/catalog/products" label="Catalog" />
                        </PermissionGate>
                        <PermissionGate permission="stock.read">
                            <QuickLink href="/stock/levels" label="Stock levels" />
                        </PermissionGate>
                        <PermissionGate permission="stock.read">
                            <QuickLink href="/reports/low-stock" label="Low stock report" />
                        </PermissionGate>
                        <PermissionGate permission="stock.read">
                            <QuickLink href="/reports/stock-movements" label="Stock movement report" />
                        </PermissionGate>
                        <PermissionGate permission="payment.settle">
                            <QuickLink href="/reports/sales" label="Sales report" />
                        </PermissionGate>
                        <PermissionGate permission="payment.settle">
                            <QuickLink href="/reports/payments" label="Payments report" />
                        </PermissionGate>
                        <PermissionGate any={['import.run', 'audit.read']}>
                            <QuickLink href="/reports/imports" label="Import history" />
                        </PermissionGate>
                        <PermissionGate permission="sale.create">
                            <QuickLink href="/orders" label="My orders" />
                        </PermissionGate>
                        <PermissionGate any={['quote.request', 'quote.price', 'po.approve']}>
                            <QuickLink href="/procurement/quotes" label="Quotes" />
                        </PermissionGate>
                        <PermissionGate any={['quote.request', 'po.approve', 'payment.settle']}>
                            <QuickLink href="/procurement/purchase-orders" label="Purchase orders" />
                        </PermissionGate>
                        <PermissionGate permission="user.manage">
                            <QuickLink href="/admin/users" label="Users" />
                        </PermissionGate>
                        <PermissionGate permission="role.manage">
                            <QuickLink href="/admin/roles" label="Roles" />
                        </PermissionGate>
                        <PermissionGate permission="audit.read">
                            <QuickLink href="/admin/audit-log" label="Audit log" />
                        </PermissionGate>
                        <PermissionGate permission="access.manage">
                            <QuickLink href="/admin/access/company-hours" label="Company working hours" />
                        </PermissionGate>
                        <PermissionGate permission="access.manage">
                            <QuickLink href="/admin/access/permission-windows" label="Role/permission access windows" />
                        </PermissionGate>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
