import { Head, usePage } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';

export default function Dashboard() {
    const { auth } = usePage().props;

    return (
        <AppLayout>
            <Head title="Dashboard" />

            <div className="rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <h1 className="text-xl font-semibold text-gray-900">
                    Welcome{auth?.user ? `, ${auth.user.name}` : ''}
                </h1>
                <p className="mt-2 text-sm text-gray-600">
                    This is the base StockFlow dashboard. Business modules (catalog, stock,
                    orders, procurement) are not built yet.
                </p>
            </div>
        </AppLayout>
    );
}
