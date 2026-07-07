import { forwardRef } from 'react';

const Select = forwardRef(function Select(
    { label, error, options = [], placeholder, className = '', id, ...props },
    ref
) {
    const selectId = id ?? props.name;

    return (
        <div className="flex flex-col gap-1">
            {label && (
                <label htmlFor={selectId} className="text-sm font-medium text-gray-700">
                    {label}
                </label>
            )}
            <select
                ref={ref}
                id={selectId}
                className={[
                    'block w-full rounded-md border-0 px-3 py-2 text-gray-900 shadow-sm ring-1 ring-inset',
                    error ? 'ring-red-400 focus:ring-red-500' : 'ring-gray-300 focus:ring-gray-900',
                    'focus:outline-none focus:ring-2 sm:text-sm',
                    className,
                ].join(' ')}
                {...props}
            >
                {placeholder && <option value="">{placeholder}</option>}
                {options.map((option) => (
                    <option key={option.value} value={option.value}>
                        {option.label}
                    </option>
                ))}
            </select>
            {error && <p className="text-sm text-red-600">{error}</p>}
        </div>
    );
});

export default Select;
