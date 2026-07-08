<?php

namespace App\Services;

use App\Models\User;

/**
 * @see docs/project/canonical-decisions.md §3 — Laratrust roles/permissions,
 *      cached and invalidated on role/permission change.
 */
class RoleAssignmentService
{
    public function __construct(private readonly AuditService $audit) {}

    /**
     * Replace a user's role assignments with exactly the given set.
     *
     * Laratrust flushes that user's permission cache as part of syncRoles(),
     * so a stale role/permission list is never served after this call.
     *
     * @param  list<string>  $roleNames
     */
    public function syncRoles(User $user, array $roleNames, ?User $actor = null): User
    {
        $before = $user->roles()->pluck('name')->all();

        $user->syncRoles($roleNames);

        // Requirement #2 of the admin/audit module: user/role changes are
        // an audited event category.
        $this->audit->record('user.roles_updated', $user, $actor, [
            'before' => $before,
            'after' => $roleNames,
        ]);

        return $user->fresh();
    }
}
