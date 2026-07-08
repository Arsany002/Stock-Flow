import { Link } from '@inertiajs/react';

/**
 * Top-level categories with their children — expects the tree shape
 * produced by CategoryRepository::allWithChildren() (shared globally as
 * the `publicCategories` Inertia prop).
 */
export default function CategoryNav({ categories = [] }) {
    if (categories.length === 0) {
        return null;
    }

    return (
        <nav className="flex flex-wrap gap-x-6 gap-y-2 text-sm">
            {categories.map((category) => (
                <div key={category.id} className="group relative">
                    <Link href={`/categories/${category.slug}`} className="font-medium text-gray-700 hover:text-gray-900">
                        {category.name}
                    </Link>
                    {category.children?.length > 0 && (
                        <div className="mt-1 hidden flex-col gap-1 group-hover:flex">
                            {category.children.map((child) => (
                                <Link
                                    key={child.id}
                                    href={`/categories/${child.slug}`}
                                    className="text-gray-500 hover:text-gray-900"
                                >
                                    {child.name}
                                </Link>
                            ))}
                        </div>
                    )}
                </div>
            ))}
        </nav>
    );
}
