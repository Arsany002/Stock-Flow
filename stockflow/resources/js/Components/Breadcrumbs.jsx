import { Link } from '@inertiajs/react';

/**
 * items: [{ label: string, href?: string }] — the last item (no href) renders as plain text.
 */
export default function Breadcrumbs({ items = [] }) {
    if (items.length === 0) {
        return null;
    }

    return (
        <nav aria-label="Breadcrumb" className="mb-2">
            <ol className="flex flex-wrap items-center gap-1 text-sm text-gray-500">
                {items.map((item, index) => (
                    <li key={index} className="flex items-center gap-1">
                        {index > 0 && <span className="text-gray-300">/</span>}
                        {item.href ? (
                            <Link href={item.href} className="hover:text-gray-900 hover:underline">
                                {item.label}
                            </Link>
                        ) : (
                            <span className="text-gray-900">{item.label}</span>
                        )}
                    </li>
                ))}
            </ol>
        </nav>
    );
}
