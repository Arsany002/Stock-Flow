import { Head } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';

export default function Matrix({ permissions, roles }) {
    return (
        <AppLayout>
            <Head title="Permission matrix" />

            <div className="flex flex-col gap-4">
                <h1 className="text-xl font-semibold text-gray-900">Permission matrix</h1>
                <p className="text-sm text-gray-500">
                    Read-only view of the Enterprise PRD permission matrix. Assign roles to a
                    user from the Users page.
                </p>

                <div className="overflow-x-auto rounded-lg ring-1 ring-gray-200">
                    <table className="min-w-full divide-y divide-gray-200">
                        <thead className="bg-gray-50">
                            <tr>
                                <th scope="col" className="sticky left-0 bg-gray-50 px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                                    Permission
                                </th>
                                {roles.map((role) => (
                                    <th
                                        key={role.name}
                                        scope="col"
                                        className="px-4 py-3 text-center text-xs font-semibold uppercase tracking-wide text-gray-500"
                                    >
                                        {role.display_name}
                                    </th>
                                ))}
                            </tr>
                        </thead>
                        <tbody className="divide-y divide-gray-100 bg-white">
                            {permissions.map((permission) => (
                                <tr key={permission.name}>
                                    <td className="sticky left-0 whitespace-nowrap bg-white px-4 py-3 text-sm font-medium text-gray-900">
                                        {permission.display_name}
                                        <span className="ml-2 text-gray-400">({permission.name})</span>
                                    </td>
                                    {roles.map((role) => (
                                        <td key={role.name} className="px-4 py-3 text-center text-sm">
                                            {role.permissions.includes(permission.name) ? (
                                                <span aria-label="granted" className="text-green-600">
                                                    ✓
                                                </span>
                                            ) : (
                                                <span aria-label="not granted" className="text-gray-300">
                                                    –
                                                </span>
                                            )}
                                        </td>
                                    ))}
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
            </div>
        </AppLayout>
    );
}
