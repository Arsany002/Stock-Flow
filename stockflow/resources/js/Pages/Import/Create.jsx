import { Head, Link, useForm } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';
import Breadcrumbs from '@/Components/Breadcrumbs';
import Button from '@/Components/Button';
import Select from '@/Components/Select';

export default function Create({ entities }) {
    const { data, setData, post, processing, errors } = useForm({
        entity: '',
        file: null,
    });

    function submit(event) {
        event.preventDefault();

        post('/imports', { forceFormData: true });
    }

    return (
        <AppLayout>
            <Head title="New import" />

            <div className="flex flex-col gap-4">
                <Breadcrumbs items={[{ label: 'Imports', href: '/imports' }, { label: 'New import' }]} />

                <div className="flex items-center justify-between">
                    <h1 className="text-xl font-semibold text-gray-900">New import</h1>
                    <Button as={Link} href="/imports" variant="secondary">
                        Back
                    </Button>
                </div>

                <form onSubmit={submit} className="flex max-w-xl flex-col gap-4 rounded-lg bg-white p-5 shadow-sm ring-1 ring-gray-200">
                    <Select
                        label="Entity"
                        name="entity"
                        placeholder="Select entity"
                        value={data.entity}
                        options={entities}
                        error={errors.entity}
                        onChange={(event) => setData('entity', event.target.value)}
                    />

                    <div className="flex flex-col gap-1">
                        <label htmlFor="file" className="text-sm font-medium text-gray-700">
                            File
                        </label>
                        <input
                            id="file"
                            name="file"
                            type="file"
                            accept=".xlsx,.xls,.csv,.txt"
                            onChange={(event) => setData('file', event.target.files[0])}
                            className={[
                                'block w-full rounded-md border-0 px-3 py-2 text-gray-900 shadow-sm ring-1 ring-inset',
                                errors.file ? 'ring-red-400 focus:ring-red-500' : 'ring-gray-300 focus:ring-gray-900',
                                'file:mr-3 file:rounded-md file:border-0 file:bg-gray-900 file:px-3 file:py-1.5 file:text-sm file:font-semibold file:text-white',
                                'focus:outline-none focus:ring-2 sm:text-sm',
                            ].join(' ')}
                        />
                        {errors.file && <p className="text-sm text-red-600">{errors.file}</p>}
                    </div>

                    <div className="flex justify-end gap-3">
                        <Button as={Link} href="/imports" variant="secondary">
                            Cancel
                        </Button>
                        <Button type="submit" disabled={processing}>
                            Queue import
                        </Button>
                    </div>
                </form>
            </div>
        </AppLayout>
    );
}
