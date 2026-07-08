/**
 * Formats the retail unit price string StorefrontCatalogService::
 * presentProduct() returns (a decimal string, e.g. "100.00", or null if no
 * active retail price is configured for the product).
 */
export default function PriceLabel({ price, className = '' }) {
    if (price === null || price === undefined) {
        return <span className={['text-sm text-gray-400', className].join(' ')}>Price unavailable</span>;
    }

    return <span className={['font-semibold text-gray-900', className].join(' ')}>${price}</span>;
}
