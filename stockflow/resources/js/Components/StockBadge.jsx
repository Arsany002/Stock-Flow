const styles = {
    in_stock: 'bg-green-50 text-green-700 ring-green-200',
    low_stock: 'bg-amber-50 text-amber-700 ring-amber-200',
    out_of_stock: 'bg-red-50 text-red-700 ring-red-200',
};

/**
 * Public stock label only — never renders an exact quantity. Expects the
 * `stock_status`/`stock_label` pair produced by
 * StorefrontCatalogService::presentProduct() (StockAvailabilityService's
 * in_stock/low_stock/out_of_stock vocabulary).
 */
export default function StockBadge({ status, label }) {
    return (
        <span
            className={[
                'inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium ring-1 ring-inset',
                styles[status] ?? styles.in_stock,
            ].join(' ')}
        >
            {label}
        </span>
    );
}
