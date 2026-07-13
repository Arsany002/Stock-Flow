<?php

namespace App\Repositories;

use App\Models\CompanyWorkingHour;
use App\Models\PermissionAccessWindow;
use App\Repositories\Contracts\AccessWindowRepositoryInterface;
use Illuminate\Support\Collection;

class AccessWindowRepository implements AccessWindowRepositoryInterface
{
    public function workingHourForDay(int $dayOfWeek): ?CompanyWorkingHour
    {
        return CompanyWorkingHour::query()->where('day_of_week', $dayOfWeek)->first();
    }

    public function allWorkingHours(): Collection
    {
        return CompanyWorkingHour::query()->orderBy('day_of_week')->get();
    }

    public function upsertWorkingHour(int $dayOfWeek, array $attributes): CompanyWorkingHour
    {
        return CompanyWorkingHour::query()->updateOrCreate(['day_of_week' => $dayOfWeek], $attributes);
    }

    public function activeWindowsFor(string $permissionName, ?string $action): Collection
    {
        return PermissionAccessWindow::query()
            ->where('permission_name', $permissionName)
            ->where('is_active', true)
            ->where(function ($query) use ($action) {
                $query->whereNull('action');

                if ($action !== null) {
                    $query->orWhere('action', $action);
                }
            })
            ->get();
    }

    public function allWindows(): Collection
    {
        return PermissionAccessWindow::query()->with('role')->orderBy('permission_name')->orderBy('day_of_week')->get();
    }

    public function createWindow(array $attributes): PermissionAccessWindow
    {
        return PermissionAccessWindow::query()->create($attributes);
    }

    public function updateWindow(PermissionAccessWindow $window, array $attributes): PermissionAccessWindow
    {
        $window->update($attributes);

        return $window->fresh();
    }

    public function deleteWindow(PermissionAccessWindow $window): void
    {
        $window->delete();
    }
}
