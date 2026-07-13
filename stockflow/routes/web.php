<?php

use App\Http\Controllers\Web\Admin\AccessWindowController;
use App\Http\Controllers\Web\Admin\AuditLogController;
use App\Http\Controllers\Web\Admin\PermissionMatrixController;
use App\Http\Controllers\Web\Admin\RoleController;
use App\Http\Controllers\Web\Admin\UserController;
use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Auth\RegisterController;
use App\Http\Controllers\Web\Catalog\CategoryController;
use App\Http\Controllers\Web\Catalog\PriceListController;
use App\Http\Controllers\Web\Catalog\PriceListItemController;
use App\Http\Controllers\Web\Catalog\ProductController;
use App\Http\Controllers\Web\Catalog\SupplierController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\Import\ImportController;
use App\Http\Controllers\Web\Procurement\PurchaseOrderController;
use App\Http\Controllers\Web\Procurement\QuoteController;
use App\Http\Controllers\Web\Reports\ReportController;
use App\Http\Controllers\Web\Sales\CheckoutController;
use App\Http\Controllers\Web\Sales\OrderController;
use App\Http\Controllers\Web\Sales\PaymentController;
use App\Http\Controllers\Web\Stock\StockAdjustmentController;
use App\Http\Controllers\Web\Stock\StockLevelController;
use App\Http\Controllers\Web\Stock\StockMovementController;
use App\Http\Controllers\Web\Stock\StockReconciliationController;
use App\Http\Controllers\Web\Stock\StockTransferController;
use App\Http\Controllers\Web\Storefront\CartController;
use App\Http\Controllers\Web\Storefront\CategoryBrowseController;
use App\Http\Controllers\Web\Storefront\HomeController;
use App\Http\Controllers\Web\Storefront\ProductBrowseController;
use App\Http\Controllers\Web\Storefront\SearchController;
use App\Support\Access\AccessAction;
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

// Public storefront: no `auth`, no `permission` middleware anywhere in this
// section — guests must reach all of it with no login (see Guest rules
// #1-#7 in the storefront requirements). Staff/business users still reach
// `/dashboard` explicitly (post-login redirect target); `/` itself is the
// storefront for everyone, guest or authenticated.
Route::get('/', HomeController::class)->name('home');

// Adaptive throttling only (public_read profile) — never `abac`, per
// requirement #4: public storefront browsing must never be broken by
// working-hour/access-window rules.
Route::middleware('adaptive.throttle:public_read,'.AccessAction::STOREFRONT_BROWSE)->group(function () {
    Route::get('/products', [ProductBrowseController::class, 'index'])->name('storefront.products.index');
    Route::get('/products/{sku}', [ProductBrowseController::class, 'show'])->name('storefront.products.show');
    Route::get('/categories/{category:slug}', [CategoryBrowseController::class, 'show'])->name('storefront.categories.show');
    Route::get('/search', [SearchController::class, 'index'])->name('storefront.search');
});

// Session cart: also guest-accessible (Guest rules #8-#11). Never reserves
// stock or writes anything but the session — see CartService's docblock.
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::middleware(['throttle:cart', 'adaptive.throttle:cart_mutation,'.AccessAction::CART_MUTATE])->group(function () {
    Route::post('/cart/items', [CartController::class, 'store'])->name('cart.items.store');
    Route::patch('/cart/items/{item}', [CartController::class, 'update'])->name('cart.items.update');
    Route::delete('/cart/items/{item}', [CartController::class, 'destroy'])->name('cart.items.destroy');
    Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');
});

// Checkout entry gate: `checkout.guard` redirects an unauthenticated
// visitor to /login with a specific flash message (Guest rule #18) before
// CheckoutController (and its own `sale.create` OrderPolicy check) ever
// runs — see EnsureCheckoutIsAuthenticated's docblock for why this is a
// middleware rather than a wrapper controller.
Route::middleware(['checkout.guard', 'adaptive.throttle:checkout,'.AccessAction::CHECKOUT_CONFIRM])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'create'])->name('checkout.create');
    Route::post('/checkout', [CheckoutController::class, 'store'])
        ->name('checkout.store')
        ->middleware(['throttle:checkout', 'abac:'.AccessAction::CHECKOUT_CONFIRM.',sale.create']);
});

