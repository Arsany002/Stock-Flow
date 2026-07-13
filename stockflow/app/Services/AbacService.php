<?php

namespace App\Services;

use App\Enums\UserRole;
use App\Support\Access\AccessContext;
use App\Support\Access\AccessDecision;
use RuntimeException;

/**
 * ABAC answers "can this user perform this action now, from this request,
 * under these conditions?" — a layer on top of Laratrust RBAC, never a
 * replacement for it. Route middleware (`permission:*`) still decides
 * "does this user have this permission at all"; AbacService only narrows
 * that further by time-of-day. It never touches rate/abuse protection —
 * that's AdaptiveThrottleService's job, enforced by a separate middleware.
 *
 * See docs/technical/abac.md.
 */
class AbacService
{
    public function __construct(private readonly AccessWindowService $windows) {}

    public function check(AccessContext $context): AccessDecision
    {
        if ($context->permissionName !== null && $context->user !== null) {
            $hasSpecificWindow = $this->windows->hasActiveWindows($context->permissionName, $context->action);

            if ($hasSpecificWindow) {
                $allowed = $this->windows->isPermissionAllowedNow(
                    $context->user,
                    $context->permissionName,
                    $context->action,
                    $context->currentTime,
                );

                if (! $allowed) {
                    return AccessDecision::deny(
                        'This action is only available during its configured access window.',
                        'outside_permission_window',
                        403,
                        ['action' => $context->action, 'permission' => $context->permissionName],
                    );
                }

                return AccessDecision::allow();
            }
        }

        $companyOpen = $this->windows->isCompanyOpenNow($context->currentTime, $context->timezone);

        if (! $companyOpen) {
            $bypass = config('abac.super_admin_bypass_time_windows', true)
                && $context->user?->hasRole(UserRole::SuperAdmin->value);

            if (! $bypass) {
                return AccessDecision::deny(
                    'This action is only available during company working hours.',
                    'outside_working_hours',
                    403,
                    ['action' => $context->action],
                );
            }
        }

        return AccessDecision::allow();
    }

    public function assertAllowed(AccessContext $context): void
    {
        $decision = $this->check($context);

        if (! $decision->allowed) {
            throw new RuntimeException($decision->reason);
        }
    }
}
