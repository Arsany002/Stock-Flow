import { Link } from '@inertiajs/react';

/**
 * Expects the `links` array shape produced by Laravel's paginator
 * (e.g. `$paginator->linkCollection()` / the `links` meta on an API resource):
 * [{ url: string|null, label: string, active: boolean }]
 */
export default function Pagination({ links = [] }) {
    if (links.length <= 3) {
        return null;
    }

    return (
        <nav className="flex flex-wrap items-center gap-1" aria-label="Pagination">
            {links.map((link, index) => (
                <Link
                    key={index}
                    href={link.url ?? '#'}
                    preserveScroll
                    disabled={!link.url}
                    dangerouslySetInnerHTML={{ __html: link.label }}
                    className={[
                        'min-w-[2.25rem] rounded-md px-3 py-1.5 text-center text-sm',
                        link.active
                            ? 'bg-gray-900 text-white'
                            : link.url
                              ? 'text-gray-700 hover:bg-gray-100'
                              : 'cursor-not-allowed text-gray-300',
                    ].join(' ')}
                />
            ))}
        </nav>
    );
}
