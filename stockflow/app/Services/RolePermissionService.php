<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;

/**
 * Role/permission management improvements (module 4): lets a `role.manage`
 * holder edit a role's own permission set, not just which roles a user
 * has (RoleAssignmentService). Role::syncPermissions() already flushes
 * Laratrust's permission cache for every user holding that role, so no
 * separate cache-invalidation step is needed here.
 */
class RolePermissionService
{
    public function __construct(private readonly AuditService $audit) {}

    /**
     * @param  list<string>  $permissionNames
     */
    public function syncPermissions(Role $role, array $permissionNames, ?User $actor = null): Role
    {
        $before = $role->permissions()->pluck('name')->all();

        $role->syncPermissions($permissionNames);

        // Requirement #2 of the admin/audit module: permission changes are
        // an audited event category, distinct from user/role changes.
        $this->audit->record('role.permissions_updated', $role, $actor, [
            'before' => $before,
            'after' => $permissionNames,
        ]);

        return $role->fresh('permissions');
    }
}
