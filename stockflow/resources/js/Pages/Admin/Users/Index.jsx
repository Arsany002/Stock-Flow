import { Head, Link } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';
import Table from '@/Components/Table';
import Pagination from '@/Components/Pagination';

export default function Index({ users }) {
    const columns = [
        { key: 'name', label: 'Name' },
        { key: 'email', label: 'Email' },
        {
            key: 'roles',
            label: 'Roles',
            render: (row) =>
                row.roles.length > 0 ? (
                    <div className="flex flex-wrap gap-1">
                        {row.roles.map((role) => (
                            <span
                                key={role}
                                className="rounded-full bg-gray-100 px-2 py-0.5 text-xs font-medium text-gray-700"
                            >
                                {role}
                            </span>
                        ))}
                    </div>
                ) : (
                    <span className="text-gray-400">No roles</span>
                ),
        },
        {
            key: 'actions',
            label: '',
            render: (row) => (
                <Link
                    href={`/admin/users/${row.id}/roles`}
                    className="font-medium text-gray-900 underline"
                >
                    Edit roles
                </Link>
            ),
        },
    ];

    return (
        <AppLayout>
            <Head title="Users" />

            <div className="flex flex-col gap-4">
                <h1 className="text-xl font-semibold text-gray-900">Users</h1>

                <Table columns={columns} rows={users.data} emptyMessage="No users found." />

                <Pagination links={users.links} />
            </div>
        </AppLayout>
    );
}
