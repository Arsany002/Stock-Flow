<?php

use App\Http\Controllers\Web\Admin\PermissionMatrixController;
use App\Http\Controllers\Web\Admin\RoleController;
use App\Http\Controllers\Web\Admin\UserController;
use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes (Inertia)
|--------------------------------------------------------------------------
|
| Human UI only. Session auth via the `web` guard. No API routes belong
| here — see docs/project/canonical-decisions.md.
|
*/

Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::middleware('permission:user.manage')->group(function () {
            Route::get('/users', [UserController::class, 'index'])->name('users.index');
            Route::get('/users/{user}/roles', [UserController::class, 'editRoles'])->name('users.edit-roles');
        });

        Route::put('/users/{user}/roles', [UserController::class, 'updateRoles'])
            ->name('users.update-roles')
            ->middleware('permission:role.manage');

        Route::middleware('permission:role.manage')->group(function () {
            Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
            Route::get('/permissions/matrix', [PermissionMatrixController::class, 'index'])->name('permissions.matrix');
        });
    });
});
