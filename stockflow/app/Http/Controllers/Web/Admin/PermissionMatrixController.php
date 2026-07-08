<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Inertia\Inertia;
use Inertia\Response;

class PermissionMatrixController extends Controller
{
    /**
     * Read-only role x permission grid, mirroring the Enterprise PRD §3
     * permission matrix. This is a reporting view; role assignment happens
     * on the Users/Edit page, and a role's own permission set is edited on
     * Roles/Index (RolePermissionController).
     */
    public function index(): Response
    {
        $roles = Role::query()->orderBy('name')->with('permissions')->get();
        $permissions = Permission::query()->orderBy('name')->get(['id', 'name', 'display_name']);

        return Inertia::render('Admin/Permissions/Matrix', [
            'permissions' => $permissions->map(fn (Permission $permission) => [
                'name' => $permission->name,
                'display_name' => $permission->display_name,
            ]),
            'roles' => $roles->map(fn (Role $role) => [
                'name' => $role->name,
                'display_name' => $role->display_name,
                'permissions' => $role->permissions->pluck('name')->all(),
            ]),
        ]);
    }
}
