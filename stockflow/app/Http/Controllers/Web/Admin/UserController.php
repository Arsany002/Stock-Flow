<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateUserRolesRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\RoleAssignmentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function __construct(private readonly RoleAssignmentService $roleAssignmentService) {}

    /**
     * List users with their current role names.
     */
    public function index(): Response
    {
        $users = User::query()
            ->orderBy('name')
            ->paginate(15)
            ->through(fn (User $user) => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'roles' => $user->roles()->pluck('display_name')->all(),
            ]);

        return Inertia::render('Admin/Users/Index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the role-assignment page for a single user.
     */
    public function editRoles(User $user): Response
    {
        $roles = Role::query()->orderBy('name')->get(['id', 'name', 'display_name']);

        return Inertia::render('Admin/Users/Edit', [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
            'roles' => $roles->map(fn (Role $role) => [
                'name' => $role->name,
                'display_name' => $role->display_name,
            ]),
            'assignedRoles' => $user->roles()->pluck('name'),
        ]);
    }

    /**
     * Sync the given user's role assignments.
     */
    public function updateRoles(UpdateUserRolesRequest $request, User $user): RedirectResponse
    {
        $this->roleAssignmentService->syncRoles($user, $request->roleNames(), Auth::user());

        return redirect()
            ->route('admin.users.edit-roles', $user)
            ->with('flash.success', "Roles updated for {$user->name}.");
    }
}
