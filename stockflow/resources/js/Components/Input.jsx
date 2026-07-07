import { forwardRef } from 'react';

const Input = forwardRef(function Input(
    { label, error, className = '', id, ...props },
    ref
) {
    const inputId = id ?? props.name;

    return (
        <div className="flex flex-col gap-1">
            {label && (
                <label htmlFor={inputId} className="text-sm font-medium text-gray-700">
                    {label}
                </label>
            )}
            <input
                ref={ref}
                id={inputId}
                className={[
                    'block w-full rounded-md border-0 px-3 py-2 text-gray-900 shadow-sm ring-1 ring-inset',
                    error ? 'ring-red-400 focus:ring-red-500' : 'ring-gray-300 focus:ring-gray-900',
                    'placeholder:text-gray-400 focus:outline-none focus:ring-2 sm:text-sm',
                    className,
                ].join(' ')}
                {...props}
            />
            {error && <p className="text-sm text-red-600">{error}</p>}
        </div>
    );
});

export default Input;
