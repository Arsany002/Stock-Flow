import { Head, router, useForm } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';
import Breadcrumbs from '@/Components/Breadcrumbs';
import Input from '@/Components/Input';
import Select from '@/Components/Select';
import Button from '@/Components/Button';
import PermissionGate from '@/Components/PermissionGate';

export default function Index({ categories, parentOptions }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        parent_id: '',
        name: '',
        slug: '',
    });

    function submit(event) {
        event.preventDefault();
        post('/catalog/categories', { onSuccess: () => reset() });
    }

    function destroy(category) {
        if (confirm(`Delete category "${category.name}"?`)) {
            router.delete(`/catalog/categories/${category.id}`);
        }
    }

    return (
        <AppLayout>
            <Head title="Categories" />

            <div className="flex flex-col gap-4">
                <Breadcrumbs items={[{ label: 'Catalog' }, { label: 'Categories' }]} />

                <h1 className="text-xl font-semibold text-gray-900">Categories</h1>

                <div className="rounded-lg bg-white shadow-sm ring-1 ring-gray-200">
                    {categories.length === 0 ? (
                        <p className="p-6 text-sm text-gray-500">No categories yet.</p>
                    ) : (
                        <ul className="divide-y divide-gray-100">
                            {categories.map((category) => (
                                <li key={category.id} className="p-4">
                                    <div className="flex items-center justify-between">
                                        <span className="font-medium text-gray-900">{category.name}</span>
                                        <PermissionGate permission="category.manage">
                                            <button
                                                onClick={() => destroy(category)}
                                                className="text-sm text-red-600 hover:underline"
                                            >
                                                Delete
                                            </button>
                                        </PermissionGate>
                                    </div>
                                    {category.children.length > 0 && (
                                        <ul className="mt-2 ml-4 flex flex-col gap-1 border-l border-gray-100 pl-4">
                                            {category.children.map((child) => (
                                                <li key={child.id} className="flex items-center justify-between text-sm text-gray-600">
                                                    <span>{child.name}</span>
                                                    <PermissionGate permission="category.manage">
                                                        <button
                                                            onClick={() => destroy(child)}
                                                            className="text-red-600 hover:underline"
                                                        >
                                                            Delete
                                                        </button>
                                                    </PermissionGate>
                                                </li>
                                            ))}
                                        </ul>
                                    )}
                                </li>
                            ))}
                        </ul>
                    )}
                </div>

                <PermissionGate permission="category.manage">
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
                                label="Slug"
                                name="slug"
                                value={data.slug}
                                error={errors.slug}
                                onChange={(e) => setData('slug', e.target.value)}
                                required
                            />
                        </div>
                        <div className="w-56">
                            <Select
                                label="Parent"
                                name="parent_id"
                                placeholder="No parent (top-level)"
                                value={data.parent_id}
                                error={errors.parent_id}
                                onChange={(e) => setData('parent_id', e.target.value)}
                                options={parentOptions.map((c) => ({ value: c.id, label: c.name }))}
                            />
                        </div>
                        <Button type="submit" disabled={processing}>
                            Add category
                        </Button>
                    </form>
                </PermissionGate>
            </div>
        </AppLayout>
    );
}
