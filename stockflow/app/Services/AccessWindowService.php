<?php

namespace App\Services;

use App\Enums\UserRole;
use App\Models\PermissionAccessWindow;
use App\Models\User;
use App\Repositories\Contracts\AccessWindowRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Collection;

/**
 * Resolves "is the company/an action open right now?" against the
 * company_working_hours + permission_access_windows tables. Pure read
 * logic — AbacService is the only caller that turns this into an
 * allow/deny AccessDecision; this service never throws or redirects.
 *
 * Precedence (see docs/technical/abac.md):
 *  1. If permission_access_windows has any active row for the permission
 *     (+ action), that overrides company_working_hours entirely.
 *  2. Otherwise fall back to company_working_hours for "now".
 *  3. If neither has a row at all, allow by default (absence of
 *     configuration is permissive, not restrictive).
 */
class AccessWindowService
{
    public function __construct(private readonly AccessWindowRepositoryInterface $windows) {}

    public function isCompanyOpenNow(Carbon $now, string $timezone = 'Africa/Cairo'): bool
    {
        $localNow = $now->copy()->timezone($timezone);
        $row = $this->windows->workingHourForDay($localNow->dayOfWeek);

        if ($row === null) {
            // No configured schedule for this day at all — permissive default.
            return true;
        }

        if (! $row->is_open) {
            return false;
        }

        if ($row->opens_at === null || $row->closes_at === null) {
            return true;
        }

        $rowLocalNow = $now->copy()->timezone($row->timezone ?? $timezone);

        return $this->isTimeInsideWindow($rowLocalNow->format('H:i:s'), (string) $row->opens_at, (string) $row->closes_at);
    }

    /**
     * Whether any active permission_access_windows row exists for this
     * permission (+ optional action) — callers use this to decide whether
     * to check isPermissionAllowedNow() at all or fall back to company
     * working hours.
     */
    public function hasActiveWindows(string $permission, ?string $action): bool
    {
        return $this->allowedWindowsForPermission($permission, $action)->isNotEmpty();
    }

    public function isPermissionAllowedNow(User $user, string $permission, ?string $action, Carbon $now): bool
    {
        $windows = $this->allowedWindowsForPermission($permission, $action)
            ->filter(fn (PermissionAccessWindow $window) => $window->role_id === null || $user->hasRole($window->role?->name ?? '__none__'));

        if ($windows->isEmpty()) {
            return true;
        }

        $isSuperAdmin = $user->hasRole(UserRole::SuperAdmin->value);

        foreach ($windows as $window) {
            if ($isSuperAdmin && $window->bypass_for_super_admin) {
                return true;
            }

            $localNow = $now->copy()->timezone($window->timezone ?? 'Africa/Cairo');
            $time = $localNow->format('H:i:s');
            $start = (string) $window->starts_at;
            $end = (string) $window->ends_at;
            $isOvernight = $this->normalizeTime($start) > $this->normalizeTime($end);
            $windowDay = (int) $window->day_of_week;
            $today = $localNow->dayOfWeek;
            $yesterday = ($today + 6) % 7;

            if ($windowDay === $today) {
                // Same-day segment: for an overnight window this is the
                // "starts_at -> midnight" half; for a normal window it's
                // the whole thing.
                if ($isOvernight ? $time >= $this->normalizeTime($start) : $this->isTimeInsideWindow($time, $start, $end)) {
                    return true;
                }
            }

            if ($isOvernight && $windowDay === $yesterday && $time < $this->normalizeTime($end)) {
                // "midnight -> ends_at" half, on the calendar day after
                // the window's configured day_of_week.
                return true;
            }
        }

        return false;
    }

    /**
     * String time comparison ("H:i:s" or "H:i"), supporting overnight
     * ranges where starts_at > ends_at (e.g. 22:00 -> 06:00 wraps past
     * midnight).
     */
    public function isTimeInsideWindow(string $time, string $startsAt, string $endsAt): bool
    {
        $time = $this->normalizeTime($time);
        $start = $this->normalizeTime($startsAt);
        $end = $this->normalizeTime($endsAt);

        if ($start <= $end) {
            return $time >= $start && $time < $end;
        }

        // Overnight window: e.g. 22:00:00 -> 06:00:00.
        return $time >= $start || $time < $end;
    }

    /**
     * @return Collection<int, PermissionAccessWindow>
     */
    public function allowedWindowsForPermission(string $permission, ?string $action = null): Collection
    {
        return $this->windows->activeWindowsFor($permission, $action);
    }

    private function normalizeTime(string $time): string
    {
        $parts = explode(':', $time);
        $parts += ['00', '00', '00'];

        return sprintf('%02d:%02d:%02d', (int) $parts[0], (int) $parts[1], (int) $parts[2]);
    }
}
