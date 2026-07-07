<?php

namespace App\Services;

use App\Models\User;

/**
 * @see docs/project/canonical-decisions.md §3 — Laratrust roles/permissions,
 *      cached and invalidated on role/permission change.
 */
class RoleAssignmentService
{
    /**
     * Replace a user's role assignments with exactly the given set.
     *
     * Laratrust flushes that user's permission cache as part of syncRoles(),
     * so a stale role/permission list is never served after this call.
     *
     * @param  list<string>  $roleNames
     */
    public function syncRoles(User $user, array $roleNames): User
    {
        $user->syncRoles($roleNames);

        return $user->fresh();
    }
}
