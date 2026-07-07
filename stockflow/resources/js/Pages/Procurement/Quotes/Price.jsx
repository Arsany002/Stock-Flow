import { Head, Link, useForm } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';
import Breadcrumbs from '@/Components/Breadcrumbs';
import Input from '@/Components/Input';
import Button from '@/Components/Button';

export default function Price({ quote }) {
    const initialPrices = Object.fromEntries(
        quote.items.map((item) => [item.id, item.suggested_unit_price ?? ''])
    );

    const { data, setData, post, processing, errors } = useForm({
        prices: initialPrices,
    });

    function submit(event) {
        event.preventDefault();
        post(`/procurement/quotes/${quote.id}/price`);
    }

    return (
        <AppLayout>
            <Head title="Price quote" />

            <div className="flex flex-col gap-4">
                <Breadcrumbs
                    items={[
                        { label: 'Procurement' },
                        { label: 'Quotes', href: '/procurement/quotes' },
                        { label: quote.id.slice(0, 8), href: `/procurement/quotes/${quote.id}` },
                        { label: 'Price' },
                    ]}
                />

                <h1 className="text-xl font-semibold text-gray-900">Price quote {quote.id.slice(0, 8)}</h1>
                <p className="text-sm text-gray-500">
                    Suggested prices are pulled from the active B2B tier price list — override as negotiated.
                </p>

                <form onSubmit={submit} className="flex flex-col gap-4 rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    {quote.items.map((item) => (
                        <div key={item.id} className="flex items-end gap-4">
                            <div className="w-72">
                                <p className="text-sm font-medium text-gray-700">
                                    {item.product.name} ({item.product.sku})
                                </p>
                                <p className="text-xs text-gray-500">Quantity: {item.quantity}</p>
                            </div>
                            <div className="w-40">
                                <Input
                                    label="Unit price"
                                    name={`prices.${item.id}`}
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    value={data.prices[item.id]}
                                    error={errors[`prices.${item.id}`]}
                                    onChange={(e) => setData('prices', { ...data.prices, [item.id]: e.target.value })}
                                    placeholder={item.suggested_unit_price ?? undefined}
                                    required
                                />
                            </div>
                        </div>
                    ))}

                    <div className="flex items-center gap-3">
                        <Button type="submit" disabled={processing}>
                            Send quote
                        </Button>
                        <Link href={`/procurement/quotes/${quote.id}`} className="text-sm text-gray-500 underline">
                            Cancel
                        </Link>
                    </div>
                </form>
            </div>
        </AppLayout>
    );
}
