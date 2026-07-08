/**
 * Plain number input clamped to >= 1 client-side; the server re-validates
 * (`quantity: min:1` on AddToCartRequest / `min:0` on UpdateCartItemRequest)
 * regardless, so this is a UX convenience, not the authoritative check.
 */
export default function QuantitySelector({ value, onChange, min = 1, className = '' }) {
    return (
        <input
            type="number"
            min={min}
            value={value}
            onChange={(e) => {
                const parsed = parseInt(e.target.value, 10);
                onChange(Number.isNaN(parsed) ? min : parsed);
            }}
            className={[
                'block w-20 rounded-md border-0 px-3 py-2 text-center text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300',
                'focus:outline-none focus:ring-2 focus:ring-gray-900 sm:text-sm',
                className,
            ].join(' ')}
        />
    );
}
