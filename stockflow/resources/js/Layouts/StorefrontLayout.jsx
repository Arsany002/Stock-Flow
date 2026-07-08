import { Link, usePage, router } from '@inertiajs/react';
import { useState } from 'react';
import FlashMessage from '@/Components/FlashMessage';
import CategoryNav from '@/Components/CategoryNav';
import Button from '@/Components/Button';
import Input from '@/Components/Input';

/**
 * Public storefront shell — used by every guest-accessible page (Home,
 * Products, Categories, Search, Cart). Unlike AppLayout, this never
 * assumes an authenticated user: the header shows Login/Register for a
 * guest and a "Log out" + "My orders" link once authenticated, and never
 * hides the storefront itself behind a permission check.
 */
export default function StorefrontLayout({ children }) {
    const { auth, cart, publicCategories } = usePage().props;
    const [search, setSearch] = useState('');

    function handleLogout(event) {
        event.preventDefault();
        router.post('/logout');
    }

    function handleSearch(event) {
        event.preventDefault();
        router.get('/search', { q: search }, { preserveState: true });
    }

    return (
        <div className="min-h-screen bg-gray-50">
            <header className="border-b border-gray-200 bg-white">
                <div className="mx-auto flex max-w-6xl flex-col gap-3 px-4 py-4 sm:px-6 lg:px-8">
                    <div className="flex items-center justify-between gap-4">
                        <Link href="/" className="text-lg font-semibold text-gray-900">
                            StockFlow
                        </Link>

                        <form onSubmit={handleSearch} className="hidden max-w-sm flex-1 sm:block">
                            <Input
                                placeholder="Search products..."
                                value={search}
                                onChange={(e) => setSearch(e.target.value)}
                            />
                        </form>

                        <div className="flex items-center gap-4">
                            <Link href="/cart" className="text-sm font-medium text-gray-700 hover:text-gray-900">
                                Cart{cart?.count > 0 ? ` (${cart.count})` : ''}
                            </Link>

                            {auth?.user ? (
                                <>
                                    <Link href="/orders" className="text-sm text-gray-600 hover:text-gray-900">
                                        My orders
                                    </Link>
                                    <Button variant="secondary" onClick={handleLogout}>
                                        Log out
                                    </Button>
                                </>
                            ) : (
                                <Button as={Link} href="/login" variant="secondary">
                                    Log in
                                </Button>
                            )}
                        </div>
                    </div>

                    <CategoryNav categories={publicCategories ?? []} />
                </div>
            </header>

            <main className="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
                <div className="mb-6">
                    <FlashMessage />
                </div>
                {children}
            </main>
        </div>
    );
}
