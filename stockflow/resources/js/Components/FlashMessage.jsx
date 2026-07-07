import { usePage } from '@inertiajs/react';

export default function FlashMessage() {
    const { flash } = usePage().props;

    if (!flash?.success && !flash?.error) {
        return null;
    }

    return (
        <div className="flex flex-col gap-2">
            {flash.success && (
                <div className="rounded-md bg-green-50 px-4 py-3 text-sm font-medium text-green-800 ring-1 ring-inset ring-green-200">
                    {flash.success}
                </div>
            )}
            {flash.error && (
                <div className="rounded-md bg-red-50 px-4 py-3 text-sm font-medium text-red-800 ring-1 ring-inset ring-red-200">
                    {flash.error}
                </div>
            )}
        </div>
    );
}
