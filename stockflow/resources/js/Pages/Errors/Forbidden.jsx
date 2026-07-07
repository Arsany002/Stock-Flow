import { Head, Link } from '@inertiajs/react';

export default function Forbidden() {
    return (
        <div className="flex min-h-screen flex-col items-center justify-center gap-4 bg-gray-50 px-4 text-center">
            <Head title="Forbidden" />
            <p className="text-sm font-semibold text-gray-500">403</p>
            <h1 className="text-2xl font-semibold text-gray-900">You don't have access to this page</h1>
            <p className="max-w-md text-sm text-gray-600">
                Your account doesn't have the permission required to view this resource.
            </p>
            <Link href="/dashboard" className="text-sm font-medium text-gray-900 underline">
                Back to dashboard
            </Link>
        </div>
    );
}
