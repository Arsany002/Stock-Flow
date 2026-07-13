<?php

namespace App\Repositories\Contracts;

use App\Models\CompanyWorkingHour;
use App\Models\PermissionAccessWindow;
use Illuminate\Support\Collection;

interface AccessWindowRepositoryInterface
{
    public function workingHourForDay(int $dayOfWeek): ?CompanyWorkingHour;

    /**
     * @return Collection<int, CompanyWorkingHour>
     */
    public function allWorkingHours(): Collection;

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function upsertWorkingHour(int $dayOfWeek, array $attributes): CompanyWorkingHour;

    /**
     * Active windows for a permission (+ optional action), regardless of
     * day/time — existence of this collection is what decides whether
     * AbacService falls back to company_working_hours.
     *
     * @return Collection<int, PermissionAccessWindow>
     */
    public function activeWindowsFor(string $permissionName, ?string $action): Collection;

    /**
     * @return Collection<int, PermissionAccessWindow>
     */
    public function allWindows(): Collection;

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function createWindow(array $attributes): PermissionAccessWindow;

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function updateWindow(PermissionAccessWindow $window, array $attributes): PermissionAccessWindow;

    public function deleteWindow(PermissionAccessWindow $window): void;
}
