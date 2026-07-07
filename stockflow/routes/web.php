<?php

use App\Http\Controllers\Web\Admin\PermissionMatrixController;
use App\Http\Controllers\Web\Admin\RoleController;
use App\Http\Controllers\Web\Admin\UserController;
use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Catalog\CategoryController;
use App\Http\Controllers\Web\Catalog\PriceListController;
use App\Http\Controllers\Web\Catalog\PriceListItemController;
use App\Http\Controllers\Web\Catalog\ProductController;
use App\Http\Controllers\Web\Catalog\SupplierController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\Stock\StockAdjustmentController;
use App\Http\Controllers\Web\Stock\StockLevelController;
use App\Http\Controllers\Web\Stock\StockMovementController;
use App\Http\Controllers\Web\Stock\StockReconciliationController;
use App\Http\Controllers\Web\Stock\StockTransferController;
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

    Route::prefix('catalog')->name('catalog.')->group(function () {
        // Route order matters: /products/create must be registered before
        // the /products/{product} wildcard, or "create" would be parsed as
        // a product id.
        Route::get('/products', [ProductController::class, 'index'])
            ->name('products.index')->middleware('permission:catalog.read');
        Route::get('/products/create', [ProductController::class, 'create'])
            ->name('products.create')->middleware('permission:product.manage');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
            ->name('products.edit')->middleware('permission:product.manage');
        Route::get('/products/{product}', [ProductController::class, 'show'])
            ->name('products.show')->middleware('permission:catalog.read');
        Route::post('/products', [ProductController::class, 'store'])
            ->name('products.store')->middleware('permission:product.manage');
        Route::put('/products/{product}', [ProductController::class, 'update'])
            ->name('products.update')->middleware('permission:product.manage');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])
            ->name('products.destroy')->middleware('permission:product.manage');

        Route::get('/categories', [CategoryController::class, 'index'])
            ->name('categories.index')->middleware('permission:catalog.read');
        Route::post('/categories', [CategoryController::class, 'store'])
            ->name('categories.store')->middleware('permission:category.manage');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
            ->name('categories.destroy')->middleware('permission:category.manage');

        Route::get('/suppliers', [SupplierController::class, 'index'])
            ->name('suppliers.index')->middleware('permission:catalog.read');
        Route::post('/suppliers', [SupplierController::class, 'store'])
            ->name('suppliers.store')->middleware('permission:product.manage');
        Route::delete('/suppliers/{supplier}', [SupplierController::class, 'destroy'])
            ->name('suppliers.destroy')->middleware('permission:product.manage');

        Route::get('/price-lists', [PriceListController::class, 'index'])
            ->name('price-lists.index')->middleware('permission:catalog.read');
        Route::post('/price-lists', [PriceListController::class, 'store'])
            ->name('price-lists.store')->middleware('permission:pricelist.manage');
        Route::post('/price-lists/{priceList}/items', [PriceListItemController::class, 'store'])
            ->name('price-lists.items.store')->middleware('permission:pricelist.manage');
        Route::put('/price-list-items/{priceListItem}', [PriceListItemController::class, 'update'])
            ->name('price-list-items.update')->middleware('permission:pricelist.manage');
        Route::delete('/price-list-items/{priceListItem}', [PriceListItemController::class, 'destroy'])
            ->name('price-list-items.destroy')->middleware('permission:pricelist.manage');
    });

    Route::prefix('stock')->name('stock.')->group(function () {
        Route::get('/levels', [StockLevelController::class, 'index'])
            ->name('levels.index')->middleware('permission:stock.read');

        Route::get('/movements', [StockMovementController::class, 'index'])
            ->name('movements.index')->middleware('permission:stock.read');

        // Route order matters: /adjustments/create must be registered
        // before a wildcard could ever be added under /adjustments.
        Route::get('/adjustments/create', [StockAdjustmentController::class, 'create'])
            ->name('adjustments.create')->middleware('permission:stock.move');
        Route::post('/adjustments', [StockAdjustmentController::class, 'store'])
            ->name('adjustments.store')->middleware(['permission:stock.move', 'warehouse.scope:stock.move']);

        Route::get('/transfers/create', [StockTransferController::class, 'create'])
            ->name('transfers.create')->middleware('permission:stock.transfer');
        Route::post('/transfers', [StockTransferController::class, 'store'])
            ->name('transfers.store')->middleware(['permission:stock.transfer', 'warehouse.scope:stock.transfer']);

        Route::get('/reconcile', [StockReconciliationController::class, 'show'])
            ->name('reconcile.show')->middleware('permission:stock.move|audit.read');
        Route::post('/reconcile', [StockReconciliationController::class, 'run'])
            ->name('reconcile.run')->middleware('permission:stock.move|audit.read');
    });
});
