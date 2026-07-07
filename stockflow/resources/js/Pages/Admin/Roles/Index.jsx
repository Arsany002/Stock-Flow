import { Head, Link } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';
import Table from '@/Components/Table';

export default function Index({ roles }) {
    const columns = [
        { key: 'display_name', label: 'Role' },
        { key: 'name', label: 'Slug' },
        { key: 'description', label: 'Description' },
        { key: 'permissions_count', label: 'Permissions' },
    ];

    return (
        <AppLayout>
            <Head title="Roles" />

            <div className="flex flex-col gap-4">
                <div className="flex items-center justify-between">
                    <h1 className="text-xl font-semibold text-gray-900">Roles</h1>
                    <Link href="/admin/permissions/matrix" className="text-sm font-medium text-gray-900 underline">
                        View permission matrix
                    </Link>
                </div>

                <Table columns={columns} rows={roles} emptyMessage="No roles found." />
            </div>
        </AppLayout>
    );
}
