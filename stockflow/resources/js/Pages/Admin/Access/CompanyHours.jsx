import { Head, router } from '@inertiajs/react';
import { useState } from 'react';
import AppLayout from '@/Layouts/AppLayout';
import Button from '@/Components/Button';

const DAY_LABELS = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

export default function CompanyHours({ days }) {
    const [rows, setRows] = useState(days);
    const [processing, setProcessing] = useState(false);

    function updateRow(dayOfWeek, changes) {
        setRows((current) =>
            current.map((row) => (row.day_of_week === dayOfWeek ? { ...row, ...changes } : row))
        );
    }

    function save() {
        setProcessing(true);
        router.put(
            '/admin/access/company-hours',
            { days: rows },
            { preserveScroll: true, onFinish: () => setProcessing(false) }
        );
    }

    return (
        <AppLayout>
            <Head title="Company Working Hours" />

            <div className="flex flex-col gap-4">
                <h1 className="text-xl font-semibold text-gray-900">Company Working Hours</h1>
                <p className="text-sm text-gray-500">
                    The default schedule ABAC falls back to for any action that has no permission-specific
                    access window of its own.
                </p>

                <div className="overflow-hidden rounded-lg ring-1 ring-gray-200">
                    <table className="min-w-full divide-y divide-gray-200">
                        <thead className="bg-gray-50">
                            <tr>
                                <th className="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Day</th>
                                <th className="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Open</th>
                                <th className="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Opens</th>
                                <th className="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Closes</th>
                            </tr>
                        </thead>
                        <tbody className="divide-y divide-gray-100 bg-white">
                            {rows.map((row) => (
                                <tr key={row.day_of_week}>
                                    <td className="whitespace-nowrap px-4 py-3 text-sm text-gray-700">
                                        {DAY_LABELS[row.day_of_week]}
                                    </td>
                                    <td className="whitespace-nowrap px-4 py-3 text-sm">
                                        <input
                                            type="checkbox"
                                            className="rounded border-gray-300"
                                            checked={row.is_open}
                                            onChange={(e) => updateRow(row.day_of_week, { is_open: e.target.checked })}
                                        />
                                    </td>
                                    <td className="whitespace-nowrap px-4 py-3 text-sm">
                                        <input
                                            type="time"
                                            className="rounded border-gray-300 text-sm"
                                            value={row.opens_at ?? ''}
                                            disabled={!row.is_open}
                                            onChange={(e) => updateRow(row.day_of_week, { opens_at: e.target.value })}
                                        />
                                    </td>
                                    <td className="whitespace-nowrap px-4 py-3 text-sm">
                                        <input
                                            type="time"
                                            className="rounded border-gray-300 text-sm"
                                            value={row.closes_at ?? ''}
                                            disabled={!row.is_open}
                                            onChange={(e) => updateRow(row.day_of_week, { closes_at: e.target.value })}
                                        />
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>

                <div>
                    <Button onClick={save} disabled={processing}>
                        Save working hours
                    </Button>
                </div>
            </div>
        </AppLayout>
    );
}
