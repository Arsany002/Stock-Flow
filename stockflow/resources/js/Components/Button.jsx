const variants = {
    primary: 'bg-gray-900 text-white hover:bg-gray-700 focus-visible:outline-gray-900',
    secondary: 'bg-white text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:outline-gray-400',
    danger: 'bg-red-600 text-white hover:bg-red-500 focus-visible:outline-red-600',
};

export default function Button({
    as: Component = 'button',
    type = 'button',
    variant = 'primary',
    className = '',
    disabled = false,
    children,
    ...props
}) {
    const classes = [
        'inline-flex items-center justify-center gap-2 rounded-md px-3.5 py-2 text-sm font-semibold',
        'shadow-sm transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2',
        'disabled:cursor-not-allowed disabled:opacity-50',
        variants[variant] ?? variants.primary,
        className,
    ].join(' ');

    return (
        <Component
            type={Component === 'button' ? type : undefined}
            className={classes}
            disabled={disabled}
            {...props}
        >
            {children}
        </Component>
    );
}
