<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateRolePermissionsRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Services\RolePermissionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class RoleController extends Controller
{
    public function __construct(private readonly RolePermissionService $rolePermissions) {}

    /**
     * List roles with their permission counts and full assigned permission
     * names, plus the full permission catalog — Roles/Index.jsx edits a
     * role's own permission set inline (module 4: role/permission
     * management improvements), no separate edit page needed.
     */
    public function index(): Response
    {
        $roles = Role::query()
            ->with('permissions')
            ->withCount('permissions')
            ->orderBy('name')
            ->get()
            ->map(fn (Role $role) => [
                'id' => $role->id,
                'name' => $role->name,
                'display_name' => $role->display_name,
                'description' => $role->description,
                'permissions_count' => $role->permissions_count,
                'permissions' => $role->permissions->pluck('name')->all(),
            ]);

        $permissions = Permission::query()->orderBy('name')->get(['name', 'display_name']);

        return Inertia::render('Admin/Roles/Index', [
            'roles' => $roles,
            'permissions' => $permissions->map(fn (Permission $permission) => [
                'name' => $permission->name,
                'display_name' => $permission->display_name,
            ]),
        ]);
    }

    /**
     * Sync the given role's permission assignments.
     */
    public function updatePermissions(UpdateRolePermissionsRequest $request, Role $role): RedirectResponse
    {
        $this->rolePermissions->syncPermissions($role, $request->permissionNames(), Auth::user());

        return redirect()
            ->route('admin.roles.index')
            ->with('flash.success', "Permissions updated for {$role->display_name}.");
    }
}
