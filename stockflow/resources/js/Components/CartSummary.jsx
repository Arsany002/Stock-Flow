import { Link } from '@inertiajs/react';
import Button from '@/Components/Button';

/**
 * Server-computed totals only (Controller rule #4 — totals are never
 * computed client-side). `checkoutHref` defaults to /checkout, which is
 * gated by `checkout.guard` — a guest clicking through gets redirected to
 * /login with the "Please log in to complete your order." flash message.
 */
export default function CartSummary({ subtotal, tax, total, checkoutHref = '/checkout' }) {
    return (
        <div className="flex flex-col items-end gap-1 rounded-lg bg-white p-4 shadow-sm ring-1 ring-gray-200">
            <div className="flex w-64 justify-between text-sm text-gray-600">
                <span>Subtotal</span>
                <span>{subtotal}</span>
            </div>
            <div className="flex w-64 justify-between text-sm text-gray-600">
                <span>VAT (14%)</span>
                <span>{tax}</span>
            </div>
            <div className="flex w-64 justify-between text-base font-semibold text-gray-900">
                <span>Total</span>
                <span>{total}</span>
            </div>

            <Button as={Link} href={checkoutHref} className="mt-3">
                Proceed to checkout
            </Button>
        </div>
    );
}
