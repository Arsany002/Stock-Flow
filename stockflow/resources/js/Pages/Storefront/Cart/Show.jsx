import { Head, Link, router } from '@inertiajs/react';
import StorefrontLayout from '@/Layouts/StorefrontLayout';
import Table from '@/Components/Table';
import Button from '@/Components/Button';
import QuantitySelector from '@/Components/QuantitySelector';
import CartSummary from '@/Components/CartSummary';

export default function Show({ lines, subtotal, tax, total }) {
    function updateQuantity(productId, quantity) {
        router.patch(`/cart/items/${productId}`, { quantity }, { preserveScroll: true });
    }

    function remove(productId) {
        router.delete(`/cart/items/${productId}`, { preserveScroll: true });
    }

    function clearCart() {
        router.delete('/cart', { preserveScroll: true });
    }

    const columns = [
        { key: 'product', label: 'Product', render: (row) => `${row.product.name} (${row.product.sku})` },
        {
            key: 'quantity',
            label: 'Quantity',
            render: (row) => (
                <QuantitySelector value={row.quantity} min={0} onChange={(value) => updateQuantity(row.product.id, value)} />
            ),
        },
        { key: 'unit_price', label: 'Unit price' },
        { key: 'line_total', label: 'Line total' },
        {
            key: 'actions',
            label: '',
            render: (row) => (
                <Button variant="danger" onClick={() => remove(row.product.id)}>
                    Remove
                </Button>
            ),
        },
    ];

    return (
        <StorefrontLayout>
            <Head title="Cart" />

            <div className="flex flex-col gap-4">
                <div className="flex items-center justify-between">
                    <h1 className="text-xl font-semibold text-gray-900">Your cart</h1>
                    {lines.length > 0 && (
                        <Button variant="secondary" onClick={clearCart}>
                            Clear cart
                        </Button>
                    )}
                </div>

                <Table columns={columns} rows={lines} emptyMessage="Your cart is empty. Browse the catalog to add products." />

                {lines.length > 0 && <CartSummary subtotal={subtotal} tax={tax} total={total} />}

                <Link href="/products" className="text-sm text-gray-500 underline">
                    Continue shopping
                </Link>
            </div>
        </StorefrontLayout>
    );
}
