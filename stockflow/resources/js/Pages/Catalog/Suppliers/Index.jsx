import { Head, router, useForm } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';
import Breadcrumbs from '@/Components/Breadcrumbs';
import Table from '@/Components/Table';
import Pagination from '@/Components/Pagination';
import Input from '@/Components/Input';
import Button from '@/Components/Button';
import PermissionGate from '@/Components/PermissionGate';

export default function Index({ suppliers }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        name: '',
        email: '',
        phone: '',
    });

    function submit(event) {
        event.preventDefault();
        post('/catalog/suppliers', { onSuccess: () => reset() });
    }

    function destroy(supplier) {
        if (confirm(`Delete supplier "${supplier.name}"?`)) {
            router.delete(`/catalog/suppliers/${supplier.id}`);
        }
    }

    const columns = [
        { key: 'name', label: 'Name' },
        { key: 'email', label: 'Email', render: (row) => row.email ?? '—' },
        { key: 'phone', label: 'Phone', render: (row) => row.phone ?? '—' },
        {
            key: 'is_active',
            label: 'Status',
            render: (row) => (row.is_active ? 'Active' : 'Inactive'),
        },
        {
            key: 'actions',
            label: '',
            render: (row) => (
                <PermissionGate permission="product.manage">
                    <button onClick={() => destroy(row)} className="text-sm text-red-600 hover:underline">
                        Delete
                    </button>
                </PermissionGate>
            ),
        },
    ];

    return (
        <AppLayout>
            <Head title="Suppliers" />

            <div className="flex flex-col gap-4">
                <Breadcrumbs items={[{ label: 'Catalog' }, { label: 'Suppliers' }]} />

                <h1 className="text-xl font-semibold text-gray-900">Suppliers</h1>

                <Table columns={columns} rows={suppliers.data} emptyMessage="No suppliers found." />

                <Pagination links={suppliers.links} />

                <PermissionGate permission="product.manage">
                    <form onSubmit={submit} className="flex flex-wrap items-end gap-3 rounded-lg bg-white p-4 shadow-sm ring-1 ring-gray-200">
                        <div className="w-56">
                            <Input
                                label="Name"
                                name="name"
                                value={data.name}
                                error={errors.name}
                                onChange={(e) => setData('name', e.target.value)}
                                required
                            />
                        </div>
                        <div className="w-56">
                            <Input
                                label="Email"
                                name="email"
                                type="email"
                                value={data.email}
                                error={errors.email}
                                onChange={(e) => setData('email', e.target.value)}
                            />
                        </div>
                        <div className="w-56">
                            <Input
                                label="Phone"
                                name="phone"
                                value={data.phone}
                                error={errors.phone}
                                onChange={(e) => setData('phone', e.target.value)}
                            />
                        </div>
                        <Button type="submit" disabled={processing}>
                            Add supplier
                        </Button>
                    </form>
                </PermissionGate>
            </div>
        </AppLayout>
    );
}