// `guest` middleware redirects an already-authenticated visitor to
// /dashboard automatically (Illuminate\Auth\Middleware\RedirectIfAuthenticated
// checks for a `dashboard` route first) — that's Register rule #2, no
// extra check needed in RegisterController itself.
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])
        ->middleware(['throttle:login', 'adaptive.throttle:auth,'.AccessAction::AUTH_LOGIN]);

    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])
        ->middleware(['throttle:login', 'adaptive.throttle:auth,'.AccessAction::AUTH_REGISTER]);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::prefix('admin')->name('admin.')->middleware('adaptive.throttle:admin,'.AccessAction::ADMIN_MANAGE)->group(function () {
        Route::middleware('permission:user.manage')->group(function () {
            Route::get('/users', [UserController::class, 'index'])->name('users.index');
            Route::get('/users/{user}/roles', [UserController::class, 'editRoles'])->name('users.edit-roles');
        });

        Route::put('/users/{user}/roles', [UserController::class, 'updateRoles'])
            ->name('users.update-roles')
            ->middleware(['permission:role.manage', 'abac:'.AccessAction::ADMIN_MANAGE.',user.manage']);

        Route::middleware('permission:role.manage')->group(function () {
            Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
            Route::put('/roles/{role}/permissions', [RoleController::class, 'updatePermissions'])
                ->name('roles.update-permissions')
                ->middleware('abac:'.AccessAction::ADMIN_MANAGE.',role.manage');
            Route::get('/permissions/matrix', [PermissionMatrixController::class, 'index'])->name('permissions.matrix');
        });

        Route::get('/audit-log', [AuditLogController::class, 'index'])
            ->name('audit-log.index')->middleware('permission:audit.read');

        Route::middleware('permission:access.manage')->prefix('access')->name('access.')->group(function () {
            Route::get('/company-hours', [AccessWindowController::class, 'companyHours'])->name('company-hours.index');
            Route::put('/company-hours', [AccessWindowController::class, 'updateCompanyHours'])->name('company-hours.update');
            Route::get('/permission-windows', [AccessWindowController::class, 'permissionWindows'])->name('permission-windows.index');
            Route::post('/permission-windows', [AccessWindowController::class, 'storePermissionWindow'])->name('permission-windows.store');
            Route::put('/permission-windows/{window}', [AccessWindowController::class, 'updatePermissionWindow'])->name('permission-windows.update');
            Route::delete('/permission-windows/{window}', [AccessWindowController::class, 'destroyPermissionWindow'])->name('permission-windows.destroy');
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
            ->name('adjustments.store')->middleware([
                'permission:stock.move',
                'warehouse.scope:stock.move',
                'adaptive.throttle:stock,'.AccessAction::STOCK_MOVE,
                'abac:'.AccessAction::STOCK_MOVE.',stock.move',
            ]);

        Route::get('/transfers/create', [StockTransferController::class, 'create'])
            ->name('transfers.create')->middleware('permission:stock.transfer');
        Route::post('/transfers', [StockTransferController::class, 'store'])
            ->name('transfers.store')->middleware([
                'permission:stock.transfer',
                'warehouse.scope:stock.transfer',
                'adaptive.throttle:stock,'.AccessAction::STOCK_TRANSFER,
                'abac:'.AccessAction::STOCK_TRANSFER.',stock.transfer',
            ]);

        Route::get('/reconcile', [StockReconciliationController::class, 'show'])
            ->name('reconcile.show')->middleware('permission:stock.move|audit.read');
        Route::post('/reconcile', [StockReconciliationController::class, 'run'])
            ->name('reconcile.run')->middleware('permission:stock.move|audit.read');
    });

    // B2C "my orders" — a customer action gated by `sale.create`. Cart and
    // checkout routes now live in the public storefront section above
    // (guest-accessible; checkout itself is gated by `checkout.guard`, not
    // `permission:sale.create`, since a guest has no permissions at all).
    // /orders/{order} and /payments/{payment} are reachable by either the
    // owning customer OR staff holding `payment.settle` (they need to see
    // an order to settle its COD/placeholder payment), so those two stay
    // behind plain `auth` with OrderPolicy::view() / PaymentPolicy::view()
    // (checked in the controllers) doing the real record-level gate. See
    // docs/project/canonical-decisions.md §2 and app/Services/OrderService.php.
    Route::middleware('permission:sale.create')->group(function () {
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    });

    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/payments', [PaymentController::class, 'index'])
        ->name('payments.index')->middleware('permission:payment.settle');
    Route::get('/payments/{payment}', [PaymentController::class, 'show'])->name('payments.show');
    Route::get('/payments/{payment}/fake-gateway', [PaymentController::class, 'fakeGateway'])
        ->name('payments.fake-gateway');
    Route::post('/payments/{payment}/fake-gateway', [PaymentController::class, 'simulateFakeGateway'])
        ->name('payments.fake-gateway.store');

    Route::middleware('permission:import.run')->prefix('imports')->name('imports.')->group(function () {
        Route::get('/', [ImportController::class, 'index'])->name('index');
        Route::get('/create', [ImportController::class, 'create'])->name('create');
        Route::post('/', [ImportController::class, 'store'])
            ->name('store')
            ->middleware([
                'adaptive.throttle:admin,'.AccessAction::IMPORT_RUN,
                'abac:'.AccessAction::IMPORT_RUN.',import.run',
            ]);
        Route::get('/{importBatch}/errors', [ImportController::class, 'errorReport'])->name('errors');
        Route::get('/{importBatch}/errors/download', [ImportController::class, 'downloadErrorReport'])->name('errors.download');
        Route::get('/{importBatch}', [ImportController::class, 'show'])->name('show');
    });

    // Staff-only actions (payment.settle) — record-level enforcement is in
    // OrderPolicy::fulfill() / PaymentPolicy::settle(), this is the coarse
    // route gate.
    Route::post('/orders/{order}/fulfill', [OrderController::class, 'fulfill'])
        ->name('orders.fulfill')->middleware('permission:payment.settle');
    Route::post('/payments/{payment}/settle', [PaymentController::class, 'settle'])
        ->name('payments.settle')->middleware([
            'permission:payment.settle',
            'adaptive.throttle:payment,'.AccessAction::PAYMENT_SETTLE,
            'abac:'.AccessAction::PAYMENT_SETTLE.',payment.settle',
        ]);

    // B2B procurement module. Visibility across the whole /procurement
    // group is gated broadly to anyone who could plausibly need it
    // (Business Buyer requesting/owning quotes+POs, Vendor/Inventory
    // Manager pricing quotes, an approver, or someone settling payments);
    // QuotePolicy/PurchaseOrderPolicy (checked in the controllers) do the
    // real "own account" / "own pricing context" record-level scoping. See
    // app/Services/QuoteService.php and PurchaseOrderService.php for the
    // full draft -> sent -> accepted -> pending_approval -> approved ->
    // fulfilled state machine.
    Route::middleware('permission:quote.request|quote.price|po.approve|payment.settle')
        ->prefix('procurement')->name('procurement.')->group(function () {
            // Route order matters: /quotes/create before /quotes/{quote}.
            Route::get('/quotes', [QuoteController::class, 'index'])->name('quotes.index');
            Route::get('/quotes/create', [QuoteController::class, 'create'])
                ->name('quotes.create')->middleware('permission:quote.request');
            Route::post('/quotes', [QuoteController::class, 'store'])
                ->name('quotes.store')->middleware('permission:quote.request');
            Route::get('/quotes/{quote}/price', [QuoteController::class, 'priceCreate'])
                ->name('quotes.price.create')->middleware('permission:quote.price');
            Route::post('/quotes/{quote}/price', [QuoteController::class, 'priceStore'])
                ->name('quotes.price.store')->middleware('permission:quote.price');
            Route::post('/quotes/{quote}/accept', [QuoteController::class, 'accept'])
                ->name('quotes.accept')->middleware('permission:quote.request');
            Route::post('/quotes/{quote}/reject', [QuoteController::class, 'reject'])
                ->name('quotes.reject')->middleware('permission:quote.request');
            Route::get('/quotes/{quote}', [QuoteController::class, 'show'])->name('quotes.show');

            Route::get('/purchase-orders', [PurchaseOrderController::class, 'index'])->name('purchase-orders.index');
            Route::get('/purchase-orders/{purchaseOrder}/approve', [PurchaseOrderController::class, 'approveCreate'])
                ->name('purchase-orders.approve.create')->middleware('permission:po.approve');
            Route::post('/purchase-orders/{purchaseOrder}/approve', [PurchaseOrderController::class, 'approve'])
                ->name('purchase-orders.approve.store')->middleware([
                    'permission:po.approve',
                    'adaptive.throttle:admin,'.AccessAction::PO_APPROVE,
                    'abac:'.AccessAction::PO_APPROVE.',po.approve',
                ]);
            Route::post('/purchase-orders/{purchaseOrder}/reject', [PurchaseOrderController::class, 'reject'])
                ->name('purchase-orders.reject')->middleware('permission:po.approve');
            Route::get('/purchase-orders/{purchaseOrder}/bank-transfer', [PurchaseOrderController::class, 'bankTransferCreate'])
                ->name('purchase-orders.bank-transfer.create')->middleware('permission:payment.settle');
            Route::post('/purchase-orders/{purchaseOrder}/bank-transfer', [PurchaseOrderController::class, 'bankTransferStore'])
                ->name('purchase-orders.bank-transfer.store')->middleware('permission:payment.settle');
            Route::post('/purchase-orders/{purchaseOrder}/close', [PurchaseOrderController::class, 'close'])
                ->name('purchase-orders.close')->middleware('permission:payment.settle');
            Route::get('/purchase-orders/{purchaseOrder}', [PurchaseOrderController::class, 'show'])
                ->name('purchase-orders.show');
        });

    // Reports (modules 5–9). Each gated by whichever existing permission
    // maps to that report's domain — no new permissions invented. See
    // requirement #7: audit.read/user.manage/role.manage/stock.read/
    // payment.settle "where relevant".
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/low-stock', [ReportController::class, 'lowStock'])
            ->name('low-stock')->middleware('permission:stock.read');
        Route::get('/stock-movements', [ReportController::class, 'stockMovements'])
            ->name('stock-movements')->middleware('permission:stock.read');
        Route::get('/sales', [ReportController::class, 'sales'])
            ->name('sales')->middleware('permission:payment.settle');
        Route::get('/payments', [ReportController::class, 'payments'])
            ->name('payments')->middleware('permission:payment.settle');
        Route::get('/imports', [ReportController::class, 'imports'])
            ->name('imports')->middleware('permission:import.run|audit.read');
    });
});
