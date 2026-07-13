import { Head, router } from '@inertiajs/react';
import { useState } from 'react';
import AppLayout from '@/Layouts/AppLayout';
import Button from '@/Components/Button';

const DAY_LABELS = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

const EMPTY_FORM = {
    permission_name: '',
    action: '',
    role_id: '',
    day_of_week: 6,
    starts_at: '09:00',
    ends_at: '17:00',
    is_active: true,
    bypass_for_super_admin: true,
};

export default function PermissionWindows({ windows, permissions, roles }) {
    const [form, setForm] = useState(EMPTY_FORM);
    const [processing, setProcessing] = useState(false);

    function submit(e) {
        e.preventDefault();
        setProcessing(true);
        router.post('/admin/access/permission-windows', form, {
            preserveScroll: true,
            onFinish: () => setProcessing(false),
            onSuccess: () => setForm(EMPTY_FORM),
        });
    }

    function toggleActive(window) {
        router.put(
            `/admin/access/permission-windows/${window.id}`,
            { ...window, is_active: !window.is_active },
            { preserveScroll: true }
        );
    }

    function remove(window) {
        router.delete(`/admin/access/permission-windows/${window.id}`, { preserveScroll: true });
    }

    return (
        <AppLayout>
            <Head title="Permission Access Windows" />

            <div className="flex flex-col gap-6">
                <h1 className="text-xl font-semibold text-gray-900">Permission Access Windows</h1>
                <p className="text-sm text-gray-500">
                    Stricter, permission/action-specific schedules that override the global company working
                    hours whenever one exists.
                </p>

                <form onSubmit={submit} className="grid grid-cols-2 gap-3 rounded-lg bg-gray-50 p-4 sm:grid-cols-4">
                    <select
                        className="rounded border-gray-300 text-sm"
                        value={form.permission_name}
                        onChange={(e) => setForm({ ...form, permission_name: e.target.value })}
                        required
                    >
                        <option value="">Permission…</option>
                        {permissions.map((p) => (
                            <option key={p.name} value={p.name}>
                                {p.label}
                            </option>
                        ))}
                    </select>

                    <input
                        type="text"
                        placeholder="Action (optional)"
                        className="rounded border-gray-300 text-sm"
                        value={form.action}
                        onChange={(e) => setForm({ ...form, action: e.target.value })}
                    />

                    <select
                        className="rounded border-gray-300 text-sm"
                        value={form.role_id}
                        onChange={(e) => setForm({ ...form, role_id: e.target.value })}
                    >
                        <option value="">Any role</option>
                        {roles.map((role) => (
                            <option key={role.id} value={role.id}>
                                {role.display_name}
                            </option>
                        ))}
                    </select>

                    <select
                        className="rounded border-gray-300 text-sm"
                        value={form.day_of_week}
                        onChange={(e) => setForm({ ...form, day_of_week: Number(e.target.value) })}
                    >
                        {DAY_LABELS.map((label, index) => (
                            <option key={label} value={index}>
                                {label}
                            </option>
                        ))}
                    </select>

                    <input
                        type="time"
                        className="rounded border-gray-300 text-sm"
                        value={form.starts_at}
                        onChange={(e) => setForm({ ...form, starts_at: e.target.value })}
                        required
                    />
                    <input
                        type="time"
                        className="rounded border-gray-300 text-sm"
                        value={form.ends_at}
                        onChange={(e) => setForm({ ...form, ends_at: e.target.value })}
                        required
                    />

                    <label className="flex items-center gap-2 text-sm text-gray-700">
                        <input
                            type="checkbox"
                            className="rounded border-gray-300"
                            checked={form.bypass_for_super_admin}
                            onChange={(e) => setForm({ ...form, bypass_for_super_admin: e.target.checked })}
                        />
                        SuperAdmin bypass
                    </label>

                    <Button type="submit" disabled={processing}>
                        Add window
                    </Button>
                </form>

                <div className="overflow-hidden rounded-lg ring-1 ring-gray-200">
                    <table className="min-w-full divide-y divide-gray-200">
                        <thead className="bg-gray-50">
                            <tr>
                                <th className="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Permission</th>
                                <th className="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Action</th>
                                <th className="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Role</th>
                                <th className="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Day</th>
                                <th className="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Window</th>
                                <th className="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Active</th>
                                <th className="px-4 py-3" />
                            </tr>
                        </thead>
                        <tbody className="divide-y divide-gray-100 bg-white">
                            {windows.map((window) => (
                                <tr key={window.id}>
                                    <td className="whitespace-nowrap px-4 py-3 text-sm text-gray-700">{window.permission_name}</td>
                                    <td className="whitespace-nowrap px-4 py-3 text-sm text-gray-700">{window.action ?? '—'}</td>
                                    <td className="whitespace-nowrap px-4 py-3 text-sm text-gray-700">{window.role_name ?? 'Any'}</td>
                                    <td className="whitespace-nowrap px-4 py-3 text-sm text-gray-700">{DAY_LABELS[window.day_of_week]}</td>
                                    <td className="whitespace-nowrap px-4 py-3 text-sm text-gray-700">
                                        {window.starts_at}–{window.ends_at}
                                    </td>
                                    <td className="whitespace-nowrap px-4 py-3 text-sm">
                                        <button
                                            type="button"
                                            className="font-medium text-gray-900 underline"
                                            onClick={() => toggleActive(window)}
                                        >
                                            {window.is_active ? 'Active' : 'Inactive'}
                                        </button>
                                    </td>
                                    <td className="whitespace-nowrap px-4 py-3 text-sm">
                                        <button
                                            type="button"
                                            className="font-medium text-red-600 underline"
                                            onClick={() => remove(window)}
                                        >
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
            </div>
        </AppLayout>
    );
}
