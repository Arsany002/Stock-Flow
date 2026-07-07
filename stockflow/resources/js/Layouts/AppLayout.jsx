import { Link, usePage, router } from '@inertiajs/react';
import FlashMessage from '@/Components/FlashMessage';
import Button from '@/Components/Button';

export default function AppLayout({ children }) {
    const { auth, activeWarehouse } = usePage().props;

    function handleLogout(event) {
        event.preventDefault();
        router.post('/logout');
    }

    return (
        <div className="min-h-screen bg-gray-50">
            <header className="border-b border-gray-200 bg-white">
                <div className="mx-auto flex max-w-6xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
                    <div className="flex items-center gap-6">
                        <Link href="/dashboard" className="text-lg font-semibold text-gray-900">
                            StockFlow
                        </Link>
                        {activeWarehouse && (
                            <span className="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600">
                                {activeWarehouse.name}
                            </span>
                        )}
                    </div>

                    <div className="flex items-center gap-4">
                        {auth?.user && (
                            <span className="text-sm text-gray-600">
                                {auth.user.name}
                            </span>
                        )}
                        <Button variant="secondary" onClick={handleLogout}>
                            Log out
                        </Button>
                    </div>
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
