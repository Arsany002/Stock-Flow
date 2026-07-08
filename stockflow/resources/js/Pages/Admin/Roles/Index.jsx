import { Head, Link, router } from '@inertiajs/react';
import { Fragment, useState } from 'react';
import AppLayout from '@/Layouts/AppLayout';
import Button from '@/Components/Button';

export default function Index({ roles, permissions }) {
    const [expanded, setExpanded] = useState(null);
    const [selected, setSelected] = useState([]);
    const [processing, setProcessing] = useState(false);

    function toggleExpand(role) {
        if (expanded === role.name) {
            setExpanded(null);
            return;
        }
        setExpanded(role.name);
        setSelected(role.permissions);
    }

    function togglePermission(name) {
        setSelected((current) =>
            current.includes(name) ? current.filter((p) => p !== name) : [...current, name]
        );
    }

    function save(role) {
        setProcessing(true);
        router.put(
            `/admin/roles/${role.id}/permissions`,
            { permissions: selected },
            {
                preserveScroll: true,
                onFinish: () => setProcessing(false),
                onSuccess: () => setExpanded(null),
            }
        );
    }

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

                <div className="overflow-hidden rounded-lg ring-1 ring-gray-200">
                    <table className="min-w-full divide-y divide-gray-200">
                        <thead className="bg-gray-50">
                            <tr>
                                <th className="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Role</th>
                                <th className="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Slug</th>
                                <th className="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Description</th>
                                <th className="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Permissions</th>
                                <th className="px-4 py-3" />
                            </tr>
                        </thead>
                        <tbody className="divide-y divide-gray-100 bg-white">
                            {roles.map((role) => (
                                <Fragment key={role.name}>
                                    <tr>
                                        <td className="whitespace-nowrap px-4 py-3 text-sm text-gray-700">{role.display_name}</td>
                                        <td className="whitespace-nowrap px-4 py-3 text-sm text-gray-700">{role.name}</td>
                                        <td className="whitespace-nowrap px-4 py-3 text-sm text-gray-700">{role.description}</td>
                                        <td className="whitespace-nowrap px-4 py-3 text-sm text-gray-700">{role.permissions_count}</td>
                                        <td className="whitespace-nowrap px-4 py-3 text-sm">
                                            <button
                                                type="button"
                                                className="font-medium text-gray-900 underline"
                                                onClick={() => toggleExpand(role)}
                                            >
                                                {expanded === role.name ? 'Cancel' : 'Edit permissions'}
                                            </button>
                                        </td>
                                    </tr>
                                    {expanded === role.name && (
                                        <tr key={`${role.name}-editor`}>
                                            <td colSpan={5} className="bg-gray-50 px-4 py-4">
                                                <fieldset className="grid grid-cols-2 gap-2 sm:grid-cols-3">
                                                    <legend className="sr-only">Permissions for {role.display_name}</legend>
                                                    {permissions.map((permission) => (
                                                        <label
                                                            key={permission.name}
                                                            className="flex items-center gap-2 text-sm text-gray-700"
                                                        >
                                                            <input
                                                                type="checkbox"
                                                                className="rounded border-gray-300"
                                                                checked={selected.includes(permission.name)}
                                                                onChange={() => togglePermission(permission.name)}
                                                            />
                                                            {permission.display_name}
                                                        </label>
                                                    ))}
                                                </fieldset>
                                                <div className="mt-4">
                                                    <Button onClick={() => save(role)} disabled={processing}>
                                                        Save permissions
                                                    </Button>
                                                </div>
                                            </td>
                                        </tr>
                                    )}
                                </Fragment>
                            ))}
                        </tbody>
                    </table>
                </div>
            </div>
        </AppLayout>
    );
}
