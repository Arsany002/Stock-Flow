import { Head, Link } from '@inertiajs/react';

export default function NotFound() {
    return (
        <div className="flex min-h-screen flex-col items-center justify-center gap-4 bg-gray-50 px-4 text-center">
            <Head title="Not found" />
            <p className="text-sm font-semibold text-gray-500">404</p>
            <h1 className="text-2xl font-semibold text-gray-900">Page not found</h1>
            <p className="max-w-md text-sm text-gray-600">
                The page you're looking for doesn't exist or may have been moved.
            </p>
            <Link href="/dashboard" className="text-sm font-medium text-gray-900 underline">
                Back to dashboard
            </Link>
        </div>
    );
}
