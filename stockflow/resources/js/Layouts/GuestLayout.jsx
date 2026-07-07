import FlashMessage from '@/Components/FlashMessage';

export default function GuestLayout({ children }) {
    return (
        <div className="flex min-h-screen flex-col items-center justify-center bg-gray-50 px-4 py-12">
            <div className="mb-8 text-2xl font-semibold text-gray-900">StockFlow</div>

            <div className="w-full max-w-md">
                <div className="mb-4">
                    <FlashMessage />
                </div>
                <div className="rounded-lg bg-white px-6 py-8 shadow-sm ring-1 ring-gray-200">
                    {children}
                </div>
            </div>
        </div>
    );
}
