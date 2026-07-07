import { Head, Link, useForm } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';
import Breadcrumbs from '@/Components/Breadcrumbs';
import Select from '@/Components/Select';
import Input from '@/Components/Input';
import Button from '@/Components/Button';

export default function Create({ products }) {
    const { data, setData, post, processing, errors } = useForm({
        lines: [{ product_id: '', quantity: 1 }],
    });

    function updateLine(index, field, value) {
        const lines = data.lines.map((line, i) => (i === index ? { ...line, [field]: value } : line));
        setData('lines', lines);
    }

    function addLine() {
        setData('lines', [...data.lines, { product_id: '', quantity: 1 }]);
    }

    function removeLine(index) {
        setData('lines', data.lines.filter((_, i) => i !== index));
    }

    function submit(event) {
        event.preventDefault();
        post('/procurement/quotes');
    }

    const productOptions = products.map((product) => ({ value: product.id, label: `${product.name} (${product.sku})` }));

    return (
        <AppLayout>
            <Head title="Request a quote" />

            <div className="flex flex-col gap-4">
                <Breadcrumbs
                    items={[{ label: 'Procurement' }, { label: 'Quotes', href: '/procurement/quotes' }, { label: 'Request' }]}
                />

                <h1 className="text-xl font-semibold text-gray-900">Request a quote (RFQ)</h1>

                <form onSubmit={submit} className="flex flex-col gap-4 rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    {data.lines.map((line, index) => (
                        <div key={index} className="flex items-end gap-3">
                            <div className="w-72">
                                <Select
                                    label="Product"
                                    name={`lines.${index}.product_id`}
                                    placeholder="Select a product"
                                    value={line.product_id}
                                    error={errors[`lines.${index}.product_id`]}
                                    onChange={(e) => updateLine(index, 'product_id', e.target.value)}
                                    options={productOptions}
                                    required
                                />
                            </div>
                            <div className="w-28">
                                <Input
                                    label="Quantity"
                                    name={`lines.${index}.quantity`}
                                    type="number"
                                    min="1"
                                    value={line.quantity}
                                    error={errors[`lines.${index}.quantity`]}
                                    onChange={(e) => updateLine(index, 'quantity', e.target.value)}
                                    required
                                />
                            </div>
                            {data.lines.length > 1 && (
                                <Button type="button" variant="danger" onClick={() => removeLine(index)}>
                                    Remove
                                </Button>
                            )}
                        </div>
                    ))}

                    <div>
                        <Button type="button" variant="secondary" onClick={addLine}>
                            Add another line
                        </Button>
                    </div>

                    <div className="flex items-center gap-3">
                        <Button type="submit" disabled={processing}>
                            Submit RFQ
                        </Button>
                        <Link href="/procurement/quotes" className="text-sm text-gray-500 underline">
                            Cancel
                        </Link>
                    </div>
                </form>
            </div>
        </AppLayout>
    );
}
