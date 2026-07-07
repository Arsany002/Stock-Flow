import { usePage } from '@inertiajs/react';

/**
 * Client-side visibility helper only — this is cosmetic, not a security boundary.
 * The server (route middleware / policies) always re-enforces authorization;
 * see docs/project/canonical-decisions.md.
 *
 * Usage:
 *   <PermissionGate permission="stock.move">...</PermissionGate>
 *   <PermissionGate role="SuperAdmin">...</PermissionGate>
 *   <PermissionGate any={['stock.move', 'stock.transfer']}>...</PermissionGate>
 */
export default function PermissionGate({ permission, role, any, fallback = null, children }) {
    const { auth } = usePage().props;
    const permissions = auth?.permissions ?? [];
    const roles = auth?.roles ?? [];

    let allowed = true;

    if (permission) {
        allowed = permissions.includes(permission);
    } else if (role) {
        allowed = roles.includes(role);
    } else if (any?.length) {
        allowed = any.some((p) => permissions.includes(p) || roles.includes(p));
    }

    return allowed ? children : fallback;
}
