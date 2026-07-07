import { Head, Link, useForm } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';
import Button from '@/Components/Button';

export default function EditRoles({ user, roles, assignedRoles }) {
    const { data, setData, put, processing, errors } = useForm({
        roles: assignedRoles,
    });

    function toggleRole(roleName) {
        setData(
            'roles',
            data.roles.includes(roleName)
                ? data.roles.filter((name) => name !== roleName)
                : [...data.roles, roleName]
        );
    }

    function submit(event) {
        event.preventDefault();
        put(`/admin/users/${user.id}/roles`);
    }

    return (
        <AppLayout>
            <Head title={`Edit roles — ${user.name}`} />

            <div className="flex flex-col gap-4">
                <div>
                    <Link href="/admin/users" className="text-sm text-gray-500 underline">
                        &larr; Back to users
                    </Link>
                    <h1 className="mt-2 text-xl font-semibold text-gray-900">
                        Edit roles for {user.name}
                    </h1>
                    <p className="text-sm text-gray-500">{user.email}</p>
                </div>

                <form onSubmit={submit} className="flex flex-col gap-4 rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    <fieldset className="flex flex-col gap-3">
                        <legend className="sr-only">Roles</legend>
                        {roles.map((role) => (
                            <label key={role.name} className="flex items-center gap-3 text-sm text-gray-700">
                                <input
                                    type="checkbox"
                                    className="rounded border-gray-300"
                                    checked={data.roles.includes(role.name)}
                                    onChange={() => toggleRole(role.name)}
                                />
                                <span className="font-medium">{role.display_name}</span>
                                <span className="text-gray-400">({role.name})</span>
                            </label>
                        ))}
                    </fieldset>

                    {errors.roles && <p className="text-sm text-red-600">{errors.roles}</p>}

                    <Button type="submit" disabled={processing} className="self-start">
                        Save roles
                    </Button>
                </form>
            </div>
        </AppLayout>
    );
}
