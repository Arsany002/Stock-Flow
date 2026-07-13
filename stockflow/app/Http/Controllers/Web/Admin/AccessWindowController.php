<?php

namespace App\Http\Controllers\Web\Admin;

use App\Enums\PermissionName;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePermissionAccessWindowRequest;
use App\Http\Requests\Admin\UpdateCompanyWorkingHoursRequest;
use App\Http\Requests\Admin\UpdatePermissionAccessWindowRequest;
use App\Models\PermissionAccessWindow;
use App\Models\Role;
use App\Repositories\Contracts\AccessWindowRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

/**
 * Admin UI for the two ABAC schedule tables — see AccessWindowService for
 * the read-side logic these edit. Gated by `access.manage` (SuperAdmin
 * only by default; see RolePermissionSeeder), not `role.manage`/
 * `user.manage`, since editing working hours is a distinct concern from
 * RBAC role/permission assignment.
 */
class AccessWindowController extends Controller
{
    public function __construct(private readonly AccessWindowRepositoryInterface $windows) {}

    public function companyHours(): Response
    {
        $days = collect(range(0, 6))->map(function (int $day) {
            $row = $this->windows->workingHourForDay($day);

            return [
                'day_of_week' => $day,
                'is_open' => $row === null ? true : $row->is_open,
                'opens_at' => $row?->opens_at !== null ? substr((string) $row->opens_at, 0, 5) : null,
                'closes_at' => $row?->closes_at !== null ? substr((string) $row->closes_at, 0, 5) : null,
                'timezone' => $row === null ? 'Africa/Cairo' : $row->timezone,
            ];
        });

        return Inertia::render('Admin/Access/CompanyHours', ['days' => $days]);
    }

    public function updateCompanyHours(UpdateCompanyWorkingHoursRequest $request): RedirectResponse
    {
        foreach ($request->days() as $day) {
            $this->windows->upsertWorkingHour($day['day_of_week'], $day);
        }

        return redirect()
            ->route('admin.access.company-hours.index')
            ->with('flash.success', 'Company working hours updated.');
    }

    public function permissionWindows(): Response
    {
        $windows = $this->windows->allWindows()->map(fn (PermissionAccessWindow $window) => [
            'id' => $window->id,
            'permission_name' => $window->permission_name,
            'action' => $window->action,
            'role_id' => $window->role_id,
            'role_name' => $window->role?->display_name,
            'day_of_week' => $window->day_of_week,
            'starts_at' => substr((string) $window->starts_at, 0, 5),
            'ends_at' => substr((string) $window->ends_at, 0, 5),
            'timezone' => $window->timezone,
            'is_active' => $window->is_active,
            'bypass_for_super_admin' => $window->bypass_for_super_admin,
        ]);

        return Inertia::render('Admin/Access/PermissionWindows', [
            'windows' => $windows,
            'permissions' => collect(PermissionName::cases())->map(fn (PermissionName $p) => [
                'name' => $p->value,
                'label' => $p->label(),
            ]),
            'roles' => Role::query()->orderBy('display_name')->get(['id', 'display_name', 'name']),
        ]);
    }

    public function storePermissionWindow(StorePermissionAccessWindowRequest $request): RedirectResponse
    {
        $this->windows->createWindow($request->attributesToPersist());

        return redirect()
            ->route('admin.access.permission-windows.index')
            ->with('flash.success', 'Access window created.');
    }

    public function updatePermissionWindow(UpdatePermissionAccessWindowRequest $request, PermissionAccessWindow $window): RedirectResponse
    {
        $this->windows->updateWindow($window, $request->attributesToPersist());

        return redirect()
            ->route('admin.access.permission-windows.index')
            ->with('flash.success', 'Access window updated.');
    }

    public function destroyPermissionWindow(PermissionAccessWindow $window): RedirectResponse
    {
        $this->windows->deleteWindow($window);

        return redirect()
            ->route('admin.access.permission-windows.index')
            ->with('flash.success', 'Access window deleted.');
    }
}
