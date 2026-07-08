import { Head, Link, useForm } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';
import Breadcrumbs from '@/Components/Breadcrumbs';
import Select from '@/Components/Select';
import Button from '@/Components/Button';

export default function FakeGateway({ payment }) {
    const { data, setData, post, processing } = useForm({ outcome: 'succeed' });

    function submit(event) {
        event.preventDefault();
        post(`/payments/${payment.id}/fake-gateway`);
    }

    return (
        <AppLayout>
            <Head title="Fake gateway" />

            <div className="flex flex-col gap-4">
                <Breadcrumbs
                    items={[
                        { label: 'Payments', href: '/payments' },
                        { label: payment.id.slice(0, 8), href: `/payments/${payment.id}` },
                        { label: 'Fake gateway' },
                    ]}
                />

                <h1 className="text-xl font-semibold text-gray-900">Fake gateway callback</h1>

                <form onSubmit={submit} className="flex max-w-md flex-col gap-4 rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    <Select
                        label="Outcome"
                        name="outcome"
                        value={data.outcome}
                        onChange={(e) => setData('outcome', e.target.value)}
                        options={[
                            { value: 'succeed', label: 'Succeed' },
                            { value: 'fail', label: 'Fail' },
                        ]}
                    />

                    <div className="flex items-center gap-3">
                        <Button type="submit" disabled={processing || payment.status !== 'pending'}>
                            Send callback
                        </Button>
                        <Link href={`/payments/${payment.id}`} className="text-sm text-gray-500 underline">
                            Back
                        </Link>
                    </div>
                </form>
            </div>
        </AppLayout>
    );
}
