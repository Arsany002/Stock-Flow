This file is a merged representation of a subset of the codebase, containing files not matching ignore patterns, combined into a single document by Repomix.
The content has been processed where content has been compressed (code blocks are separated by ⋮---- delimiter).

# File Summary

## Purpose
This file contains a packed representation of a subset of the repository's contents that is considered the most important context.
It is designed to be easily consumable by AI systems for analysis, code review,
or other automated processes.

## File Format
The content is organized as follows:
1. This summary section
2. Repository information
3. Directory structure
4. Repository files (if enabled)
5. Multiple file entries, each consisting of:
  a. A header with the file path (## File: path/to/file)
  b. The full contents of the file in a code block

## Usage Guidelines
- This file should be treated as read-only. Any changes should be made to the
  original repository files, not this packed version.
- When processing this file, use the file path to distinguish
  between different files in the repository.
- Be aware that this file may contain sensitive information. Handle it with
  the same level of security as you would the original repository.

## Notes
- Some files may have been excluded based on .gitignore rules and Repomix's configuration
- Binary files are not included in this packed representation. Please refer to the Repository Structure section for a complete list of file paths, including binary files
- Files matching these patterns are excluded: vendor/**, node_modules/**, .git/**, storage/**, bootstrap/cache/**, public/build/**, .env, .env.*, *.log
- Files matching patterns in .gitignore are excluded
- Files matching default ignore patterns are excluded
- Content has been compressed - code blocks are separated by ⋮---- delimiter
- Files are sorted by Git change count (files with more changes are at the bottom)

# Directory Structure
```
.github/
  workflows/
    ci.yml
app/
  Auth/
    ApiClientPrincipal.php
  Console/
    Commands/
      StockReconcileCommand.php
      StockReleaseExpiredReservationsCommand.php
  Enums/
    ApprovalDecision.php
    ImportEntity.php
    ImportRowStatus.php
    ImportStatus.php
    MovementType.php
    OrderChannel.php
    OrderStatus.php
    PaymentMethod.php
    PaymentStatus.php
    PermissionName.php
    PriceListType.php
    PurchaseOrderStatus.php
    QuoteStatus.php
    UserRole.php
  Exceptions/
    CreditLimitExceededException.php
    DomainException.php
    ImportValidationException.php
    InvalidStateTransitionException.php
    OutOfStockException.php
    PaymentVerificationException.php
    PricingUnavailableException.php
    ProductUnavailableException.php
    UnauthorizedWarehouseException.php
  Http/
    Controllers/
      Api/
        V1/
          .gitkeep
          ApiController.php
          CatalogController.php
          PaymentController.php
          PurchaseOrderController.php
          QuoteController.php
          StockAvailabilityController.php
      Web/
        Admin/
          AuditLogController.php
          PermissionMatrixController.php
          RoleController.php
          UserController.php
        Auth/
          LoginController.php
        Catalog/
          CategoryController.php
          PriceListController.php
          PriceListItemController.php
          ProductController.php
          SupplierController.php
        Import/
          ImportController.php
        Procurement/
          PurchaseOrderController.php
          QuoteController.php
        Reports/
          ReportController.php
        Sales/
          CheckoutController.php
          OrderController.php
          PaymentController.php
        Stock/
          StockAdjustmentController.php
          StockLevelController.php
          StockMovementController.php
          StockReconciliationController.php
          StockTransferController.php
        Storefront/
          CartController.php
          CategoryBrowseController.php
          HomeController.php
          ProductBrowseController.php
          SearchController.php
        DashboardController.php
      Webhooks/
        .gitkeep
        FakeGatewayWebhookController.php
        FawryWebhookController.php
        PaymobWebhookController.php
      Controller.php
    Middleware/
      AuthenticateApiClientCredentials.php
      EnsureApiRequestsJson.php
      EnsureCheckoutIsAuthenticated.php
      HandleInertiaRequests.php
      SecurityHeaders.php
      WarehouseScopeMiddleware.php
    Requests/
      Admin/
        UpdateRolePermissionsRequest.php
        UpdateUserRolesRequest.php
      Api/
        V1/
          AcceptPurchaseOrderRequest.php
          ListPaymentsRequest.php
          ListProductsRequest.php
          ListPurchaseOrdersRequest.php
          ListQuotesRequest.php
          StockAvailabilityRequest.php
          StoreBankTransferProofRequest.php
          StoreQuoteRequest.php
      Auth/
        LoginRequest.php
      Catalog/
        StoreCategoryRequest.php
        StorePriceListItemRequest.php
        StorePriceListRequest.php
        StoreProductRequest.php
        StoreSupplierRequest.php
        UpdatePriceListItemRequest.php
        UpdateProductRequest.php
      Import/
        StoreImportRequest.php
      Procurement/
        ApprovePurchaseOrderRequest.php
        PriceQuoteRequest.php
        RejectPurchaseOrderRequest.php
        StoreBankTransferSettlementRequest.php
        StoreQuoteRequest.php
      Sales/
        StoreCheckoutRequest.php
      Stock/
        StoreStockAdjustmentRequest.php
        StoreStockTransferRequest.php
      Storefront/
        AddToCartRequest.php
        UpdateCartItemRequest.php
    Resources/
      Api/
        V1/
          PaymentResource.php
          ProductResource.php
          PurchaseOrderResource.php
          QuoteResource.php
          StockAvailabilityResource.php
  Imports/
    CatalogRowsImport.php
  Jobs/
    ImportCatalogJob.php
  Models/
    ActivityLog.php
    BusinessAccount.php
    Category.php
    ImportBatch.php
    ImportRow.php
    Order.php
    OrderItem.php
    Payment.php
    Permission.php
    PoApproval.php
    PoItem.php
    PriceList.php
    PriceListItem.php
    Product.php
    PurchaseOrder.php
    Quote.php
    QuoteItem.php
    Role.php
    StockLevel.php
    StockMovement.php
    Supplier.php
    Team.php
    User.php
    Warehouse.php
  Payments/
    BankTransferGateway.php
    CodGateway.php
    FakeGateway.php
    FawryGateway.php
    PaymentGateway.php
    PaymobGateway.php
  Policies/
    OrderPolicy.php
    PaymentPolicy.php
    PriceListPolicy.php
    ProductPolicy.php
    PurchaseOrderPolicy.php
    QuotePolicy.php
    StockPolicy.php
  Providers/
    AppServiceProvider.php
    HorizonServiceProvider.php
    RepositoryServiceProvider.php
  Repositories/
    Contracts/
      AuditLogRepositoryInterface.php
      BusinessAccountRepositoryInterface.php
      CategoryRepositoryInterface.php
      ImportRepositoryInterface.php
      OrderRepositoryInterface.php
      PaymentRepositoryInterface.php
      PriceListRepositoryInterface.php
      ProductRepositoryInterface.php
      PurchaseOrderRepositoryInterface.php
      QuoteRepositoryInterface.php
      StockRepositoryInterface.php
      SupplierRepositoryInterface.php
      WarehouseRepositoryInterface.php
    AuditLogRepository.php
    BusinessAccountRepository.php
    CategoryRepository.php
    ImportRepository.php
    OrderRepository.php
    PaymentRepository.php
    PriceListRepository.php
    ProductRepository.php
    PurchaseOrderRepository.php
    QuoteRepository.php
    StockRepository.php
    SupplierRepository.php
    WarehouseRepository.php
  Services/
    AuditService.php
    AuthService.php
    CartService.php
    CatalogService.php
    DashboardService.php
    ImportService.php
    OrderService.php
    PaymentService.php
    PurchaseOrderService.php
    QuoteService.php
    ReportService.php
    RoleAssignmentService.php
    RolePermissionService.php
    StockAvailabilityService.php
    StockService.php
    StorefrontCatalogService.php
  Support/
    WarehouseAccess.php
bootstrap/
  app.php
  providers.php
config/
  app.php
  auth.php
  cache.php
  database.php
  filesystems.php
  horizon.php
  laratrust_seeder.php
  laratrust.php
  logging.php
  mail.php
  passport.php
  queue.php
  services.php
  session.php
database/
  factories/
    BusinessAccountFactory.php
    CategoryFactory.php
    OrderFactory.php
    PaymentFactory.php
    PriceListFactory.php
    PriceListItemFactory.php
    ProductFactory.php
    PurchaseOrderFactory.php
    QuoteFactory.php
    StockLevelFactory.php
    SupplierFactory.php
    UserFactory.php
    WarehouseFactory.php
  migrations/
    0001_01_01_000000_create_users_table.php
    0001_01_01_000001_create_cache_table.php
    0001_01_01_000002_create_jobs_table.php
    2026_07_06_235123_laratrust_setup_tables.php
    2026_07_07_003001_create_business_accounts_table.php
    2026_07_07_003002_create_warehouses_table.php
    2026_07_07_003003_create_suppliers_table.php
    2026_07_07_003004_create_categories_table.php
    2026_07_07_003005_create_products_table.php
    2026_07_07_003006_create_price_lists_table.php
    2026_07_07_003007_create_price_list_items_table.php
    2026_07_07_003008_create_stock_movements_table.php
    2026_07_07_003009_create_stock_levels_table.php
    2026_07_07_003010_create_orders_table.php
    2026_07_07_003011_create_order_items_table.php
    2026_07_07_003012_create_quotes_table.php
    2026_07_07_003013_create_quote_items_table.php
    2026_07_07_003014_create_purchase_orders_table.php
    2026_07_07_003015_create_po_items_table.php
    2026_07_07_003016_create_po_approvals_table.php
    2026_07_07_003017_create_payments_table.php
    2026_07_07_003018_create_import_batches_table.php
    2026_07_07_003019_create_import_rows_table.php
    2026_07_07_003020_create_activity_log_table.php
    2026_07_07_115907_add_user_id_to_suppliers_table.php
    2026_07_07_181917_add_warehouse_id_to_teams_table.php
    2026_07_07_222101_create_oauth_auth_codes_table.php
    2026_07_07_222102_create_oauth_access_tokens_table.php
    2026_07_07_222103_create_oauth_refresh_tokens_table.php
    2026_07_07_222104_create_oauth_clients_table.php
    2026_07_07_222105_create_oauth_device_codes_table.php
    2026_07_07_222923_add_fake_to_payments_method_enum.php
    2026_07_08_000001_rename_fake_payment_method_to_fake_gateway.php
    2026_07_08_000002_add_warehouses_and_file_metadata_to_import_batches.php
    2026_07_08_020718_add_report_indexes_to_payments_table.php
    2026_07_08_020719_add_report_indexes_to_import_batches_table.php
    2026_07_08_020720_add_report_indexes_to_activity_log_table.php
  seeders/
    DatabaseSeeder.php
    DemoBusinessAccountSeeder.php
    DemoCatalogSeeder.php
    DemoUserSeeder.php
    DemoWarehouseSeeder.php
    RolePermissionSeeder.php
  .gitignore
docker/
  entrypoint.sh
  php.ini
docs/
  technical/
    cache.md
    indexing.md
lang/
  en/
    auth.php
public/
  .htaccess
  favicon.ico
  index.php
  robots.txt
resources/
  css/
    app.css
  js/
    Components/
      AddToCartButton.jsx
      Breadcrumbs.jsx
      Button.jsx
      CartSummary.jsx
      CategoryNav.jsx
      FlashMessage.jsx
      Input.jsx
      Pagination.jsx
      PermissionGate.jsx
      PriceLabel.jsx
      ProductCard.jsx
      QuantitySelector.jsx
      Select.jsx
      StockBadge.jsx
      Table.jsx
    Layouts/
      AppLayout.jsx
      GuestLayout.jsx
      StorefrontLayout.jsx
    Pages/
      Admin/
        AuditLog/
          Index.jsx
        Permissions/
          Matrix.jsx
        Roles/
          Index.jsx
        Users/
          Edit.jsx
          Index.jsx
      Auth/
        Login.jsx
      Catalog/
        Categories/
          Index.jsx
        PriceLists/
          Index.jsx
        Products/
          Create.jsx
          Edit.jsx
          Index.jsx
          Show.jsx
        Suppliers/
          Index.jsx
      Errors/
        Forbidden.jsx
        NotFound.jsx
      Import/
        Create.jsx
        ErrorReport.jsx
        Index.jsx
        Show.jsx
      Payments/
        BankTransferReview.jsx
        FakeGateway.jsx
        Index.jsx
        Show.jsx
      Procurement/
        PurchaseOrders/
          Approve.jsx
          BankTransferSettlement.jsx
          Index.jsx
          Show.jsx
        Quotes/
          Create.jsx
          Index.jsx
          Price.jsx
          Show.jsx
      Reports/
        Imports.jsx
        LowStock.jsx
        Payments.jsx
        Sales.jsx
        StockMovements.jsx
      Sales/
        Checkout/
          Create.jsx
        Orders/
          Index.jsx
          Show.jsx
        Payments/
          Show.jsx
      Stock/
        Adjustments/
          Create.jsx
        Levels/
          Index.jsx
        Movements/
          Index.jsx
        Reconciliation/
          Show.jsx
        Transfers/
          Create.jsx
      Storefront/
        Cart/
          Show.jsx
        Categories/
          Show.jsx
        Products/
          Index.jsx
          Show.jsx
        Home.jsx
        Search.jsx
      Dashboard.jsx
    app.jsx
  views/
    vendor/
      laratrust/
        panel/
          permissions/
            index.blade.php
          roles/
            index.blade.php
            show.blade.php
          roles-assignment/
            edit.blade.php
            index.blade.php
          edit.blade.php
          layout.blade.php
          pagination.blade.php
    app.blade.php
routes/
  api.php
  console.php
  web.php
  webhooks.php
tests/
  Concerns/
    SetsUpCheckoutFixtures.php
    SetsUpProcurementFixtures.php
    UsesRealMysqlDatabase.php
  Concurrency/
    reserve_once.php
  Feature/
    Admin/
      AuditLogTest.php
      AuthorizationTest.php
      HorizonAccessTest.php
      PaymentSettlementAuditTest.php
      PurchaseOrderApprovalAuditTest.php
      RolePermissionManagementTest.php
      SeededSuperAdminAccessTest.php
      UserRoleManagementTest.php
    Api/
      V1/
        ExternalB2bApiTest.php
    Auth/
      AuthenticationTest.php
    Catalog/
      CatalogCacheTest.php
      PriceListItemOwnershipTest.php
      ProductManagementTest.php
    Import/
      ImportWorkflowTest.php
    Payments/
      PaymentWebhookTest.php
    Procurement/
      BankTransferSettlementTest.php
      PurchaseOrderApprovalTest.php
      PurchaseOrderAuthorizationTest.php
      QuoteWorkflowTest.php
    Reports/
      ReportsTest.php
    Sales/
      CheckoutTest.php
      CodReservationTest.php
      OrderAuthorizationTest.php
      ReservationExpiryTest.php
    Schema/
      DatabaseSchemaTest.php
    Stock/
      StockConcurrencyTest.php
      StockLevelCacheTest.php
      StockWarehouseScopeTest.php
    Storefront/
      CheckoutGateTest.php
      GuestCartTest.php
      PublicBrowsingTest.php
      StorefrontCacheTest.php
    DashboardTest.php
    ExampleTest.php
    RateLimitingTest.php
    SecurityHeadersTest.php
  Unit/
    Services/
      ServiceContainerResolutionTest.php
      StockServiceTest.php
    ExampleTest.php
  TestCase.php
.editorconfig
.gitattributes
.gitignore
.npmrc
artisan
composer.json
docker-compose.yml
Dockerfile
Makefile
package.json
phpstan-baseline.neon
phpstan.neon
phpunit.xml
pint.json
README.md
vite.config.js
```

# Files

## File: .github/workflows/ci.yml
````yaml
name: CI

on:
  push:
    branches: [main]
  pull_request:

jobs:
  quality:
    name: Style, static analysis, and tests
    runs-on: ubuntu-latest

    # Only a handful of tests need real MySQL/Redis (schema/index invariants,
    # the concurrency proof, and one Redis-serialization round-trip test —
    # see tests/Concerns/UsesRealMysqlDatabase.php and CLAUDE.md's gotcha on
    # why SQLite can't stand in for those). The rest of the suite runs
    # against SQLite in-memory (phpunit.xml forces DB_CONNECTION=sqlite),
    # but these services need to exist for the full suite to pass.
    services:
      mysql:
        image: mysql:8.0
        env:
          MYSQL_ROOT_PASSWORD: stockflow_root
          MYSQL_DATABASE: stockflow
          MYSQL_USER: stockflow
          MYSQL_PASSWORD: stockflow
        ports:
          - 3306:3306
        options: >-
          --health-cmd="mysqladmin ping -h 127.0.0.1 -uroot -pstockflow_root"
          --health-interval=10s
          --health-timeout=5s
          --health-retries=10
      redis:
        image: redis:7-alpine
        ports:
          - 6379:6379
        options: >-
          --health-cmd="redis-cli ping"
          --health-interval=10s
          --health-timeout=5s
          --health-retries=10

    env:
      DB_HOST: 127.0.0.1
      DB_PORT: 3306
      DB_DATABASE: stockflow
      DB_USERNAME: stockflow
      DB_PASSWORD: stockflow
      DB_ROOT_PASSWORD: stockflow_root
      DB_TEST_DATABASE: stockflow_testing
      REDIS_HOST: 127.0.0.1
      REDIS_PORT: 6379

    steps:
      - uses: actions/checkout@v4

      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: '8.3'
          extensions: mbstring, xml, ctype, fileinfo, tokenizer, pdo_mysql, pdo_sqlite, redis, bcmath, gd, zip, curl, intl
          coverage: none

      - name: Setup Node
        uses: actions/setup-node@v4
        with:
          node-version: '20'
          cache: npm

      - name: Copy .env
        run: cp .env.example .env

      - name: Install PHP dependencies
        run: composer install --no-interaction --prefer-dist --no-progress

      - name: Generate app key
        run: php artisan key:generate

      - name: Install npm dependencies
        run: npm ci

      - name: Build frontend assets
        run: npm run build

      - name: Pint (code style)
        run: composer run pint-test

      - name: Larastan (static analysis)
        run: composer run stan

      - name: PHPUnit
        run: php artisan test
````

## File: app/Auth/ApiClientPrincipal.php
````php
namespace App\Auth;
⋮----
use App\Enums\PermissionName;
use App\Models\User;
use BackedEnum;
use Laravel\Passport\Client;
⋮----
class ApiClientPrincipal extends User
⋮----
public function __construct(private readonly ?Client $apiClient = null)
⋮----
parent::__construct([
⋮----
public function getAuthIdentifier(): mixed
⋮----
public function hasRole(
⋮----
public function hasPermission(
⋮----
$scope = $this->scopeForPermission($item);
$hasPermission = $scope !== null && $this->tokenCan($scope);
⋮----
public function ability(
⋮----
return $this->hasPermission($permissions, $team, (bool) ($options['validate_all'] ?? false));
⋮----
private function scopeForPermission(string|BackedEnum $permission): ?string
````

## File: app/Console/Commands/StockReconcileCommand.php
````php
namespace App\Console\Commands;
⋮----
use App\Models\Product;
use App\Models\Warehouse;
use App\Services\StockService;
use Illuminate\Console\Command;
⋮----
/**
 * CI-checkable proof that stock_levels (the projection) matches
 * stock_movements (the immutable ledger) — see
 * docs/project/canonical-decisions.md §6 and StockService::reconcile().
 */
class StockReconcileCommand extends Command
⋮----
protected $signature = 'stock:reconcile {--product= : Limit to one product UUID} {--warehouse= : Limit to one warehouse UUID}';
⋮----
protected $description = 'Prove stock_levels matches the immutable stock_movements ledger; exits non-zero on any mismatch.';
⋮----
public function handle(StockService $stock): int
⋮----
$product = $this->option('product') ? Product::query()->find($this->option('product')) : null;
$warehouse = $this->option('warehouse') ? Warehouse::query()->find($this->option('warehouse')) : null;
⋮----
$results = $stock->reconcile($product, $warehouse);
⋮----
if ($results->isEmpty()) {
$this->info('No (product, warehouse) pairs to reconcile.');
⋮----
$this->table(
⋮----
$results->map(fn (array $row) => [
⋮----
])->all()
⋮----
$mismatches = $results->reject(fn (array $row) => $row['on_hand_matches'] && $row['reserved_matches']);
⋮----
if ($mismatches->isEmpty()) {
$this->info("Reconciliation passed — all {$results->count()} row(s) match.");
⋮----
$this->error("Reconciliation FAILED — {$mismatches->count()} of {$results->count()} row(s) mismatch.");
````

## File: app/Console/Commands/StockReleaseExpiredReservationsCommand.php
````php
namespace App\Console\Commands;
⋮----
use App\Services\OrderService;
use Illuminate\Console\Command;
⋮----
/**
 * Releases every B2C order reservation whose `orders.reserved_until` has
 * passed without payment — the counterpart to StockService's "no oversell"
 * guarantee (an abandoned/unpaid checkout can't hold stock hostage
 * indefinitely). Each release goes through OrderService::cancel(), which
 * calls StockService::release() per line inside its own transaction, so one
 * bad row can't block the rest of the batch.
 *
 * Registered on the scheduler (routes/console.php) to run every minute —
 * see requirement #6: the scheduled *job* wiring is intentionally minimal
 * (a plain Schedule::command(), no dedicated queued Job class/retry/backoff
 * policy), since the release logic itself needed to be fully correct, not
 * the scheduling infrastructure around it.
 */
class StockReleaseExpiredReservationsCommand extends Command
⋮----
protected $signature = 'stock:release-expired-reservations';
⋮----
protected $description = 'Release stock reservations for B2C orders whose reserved_until has passed unpaid.';
⋮----
public function handle(OrderService $orders): int
⋮----
$released = $orders->releaseExpiredReservations();
⋮----
$this->info("Released {$released} expired reservation(s).");
````

## File: app/Enums/ApprovalDecision.php
````php
namespace App\Enums;
⋮----
/**
 * po_approvals.decision.
 */
enum ApprovalDecision: string
⋮----
public function label(): string
````

## File: app/Enums/ImportEntity.php
````php
namespace App\Enums;
⋮----
/**
 * import_batches.entity — the catalogable data types the Excel importer
 * supports (FR-7.1).
 */
enum ImportEntity: string
⋮----
public function label(): string
````

## File: app/Enums/ImportRowStatus.php
````php
namespace App\Enums;
⋮----
/**
 * import_rows.status — per-row outcome, distinct from the batch-level
 * ImportStatus (a batch can be "completed" while individual rows are
 * "failed" — FR-7.3: rows validate individually and don't fail the file).
 */
enum ImportRowStatus: string
⋮----
public function label(): string
````

## File: app/Enums/ImportStatus.php
````php
namespace App\Enums;
⋮----
/**
 * import_batches.status — overall batch progress for a queued Excel import.
 */
enum ImportStatus: string
⋮----
public function label(): string
````

## File: app/Enums/MovementType.php
````php
namespace App\Enums;
⋮----
/**
 * stock_movements.type — the only mutations ever applied to inventory.
 * See docs/project/canonical-decisions.md §6 (immutable, insert-only ledger).
 */
enum MovementType: string
⋮----
public function label(): string
````

## File: app/Enums/OrderChannel.php
````php
namespace App\Enums;
⋮----
/**
 * orders.channel — single value in v1 (B2C only; B2B goes through
 * quotes/purchase_orders instead), kept as an enum for forward-compatibility.
 */
enum OrderChannel: string
⋮----
public function label(): string
````

## File: app/Enums/OrderStatus.php
````php
namespace App\Enums;
⋮----
/**
 * orders.status — B2C order state machine:
 * pending → reserved → confirmed → fulfilled; reserved → cancelled.
 */
enum OrderStatus: string
⋮----
public function label(): string
````

## File: app/Enums/PaymentMethod.php
````php
namespace App\Enums;
⋮----
/**
 * payments.method — Egyptian payment integrations (PRD §10.1).
 */
enum PaymentMethod: string
⋮----
public function label(): string
⋮----
/**
     * Paymob and Fawry have no real integration yet (see app/Payments) — a
     * checkout using either leaves the payment `pending` for manual
     * settlement instead of processing anything. Cod and FakeGateway are both
     * wired: Cod stays `pending` until a staff delivery/settlement action;
     * FakeGateway uses a simulated verified callback (demo/test only).
     */
public function isPlaceholder(): bool
````

## File: app/Enums/PaymentStatus.php
````php
namespace App\Enums;
⋮----
/**
 * payments.status — a reservation only converts to sale_out on a verified,
 * idempotent `paid` event (see canonical-decisions.md).
 */
enum PaymentStatus: string
⋮----
public function label(): string
````

## File: app/Enums/PermissionName.php
````php
namespace App\Enums;
⋮----
/**
 * The permission catalog from the Enterprise PRD §3 permission matrix.
 * Values are the Laratrust `permissions.name` slugs.
 */
enum PermissionName: string
⋮----
public function label(): string
````

## File: app/Enums/PriceListType.php
````php
namespace App\Enums;
⋮----
/**
 * price_lists.type — retail (B2C) vs. tiered (B2B) pricing.
 */
enum PriceListType: string
⋮----
public function label(): string
````

## File: app/Enums/PurchaseOrderStatus.php
````php
namespace App\Enums;
⋮----
/**
 * purchase_orders.status — pending_approval → approved → fulfilled → closed;
 * pending_approval → rejected.
 */
enum PurchaseOrderStatus: string
⋮----
public function label(): string
````

## File: app/Enums/QuoteStatus.php
````php
namespace App\Enums;
⋮----
/**
 * quotes.status — B2B state machine: draft → sent → accepted → (PO);
 * sent → rejected | expired.
 */
enum QuoteStatus: string
⋮----
public function label(): string
````

## File: app/Enums/UserRole.php
````php
namespace App\Enums;
⋮----
/**
 * The six roles from the Enterprise PRD §3 (Actors, Roles & Permission Matrix).
 * Values are the Laratrust `roles.name` slugs.
 */
enum UserRole: string
⋮----
public function label(): string
⋮----
public function description(): string
````

## File: app/Exceptions/CreditLimitExceededException.php
````php
namespace App\Exceptions;
⋮----
/**
 * Thrown during PO approval when a business account's outstanding_balance
 * plus the new PO total would exceed its credit_limit.
 *
 * @see docs/source/StockFlow-Enterprise-PRD.md.pdf FR-6.4.
 */
class CreditLimitExceededException extends DomainException
⋮----
public static function forBusinessAccount(string $businessAccountId, float $creditLimit, float $attemptedTotal): self
````

## File: app/Exceptions/DomainException.php
````php
namespace App\Exceptions;
⋮----
use RuntimeException;
⋮----
/**
 * Base type for exceptions that represent a domain/business-rule failure
 * (as opposed to an infrastructure error). Services throw these; the
 * exception handler and/or controllers translate them into the appropriate
 * HTTP response (validation error bag, 403, 409, ...).
 *
 * See docs/project/canonical-decisions.md §2 — "Exceptions represent domain
 * failures" is an architecture rule, not just a naming convention.
 */
abstract class DomainException extends RuntimeException
⋮----
/**
     * Extra machine-readable context about the failure (e.g. product_id,
     * requested vs. available quantity). Safe to expose in API error
     * responses; never put secrets here.
     *
     * @var array<string, mixed>
     */
protected array $context = [];
⋮----
/**
     * @param  array<string, mixed>  $context
     */
public function __construct(string $message, array $context = [])
⋮----
parent::__construct($message);
⋮----
/**
     * @return array<string, mixed>
     */
public function context(): array
````

## File: app/Exceptions/ImportValidationException.php
````php
namespace App\Exceptions;
⋮----
/**
 * Thrown for a single import row that fails validation. Per FR-7.3, one
 * row's failure must not fail the whole batch — the ImportService is
 * expected to catch this per-row, record it against import_rows, and
 * continue processing the rest of the file.
 */
class ImportValidationException extends DomainException
⋮----
/**
     * @param  array<string, list<string>>  $errors  field => messages
     */
public static function forRow(int $rowNumber, array $errors): self
⋮----
/**
     * @return array<string, list<string>>
     */
public function errors(): array
⋮----
return $this->context()['errors'] ?? [];
````

## File: app/Exceptions/InvalidStateTransitionException.php
````php
namespace App\Exceptions;
⋮----
/**
 * Thrown when a service is asked to move a stateful entity (Order, Quote,
 * PurchaseOrder, ...) to a status its current status cannot transition to.
 *
 * @see docs/project/canonical-decisions.md — state machines are explicit;
 *      illegal transitions throw domain exceptions.
 */
class InvalidStateTransitionException extends DomainException
⋮----
public static function make(string $entity, string $from, string $to): self
````

## File: app/Exceptions/OutOfStockException.php
````php
namespace App\Exceptions;
⋮----
/**
 * Thrown when a reservation/confirmation would require more stock than is
 * currently available (on_hand - reserved) for a (product, warehouse) pair.
 *
 * @see docs/project/canonical-decisions.md §6 — no oversell under concurrency.
 */
class OutOfStockException extends DomainException
⋮----
public static function forProduct(string $productId, string $warehouseId, int $requested, int $available): self
⋮----
/**
     * No single active warehouse can cover the full requested quantity —
     * thrown by OrderService::checkout() before it even attempts a
     * reserve() call, since StockService::bestWarehouseFor() found nowhere
     * to place the line.
     */
public static function noWarehouseAvailable(string $productId, int $requested): self
⋮----
/**
     * Thrown by CartService::add() when the total desired quantity (already
     * in the cart plus this addition) exceeds stock available across every
     * active warehouse combined. Not tied to one warehouse — adding to cart
     * never picks or reserves one; that only happens at authenticated
     * checkout via StockService::bestWarehouseFor()/reserve().
     */
public static function forCartAddition(string $productId, int $requested, int $available): self
````

## File: app/Exceptions/PaymentVerificationException.php
````php
namespace App\Exceptions;
⋮----
/**
 * Thrown when a payment webhook/callback fails signature verification, or
 * otherwise cannot be trusted enough to convert a reservation to sale_out.
 *
 * @see docs/project/canonical-decisions.md — webhooks are signature-verified
 *      and idempotent.
 */
class PaymentVerificationException extends DomainException
⋮----
public static function invalidSignature(string $method): self
````

## File: app/Exceptions/PricingUnavailableException.php
````php
namespace App\Exceptions;
⋮----
/**
 * Thrown when a checkout line has no applicable price — no active
 * `b2c_retail` price list item covers the product/quantity. A pricing gap
 * is a catalog-data problem, not a stock problem, so it's kept distinct
 * from OutOfStockException even though both abort checkout the same way.
 */
class PricingUnavailableException extends DomainException
⋮----
public static function forProduct(string $productId): self
````

## File: app/Exceptions/ProductUnavailableException.php
````php
namespace App\Exceptions;
⋮----
/**
 * Thrown when a public storefront action (add to cart) targets a product
 * that doesn't exist or is inactive. Distinct from OutOfStockException:
 * this is a catalog-visibility failure, not a stock-quantity failure — an
 * inactive product might have plenty of stock, it's just not for sale.
 */
class ProductUnavailableException extends DomainException
⋮----
public static function forProduct(string $productId): self
````

## File: app/Exceptions/UnauthorizedWarehouseException.php
````php
namespace App\Exceptions;
⋮----
/**
 * Thrown when a warehouse-scoped action (stock.move, stock.transfer) is
 * attempted against a warehouse outside the actor's assigned Laratrust
 * team(s).
 *
 * @see docs/project/canonical-decisions.md §3 — warehouse-scoping via
 *      Laratrust teams (one team per warehouse).
 */
class UnauthorizedWarehouseException extends DomainException
⋮----
public static function forWarehouse(string $warehouseId): self
````

## File: app/Http/Controllers/Api/V1/.gitkeep
````

````

## File: app/Http/Controllers/Api/V1/ApiController.php
````php
namespace App\Http\Controllers\Api\V1;
⋮----
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
⋮----
abstract class ApiController extends Controller
⋮----
protected function resource(JsonResource $resource, Request $request, int $status = 200, array $meta = []): JsonResponse
⋮----
return response()->json([
'data' => $resource->resolve($request),
⋮----
/**
     * @param  class-string<JsonResource>  $resourceClass
     */
protected function paginated(LengthAwarePaginator $paginator, string $resourceClass, Request $request): JsonResponse
⋮----
'data' => $paginator->getCollection()
->map(fn ($item) => (new $resourceClass($item))->resolve($request))
->values(),
⋮----
'current_page' => $paginator->currentPage(),
'from' => $paginator->firstItem(),
'last_page' => $paginator->lastPage(),
'per_page' => $paginator->perPage(),
'to' => $paginator->lastItem(),
'total' => $paginator->total(),
````

## File: app/Http/Controllers/Api/V1/CatalogController.php
````php
namespace App\Http\Controllers\Api\V1;
⋮----
use App\Http\Requests\Api\V1\ListProductsRequest;
use App\Http\Resources\Api\V1\ProductResource;
use App\Services\CatalogService;
⋮----
class CatalogController extends ApiController
⋮----
public function __construct(private readonly CatalogService $catalog) {}
⋮----
public function products(ListProductsRequest $request)
⋮----
$validated = $request->validated();
⋮----
$products = $this->catalog->listProducts(
⋮----
return $this->paginated($products, ProductResource::class, $request);
````

## File: app/Http/Controllers/Api/V1/PaymentController.php
````php
namespace App\Http\Controllers\Api\V1;
⋮----
use App\Enums\PaymentMethod;
use App\Http\Requests\Api\V1\ListPaymentsRequest;
use App\Http\Requests\Api\V1\StoreBankTransferProofRequest;
use App\Http\Resources\Api\V1\PaymentResource;
use App\Services\PaymentService;
use App\Services\PurchaseOrderService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
⋮----
class PaymentController extends ApiController
⋮----
public function __construct(
⋮----
public function index(ListPaymentsRequest $request): JsonResponse
⋮----
$validated = $request->validated();
⋮----
$payments = $this->payments->listForViewer($request->user(), (int) ($validated['per_page'] ?? 15));
$payments->getCollection()->load('payable');
⋮----
return $this->paginated($payments, PaymentResource::class, $request);
⋮----
public function bankTransferProof(StoreBankTransferProofRequest $request): JsonResponse
⋮----
$purchaseOrder = $this->purchaseOrders->find($validated['purchase_order_id']);
⋮----
$payment = $this->payments->initiate(
⋮----
$payment->load('payable');
⋮----
return $this->resource(new PaymentResource($payment), $request, 201, [
````

## File: app/Http/Controllers/Api/V1/PurchaseOrderController.php
````php
namespace App\Http\Controllers\Api\V1;
⋮----
use App\Http\Requests\Api\V1\AcceptPurchaseOrderRequest;
use App\Http\Requests\Api\V1\ListPurchaseOrdersRequest;
use App\Http\Resources\Api\V1\PurchaseOrderResource;
use App\Models\PurchaseOrder;
use App\Services\PurchaseOrderService;
use Illuminate\Http\JsonResponse;
⋮----
class PurchaseOrderController extends ApiController
⋮----
public function __construct(private readonly PurchaseOrderService $purchaseOrders) {}
⋮----
public function index(ListPurchaseOrdersRequest $request): JsonResponse
⋮----
$validated = $request->validated();
⋮----
$purchaseOrders = $this->purchaseOrders->listForViewer(
$request->user()->businessAccount,
⋮----
$purchaseOrders->getCollection()->load(['businessAccount', 'items.product', 'items.warehouse', 'payments']);
⋮----
return $this->paginated($purchaseOrders, PurchaseOrderResource::class, $request);
⋮----
public function accept(AcceptPurchaseOrderRequest $request, PurchaseOrder $purchaseOrder): JsonResponse
⋮----
$purchaseOrder = $this->purchaseOrders->find($purchaseOrder->id) ?? $purchaseOrder;
$purchaseOrder->load(['businessAccount', 'items.product', 'items.warehouse', 'payments']);
⋮----
return $this->resource(new PurchaseOrderResource($purchaseOrder), $request, meta: [
````

## File: app/Http/Controllers/Api/V1/QuoteController.php
````php
namespace App\Http\Controllers\Api\V1;
⋮----
use App\Http\Requests\Api\V1\ListQuotesRequest;
use App\Http\Requests\Api\V1\StoreQuoteRequest;
use App\Http\Resources\Api\V1\QuoteResource;
use App\Services\QuoteService;
use Illuminate\Http\JsonResponse;
⋮----
class QuoteController extends ApiController
⋮----
public function __construct(private readonly QuoteService $quotes) {}
⋮----
public function index(ListQuotesRequest $request): JsonResponse
⋮----
$validated = $request->validated();
$user = $request->user();
⋮----
$quotes = $this->quotes->listForViewer(
⋮----
$quotes->getCollection()->load(['businessAccount', 'items.product', 'purchaseOrders']);
⋮----
return $this->paginated($quotes, QuoteResource::class, $request);
⋮----
public function store(StoreQuoteRequest $request): JsonResponse
⋮----
$quote = $this->quotes->request(
$request->user()->businessAccount,
$request->validated('lines'),
⋮----
$quote->load(['businessAccount', 'items.product', 'purchaseOrders']);
⋮----
return $this->resource(new QuoteResource($quote), $request, 201);
````

## File: app/Http/Controllers/Api/V1/StockAvailabilityController.php
````php
namespace App\Http\Controllers\Api\V1;
⋮----
use App\Http\Requests\Api\V1\StockAvailabilityRequest;
use App\Http\Resources\Api\V1\StockAvailabilityResource;
use App\Services\StockService;
⋮----
class StockAvailabilityController extends ApiController
⋮----
public function __construct(private readonly StockService $stock) {}
⋮----
public function __invoke(StockAvailabilityRequest $request)
⋮----
$validated = $request->validated();
⋮----
$levels = $this->stock->listLevels((int) ($validated['per_page'] ?? 15), [
⋮----
return $this->paginated($levels, StockAvailabilityResource::class, $request);
````

## File: app/Http/Controllers/Web/Admin/AuditLogController.php
````php
namespace App\Http\Controllers\Web\Admin;
⋮----
use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use App\Services\AuditService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
⋮----
class AuditLogController extends Controller
⋮----
/**
     * The fixed set of event names this codebase ever records (see
     * requirement #2 / the *::record() call sites in StockService,
     * PurchaseOrderService, PaymentService, RoleAssignmentService,
     * RolePermissionService). Hardcoded instead of a DISTINCT query so the
     * filter dropdown always lists every possible event, even ones that
     * haven't happened yet, without scanning the table on every page load.
     */
⋮----
public function __construct(private readonly AuditService $audit) {}
⋮----
public function index(Request $request): Response
⋮----
'event' => $request->string('event')->toString() ?: null,
'causer_id' => $request->string('causer_id')->toString() ?: null,
'date_from' => $request->string('date_from')->toString() ?: null,
'date_to' => $request->string('date_to')->toString() ?: null,
⋮----
$logs = $this->audit->listAll(20, $filters)->through(fn (ActivityLog $log) => [
⋮----
return Inertia::render('Admin/AuditLog/Index', [
⋮----
'users' => User::query()->orderBy('name')->get(['id', 'name']),
````

## File: app/Http/Controllers/Web/Admin/PermissionMatrixController.php
````php
namespace App\Http\Controllers\Web\Admin;
⋮----
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Inertia\Inertia;
use Inertia\Response;
⋮----
class PermissionMatrixController extends Controller
⋮----
/**
     * Read-only role x permission grid, mirroring the Enterprise PRD §3
     * permission matrix. This is a reporting view; role assignment happens
     * on the Users/Edit page, and a role's own permission set is edited on
     * Roles/Index (RolePermissionController).
     */
public function index(): Response
⋮----
$roles = Role::query()->orderBy('name')->with('permissions')->get();
$permissions = Permission::query()->orderBy('name')->get(['id', 'name', 'display_name']);
⋮----
return Inertia::render('Admin/Permissions/Matrix', [
'permissions' => $permissions->map(fn (Permission $permission) => [
⋮----
'roles' => $roles->map(fn (Role $role) => [
⋮----
'permissions' => $role->permissions->pluck('name')->all(),
````

## File: app/Http/Controllers/Web/Admin/RoleController.php
````php
namespace App\Http\Controllers\Web\Admin;
⋮----
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateRolePermissionsRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Services\RolePermissionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
⋮----
class RoleController extends Controller
⋮----
public function __construct(private readonly RolePermissionService $rolePermissions) {}
⋮----
/**
     * List roles with their permission counts and full assigned permission
     * names, plus the full permission catalog — Roles/Index.jsx edits a
     * role's own permission set inline (module 4: role/permission
     * management improvements), no separate edit page needed.
     */
public function index(): Response
⋮----
$roles = Role::query()
->with('permissions')
->withCount('permissions')
->orderBy('name')
->get()
->map(fn (Role $role) => [
⋮----
'permissions' => $role->permissions->pluck('name')->all(),
⋮----
$permissions = Permission::query()->orderBy('name')->get(['name', 'display_name']);
⋮----
return Inertia::render('Admin/Roles/Index', [
⋮----
'permissions' => $permissions->map(fn (Permission $permission) => [
⋮----
/**
     * Sync the given role's permission assignments.
     */
public function updatePermissions(UpdateRolePermissionsRequest $request, Role $role): RedirectResponse
⋮----
$this->rolePermissions->syncPermissions($role, $request->permissionNames(), Auth::user());
⋮----
->route('admin.roles.index')
->with('flash.success', "Permissions updated for {$role->display_name}.");
````

## File: app/Http/Controllers/Web/Admin/UserController.php
````php
namespace App\Http\Controllers\Web\Admin;
⋮----
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateUserRolesRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\RoleAssignmentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
⋮----
class UserController extends Controller
⋮----
public function __construct(private readonly RoleAssignmentService $roleAssignmentService) {}
⋮----
/**
     * List users with their current role names.
     */
public function index(): Response
⋮----
$users = User::query()
->orderBy('name')
->paginate(15)
->through(fn (User $user) => [
⋮----
'roles' => $user->roles()->pluck('display_name')->all(),
⋮----
return Inertia::render('Admin/Users/Index', [
⋮----
/**
     * Show the role-assignment page for a single user.
     */
public function editRoles(User $user): Response
⋮----
$roles = Role::query()->orderBy('name')->get(['id', 'name', 'display_name']);
⋮----
return Inertia::render('Admin/Users/Edit', [
⋮----
'roles' => $roles->map(fn (Role $role) => [
⋮----
'assignedRoles' => $user->roles()->pluck('name'),
⋮----
/**
     * Sync the given user's role assignments.
     */
public function updateRoles(UpdateUserRolesRequest $request, User $user): RedirectResponse
⋮----
$this->roleAssignmentService->syncRoles($user, $request->roleNames(), Auth::user());
⋮----
->route('admin.users.edit-roles', $user)
->with('flash.success', "Roles updated for {$user->name}.");
````

## File: app/Http/Controllers/Web/Auth/LoginController.php
````php
namespace App\Http\Controllers\Web\Auth;
⋮----
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
⋮----
class LoginController extends Controller
⋮----
public function __construct(private readonly AuthService $authService) {}
⋮----
/**
     * Show the login page.
     *
     * FR-1.1: session (`web` guard) login for all human UI.
     */
public function create(): Response
⋮----
return Inertia::render('Auth/Login');
⋮----
/**
     * Authenticate the request and establish a session.
     */
public function store(LoginRequest $request): RedirectResponse
⋮----
$this->authService->login($request);
⋮----
return redirect()->intended(route('dashboard'));
⋮----
/**
     * Destroy the session (FR-1.2).
     */
public function destroy(Request $request): RedirectResponse
⋮----
$this->authService->logout($request);
⋮----
return redirect()->route('login');
````

## File: app/Http/Controllers/Web/Catalog/CategoryController.php
````php
namespace App\Http\Controllers\Web\Catalog;
⋮----
use App\Enums\PermissionName;
use App\Http\Controllers\Controller;
use App\Http\Requests\Catalog\StoreCategoryRequest;
use App\Models\Category;
use App\Models\User;
use App\Services\CatalogService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
⋮----
/**
 * Categories have no ownership concept and no dedicated Policy — the
 * `category.manage`/`catalog.read` Laratrust permissions (route middleware,
 * plus a direct isAbleTo() check here for defense-in-depth) are the full
 * gate. See docs/project/canonical-decisions.md §2 and StoreCategoryRequest.
 */
class CategoryController extends Controller
⋮----
public function __construct(private readonly CatalogService $catalog) {}
⋮----
public function index(): Response
⋮----
$categories = $this->catalog->listCategories()->map(fn (Category $category) => [
⋮----
'children' => $category->children->map(fn (Category $child) => [
⋮----
return Inertia::render('Catalog/Categories/Index', [
⋮----
'parentOptions' => $this->catalog->listCategoriesFlat()->map->only(['id', 'name']),
⋮----
public function store(StoreCategoryRequest $request): RedirectResponse
⋮----
$category = $this->catalog->createCategory($request->validated());
⋮----
->route('catalog.categories.index')
->with('flash.success', "Category \"{$category->name}\" created.");
⋮----
public function destroy(Category $category): RedirectResponse
⋮----
/** @var User $user */
$user = Auth::user();
⋮----
if (! $user->isAbleTo(PermissionName::CategoryManage->value)) {
⋮----
$this->catalog->deleteCategory($category);
⋮----
->with('flash.success', 'Category deleted.');
````

## File: app/Http/Controllers/Web/Catalog/PriceListController.php
````php
namespace App\Http\Controllers\Web\Catalog;
⋮----
use App\Http\Controllers\Controller;
use App\Http\Requests\Catalog\StorePriceListRequest;
use App\Models\PriceList;
use App\Services\CatalogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
⋮----
class PriceListController extends Controller
⋮----
public function __construct(private readonly CatalogService $catalog) {}
⋮----
public function index(Request $request): Response
⋮----
$this->authorize('viewAny', PriceList::class);
⋮----
$priceLists = $this->catalog->listPriceLists(15)->through(fn (PriceList $priceList) => [
⋮----
'items' => $priceList->items->map(fn ($item) => [
⋮----
'product' => $item->product->only(['id', 'name', 'sku']),
⋮----
return Inertia::render('Catalog/PriceLists/Index', [
⋮----
'canManagePriceLists' => $request->user()->can('create', PriceList::class),
⋮----
public function store(StorePriceListRequest $request): RedirectResponse
⋮----
$priceList = $this->catalog->createPriceList($request->validated());
⋮----
->route('catalog.price-lists.index')
->with('flash.success', "Price list \"{$priceList->name}\" created.");
````

## File: app/Http/Controllers/Web/Catalog/PriceListItemController.php
````php
namespace App\Http\Controllers\Web\Catalog;
⋮----
use App\Http\Controllers\Controller;
use App\Http\Requests\Catalog\StorePriceListItemRequest;
use App\Http\Requests\Catalog\UpdatePriceListItemRequest;
use App\Models\PriceList;
use App\Models\PriceListItem;
use App\Services\CatalogService;
use Illuminate\Http\RedirectResponse;
⋮----
class PriceListItemController extends Controller
⋮----
public function __construct(private readonly CatalogService $catalog) {}
⋮----
public function store(StorePriceListItemRequest $request, PriceList $priceList): RedirectResponse
⋮----
$this->catalog->createPriceListItem([
...$request->validated(),
⋮----
->route('catalog.price-lists.index')
->with('flash.success', 'Price list item added.');
⋮----
public function update(UpdatePriceListItemRequest $request, PriceListItem $priceListItem): RedirectResponse
⋮----
$this->catalog->updatePriceListItem($priceListItem, $request->validated());
⋮----
->with('flash.success', 'Price list item updated.');
⋮----
public function destroy(PriceListItem $priceListItem): RedirectResponse
⋮----
$this->authorize('deleteItem', $priceListItem);
⋮----
$this->catalog->deletePriceListItem($priceListItem);
⋮----
->with('flash.success', 'Price list item removed.');
````

## File: app/Http/Controllers/Web/Catalog/ProductController.php
````php
namespace App\Http\Controllers\Web\Catalog;
⋮----
use App\Http\Controllers\Controller;
use App\Http\Requests\Catalog\StoreProductRequest;
use App\Http\Requests\Catalog\UpdateProductRequest;
use App\Models\Product;
use App\Services\CatalogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
⋮----
class ProductController extends Controller
⋮----
public function __construct(private readonly CatalogService $catalog) {}
⋮----
public function index(Request $request): Response
⋮----
$this->authorize('viewAny', Product::class);
⋮----
$search = $request->string('search')->toString() ?: null;
$categoryId = $request->string('category_id')->toString() ?: null;
⋮----
$products = $this->catalog->listProducts(15, [
⋮----
])->through(fn (Product $product) => [
⋮----
return Inertia::render('Catalog/Products/Index', [
⋮----
'categories' => $this->catalog->listCategoriesFlat()->map->only(['id', 'name']),
⋮----
public function create(): Response
⋮----
$this->authorize('create', Product::class);
⋮----
return Inertia::render('Catalog/Products/Create', [
⋮----
'suppliers' => $this->catalog->listSuppliersFlat()->map->only(['id', 'name']),
⋮----
public function store(StoreProductRequest $request): RedirectResponse
⋮----
$product = $this->catalog->createProduct($request->validated());
⋮----
->route('catalog.products.show', $product)
->with('flash.success', "Product \"{$product->name}\" created.");
⋮----
public function show(Product $product): Response
⋮----
$this->authorize('view', $product);
⋮----
$product = $this->catalog->findProductWithRelations($product->id);
⋮----
return Inertia::render('Catalog/Products/Show', [
⋮----
'price_list_items' => $product->priceListItems->map(fn ($item) => [
⋮----
'price_list' => $item->priceList->only(['id', 'name']),
⋮----
public function edit(Product $product): Response
⋮----
$this->authorize('update', $product);
⋮----
return Inertia::render('Catalog/Products/Edit', [
'product' => $product->only(['id', 'category_id', 'supplier_id', 'sku', 'name', 'description', 'is_active']),
⋮----
public function update(UpdateProductRequest $request, Product $product): RedirectResponse
⋮----
$product = $this->catalog->updateProduct($product, $request->validated());
⋮----
->with('flash.success', "Product \"{$product->name}\" updated.");
⋮----
public function destroy(Product $product): RedirectResponse
⋮----
$this->authorize('delete', $product);
⋮----
$this->catalog->deleteProduct($product);
⋮----
->route('catalog.products.index')
->with('flash.success', 'Product deleted.');
````

## File: app/Http/Controllers/Web/Catalog/SupplierController.php
````php
namespace App\Http\Controllers\Web\Catalog;
⋮----
use App\Enums\PermissionName;
use App\Http\Controllers\Controller;
use App\Http\Requests\Catalog\StoreSupplierRequest;
use App\Models\Supplier;
use App\Models\User;
use App\Services\CatalogService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
⋮----
/**
 * Suppliers have no dedicated PRD permission or Policy — gated under
 * `product.manage` (route middleware + StoreSupplierRequest), the same
 * roles that manage the product catalog itself.
 */
class SupplierController extends Controller
⋮----
public function __construct(private readonly CatalogService $catalog) {}
⋮----
public function index(): Response
⋮----
$suppliers = $this->catalog->listSuppliers(15)->through(fn (Supplier $supplier) => [
⋮----
return Inertia::render('Catalog/Suppliers/Index', [
⋮----
public function store(StoreSupplierRequest $request): RedirectResponse
⋮----
$supplier = $this->catalog->createSupplier($request->validated());
⋮----
->route('catalog.suppliers.index')
->with('flash.success', "Supplier \"{$supplier->name}\" created.");
⋮----
public function destroy(Supplier $supplier): RedirectResponse
⋮----
/** @var User $user */
$user = Auth::user();
⋮----
if (! $user->isAbleTo(PermissionName::ProductManage->value)) {
⋮----
$this->catalog->deleteSupplier($supplier);
⋮----
->with('flash.success', 'Supplier deleted.');
````

## File: app/Http/Controllers/Web/Import/ImportController.php
````php
namespace App\Http\Controllers\Web\Import;
⋮----
use App\Enums\ImportEntity;
use App\Http\Controllers\Controller;
use App\Http\Requests\Import\StoreImportRequest;
use App\Models\ImportBatch;
use App\Models\ImportRow;
use App\Services\ImportService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
⋮----
class ImportController extends Controller
⋮----
public function __construct(private readonly ImportService $imports) {}
⋮----
public function index(): Response
⋮----
return Inertia::render('Import/Index', [
'batches' => $this->imports->listBatches()->through(fn (ImportBatch $batch) => $this->batchPayload($batch)),
⋮----
public function create(): Response
⋮----
return Inertia::render('Import/Create', [
'entities' => collect(ImportEntity::cases())->map(fn (ImportEntity $entity) => [
⋮----
'label' => $entity->label(),
])->values(),
⋮----
public function store(StoreImportRequest $request): RedirectResponse
⋮----
$validated = $request->validated();
⋮----
$batch = $this->imports->start(
$request->user(),
ImportEntity::from($validated['entity']),
$request->file('file'),
⋮----
->route('imports.show', $batch)
->with('flash.success', 'Import queued.');
⋮----
public function show(ImportBatch $importBatch): Response
⋮----
$batch = $this->imports->findBatch($importBatch->id) ?? $importBatch;
⋮----
return Inertia::render('Import/Show', [
'batch' => $this->batchPayload($batch),
'rows' => $this->imports->rowsForBatch($batch->id)->through(fn (ImportRow $row) => $this->rowPayload($row)),
⋮----
public function errorReport(ImportBatch $importBatch): Response
⋮----
return Inertia::render('Import/ErrorReport', [
⋮----
'rows' => $this->imports->failedRowsForBatch($batch->id)->map(fn (ImportRow $row) => $this->rowPayload($row)),
⋮----
public function downloadErrorReport(ImportBatch $importBatch): StreamedResponse
⋮----
$rows = $this->imports->failedRowsForBatch($importBatch->id);
⋮----
return response()->streamDownload(function () use ($rows) {
⋮----
$rows->each(function (ImportRow $row) use ($handle) {
⋮----
/**
     * @return array<string, mixed>
     */
private function batchPayload(ImportBatch $batch): array
⋮----
'entity_label' => $batch->entity->label(),
⋮----
'status_label' => $batch->status->label(),
⋮----
private function rowPayload(ImportRow $row): array
⋮----
'status_label' => $row->status->label(),
````

## File: app/Http/Controllers/Web/Procurement/PurchaseOrderController.php
````php
namespace App\Http\Controllers\Web\Procurement;
⋮----
use App\Enums\PaymentMethod;
use App\Http\Controllers\Controller;
use App\Http\Requests\Procurement\ApprovePurchaseOrderRequest;
use App\Http\Requests\Procurement\RejectPurchaseOrderRequest;
use App\Http\Requests\Procurement\StoreBankTransferSettlementRequest;
use App\Models\PurchaseOrder;
use App\Services\PaymentService;
use App\Services\PurchaseOrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
⋮----
class PurchaseOrderController extends Controller
⋮----
public function __construct(
⋮----
public function index(): Response
⋮----
$businessAccount = Auth::user()->businessAccount;
⋮----
$purchaseOrders = $this->purchaseOrders->listForViewer($businessAccount)->through(fn (PurchaseOrder $po) => [
⋮----
'status_label' => $po->status->label(),
⋮----
return Inertia::render('Procurement/PurchaseOrders/Index', [
⋮----
public function show(PurchaseOrder $purchaseOrder): Response
⋮----
$this->authorize('view', $purchaseOrder);
⋮----
$purchaseOrder->load(['items.product', 'items.warehouse', 'businessAccount', 'approvals.approver', 'payments']);
$user = Auth::user();
⋮----
return Inertia::render('Procurement/PurchaseOrders/Show', [
⋮----
'status_label' => $purchaseOrder->status->label(),
⋮----
'business_account' => $purchaseOrder->businessAccount->only([
⋮----
'items' => $purchaseOrder->items->map(fn ($item) => [
⋮----
'product' => $item->product->only(['id', 'name', 'sku']),
'warehouse' => $item->warehouse->only(['id', 'name']),
⋮----
'approvals' => $purchaseOrder->approvals->map(fn ($approval) => [
⋮----
'approver' => $approval->approver->only(['id', 'name']),
⋮----
'payments' => $purchaseOrder->payments->map(fn ($payment) => [
⋮----
'method_label' => $payment->method->label(),
'status_label' => $payment->status->label(),
⋮----
'canApprove' => $user->can('approve', $purchaseOrder),
'canReject' => $user->can('reject', $purchaseOrder),
'canSettle' => $user->can('settle', $purchaseOrder),
⋮----
public function approveCreate(PurchaseOrder $purchaseOrder): Response
⋮----
$this->authorize('approve', $purchaseOrder);
⋮----
$purchaseOrder->load('businessAccount');
⋮----
return Inertia::render('Procurement/PurchaseOrders/Approve', [
⋮----
'business_account' => $account->only(['id', 'company_name', 'credit_limit', 'outstanding_balance']),
⋮----
public function approve(ApprovePurchaseOrderRequest $request, PurchaseOrder $purchaseOrder): RedirectResponse
⋮----
$this->purchaseOrders->approve($purchaseOrder, Auth::user(), $request->validated('note'));
⋮----
return redirect()->route('procurement.purchase-orders.show', $purchaseOrder)
->with('flash.success', 'Purchase order approved — stock reserved.');
⋮----
public function reject(RejectPurchaseOrderRequest $request, PurchaseOrder $purchaseOrder): RedirectResponse
⋮----
$this->purchaseOrders->reject($purchaseOrder, Auth::user(), $request->validated('note'));
⋮----
->with('flash.success', 'Purchase order rejected.');
⋮----
public function bankTransferCreate(PurchaseOrder $purchaseOrder): Response
⋮----
$this->authorize('settle', $purchaseOrder);
⋮----
return Inertia::render('Payments/BankTransferReview', [
⋮----
public function bankTransferStore(StoreBankTransferSettlementRequest $request, PurchaseOrder $purchaseOrder): RedirectResponse
⋮----
$payment = $this->payments->initiate(
⋮----
['reference' => $request->validated('reference')]
⋮----
$this->payments->settleManually($payment, Auth::user());
⋮----
->with('flash.success', 'Bank transfer settled — order fulfilled.');
⋮----
public function close(PurchaseOrder $purchaseOrder): RedirectResponse
⋮----
$this->purchaseOrders->close($purchaseOrder);
⋮----
->with('flash.success', 'Purchase order closed.');
````

## File: app/Http/Controllers/Web/Procurement/QuoteController.php
````php
namespace App\Http\Controllers\Web\Procurement;
⋮----
use App\Http\Controllers\Controller;
use App\Http\Requests\Procurement\PriceQuoteRequest;
use App\Http\Requests\Procurement\StoreQuoteRequest;
use App\Models\Quote;
use App\Services\CatalogService;
use App\Services\PurchaseOrderService;
use App\Services\QuoteService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
⋮----
class QuoteController extends Controller
⋮----
public function __construct(
⋮----
public function index(): Response
⋮----
$user = Auth::user();
⋮----
$quotes = $this->quotes->listForViewer($user, $businessAccount)->through(fn (Quote $quote) => [
⋮----
'status_label' => $quote->status->label(),
⋮----
return Inertia::render('Procurement/Quotes/Index', [
⋮----
public function create(): Response
⋮----
$this->authorize('create', Quote::class);
⋮----
return Inertia::render('Procurement/Quotes/Create', [
'products' => collect($this->catalog->listProducts(1000)->items())->map->only(['id', 'name', 'sku']),
⋮----
public function store(StoreQuoteRequest $request): RedirectResponse
⋮----
$businessAccount = Auth::user()->businessAccount;
⋮----
$quote = $this->quotes->request($businessAccount, $request->validated('lines'));
⋮----
return redirect()->route('procurement.quotes.show', $quote)
->with('flash.success', 'RFQ submitted — awaiting pricing.');
⋮----
public function show(Quote $quote): Response
⋮----
$this->authorize('view', $quote);
⋮----
$quote->load(['items.product', 'businessAccount', 'purchaseOrders']);
⋮----
return Inertia::render('Procurement/Quotes/Show', [
⋮----
'is_expired' => $this->quotes->isExpired($quote),
'business_account' => $quote->businessAccount->only(['id', 'company_name']),
'items' => $quote->items->map(fn ($item) => [
⋮----
'product' => $item->product->only(['id', 'name', 'sku']),
⋮----
'purchase_orders' => $quote->purchaseOrders->map(fn ($po) => [
⋮----
'canPrice' => $user->can('price', $quote),
'canAccept' => $user->can('accept', $quote),
'canReject' => $user->can('reject', $quote),
⋮----
public function priceCreate(Quote $quote): Response
⋮----
$this->authorize('price', $quote);
⋮----
$quote->load('items.product');
⋮----
return Inertia::render('Procurement/Quotes/Price', [
⋮----
'suggested_unit_price' => $this->quotes->suggestedTierPrice($item->product_id, $item->quantity),
⋮----
public function priceStore(PriceQuoteRequest $request, Quote $quote): RedirectResponse
⋮----
$this->quotes->price($quote, $request->validated('prices'));
⋮----
->with('flash.success', 'Quote priced and sent to the buyer.');
⋮----
public function accept(Quote $quote): RedirectResponse
⋮----
$this->authorize('accept', $quote);
⋮----
$purchaseOrder = $this->purchaseOrders->createFromQuote($quote, Auth::user());
⋮----
return redirect()->route('procurement.purchase-orders.show', $purchaseOrder)
->with('flash.success', 'Quote accepted — purchase order created and awaiting approval.');
⋮----
public function reject(Quote $quote): RedirectResponse
⋮----
$this->authorize('reject', $quote);
⋮----
$this->quotes->reject($quote);
⋮----
->with('flash.success', 'Quote rejected.');
````

## File: app/Http/Controllers/Web/Reports/ReportController.php
````php
namespace App\Http\Controllers\Web\Reports;
⋮----
use App\Enums\ImportEntity;
use App\Enums\ImportStatus;
use App\Enums\MovementType;
use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Http\Controllers\Controller;
use App\Models\StockLevel;
use App\Models\StockMovement;
use App\Models\User;
use App\Services\CatalogService;
use App\Services\ReportService;
use App\Services\StockService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
⋮----
/**
 * Modules 5–9: five read-only reports, each paginated (requirement #4),
 * backed by an indexed repository query (requirement #5 — see the
 * migrations/queries ReportService delegates to), with the filter set
 * (date range, product, warehouse, status, user) applied wherever that
 * dimension actually exists on the underlying table — see each action's
 * comment for which subset applies and why.
 */
class ReportController extends Controller
⋮----
public function __construct(
⋮----
public function lowStock(Request $request): Response
⋮----
$filters = $this->filters($request, ['product_id', 'warehouse_id']);
$threshold = $request->integer('threshold') ?: null;
⋮----
$levels = $this->reports->lowStock(20, $threshold, $filters)->through(fn (StockLevel $level) => [
⋮----
return Inertia::render('Reports/LowStock', [
⋮----
...$this->catalogFilterOptions(),
⋮----
public function stockMovements(Request $request): Response
⋮----
// date range, product, warehouse, status(->type), user(->actor)
$filters = $this->filters($request, ['product_id', 'warehouse_id', 'date_from', 'date_to']);
$filters['type'] = $request->string('type')->toString() ?: null;
$filters['actor_id'] = $request->integer('actor_id') ?: null;
⋮----
$movements = $this->reports->stockMovements(20, $filters)->through(fn (StockMovement $movement) => [
⋮----
'type_label' => $movement->type->label(),
⋮----
return Inertia::render('Reports/StockMovements', [
⋮----
'types' => collect(MovementType::cases())->map(fn ($t) => ['value' => $t->value, 'label' => $t->label()]),
'users' => User::query()->orderBy('name')->get(['id', 'name']),
⋮----
public function sales(Request $request): Response
⋮----
// date range, product, warehouse, status, user
⋮----
$filters['status'] = $request->string('status')->toString() ?: null;
$filters['user_id'] = $request->integer('user_id') ?: null;
⋮----
$orders = $this->reports->sales(20, $filters)->through(fn ($order) => [
⋮----
'status_label' => $order->status->label(),
⋮----
return Inertia::render('Reports/Sales', [
⋮----
'statuses' => collect(OrderStatus::cases())->map(fn ($s) => ['value' => $s->value, 'label' => $s->label()]),
⋮----
public function payments(Request $request): Response
⋮----
// date range, status, user — no product/warehouse dimension on payments.
⋮----
'date_from' => $request->string('date_from')->toString() ?: null,
'date_to' => $request->string('date_to')->toString() ?: null,
'status' => $request->string('status')->toString() ?: null,
'method' => $request->string('method')->toString() ?: null,
'user_id' => $request->integer('user_id') ?: null,
⋮----
$payments = $this->reports->payments(20, $filters)->through(fn ($payment) => [
⋮----
'method_label' => $payment->method->label(),
⋮----
'status_label' => $payment->status->label(),
⋮----
return Inertia::render('Reports/Payments', [
⋮----
'statuses' => collect(PaymentStatus::cases())->map(fn ($s) => ['value' => $s->value, 'label' => $s->label()]),
'methods' => collect(PaymentMethod::cases())->map(fn ($m) => ['value' => $m->value, 'label' => $m->label()]),
⋮----
public function imports(Request $request): Response
⋮----
// date range, status, user(->uploader) — entity stands in for "product".
⋮----
'entity' => $request->string('entity')->toString() ?: null,
'uploader_id' => $request->integer('uploader_id') ?: null,
⋮----
$batches = $this->reports->imports(20, $filters)->through(fn ($batch) => [
⋮----
'entity_label' => $batch->entity->label(),
⋮----
'status_label' => $batch->status->label(),
⋮----
return Inertia::render('Reports/Imports', [
⋮----
'statuses' => collect(ImportStatus::cases())->map(fn ($s) => ['value' => $s->value, 'label' => $s->label()]),
'entities' => collect(ImportEntity::cases())->map(fn ($e) => ['value' => $e->value, 'label' => $e->label()]),
⋮----
/**
     * @param  list<string>  $keys
     * @return array<string, mixed>
     */
private function filters(Request $request, array $keys): array
⋮----
$filters[$key] = $request->string($key)->toString() ?: null;
⋮----
/**
     * @return array<string, mixed>
     */
private function catalogFilterOptions(): array
⋮----
'products' => collect($this->catalog->listProducts(1000)->items())->map->only(['id', 'name', 'sku']),
'warehouses' => $this->stock->listActiveWarehouses()->map->only(['id', 'name', 'code']),
````

## File: app/Http/Controllers/Web/Sales/CheckoutController.php
````php
namespace App\Http\Controllers\Web\Sales;
⋮----
use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Http\Controllers\Controller;
use App\Http\Requests\Sales\StoreCheckoutRequest;
use App\Models\Order;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
⋮----
class CheckoutController extends Controller
⋮----
/** Methods a B2C customer can actually pick at checkout — see requirement #7. */
⋮----
public function __construct(
⋮----
public function create(): Response|RedirectResponse
⋮----
$this->authorize('create', Order::class);
⋮----
if ($this->cart->isEmpty()) {
return redirect()->route('cart.show')->with('flash.error', 'Your cart is empty.');
⋮----
$lines = $this->cart->lines();
$subtotal = $this->cart->subtotal();
⋮----
return Inertia::render('Sales/Checkout/Create', [
'lines' => $lines->map(fn (array $line) => [
'product' => $line['product']->only(['id', 'name', 'sku']),
⋮----
'paymentMethods' => collect(self::CHECKOUT_METHODS)->map(fn (PaymentMethod $m) => [
⋮----
'label' => $m->label(),
'is_placeholder' => $m->isPlaceholder(),
⋮----
public function store(StoreCheckoutRequest $request): RedirectResponse
⋮----
$data = $request->validated();
$method = PaymentMethod::from($data['payment_method']);
⋮----
$order = $this->orders->checkout(Auth::user(), $this->cart->toCheckoutLines(), $method, $paymentOptions);
⋮----
$this->cart->clear();
⋮----
return redirect()->route('orders.show', $order)->with('flash.success', $this->flashMessageFor($order));
⋮----
private function flashMessageFor(Order $order): string
````

## File: app/Http/Controllers/Web/Sales/OrderController.php
````php
namespace App\Http\Controllers\Web\Sales;
⋮----
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
⋮----
class OrderController extends Controller
⋮----
public function __construct(private readonly OrderService $orders) {}
⋮----
public function index(): Response
⋮----
$orders = $this->orders->listForUser(Auth::id())->through(fn (Order $order) => [
⋮----
'status_label' => $order->status->label(),
⋮----
return Inertia::render('Sales/Orders/Index', [
⋮----
public function show(Order $order): Response
⋮----
$this->authorize('view', $order);
⋮----
$order->load(['items.product', 'items.warehouse', 'payments']);
⋮----
return Inertia::render('Sales/Orders/Show', [
⋮----
'items' => $order->items->map(fn ($item) => [
⋮----
'product' => $item->product->only(['id', 'name', 'sku']),
'warehouse' => $item->warehouse->only(['id', 'name']),
⋮----
'payments' => $order->payments->map(fn ($payment) => [
⋮----
'method_label' => $payment->method->label(),
⋮----
'status_label' => $payment->status->label(),
⋮----
'canSettlePayment' => Auth::user()->can('settlePayment', $order),
'canFulfill' => Auth::user()->can('fulfill', $order),
⋮----
/**
     * Staff-only: confirmed -> fulfilled (delivered/picked up).
     */
public function fulfill(Order $order): RedirectResponse
⋮----
$this->authorize('fulfill', $order);
⋮----
$this->orders->markFulfilled($order);
⋮----
return redirect()->route('orders.show', $order)->with('flash.success', 'Order marked fulfilled.');
````

## File: app/Http/Controllers/Web/Sales/PaymentController.php
````php
namespace App\Http\Controllers\Web\Sales;
⋮----
use App\Enums\PaymentMethod;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\PurchaseOrder;
use App\Services\PaymentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;
⋮----
class PaymentController extends Controller
⋮----
public function __construct(private readonly PaymentService $payments) {}
⋮----
public function index(): Response
⋮----
$payments = $this->payments->listAll()->through(fn (Payment $payment) => $this->paymentSummary($payment));
⋮----
return Inertia::render('Payments/Index', [
⋮----
public function show(Payment $payment): Response
⋮----
$this->authorize('view', $payment);
⋮----
$payment->load('payable');
⋮----
return Inertia::render('Payments/Show', [
'payment' => $this->paymentDetail($payment),
'canSettle' => Auth::user()->can('settle', $payment),
⋮----
&& Auth::user()->can('view', $payment),
⋮----
public function fakeGateway(Payment $payment): Response
⋮----
return Inertia::render('Payments/FakeGateway', [
'payment' => $this->paymentDetail($payment->load('payable')),
⋮----
public function simulateFakeGateway(Request $request, Payment $payment): RedirectResponse
⋮----
$data = $request->validate([
'outcome' => ['required', Rule::in(['succeed', 'fail'])],
⋮----
$this->payments->simulateFakeGateway($payment, $data['outcome']);
⋮----
return redirect()->route('payments.show', $payment)
->with('flash.success', 'Fake gateway callback processed.');
⋮----
public function settle(Payment $payment): RedirectResponse
⋮----
$this->authorize('settle', $payment);
⋮----
$this->payments->settleManually($payment, Auth::user());
⋮----
->with('flash.success', 'Payment settled.');
⋮----
/**
     * @return array<string, mixed>
     */
private function paymentSummary(Payment $payment): array
⋮----
'method_label' => $payment->method->label(),
⋮----
'status_label' => $payment->status->label(),
⋮----
'payable' => $this->payableSummary($payable),
⋮----
private function paymentDetail(Payment $payment): array
⋮----
...$this->paymentSummary($payment),
'is_placeholder' => $payment->method->isPlaceholder(),
⋮----
/**
     * @return array<string, mixed>|null
     */
private function payableSummary(mixed $payable): ?array
````

## File: app/Http/Controllers/Web/Stock/StockAdjustmentController.php
````php
namespace App\Http\Controllers\Web\Stock;
⋮----
use App\Http\Controllers\Controller;
use App\Http\Requests\Stock\StoreStockAdjustmentRequest;
use App\Models\Product;
use App\Models\Warehouse;
use App\Services\CatalogService;
use App\Services\StockService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
⋮----
class StockAdjustmentController extends Controller
⋮----
public function __construct(
⋮----
public function create(): Response
⋮----
return Inertia::render('Stock/Adjustments/Create', [
'products' => collect($this->catalog->listProducts(1000)->items())->map->only(['id', 'name', 'sku']),
'warehouses' => $this->stock->listActiveWarehouses()->map->only(['id', 'name', 'code']),
⋮----
public function store(StoreStockAdjustmentRequest $request): RedirectResponse
⋮----
$data = $request->validated();
⋮----
$product = Product::query()->findOrFail($data['product_id']);
$warehouse = Warehouse::query()->findOrFail($data['warehouse_id']);
⋮----
$level = $this->stock->adjust(
⋮----
Auth::user(),
⋮----
->route('stock.levels.index')
->with('flash.success', "Stock adjusted for \"{$product->name}\" at {$warehouse->name} — on hand is now {$level->on_hand}.");
````

## File: app/Http/Controllers/Web/Stock/StockLevelController.php
````php
namespace App\Http\Controllers\Web\Stock;
⋮----
use App\Http\Controllers\Controller;
use App\Models\StockLevel;
use App\Services\CatalogService;
use App\Services\StockService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
⋮----
class StockLevelController extends Controller
⋮----
public function __construct(
⋮----
public function index(Request $request): Response
⋮----
$productId = $request->string('product_id')->toString() ?: null;
$warehouseId = $request->string('warehouse_id')->toString() ?: null;
⋮----
$levels = $this->stock->listLevels(15, [
⋮----
])->through(fn (StockLevel $level) => [
⋮----
return Inertia::render('Stock/Levels/Index', [
⋮----
'products' => collect($this->catalog->listProducts(1000)->items())->map->only(['id', 'name', 'sku']),
'warehouses' => $this->stock->listActiveWarehouses()->map->only(['id', 'name', 'code']),
````

## File: app/Http/Controllers/Web/Stock/StockMovementController.php
````php
namespace App\Http\Controllers\Web\Stock;
⋮----
use App\Enums\MovementType;
use App\Http\Controllers\Controller;
use App\Models\StockMovement;
use App\Services\CatalogService;
use App\Services\StockService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
⋮----
class StockMovementController extends Controller
⋮----
public function __construct(
⋮----
public function index(Request $request): Response
⋮----
$productId = $request->string('product_id')->toString() ?: null;
$warehouseId = $request->string('warehouse_id')->toString() ?: null;
$type = $request->string('type')->toString() ?: null;
⋮----
$movements = $this->stock->listMovements(20, [
⋮----
])->through(fn (StockMovement $movement) => [
⋮----
'type_label' => $movement->type->label(),
⋮----
return Inertia::render('Stock/Movements/Index', [
⋮----
'products' => collect($this->catalog->listProducts(1000)->items())->map->only(['id', 'name', 'sku']),
'warehouses' => $this->stock->listActiveWarehouses()->map->only(['id', 'name', 'code']),
'types' => collect(MovementType::cases())->map(fn (MovementType $type) => [
⋮----
'label' => $type->label(),
````

## File: app/Http/Controllers/Web/Stock/StockReconciliationController.php
````php
namespace App\Http\Controllers\Web\Stock;
⋮----
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Warehouse;
use App\Services\CatalogService;
use App\Services\StockService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
⋮----
/**
 * Read-only reconciliation report: proves (or disproves) that stock_levels
 * matches what the immutable stock_movements ledger says it should be. No
 * mutation, so `stock.move` and `audit.read` are both accepted gates — see
 * routes/web.php.
 */
class StockReconciliationController extends Controller
⋮----
public function __construct(
⋮----
public function show(Request $request): Response
⋮----
return Inertia::render('Stock/Reconciliation/Show', [
'results' => $this->runReconciliation($request),
'filters' => $this->filters($request),
'products' => collect($this->catalog->listProducts(1000)->items())->map->only(['id', 'name', 'sku']),
'warehouses' => $this->stock->listActiveWarehouses()->map->only(['id', 'name', 'code']),
⋮----
public function run(Request $request): RedirectResponse
⋮----
$results = $this->runReconciliation($request);
$mismatches = $results->reject(fn (array $row) => $row['on_hand_matches'] && $row['reserved_matches'])->count();
⋮----
->route('stock.reconcile.show', $this->filters($request))
->with(
⋮----
/** @return array{product_id: ?string, warehouse_id: ?string} */
private function filters(Request $request): array
⋮----
'product_id' => $request->string('product_id')->toString() ?: null,
'warehouse_id' => $request->string('warehouse_id')->toString() ?: null,
⋮----
private function runReconciliation(Request $request)
⋮----
$filters = $this->filters($request);
⋮----
$product = $filters['product_id'] ? Product::query()->find($filters['product_id']) : null;
$warehouse = $filters['warehouse_id'] ? Warehouse::query()->find($filters['warehouse_id']) : null;
⋮----
return $this->stock->reconcile($product, $warehouse);
````

## File: app/Http/Controllers/Web/Stock/StockTransferController.php
````php
namespace App\Http\Controllers\Web\Stock;
⋮----
use App\Http\Controllers\Controller;
use App\Http\Requests\Stock\StoreStockTransferRequest;
use App\Models\Product;
use App\Models\Warehouse;
use App\Services\CatalogService;
use App\Services\StockService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
⋮----
class StockTransferController extends Controller
⋮----
public function __construct(
⋮----
public function create(): Response
⋮----
return Inertia::render('Stock/Transfers/Create', [
'products' => collect($this->catalog->listProducts(1000)->items())->map->only(['id', 'name', 'sku']),
'warehouses' => $this->stock->listActiveWarehouses()->map->only(['id', 'name', 'code']),
⋮----
public function store(StoreStockTransferRequest $request): RedirectResponse
⋮----
$data = $request->validated();
⋮----
$product = Product::query()->findOrFail($data['product_id']);
$fromWarehouse = Warehouse::query()->findOrFail($data['from_warehouse_id']);
$toWarehouse = Warehouse::query()->findOrFail($data['to_warehouse_id']);
⋮----
$this->stock->transfer(
⋮----
Auth::user(),
⋮----
->route('stock.levels.index')
->with('flash.success', "Transferred {$data['quantity']} × \"{$product->name}\" from {$fromWarehouse->name} to {$toWarehouse->name}.");
````

## File: app/Http/Controllers/Web/Storefront/CartController.php
````php
namespace App\Http\Controllers\Web\Storefront;
⋮----
use App\Http\Controllers\Controller;
use App\Http\Requests\Storefront\AddToCartRequest;
use App\Http\Requests\Storefront\UpdateCartItemRequest;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
⋮----
/**
 * Guest-accessible: the cart is session state, not a Model, so there's no
 * login/permission gate here at all (see routes/web.php). Never reserves
 * stock or writes anything but the session — see CartService's docblock.
 */
class CartController extends Controller
⋮----
/**
     * Same flat 14% VAT as OrderService — this is a display-only estimate
     * for the cart page; the authoritative total is always recomputed
     * server-side by OrderService::checkout() at checkout time.
     */
⋮----
public function __construct(private readonly CartService $cart) {}
⋮----
public function show(): Response
⋮----
return Inertia::render('Storefront/Cart/Show', $this->cartProps());
⋮----
public function store(AddToCartRequest $request): RedirectResponse
⋮----
$data = $request->validated();
⋮----
$this->cart->add($data['product_id'], (int) $data['quantity']);
⋮----
return redirect()->route('cart.show')->with('flash.success', 'Added to cart.');
⋮----
public function update(UpdateCartItemRequest $request, string $item): RedirectResponse
⋮----
$this->cart->updateQuantity($item, (int) $request->validated('quantity'));
⋮----
return redirect()->route('cart.show')->with('flash.success', 'Cart updated.');
⋮----
public function destroy(string $item): RedirectResponse
⋮----
$this->cart->remove($item);
⋮----
return redirect()->route('cart.show')->with('flash.success', 'Removed from cart.');
⋮----
public function clear(): RedirectResponse
⋮----
$this->cart->clear();
⋮----
return redirect()->route('cart.show')->with('flash.success', 'Cart cleared.');
⋮----
/**
     * @return array<string, mixed>
     */
private function cartProps(): array
⋮----
$lines = $this->cart->lines();
$subtotal = $this->cart->subtotal();
⋮----
'lines' => $lines->map(fn (array $line) => [
'product' => $line['product']->only(['id', 'name', 'sku']),
````

## File: app/Http/Controllers/Web/Storefront/CategoryBrowseController.php
````php
namespace App\Http\Controllers\Web\Storefront;
⋮----
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\StorefrontCatalogService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
⋮----
/**
 * Public category product listing — no auth, no permission. See Guest
 * rule #4. Categories have no is_active column (see
 * docs/project/canonical-decisions.md), so implicit route-model binding
 * by slug is safe here without the scoping concerns that block it for
 * Product (see ProductBrowseController — inactive products must 404).
 */
class CategoryBrowseController extends Controller
⋮----
public function __construct(private readonly StorefrontCatalogService $catalog) {}
⋮----
public function show(Category $category, Request $request): Response
⋮----
$search = $request->string('search')->toString() ?: null;
⋮----
$products = $this->catalog->listActiveProducts(12, [
⋮----
return Inertia::render('Storefront/Categories/Show', [
'category' => $category->only(['id', 'name', 'slug']),
'products' => $this->catalog->presentPaginated($products),
````

## File: app/Http/Controllers/Web/Storefront/HomeController.php
````php
namespace App\Http\Controllers\Web\Storefront;
⋮----
use App\Http\Controllers\Controller;
use App\Services\StorefrontCatalogService;
use Inertia\Inertia;
use Inertia\Response;
⋮----
/**
 * Public home page — no auth, no permission. See Guest rule #1.
 */
class HomeController extends Controller
⋮----
public function __construct(private readonly StorefrontCatalogService $catalog) {}
⋮----
public function __invoke(): Response
⋮----
$featured = $this->catalog->listActiveProducts(8);
⋮----
return Inertia::render('Storefront/Home', [
'featuredProducts' => $this->catalog->presentPaginated($featured)->items(),
````

## File: app/Http/Controllers/Web/Storefront/ProductBrowseController.php
````php
namespace App\Http\Controllers\Web\Storefront;
⋮----
use App\Http\Controllers\Controller;
use App\Services\StorefrontCatalogService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
⋮----
/**
 * Public product listing + detail — no auth, no permission. See Guest
 * rules #2, #4, #5, #6, #7.
 */
class ProductBrowseController extends Controller
⋮----
public function __construct(private readonly StorefrontCatalogService $catalog) {}
⋮----
public function index(Request $request): Response
⋮----
$search = $request->string('search')->toString() ?: null;
$categoryId = $request->string('category_id')->toString() ?: null;
⋮----
$products = $this->catalog->listActiveProducts(12, [
⋮----
return Inertia::render('Storefront/Products/Index', [
'products' => $this->catalog->presentPaginated($products),
⋮----
public function show(string $sku): Response
⋮----
$product = $this->catalog->findActiveProductBySku($sku);
⋮----
return Inertia::render('Storefront/Products/Show', [
'product' => $this->catalog->presentProduct($product),
````

## File: app/Http/Controllers/Web/Storefront/SearchController.php
````php
namespace App\Http\Controllers\Web\Storefront;
⋮----
use App\Http\Controllers\Controller;
use App\Services\StorefrontCatalogService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
⋮----
/**
 * Public product search — no auth, no permission. See Guest rule #3.
 * Kept as a distinct page/route from Storefront/Products/Index (which also
 * accepts a `search` filter) because a dedicated /search URL is what the
 * storefront's search box submits to, and keeps that intent separate from
 * "browsing the full catalog with a filter applied".
 */
class SearchController extends Controller
⋮----
public function __construct(private readonly StorefrontCatalogService $catalog) {}
⋮----
public function index(Request $request): Response
⋮----
$query = $request->string('q')->toString() ?: null;
⋮----
? $this->catalog->presentPaginated($this->catalog->listActiveProducts(12, ['search' => $query]))
⋮----
return Inertia::render('Storefront/Search', [
````

## File: app/Http/Controllers/Web/DashboardController.php
````php
namespace App\Http\Controllers\Web;
⋮----
use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
⋮----
class DashboardController extends Controller
⋮----
public function __construct(private readonly DashboardService $dashboard) {}
⋮----
public function __invoke(Request $request): Response
⋮----
return Inertia::render('Dashboard', [
'kpis' => $this->dashboard->kpisFor(Auth::user()),
````

## File: app/Http/Controllers/Webhooks/.gitkeep
````

````

## File: app/Http/Controllers/Webhooks/FakeGatewayWebhookController.php
````php
namespace App\Http\Controllers\Webhooks;
⋮----
use App\Enums\PaymentMethod;
use App\Http\Controllers\Controller;
use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
⋮----
class FakeGatewayWebhookController extends Controller
⋮----
public function __invoke(Request $request, PaymentService $payments): JsonResponse
⋮----
$payment = $payments->verifyWebhook(
⋮----
$request->all(),
$this->headers($request),
⋮----
return response()->json([
⋮----
/**
     * @return array<string, mixed>
     */
private function headers(Request $request): array
⋮----
...$request->headers->all(),
'x-fake-gateway-signature' => $request->header('X-Fake-Gateway-Signature'),
'raw_body' => $request->getContent(),
````

## File: app/Http/Controllers/Webhooks/FawryWebhookController.php
````php
namespace App\Http\Controllers\Webhooks;
⋮----
use App\Enums\PaymentMethod;
use App\Http\Controllers\Controller;
use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
⋮----
class FawryWebhookController extends Controller
⋮----
public function __invoke(Request $request, PaymentService $payments): JsonResponse
⋮----
$payment = $payments->verifyWebhook(
⋮----
$request->all(),
$this->headers($request),
⋮----
return response()->json([
⋮----
/**
     * @return array<string, mixed>
     */
private function headers(Request $request): array
⋮----
...$request->headers->all(),
'x-fawry-signature' => $request->header('X-Fawry-Signature'),
'raw_body' => $request->getContent(),
````

## File: app/Http/Controllers/Webhooks/PaymobWebhookController.php
````php
namespace App\Http\Controllers\Webhooks;
⋮----
use App\Enums\PaymentMethod;
use App\Http\Controllers\Controller;
use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
⋮----
class PaymobWebhookController extends Controller
⋮----
public function __invoke(Request $request, PaymentService $payments): JsonResponse
⋮----
$payment = $payments->verifyWebhook(
⋮----
$request->all(),
$this->headers($request),
⋮----
return response()->json([
⋮----
/**
     * @return array<string, mixed>
     */
private function headers(Request $request): array
⋮----
...$request->headers->all(),
'x-paymob-signature' => $request->header('X-Paymob-Signature'),
'raw_body' => $request->getContent(),
````

## File: app/Http/Controllers/Controller.php
````php
namespace App\Http\Controllers;
⋮----
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
⋮----
abstract class Controller
````

## File: app/Http/Middleware/AuthenticateApiClientCredentials.php
````php
namespace App\Http\Middleware;
⋮----
use App\Auth\ApiClientPrincipal;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\AccessToken;
use Laravel\Passport\ClientRepository;
use League\OAuth2\Server\Exception\OAuthServerException;
use League\OAuth2\Server\ResourceServer;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Symfony\Component\HttpFoundation\Response;
⋮----
class AuthenticateApiClientCredentials
⋮----
public function __construct(
⋮----
/**
     * Allow Passport client-credentials tokens to satisfy `auth:api` as a
     * scoped, read-only machine principal. User bearer tokens are left to the
     * normal Passport guard.
     */
public function handle(Request $request, Closure $next): Response
⋮----
if (! $request->bearerToken() || Auth::guard('api')->user()) {
return $next($request);
⋮----
$psrRequest = (new PsrHttpFactory)->createRequest($request);
⋮----
$psrRequest = $this->server->validateAuthenticatedRequest($psrRequest);
⋮----
$oauthUserId = $psrRequest->getAttribute('oauth_user_id');
$clientId = $psrRequest->getAttribute('oauth_client_id');
⋮----
$client = $this->clients->findActive($clientId);
⋮----
->withAccessToken(AccessToken::fromPsrRequest($psrRequest));
⋮----
Auth::guard('api')->setUser($principal);
````

## File: app/Http/Middleware/EnsureApiRequestsJson.php
````php
namespace App\Http\Middleware;
⋮----
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
⋮----
class EnsureApiRequestsJson
⋮----
/**
     * @param  Closure(Request): Response  $next
     */
public function handle(Request $request, Closure $next): Response
⋮----
if (! $request->expectsJson() && ! $request->acceptsAnyContentType()) {
return response()->json([
⋮----
if (in_array($request->method(), ['POST', 'PUT', 'PATCH'], true)
&& $request->getContent() !== ''
&& ! $request->isJson()) {
⋮----
return $next($request);
````

## File: app/Http/Middleware/EnsureCheckoutIsAuthenticated.php
````php
namespace App\Http\Middleware;
⋮----
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
⋮----
/**
 * The /checkout entry gate (Guest rule #18). Applied to both GET and POST
 * /checkout, ahead of `throttle:checkout` in the middleware stack, so a
 * guest never reaches StoreCheckoutRequest::authorize() — that method
 * assumes an authenticated user ($this->user()->can(...)) and would throw
 * on a null user rather than redirect. Kept as a dedicated middleware
 * rather than a wrapper controller so CheckoutController's create()/
 * store() logic is never duplicated: once this gate passes, the existing
 * CheckoutController (and its own `sale.create` policy check) is
 * unchanged. Gives a specific flash message, unlike the default `auth`
 * middleware's silent redirect, so a guest who's been browsing anonymously
 * understands why they landed on the login page.
 */
class EnsureCheckoutIsAuthenticated
⋮----
public function handle(Request $request, Closure $next): Response
⋮----
if (! Auth::check()) {
return redirect()->route('login')->with('flash.error', 'Please log in to complete your order.');
⋮----
return $next($request);
````

## File: app/Http/Middleware/HandleInertiaRequests.php
````php
namespace App\Http\Middleware;
⋮----
use App\Services\CartService;
use App\Services\StorefrontCatalogService;
use Illuminate\Http\Request;
use Inertia\Middleware;
⋮----
class HandleInertiaRequests extends Middleware
⋮----
/**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
protected $rootView = 'app';
⋮----
public function __construct(
⋮----
/**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
public function version(Request $request): ?string
⋮----
return parent::version($request);
⋮----
/**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
public function share(Request $request): array
⋮----
$user = $request->user();
⋮----
...parent::share($request),
⋮----
// Cosmetic only — the server (route middleware/policies)
// always re-enforces. See docs/project/canonical-decisions.md §3.
'roles' => fn () => $user?->roles()->pluck('name')->all() ?? [],
'permissions' => fn () => $user?->allPermissions()->pluck('name')->all() ?? [],
⋮----
// Populated once warehouse-scoped teams/warehouses exist; null until then.
⋮----
'success' => fn () => $request->session()->get('flash.success'),
'error' => fn () => $request->session()->get('flash.error'),
⋮----
// Cart is session state (guest or authenticated) — shared
// everywhere so the storefront header badge doesn't need a
// dedicated round trip. Session read only, cheap.
⋮----
'count' => fn () => $this->cart->count(),
'subtotal' => fn () => $this->cart->subtotal(),
⋮----
// Cached (StorefrontCatalogService -> CatalogService::
// listCategories(), tag 'catalog') — shared globally so
// StorefrontLayout's category nav renders on every storefront
// page without each controller having to pass it explicitly.
'publicCategories' => fn () => $this->storefrontCatalog->publicCategories(),
````

## File: app/Http/Middleware/SecurityHeaders.php
````php
namespace App\Http\Middleware;
⋮----
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
⋮----
/**
 * Baseline security headers for every response (web, api, webhooks).
 *
 * No CSP here: Inertia/Vite inject per-request script nonces nowhere in
 * this app yet, and the React bundle relies on inline style attributes
 * from a couple of UI libraries — a naive CSP would break the app rather
 * than harden it. The headers below are safe defaults with no such
 * trade-off. Revisit CSP as a dedicated task once nonce plumbing exists.
 */
class SecurityHeaders
⋮----
public function handle(Request $request, Closure $next): Response
⋮----
$response = $next($request);
⋮----
$response->headers->set('X-Content-Type-Options', 'nosniff');
$response->headers->set('X-Frame-Options', 'DENY');
$response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
$response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');
⋮----
if ($request->secure()) {
$response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
````

## File: app/Http/Middleware/WarehouseScopeMiddleware.php
````php
namespace App\Http\Middleware;
⋮----
use App\Enums\PermissionName;
use App\Exceptions\UnauthorizedWarehouseException;
use App\Models\Warehouse;
use App\Support\WarehouseAccess;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
⋮----
/**
 * Route-level, defense-in-depth counterpart to StockPolicy: rejects a
 * stock.move/stock.transfer request before it ever reaches the controller
 * if the acting user isn't scoped to every warehouse the request touches
 * (via Laratrust teams — see App\Support\WarehouseAccess).
 *
 * Usage: `->middleware('warehouse.scope:stock.move')` on a route whose
 * request carries `warehouse_id`, or `from_warehouse_id`/`to_warehouse_id`
 * for transfers. See docs/project/canonical-decisions.md §3.
 */
class WarehouseScopeMiddleware
⋮----
public function handle(Request $request, Closure $next, string $permission): Response
⋮----
$user = $request->user();
$permissionEnum = PermissionName::from($permission);
⋮----
foreach ($this->resolveWarehouseIds($request) as $warehouseId) {
$warehouse = Warehouse::query()->find($warehouseId);
⋮----
// An unknown/missing id isn't this middleware's job — the
// FormRequest's `exists:warehouses,id` rule rejects it with a
// normal validation error instead of a 403.
⋮----
if (! WarehouseAccess::allows($user, $warehouse, $permissionEnum)) {
throw UnauthorizedWarehouseException::forWarehouse($warehouseId);
⋮----
return $next($request);
⋮----
/**
     * @return list<string>
     */
private function resolveWarehouseIds(Request $request): array
⋮----
$routeWarehouse = $request->route('warehouse');
⋮----
$request->input('warehouse_id'),
$request->input('from_warehouse_id'),
$request->input('to_warehouse_id'),
````

## File: app/Http/Requests/Admin/UpdateRolePermissionsRequest.php
````php
namespace App\Http\Requests\Admin;
⋮----
use App\Enums\PermissionName;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
⋮----
class UpdateRolePermissionsRequest extends FormRequest
⋮----
/**
     * Route middleware (`permission:role.manage`) is the real gate; this
     * FormRequest only validates shape.
     */
public function authorize(): bool
⋮----
/**
     * @return array<string, array<int, mixed>>
     */
public function rules(): array
⋮----
'permissions.*' => ['string', Rule::in(array_column(PermissionName::cases(), 'value'))],
⋮----
/**
     * @return list<string>
     */
public function permissionNames(): array
⋮----
return $this->input('permissions', []);
````

## File: app/Http/Requests/Admin/UpdateUserRolesRequest.php
````php
namespace App\Http\Requests\Admin;
⋮----
use App\Enums\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
⋮----
class UpdateUserRolesRequest extends FormRequest
⋮----
/**
     * Route middleware (`permission:role.manage`) is the real gate; this
     * FormRequest only validates shape.
     */
public function authorize(): bool
⋮----
/**
     * @return array<string, array<int, mixed>>
     */
public function rules(): array
⋮----
'roles.*' => ['string', Rule::in(array_column(UserRole::cases(), 'value'))],
⋮----
/**
     * @return list<string>
     */
public function roleNames(): array
⋮----
return $this->input('roles', []);
````

## File: app/Http/Requests/Api/V1/AcceptPurchaseOrderRequest.php
````php
namespace App\Http\Requests\Api\V1;
⋮----
use Illuminate\Foundation\Http\FormRequest;
⋮----
class AcceptPurchaseOrderRequest extends FormRequest
⋮----
public function authorize(): bool
⋮----
$purchaseOrder = $this->route('purchaseOrder');
⋮----
&& ($this->user()?->can('view', $purchaseOrder) ?? false);
⋮----
/**
     * @return array<string, array<int, mixed>>
     */
public function rules(): array
````

## File: app/Http/Requests/Api/V1/ListPaymentsRequest.php
````php
namespace App\Http\Requests\Api\V1;
⋮----
use App\Enums\PermissionName;
use Illuminate\Foundation\Http\FormRequest;
⋮----
class ListPaymentsRequest extends FormRequest
⋮----
public function authorize(): bool
⋮----
$user = $this->user();
⋮----
$user->isAbleTo(PermissionName::QuoteRequest->value)
|| $user->isAbleTo(PermissionName::PaymentSettle->value)
⋮----
/**
     * @return array<string, array<int, mixed>>
     */
public function rules(): array
````

## File: app/Http/Requests/Api/V1/ListProductsRequest.php
````php
namespace App\Http\Requests\Api\V1;
⋮----
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
⋮----
class ListProductsRequest extends FormRequest
⋮----
public function authorize(): bool
⋮----
return $this->user()?->can('viewAny', Product::class) ?? false;
⋮----
/**
     * @return array<string, array<int, mixed>>
     */
public function rules(): array
````

## File: app/Http/Requests/Api/V1/ListPurchaseOrdersRequest.php
````php
namespace App\Http\Requests\Api\V1;
⋮----
use App\Enums\PermissionName;
use Illuminate\Foundation\Http\FormRequest;
⋮----
class ListPurchaseOrdersRequest extends FormRequest
⋮----
public function authorize(): bool
⋮----
$user = $this->user();
⋮----
$user->isAbleTo(PermissionName::QuoteRequest->value)
|| $user->isAbleTo(PermissionName::PoApprove->value)
|| $user->isAbleTo(PermissionName::PaymentSettle->value)
⋮----
/**
     * @return array<string, array<int, mixed>>
     */
public function rules(): array
````

## File: app/Http/Requests/Api/V1/ListQuotesRequest.php
````php
namespace App\Http\Requests\Api\V1;
⋮----
use App\Enums\PermissionName;
use Illuminate\Foundation\Http\FormRequest;
⋮----
class ListQuotesRequest extends FormRequest
⋮----
public function authorize(): bool
⋮----
$user = $this->user();
⋮----
$user->isAbleTo(PermissionName::QuoteRequest->value)
|| $user->isAbleTo(PermissionName::QuotePrice->value)
|| $user->isAbleTo(PermissionName::PoApprove->value)
⋮----
/**
     * @return array<string, array<int, mixed>>
     */
public function rules(): array
````

## File: app/Http/Requests/Api/V1/StockAvailabilityRequest.php
````php
namespace App\Http\Requests\Api\V1;
⋮----
use App\Enums\PermissionName;
use Illuminate\Foundation\Http\FormRequest;
⋮----
class StockAvailabilityRequest extends FormRequest
⋮----
public function authorize(): bool
⋮----
return $this->user()?->isAbleTo(PermissionName::StockRead->value) ?? false;
⋮----
/**
     * @return array<string, array<int, mixed>>
     */
public function rules(): array
````

## File: app/Http/Requests/Api/V1/StoreBankTransferProofRequest.php
````php
namespace App\Http\Requests\Api\V1;
⋮----
use App\Models\PurchaseOrder;
use Illuminate\Foundation\Http\FormRequest;
⋮----
class StoreBankTransferProofRequest extends FormRequest
⋮----
public function authorize(): bool
⋮----
$purchaseOrder = PurchaseOrder::query()->find($this->input('purchase_order_id'));
⋮----
&& ($this->user()?->can('view', $purchaseOrder) ?? false);
⋮----
/**
     * @return array<string, array<int, mixed>>
     */
public function rules(): array
````

## File: app/Http/Requests/Api/V1/StoreQuoteRequest.php
````php
namespace App\Http\Requests\Api\V1;
⋮----
use App\Models\Quote;
use Illuminate\Foundation\Http\FormRequest;
⋮----
class StoreQuoteRequest extends FormRequest
⋮----
public function authorize(): bool
⋮----
return ($this->user()?->can('create', Quote::class) ?? false)
&& $this->user()?->businessAccount !== null;
⋮----
/**
     * @return array<string, array<int, mixed>>
     */
public function rules(): array
````

## File: app/Http/Requests/Auth/LoginRequest.php
````php
namespace App\Http\Requests\Auth;
⋮----
use Illuminate\Foundation\Http\FormRequest;
⋮----
class LoginRequest extends FormRequest
⋮----
/**
     * Anyone may attempt to log in; Auth::attempt() is the real gate.
     */
public function authorize(): bool
⋮----
/**
     * @return array<string, array<int, string>>
     */
public function rules(): array
⋮----
/**
     * @return array{email: string, password: string}
     */
public function credentials(): array
⋮----
return $this->only('email', 'password');
⋮----
public function remember(): bool
⋮----
return $this->boolean('remember');
````

## File: app/Http/Requests/Catalog/StoreCategoryRequest.php
````php
namespace App\Http\Requests\Catalog;
⋮----
use App\Enums\PermissionName;
use Illuminate\Foundation\Http\FormRequest;
⋮----
class StoreCategoryRequest extends FormRequest
⋮----
/**
     * Categories have no ownership concept (unlike products/price-list
     * items), so the `category.manage` permission alone — already enforced
     * by route middleware — is the full gate. No CategoryPolicy needed.
     */
public function authorize(): bool
⋮----
return $this->user()->isAbleTo(PermissionName::CategoryManage->value);
⋮----
/**
     * @return array<string, array<int, mixed>>
     */
public function rules(): array
````

## File: app/Http/Requests/Catalog/StorePriceListItemRequest.php
````php
namespace App\Http\Requests\Catalog;
⋮----
use App\Enums\PermissionName;
use App\Enums\UserRole;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
⋮----
class StorePriceListItemRequest extends FormRequest
⋮----
/**
     * A Vendor may only add items for their own products (Enterprise PRD
     * §3, pricelist.manage "own"). There's no PriceListItem yet to hand to
     * a Policy at create time, so the ownership check is done here against
     * the submitted product_id.
     */
public function authorize(): bool
⋮----
$user = $this->user();
⋮----
if (! $user->isAbleTo(PermissionName::PricelistManage->value)) {
⋮----
if (! $user->hasRole(UserRole::VendorSupplier->value)) {
⋮----
$product = Product::query()->find($this->input('product_id'));
⋮----
/**
     * @return array<string, array<int, mixed>>
     */
public function rules(): array
````

## File: app/Http/Requests/Catalog/StorePriceListRequest.php
````php
namespace App\Http\Requests\Catalog;
⋮----
use App\Enums\PriceListType;
use App\Models\PriceList;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
⋮----
class StorePriceListRequest extends FormRequest
⋮----
public function authorize(): bool
⋮----
return $this->user()->can('create', PriceList::class);
⋮----
/**
     * @return array<string, array<int, mixed>>
     */
public function rules(): array
⋮----
'type' => ['required', Rule::in(array_column(PriceListType::cases(), 'value'))],
````

## File: app/Http/Requests/Catalog/StoreProductRequest.php
````php
namespace App\Http\Requests\Catalog;
⋮----
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
⋮----
class StoreProductRequest extends FormRequest
⋮----
public function authorize(): bool
⋮----
return $this->user()->can('create', Product::class);
⋮----
/**
     * @return array<string, array<int, mixed>>
     */
public function rules(): array
````

## File: app/Http/Requests/Catalog/StoreSupplierRequest.php
````php
namespace App\Http\Requests\Catalog;
⋮----
use App\Enums\PermissionName;
use Illuminate\Foundation\Http\FormRequest;
⋮----
class StoreSupplierRequest extends FormRequest
⋮----
/**
     * Suppliers have no dedicated PRD permission; gated under
     * `product.manage` since they're a product-catalog concern managed by
     * the same roles (SuperAdmin, Inventory Manager).
     */
public function authorize(): bool
⋮----
return $this->user()->isAbleTo(PermissionName::ProductManage->value);
⋮----
/**
     * @return array<string, array<int, mixed>>
     */
public function rules(): array
````

## File: app/Http/Requests/Catalog/UpdatePriceListItemRequest.php
````php
namespace App\Http\Requests\Catalog;
⋮----
use Illuminate\Foundation\Http\FormRequest;
⋮----
class UpdatePriceListItemRequest extends FormRequest
⋮----
public function authorize(): bool
⋮----
return $this->user()->can('updateItem', $this->route('priceListItem'));
⋮----
/**
     * @return array<string, array<int, mixed>>
     */
public function rules(): array
````

## File: app/Http/Requests/Catalog/UpdateProductRequest.php
````php
namespace App\Http\Requests\Catalog;
⋮----
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
⋮----
class UpdateProductRequest extends FormRequest
⋮----
public function authorize(): bool
⋮----
return $this->user()->can('update', $this->route('product'));
⋮----
/**
     * @return array<string, array<int, mixed>>
     */
public function rules(): array
⋮----
Rule::unique('products', 'sku')->ignore($this->route('product')),
````

## File: app/Http/Requests/Import/StoreImportRequest.php
````php
namespace App\Http\Requests\Import;
⋮----
use App\Enums\ImportEntity;
use App\Enums\PermissionName;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
⋮----
class StoreImportRequest extends FormRequest
⋮----
public function authorize(): bool
⋮----
return $this->user()?->isAbleTo(PermissionName::ImportRun->value) ?? false;
⋮----
/**
     * @return array<string, array<int, mixed>>
     */
public function rules(): array
⋮----
'entity' => ['required', Rule::in(array_column(ImportEntity::cases(), 'value'))],
````

## File: app/Http/Requests/Procurement/ApprovePurchaseOrderRequest.php
````php
namespace App\Http\Requests\Procurement;
⋮----
use Illuminate\Foundation\Http\FormRequest;
⋮----
class ApprovePurchaseOrderRequest extends FormRequest
⋮----
public function authorize(): bool
⋮----
$purchaseOrder = $this->route('purchaseOrder');
⋮----
return $purchaseOrder !== null && $this->user()->can('approve', $purchaseOrder);
⋮----
/**
     * @return array<string, array<int, mixed>>
     */
public function rules(): array
````

## File: app/Http/Requests/Procurement/PriceQuoteRequest.php
````php
namespace App\Http\Requests\Procurement;
⋮----
use Illuminate\Foundation\Http\FormRequest;
⋮----
class PriceQuoteRequest extends FormRequest
⋮----
/**
     * QuotePolicy::price() does the real (own-pricing-context) check —
     * `quote` here is the route-bound Quote model.
     */
public function authorize(): bool
⋮----
$quote = $this->route('quote');
⋮----
return $quote !== null && $this->user()->can('price', $quote);
⋮----
/**
     * @return array<string, array<int, mixed>>
     */
public function rules(): array
````

## File: app/Http/Requests/Procurement/RejectPurchaseOrderRequest.php
````php
namespace App\Http\Requests\Procurement;
⋮----
use Illuminate\Foundation\Http\FormRequest;
⋮----
class RejectPurchaseOrderRequest extends FormRequest
⋮----
public function authorize(): bool
⋮----
$purchaseOrder = $this->route('purchaseOrder');
⋮----
return $purchaseOrder !== null && $this->user()->can('reject', $purchaseOrder);
⋮----
/**
     * @return array<string, array<int, mixed>>
     */
public function rules(): array
````

## File: app/Http/Requests/Procurement/StoreBankTransferSettlementRequest.php
````php
namespace App\Http\Requests\Procurement;
⋮----
use Illuminate\Foundation\Http\FormRequest;
⋮----
class StoreBankTransferSettlementRequest extends FormRequest
⋮----
public function authorize(): bool
⋮----
$purchaseOrder = $this->route('purchaseOrder');
⋮----
return $purchaseOrder !== null && $this->user()->can('settle', $purchaseOrder);
⋮----
/**
     * @return array<string, array<int, mixed>>
     */
public function rules(): array
````

## File: app/Http/Requests/Procurement/StoreQuoteRequest.php
````php
namespace App\Http\Requests\Procurement;
⋮----
use App\Models\Quote;
use Illuminate\Foundation\Http\FormRequest;
⋮----
class StoreQuoteRequest extends FormRequest
⋮----
public function authorize(): bool
⋮----
return $this->user()->can('create', Quote::class);
⋮----
/**
     * @return array<string, array<int, mixed>>
     */
public function rules(): array
````

## File: app/Http/Requests/Sales/StoreCheckoutRequest.php
````php
namespace App\Http\Requests\Sales;
⋮----
use App\Enums\PaymentMethod;
use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
⋮----
class StoreCheckoutRequest extends FormRequest
⋮----
/**
     * OrderPolicy::create() is the real gate (`sale.create`) — checked here
     * rather than only via route middleware, per the task's explicit "Use
     * OrderPolicy" requirement.
     */
public function authorize(): bool
⋮----
return $this->user()->can('create', Order::class);
⋮----
/**
     * @return array<string, array<int, mixed>>
     */
public function rules(): array
⋮----
'payment_method' => ['required', Rule::in([
⋮----
// Only meaningful for payment_method=fake_gateway — lets a demo/test
// checkout choose the simulated outcome. Ignored by every other
// gateway driver.
'outcome' => ['nullable', Rule::in(['succeed', 'fail'])],
````

## File: app/Http/Requests/Stock/StoreStockAdjustmentRequest.php
````php
namespace App\Http\Requests\Stock;
⋮----
use App\Models\Warehouse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
⋮----
class StoreStockAdjustmentRequest extends FormRequest
⋮----
/**
     * StockPolicy::adjust() does the real (warehouse-team-scoped) check;
     * `warehouse_id` is only in the request body (no route-bound model) so
     * it's resolved here first.
     */
public function authorize(): bool
⋮----
$warehouse = Warehouse::query()->find($this->input('warehouse_id'));
⋮----
return $warehouse !== null && $this->user()->can('adjust', $warehouse);
⋮----
/**
     * @return array<string, array<int, mixed>>
     */
public function rules(): array
⋮----
'quantity' => ['required', 'integer', Rule::notIn([0])],
````

## File: app/Http/Requests/Stock/StoreStockTransferRequest.php
````php
namespace App\Http\Requests\Stock;
⋮----
use App\Models\Warehouse;
use Illuminate\Foundation\Http\FormRequest;
⋮----
class StoreStockTransferRequest extends FormRequest
⋮----
/**
     * StockPolicy::transfer() does the real (warehouse-team-scoped) check
     * against both warehouses; they're only in the request body (no
     * route-bound model) so they're resolved here first.
     */
public function authorize(): bool
⋮----
$from = Warehouse::query()->find($this->input('from_warehouse_id'));
$to = Warehouse::query()->find($this->input('to_warehouse_id'));
⋮----
return $from !== null && $to !== null && $this->user()->can('transfer', [Warehouse::class, $from, $to]);
⋮----
/**
     * @return array<string, array<int, mixed>>
     */
public function rules(): array
````

## File: app/Http/Requests/Storefront/AddToCartRequest.php
````php
namespace App\Http\Requests\Storefront;
⋮----
use Illuminate\Foundation\Http\FormRequest;
⋮----
/**
 * The cart is session state, not a Model, so there's no Policy to defer
 * to — this request has no auth gate at all (guests and authenticated
 * users alike may add to cart). Active/availability checks happen in
 * CartService::add(), not here, so every failure mode (product doesn't
 * exist, is inactive, or is out of stock) redirects back with the same
 * flash-message UX via the generic DomainException handler, instead of
 * some failures being a 422 validation error and others a flash redirect.
 */
class AddToCartRequest extends FormRequest
⋮----
public function authorize(): bool
⋮----
/**
     * @return array<string, array<int, mixed>>
     */
public function rules(): array
````

## File: app/Http/Requests/Storefront/UpdateCartItemRequest.php
````php
namespace App\Http\Requests\Storefront;
⋮----
use Illuminate\Foundation\Http\FormRequest;
⋮----
class UpdateCartItemRequest extends FormRequest
⋮----
public function authorize(): bool
⋮----
/**
     * @return array<string, array<int, mixed>>
     */
public function rules(): array
⋮----
// 0 removes the line — see CartService::updateQuantity().
````

## File: app/Http/Resources/Api/V1/PaymentResource.php
````php
namespace App\Http\Resources\Api\V1;
⋮----
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
⋮----
class PaymentResource extends JsonResource
⋮----
/**
     * @return array<string, mixed>
     */
public function toArray(Request $request): array
⋮----
'method_label' => $this->method->label(),
⋮----
'status_label' => $this->status->label(),
⋮----
'payable' => $this->whenLoaded('payable', fn () => $this->payable instanceof PurchaseOrder ? [
````

## File: app/Http/Resources/Api/V1/ProductResource.php
````php
namespace App\Http\Resources\Api\V1;
⋮----
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
⋮----
class ProductResource extends JsonResource
⋮----
/**
     * @return array<string, mixed>
     */
public function toArray(Request $request): array
⋮----
'category' => $this->whenLoaded('category', fn () => [
⋮----
'supplier' => $this->whenLoaded('supplier', fn () => $this->supplier ? [
````

## File: app/Http/Resources/Api/V1/PurchaseOrderResource.php
````php
namespace App\Http\Resources\Api\V1;
⋮----
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
⋮----
class PurchaseOrderResource extends JsonResource
⋮----
/**
     * @return array<string, mixed>
     */
public function toArray(Request $request): array
⋮----
'status_label' => $this->status->label(),
⋮----
'business_account' => $this->whenLoaded('businessAccount', fn () => [
⋮----
'items' => $this->whenLoaded('items', fn () => $this->items->map(fn ($item) => [
⋮----
])->values()),
'payments' => $this->whenLoaded('payments', fn () => $this->payments->map(fn ($payment) => [
````

## File: app/Http/Resources/Api/V1/QuoteResource.php
````php
namespace App\Http\Resources\Api\V1;
⋮----
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
⋮----
class QuoteResource extends JsonResource
⋮----
/**
     * @return array<string, mixed>
     */
public function toArray(Request $request): array
⋮----
'status_label' => $this->status->label(),
⋮----
'business_account' => $this->whenLoaded('businessAccount', fn () => [
⋮----
'items' => $this->whenLoaded('items', fn () => $this->items->map(fn ($item) => [
⋮----
])->values()),
'purchase_orders' => $this->whenLoaded('purchaseOrders', fn () => $this->purchaseOrders->map(fn ($po) => [
````

## File: app/Http/Resources/Api/V1/StockAvailabilityResource.php
````php
namespace App\Http\Resources\Api\V1;
⋮----
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
⋮----
class StockAvailabilityResource extends JsonResource
⋮----
/**
     * @return array<string, mixed>
     */
public function toArray(Request $request): array
````

## File: app/Imports/CatalogRowsImport.php
````php
namespace App\Imports;
⋮----
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
⋮----
class CatalogRowsImport implements SkipsEmptyRows, ToCollection, WithCalculatedFormulas, WithHeadingRow
⋮----
/**
     * @var Collection<int, array<string, mixed>>
     */
private Collection $rows;
⋮----
public function __construct()
⋮----
/**
     * @param  Collection<int, mixed>  $rows
     */
public function collection(Collection $rows): void
⋮----
->map(fn ($row) => collect($row)->toArray())
->values();
⋮----
/**
     * @return Collection<int, array<string, mixed>>
     */
public function rows(): Collection
````

## File: app/Jobs/ImportCatalogJob.php
````php
namespace App\Jobs;
⋮----
use App\Services\ImportService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
⋮----
class ImportCatalogJob implements ShouldQueue
⋮----
public function __construct(public readonly string $importBatchId) {}
⋮----
public function handle(ImportService $imports): void
⋮----
$imports->run($this->importBatchId);
````

## File: app/Models/ActivityLog.php
````php
namespace App\Models;
⋮----
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
⋮----
/**
 * Custom activity log (no spatie/laravel-activitylog). `subject_type` /
 * `subject_id` are plain attributes rather than a morphTo relation because
 * subjects span both UUID-keyed and the existing bigint-keyed users/roles
 * tables — see the migration's docblock and this session's ERD mismatch note.
 */
class ActivityLog extends Model
⋮----
protected $table = 'activity_log';
⋮----
public $timestamps = false;
⋮----
protected $guarded = [];
⋮----
protected function casts(): array
⋮----
public function causer(): BelongsTo
⋮----
return $this->belongsTo(User::class, 'causer_id');
````

## File: app/Models/BusinessAccount.php
````php
namespace App\Models;
⋮----
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
⋮----
class BusinessAccount extends Model
⋮----
protected $guarded = [];
⋮----
protected function casts(): array
⋮----
public function user(): BelongsTo
⋮----
return $this->belongsTo(User::class);
⋮----
public function quotes(): HasMany
⋮----
return $this->hasMany(Quote::class);
⋮----
public function purchaseOrders(): HasMany
⋮----
return $this->hasMany(PurchaseOrder::class);
````

## File: app/Models/Category.php
````php
namespace App\Models;
⋮----
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
⋮----
/**
 * @property-read string $id
 * @property-read string $name
 * @property-read string $slug
 */
class Category extends Model
⋮----
protected $guarded = [];
⋮----
public function parent(): BelongsTo
⋮----
return $this->belongsTo(Category::class, 'parent_id');
⋮----
public function children(): HasMany
⋮----
return $this->hasMany(Category::class, 'parent_id');
⋮----
public function products(): HasMany
⋮----
return $this->hasMany(Product::class);
````

## File: app/Models/ImportBatch.php
````php
namespace App\Models;
⋮----
use App\Enums\ImportEntity;
use App\Enums\ImportStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
⋮----
class ImportBatch extends Model
⋮----
protected $guarded = [];
⋮----
protected function casts(): array
⋮----
public function uploader(): BelongsTo
⋮----
return $this->belongsTo(User::class, 'uploader_id');
⋮----
public function rows(): HasMany
⋮----
return $this->hasMany(ImportRow::class);
````

## File: app/Models/ImportRow.php
````php
namespace App\Models;
⋮----
use App\Enums\ImportRowStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
⋮----
class ImportRow extends Model
⋮----
public $timestamps = false;
⋮----
protected $guarded = [];
⋮----
protected function casts(): array
⋮----
public function importBatch(): BelongsTo
⋮----
return $this->belongsTo(ImportBatch::class);
````

## File: app/Models/Order.php
````php
namespace App\Models;
⋮----
use App\Enums\OrderChannel;
use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
⋮----
class Order extends Model
⋮----
protected $guarded = [];
⋮----
protected function casts(): array
⋮----
public function user(): BelongsTo
⋮----
return $this->belongsTo(User::class);
⋮----
public function items(): HasMany
⋮----
return $this->hasMany(OrderItem::class);
⋮----
public function payments(): MorphMany
⋮----
return $this->morphMany(Payment::class, 'payable');
````

## File: app/Models/OrderItem.php
````php
namespace App\Models;
⋮----
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
⋮----
class OrderItem extends Model
⋮----
public $timestamps = false;
⋮----
protected $guarded = [];
⋮----
protected function casts(): array
⋮----
public function order(): BelongsTo
⋮----
return $this->belongsTo(Order::class);
⋮----
public function product(): BelongsTo
⋮----
return $this->belongsTo(Product::class);
⋮----
public function warehouse(): BelongsTo
⋮----
return $this->belongsTo(Warehouse::class);
````

## File: app/Models/Payment.php
````php
namespace App\Models;
⋮----
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
⋮----
class Payment extends Model
⋮----
protected $guarded = [];
⋮----
protected function casts(): array
⋮----
public function payable(): MorphTo
⋮----
return $this->morphTo();
````

## File: app/Models/Permission.php
````php
namespace App\Models;
⋮----
use Laratrust\Models\Permission as PermissionModel;
⋮----
class Permission extends PermissionModel
⋮----
public $guarded = [];
````

## File: app/Models/PoApproval.php
````php
namespace App\Models;
⋮----
use App\Enums\ApprovalDecision;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
⋮----
class PoApproval extends Model
⋮----
public $timestamps = false;
⋮----
protected $table = 'po_approvals';
⋮----
protected $guarded = [];
⋮----
protected function casts(): array
⋮----
public function purchaseOrder(): BelongsTo
⋮----
return $this->belongsTo(PurchaseOrder::class);
⋮----
public function approver(): BelongsTo
⋮----
return $this->belongsTo(User::class, 'approver_id');
````

## File: app/Models/PoItem.php
````php
namespace App\Models;
⋮----
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
⋮----
class PoItem extends Model
⋮----
public $timestamps = false;
⋮----
protected $table = 'po_items';
⋮----
protected $guarded = [];
⋮----
protected function casts(): array
⋮----
public function purchaseOrder(): BelongsTo
⋮----
return $this->belongsTo(PurchaseOrder::class);
⋮----
public function product(): BelongsTo
⋮----
return $this->belongsTo(Product::class);
⋮----
public function warehouse(): BelongsTo
⋮----
return $this->belongsTo(Warehouse::class);
````

## File: app/Models/PriceList.php
````php
namespace App\Models;
⋮----
use App\Enums\PriceListType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
⋮----
class PriceList extends Model
⋮----
protected $guarded = [];
⋮----
protected function casts(): array
⋮----
public function items(): HasMany
⋮----
return $this->hasMany(PriceListItem::class);
````

## File: app/Models/PriceListItem.php
````php
namespace App\Models;
⋮----
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
⋮----
class PriceListItem extends Model
⋮----
public $timestamps = false;
⋮----
protected $guarded = [];
⋮----
protected function casts(): array
⋮----
public function priceList(): BelongsTo
⋮----
return $this->belongsTo(PriceList::class);
⋮----
public function product(): BelongsTo
⋮----
return $this->belongsTo(Product::class);
````

## File: app/Models/Product.php
````php
namespace App\Models;
⋮----
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
⋮----
/**
 * NOTE: deliberately no `quantity` attribute/accessor here. Stock is only
 * ever read via stockLevels()/stock_movements — see
 * docs/project/canonical-decisions.md §6.
 *
 * @property-read Category|null $category
 */
class Product extends Model
⋮----
protected $guarded = [];
⋮----
protected function casts(): array
⋮----
public function category(): BelongsTo
⋮----
return $this->belongsTo(Category::class);
⋮----
public function supplier(): BelongsTo
⋮----
return $this->belongsTo(Supplier::class);
⋮----
public function priceListItems(): HasMany
⋮----
return $this->hasMany(PriceListItem::class);
⋮----
public function stockMovements(): HasMany
⋮----
return $this->hasMany(StockMovement::class);
⋮----
public function stockLevels(): HasMany
⋮----
return $this->hasMany(StockLevel::class);
⋮----
public function orderItems(): HasMany
⋮----
return $this->hasMany(OrderItem::class);
⋮----
public function quoteItems(): HasMany
⋮----
return $this->hasMany(QuoteItem::class);
⋮----
public function poItems(): HasMany
⋮----
return $this->hasMany(PoItem::class);
````

## File: app/Models/PurchaseOrder.php
````php
namespace App\Models;
⋮----
use App\Enums\PurchaseOrderStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
⋮----
class PurchaseOrder extends Model
⋮----
protected $guarded = [];
⋮----
protected function casts(): array
⋮----
public function quote(): BelongsTo
⋮----
return $this->belongsTo(Quote::class);
⋮----
public function businessAccount(): BelongsTo
⋮----
return $this->belongsTo(BusinessAccount::class);
⋮----
public function items(): HasMany
⋮----
return $this->hasMany(PoItem::class);
⋮----
public function approvals(): HasMany
⋮----
return $this->hasMany(PoApproval::class);
⋮----
public function payments(): MorphMany
⋮----
return $this->morphMany(Payment::class, 'payable');
````

## File: app/Models/Quote.php
````php
namespace App\Models;
⋮----
use App\Enums\QuoteStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
⋮----
class Quote extends Model
⋮----
protected $guarded = [];
⋮----
protected function casts(): array
⋮----
public function businessAccount(): BelongsTo
⋮----
return $this->belongsTo(BusinessAccount::class);
⋮----
public function items(): HasMany
⋮----
return $this->hasMany(QuoteItem::class);
⋮----
public function purchaseOrders(): HasMany
⋮----
return $this->hasMany(PurchaseOrder::class);
````

## File: app/Models/QuoteItem.php
````php
namespace App\Models;
⋮----
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
⋮----
class QuoteItem extends Model
⋮----
public $timestamps = false;
⋮----
protected $guarded = [];
⋮----
protected function casts(): array
⋮----
public function quote(): BelongsTo
⋮----
return $this->belongsTo(Quote::class);
⋮----
public function product(): BelongsTo
⋮----
return $this->belongsTo(Product::class);
````

## File: app/Models/Role.php
````php
namespace App\Models;
⋮----
use Laratrust\Models\Role as RoleModel;
⋮----
class Role extends RoleModel
⋮----
public $guarded = [];
````

## File: app/Models/StockLevel.php
````php
namespace App\Models;
⋮----
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
⋮----
/**
 * Denormalized projection of stock_movements, and the row locked
 * (SELECT ... FOR UPDATE) during reserve/confirm/transfer. `available` is
 * always computed, never stored — see docs/project/canonical-decisions.md §6.
 *
 * @property-read int $available
 * @property-read Warehouse $warehouse
 */
class StockLevel extends Model
⋮----
protected $guarded = [];
⋮----
protected function casts(): array
⋮----
public function product(): BelongsTo
⋮----
return $this->belongsTo(Product::class);
⋮----
public function warehouse(): BelongsTo
⋮----
return $this->belongsTo(Warehouse::class);
⋮----
protected function available(): Attribute
⋮----
return Attribute::get(fn () => $this->on_hand - $this->reserved);
````

## File: app/Models/StockMovement.php
````php
namespace App\Models;
⋮----
use App\Enums\MovementType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
⋮----
/**
 * Immutable, insert-only ledger row. Never update or delete a movement —
 * see docs/project/canonical-decisions.md §6.
 */
class StockMovement extends Model
⋮----
public $timestamps = false;
⋮----
protected $guarded = [];
⋮----
protected function casts(): array
⋮----
public function product(): BelongsTo
⋮----
return $this->belongsTo(Product::class);
⋮----
public function warehouse(): BelongsTo
⋮----
return $this->belongsTo(Warehouse::class);
⋮----
public function actor(): BelongsTo
⋮----
return $this->belongsTo(User::class, 'actor_id');
⋮----
public function reference(): MorphTo
⋮----
return $this->morphTo();
````

## File: app/Models/Supplier.php
````php
namespace App\Models;
⋮----
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
⋮----
class Supplier extends Model
⋮----
protected $guarded = [];
⋮----
protected function casts(): array
⋮----
/**
     * The Vendor-role user who manages this supplier's own products/price
     * list items, if this supplier has a portal login.
     */
public function user(): BelongsTo
⋮----
return $this->belongsTo(User::class);
⋮----
public function products(): HasMany
⋮----
return $this->hasMany(Product::class);
````

## File: app/Models/Team.php
````php
namespace App\Models;
⋮----
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laratrust\Models\Team as LaratrustTeam;
⋮----
class Team extends LaratrustTeam
⋮----
public $guarded = [];
⋮----
/**
     * The parent Laratrust\Models\Team declares $fillable =
     * ['name', 'display_name', 'description']. Since that property is
     * non-empty, Eloquent uses it instead of falling back to our $guarded
     * above (redeclaring a parent's protected property doesn't erase it —
     * PHP property inheritance just shadows it, and Eloquent's
     * isFillable() checks $fillable first whenever it's non-empty). That
     * silently stripped `warehouse_id` from mass-assignment. Redeclaring
     * $fillable here to include it is the fix.
     */
protected $fillable = ['name', 'display_name', 'description', 'warehouse_id'];
⋮----
public function warehouse(): BelongsTo
⋮----
return $this->belongsTo(Warehouse::class);
````

## File: app/Models/User.php
````php
namespace App\Models;
⋮----
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;
use Laravel\Passport\Contracts\OAuthenticatable;
use Laravel\Passport\HasApiTokens;
⋮----
class User extends Authenticatable implements LaratrustUser, OAuthenticatable
⋮----
/** @use HasFactory<UserFactory> */
⋮----
/**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
protected function casts(): array
⋮----
public function businessAccount(): HasOne
⋮----
return $this->hasOne(BusinessAccount::class);
⋮----
/**
     * The supplier this Vendor-role user manages, if any.
     */
public function supplier(): HasOne
⋮----
return $this->hasOne(Supplier::class);
⋮----
public function orders(): HasMany
⋮----
return $this->hasMany(Order::class);
⋮----
public function stockMovements(): HasMany
⋮----
return $this->hasMany(StockMovement::class, 'actor_id');
⋮----
public function poApprovals(): HasMany
⋮----
return $this->hasMany(PoApproval::class, 'approver_id');
⋮----
public function importBatches(): HasMany
⋮----
return $this->hasMany(ImportBatch::class, 'uploader_id');
````

## File: app/Models/Warehouse.php
````php
namespace App\Models;
⋮----
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
⋮----
class Warehouse extends Model
⋮----
protected $guarded = [];
⋮----
protected function casts(): array
⋮----
/**
     * Every warehouse maps to exactly one Laratrust team, auto-created
     * below, so Inventory Manager role assignments can be scoped to it.
     * See docs/project/canonical-decisions.md §3 and the
     * add_warehouse_id_to_teams_table migration.
     */
protected static function booted(): void
⋮----
static::created(function (Warehouse $warehouse) {
Team::query()->firstOrCreate(
⋮----
public function team(): HasOne
⋮----
return $this->hasOne(Team::class);
⋮----
public function stockMovements(): HasMany
⋮----
return $this->hasMany(StockMovement::class);
⋮----
public function stockLevels(): HasMany
⋮----
return $this->hasMany(StockLevel::class);
⋮----
public function orderItems(): HasMany
⋮----
return $this->hasMany(OrderItem::class);
⋮----
public function poItems(): HasMany
⋮----
return $this->hasMany(PoItem::class);
````

## File: app/Payments/BankTransferGateway.php
````php
namespace App\Payments;
⋮----
use App\Models\Payment;
⋮----
/**
 * Bank transfer stays pending until a staff member with payment.settle verifies
 * the transfer. If a bank reference is provided, it is stored as a unique
 * gateway_ref so the same transfer cannot be processed twice.
 */
class BankTransferGateway implements PaymentGateway
⋮----
public function initiate(Payment $payment, array $options = []): array
⋮----
public function verifyWebhook(array $payload, array $headers = []): array
⋮----
throw new \LogicException('Bank transfers are settled through the authenticated staff flow.');
````

## File: app/Payments/CodGateway.php
````php
namespace App\Payments;
⋮----
use App\Models\Payment;
⋮----
/**
 * Cash on delivery has no online callback. The reservation remains held until
 * a staff member confirms cash collection through the authenticated settlement
 * flow.
 */
class CodGateway implements PaymentGateway
⋮----
public function initiate(Payment $payment, array $options = []): array
⋮----
public function verifyWebhook(array $payload, array $headers = []): array
⋮----
throw new \LogicException('COD has no online webhook; settle it through the authenticated staff flow.');
````

## File: app/Payments/FakeGateway.php
````php
namespace App\Payments;
⋮----
use App\Exceptions\PaymentVerificationException;
use App\Models\Payment;
use Illuminate\Support\Str;
⋮----
/**
 * Demo/test-only gateway. It still follows the production architecture:
 * initiation creates a pending payment and a later verified fake callback
 * confirms or fails it. Checkout may dispatch that callback immediately for
 * manual testing convenience.
 */
class FakeGateway implements PaymentGateway
⋮----
public function initiate(Payment $payment, array $options = []): array
⋮----
'gateway_ref' => $this->gatewayRefFor($payment),
⋮----
public function verifyWebhook(array $payload, array $headers = []): array
⋮----
if (is_string($signature) && ! hash_equals($this->signatureFor($gatewayRef, $outcome), $signature)) {
throw PaymentVerificationException::invalidSignature('fake_gateway');
⋮----
'webhook_id' => $payload['webhook_id'] ?? (string) Str::uuid(),
⋮----
public function gatewayRefFor(Payment $payment): string
⋮----
public function signatureFor(string $gatewayRef, string $outcome): string
````

## File: app/Payments/FawryGateway.php
````php
namespace App\Payments;
⋮----
use App\Exceptions\PaymentVerificationException;
use App\Models\Payment;
⋮----
/**
 * Placeholder — no real Fawry reference-code API call is made yet. Initiation
 * leaves the payment pending, while webhook handling rejects unsigned
 * callbacks.
 *
 * TODO: Replace the generic HMAC check and payload mapping with Fawry's
 * current production contract before real credentials are configured.
 */
class FawryGateway implements PaymentGateway
⋮----
public function initiate(Payment $payment, array $options = []): array
⋮----
public function verifyWebhook(array $payload, array $headers = []): array
⋮----
$this->verifyPlaceholderSignature($headers);
⋮----
/**
     * Temporary safety check. Fawry's real signature canonicalization is
     * provider-specific; this placeholder uses HMAC-SHA256(raw_body,
     * FAWRY_WEBHOOK_SECRET) so unsigned callbacks cannot change state.
     *
     * @param  array<string, mixed>  $headers
     */
private function verifyPlaceholderSignature(array $headers): void
⋮----
throw PaymentVerificationException::invalidSignature('fawry');
````

## File: app/Payments/PaymentGateway.php
````php
namespace App\Payments;
⋮----
use App\Models\Payment;
⋮----
/**
 * Gateway drivers are thin adapters. They may prepare redirect/reference
 * metadata during initiation and they verify provider callbacks, but they do
 * not mutate database state. PaymentService owns persistence, idempotency, and
 * reservation -> sale_out conversion.
 */
interface PaymentGateway
⋮----
/**
     * @param  array<string, mixed>  $options
     * @return array{gateway_ref?: string|null, meta?: array<string, mixed>}
     */
public function initiate(Payment $payment, array $options = []): array;
⋮----
/**
     * Verify a webhook/callback and normalize it into a provider-independent
     * event. Implementations must throw PaymentVerificationException when the
     * payload cannot be trusted.
     *
     * @param  array<string, mixed>  $payload
     * @param  array<string, mixed>  $headers
     * @return array{
     *     payment_id?: string|null,
     *     gateway_ref: string,
     *     successful: bool,
     *     meta?: array<string, mixed>
     * }
     */
public function verifyWebhook(array $payload, array $headers = []): array;
````

## File: app/Payments/PaymobGateway.php
````php
namespace App\Payments;
⋮----
use App\Exceptions\PaymentVerificationException;
use App\Models\Payment;
⋮----
/**
 * Placeholder — no real Paymob API call is made yet. Initiation leaves the
 * payment pending, while webhook handling rejects unsigned callbacks.
 *
 * TODO: Replace the generic HMAC check and payload mapping with Paymob's
 * current Accept/Intention contract before real credentials are configured.
 */
class PaymobGateway implements PaymentGateway
⋮----
public function initiate(Payment $payment, array $options = []): array
⋮----
public function verifyWebhook(array $payload, array $headers = []): array
⋮----
$this->verifyPlaceholderSignature($headers);
⋮----
/**
     * Temporary safety check. Paymob's real signature canonicalization is
     * provider-specific; this placeholder uses HMAC-SHA256(raw_body,
     * PAYMOB_WEBHOOK_SECRET) so unsigned callbacks cannot change state.
     *
     * @param  array<string, mixed>  $headers
     */
private function verifyPlaceholderSignature(array $headers): void
⋮----
throw PaymentVerificationException::invalidSignature('paymob');
````

## File: app/Policies/OrderPolicy.php
````php
namespace App\Policies;
⋮----
use App\Enums\PermissionName;
use App\Models\Order;
use App\Models\User;
⋮----
/**
 * Record-level authorization for B2C orders: a customer may only see their
 * own orders; staff holding `payment.settle` (SalesCashier, InventoryManager,
 * SuperAdmin — see RolePermissionSeeder) can see and settle any order, since
 * they're the ones confirming COD deliveries / placeholder-gateway
 * payments. `sale.create` (route middleware) is the coarse gate for
 * checking out at all.
 */
class OrderPolicy
⋮----
public function view(User $user, Order $order): bool
⋮----
return $order->user_id === $user->id || $user->isAbleTo(PermissionName::PaymentSettle->value);
⋮----
public function create(User $user): bool
⋮----
return $user->isAbleTo(PermissionName::SaleCreate->value);
⋮----
/**
     * Staff-only: settle a pending payment (Cod / Paymob / Fawry
     * placeholder) and confirm the order.
     */
public function settlePayment(User $user, Order $order): bool
⋮----
return $user->isAbleTo(PermissionName::PaymentSettle->value);
⋮----
/**
     * Staff-only: mark a confirmed order as fulfilled (delivered/picked up).
     */
public function fulfill(User $user, Order $order): bool
````

## File: app/Policies/PaymentPolicy.php
````php
namespace App\Policies;
⋮----
use App\Enums\PermissionName;
use App\Models\Order;
use App\Models\Payment;
use App\Models\PurchaseOrder;
use App\Models\User;
⋮----
/**
 * Record-level authorization for payments — covers both payable types:
 * `Order` (B2C checkout) and `PurchaseOrder` (B2B Bank Transfer
 * settlement). Same shape either way: the owner sees their own, staff
 * holding `payment.settle` sees/settles any.
 */
class PaymentPolicy
⋮----
public function view(User $user, Payment $payment): bool
⋮----
return $payment->payable->user_id === $user->id || $user->isAbleTo(PermissionName::PaymentSettle->value);
⋮----
return $ownsAccount || $user->isAbleTo(PermissionName::PaymentSettle->value);
⋮----
public function settle(User $user, Payment $payment): bool
⋮----
return $user->isAbleTo(PermissionName::PaymentSettle->value);
````

## File: app/Policies/PriceListPolicy.php
````php
namespace App\Policies;
⋮----
use App\Enums\PermissionName;
use App\Enums\UserRole;
use App\Models\PriceList;
use App\Models\PriceListItem;
use App\Models\User;
⋮----
/**
 * Record-level authorization for price lists and their items.
 * `pricelist.manage` (route middleware) is the coarse gate. A Vendor
 * holding that permission may only manage items on their own products
 * (Enterprise PRD §3, "own" cell) — they never manage whole price lists.
 * See docs/project/canonical-decisions.md §2.
 *
 * Registered for both PriceList and PriceListItem in AppServiceProvider,
 * since one policy class serves both models here.
 */
class PriceListPolicy
⋮----
public function viewAny(User $user): bool
⋮----
return $user->isAbleTo(PermissionName::CatalogRead->value);
⋮----
public function view(User $user, PriceList $priceList): bool
⋮----
public function create(User $user): bool
⋮----
return $user->isAbleTo(PermissionName::PricelistManage->value)
&& ! $user->hasRole(UserRole::VendorSupplier->value);
⋮----
public function update(User $user, PriceList $priceList): bool
⋮----
return $this->create($user);
⋮----
public function updateItem(User $user, PriceListItem $item): bool
⋮----
if (! $user->isAbleTo(PermissionName::PricelistManage->value)) {
⋮----
if (! $user->hasRole(UserRole::VendorSupplier->value)) {
⋮----
public function deleteItem(User $user, PriceListItem $item): bool
⋮----
return $this->updateItem($user, $item);
````

## File: app/Policies/ProductPolicy.php
````php
namespace App\Policies;
⋮----
use App\Enums\PermissionName;
use App\Enums\UserRole;
use App\Models\Product;
use App\Models\User;
⋮----
/**
 * Record-level authorization for products. `product.manage` (route
 * middleware) is the coarse gate; a Vendor holding that permission is
 * further restricted here to only their own products (Enterprise PRD §3,
 * "own" cell). See docs/project/canonical-decisions.md §2.
 */
class ProductPolicy
⋮----
public function viewAny(User $user): bool
⋮----
return $user->isAbleTo(PermissionName::CatalogRead->value);
⋮----
public function view(User $user, Product $product): bool
⋮----
public function create(User $user): bool
⋮----
return $user->isAbleTo(PermissionName::ProductManage->value);
⋮----
public function update(User $user, Product $product): bool
⋮----
if (! $user->isAbleTo(PermissionName::ProductManage->value)) {
⋮----
if (! $user->hasRole(UserRole::VendorSupplier->value)) {
⋮----
public function delete(User $user, Product $product): bool
⋮----
return $this->update($user, $product);
````

## File: app/Policies/PurchaseOrderPolicy.php
````php
namespace App\Policies;
⋮----
use App\Enums\PermissionName;
use App\Models\PurchaseOrder;
use App\Models\User;
⋮----
/**
 * Record-level authorization for B2B purchase orders. A Business Buyer
 * only ever sees their own account's POs; staff holding `po.approve` or
 * `payment.settle` can see and act on any (they need visibility to do
 * their job — approving or settling isn't scoped to "own").
 */
class PurchaseOrderPolicy
⋮----
public function view(User $user, PurchaseOrder $purchaseOrder): bool
⋮----
if ($this->ownsAccount($user, $purchaseOrder)) {
⋮----
return $user->isAbleTo(PermissionName::PoApprove->value) || $user->isAbleTo(PermissionName::PaymentSettle->value);
⋮----
public function approve(User $user, PurchaseOrder $purchaseOrder): bool
⋮----
return $user->isAbleTo(PermissionName::PoApprove->value);
⋮----
public function reject(User $user, PurchaseOrder $purchaseOrder): bool
⋮----
public function settle(User $user, PurchaseOrder $purchaseOrder): bool
⋮----
return $user->isAbleTo(PermissionName::PaymentSettle->value);
⋮----
private function ownsAccount(User $user, PurchaseOrder $purchaseOrder): bool
````

## File: app/Policies/QuotePolicy.php
````php
namespace App\Policies;
⋮----
use App\Enums\PermissionName;
use App\Enums\UserRole;
use App\Models\Quote;
use App\Models\User;
⋮----
/**
 * Record-level authorization for B2B quotes (RFQs). `quote.request`
 * (Business Buyer) / `quote.price` (Vendor, Inventory Manager) are the
 * coarse route gates; this Policy adds the "own" scoping: a Business Buyer
 * only ever sees/acts on their own account's quotes, and a Vendor only
 * ever sees/prices quotes containing at least one product they supply
 * ("own pricing context" — Enterprise PRD §3).
 */
class QuotePolicy
⋮----
public function view(User $user, Quote $quote): bool
⋮----
if ($this->ownsAccount($user, $quote)) {
⋮----
if ($user->hasRole(UserRole::VendorSupplier->value)) {
return $this->hasOwnLine($user, $quote);
⋮----
return $user->isAbleTo(PermissionName::QuotePrice->value) || $user->isAbleTo(PermissionName::PoApprove->value);
⋮----
public function create(User $user): bool
⋮----
return $user->isAbleTo(PermissionName::QuoteRequest->value);
⋮----
/**
     * Sets prices on a quote's lines. A Vendor holding `quote.price` may
     * only price quotes that include one of their own products; Inventory
     * Manager/SuperAdmin (also `quote.price`, but not Vendor) may price any.
     */
public function price(User $user, Quote $quote): bool
⋮----
if (! $user->isAbleTo(PermissionName::QuotePrice->value)) {
⋮----
if (! $user->hasRole(UserRole::VendorSupplier->value)) {
⋮----
/**
     * accept()/reject() are the owning Business Buyer's decision alone.
     */
public function accept(User $user, Quote $quote): bool
⋮----
return $this->ownsAccount($user, $quote);
⋮----
public function reject(User $user, Quote $quote): bool
⋮----
private function ownsAccount(User $user, Quote $quote): bool
⋮----
private function hasOwnLine(User $user, Quote $quote): bool
⋮----
return $quote->items->contains(
````

## File: app/Policies/StockPolicy.php
````php
namespace App\Policies;
⋮----
use App\Enums\PermissionName;
use App\Models\User;
use App\Models\Warehouse;
use App\Support\WarehouseAccess;
⋮----
/**
 * Record-level authorization for stock mutations. `stock.move` /
 * `stock.transfer` (route middleware) are the coarse gates; this restricts
 * them to the specific warehouse(s) involved, via Laratrust teams
 * (Enterprise PRD §3, "team" cell — Inventory Manager only; SuperAdmin
 * bypasses). `stock.read` and the reconcile command have no record to
 * scope against, so route middleware alone is their full gate — no methods
 * needed here for those. See docs/project/canonical-decisions.md §2 and
 * App\Support\WarehouseAccess.
 */
class StockPolicy
⋮----
public function move(User $user, Warehouse $warehouse): bool
⋮----
return WarehouseAccess::allows($user, $warehouse, PermissionName::StockMove);
⋮----
public function adjust(User $user, Warehouse $warehouse): bool
⋮----
return $this->move($user, $warehouse);
⋮----
public function transfer(User $user, Warehouse $fromWarehouse, Warehouse $toWarehouse): bool
⋮----
return WarehouseAccess::allows($user, $fromWarehouse, PermissionName::StockTransfer)
&& WarehouseAccess::allows($user, $toWarehouse, PermissionName::StockTransfer);
````

## File: app/Providers/AppServiceProvider.php
````php
namespace App\Providers;
⋮----
use App\Models\Order;
use App\Models\Payment;
use App\Models\PriceList;
use App\Models\PriceListItem;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\Quote;
use App\Models\Warehouse;
use App\Policies\OrderPolicy;
use App\Policies\PaymentPolicy;
use App\Policies\PriceListPolicy;
use App\Policies\ProductPolicy;
use App\Policies\PurchaseOrderPolicy;
use App\Policies\QuotePolicy;
use App\Policies\StockPolicy;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
⋮----
class AppServiceProvider extends ServiceProvider
⋮----
/**
     * Register any application services.
     */
public function register(): void
⋮----
//
⋮----
/**
     * Bootstrap any application services.
     */
public function boot(): void
⋮----
Passport::enablePasswordGrant();
⋮----
Passport::tokensExpireIn(now()->addMinutes(15));
Passport::clientCredentialsTokensExpireIn(now()->addMinutes(15));
Passport::refreshTokensExpireIn(now()->addDays(30));
Passport::tokensCan([
⋮----
RateLimiter::for('api', function (Request $request) {
$identifier = $request->user('api')?->getAuthIdentifier() ?: $request->ip();
⋮----
return Limit::perMinute(120)->by((string) $identifier);
⋮----
// Brute-force protection: keyed by IP + attempted email together, so
// one attacker IP can't lock out a legitimate user's email (a
// per-email-only limit would let an attacker DoS a known user by
// spamming failed logins), and one email being hammered from many
// IPs still gets rate-limited per source. This is currently the
// only login-attempt throttle — AuthService itself has no separate
// lockout, so don't remove this without adding an equivalent.
RateLimiter::for('login', function (Request $request) {
$email = (string) $request->string('email');
⋮----
return Limit::perMinute(5)->by($request->ip().'|'.$email);
⋮----
// Checkout creates a real Order + reserves stock on every request —
// keyed per authenticated user (checkout always requires
// `sale.create`, so a user is always present) rather than IP, so
// shared-IP customers (offices, NAT) don't throttle each other.
RateLimiter::for('checkout', function (Request $request) {
return Limit::perMinute(10)->by((string) $request->user()?->id);
⋮----
// Cart mutations (add/update/remove/clear) are reachable by guests
// with no login at all, so unlike 'checkout' this can't key on a
// guaranteed user id — falls back to IP for anonymous carts, user
// id once authenticated (so logging in doesn't reset a guest's
// remaining quota mid-session at the same IP).
RateLimiter::for('cart', function (Request $request) {
return Limit::perMinute(30)->by((string) ($request->user()?->id ?: $request->ip()));
⋮----
// Payment webhooks are server-to-server (Paymob/Fawry/the Fake
// Gateway simulator), not interactive traffic — generous enough
// that a legitimate retry storm from a gateway provider doesn't get
// dropped, but bounded so a misconfigured or malicious sender can't
// hammer PaymentService::verifyWebhook() indefinitely. Keyed by IP;
// webhook payloads are signature-verified separately (see
// app/Payments/*Gateway.php), so this is throughput protection, not
// authentication.
RateLimiter::for('webhook', function (Request $request) {
return Limit::perMinute(60)->by($request->ip());
⋮----
Gate::policy(Product::class, ProductPolicy::class);
Gate::policy(PriceList::class, PriceListPolicy::class);
// PriceListPolicy also covers PriceListItem (own-item checks) —
// see docs/project/canonical-decisions.md §2 and the policy's docblock.
Gate::policy(PriceListItem::class, PriceListPolicy::class);
Gate::policy(Warehouse::class, StockPolicy::class);
Gate::policy(Order::class, OrderPolicy::class);
Gate::policy(Payment::class, PaymentPolicy::class);
Gate::policy(Quote::class, QuotePolicy::class);
Gate::policy(PurchaseOrder::class, PurchaseOrderPolicy::class);
````

## File: app/Providers/HorizonServiceProvider.php
````php
namespace App\Providers;
⋮----
use App\Enums\UserRole;
use Illuminate\Support\Facades\Gate;
use Laravel\Horizon\HorizonApplicationServiceProvider;
⋮----
class HorizonServiceProvider extends HorizonApplicationServiceProvider
⋮----
/**
     * Bootstrap any application services.
     */
public function boot(): void
⋮----
parent::boot();
⋮----
// Horizon::routeSmsNotificationsTo('15556667777');
// Horizon::routeMailNotificationsTo('example@example.com');
// Horizon::routeSlackNotificationsTo('slack-webhook-url', '#channel');
⋮----
/**
     * Register the Horizon gate.
     *
     * Horizon exposes queue throughput, job payloads, and failure details —
     * infra-level visibility with no equivalent in the PRD's permission
     * matrix, so it's restricted to SuperAdmin directly rather than added as
     * a new granular permission for a single dashboard.
     */
protected function gate(): void
⋮----
Gate::define('viewHorizon', function ($user = null) {
````

## File: app/Providers/RepositoryServiceProvider.php
````php
namespace App\Providers;
⋮----
use App\Repositories\AuditLogRepository;
use App\Repositories\BusinessAccountRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\Contracts\AuditLogRepositoryInterface;
use App\Repositories\Contracts\BusinessAccountRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\ImportRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use App\Repositories\Contracts\PriceListRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\PurchaseOrderRepositoryInterface;
use App\Repositories\Contracts\QuoteRepositoryInterface;
use App\Repositories\Contracts\StockRepositoryInterface;
use App\Repositories\Contracts\SupplierRepositoryInterface;
use App\Repositories\Contracts\WarehouseRepositoryInterface;
use App\Repositories\ImportRepository;
use App\Repositories\OrderRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\PriceListRepository;
use App\Repositories\ProductRepository;
use App\Repositories\PurchaseOrderRepository;
use App\Repositories\QuoteRepository;
use App\Repositories\StockRepository;
use App\Repositories\SupplierRepository;
use App\Repositories\WarehouseRepository;
use Illuminate\Support\ServiceProvider;
⋮----
/**
 * Binds each repository contract to its Eloquent implementation, so
 * Services can depend on the interface (see
 * docs/project/canonical-decisions.md §2 — Controller → Service →
 * Repository → Model).
 */
class RepositoryServiceProvider extends ServiceProvider
⋮----
/**
     * @var array<class-string, class-string>
     */
public array $bindings = [
````

## File: app/Repositories/Contracts/AuditLogRepositoryInterface.php
````php
namespace App\Repositories\Contracts;
⋮----
use App\Models\ActivityLog;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
⋮----
interface AuditLogRepositoryInterface
⋮----
/**
     * Appends an audit entry. `activity_log` is write-once from the
     * application's perspective — nothing ever updates or deletes a row.
     *
     * @param  array<string, mixed>  $attributes
     */
public function create(array $attributes): ActivityLog;
⋮----
/**
     * Paginated, filterable listing for the Admin/AuditLog/Index page.
     *
     * @param  array<string, mixed>  $filters  event, causer_id, subject_type, date_from, date_to
     */
public function paginate(int $perPage, array $filters = []): LengthAwarePaginator;
⋮----
/**
     * The most recent $limit entries — the dashboard's "recent activity"
     * KPI. Deliberately unfiltered/unpaginated: it's a small, fixed-size
     * peek, not a report.
     *
     * @return Collection<int, ActivityLog>
     */
public function recent(int $limit = 5): Collection;
````

## File: app/Repositories/Contracts/BusinessAccountRepositoryInterface.php
````php
namespace App\Repositories\Contracts;
⋮----
use App\Models\BusinessAccount;
⋮----
interface BusinessAccountRepositoryInterface
⋮----
public function find(string $id): ?BusinessAccount;
⋮----
public function findByUserId(int $userId): ?BusinessAccount;
⋮----
/**
     * Locks the row for update within the caller's transaction — used by
     * PurchaseOrderService before reading/mutating `outstanding_balance`,
     * so two concurrent PO approvals against the same account can't both
     * pass the credit check against the same stale balance. Callers must
     * wrap this in DB::transaction().
     */
public function lockForUpdate(string $id): ?BusinessAccount;
⋮----
/**
     * @param  array<string, mixed>  $attributes
     */
public function update(BusinessAccount $businessAccount, array $attributes): BusinessAccount;
````

## File: app/Repositories/Contracts/CategoryRepositoryInterface.php
````php
namespace App\Repositories\Contracts;
⋮----
use App\Models\Category;
use Illuminate\Support\Collection;
⋮----
interface CategoryRepositoryInterface
⋮----
public function find(string $id): ?Category;
⋮----
/**
     * All categories with their children eager-loaded, for building a
     * nested tree client-side.
     *
     * @return Collection<int, Category>
     */
public function allWithChildren(): Collection;
⋮----
/**
     * Flat, minimal list for select-dropdown use.
     *
     * @return Collection<int, Category>
     */
public function all(): Collection;
⋮----
/**
     * @param  array<string, mixed>  $attributes
     */
public function create(array $attributes): Category;
⋮----
public function update(Category $category, array $attributes): Category;
⋮----
public function delete(Category $category): bool;
````

## File: app/Repositories/Contracts/ImportRepositoryInterface.php
````php
namespace App\Repositories\Contracts;
⋮----
use App\Models\ImportBatch;
use App\Models\ImportRow;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
⋮----
interface ImportRepositoryInterface
⋮----
public function findBatch(string $id): ?ImportBatch;
⋮----
public function paginateBatches(int $perPage = 15): LengthAwarePaginator;
⋮----
/**
     * @param  array<string, mixed>  $attributes
     */
public function createBatch(array $attributes): ImportBatch;
⋮----
public function updateBatch(ImportBatch $batch, array $attributes): ImportBatch;
⋮----
public function createRow(array $attributes): ImportRow;
⋮----
public function updateRow(ImportRow $row, array $attributes): ImportRow;
⋮----
/**
     * @return Collection<int, ImportRow>
     */
public function rowsForBatch(string $batchId): Collection;
⋮----
public function paginateRowsForBatch(string $batchId, int $perPage = 25): LengthAwarePaginator;
⋮----
public function failedRowsForBatch(string $batchId): Collection;
⋮----
/**
     * Paginated, filterable listing for the Import History report. No
     * product/warehouse filter — an import batch spans many rows/entities,
     * not a single product or warehouse; `entity` (the natural analog) is
     * exposed instead.
     *
     * @param  array<string, mixed>  $filters  status, entity, uploader_id (user), date_from, date_to
     */
public function paginateForReport(int $perPage, array $filters = []): LengthAwarePaginator;
````

## File: app/Repositories/Contracts/OrderRepositoryInterface.php
````php
namespace App\Repositories\Contracts;
⋮----
use App\Models\Order;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
⋮----
interface OrderRepositoryInterface
⋮----
public function find(string $id): ?Order;
⋮----
public function paginateForUser(int $userId, int $perPage = 15): LengthAwarePaginator;
⋮----
/**
     * @param  array<string, mixed>  $attributes
     */
public function create(array $attributes): Order;
⋮----
public function update(Order $order, array $attributes): Order;
⋮----
/**
     * `reserved` orders whose `reserved_until` has passed — unpaid
     * reservations due for release. Used by
     * OrderService::releaseExpiredReservations() /
     * `stock:release-expired-reservations`.
     *
     * @return Collection<int, Order>
     */
public function expiredReservations(): Collection;
⋮----
/**
     * Paginated, filterable listing for the Sales report.
     *
     * @param  array<string, mixed>  $filters  status, user_id, product_id, warehouse_id, date_from, date_to
     */
public function paginateForSalesReport(int $perPage, array $filters = []): LengthAwarePaginator;
⋮----
/**
     * Sum of `total` for confirmed/fulfilled orders created since
     * $since — the dashboard's "today's sales" KPI.
     */
public function salesTotalSince(\DateTimeInterface $since): string;
````

## File: app/Repositories/Contracts/PaymentRepositoryInterface.php
````php
namespace App\Repositories\Contracts;
⋮----
use App\Enums\PaymentStatus;
use App\Models\Payment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
⋮----
interface PaymentRepositoryInterface
⋮----
public function find(string $id): ?Payment;
⋮----
public function lockForUpdate(string $id): ?Payment;
⋮----
/**
     * Used for webhook idempotency — dedupe by gateway_ref.
     */
public function findByGatewayRef(string $gatewayRef): ?Payment;
⋮----
public function paginateAll(int $perPage = 15): LengthAwarePaginator;
⋮----
public function paginateForBusinessAccount(string $businessAccountId, int $perPage = 15): LengthAwarePaginator;
⋮----
/**
     * @param  array<string, mixed>  $attributes
     */
public function create(array $attributes): Payment;
⋮----
public function update(Payment $payment, array $attributes): Payment;
⋮----
/**
     * @return Collection<int, Payment>
     */
public function forPayable(Model $payable): Collection;
⋮----
/**
     * Paginated, filterable listing for the Payments report. No product/
     * warehouse filter — payments have no product dimension. "user" means
     * the payable's owner: Order.user_id for B2C, or
     * PurchaseOrder.businessAccount.user_id for B2B.
     *
     * @param  array<string, mixed>  $filters  status, method, user_id, date_from, date_to
     */
public function paginateForReport(int $perPage, array $filters = []): LengthAwarePaginator;
⋮----
/**
     * Cheap COUNT for dashboard KPIs — e.g. "pending settlement" for staff.
     */
public function countByStatus(PaymentStatus $status): int;
````

## File: app/Repositories/Contracts/PriceListRepositoryInterface.php
````php
namespace App\Repositories\Contracts;
⋮----
use App\Models\PriceList;
use App\Models\PriceListItem;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
⋮----
interface PriceListRepositoryInterface
⋮----
public function find(string $id): ?PriceList;
⋮----
public function paginateWithItems(int $perPage = 15): LengthAwarePaginator;
⋮----
/**
     * @param  array<string, mixed>  $attributes
     */
public function create(array $attributes): PriceList;
⋮----
public function update(PriceList $priceList, array $attributes): PriceList;
⋮----
public function findItem(string $id): ?PriceListItem;
⋮----
public function createItem(array $attributes): PriceListItem;
⋮----
public function updateItem(PriceListItem $item, array $attributes): PriceListItem;
⋮----
public function deleteItem(PriceListItem $item): bool;
⋮----
/**
     * The active `b2c_retail` price list's item for this product with the
     * highest `min_qty` that's still `<= $quantity` (retail lists in
     * practice only carry a single min_qty=1 tier, but this stays correct
     * if that ever changes). Null if no active retail list prices this
     * product at all.
     */
public function activeRetailItemFor(string $productId, int $quantity): ?PriceListItem;
⋮----
/**
     * The active `b2b_tier` price list's item for this product with the
     * highest `min_qty` that's still `<= $quantity` — used as a starting
     * suggestion when a Vendor/Inventory Manager prices a B2B quote line.
     * Null if no active tier list prices this product at all.
     */
public function activeTierItemFor(string $productId, int $quantity): ?PriceListItem;
````

## File: app/Repositories/Contracts/ProductRepositoryInterface.php
````php
namespace App\Repositories\Contracts;
⋮----
use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
⋮----
interface ProductRepositoryInterface
⋮----
public function find(string $id): ?Product;
⋮----
public function findWithRelations(string $id): ?Product;
⋮----
public function findBySku(string $sku): ?Product;
⋮----
/**
     * Active-only lookup by SKU for the public storefront's product detail
     * page — an inactive product must 404 there, not just render with a
     * "hidden" flag, so this returns null instead of an inactive Product.
     */
public function findActiveBySku(string $sku): ?Product;
⋮----
/**
     * @param  array<string, mixed>  $filters  e.g. ['search' => 'laptop', 'category_id' => '...']
     */
public function paginate(int $perPage = 15, array $filters = []): LengthAwarePaginator;
⋮----
/**
     * Same shape as paginate(), but always scoped to is_active=true — the
     * public storefront listing/search/category pages. Kept as a separate
     * method (rather than an $filters['is_active'] flag on paginate())
     * so the admin catalog listing can never accidentally forget to
     * exclude inactive products, and vice versa.
     *
     * @param  array<string, mixed>  $filters  e.g. ['search' => 'laptop', 'category_id' => '...']
     */
public function publicPaginatedList(int $perPage = 15, array $filters = []): LengthAwarePaginator;
⋮----
/**
     * @param  array<string, mixed>  $attributes
     */
public function create(array $attributes): Product;
⋮----
public function update(Product $product, array $attributes): Product;
⋮----
public function delete(Product $product): bool;
````

## File: app/Repositories/Contracts/PurchaseOrderRepositoryInterface.php
````php
namespace App\Repositories\Contracts;
⋮----
use App\Enums\PurchaseOrderStatus;
use App\Models\PurchaseOrder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
⋮----
interface PurchaseOrderRepositoryInterface
⋮----
public function find(string $id): ?PurchaseOrder;
⋮----
public function paginateForBusinessAccount(string $businessAccountId, int $perPage = 15): LengthAwarePaginator;
⋮----
/**
     * Every PO — for staff (`po.approve`/`payment.settle` holders) who need
     * to see/act on any business account's orders, not just their own.
     */
public function paginateAll(int $perPage = 15): LengthAwarePaginator;
⋮----
/**
     * @param  array<string, mixed>  $attributes
     */
public function create(array $attributes): PurchaseOrder;
⋮----
public function update(PurchaseOrder $purchaseOrder, array $attributes): PurchaseOrder;
⋮----
/**
     * Cheap COUNT for dashboard KPIs — e.g. "pending approvals" for staff,
     * optionally scoped to one business account.
     */
public function countByStatus(PurchaseOrderStatus $status, ?string $businessAccountId = null): int;
````

## File: app/Repositories/Contracts/QuoteRepositoryInterface.php
````php
namespace App\Repositories\Contracts;
⋮----
use App\Models\Quote;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
⋮----
interface QuoteRepositoryInterface
⋮----
public function find(string $id): ?Quote;
⋮----
public function paginateForBusinessAccount(string $businessAccountId, int $perPage = 15): LengthAwarePaginator;
⋮----
/**
     * Quotes containing at least one line for a product this vendor
     * supplies — a Vendor's "own pricing context" (see QuotePolicy).
     */
public function paginateForVendor(int $vendorUserId, int $perPage = 15): LengthAwarePaginator;
⋮----
/**
     * Every quote — for staff (Inventory Manager/SuperAdmin) who can price
     * or oversee any quote, not just their own.
     */
public function paginateAll(int $perPage = 15): LengthAwarePaginator;
⋮----
/**
     * @param  array<string, mixed>  $attributes
     */
public function create(array $attributes): Quote;
⋮----
public function update(Quote $quote, array $attributes): Quote;
````

## File: app/Repositories/Contracts/StockRepositoryInterface.php
````php
namespace App\Repositories\Contracts;
⋮----
use App\Models\StockLevel;
use App\Models\StockMovement;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
⋮----
interface StockRepositoryInterface
⋮----
public function findLevel(string $productId, string $warehouseId): ?StockLevel;
⋮----
/**
     * Lock the (product, warehouse) row for update within the caller's
     * transaction. Callers are responsible for wrapping this in
     * DB::transaction() — locking is meaningless outside one.
     */
public function lockLevelForUpdate(string $productId, string $warehouseId): ?StockLevel;
⋮----
/**
     * Lock the (product, warehouse) row for update, creating it (on_hand=0,
     * reserved=0) first if it doesn't exist yet. Race-safe: if two
     * transactions both try to create the same brand-new pair
     * concurrently, the loser's insert hits the stock_levels
     * (product_id, warehouse_id) unique constraint and falls back to
     * locking the winner's row instead of erroring. Must be called inside
     * the caller's DB::transaction().
     */
public function lockOrCreateLevel(string $productId, string $warehouseId): StockLevel;
⋮----
/**
     * @param  array<string, mixed>  $attributes
     */
public function createLevel(array $attributes): StockLevel;
⋮----
public function updateLevel(StockLevel $level, array $attributes): StockLevel;
⋮----
/**
     * Append an immutable movement row. Never update or delete a movement.
     *
     * @param  array<string, mixed>  $attributes
     */
public function createMovement(array $attributes): StockMovement;
⋮----
/**
     * @return Collection<int, StockMovement>
     */
public function movementsFor(string $productId, string $warehouseId): Collection;
⋮----
/**
     * Paginated, filterable listing for the Stock/Levels/Index page.
     *
     * @param  array<string, mixed>  $filters  e.g. ['product_id' => ..., 'warehouse_id' => ...]
     */
public function paginateLevels(int $perPage, array $filters = []): LengthAwarePaginator;
⋮----
/**
     * Paginated, filterable listing for the Stock/Movements/Index page and
     * the Stock Movement report.
     *
     * @param  array<string, mixed>  $filters  product_id, warehouse_id, type, actor_id, date_from, date_to
     */
public function paginateMovements(int $perPage, array $filters = []): LengthAwarePaginator;
⋮----
/**
     * Paginated, filterable listing for the Low Stock report — every
     * (product, warehouse) pair whose available (on_hand - reserved) is at
     * or below $threshold.
     *
     * @param  array<string, mixed>  $filters  product_id, warehouse_id
     */
public function paginateLowStockLevels(int $threshold, int $perPage, array $filters = []): LengthAwarePaginator;
⋮----
/**
     * All stock_levels rows (the projection side of reconciliation),
     * optionally filtered.
     *
     * @return Collection<int, StockLevel>
     */
public function allLevels(?string $productId = null, ?string $warehouseId = null): Collection;
⋮----
/**
     * One row per (product, warehouse) pair with ledger-derived on_hand/
     * reserved already summed in a single grouped query — the ledger side
     * of reconciliation. `ledger_on_hand` sums purchase_in/sale_out/
     * adjustment/transfer_in/transfer_out (the types that affect on_hand);
     * `ledger_reserved` sums reservation/release/sale_out (the types that
     * affect reserved). See StockService's docblock for the full reasoning.
     *
     * @return Collection<int, object{product_id: string, warehouse_id: string, ledger_on_hand: int, ledger_reserved: int}>
     */
public function ledgerTotals(?string $productId = null, ?string $warehouseId = null): Collection;
⋮----
/**
     * All stock_levels rows for a product in active warehouses, with
     * `warehouse` eager-loaded, ordered by available (on_hand - reserved)
     * descending. Used by StockService::bestWarehouseFor() to place a B2C
     * order line. Read-only — no lock, since it's a placement heuristic,
     * not a mutation.
     *
     * @return Collection<int, StockLevel>
     */
public function levelsForProductOrderedByAvailability(string $productId): Collection;
⋮----
/**
     * Cheap COUNT for the dashboard's "low stock" KPI.
     */
public function countLowStockLevels(int $threshold): int;
⋮----
/**
     * Total available (on_hand - reserved) for a product summed across
     * every active warehouse — used by the public storefront's In Stock /
     * Low Stock / Out of Stock badge and cart-add validation. Deliberately
     * uncached and live, like every other read in this interface: it feeds
     * an "is this addable to cart" decision, and a stale answer here would
     * let a guest add an item that's actually sold out (final validation
     * still happens again at authenticated checkout regardless).
     */
public function availabilityForProduct(string $productId): int;
⋮----
/**
     * Batched form of availabilityForProduct() for listing/search/category
     * pages — one grouped query instead of N, keyed by product_id. Products
     * with no stock_levels row at all are simply absent from the result
     * (callers should default missing entries to 0).
     *
     * @param  list<string>  $productIds
     * @return array<string, int>
     */
public function availabilityForProducts(array $productIds): array;
````

## File: app/Repositories/Contracts/SupplierRepositoryInterface.php
````php
namespace App\Repositories\Contracts;
⋮----
use App\Models\Supplier;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
⋮----
interface SupplierRepositoryInterface
⋮----
public function find(string $id): ?Supplier;
⋮----
public function paginate(int $perPage = 15): LengthAwarePaginator;
⋮----
/**
     * Flat, minimal list for select-dropdown use.
     *
     * @return Collection<int, Supplier>
     */
public function all(): Collection;
⋮----
/**
     * @param  array<string, mixed>  $attributes
     */
public function create(array $attributes): Supplier;
⋮----
public function update(Supplier $supplier, array $attributes): Supplier;
⋮----
public function delete(Supplier $supplier): bool;
````

## File: app/Repositories/Contracts/WarehouseRepositoryInterface.php
````php
namespace App\Repositories\Contracts;
⋮----
use App\Models\Warehouse;
use Illuminate\Support\Collection;
⋮----
/**
 * Minimal, read-only: warehouse CRUD isn't part of the stock engine module.
 * Just enough to populate select-dropdowns on the stock pages.
 */
interface WarehouseRepositoryInterface
⋮----
public function find(string $id): ?Warehouse;
⋮----
/**
     * @return Collection<int, Warehouse>
     */
public function active(): Collection;
````

## File: app/Repositories/AuditLogRepository.php
````php
namespace App\Repositories;
⋮----
use App\Models\ActivityLog;
use App\Repositories\Contracts\AuditLogRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
⋮----
class AuditLogRepository implements AuditLogRepositoryInterface
⋮----
public function create(array $attributes): ActivityLog
⋮----
return ActivityLog::query()->create($attributes);
⋮----
public function paginate(int $perPage, array $filters = []): LengthAwarePaginator
⋮----
return ActivityLog::query()
->with('causer:id,name')
->when($filters['event'] ?? null, fn ($query, $event) => $query->where('event', $event))
->when($filters['causer_id'] ?? null, fn ($query, $causerId) => $query->where('causer_id', $causerId))
->when($filters['subject_type'] ?? null, fn ($query, $type) => $query->where('subject_type', $type))
->when($filters['date_from'] ?? null, fn ($query, $date) => $query->where('created_at', '>=', $date))
->when($filters['date_to'] ?? null, fn ($query, $date) => $query->where('created_at', '<=', $date))
->orderByDesc('created_at')
->paginate($perPage)
->withQueryString();
⋮----
public function recent(int $limit = 5): Collection
⋮----
->limit($limit)
->get();
````

## File: app/Repositories/BusinessAccountRepository.php
````php
namespace App\Repositories;
⋮----
use App\Models\BusinessAccount;
use App\Repositories\Contracts\BusinessAccountRepositoryInterface;
⋮----
class BusinessAccountRepository implements BusinessAccountRepositoryInterface
⋮----
public function find(string $id): ?BusinessAccount
⋮----
return BusinessAccount::query()->find($id);
⋮----
public function findByUserId(int $userId): ?BusinessAccount
⋮----
return BusinessAccount::query()->where('user_id', $userId)->first();
⋮----
public function lockForUpdate(string $id): ?BusinessAccount
⋮----
return BusinessAccount::query()->lockForUpdate()->find($id);
⋮----
public function update(BusinessAccount $businessAccount, array $attributes): BusinessAccount
⋮----
$businessAccount->update($attributes);
````

## File: app/Repositories/CategoryRepository.php
````php
namespace App\Repositories;
⋮----
use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Support\Collection;
⋮----
class CategoryRepository implements CategoryRepositoryInterface
⋮----
public function find(string $id): ?Category
⋮----
return Category::query()->find($id);
⋮----
public function allWithChildren(): Collection
⋮----
return Category::query()
->whereNull('parent_id')
->with('children')
->orderBy('name')
->get();
⋮----
public function all(): Collection
⋮----
return Category::query()->orderBy('name')->get(['id', 'name', 'parent_id']);
⋮----
public function create(array $attributes): Category
⋮----
return Category::query()->create($attributes);
⋮----
public function update(Category $category, array $attributes): Category
⋮----
$category->update($attributes);
⋮----
public function delete(Category $category): bool
⋮----
return (bool) $category->delete();
````

## File: app/Repositories/ImportRepository.php
````php
namespace App\Repositories;
⋮----
use App\Enums\ImportRowStatus;
use App\Models\ImportBatch;
use App\Models\ImportRow;
use App\Repositories\Contracts\ImportRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
⋮----
class ImportRepository implements ImportRepositoryInterface
⋮----
public function findBatch(string $id): ?ImportBatch
⋮----
return ImportBatch::query()->with('uploader')->find($id);
⋮----
public function paginateBatches(int $perPage = 15): LengthAwarePaginator
⋮----
return ImportBatch::query()
->with('uploader')
->latest()
->paginate($perPage);
⋮----
public function createBatch(array $attributes): ImportBatch
⋮----
return ImportBatch::query()->create($attributes);
⋮----
public function updateBatch(ImportBatch $batch, array $attributes): ImportBatch
⋮----
$batch->update($attributes);
⋮----
public function createRow(array $attributes): ImportRow
⋮----
return ImportRow::query()->create($attributes);
⋮----
public function updateRow(ImportRow $row, array $attributes): ImportRow
⋮----
$row->update($attributes);
⋮----
public function rowsForBatch(string $batchId): Collection
⋮----
return ImportRow::query()
->where('import_batch_id', $batchId)
->orderBy('row_number')
->get();
⋮----
public function paginateRowsForBatch(string $batchId, int $perPage = 25): LengthAwarePaginator
⋮----
public function failedRowsForBatch(string $batchId): Collection
⋮----
->where('status', ImportRowStatus::Failed)
⋮----
public function paginateForReport(int $perPage, array $filters = []): LengthAwarePaginator
⋮----
->with('uploader:id,name')
->when($filters['status'] ?? null, fn ($query, $status) => $query->where('status', $status))
->when($filters['entity'] ?? null, fn ($query, $entity) => $query->where('entity', $entity))
->when($filters['uploader_id'] ?? null, fn ($query, $id) => $query->where('uploader_id', $id))
->when($filters['date_from'] ?? null, fn ($query, $date) => $query->where('created_at', '>=', $date))
->when($filters['date_to'] ?? null, fn ($query, $date) => $query->where('created_at', '<=', $date))
->orderByDesc('created_at')
->paginate($perPage)
->withQueryString();
````

## File: app/Repositories/OrderRepository.php
````php
namespace App\Repositories;
⋮----
use App\Enums\OrderStatus;
use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
⋮----
class OrderRepository implements OrderRepositoryInterface
⋮----
public function find(string $id): ?Order
⋮----
return Order::query()->find($id);
⋮----
public function paginateForUser(int $userId, int $perPage = 15): LengthAwarePaginator
⋮----
return Order::query()
->where('user_id', $userId)
->latest()
->paginate($perPage);
⋮----
public function create(array $attributes): Order
⋮----
return Order::query()->create($attributes);
⋮----
public function update(Order $order, array $attributes): Order
⋮----
$order->update($attributes);
⋮----
public function expiredReservations(): Collection
⋮----
->where('status', OrderStatus::Reserved)
->whereNotNull('reserved_until')
->where('reserved_until', '<', now())
->get();
⋮----
/**
     * Paginated, filterable listing for the Sales report. product_id/
     * warehouse_id live on order_items, not orders, so those two filters
     * go through a whereHas() — the (status, created_at) index on `orders`
     * still serves the status/date filters directly.
     */
public function paginateForSalesReport(int $perPage, array $filters = []): LengthAwarePaginator
⋮----
->with('user:id,name')
->when($filters['status'] ?? null, fn ($query, $status) => $query->where('status', $status))
->when($filters['user_id'] ?? null, fn ($query, $userId) => $query->where('user_id', $userId))
->when($filters['date_from'] ?? null, fn ($query, $date) => $query->where('created_at', '>=', $date))
->when($filters['date_to'] ?? null, fn ($query, $date) => $query->where('created_at', '<=', $date))
->when(
⋮----
fn ($query, $productId) => $query->whereHas('items', fn ($q) => $q->where('product_id', $productId))
⋮----
fn ($query, $warehouseId) => $query->whereHas('items', fn ($q) => $q->where('warehouse_id', $warehouseId))
⋮----
->orderByDesc('created_at')
->paginate($perPage)
->withQueryString();
⋮----
public function salesTotalSince(\DateTimeInterface $since): string
⋮----
return (string) Order::query()
->whereIn('status', [OrderStatus::Confirmed, OrderStatus::Fulfilled])
->where('created_at', '>=', $since)
->sum('total');
````

## File: app/Repositories/PaymentRepository.php
````php
namespace App\Repositories;
⋮----
use App\Enums\PaymentStatus;
use App\Models\Order;
use App\Models\Payment;
use App\Models\PurchaseOrder;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
⋮----
class PaymentRepository implements PaymentRepositoryInterface
⋮----
public function find(string $id): ?Payment
⋮----
return Payment::query()->find($id);
⋮----
public function lockForUpdate(string $id): ?Payment
⋮----
return Payment::query()
->whereKey($id)
->lockForUpdate()
->first();
⋮----
public function findByGatewayRef(string $gatewayRef): ?Payment
⋮----
return Payment::query()->where('gateway_ref', $gatewayRef)->first();
⋮----
public function paginateAll(int $perPage = 15): LengthAwarePaginator
⋮----
->with('payable')
->latest()
->paginate($perPage);
⋮----
public function paginateForBusinessAccount(string $businessAccountId, int $perPage = 15): LengthAwarePaginator
⋮----
->where('payable_type', (new PurchaseOrder)->getMorphClass())
->whereHasMorph('payable', [PurchaseOrder::class], fn ($query) => $query
->where('business_account_id', $businessAccountId))
⋮----
public function create(array $attributes): Payment
⋮----
return Payment::query()->create($attributes);
⋮----
public function update(Payment $payment, array $attributes): Payment
⋮----
$payment->update($attributes);
⋮----
public function forPayable(Model $payable): Collection
⋮----
->where('payable_type', $payable->getMorphClass())
->where('payable_id', $payable->getKey())
->get();
⋮----
public function paginateForReport(int $perPage, array $filters = []): LengthAwarePaginator
⋮----
->when($filters['status'] ?? null, fn ($query, $status) => $query->where('status', $status))
->when($filters['method'] ?? null, fn ($query, $method) => $query->where('method', $method))
->when($filters['date_from'] ?? null, fn ($query, $date) => $query->where('created_at', '>=', $date))
->when($filters['date_to'] ?? null, fn ($query, $date) => $query->where('created_at', '<=', $date))
->when($filters['user_id'] ?? null, function ($query, $userId) {
$query->where(function ($query) use ($userId) {
⋮----
->whereHasMorph('payable', [Order::class], fn ($q) => $q->where('user_id', $userId))
->orWhereHasMorph('payable', [PurchaseOrder::class], fn ($q) => $q
->whereHas('businessAccount', fn ($q) => $q->where('user_id', $userId)));
⋮----
->orderByDesc('created_at')
->paginate($perPage)
->withQueryString();
⋮----
public function countByStatus(PaymentStatus $status): int
⋮----
return Payment::query()->where('status', $status)->count();
````

## File: app/Repositories/PriceListRepository.php
````php
namespace App\Repositories;
⋮----
use App\Enums\PriceListType;
use App\Models\PriceList;
use App\Models\PriceListItem;
use App\Repositories\Contracts\PriceListRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
⋮----
class PriceListRepository implements PriceListRepositoryInterface
⋮----
public function find(string $id): ?PriceList
⋮----
return PriceList::query()->find($id);
⋮----
public function paginateWithItems(int $perPage = 15): LengthAwarePaginator
⋮----
return PriceList::query()
->with(['items.product:id,name,sku'])
->orderBy('name')
->paginate($perPage);
⋮----
public function create(array $attributes): PriceList
⋮----
return PriceList::query()->create($attributes);
⋮----
public function update(PriceList $priceList, array $attributes): PriceList
⋮----
$priceList->update($attributes);
⋮----
public function findItem(string $id): ?PriceListItem
⋮----
return PriceListItem::query()->with('product.supplier')->find($id);
⋮----
public function createItem(array $attributes): PriceListItem
⋮----
return PriceListItem::query()->create($attributes);
⋮----
public function updateItem(PriceListItem $item, array $attributes): PriceListItem
⋮----
$item->update($attributes);
⋮----
public function deleteItem(PriceListItem $item): bool
⋮----
return (bool) $item->delete();
⋮----
public function activeRetailItemFor(string $productId, int $quantity): ?PriceListItem
⋮----
return $this->activeItemFor(PriceListType::B2cRetail, $productId, $quantity);
⋮----
public function activeTierItemFor(string $productId, int $quantity): ?PriceListItem
⋮----
return $this->activeItemFor(PriceListType::B2bTier, $productId, $quantity);
⋮----
private function activeItemFor(PriceListType $type, string $productId, int $quantity): ?PriceListItem
⋮----
return PriceListItem::query()
->whereHas('priceList', fn ($query) => $query
->where('type', $type)
->where('is_active', true))
->where('product_id', $productId)
->where('min_qty', '<=', $quantity)
->orderByDesc('min_qty')
->first();
````

## File: app/Repositories/ProductRepository.php
````php
namespace App\Repositories;
⋮----
use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
⋮----
class ProductRepository implements ProductRepositoryInterface
⋮----
public function find(string $id): ?Product
⋮----
return Product::query()->find($id);
⋮----
public function findWithRelations(string $id): ?Product
⋮----
return Product::query()->with(['category', 'supplier', 'priceListItems.priceList'])->find($id);
⋮----
public function findBySku(string $sku): ?Product
⋮----
return Product::query()->where('sku', $sku)->first();
⋮----
public function findActiveBySku(string $sku): ?Product
⋮----
return Product::query()->where('sku', $sku)->where('is_active', true)->with('category')->first();
⋮----
public function paginate(int $perPage = 15, array $filters = []): LengthAwarePaginator
⋮----
$query = Product::query()->with('category')->orderBy('name');
⋮----
$this->applySearch($query, $filters['search']);
⋮----
$query->where('category_id', $filters['category_id']);
⋮----
$query->where('supplier_id', $filters['supplier_id']);
⋮----
return $query->paginate($perPage)->withQueryString();
⋮----
public function publicPaginatedList(int $perPage = 15, array $filters = []): LengthAwarePaginator
⋮----
$query = Product::query()->where('is_active', true)->with('category')->orderBy('name');
⋮----
public function create(array $attributes): Product
⋮----
return Product::query()->create($attributes);
⋮----
public function update(Product $product, array $attributes): Product
⋮----
$product->update($attributes);
⋮----
public function delete(Product $product): bool
⋮----
return (bool) $product->delete();
⋮----
/**
     * FULLTEXT search on real MySQL (matches the products_name_fulltext
     * index — see the products migration); falls back to LIKE on SQLite,
     * which the app's fast feature-test suite runs on.
     */
private function applySearch(Builder $query, string $search): void
⋮----
if (DB::connection()->getDriverName() === 'mysql') {
$query->whereFullText('name', $search);
⋮----
$query->where('name', 'like', "%{$search}%");
````

## File: app/Repositories/PurchaseOrderRepository.php
````php
namespace App\Repositories;
⋮----
use App\Enums\PurchaseOrderStatus;
use App\Models\PurchaseOrder;
use App\Repositories\Contracts\PurchaseOrderRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
⋮----
class PurchaseOrderRepository implements PurchaseOrderRepositoryInterface
⋮----
public function find(string $id): ?PurchaseOrder
⋮----
return PurchaseOrder::query()->find($id);
⋮----
public function paginateForBusinessAccount(string $businessAccountId, int $perPage = 15): LengthAwarePaginator
⋮----
return PurchaseOrder::query()
->where('business_account_id', $businessAccountId)
->latest()
->paginate($perPage);
⋮----
public function paginateAll(int $perPage = 15): LengthAwarePaginator
⋮----
return PurchaseOrder::query()->latest()->paginate($perPage);
⋮----
public function create(array $attributes): PurchaseOrder
⋮----
return PurchaseOrder::query()->create($attributes);
⋮----
public function update(PurchaseOrder $purchaseOrder, array $attributes): PurchaseOrder
⋮----
$purchaseOrder->update($attributes);
⋮----
public function countByStatus(PurchaseOrderStatus $status, ?string $businessAccountId = null): int
⋮----
->where('status', $status)
->when($businessAccountId, fn ($query, $id) => $query->where('business_account_id', $id))
->count();
````

## File: app/Repositories/QuoteRepository.php
````php
namespace App\Repositories;
⋮----
use App\Models\Quote;
use App\Repositories\Contracts\QuoteRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
⋮----
class QuoteRepository implements QuoteRepositoryInterface
⋮----
public function find(string $id): ?Quote
⋮----
return Quote::query()->find($id);
⋮----
public function paginateForBusinessAccount(string $businessAccountId, int $perPage = 15): LengthAwarePaginator
⋮----
return Quote::query()
->where('business_account_id', $businessAccountId)
->latest()
->paginate($perPage);
⋮----
public function paginateForVendor(int $vendorUserId, int $perPage = 15): LengthAwarePaginator
⋮----
->whereHas('items.product.supplier', fn ($query) => $query->where('user_id', $vendorUserId))
⋮----
public function paginateAll(int $perPage = 15): LengthAwarePaginator
⋮----
return Quote::query()->latest()->paginate($perPage);
⋮----
public function create(array $attributes): Quote
⋮----
return Quote::query()->create($attributes);
⋮----
public function update(Quote $quote, array $attributes): Quote
⋮----
$quote->update($attributes);
````

## File: app/Repositories/StockRepository.php
````php
namespace App\Repositories;
⋮----
use App\Enums\MovementType;
use App\Models\StockLevel;
use App\Models\StockMovement;
use App\Repositories\Contracts\StockRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
⋮----
class StockRepository implements StockRepositoryInterface
⋮----
/**
     * Movement types that affect on_hand.
     */
⋮----
/**
     * Movement types that affect reserved.
     */
⋮----
public function findLevel(string $productId, string $warehouseId): ?StockLevel
⋮----
return StockLevel::query()
->where('product_id', $productId)
->where('warehouse_id', $warehouseId)
->first();
⋮----
public function lockLevelForUpdate(string $productId, string $warehouseId): ?StockLevel
⋮----
->lockForUpdate()
⋮----
public function lockOrCreateLevel(string $productId, string $warehouseId): StockLevel
⋮----
$level = $this->lockLevelForUpdate($productId, $warehouseId);
⋮----
return $this->createLevel([
⋮----
// A concurrent transaction won the race to create this pair
// (unique constraint on product_id+warehouse_id). Fall back to
// locking its row — this blocks until that transaction commits.
⋮----
public function createLevel(array $attributes): StockLevel
⋮----
return StockLevel::query()->create($attributes);
⋮----
public function updateLevel(StockLevel $level, array $attributes): StockLevel
⋮----
$level->update($attributes);
⋮----
public function createMovement(array $attributes): StockMovement
⋮----
return StockMovement::query()->create($attributes);
⋮----
public function movementsFor(string $productId, string $warehouseId): Collection
⋮----
return StockMovement::query()
⋮----
->orderBy('created_at')
->get();
⋮----
public function paginateLevels(int $perPage, array $filters = []): LengthAwarePaginator
⋮----
->with(['product:id,name,sku', 'warehouse:id,name,code'])
->when($filters['product_id'] ?? null, fn ($query, $id) => $query->where('product_id', $id))
->when($filters['warehouse_id'] ?? null, fn ($query, $id) => $query->where('warehouse_id', $id))
->orderBy('updated_at', 'desc')
->paginate($perPage)
->withQueryString();
⋮----
public function paginateMovements(int $perPage, array $filters = []): LengthAwarePaginator
⋮----
->with(['product:id,name,sku', 'warehouse:id,name,code', 'actor:id,name'])
⋮----
->when($filters['type'] ?? null, fn ($query, $type) => $query->where('type', $type))
// actor_id ("user") and date_from/date_to power the Stock
// Movement report's filters — additive, the Stock/Movements
// page itself only ever passes product_id/warehouse_id/type.
->when($filters['actor_id'] ?? null, fn ($query, $id) => $query->where('actor_id', $id))
->when($filters['date_from'] ?? null, fn ($query, $date) => $query->where('created_at', '>=', $date))
->when($filters['date_to'] ?? null, fn ($query, $date) => $query->where('created_at', '<=', $date))
->orderBy('created_at', 'desc')
⋮----
/**
     * Stock levels whose available (on_hand - reserved) is at or below
     * $threshold — the Low Stock report. Uses the existing
     * (product_id, warehouse_id) unique index for the product/warehouse
     * filters; `available` isn't a stored column so the threshold
     * comparison itself is necessarily a computed-expression filter, not
     * an index seek — acceptable at this table's scale (one row per
     * product/warehouse pair, never per-movement).
     */
public function paginateLowStockLevels(int $threshold, int $perPage, array $filters = []): LengthAwarePaginator
⋮----
->whereRaw('(on_hand - reserved) <= ?', [$threshold])
⋮----
->orderByRaw('(on_hand - reserved) asc')
⋮----
public function allLevels(?string $productId = null, ?string $warehouseId = null): Collection
⋮----
->when($productId, fn ($query) => $query->where('product_id', $productId))
->when($warehouseId, fn ($query) => $query->where('warehouse_id', $warehouseId))
⋮----
public function ledgerTotals(?string $productId = null, ?string $warehouseId = null): Collection
⋮----
$onHandTypes = collect(self::ON_HAND_TYPES)->map(fn ($type) => "'{$type}'")->implode(',');
$reservedTypes = collect(self::RESERVED_TYPES)->map(fn ($type) => "'{$type}'")->implode(',');
⋮----
return DB::table('stock_movements')
->select('product_id', 'warehouse_id')
->selectRaw("SUM(CASE WHEN type IN ({$onHandTypes}) THEN quantity ELSE 0 END) as ledger_on_hand")
->selectRaw("SUM(CASE WHEN type IN ({$reservedTypes}) THEN quantity ELSE 0 END) as ledger_reserved")
⋮----
->groupBy('product_id', 'warehouse_id')
->get()
->map(fn ($row) => (object) [
⋮----
public function levelsForProductOrderedByAvailability(string $productId): Collection
⋮----
->whereHas('warehouse', fn ($query) => $query->where('is_active', true))
->with('warehouse')
⋮----
->sortByDesc(fn (StockLevel $level) => $level->available)
->values();
⋮----
public function countLowStockLevels(int $threshold): int
⋮----
->count();
⋮----
public function availabilityForProduct(string $productId): int
⋮----
return (int) StockLevel::query()
⋮----
->selectRaw('COALESCE(SUM(on_hand - reserved), 0) as total')
->value('total');
⋮----
public function availabilityForProducts(array $productIds): array
⋮----
->whereIn('product_id', $productIds)
⋮----
->selectRaw('product_id, COALESCE(SUM(on_hand - reserved), 0) as total')
->groupBy('product_id')
->pluck('total', 'product_id')
->map(fn ($total) => (int) $total)
->all();
````

## File: app/Repositories/SupplierRepository.php
````php
namespace App\Repositories;
⋮----
use App\Models\Supplier;
use App\Repositories\Contracts\SupplierRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
⋮----
class SupplierRepository implements SupplierRepositoryInterface
⋮----
public function find(string $id): ?Supplier
⋮----
return Supplier::query()->find($id);
⋮----
public function paginate(int $perPage = 15): LengthAwarePaginator
⋮----
return Supplier::query()->orderBy('name')->paginate($perPage);
⋮----
public function all(): Collection
⋮----
return Supplier::query()->where('is_active', true)->orderBy('name')->get(['id', 'name']);
⋮----
public function create(array $attributes): Supplier
⋮----
return Supplier::query()->create($attributes);
⋮----
public function update(Supplier $supplier, array $attributes): Supplier
⋮----
$supplier->update($attributes);
⋮----
public function delete(Supplier $supplier): bool
⋮----
return (bool) $supplier->delete();
````

## File: app/Repositories/WarehouseRepository.php
````php
namespace App\Repositories;
⋮----
use App\Models\Warehouse;
use App\Repositories\Contracts\WarehouseRepositoryInterface;
use Illuminate\Support\Collection;
⋮----
class WarehouseRepository implements WarehouseRepositoryInterface
⋮----
public function find(string $id): ?Warehouse
⋮----
return Warehouse::query()->find($id);
⋮----
public function active(): Collection
⋮----
return Warehouse::query()
->where('is_active', true)
->orderBy('name')
->get(['id', 'name', 'code']);
````

## File: app/Services/AuditService.php
````php
namespace App\Services;
⋮----
use App\Models\ActivityLog;
use App\Models\User;
use App\Repositories\Contracts\AuditLogRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
⋮----
/**
 * The only place `activity_log` is ever written — mirrors StockService
 * being the only writer of `stock_movements`. Called from inside the
 * business-rule Services that perform an auditable action (stock
 * adjustments, PO approvals, payment settlement, role/permission changes),
 * never from a Controller directly, so an audit entry can never be
 * recorded without the action it describes actually having happened (both
 * live inside the same DB::transaction() in the caller).
 *
 * See docs/project/canonical-decisions.md §2 and requirement #2 of the
 * admin/audit/dashboard/reports module for the exact event categories.
 */
class AuditService
⋮----
public function __construct(private readonly AuditLogRepositoryInterface $logs) {}
⋮----
/**
     * @param  array<string, mixed>  $properties
     */
public function record(string $event, ?Model $subject, ?User $causer, array $properties = []): ActivityLog
⋮----
return $this->logs->create([
⋮----
/**
     * @param  array<string, mixed>  $filters
     */
public function listAll(int $perPage = 15, array $filters = []): LengthAwarePaginator
⋮----
return $this->logs->paginate($perPage, $filters);
````

## File: app/Services/AuthService.php
````php
namespace App\Services;
⋮----
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
⋮----
/**
 * Session (`web` guard) authentication for the human Inertia UI.
 *
 * @see docs/project/canonical-decisions.md §3 — session auth for humans,
 *      Passport is reserved exclusively for the external B2B API.
 */
class AuthService
⋮----
/**
     * Attempt to authenticate the request and establish a session.
     *
     * @throws ValidationException when credentials don't match.
     */
public function login(LoginRequest $request): void
⋮----
if (! Auth::attempt($request->credentials(), $request->remember())) {
// Deliberately generic: does not reveal whether the email exists
// or the password was wrong (FR-1.1 / US-1.1 non-leaking AC).
throw ValidationException::withMessages([
⋮----
$request->session()->regenerate();
⋮----
/**
     * Log the current user out and fully invalidate the session.
     */
public function logout(Request $request): void
⋮----
Auth::guard('web')->logout();
⋮----
$request->session()->invalidate();
$request->session()->regenerateToken();
````

## File: app/Services/CartService.php
````php
namespace App\Services;
⋮----
use App\Exceptions\OutOfStockException;
use App\Exceptions\ProductUnavailableException;
use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
⋮----
/**
 * Session-backed cart — requirement #1 of the B2C checkout module allows
 * either a database-backed or session-backed cart, as long as order
 * creation itself is database-backed (which it is: OrderService::checkout()
 * writes the real `orders`/`order_items` rows and reserves stock). Storing
 * `[product_id => quantity]` in the session keeps this simple and avoids a
 * cart table + cleanup job for what is, until checkout, disposable state.
 * Prices are always looked up fresh (never cached in the session), so a
 * price-list change is reflected immediately.
 *
 * Deliberately never touches StockService: adding to (or updating) the
 * cart only ever writes to the session. No stock_movements row, no
 * reservation, is ever created here — that only happens once an
 * authenticated checkout calls OrderService::checkout(), which delegates
 * to StockService. This is what makes a guest cart safe to expose with no
 * login at all. Because it's plain Laravel session state, it survives a
 * login/logout transition for free — Laravel regenerates the session ID
 * on login (AuthService::login()) but keeps the session's data, so a
 * guest's cart is still there once they authenticate.
 */
class CartService
⋮----
public function __construct(
⋮----
/**
     * Only blocks a completely out-of-stock product (available <= 0) — it
     * deliberately does NOT compare the requested quantity against the
     * exact amount available. That stricter check is checkout's job
     * (OrderService::checkout() -> StockService::reserve(), which rolls
     * back the whole order atomically on a partial shortfall — see
     * tests/Feature/Sales/CheckoutTest.php::
     * test_partial_availability_fails_without_partial_writes()). Cart-add
     * is a lighter, advisory gate: "is this even sellable at all", not a
     * reservation or a promise the full requested quantity will be
     * honored (see Cart rule #9 — "final stock validation must happen
     * again during authenticated checkout").
     *
     * @throws ProductUnavailableException the product doesn't exist or isn't active
     * @throws OutOfStockException the product has zero availability across every warehouse
     */
public function add(string $productId, int $quantity): void
⋮----
$product = $this->products->find($productId);
⋮----
throw ProductUnavailableException::forProduct($productId);
⋮----
$available = $this->availability->totalAvailableFor($productId);
⋮----
throw OutOfStockException::forCartAddition($productId, $quantity, $available);
⋮----
$cart = $this->raw();
⋮----
$this->put($cart);
⋮----
public function updateQuantity(string $productId, int $quantity): void
⋮----
public function remove(string $productId): void
⋮----
public function clear(): void
⋮----
Session::forget(self::SESSION_KEY);
⋮----
public function isEmpty(): bool
⋮----
return $this->raw() === [];
⋮----
/**
     * Total item count across all lines (sum of quantities, not distinct
     * line count) — shared on every Inertia response as `cart.count` for
     * the storefront header badge.
     */
public function count(): int
⋮----
return array_sum($this->raw());
⋮----
/**
     * Priced cart lines for display — looks up the current product and
     * retail price for every line, silently dropping lines whose product
     * no longer exists (e.g. deleted after being added to the cart).
     *
     * @return Collection<int, array{product: Product, quantity: int, unit_price: string, line_total: string}>
     */
public function lines(): Collection
⋮----
return collect($this->raw())
->map(function (int $quantity, string $productId) {
$product = Product::query()->find($productId);
⋮----
$priceItem = $this->catalog->retailPriceFor($productId, $quantity);
⋮----
->filter()
->values();
⋮----
public function subtotal(): string
⋮----
return $this->lines()->reduce(
⋮----
/**
     * The shape OrderService::checkout() expects.
     *
     * @return list<array{product_id: string, quantity: int}>
     */
public function toCheckoutLines(): array
⋮----
->map(fn (int $quantity, string $productId) => ['product_id' => $productId, 'quantity' => $quantity])
->values()
->all();
⋮----
/**
     * @return array<string, int>
     */
private function raw(): array
⋮----
return Session::get(self::SESSION_KEY, []);
⋮----
/**
     * @param  array<string, int>  $cart
     */
private function put(array $cart): void
⋮----
Session::put(self::SESSION_KEY, $cart);
````

## File: app/Services/CatalogService.php
````php
namespace App\Services;
⋮----
use App\Models\Category;
use App\Models\PriceList;
use App\Models\PriceListItem;
use App\Models\Product;
use App\Models\Supplier;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\PriceListRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\SupplierRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
⋮----
/**
 * Catalog reads and writes (FR-3.1–3.5). Reads are cache-aside under a
 * single 'catalog' Redis tag; every write flushes that whole tag rather
 * than trying to bust individual keys — simple and correct given products,
 * categories, and price lists all influence each other's listings.
 * See docs/project/canonical-decisions.md §11 and requirement #4/#5.
 */
class CatalogService
⋮----
/**
     * Catalog reads TTL — 1 hour, per the Enterprise PRD §11.
     */
⋮----
public function __construct(
⋮----
// ---------------------------------------------------------------
// Products
⋮----
/**
     * @param  array<string, mixed>  $filters
     */
public function listProducts(int $perPage = 15, array $filters = []): LengthAwarePaginator
⋮----
$page = Paginator::resolveCurrentPage() ?: 1;
⋮----
return $this->remember(
$this->cacheKey('products', $page, $perPage, $filters),
fn () => $this->products->paginate($perPage, $filters)
⋮----
public function findProduct(string $id): ?Product
⋮----
return $this->products->find($id);
⋮----
public function findProductWithRelations(string $id): ?Product
⋮----
return $this->products->findWithRelations($id);
⋮----
public function findProductBySku(string $sku): ?Product
⋮----
return $this->products->findBySku($sku);
⋮----
/**
     * @param  array<string, mixed>  $attributes
     */
public function createProduct(array $attributes): Product
⋮----
$product = $this->products->create($attributes);
⋮----
$this->flushCache();
⋮----
public function updateProduct(Product $product, array $attributes): Product
⋮----
$product = $this->products->update($product, $attributes);
⋮----
public function deleteProduct(Product $product): bool
⋮----
$deleted = $this->products->delete($product);
⋮----
// Categories
⋮----
/**
     * @return Collection<int, Category>
     */
public function listCategories(): Collection
⋮----
$this->cacheKey('categories'),
fn () => $this->categories->allWithChildren()
⋮----
/**
     * Flat list for select-dropdown use (product/category forms).
     *
     * @return Collection<int, Category>
     */
public function listCategoriesFlat(): Collection
⋮----
$this->cacheKey('categories', 'flat'),
fn () => $this->categories->all()
⋮----
public function createCategory(array $attributes): Category
⋮----
$category = $this->categories->create($attributes);
⋮----
public function deleteCategory(Category $category): bool
⋮----
$deleted = $this->categories->delete($category);
⋮----
// Suppliers
⋮----
public function listSuppliers(int $perPage = 15): LengthAwarePaginator
⋮----
$this->cacheKey('suppliers', $page, $perPage),
fn () => $this->suppliers->paginate($perPage)
⋮----
/**
     * Flat list of active suppliers for select-dropdown use (product form).
     *
     * @return Collection<int, Supplier>
     */
public function listSuppliersFlat(): Collection
⋮----
$this->cacheKey('suppliers', 'flat'),
fn () => $this->suppliers->all()
⋮----
public function createSupplier(array $attributes): Supplier
⋮----
$supplier = $this->suppliers->create($attributes);
⋮----
public function deleteSupplier(Supplier $supplier): bool
⋮----
$deleted = $this->suppliers->delete($supplier);
⋮----
// Price lists & items
⋮----
public function listPriceLists(int $perPage = 15): LengthAwarePaginator
⋮----
$this->cacheKey('price_lists', $page, $perPage),
fn () => $this->priceLists->paginateWithItems($perPage)
⋮----
public function createPriceList(array $attributes): PriceList
⋮----
$priceList = $this->priceLists->create($attributes);
⋮----
public function findPriceListItem(string $id): ?PriceListItem
⋮----
return $this->priceLists->findItem($id);
⋮----
public function createPriceListItem(array $attributes): PriceListItem
⋮----
$item = $this->priceLists->createItem($attributes);
⋮----
public function updatePriceListItem(PriceListItem $item, array $attributes): PriceListItem
⋮----
$item = $this->priceLists->updateItem($item, $attributes);
⋮----
public function deletePriceListItem(PriceListItem $item): bool
⋮----
$deleted = $this->priceLists->deleteItem($item);
⋮----
/**
     * The applicable retail (B2C) unit price for a product at a given
     * quantity — the active `b2c_retail` price list's item with the
     * highest `min_qty` that's still `<= $quantity`. Used by
     * OrderService::checkout() to price order lines server-side; see
     * requirement #2/#3 in the B2C checkout module (totals computed
     * server-side, retail price list applies).
     */
public function retailPriceFor(string $productId, int $quantity = 1): ?PriceListItem
⋮----
$this->cacheKey('retail_price', $productId, $quantity),
fn () => $this->priceLists->activeRetailItemFor($productId, $quantity)
⋮----
/**
     * The applicable B2B tier unit price for a product at a given quantity
     * — the active `b2b_tier` price list's item with the highest `min_qty`
     * that's still `<= $quantity`. Used only as a *suggested* starting
     * price when a Vendor/Inventory Manager prices a quote line
     * (QuoteService::price()) — the actual submitted unit_price can
     * override it, since a quote is a negotiated price, not a fixed
     * catalog lookup like B2C checkout.
     */
public function tierPriceFor(string $productId, int $quantity = 1): ?PriceListItem
⋮----
$this->cacheKey('tier_price', $productId, $quantity),
fn () => $this->priceLists->activeTierItemFor($productId, $quantity)
⋮----
private function remember(string $key, \Closure $callback): mixed
⋮----
return Cache::tags([self::CACHE_TAG])->remember($key, self::CACHE_TTL, $callback);
⋮----
private function cacheKey(string $entity, mixed ...$parts): string
⋮----
private function flushCache(): void
⋮----
Cache::tags([self::CACHE_TAG])->flush();
````

## File: app/Services/DashboardService.php
````php
namespace App\Services;
⋮----
use App\Enums\PaymentStatus;
use App\Enums\PurchaseOrderStatus;
use App\Models\BusinessAccount;
use App\Models\User;
use App\Repositories\Contracts\AuditLogRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use App\Repositories\Contracts\PurchaseOrderRepositoryInterface;
use App\Repositories\Contracts\StockRepositoryInterface;
use Illuminate\Support\Facades\Cache;
⋮----
/**
 * Dashboard KPIs (requirement #1: "props must be efficient and cached
 * where useful"). Every KPI is a single COUNT/SUM query (see the
 * Repository methods this calls — no N+1, no loading full rows just to
 * count them), and the whole bundle is cached for a short TTL rather than
 * invalidated on every write: a dashboard reads as "accurate to the last
 * minute", not "live to the millisecond", which is a reasonable trade for
 * how cheap the queries already are and how often the underlying data
 * changes (stock movements, orders, payments — all the time). Contrast
 * with CatalogService's tag-based cache-and-flush-on-write, which is
 * appropriate there because catalog reads vastly outnumber writes; here
 * it's the opposite.
 */
class DashboardService
⋮----
/** Same interpretive default as ReportService::lowStock(). */
⋮----
public function __construct(
⋮----
/**
     * @return array<string, mixed>
     */
public function kpisFor(User $user): array
⋮----
return Cache::remember(
$this->cacheKey($businessAccount),
⋮----
fn () => $this->businessBuyerKpis($businessAccount)
⋮----
// A bare Retail Customer (no business account, no staff
// permissions) has no aggregate KPIs to see — staffKpis() exposes
// store-wide numbers that aren't theirs to look at.
if (! $this->hasAnyStaffPermission($user)) {
⋮----
return Cache::remember('dashboard:kpis:staff', self::CACHE_TTL_SECONDS, fn () => $this->staffKpis());
⋮----
private function hasAnyStaffPermission(User $user): bool
⋮----
return $user->isAbleTo('stock.read')
|| $user->isAbleTo('audit.read')
|| $user->isAbleTo('po.approve')
|| $user->isAbleTo('payment.settle');
⋮----
private function staffKpis(): array
⋮----
'low_stock_count' => $this->stock->countLowStockLevels(self::LOW_STOCK_THRESHOLD),
'pending_po_approvals' => $this->purchaseOrders->countByStatus(PurchaseOrderStatus::PendingApproval),
'pending_payments' => $this->payments->countByStatus(PaymentStatus::Pending),
'todays_sales_total' => $this->orders->salesTotalSince(now()->startOfDay()),
'recent_activity' => $this->auditLogs->recent(self::RECENT_ACTIVITY_LIMIT)->map(fn ($log) => [
⋮----
private function businessBuyerKpis(BusinessAccount $businessAccount): array
⋮----
'pending_po_approvals' => $this->purchaseOrders->countByStatus(PurchaseOrderStatus::PendingApproval, $businessAccount->id),
⋮----
private function cacheKey(BusinessAccount $businessAccount): string
````

## File: app/Services/ImportService.php
````php
namespace App\Services;
⋮----
use App\Enums\ImportEntity;
use App\Enums\ImportRowStatus;
use App\Enums\ImportStatus;
use App\Enums\PriceListType;
use App\Exceptions\ImportValidationException;
use App\Imports\CatalogRowsImport;
use App\Jobs\ImportCatalogJob;
use App\Models\Category;
use App\Models\ImportBatch;
use App\Models\ImportRow;
use App\Models\PriceList;
use App\Models\PriceListItem;
use App\Models\Product;
use App\Models\StockLevel;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Warehouse;
use App\Repositories\Contracts\ImportRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use RuntimeException;
use Throwable;
⋮----
class ImportService
⋮----
public function __construct(
⋮----
public function listBatches(int $perPage = 15): LengthAwarePaginator
⋮----
return $this->imports->paginateBatches($perPage);
⋮----
public function findBatch(string $id): ?ImportBatch
⋮----
return $this->imports->findBatch($id);
⋮----
public function rowsForBatch(string $batchId, int $perPage = 25): LengthAwarePaginator
⋮----
return $this->imports->paginateRowsForBatch($batchId, $perPage);
⋮----
/**
     * @return Collection<int, ImportRow>
     */
public function failedRowsForBatch(string $batchId): Collection
⋮----
return $this->imports->failedRowsForBatch($batchId);
⋮----
public function start(User $uploader, ImportEntity $entity, UploadedFile $file): ImportBatch
⋮----
$batch = $this->imports->createBatch([
⋮----
'file_path' => $file->store('imports'),
'original_filename' => $file->getClientOriginalName(),
⋮----
ImportCatalogJob::dispatch($batch->id);
⋮----
public function run(string $importBatchId): void
⋮----
$batch = $this->imports->findBatch($importBatchId);
⋮----
$this->imports->updateBatch($batch, ['status' => ImportStatus::Processing]);
⋮----
if ($this->imports->rowsForBatch($batch->id)->isEmpty()) {
$this->createRowsFromFile($batch);
⋮----
$this->processPendingRows($batch);
$this->refreshBatchCounts($batch, ImportStatus::Completed);
$this->flushCatalogCache($batch->entity);
⋮----
$this->imports->updateBatch($batch->fresh(), ['status' => ImportStatus::Failed]);
⋮----
public function processRow(string $importBatchId, int $rowNumber, array $payload): void
⋮----
$row = $this->imports->createRow([
⋮----
'payload' => $this->normalizePayload($payload),
⋮----
DB::transaction(function () use ($batch, $row) {
⋮----
DB::transaction(fn () => $this->importStoredRow($batch, $row));
⋮----
$this->recordFailedRow($row->fresh(), $exception);
⋮----
$this->refreshBatchCounts($batch);
⋮----
private function createRowsFromFile(ImportBatch $batch): void
⋮----
Excel::import($import, $batch->file_path, 'local');
⋮----
$rows = $import->rows()
->map(fn (array $payload, int $index) => [
'id' => (string) Str::uuid(),
⋮----
'payload' => json_encode($this->normalizePayload($payload), JSON_THROW_ON_ERROR),
⋮----
->values();
⋮----
DB::transaction(function () use ($batch, $rows) {
$rows->chunk(self::ROW_BATCH_SIZE)->each(function (Collection $chunk) {
ImportRow::query()->insert($chunk->all());
⋮----
$this->imports->updateBatch($batch, [
'total_rows' => $rows->count(),
⋮----
private function processPendingRows(ImportBatch $batch): void
⋮----
$pendingRows = $this->imports->rowsForBatch($batch->id)
->filter(fn (ImportRow $row) => $row->status === ImportRowStatus::Pending)
⋮----
$pendingRows->chunk(self::ROW_BATCH_SIZE)->each(function (Collection $chunk) use ($batch) {
DB::transaction(function () use ($batch, $chunk) {
$chunk->each(function (ImportRow $row) use ($batch) {
⋮----
$this->refreshBatchCounts($batch, ImportStatus::Processing);
⋮----
private function importStoredRow(ImportBatch $batch, ImportRow $row): void
⋮----
ImportEntity::Categories => $this->importCategory($row),
ImportEntity::Products => $this->importProduct($row),
ImportEntity::Warehouses => $this->importWarehouse($row),
ImportEntity::Suppliers => $this->importSupplier($row),
ImportEntity::PriceLists => $this->importPriceListItem($row),
ImportEntity::OpeningStock => $this->importOpeningStock($batch, $row),
⋮----
$this->imports->updateRow($row, [
⋮----
private function importCategory(ImportRow $row): void
⋮----
$data = $this->validate($row, [
⋮----
$slug = $data['slug'] ?: Str::slug($data['name']);
⋮----
$this->failRow($row, 'slug', 'A slug is required when the name cannot be converted to one.');
⋮----
$this->failRow($row, 'parent_slug', 'A category cannot be its own parent.');
⋮----
$parent = Category::query()->where('slug', $data['parent_slug'])->first();
⋮----
$this->failRow($row, 'parent_slug', "Parent category [{$data['parent_slug']}] was not found.");
⋮----
Category::query()->updateOrCreate(
⋮----
private function importProduct(ImportRow $row): void
⋮----
$category = $this->resolveCategory($row, $data['category_slug'], $data['category_name']);
$supplier = $this->resolveSupplier($row, $data['supplier_name'], $data['supplier_email'], $data['supplier_phone']);
⋮----
Product::query()->updateOrCreate(
⋮----
'is_active' => $this->booleanValue($row, 'is_active', $data['is_active'], true),
⋮----
private function importWarehouse(ImportRow $row): void
⋮----
Warehouse::query()->updateOrCreate(
⋮----
private function importSupplier(ImportRow $row): void
⋮----
Supplier::query()->updateOrCreate($lookup, [
⋮----
private function importPriceListItem(ImportRow $row): void
⋮----
'type' => ['required', Rule::in(array_column(PriceListType::cases(), 'value'))],
⋮----
$product = Product::query()->where('sku', $data['sku'])->first();
⋮----
$this->failRow($row, 'sku', "Product SKU [{$data['sku']}] was not found.");
⋮----
$priceList = PriceList::query()->updateOrCreate(
⋮----
['is_active' => $this->booleanValue($row, 'is_active', $data['is_active'], true)],
⋮----
PriceListItem::query()->updateOrCreate(
⋮----
private function importOpeningStock(ImportBatch $batch, ImportRow $row): void
⋮----
$warehouse = Warehouse::query()->where('code', $data['warehouse_code'])->first();
⋮----
$this->failRow($row, 'warehouse_code', "Warehouse [{$data['warehouse_code']}] was not found.");
⋮----
$level = StockLevel::query()
->where('product_id', $product->id)
->where('warehouse_id', $warehouse->id)
->first();
⋮----
$this->failRow($row, 'quantity', "Opening stock cannot be below the reserved quantity ({$reserved}).");
⋮----
$this->stock->purchaseIn(
⋮----
$this->stock->adjust(
⋮----
$mismatches = $this->stock->reconcile($product, $warehouse)
->reject(fn (array $result) => $result['on_hand_matches'] && $result['reserved_matches']);
⋮----
if ($mismatches->isNotEmpty()) {
$this->failRow($row, 'quantity', 'Opening stock did not reconcile against the movement ledger.');
⋮----
/**
     * @param  array<string, mixed>  $rules
     * @return array<string, mixed>
     */
private function validate(ImportRow $row, array $rules): array
⋮----
$validator = Validator::make($row->payload, $rules);
⋮----
if ($validator->fails()) {
throw ImportValidationException::forRow($row->row_number, $validator->errors()->toArray());
⋮----
->mapWithKeys(fn (string $key) => [$key => $validator->validated()[$key] ?? null])
->all();
⋮----
private function resolveCategory(ImportRow $row, ?string $slug, ?string $name): Category
⋮----
$category = Category::query()->where('slug', $slug)->first();
⋮----
$this->failRow($row, 'category_slug', "Category [{$slug}] was not found.");
⋮----
return Category::query()->create(['slug' => $slug, 'name' => $name]);
⋮----
$this->failRow($row, 'category_slug', 'Either category_slug or category_name is required.');
⋮----
return Category::query()->firstOrCreate(
['slug' => Str::slug($name)],
⋮----
private function resolveSupplier(ImportRow $row, ?string $name, ?string $email, ?string $phone): ?Supplier
⋮----
? Supplier::query()->where('email', $email)->first()
: Supplier::query()->where('name', $name)->first();
⋮----
$this->failRow($row, 'supplier_name', 'supplier_name is required when creating a new supplier.');
⋮----
$supplier->fill([
⋮----
$supplier->save();
⋮----
private function booleanValue(ImportRow $row, string $field, mixed $value, bool $default): bool
⋮----
default => $this->failRow($row, $field, 'Expected a boolean value.'),
⋮----
/**
     * @param  array<string, mixed>  $payload
     * @return array<string, mixed>
     */
private function normalizePayload(array $payload): array
⋮----
private function recordFailedRow(ImportRow $row, Throwable $exception): void
⋮----
'error' => $this->formatRowError($exception),
⋮----
private function refreshBatchCounts(ImportBatch $batch, ?ImportStatus $status = null): ImportBatch
⋮----
$query = ImportRow::query()->where('import_batch_id', $batch->id);
⋮----
'total_rows' => (clone $query)->count(),
'success_rows' => (clone $query)->where('status', ImportRowStatus::Imported)->count(),
'failed_rows' => (clone $query)->where('status', ImportRowStatus::Failed)->count(),
⋮----
return $this->imports->updateBatch($batch->fresh(), $attributes);
⋮----
private function formatRowError(Throwable $exception): string
⋮----
$message = collect($exception->errors())
->map(fn (array $messages, string $field) => "{$field}: ".implode(', ', $messages))
->implode('; ');
⋮----
$message = $exception->getMessage();
⋮----
return Str::limit($message ?: 'Import row failed.', 250, '');
⋮----
private function failRow(ImportRow $row, string $field, string $message): never
⋮----
throw ImportValidationException::forRow($row->row_number, [$field => [$message]]);
⋮----
private function flushCatalogCache(ImportEntity $entity): void
⋮----
Cache::tags(['catalog'])->flush();
⋮----
Cache::flush();
````

## File: app/Services/OrderService.php
````php
namespace App\Services;
⋮----
use App\Enums\OrderChannel;
use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Exceptions\InvalidStateTransitionException;
use App\Exceptions\OutOfStockException;
use App\Exceptions\PricingUnavailableException;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
⋮----
/**
 * B2C checkout / payment-confirmation / cancellation state machine:
 *
 *   pending -> reserved -> confirmed -> fulfilled
 *                  \-> cancelled       (payment failed / reservation expired)
 *
 * Every stock mutation goes through StockService (reserve/confirmSale/
 * release) — this class never writes stock_movements or stock_levels
 * itself, per docs/project/canonical-decisions.md §2/§6. Every payment
 * record mutation goes through PaymentService; this class decides what a
 * payment outcome *means* for the order (confirm vs. cancel) but never
 * touches the `payments` table directly either.
 */
class OrderService
⋮----
/**
     * Flat 14% VAT — see docs/project/canonical-decisions.md §1 ("VAT: flat
     * 14% on all taxable lines, not per-category"). Not configurable.
     */
⋮----
/**
     * How long a reservation is held before it's eligible for release by
     * `stock:release-expired-reservations`. Not specified by the PRD at the
     * exact-minutes level, so 30 minutes is an interpretive default —
     * generous enough for COD/placeholder gateways to be settled by staff,
     * short enough that abandoned carts don't lock stock indefinitely.
     */
⋮----
public function __construct(
⋮----
/**
     * Read-only pass-throughs for the Sales/Orders pages — controllers
     * depend on this service, never on the repository directly.
     */
public function listForUser(int $userId, int $perPage = 15): LengthAwarePaginator
⋮----
return $this->orders->paginateForUser($userId, $perPage);
⋮----
public function find(string $id): ?Order
⋮----
return $this->orders->find($id);
⋮----
/**
     * Creates the order, prices and reserves every line, then initiates
     * payment. Requirement #5/#6 of the B2C checkout module: all lines are
     * reserved in one DB transaction, and if any line is unavailable
     * (OutOfStockException) or unpriced (PricingUnavailableException) the
     * whole transaction rolls back — no Order, OrderItem, or stock_movements
     * row is left behind. StockService::reserve() itself also runs inside
     * this same transaction (Laravel nests it as a SAVEPOINT), so a mid-loop
     * failure unwinds every reservation already made in this checkout too.
     *
     * Payment is initiated *after* the reservation transaction commits —
     * a gateway call is an external side effect and doesn't belong inside
     * the reservation DB transaction. FakeGateway then immediately dispatches
     * its simulated verified callback so manual tests can exercise success
     * and failure without a real provider.
     *
     * @param  list<array{product_id: string, quantity: int}>  $lines
     * @param  array<string, mixed>  $paymentOptions
     */
public function checkout(User $user, array $lines, PaymentMethod $method, array $paymentOptions = []): Order
⋮----
$order = DB::transaction(function () use ($user, $lines) {
$order = $this->orders->create([
⋮----
$product = Product::query()->findOrFail($line['product_id']);
⋮----
$priceItem = $this->catalog->retailPriceFor($product->id, $quantity);
⋮----
throw PricingUnavailableException::forProduct($product->id);
⋮----
$warehouse = $this->stock->bestWarehouseFor($product, $quantity);
⋮----
throw OutOfStockException::noWarehouseAvailable($product->id, $quantity);
⋮----
OrderItem::query()->create([
⋮----
// StockService owns every stock mutation — reservation is
// never re-implemented here.
$this->stock->reserve($product, $warehouse, $quantity, $user, $order);
⋮----
return $this->orders->update($order, [
⋮----
'reserved_until' => now()->addMinutes(self::RESERVATION_TTL_MINUTES),
⋮----
$payment = $this->payments->initiate($order, $method, (string) $order->total, $paymentOptions);
⋮----
$payment = $this->payments->simulateFakeGateway($payment, $paymentOptions['outcome'] ?? 'succeed');
⋮----
return $order->fresh(['items', 'payments']);
⋮----
PaymentStatus::Paid => $this->confirmPayment($order->fresh(['items', 'payments']), $user),
PaymentStatus::Failed => $this->cancel($order->fresh(['items', 'payments']), 'Payment failed at checkout.', $user),
default => $order->fresh(['items', 'payments']),
⋮----
/**
     * reserved -> confirmed: converts every line's reservation into a
     * completed sale (StockService::confirmSale()). Called either
     * synchronously from checkout() (Fake gateway success) or later by a
     * staff `payment.settle` action (Cod / Paymob / Fawry placeholder,
     * after PaymentService::settleManually()).
     */
public function confirmPayment(Order $order, ?User $actor = null): Order
⋮----
throw InvalidStateTransitionException::make('Order.status', $order->status->value, OrderStatus::Confirmed->value);
⋮----
return DB::transaction(function () use ($order, $actor) {
foreach ($order->items()->with(['product', 'warehouse'])->get() as $item) {
$this->stock->confirmSale($item->product, $item->warehouse, $item->quantity, $actor, $order);
⋮----
return $this->orders->update($order, ['status' => OrderStatus::Confirmed]);
⋮----
/**
     * pending/reserved -> cancelled: releases every line's reservation
     * (StockService::release()) and marks any still-pending payment
     * failed. Used for checkout-time payment failure, staff-initiated
     * cancellation, and expired unpaid reservations.
     * (releaseExpiredReservations() below).
     */
public function cancel(Order $order, ?string $reason = null, ?User $actor = null): Order
⋮----
throw InvalidStateTransitionException::make('Order.status', $order->status->value, OrderStatus::Cancelled->value);
⋮----
$this->stock->release($item->product, $item->warehouse, $item->quantity, $actor, $order);
⋮----
$payment = $order->payments()->where('status', PaymentStatus::Pending)->latest()->first();
⋮----
$this->payments->markFailed($payment);
⋮----
return $this->orders->update($order, ['status' => OrderStatus::Cancelled]);
⋮----
/**
     * confirmed -> fulfilled: no stock effect (the sale was already
     * recorded at confirmPayment() time) — just the final delivery/pickup
     * status.
     */
public function markFulfilled(Order $order): Order
⋮----
throw InvalidStateTransitionException::make('Order.status', $order->status->value, OrderStatus::Fulfilled->value);
⋮----
return $this->orders->update($order, ['status' => OrderStatus::Fulfilled]);
⋮----
/**
     * Releases every `reserved` order whose `reserved_until` has passed —
     * the counterpart to StockService's "no oversell" guarantee: an
     * abandoned/unpaid checkout can't hold stock hostage forever. Driven by
     * `stock:release-expired-reservations` (see requirement #6 — a
     * scheduled job is allowed to stay a skeleton if not fully wired, but
     * the release logic itself is fully implemented here).
     */
public function releaseExpiredReservations(): int
⋮----
$expired = $this->orders->expiredReservations();
⋮----
$this->cancel($order, 'Reservation expired unpaid.');
⋮----
return $expired->count();
````

## File: app/Services/PaymentService.php
````php
namespace App\Services;
⋮----
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Exceptions\InvalidStateTransitionException;
use App\Exceptions\PaymentVerificationException;
use App\Models\Order;
use App\Models\Payment;
use App\Models\PurchaseOrder;
use App\Models\User;
use App\Payments\BankTransferGateway;
use App\Payments\CodGateway;
use App\Payments\FakeGateway;
use App\Payments\FawryGateway;
use App\Payments\PaymentGateway;
use App\Payments\PaymobGateway;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
⋮----
/**
 * Payment lifecycle and idempotency boundary.
 *
 * Gateways never mutate database state. This service creates payments, verifies
 * callbacks through the gateway drivers, locks the payment row, updates status,
 * and converts the payable reservation to sale_out inside the same transaction.
 */
class PaymentService
⋮----
public function __construct(
⋮----
public function listAll(int $perPage = 15): LengthAwarePaginator
⋮----
return $this->payments->paginateAll($perPage);
⋮----
public function listForViewer(User $user, int $perPage = 15): LengthAwarePaginator
⋮----
if ($businessAccount !== null && ! $user->isAbleTo('payment.settle')) {
return $this->payments->paginateForBusinessAccount($businessAccount->id, $perPage);
⋮----
/**
     * @param  array<string, mixed>  $options
     */
public function initiate(Model $payable, PaymentMethod $method, float|string $amount, array $options = []): Payment
⋮----
$payment = $this->payments->create([
'payable_type' => $payable->getMorphClass(),
'payable_id' => $payable->getKey(),
⋮----
$result = $this->resolveGateway($method)->initiate($payment, $options);
⋮----
return $this->payments->update($payment, $attributes);
⋮----
/**
     * @param  array<string, mixed>  $payload
     * @param  array<string, mixed>  $headers
     */
public function verifyWebhook(PaymentMethod|string $method, array $payload, array $headers = []): Payment
⋮----
$method = $method instanceof PaymentMethod ? $method : PaymentMethod::from($method);
$event = $this->resolveGateway($method)->verifyWebhook($payload, $headers);
⋮----
? $this->confirmVerifiedPaymentEvent($event)
: $this->failVerifiedPaymentEvent($event);
⋮----
public function simulateFakeGateway(Payment $payment, string $outcome = 'succeed'): Payment
⋮----
throw InvalidStateTransitionException::make('Payment.method', $payment->method->value, PaymentMethod::FakeGateway->value);
⋮----
return $this->verifyWebhook(PaymentMethod::FakeGateway, [
⋮----
'x-fake-gateway-signature' => $gateway->signatureFor($gatewayRef, $outcome),
⋮----
public function settleManually(Payment $payment, ?User $actor = null): Payment
⋮----
return $payment->fresh(['payable']);
⋮----
return $this->confirmVerifiedPayment(
⋮----
public function markFailed(Payment $payment): Payment
⋮----
return $this->failVerifiedPayment(
⋮----
/**
     * @param  array{
     *     payment_id?: string|null,
     *     gateway_ref: string,
     *     successful: bool,
     *     meta?: array<string, mixed>
     * }  $event
     */
private function confirmVerifiedPaymentEvent(array $event): Payment
⋮----
$payment = $this->paymentForEvent($event);
⋮----
private function failVerifiedPaymentEvent(array $event): Payment
⋮----
/**
     * @param  array<string, mixed>  $meta
     */
private function confirmVerifiedPayment(Payment $payment, string $gatewayRef, array $meta = [], ?User $actor = null): Payment
⋮----
return DB::transaction(function () use ($payment, $gatewayRef, $meta, $actor) {
$locked = $this->payments->lockForUpdate($payment->id);
⋮----
throw InvalidStateTransitionException::make('Payment.gateway_ref', $locked->gateway_ref, $gatewayRef);
⋮----
return $locked->fresh(['payable']);
⋮----
$locked = $this->payments->update($locked, [
⋮----
'meta' => $this->mergeMeta($locked, $meta),
⋮----
$this->settlePayable($locked->payable()->first(), $actor);
⋮----
// Requirement #2 of the admin/audit module: "payment
// settlement" is an audited event category — recorded once,
// right where status actually transitions to Paid, so it
// covers manual settlement, webhook confirmation, and the
// Fake Gateway simulator uniformly (all three funnel through
// this method) without triple-logging idempotent no-ops.
$this->audit->record('payment.settled', $locked, $actor, [
⋮----
private function failVerifiedPayment(Payment $payment, string $gatewayRef, array $meta = [], bool $releasePayable = true): Payment
⋮----
return DB::transaction(function () use ($payment, $gatewayRef, $meta, $releasePayable) {
⋮----
$this->failPayable($locked->payable()->first());
⋮----
private function paymentForEvent(array $event): Payment
⋮----
$existing = $this->payments->findByGatewayRef($event['gateway_ref']);
⋮----
$payment = $this->payments->find($paymentId);
⋮----
private function settlePayable(?Model $payable, ?User $actor): void
⋮----
app(OrderService::class)->confirmPayment($payable, $actor);
⋮----
app(PurchaseOrderService::class)->settle($payable, $actor);
⋮----
private function failPayable(?Model $payable): void
⋮----
app(OrderService::class)->cancel($payable, 'Payment failed.');
⋮----
/**
     * @param  array<string, mixed>  $meta
     * @return array<string, mixed>
     */
private function mergeMeta(Payment $payment, array $meta): array
⋮----
private function resolveGateway(PaymentMethod $method): PaymentGateway
````

## File: app/Services/PurchaseOrderService.php
````php
namespace App\Services;
⋮----
use App\Enums\ApprovalDecision;
use App\Enums\PurchaseOrderStatus;
use App\Exceptions\CreditLimitExceededException;
use App\Exceptions\InvalidStateTransitionException;
use App\Exceptions\OutOfStockException;
use App\Models\BusinessAccount;
use App\Models\PoApproval;
use App\Models\PoItem;
use App\Models\PurchaseOrder;
use App\Models\Quote;
use App\Models\User;
use App\Repositories\Contracts\BusinessAccountRepositoryInterface;
use App\Repositories\Contracts\PurchaseOrderRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
⋮----
/**
 * B2B Purchase Order state machine: pending_approval -> approved -> fulfilled
 * -> closed; pending_approval -> rejected.
 *
 *   createFromQuote()  (none) -> pending_approval — accepts the source quote
 *       (QuoteService::accept(), atomically — see that class's docblock) and
 *       copies its lines into po_items, picking a fulfillment warehouse per
 *       line (StockService::bestWarehouseFor() — same best-available-stock
 *       heuristic as B2C checkout). Deliberately does NOT reserve stock yet
 *       — that's approve()'s job, per requirement #5/#8 of this module
 *       (creating the PO and reserving stock are distinct steps).
 *
 *   approve()  pending_approval -> approved — checks
 *       outstanding_balance + PO total <= credit_limit (locked, so two
 *       concurrent approvals against the same account can't both pass
 *       against the same stale balance — see BusinessAccountRepository::
 *       lockForUpdate()), then reserves every line via StockService::
 *       reserve() (never re-implemented here), then adds the PO total to
 *       outstanding_balance (the buyer now owes it under net terms).
 *
 *   reject()  pending_approval -> rejected — no stock effect at all.
 *
 *   settle()  approved -> fulfilled — Bank Transfer settlement converts
 *       every line's reservation into a completed sale
 *       (StockService::confirmSale()) and removes the total from
 *       outstanding_balance (the debt is paid).
 *
 *   close()  fulfilled -> closed — final archival step, no stock/credit
 *       effect (goods and payment are already settled).
 *
 * Every stock mutation goes through StockService; every payment record
 * mutation goes through PaymentService (called from the controller, not
 * here — see Web/Procurement/PurchaseOrderController). This class only
 * ever touches `purchase_orders`, `po_items`, `po_approvals`, and
 * `business_accounts.outstanding_balance`.
 */
class PurchaseOrderService
⋮----
public function __construct(
⋮----
public function find(string $id): ?PurchaseOrder
⋮----
return $this->purchaseOrders->find($id);
⋮----
/**
     * Read-only listing: a Business Buyer sees only their own account's
     * POs; staff (`po.approve`/`payment.settle` holders) see every PO.
     */
public function listForViewer(?BusinessAccount $businessAccount, int $perPage = 15): LengthAwarePaginator
⋮----
return $this->purchaseOrders->paginateForBusinessAccount($businessAccount->id, $perPage);
⋮----
return $this->purchaseOrders->paginateAll($perPage);
⋮----
public function createFromQuote(Quote $quote, User $actor): PurchaseOrder
⋮----
return DB::transaction(function () use ($quote) {
// Accepting the quote and creating its PO are atomic together
// — if anything below fails, the quote must not end up
// Accepted with no PO to show for it.
$quote = $this->quotes->accept($quote);
⋮----
$purchaseOrder = $this->purchaseOrders->create([
⋮----
foreach ($quote->items()->with('product')->get() as $quoteItem) {
$warehouse = $this->stock->bestWarehouseFor($quoteItem->product, $quoteItem->quantity);
⋮----
throw OutOfStockException::noWarehouseAvailable($quoteItem->product_id, $quoteItem->quantity);
⋮----
PoItem::query()->create([
⋮----
public function approve(PurchaseOrder $purchaseOrder, User $approver, ?string $note = null): PurchaseOrder
⋮----
throw InvalidStateTransitionException::make(
⋮----
return DB::transaction(function () use ($purchaseOrder, $approver, $note) {
$account = $this->businessAccounts->lockForUpdate($purchaseOrder->business_account_id);
⋮----
throw CreditLimitExceededException::forBusinessAccount(
⋮----
PoApproval::query()->create([
⋮----
foreach ($purchaseOrder->items()->with(['product', 'warehouse'])->get() as $item) {
$this->stock->reserve($item->product, $item->warehouse, $item->quantity, $approver, $purchaseOrder);
⋮----
$this->businessAccounts->update($account, ['outstanding_balance' => $projectedBalance]);
⋮----
$updated = $this->purchaseOrders->update($purchaseOrder, ['status' => PurchaseOrderStatus::Approved]);
⋮----
$this->audit->record('po.approved', $updated, $approver, [
⋮----
public function reject(PurchaseOrder $purchaseOrder, User $approver, ?string $note = null): PurchaseOrder
⋮----
$updated = $this->purchaseOrders->update($purchaseOrder, ['status' => PurchaseOrderStatus::Rejected]);
⋮----
$this->audit->record('po.rejected', $updated, $approver, [
⋮----
/**
     * Bank Transfer settlement: converts every line's reservation into a
     * completed sale and pays down the account's outstanding balance.
     * Called by PurchaseOrderController after PaymentService confirms the
     * transfer — see that controller for the Payment-row side of this.
     */
public function settle(PurchaseOrder $purchaseOrder, ?User $actor = null): PurchaseOrder
⋮----
return DB::transaction(function () use ($purchaseOrder, $actor) {
⋮----
$this->stock->confirmSale($item->product, $item->warehouse, $item->quantity, $actor, $purchaseOrder);
⋮----
// Clamp at zero — defensive against any rounding drift, never negative debt.
⋮----
$this->businessAccounts->update($account, ['outstanding_balance' => $newBalance]);
⋮----
return $this->purchaseOrders->update($purchaseOrder, ['status' => PurchaseOrderStatus::Fulfilled]);
⋮----
/**
     * fulfilled -> closed: final archival step, no stock/credit effect.
     */
public function close(PurchaseOrder $purchaseOrder): PurchaseOrder
⋮----
return $this->purchaseOrders->update($purchaseOrder, ['status' => PurchaseOrderStatus::Closed]);
````

## File: app/Services/QuoteService.php
````php
namespace App\Services;
⋮----
use App\Enums\QuoteStatus;
use App\Enums\UserRole;
use App\Exceptions\InvalidStateTransitionException;
use App\Models\BusinessAccount;
use App\Models\Product;
use App\Models\Quote;
use App\Models\QuoteItem;
use App\Models\User;
use App\Repositories\Contracts\QuoteRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
⋮----
/**
 * B2B RFQ state machine: draft -> sent -> accepted | rejected | expired.
 *
 *   request()  draft   — Business Buyer submits desired products/quantities,
 *                         no prices yet (quote_items.unit_price defaults to
 *                         0.00 until priced).
 *   price()    draft -> sent — Vendor/Inventory Manager sets a unit_price
 *                         per line and the quote is sent with an expiry.
 *   accept()   sent -> accepted — Business Buyer accepts (guarded against
 *                         expiry). Never called directly by a controller —
 *                         PurchaseOrderService::createFromQuote() calls it
 *                         inside its own transaction, so "accept the quote"
 *                         and "create the PO" either both happen or neither
 *                         does. See docs/project/canonical-decisions.md §2.
 *   reject()   sent -> rejected — Business Buyer declines.
 *
 * This class never touches stock or purchase_orders — that's
 * PurchaseOrderService's job (see its class docblock for the full
 * accept -> PO -> approve -> reserve -> settle chain).
 */
class QuoteService
⋮----
/**
     * How long a sent quote stays valid before it's no longer acceptable.
     * Not specified at the exact-days level by the PRD, so 14 days is an
     * interpretive default — long enough for a buyer to review, short
     * enough that stale B2B pricing doesn't linger indefinitely.
     */
⋮----
public function __construct(
⋮----
public function find(string $id): ?Quote
⋮----
return $this->quotes->find($id);
⋮----
/**
     * Read-only listing for whichever role is viewing: a Business Buyer
     * sees only their own account's quotes; a Vendor sees only quotes
     * containing a product they supply ("own pricing context"); staff
     * (Inventory Manager/SuperAdmin, `quote.price`/`po.approve` holders)
     * see every quote.
     */
public function listForViewer(User $user, ?BusinessAccount $businessAccount, int $perPage = 15): LengthAwarePaginator
⋮----
return $this->quotes->paginateForBusinessAccount($businessAccount->id, $perPage);
⋮----
if ($user->hasRole(UserRole::VendorSupplier->value)) {
return $this->quotes->paginateForVendor($user->id, $perPage);
⋮----
return $this->quotes->paginateAll($perPage);
⋮----
/**
     * @param  list<array{product_id: string, quantity: int}>  $lines
     */
public function request(BusinessAccount $businessAccount, array $lines): Quote
⋮----
return DB::transaction(function () use ($businessAccount, $lines) {
$quote = $this->quotes->create([
⋮----
$product = Product::query()->findOrFail($line['product_id']);
⋮----
QuoteItem::query()->create([
⋮----
// Not priced yet — set by price() below.
⋮----
/**
     * draft -> sent: sets a unit_price per line and starts the clock on
     * the quote's validity window.
     *
     * @param  array<string, string>  $unitPricesByItemId  quote_item_id => unit_price
     */
public function price(Quote $quote, array $unitPricesByItemId): Quote
⋮----
throw InvalidStateTransitionException::make('Quote.status', $quote->status->value, QuoteStatus::Sent->value);
⋮----
return DB::transaction(function () use ($quote, $unitPricesByItemId) {
$items = $quote->items()->get();
⋮----
$item->update(['unit_price' => $unitPrice]);
⋮----
return $this->quotes->update($quote, [
⋮----
'expires_at' => now()->addDays(self::VALIDITY_DAYS)->toDateString(),
⋮----
/**
     * sent -> accepted. Not exposed on a route directly — see the class
     * docblock; PurchaseOrderService::createFromQuote() is the only caller,
     * so acceptance and PO creation are always atomic together.
     */
public function accept(Quote $quote): Quote
⋮----
throw InvalidStateTransitionException::make('Quote.status', $quote->status->value, QuoteStatus::Accepted->value);
⋮----
if ($this->isExpired($quote)) {
throw InvalidStateTransitionException::make('Quote.status', $quote->status->value, QuoteStatus::Expired->value);
⋮----
return $this->quotes->update($quote, ['status' => QuoteStatus::Accepted]);
⋮----
/**
     * sent -> rejected.
     */
public function reject(Quote $quote): Quote
⋮----
throw InvalidStateTransitionException::make('Quote.status', $quote->status->value, QuoteStatus::Rejected->value);
⋮----
return $this->quotes->update($quote, ['status' => QuoteStatus::Rejected]);
⋮----
public function isExpired(Quote $quote): bool
⋮----
return $quote->expires_at !== null && $quote->expires_at->isPast();
⋮----
/**
     * Suggested starting price for a quote line, from the active B2B tier
     * price list — the Vendor/Inventory Manager pricing the quote can
     * still submit any unit_price they choose (see price() above).
     */
public function suggestedTierPrice(string $productId, int $quantity): ?string
⋮----
$item = $this->catalog->tierPriceFor($productId, $quantity);
````

## File: app/Services/ReportService.php
````php
namespace App\Services;
⋮----
use App\Repositories\Contracts\ImportRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use App\Repositories\Contracts\StockRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
⋮----
/**
 * Read-only reporting layer (modules 5–9): low stock, stock movements,
 * sales, payments, and import history. Every method is a thin
 * pass-through to a repository query that already applies the relevant
 * filters and pagination — this class exists so Controllers depend on a
 * Service, never a Repository directly, per
 * docs/project/canonical-decisions.md §2, matching every other module in
 * this codebase. No report method mutates anything.
 */
class ReportService
⋮----
/**
     * Default "low stock" cutoff when the caller doesn't specify one —
     * not defined at a specific unit count anywhere in the PRD, so this is
     * an interpretive default (available <= 10 units, regardless of the
     * product/warehouse's normal turnover). Callers filtering the report
     * can pass a different threshold.
     */
⋮----
public function __construct(
⋮----
/**
     * @param  array<string, mixed>  $filters
     */
public function lowStock(int $perPage = 15, ?int $threshold = null, array $filters = []): LengthAwarePaginator
⋮----
return $this->stock->paginateLowStockLevels($threshold ?? self::DEFAULT_LOW_STOCK_THRESHOLD, $perPage, $filters);
⋮----
public function stockMovements(int $perPage = 15, array $filters = []): LengthAwarePaginator
⋮----
return $this->stock->paginateMovements($perPage, $filters);
⋮----
public function sales(int $perPage = 15, array $filters = []): LengthAwarePaginator
⋮----
return $this->orders->paginateForSalesReport($perPage, $filters);
⋮----
public function payments(int $perPage = 15, array $filters = []): LengthAwarePaginator
⋮----
return $this->payments->paginateForReport($perPage, $filters);
⋮----
public function imports(int $perPage = 15, array $filters = []): LengthAwarePaginator
⋮----
return $this->imports->paginateForReport($perPage, $filters);
````

## File: app/Services/RoleAssignmentService.php
````php
namespace App\Services;
⋮----
use App\Models\User;
⋮----
/**
 * @see docs/project/canonical-decisions.md §3 — Laratrust roles/permissions,
 *      cached and invalidated on role/permission change.
 */
class RoleAssignmentService
⋮----
public function __construct(private readonly AuditService $audit) {}
⋮----
/**
     * Replace a user's role assignments with exactly the given set.
     *
     * Laratrust flushes that user's permission cache as part of syncRoles(),
     * so a stale role/permission list is never served after this call.
     *
     * @param  list<string>  $roleNames
     */
public function syncRoles(User $user, array $roleNames, ?User $actor = null): User
⋮----
$before = $user->roles()->pluck('name')->all();
⋮----
$user->syncRoles($roleNames);
⋮----
// Requirement #2 of the admin/audit module: user/role changes are
// an audited event category.
$this->audit->record('user.roles_updated', $user, $actor, [
⋮----
return $user->fresh();
````

## File: app/Services/RolePermissionService.php
````php
namespace App\Services;
⋮----
use App\Models\Role;
use App\Models\User;
⋮----
/**
 * Role/permission management improvements (module 4): lets a `role.manage`
 * holder edit a role's own permission set, not just which roles a user
 * has (RoleAssignmentService). Role::syncPermissions() already flushes
 * Laratrust's permission cache for every user holding that role, so no
 * separate cache-invalidation step is needed here.
 */
class RolePermissionService
⋮----
public function __construct(private readonly AuditService $audit) {}
⋮----
/**
     * @param  list<string>  $permissionNames
     */
public function syncPermissions(Role $role, array $permissionNames, ?User $actor = null): Role
⋮----
$before = $role->permissions()->pluck('name')->all();
⋮----
$role->syncPermissions($permissionNames);
⋮----
// Requirement #2 of the admin/audit module: permission changes are
// an audited event category, distinct from user/role changes.
$this->audit->record('role.permissions_updated', $role, $actor, [
⋮----
return $role->fresh('permissions');
````

## File: app/Services/StockAvailabilityService.php
````php
namespace App\Services;
⋮----
use App\Repositories\Contracts\StockRepositoryInterface;
⋮----
/**
 * Translates raw stock numbers into the public-safe vocabulary the
 * storefront is allowed to show a guest: a status/label, never an exact
 * quantity (see docs/project/canonical-decisions.md and the storefront
 * requirement "do not expose exact stock quantity to guests"). Reads are
 * deliberately live/uncached — see StockRepositoryInterface::
 * availabilityForProduct()'s docblock.
 */
class StockAvailabilityService
⋮----
/**
     * Matches ReportService::DEFAULT_LOW_STOCK_THRESHOLD so the public
     * "Low Stock" badge and the staff Low Stock report agree on what
     * "low" means.
     */
⋮----
public function __construct(private readonly StockRepositoryInterface $stock) {}
⋮----
public function totalAvailableFor(string $productId): int
⋮----
return $this->stock->availabilityForProduct($productId);
⋮----
/**
     * @param  list<string>  $productIds
     * @return array<string, int>
     */
public function totalAvailableForMany(array $productIds): array
⋮----
return $this->stock->availabilityForProducts($productIds);
⋮----
public function statusFor(int $available): string
⋮----
public function labelFor(string $status): string
````

## File: app/Services/StockService.php
````php
namespace App\Services;
⋮----
use App\Enums\MovementType;
use App\Exceptions\InvalidStateTransitionException;
use App\Exceptions\OutOfStockException;
use App\Models\Product;
use App\Models\StockLevel;
use App\Models\StockMovement;
use App\Models\User;
use App\Models\Warehouse;
use App\Repositories\Contracts\StockRepositoryInterface;
use App\Repositories\Contracts\WarehouseRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
⋮----
/**
 * The stock engine — the only place stock_movements/stock_levels are ever
 * written. See docs/project/canonical-decisions.md §6.
 *
 * Every mutation:
 *   1. runs inside DB::transaction() (this class owns the transaction
 *      boundary — repositories never open their own, controllers never
 *      touch stock directly);
 *   2. locks the affected stock_levels row(s) via lockForUpdate()
 *      (transfer() locks both rows, in a deterministic warehouse-id order,
 *      so two opposite-direction concurrent transfers between the same
 *      pair of warehouses can never deadlock each other);
 *   3. appends exactly one immutable stock_movements row (transfer()
 *      appends two: a paired transfer_out + transfer_in);
 *   4. updates the stock_levels projection to match.
 *
 * Ledger sign convention — `stock_movements.quantity` is signed relative to
 * on_hand for the types that affect on_hand, and relative to `reserved` for
 * the types that affect reserved:
 *   - purchase_in:    +qty on_hand
 *   - transfer_in:    +qty on_hand
 *   - transfer_out:   -qty on_hand
 *   - adjustment:     ±qty on_hand (caller-supplied signed delta)
 *   - reservation:    +qty reserved (on_hand untouched)
 *   - release:        -qty reserved (on_hand untouched)
 *   - sale_out:       -qty on_hand AND -qty reserved — a single ledger row
 *     represents converting an existing reservation into a completed sale;
 *     no separate `release` row is written for it.
 *
 * This lets reconcile() prove two independent invariants from the same
 * ledger: on_hand == SUM(quantity) over the on-hand-affecting types, and
 * reserved == SUM(quantity) over the reserved-affecting types. See
 * StockRepository::ledgerTotals().
 */
class StockService
⋮----
/**
     * Tag for the *display-only* `listLevels()` cache (the Stock/Levels
     * report page). Deliberately narrow: nothing else in this class is
     * ever cached — `findLevel()`/`lockLevelForUpdate()`/
     * `lockOrCreateLevel()`/`bestWarehouseFor()`'s underlying query, and
     * `reconcile()`'s `allLevels()`/`ledgerTotals()`, all stay live,
     * uncached reads because they feed either a locked mutation decision
     * or a correctness proof — caching either would risk exactly the kind
     * of stale-oversell or false-reconciliation bug the whole ledger
     * design exists to prevent. See docs/technical/cache.md
     * §"Stock levels — cached carefully".
     */
⋮----
/**
     * Short TTL — flush-on-write (every recordMovement() call) is the
     * primary invalidation mechanism; this is just a backstop in case a
     * future write path is ever added that forgets to go through
     * recordMovement().
     */
⋮----
public function __construct(
⋮----
/**
     * Read-only pass-through for the Stock/Levels index page — controllers
     * depend on this service, never the repository directly, per
     * docs/project/canonical-decisions.md §2. Cached (see CACHE_TAG above)
     * and flushed on every stock movement via recordMovement().
     *
     * @param  array<string, mixed>  $filters
     */
public function listLevels(int $perPage, array $filters = []): LengthAwarePaginator
⋮----
$page = Paginator::resolveCurrentPage() ?: 1;
⋮----
return Cache::tags([self::CACHE_TAG])->remember(
⋮----
fn () => $this->stock->paginateLevels($perPage, $filters)
⋮----
/**
     * @param  array<string, mixed>  $filters
     */
public function listMovements(int $perPage, array $filters = []): LengthAwarePaginator
⋮----
return $this->stock->paginateMovements($perPage, $filters);
⋮----
/**
     * @return Collection<int, Warehouse>
     */
public function listActiveWarehouses(): Collection
⋮----
return $this->warehouses->active();
⋮----
/**
     * Picks a fulfillment warehouse for a B2C order line: the active
     * warehouse with the most available (on_hand - reserved) stock for this
     * product, as long as it can cover the full requested quantity. Read
     * -only placement heuristic, not a stock mutation — the caller (
     * OrderService) still must reserve the chosen warehouse's row through
     * reserve() below, which does the real lockForUpdate() check. Returns
     * null if no single warehouse can fulfill the full quantity.
     */
public function bestWarehouseFor(Product $product, int $quantity): ?Warehouse
⋮----
->levelsForProductOrderedByAvailability($product->id)
->first(fn (StockLevel $level) => $level->available >= $quantity)
⋮----
public function purchaseIn(
⋮----
$this->assertPositive($quantity);
⋮----
return DB::transaction(function () use ($product, $warehouse, $quantity, $actor, $reference, $reason) {
$level = $this->stock->lockOrCreateLevel($product->id, $warehouse->id);
⋮----
$this->recordMovement(MovementType::PurchaseIn, $product, $warehouse, $quantity, $actor, $reference, $reason);
⋮----
return $this->stock->updateLevel($level, [
⋮----
public function reserve(
⋮----
return DB::transaction(function () use ($product, $warehouse, $quantity, $actor, $reference) {
⋮----
throw OutOfStockException::forProduct($product->id, $warehouse->id, $quantity, $available);
⋮----
$this->recordMovement(MovementType::Reservation, $product, $warehouse, $quantity, $actor, $reference);
⋮----
public function release(
⋮----
throw InvalidStateTransitionException::make(
⋮----
$this->recordMovement(MovementType::Release, $product, $warehouse, -$quantity, $actor, $reference);
⋮----
public function confirmSale(
⋮----
// Defensive: reserve() never lets reserved exceed on_hand, so
// this should be unreachable in practice. Guards rule #9 (no
// negative stock) against any future ledger drift.
⋮----
throw OutOfStockException::forProduct($product->id, $warehouse->id, $quantity, $level->on_hand);
⋮----
$this->recordMovement(MovementType::SaleOut, $product, $warehouse, -$quantity, $actor, $reference);
⋮----
/**
     * Paired transfer_out (source) / transfer_in (destination) in one
     * atomic transaction — either both commit or neither does.
     *
     * @return array{from: StockLevel, to: StockLevel}
     */
public function transfer(
⋮----
return DB::transaction(function () use ($product, $fromWarehouse, $toWarehouse, $quantity, $actor, $reference) {
// Lock both rows in a deterministic (sorted warehouse id) order
// regardless of transfer direction, so a concurrent transfer of
// the same product the *other* way between these two
// warehouses always acquires locks in the same order and can't
// deadlock against this one.
$lockOrder = collect([$fromWarehouse->id, $toWarehouse->id])->sort()->values();
⋮----
$levels = $lockOrder->mapWithKeys(
fn (string $warehouseId) => [$warehouseId => $this->stock->lockOrCreateLevel($product->id, $warehouseId)]
⋮----
// Capped by *available* (on_hand - reserved), not just on_hand:
// moving already-reserved stock out from under a pending
// reservation at the source warehouse would oversell it.
⋮----
throw OutOfStockException::forProduct($product->id, $fromWarehouse->id, $quantity, $available);
⋮----
$this->recordMovement(MovementType::TransferOut, $product, $fromWarehouse, -$quantity, $actor, $reference);
$sourceLevel = $this->stock->updateLevel($sourceLevel, [
⋮----
$this->recordMovement(MovementType::TransferIn, $product, $toWarehouse, $quantity, $actor, $reference);
$destLevel = $this->stock->updateLevel($destLevel, [
⋮----
public function adjust(
⋮----
return DB::transaction(function () use ($product, $warehouse, $signedQuantity, $actor, $reason) {
⋮----
throw OutOfStockException::forProduct($product->id, $warehouse->id, abs($signedQuantity), $level->on_hand);
⋮----
$this->recordMovement(MovementType::Adjustment, $product, $warehouse, $signedQuantity, $actor, null, $reason);
⋮----
$updated = $this->stock->updateLevel($level, ['on_hand' => $newOnHand]);
⋮----
// Requirement #2 of the admin/audit module: stock adjustments
// are one of the explicitly audited event categories, on top
// of (not instead of) the immutable stock_movements row above.
$this->audit->record('stock.adjusted', $updated, $actor, [
⋮----
/**
     * Read-only: proves (or disproves) that stock_levels matches what the
     * immutable ledger says it should be, per (product, warehouse) pair.
     * No mutation, so no transaction/locking is needed.
     *
     * @return Collection<int, array{
     *     product_id: string, warehouse_id: string,
     *     on_hand: int, ledger_on_hand: int, on_hand_matches: bool,
     *     reserved: int, ledger_reserved: int, reserved_matches: bool,
     * }>
     */
public function reconcile(?Product $product = null, ?Warehouse $warehouse = null): Collection
⋮----
$levels = $this->stock->allLevels($productId, $warehouseId)
->keyBy(fn (StockLevel $level) => "{$level->product_id}:{$level->warehouse_id}");
⋮----
$ledgerTotals = $this->stock->ledgerTotals($productId, $warehouseId)
->keyBy(fn ($row) => "{$row->product_id}:{$row->warehouse_id}");
⋮----
return $levels->keys()
->merge($ledgerTotals->keys())
->unique()
->map(function (string $key) use ($levels, $ledgerTotals) {
⋮----
$level = $levels->get($key);
$ledger = $ledgerTotals->get($key);
⋮----
->values();
⋮----
private function recordMovement(
⋮----
$movement = $this->stock->createMovement([
⋮----
// Every mutation appends exactly one (or, for transfer(), two)
// movement row through this single method, so flushing here — not
// scattered across each of purchaseIn/reserve/release/confirmSale/
// transfer/adjust — guarantees listLevels()'s cache can never
// outlive the write that invalidates it.
Cache::tags([self::CACHE_TAG])->flush();
⋮----
private function assertPositive(int $quantity): void
````

## File: app/Services/StorefrontCatalogService.php
````php
namespace App\Services;
⋮----
use App\Models\Category;
use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
⋮----
/**
 * Public-storefront reads: active products/categories only, and product
 * payloads shaped for a guest (price + stock badge, never an exact
 * quantity). Deliberately a separate service from CatalogService rather
 * than adding an `is_active` filter flag everywhere in it — CatalogService
 * is the admin/CRUD surface (sees inactive products on purpose, for
 * reactivating them), this is the public-visibility surface, and keeping
 * them apart means a future admin-only field can never leak here by
 * accident. Categories and retail pricing are read straight from
 * CatalogService though, since those are already cached under the same
 * 'catalog' tag and don't need an is_active filter (categories have no
 * such column; retailPriceFor() only returns a price for lines that will
 * actually be sellable).
 */
class StorefrontCatalogService
⋮----
public function __construct(
⋮----
/**
     * @param  array<string, mixed>  $filters
     */
public function listActiveProducts(int $perPage, array $filters = []): LengthAwarePaginator
⋮----
$page = Paginator::resolveCurrentPage() ?: 1;
⋮----
return Cache::tags([self::CACHE_TAG])->remember(
⋮----
fn () => $this->products->publicPaginatedList($perPage, $filters)
⋮----
public function findActiveProductBySku(string $sku): ?Product
⋮----
// Not cached individually — a single indexed row lookup is cheap,
// and per-SKU cache keys would need their own invalidation on top
// of the tag flush. Matches CatalogService::findProduct() also
// being a live read.
return $this->products->findActiveBySku($sku);
⋮----
/**
     * @return Collection<int, Category>
     */
public function publicCategories(): Collection
⋮----
return $this->catalog->listCategories();
⋮----
/**
     * Reshape a paginator of Products into public-safe payloads, batching
     * the stock-availability lookup for every item on the page into one
     * query instead of N.
     */
public function presentPaginated(LengthAwarePaginator $paginator): LengthAwarePaginator
⋮----
$availability = $this->availability->totalAvailableForMany(
collect($paginator->items())->pluck('id')->all()
⋮----
return $paginator->through(
fn (Product $product) => $this->presentProduct($product, $availability[$product->id] ?? 0)
⋮----
/**
     * @return array<string, mixed>
     */
public function presentProduct(Product $product, ?int $available = null): array
⋮----
$priceItem = $this->catalog->retailPriceFor($product->id, 1);
$available ??= $this->availability->totalAvailableFor($product->id);
$status = $this->availability->statusFor($available);
⋮----
'category' => $product->relationLoaded('category') && $product->category !== null
⋮----
'stock_label' => $this->availability->labelFor($status),
````

## File: app/Support/WarehouseAccess.php
````php
namespace App\Support;
⋮----
use App\Enums\PermissionName;
use App\Enums\UserRole;
use App\Models\User;
use App\Models\Warehouse;
⋮----
/**
 * Shared warehouse-scoping check used by both StockPolicy (record-level,
 * called from controllers) and WarehouseScopeMiddleware (route-level,
 * defense-in-depth) — see docs/project/canonical-decisions.md §3.
 *
 * SuperAdmin has full access to every warehouse regardless of team
 * assignment (Enterprise PRD §3 permission matrix: stock.move/stock.transfer
 * are "✓" for SuperAdmin, "team" for Inventory Manager only). Everyone else
 * needs the base Laratrust permission AND a role assignment scoped to the
 * warehouse's team (role_user.team_id) — see Warehouse::booted() for how
 * each warehouse gets its team.
 */
final class WarehouseAccess
⋮----
public static function allows(?User $user, ?Warehouse $warehouse, PermissionName $permission): bool
⋮----
if (! $user->isAbleTo($permission->value)) {
⋮----
if ($user->hasRole(UserRole::SuperAdmin->value)) {
⋮----
return $team !== null && $user->isAbleTo($permission->value, $team);
````

## File: bootstrap/app.php
````php
use App\Exceptions\DomainException;
use App\Exceptions\PaymentVerificationException;
use App\Exceptions\UnauthorizedWarehouseException;
use App\Http\Middleware\AuthenticateApiClientCredentials;
use App\Http\Middleware\EnsureApiRequestsJson;
use App\Http\Middleware\EnsureCheckoutIsAuthenticated;
use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Middleware\SecurityHeaders;
use App\Http\Middleware\WarehouseScopeMiddleware;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Auth\Middleware\AuthenticatesRequests;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Passport\Http\Middleware\CheckToken;
use Laravel\Passport\Http\Middleware\CheckTokenForAnyScope;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
⋮----
return Application::configure(basePath: dirname(__DIR__))
->withRouting(
⋮----
Route::middleware(['api', 'throttle:webhook'])
->prefix('webhooks/v1')
->group(base_path('routes/webhooks.php'));
⋮----
->withMiddleware(function (Middleware $middleware): void {
// Global (web + api + webhooks): every response gets these,
// including 4xx/5xx error pages and API JSON responses.
$middleware->append(SecurityHeaders::class);
⋮----
$middleware->web(append: [
⋮----
$middleware->alias([
⋮----
$middleware->prependToPriorityList(
⋮----
->withExceptions(function (Exceptions $exceptions): void {
$exceptions->shouldRenderJsonWhen(
fn (Request $request) => $request->is('api/*') || $request->is('webhooks/*'),
⋮----
$exceptions->render(function (AuthorizationException $e, Request $request) {
if ($request->is('api/*')) {
⋮----
return Inertia::render('Errors/Forbidden')
->toResponse($request)
->setStatusCode(403);
⋮----
$exceptions->render(function (UnauthorizedWarehouseException $e, Request $request) {
⋮----
$exceptions->render(function (PaymentVerificationException $e, Request $request) {
if ($request->is('api/*') || $request->is('webhooks/*')) {
return response()->json([
'message' => $e->getMessage(),
'context' => $e->context(),
⋮----
return back()->with('flash.error', $e->getMessage());
⋮----
// Generic fallback for any other domain-rule failure (OutOfStock,
// PricingUnavailable, InvalidStateTransition, ...) — registered
// after the more specific UnauthorizedWarehouseException handler
// above, which still wins for that subtype. Redirects back with a
// flash error rather than a 500 page, so e.g. checkout failing
// because a line went out of stock mid-request reads as "cleanly
// rejected", not "server broke" — see requirement #6 of the B2C
// checkout module.
$exceptions->render(function (DomainException $e, Request $request) {
⋮----
$exceptions->render(function (NotFoundHttpException $e, Request $request) {
⋮----
return Inertia::render('Errors/NotFound')
⋮----
->setStatusCode(404);
⋮----
})->create();
````

## File: bootstrap/providers.php
````php
use App\Providers\AppServiceProvider;
use App\Providers\HorizonServiceProvider;
use App\Providers\RepositoryServiceProvider;
````

## File: config/app.php
````php
/*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application, which will be used when the
    | framework needs to place the application's name in a notification or
    | other UI elements where an application name needs to be displayed.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | the application so that it's available within Artisan commands.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. The timezone
    | is set to "UTC" by default as it is suitable for most use cases.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by Laravel's translation / localization methods. This option can be
    | set to any locale for which you plan to have translation strings.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is utilized by Laravel's encryption services and should be set
    | to a random, 32 character string to ensure that all encrypted values
    | are secure. You should do this prior to deploying the application.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Maintenance Mode Driver
    |--------------------------------------------------------------------------
    |
    | These configuration options determine the driver used to determine and
    | manage Laravel's "maintenance mode" status. The "cache" driver will
    | allow maintenance mode to be controlled across multiple machines.
    |
    | Supported drivers: "file", "cache"
    |
    */
````

## File: config/auth.php
````php
use App\Models\User;
⋮----
/*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option defines the default authentication "guard" and password
    | reset "broker" for your application. You may change these values
    | as required, but they're a perfect start for most applications.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | which utilizes session storage plus the Eloquent user provider.
    |
    | All authentication guards have a user provider, which defines how the
    | users are actually retrieved out of your database or other storage
    | system used by the application. Typically, Eloquent is utilized.
    |
    | Supported: "session"
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication guards have a user provider, which defines how the
    | users are actually retrieved out of your database or other storage
    | system used by the application. Typically, Eloquent is utilized.
    |
    | If you have multiple user tables or models you may configure multiple
    | providers to represent the model / table. These providers may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */
⋮----
// 'users' => [
//     'driver' => 'database',
//     'table' => 'users',
// ],
⋮----
/*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | These configuration options specify the behavior of Laravel's password
    | reset functionality, including the table utilized for token storage
    | and the user provider that is invoked to actually retrieve users.
    |
    | The expiry time is the number of minutes that each reset token will be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    | The throttle setting is the number of seconds a user must wait before
    | generating more password reset tokens. This prevents the user from
    | quickly generating a very large amount of password reset tokens.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define the number of seconds before a password confirmation
    | window expires and users are asked to re-enter their password via the
    | confirmation screen. By default, the timeout lasts for three hours.
    |
    */
````

## File: config/cache.php
````php
use Illuminate\Support\Str;
⋮----
/*
    |--------------------------------------------------------------------------
    | Default Cache Store
    |--------------------------------------------------------------------------
    |
    | This option controls the default cache store that will be used by the
    | framework. This connection is utilized if another isn't explicitly
    | specified when running a cache operation inside the application.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Cache Stores
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the cache "stores" for your application as
    | well as their drivers. You may even define multiple stores for the
    | same cache driver to group types of items stored in your caches.
    |
    | Supported drivers: "array", "database", "file", "memcached",
    |                    "redis", "dynamodb", "storage", "octane",
    |                    "session", "failover", "null"
    |
    */
⋮----
// Memcached::OPT_CONNECT_TIMEOUT => 2000,
⋮----
/*
    |--------------------------------------------------------------------------
    | Cache Key Prefix
    |--------------------------------------------------------------------------
    |
    | When utilizing the APC, database, memcached, Redis, and DynamoDB cache
    | stores, there might be other applications using the same cache. For
    | that reason, you may prefix every cache key to avoid collisions.
    |
    */
⋮----
'prefix' => env('CACHE_PREFIX', Str::slug((string) env('APP_NAME', 'laravel')).'-cache-'),
⋮----
/*
    |--------------------------------------------------------------------------
    | Serializable Classes
    |--------------------------------------------------------------------------
    |
    | This value determines the classes that can be unserialized from cache
    | storage. By default, no PHP classes will be unserialized from your
    | cache to prevent gadget chain attacks if your APP_KEY is leaked.
    |
    | Set to true here: CatalogService (see docs/project/canonical-decisions.md
    | §11, "catalog reads cached in Redis") deliberately caches Eloquent
    | Collections/Paginators, not just primitives. Every cached value
    | originates from a trusted server-side query, never from user input,
    | so the gadget-chain risk this setting guards against doesn't apply
    | to our cache writes.
    */
````

## File: config/database.php
````php
use Illuminate\Support\Str;
use Pdo\Mysql;
⋮----
/*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for database operations. This is
    | the connection which will be utilized unless another connection
    | is explicitly specified when you execute a query / statement.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Below are all of the database connections defined for your application.
    | An example configuration is provided for each database system which
    | is supported by Laravel. You're free to add / remove connections.
    |
    */
⋮----
// 'encrypt' => env('DB_ENCRYPT', 'yes'),
// 'trust_server_certificate' => env('DB_TRUST_SERVER_CERTIFICATE', 'false'),
⋮----
/*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run on the database.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer body of commands than a typical key-value system
    | such as Memcached. You may define your connection settings here.
    |
    */
⋮----
'prefix' => env('REDIS_PREFIX', Str::slug((string) env('APP_NAME', 'laravel')).'-database-'),
````

## File: config/filesystems.php
````php
/*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application for file storage.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Below you may configure as many filesystem disks as necessary, and you
    | may even configure multiple disks for the same driver. Examples for
    | most supported storage drivers are configured here for reference.
    |
    | Supported drivers: "local", "ftp", "sftp", "s3"
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */
````

## File: config/horizon.php
````php
use Illuminate\Support\Str;
⋮----
/*
    |--------------------------------------------------------------------------
    | Horizon Name
    |--------------------------------------------------------------------------
    |
    | This name appears in notifications and in the Horizon UI. Unique names
    | can be useful while running multiple instances of Horizon within an
    | application, allowing you to identify the Horizon you're viewing.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Horizon Domain
    |--------------------------------------------------------------------------
    |
    | This is the subdomain where Horizon will be accessible from. If this
    | setting is null, Horizon will reside under the same domain as the
    | application. Otherwise, this value will serve as the subdomain.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Horizon Path
    |--------------------------------------------------------------------------
    |
    | This is the URI path where Horizon will be accessible from. Feel free
    | to change this path to anything you like. Note that the URI will not
    | affect the paths of its internal API that aren't exposed to users.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Horizon Redis Connection
    |--------------------------------------------------------------------------
    |
    | This is the name of the Redis connection where Horizon will store the
    | meta information required for it to function. It includes the list
    | of supervisors, failed jobs, job metrics, and other information.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Horizon Redis Prefix
    |--------------------------------------------------------------------------
    |
    | This prefix will be used when storing all Horizon data in Redis. You
    | may modify the prefix when you are running multiple installations
    | of Horizon on the same server so that they don't have problems.
    |
    */
⋮----
Str::slug(env('APP_NAME', 'laravel'), '_').'_horizon:'
⋮----
/*
    |--------------------------------------------------------------------------
    | Horizon Route Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware will get attached onto each Horizon route, giving you
    | the chance to add your own middleware to this list or change any of
    | the existing middleware. Or, you can simply stick with this list.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Queue Wait Time Thresholds
    |--------------------------------------------------------------------------
    |
    | This option allows you to configure when the LongWaitDetected event
    | will be fired. Every connection / queue combination may have its
    | own, unique threshold (in seconds) before this event is fired.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Job Trimming Times
    |--------------------------------------------------------------------------
    |
    | Here you can configure for how long (in minutes) you desire Horizon to
    | persist the recent and failed jobs. Typically, recent jobs are kept
    | for one hour while all failed jobs are stored for an entire week.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Silenced Jobs
    |--------------------------------------------------------------------------
    |
    | Silencing a job will instruct Horizon to not place the job in the list
    | of completed jobs within the Horizon dashboard. This setting may be
    | used to fully remove any noisy jobs from the completed jobs list.
    |
    */
⋮----
// App\Jobs\ExampleJob::class,
⋮----
// 'notifications',
⋮----
/*
    |--------------------------------------------------------------------------
    | Metrics
    |--------------------------------------------------------------------------
    |
    | Here you can configure how many snapshots should be kept to display in
    | the metrics graph. This will get used in combination with Horizon's
    | `horizon:snapshot` schedule to define how long to retain metrics.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Fast Termination
    |--------------------------------------------------------------------------
    |
    | When this option is enabled, Horizon's "terminate" command will not
    | wait on all of the workers to terminate unless the --wait option
    | is provided. Fast termination can shorten deployment delay by
    | allowing a new instance of Horizon to start while the last
    | instance will continue to terminate each of its workers.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Memory Limit (MB)
    |--------------------------------------------------------------------------
    |
    | This value describes the maximum amount of memory the Horizon master
    | supervisor may consume before it is terminated and restarted. For
    | configuring these limits on your workers, see the next section.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Queue Worker Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may define the queue worker settings used by your application
    | in all environments. These supervisors and settings handle all your
    | queued jobs and will be provisioned by Horizon during deployment.
    |
    */
⋮----
// Matches the retry/backoff behaviour the previous plain
// `queue:work redis --tries=3 --backoff=3` process gave every
// job (ImportCatalogJob declares no $tries/$backoff of its
// own, so it depended entirely on these worker-level flags).
⋮----
/*
    |--------------------------------------------------------------------------
    | File Watcher Configuration
    |--------------------------------------------------------------------------
    |
    | The following list of directories and files will be watched when using
    | the `horizon:listen` command. Whenever any directories or files are
    | changed, Horizon will automatically restart to apply all changes.
    |
    */
````

## File: config/laratrust_seeder.php
````php
/**
     * Control if the seeder should create a user per role while seeding the data.
     */
⋮----
/**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
````

## File: config/laratrust.php
````php
use App\Models\Permission;
use App\Models\Role;
use App\Models\Team;
use App\Models\User;
⋮----
/*
    |--------------------------------------------------------------------------
    | Use MorphMap in relationships between models
    |--------------------------------------------------------------------------
    |
    | If true, the morphMap feature is going to be used. The array values that
    | are going to be used are the ones inside the 'user_models' array.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Checkers
    |--------------------------------------------------------------------------
    |
    | Manage Laratrust's role and permissions checkers configurations.
    |
    */
⋮----
/*
        |--------------------------------------------------------------------------
        | Which permissions checker to use.
        |--------------------------------------------------------------------------
        |
        | Defines if you want to use the roles and permissions checker.
        | Available:
        | - default: Check for the roles and permissions using the method that Laratrust
        |            has always used.
        | - query: Check for the roles and permissions using direct queries to the database.
        |           This method doesn't support cache yet.
        | - class that extends Laratrust\Checkers\User\UserChecker
        */
⋮----
/*
        |--------------------------------------------------------------------------
        | Which role checker to use.
        |--------------------------------------------------------------------------
        |
        | Defines if you want to use the roles and permissions checker.
        | Available:
        | - default: Check for the roles and permissions using the method that Laratrust
                     has always used.
        | - query: Check for the roles and permissions using direct queries to the database.
        |          This method doesn't support cache yet.
        | - class that extends Laratrust\Checkers\Role\RoleChecker
        */
⋮----
/*
    |--------------------------------------------------------------------------
    | Cache
    |--------------------------------------------------------------------------
    |
    | Manage Laratrust's cache configurations. It uses the driver defined in the
    | config/cache.php file.
    |
    */
⋮----
/*
        |--------------------------------------------------------------------------
        | Use cache in the package
        |--------------------------------------------------------------------------
        |
        | Defines if Laratrust will use Laravel's Cache to cache the roles and permissions.
        | NOTE: Currently the database check does not use cache.
        |
        */
⋮----
/*
        |--------------------------------------------------------------------------
        | Time to store in cache Laratrust's roles and permissions.
        |--------------------------------------------------------------------------
        |
        | Determines the time in SECONDS to store Laratrust's roles and permissions in the cache.
        |
        */
⋮----
/*
    |--------------------------------------------------------------------------
    | Laratrust User Models
    |--------------------------------------------------------------------------
    |
    | This is the array that contains the information of the user models.
    | This information is used in the add-trait command, for the roles and
    | permissions relationships with the possible user models, and the
    | administration panel to add roles and permissions to the users.
    |
    | The key in the array is the name of the relationship inside the roles and permissions.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Laratrust Models
    |--------------------------------------------------------------------------
    |
    | These are the models used by Laratrust to define the roles, permissions and teams.
    | If you want the Laratrust models to be in a different namespace or
    | to have a different name, you can do it here.
    |
    */
⋮----
/**
         * Will be used only if the teams functionality is enabled.
         */
⋮----
/*
    |--------------------------------------------------------------------------
    | Laratrust Tables
    |--------------------------------------------------------------------------
    |
    | These are the tables used by Laratrust to store all the authorization data.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Laratrust Foreign Keys
    |--------------------------------------------------------------------------
    |
    | These are the foreign keys used by laratrust in the intermediate tables.
    |
    */
⋮----
/**
         * User foreign key on Laratrust's role_user and permission_user tables.
         */
⋮----
/**
         * Role foreign key on Laratrust's role_user and permission_role tables.
         */
⋮----
/**
         * Role foreign key on Laratrust's permission_user and permission_role tables.
         */
⋮----
/**
         * Role foreign key on Laratrust's role_user and permission_user tables.
         */
⋮----
/*
    |--------------------------------------------------------------------------
    | Laratrust Middleware
    |--------------------------------------------------------------------------
    |
    | This configuration helps to customize the Laratrust middleware behavior.
    |
    */
⋮----
/**
         * Define if the laratrust middleware are registered automatically in the service provider.
         */
⋮----
/**
         * Method to be called in the middleware return case.
         * Available: abort|redirect.
         */
⋮----
/**
         * Handlers for the unauthorized method in the middlewares.
         * The name of the handler must be the same as the handling.
         */
⋮----
/**
             * Aborts the execution with a 403 code and allows you to provide the response text.
             */
⋮----
/**
             * Redirects the user to the given url.
             * If you want to flash a key to the session,
             * you can do it by setting the key and the content of the message
             * If the message content is empty it won't be added to the redirection.
             */
⋮----
/*
        |--------------------------------------------------------------------------
        | Use teams feature in the package
        |--------------------------------------------------------------------------
        |
        | Defines if Laratrust will use the teams feature.
        | Please check the docs to see what you need to do in case you have the package already configured.
        |
        */
// Warehouse-scoped permissions (Inventory Manager stock.move/stock.transfer)
// require teams: one Laratrust team per warehouse. See
// docs/project/canonical-decisions.md §3.
⋮----
/*
        |--------------------------------------------------------------------------
        | Strict check for roles/permissions inside teams
        |--------------------------------------------------------------------------
        |
        | Determines if a strict check should be done when checking if a role or permission is added inside a team.
        | If it's false, when checking a role/permission without specifying the team,
        | it will check only if the user has added that role/permission ignoring the team.
        |
        */
⋮----
/*
    |--------------------------------------------------------------------------
    | Laratrust Permissions as Gates
    |--------------------------------------------------------------------------
    |
    | Determines if you can check if a user has a permission using the "can" method.
    |
    | Deliberately false: Laratrust's Gate::before() hook (registered when
    | this is true) treats the first non-boolean argument passed to ANY
    | Gate/Policy check as a team identifier. That breaks Policy-based
    | checks like $user->can('create', Product::class) — it tries to look
    | up a team named "App\Models\Product" and throws ModelNotFoundException.
    | Our Policies (ProductPolicy, PriceListPolicy) call $user->isAbleTo()
    | directly instead, so this isn't needed. See docs/project/canonical-decisions.md §2.
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Laratrust Panel
    |--------------------------------------------------------------------------
    |
    | Section to manage everything related with the admin panel for the roles and permissions.
    |
    */
⋮----
/*
        |--------------------------------------------------------------------------
        | Laratrust Panel Register
        |--------------------------------------------------------------------------
        |
        | This manages if routes used for the admin panel should be registered.
        | Turn this value to false if you don't want to use Laratrust admin panel
        |
        */
⋮----
/*
        |--------------------------------------------------------------------------
        | Laratrust Panel Domain
        |--------------------------------------------------------------------------
        |
        | This is the Domain Laratrust panel for roles and permissions
        | will be accessible from.
        |
        */
⋮----
/*
        |--------------------------------------------------------------------------
        | Laratrust Panel Path
        |--------------------------------------------------------------------------
        |
        | This is the URI path where Laratrust panel for roles and permissions
        | will be accessible from.
        |
        */
⋮----
/*
        |--------------------------------------------------------------------------
        | Laratrust Panel Path
        |--------------------------------------------------------------------------
        |
        | The route where the go back link should point
        |
        */
⋮----
/*
        |--------------------------------------------------------------------------
        | Laratrust Panel Route Middleware
        |--------------------------------------------------------------------------
        |
        | These middleware will get added onto each Laratrust panel route.
        |
        */
⋮----
/*
        |--------------------------------------------------------------------------
        | Enable permissions assignment
        |--------------------------------------------------------------------------
        |
        | Enable/Disable the permissions assignment to the users.
        |
        */
⋮----
/*
        |--------------------------------------------------------------------------
        | Enable permissions creation
        |--------------------------------------------------------------------------
        |
        | Enable/Disable the possibility to create permissions from the panel.
        |
        */
⋮----
/*
        |--------------------------------------------------------------------------
        | Add restriction to roles in the panel
        |--------------------------------------------------------------------------
        |
        | Configure which roles can not be editable, deletable and removable.
        | To add a role to the restriction, use name of the role here.
        |
        */
⋮----
// The user won't be able to remove roles already assigned to users.
⋮----
// The user won't be able to edit the role and the permissions assigned.
⋮----
// The user won't be able to delete the role.
````

## File: config/logging.php
````php
use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;
use Monolog\Processor\PsrLogMessageProcessor;
⋮----
/*
    |--------------------------------------------------------------------------
    | Default Log Channel
    |--------------------------------------------------------------------------
    |
    | This option defines the default log channel that is utilized to write
    | messages to your logs. The value provided here should match one of
    | the channels present in the list of "channels" configured below.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Deprecations Log Channel
    |--------------------------------------------------------------------------
    |
    | This option controls the log channel that should be used to log warnings
    | regarding deprecated PHP and library features. This allows you to get
    | your application ready for upcoming major versions of dependencies.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Log Channels
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log channels for your application. Laravel
    | utilizes the Monolog PHP logging library, which includes a variety
    | of powerful log handlers and formatters that you're free to use.
    |
    | Available drivers: "single", "daily", "slack", "syslog",
    |                    "errorlog", "monolog", "custom", "stack"
    |
    */
````

## File: config/mail.php
````php
/*
    |--------------------------------------------------------------------------
    | Default Mailer
    |--------------------------------------------------------------------------
    |
    | This option controls the default mailer that is used to send all email
    | messages unless another mailer is explicitly specified when sending
    | the message. All additional mailers can be configured within the
    | "mailers" array. Examples of each type of mailer are provided.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Mailer Configurations
    |--------------------------------------------------------------------------
    |
    | Here you may configure all of the mailers used by your application plus
    | their respective settings. Several examples have been configured for
    | you and you are free to add your own as your application requires.
    |
    | Laravel supports a variety of mail "transport" drivers that can be used
    | when delivering an email. You may specify which one you're using for
    | your mailers below. You may also add additional mailers if needed.
    |
    | Supported: "smtp", "sendmail", "mailgun", "ses", "ses-v2",
    |            "postmark", "resend", "log", "array",
    |            "failover", "roundrobin"
    |
    */
⋮----
// 'message_stream_id' => env('POSTMARK_MESSAGE_STREAM_ID'),
// 'client' => [
//     'timeout' => 5,
// ],
⋮----
/*
    |--------------------------------------------------------------------------
    | Global "From" Address
    |--------------------------------------------------------------------------
    |
    | You may wish for all emails sent by your application to be sent from
    | the same address. Here you may specify a name and address that is
    | used globally for all emails that are sent by your application.
    |
    */
````

## File: config/passport.php
````php
/*
    |--------------------------------------------------------------------------
    | Passport Guard
    |--------------------------------------------------------------------------
    |
    | Here you may specify which authentication guard Passport will use when
    | authenticating users. This value should correspond with one of your
    | guards that is already present in your "auth" configuration file.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Encryption Keys
    |--------------------------------------------------------------------------
    |
    | Passport uses encryption keys while generating secure access tokens for
    | your application. By default, the keys are stored as local files but
    | can be set via environment variables when that is more convenient.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Passport Database Connection
    |--------------------------------------------------------------------------
    |
    | By default, Passport's models will utilize your application's default
    | database connection. If you wish to use a different connection you
    | may specify the configured name of the database connection here.
    |
    */
````

## File: config/queue.php
````php
/*
    |--------------------------------------------------------------------------
    | Default Queue Connection Name
    |--------------------------------------------------------------------------
    |
    | Laravel's queue supports a variety of backends via a single, unified
    | API, giving you convenient access to each backend using identical
    | syntax for each. The default queue connection is defined below.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Queue Connections
    |--------------------------------------------------------------------------
    |
    | Here you may configure the connection options for every queue backend
    | used by your application. An example configuration is provided for
    | each backend supported by Laravel. You're also free to add more.
    |
    | Drivers: "sync", "database", "beanstalkd", "sqs", "redis",
    |          "deferred", "background", "failover", "null"
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Job Batching
    |--------------------------------------------------------------------------
    |
    | The following options configure the database and table that store job
    | batching information. These options can be updated to any database
    | connection and table which has been defined by your application.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Failed Queue Jobs
    |--------------------------------------------------------------------------
    |
    | These options configure the behavior of failed queue job logging so you
    | can control how and where failed jobs are stored. Laravel ships with
    | support for storing failed jobs in a simple file or in a database.
    |
    | Supported drivers: "database-uuids", "dynamodb", "file", "null"
    |
    */
````

## File: config/services.php
````php
/*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */
````

## File: config/session.php
````php
use Illuminate\Support\Str;
⋮----
/*
    |--------------------------------------------------------------------------
    | Default Session Driver
    |--------------------------------------------------------------------------
    |
    | This option determines the default session driver that is utilized for
    | incoming requests. Laravel supports a variety of storage options to
    | persist session data. Database storage is a great default choice.
    |
    | Supported: "file", "cookie", "database", "memcached",
    |            "redis", "dynamodb", "array"
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Session Lifetime
    |--------------------------------------------------------------------------
    |
    | Here you may specify the number of minutes that you wish the session
    | to be allowed to remain idle before it expires. If you want them
    | to expire immediately when the browser is closed then you may
    | indicate that via the expire_on_close configuration option.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Session Encryption
    |--------------------------------------------------------------------------
    |
    | This option allows you to easily specify that all of your session data
    | should be encrypted before it's stored. All encryption is performed
    | automatically by Laravel and you may use the session like normal.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Session File Location
    |--------------------------------------------------------------------------
    |
    | When utilizing the "file" session driver, the session files are placed
    | on disk. The default storage location is defined here; however, you
    | are free to provide another location where they should be stored.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Session Database Connection
    |--------------------------------------------------------------------------
    |
    | When using the "database" or "redis" session drivers, you may specify a
    | connection that should be used to manage these sessions. This should
    | correspond to a connection in your database configuration options.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Session Database Table
    |--------------------------------------------------------------------------
    |
    | When using the "database" session driver, you may specify the table to
    | be used to store sessions. Of course, a sensible default is defined
    | for you; however, you're welcome to change this to another table.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Session Cache Store
    |--------------------------------------------------------------------------
    |
    | When using one of the framework's cache driven session backends, you may
    | define the cache store which should be used to store the session data
    | between requests. This must match one of your defined cache stores.
    |
    | Affects: "dynamodb", "memcached", "redis"
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Session Sweeping Lottery
    |--------------------------------------------------------------------------
    |
    | Some session drivers must manually sweep their storage location to get
    | rid of old sessions from storage. Here are the chances that it will
    | happen on a given request. By default, the odds are 2 out of 100.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Session Cookie Name
    |--------------------------------------------------------------------------
    |
    | Here you may change the name of the session cookie that is created by
    | the framework. Typically, you should not need to change this value
    | since doing so does not grant a meaningful security improvement.
    |
    */
⋮----
Str::slug((string) env('APP_NAME', 'laravel')).'-session'
⋮----
/*
    |--------------------------------------------------------------------------
    | Session Cookie Path
    |--------------------------------------------------------------------------
    |
    | The session cookie path determines the path for which the cookie will
    | be regarded as available. Typically, this will be the root path of
    | your application, but you're free to change this when necessary.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Session Cookie Domain
    |--------------------------------------------------------------------------
    |
    | This value determines the domain and subdomains the session cookie is
    | available to. By default, the cookie will be available to the root
    | domain without subdomains. Typically, this shouldn't be changed.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | HTTPS Only Cookies
    |--------------------------------------------------------------------------
    |
    | By setting this option to true, session cookies will only be sent back
    | to the server if the browser has a HTTPS connection. This will keep
    | the cookie from being sent to you when it can't be done securely.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | HTTP Access Only
    |--------------------------------------------------------------------------
    |
    | Setting this value to true will prevent JavaScript from accessing the
    | value of the cookie and the cookie will only be accessible through
    | the HTTP protocol. It's unlikely you should disable this option.
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Same-Site Cookies
    |--------------------------------------------------------------------------
    |
    | This option determines how your cookies behave when cross-site requests
    | take place, and can be used to mitigate CSRF attacks. By default, we
    | will set this value to "lax" to permit secure cross-site requests.
    |
    | See: https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Set-Cookie#samesitesamesite-value
    |
    | Supported: "lax", "strict", "none", null
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Partitioned Cookies
    |--------------------------------------------------------------------------
    |
    | Setting this value to true will tie the cookie to the top-level site for
    | a cross-site context. Partitioned cookies are accepted by the browser
    | when flagged "secure" and the Same-Site attribute is set to "none".
    |
    */
⋮----
/*
    |--------------------------------------------------------------------------
    | Session Serialization
    |--------------------------------------------------------------------------
    |
    | This value controls the serialization strategy for session data, which
    | is JSON by default. Setting this to "php" allows the storage of PHP
    | objects in the session but can make an application vulnerable to
    | "gadget chain" serialization attacks if the APP_KEY is leaked.
    |
    | Supported: "json", "php"
    |
    */
````

## File: database/factories/BusinessAccountFactory.php
````php
namespace Database\Factories;
⋮----
use App\Models\BusinessAccount;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
⋮----
/**
 * @extends Factory<BusinessAccount>
 */
class BusinessAccountFactory extends Factory
⋮----
/**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
public function definition(): array
⋮----
'user_id' => User::factory(),
'company_name' => fake()->company(),
'tax_id' => fake()->numerify('TAX-########'),
'credit_limit' => fake()->randomFloat(2, 1000, 50000),
'net_terms_days' => fake()->randomElement([0, 15, 30, 60]),
````

## File: database/factories/CategoryFactory.php
````php
namespace Database\Factories;
⋮----
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
⋮----
/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
⋮----
/**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
public function definition(): array
⋮----
$name = fake()->unique()->words(2, true);
⋮----
'slug' => Str::slug($name),
⋮----
public function childOf(Category $parent): static
⋮----
return $this->state(fn (array $attributes) => [
````

## File: database/factories/OrderFactory.php
````php
namespace Database\Factories;
⋮----
use App\Enums\OrderChannel;
use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
⋮----
/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
⋮----
/**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
public function definition(): array
⋮----
$subtotal = fake()->randomFloat(2, 10, 1000);
// Flat 14% VAT — see docs/project/canonical-decisions.md §1.
⋮----
'user_id' => User::factory(),
````

## File: database/factories/PaymentFactory.php
````php
namespace Database\Factories;
⋮----
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Models\Order;
use App\Models\Payment;
use App\Models\PurchaseOrder;
use Illuminate\Database\Eloquent\Factories\Factory;
⋮----
/**
 * @extends Factory<Payment>
 */
class PaymentFactory extends Factory
⋮----
/**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
public function definition(): array
⋮----
'payable_id' => Order::factory(),
'method' => fake()->randomElement(PaymentMethod::cases()),
⋮----
'gateway_ref' => fake()->unique()->uuid(),
'amount' => fake()->randomFloat(2, 10, 5000),
⋮----
public function forPurchaseOrder(?PurchaseOrder $purchaseOrder = null): static
⋮----
return $this->state(fn (array $attributes) => [
⋮----
'payable_id' => $purchaseOrder?->id ?? PurchaseOrder::factory(),
````

## File: database/factories/PriceListFactory.php
````php
namespace Database\Factories;
⋮----
use App\Enums\PriceListType;
use App\Models\PriceList;
use Illuminate\Database\Eloquent\Factories\Factory;
⋮----
/**
 * @extends Factory<PriceList>
 */
class PriceListFactory extends Factory
⋮----
/**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
public function definition(): array
⋮----
'name' => fake()->words(2, true).' price list',
'type' => fake()->randomElement(PriceListType::cases()),
````

## File: database/factories/PriceListItemFactory.php
````php
namespace Database\Factories;
⋮----
use App\Models\PriceList;
use App\Models\PriceListItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
⋮----
/**
 * @extends Factory<PriceListItem>
 */
class PriceListItemFactory extends Factory
⋮----
/**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
public function definition(): array
⋮----
'price_list_id' => PriceList::factory(),
'product_id' => Product::factory(),
'unit_price' => fake()->randomFloat(2, 1, 1000),
````

## File: database/factories/ProductFactory.php
````php
namespace Database\Factories;
⋮----
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;
⋮----
/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
⋮----
/**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
public function definition(): array
⋮----
'category_id' => Category::factory(),
'supplier_id' => Supplier::factory(),
'sku' => strtoupper(fake()->unique()->bothify('SKU-#####??')),
'name' => ucfirst(fake()->unique()->words(3, true)),
'description' => fake()->sentence(),
````

## File: database/factories/PurchaseOrderFactory.php
````php
namespace Database\Factories;
⋮----
use App\Enums\PurchaseOrderStatus;
use App\Models\BusinessAccount;
use App\Models\PurchaseOrder;
use Illuminate\Database\Eloquent\Factories\Factory;
⋮----
/**
 * @extends Factory<PurchaseOrder>
 */
class PurchaseOrderFactory extends Factory
⋮----
/**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
public function definition(): array
⋮----
$subtotal = fake()->randomFloat(2, 100, 10000);
⋮----
'business_account_id' => BusinessAccount::factory(),
````

## File: database/factories/QuoteFactory.php
````php
namespace Database\Factories;
⋮----
use App\Enums\QuoteStatus;
use App\Models\BusinessAccount;
use App\Models\Quote;
use Illuminate\Database\Eloquent\Factories\Factory;
⋮----
/**
 * @extends Factory<Quote>
 */
class QuoteFactory extends Factory
⋮----
/**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
public function definition(): array
⋮----
$subtotal = fake()->randomFloat(2, 100, 10000);
⋮----
'business_account_id' => BusinessAccount::factory(),
⋮----
'expires_at' => now()->addDays(14)->toDateString(),
````

## File: database/factories/StockLevelFactory.php
````php
namespace Database\Factories;
⋮----
use App\Models\Product;
use App\Models\StockLevel;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;
⋮----
/**
 * @extends Factory<StockLevel>
 */
class StockLevelFactory extends Factory
⋮----
/**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
public function definition(): array
⋮----
$onHand = fake()->numberBetween(0, 500);
⋮----
'product_id' => Product::factory(),
'warehouse_id' => Warehouse::factory(),
⋮----
'reserved' => fake()->numberBetween(0, $onHand),
````

## File: database/factories/SupplierFactory.php
````php
namespace Database\Factories;
⋮----
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;
⋮----
/**
 * @extends Factory<Supplier>
 */
class SupplierFactory extends Factory
⋮----
/**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
public function definition(): array
⋮----
'name' => fake()->company(),
'email' => fake()->unique()->companyEmail(),
'phone' => fake()->phoneNumber(),
````

## File: database/factories/UserFactory.php
````php
namespace Database\Factories;
⋮----
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
⋮----
/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
⋮----
/**
     * The current password being used by the factory.
     */
protected static ?string $password;
⋮----
/**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
public function definition(): array
⋮----
'name' => fake()->name(),
'email' => fake()->unique()->safeEmail(),
⋮----
'password' => static::$password ??= Hash::make('password'),
'remember_token' => Str::random(10),
⋮----
/**
     * Indicate that the model's email address should be unverified.
     */
public function unverified(): static
⋮----
return $this->state(fn (array $attributes) => [
````

## File: database/factories/WarehouseFactory.php
````php
namespace Database\Factories;
⋮----
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;
⋮----
/**
 * @extends Factory<Warehouse>
 */
class WarehouseFactory extends Factory
⋮----
/**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
public function definition(): array
⋮----
'name' => fake()->city().' Warehouse',
'code' => strtoupper(fake()->unique()->bothify('WH-###??')),
'address' => fake()->address(),
````

## File: database/migrations/0001_01_01_000000_create_users_table.php
````php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
⋮----
/**
     * Run the migrations.
     */
public function up(): void
⋮----
Schema::create('users', function (Blueprint $table) {
$table->id();
$table->string('name');
$table->string('email')->unique();
$table->timestamp('email_verified_at')->nullable();
$table->string('password');
$table->rememberToken();
$table->timestamps();
⋮----
Schema::create('password_reset_tokens', function (Blueprint $table) {
$table->string('email')->primary();
$table->string('token');
$table->timestamp('created_at')->nullable();
⋮----
Schema::create('sessions', function (Blueprint $table) {
$table->string('id')->primary();
$table->foreignId('user_id')->nullable()->index();
$table->string('ip_address', 45)->nullable();
$table->text('user_agent')->nullable();
$table->longText('payload');
$table->integer('last_activity')->index();
⋮----
/**
     * Reverse the migrations.
     */
public function down(): void
⋮----
Schema::dropIfExists('users');
Schema::dropIfExists('password_reset_tokens');
Schema::dropIfExists('sessions');
````

## File: database/migrations/0001_01_01_000001_create_cache_table.php
````php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
⋮----
/**
     * Run the migrations.
     */
public function up(): void
⋮----
Schema::create('cache', function (Blueprint $table) {
$table->string('key')->primary();
$table->mediumText('value');
$table->bigInteger('expiration')->index();
⋮----
Schema::create('cache_locks', function (Blueprint $table) {
⋮----
$table->string('owner');
⋮----
/**
     * Reverse the migrations.
     */
public function down(): void
⋮----
Schema::dropIfExists('cache');
Schema::dropIfExists('cache_locks');
````

## File: database/migrations/0001_01_01_000002_create_jobs_table.php
````php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
⋮----
/**
     * Run the migrations.
     */
public function up(): void
⋮----
Schema::create('jobs', function (Blueprint $table) {
$table->id();
$table->string('queue')->index();
$table->longText('payload');
$table->unsignedSmallInteger('attempts');
$table->unsignedInteger('reserved_at')->nullable();
$table->unsignedInteger('available_at');
$table->unsignedInteger('created_at');
⋮----
Schema::create('job_batches', function (Blueprint $table) {
$table->string('id')->primary();
$table->string('name');
$table->integer('total_jobs');
$table->integer('pending_jobs');
$table->integer('failed_jobs');
$table->longText('failed_job_ids');
$table->mediumText('options')->nullable();
$table->integer('cancelled_at')->nullable();
$table->integer('created_at');
$table->integer('finished_at')->nullable();
⋮----
Schema::create('failed_jobs', function (Blueprint $table) {
⋮----
$table->string('uuid')->unique();
$table->string('connection');
$table->string('queue');
⋮----
$table->longText('exception');
$table->timestamp('failed_at')->useCurrent();
⋮----
$table->index(['connection', 'queue', 'failed_at']);
⋮----
/**
     * Reverse the migrations.
     */
public function down(): void
⋮----
Schema::dropIfExists('jobs');
Schema::dropIfExists('job_batches');
Schema::dropIfExists('failed_jobs');
````

## File: database/migrations/2026_07_06_235123_laratrust_setup_tables.php
````php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
⋮----
class LaratrustSetupTables extends Migration
⋮----
/**
     * Run the migrations.
     *
     * @return void
     */
public function up()
⋮----
// Create table for storing roles
Schema::create('roles', function (Blueprint $table) {
$table->bigIncrements('id');
$table->string('name')->unique();
$table->string('display_name')->nullable();
$table->string('description')->nullable();
$table->timestamps();
⋮----
// Create table for storing permissions
Schema::create('permissions', function (Blueprint $table) {
⋮----
// Create table for storing teams
Schema::create('teams', function (Blueprint $table) {
⋮----
// Create table for associating roles to users and teams (Many To Many Polymorphic)
Schema::create('role_user', function (Blueprint $table) {
$table->unsignedBigInteger('role_id');
$table->unsignedBigInteger('user_id');
$table->string('user_type');
$table->unsignedBigInteger('team_id')->nullable();
⋮----
$table->foreign('role_id')->references('id')->on('roles')
->onUpdate('cascade')->onDelete('cascade');
$table->foreign('team_id')->references('id')->on('teams')
⋮----
$table->unique(['user_id', 'role_id', 'user_type', 'team_id']);
⋮----
// Create table for associating permissions to users (Many To Many Polymorphic)
Schema::create('permission_user', function (Blueprint $table) {
$table->unsignedBigInteger('permission_id');
⋮----
$table->foreign('permission_id')->references('id')->on('permissions')
⋮----
$table->unique(['user_id', 'permission_id', 'user_type', 'team_id']);
⋮----
// Create table for associating permissions to roles (Many-to-Many)
Schema::create('permission_role', function (Blueprint $table) {
⋮----
$table->primary(['permission_id', 'role_id']);
⋮----
/**
     * Reverse the migrations.
     *
     * @return void
     */
public function down()
⋮----
Schema::dropIfExists('permission_user');
Schema::dropIfExists('permission_role');
Schema::dropIfExists('permissions');
Schema::dropIfExists('role_user');
Schema::dropIfExists('roles');
Schema::dropIfExists('teams');
````

## File: database/migrations/2026_07_07_003001_create_business_accounts_table.php
````php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
⋮----
/**
     * Run the migrations.
     *
     * NOTE (ERD mismatch): the Enterprise PRD specifies UUID PKs everywhere,
     * including `users`. The existing `users` table (from an earlier
     * session) uses a bigint auto-increment id instead, so `user_id` here
     * is `foreignId` (unsignedBigInteger) to match it, not a UUID.
     */
public function up(): void
⋮----
Schema::create('business_accounts', function (Blueprint $table) {
⋮----
$table->uuid('id')->primary();
$table->foreignId('user_id')->unique()->constrained('users')->cascadeOnDelete();
$table->string('company_name');
$table->string('tax_id', 50)->nullable();
$table->decimal('credit_limit', 12, 2)->default(0);
$table->unsignedInteger('net_terms_days')->default(0);
$table->decimal('outstanding_balance', 12, 2)->default(0);
$table->boolean('is_active')->default(true);
$table->timestamps();
⋮----
/**
     * Reverse the migrations.
     */
public function down(): void
⋮----
Schema::dropIfExists('business_accounts');
````

## File: database/migrations/2026_07_07_003002_create_warehouses_table.php
````php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
⋮----
public function up(): void
⋮----
Schema::create('warehouses', function (Blueprint $table) {
⋮----
$table->uuid('id')->primary();
$table->string('name');
$table->string('code')->unique();
$table->string('address')->nullable();
$table->boolean('is_active')->default(true);
$table->timestamps();
⋮----
public function down(): void
⋮----
Schema::dropIfExists('warehouses');
````

## File: database/migrations/2026_07_07_003003_create_suppliers_table.php
````php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
⋮----
public function up(): void
⋮----
Schema::create('suppliers', function (Blueprint $table) {
⋮----
$table->uuid('id')->primary();
$table->string('name');
$table->string('email')->nullable();
$table->string('phone')->nullable();
$table->boolean('is_active')->default(true);
$table->timestamps();
⋮----
public function down(): void
⋮----
Schema::dropIfExists('suppliers');
````

## File: database/migrations/2026_07_07_003004_create_categories_table.php
````php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
⋮----
public function up(): void
⋮----
Schema::create('categories', function (Blueprint $table) {
⋮----
$table->uuid('id')->primary();
$table->uuid('parent_id')->nullable();
$table->string('name');
$table->string('slug')->unique();
$table->timestamps();
⋮----
$table->foreign('parent_id')->references('id')->on('categories')->nullOnDelete();
⋮----
public function down(): void
⋮----
Schema::dropIfExists('categories');
````

## File: database/migrations/2026_07_07_003005_create_products_table.php
````php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
⋮----
/**
     * NOTE: deliberately no `quantity` column — stock is only ever the
     * ledger (stock_movements) and its projection (stock_levels). See
     * docs/project/canonical-decisions.md §6.
     */
public function up(): void
⋮----
Schema::create('products', function (Blueprint $table) {
⋮----
$table->uuid('id')->primary();
$table->foreignUuid('category_id')->constrained('categories')->restrictOnDelete();
$table->foreignUuid('supplier_id')->nullable()->constrained('suppliers')->nullOnDelete();
$table->string('sku', 64)->unique();
$table->string('name');
$table->text('description')->nullable();
$table->boolean('is_active')->default(true);
$table->timestamps();
⋮----
// FULLTEXT is MySQL-only; the app's automated test suite runs
// most feature tests against SQLite in-memory for speed (see
// phpunit.xml), which has no FULLTEXT support at all and throws
// rather than ignoring it. Real MySQL (dev, and
// tests/Feature/Schema/DatabaseSchemaTest.php) still gets the
// index; FR-3.2's fulltext search itself only ever runs on MySQL.
if (Schema::getConnection()->getDriverName() === 'mysql') {
$table->fullText('name');
⋮----
public function down(): void
⋮----
Schema::dropIfExists('products');
````

## File: database/migrations/2026_07_07_003006_create_price_lists_table.php
````php
use App\Enums\PriceListType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
⋮----
public function up(): void
⋮----
Schema::create('price_lists', function (Blueprint $table) {
⋮----
$table->uuid('id')->primary();
$table->string('name');
$table->enum('type', array_column(PriceListType::cases(), 'value'));
$table->boolean('is_active')->default(true);
$table->timestamps();
⋮----
public function down(): void
⋮----
Schema::dropIfExists('price_lists');
````

## File: database/migrations/2026_07_07_003007_create_price_list_items_table.php
````php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
⋮----
public function up(): void
⋮----
Schema::create('price_list_items', function (Blueprint $table) {
⋮----
$table->uuid('id')->primary();
$table->foreignUuid('price_list_id')->constrained('price_lists')->cascadeOnDelete();
$table->foreignUuid('product_id')->constrained('products')->restrictOnDelete();
$table->decimal('unit_price', 12, 2);
$table->unsignedInteger('min_qty')->default(1);
⋮----
$table->unique(['price_list_id', 'product_id', 'min_qty']);
⋮----
public function down(): void
⋮----
Schema::dropIfExists('price_list_items');
````

## File: database/migrations/2026_07_07_003008_create_stock_movements_table.php
````php
use App\Enums\MovementType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
⋮----
/**
     * Immutable, insert-only ledger — see docs/project/canonical-decisions.md §6.
     * Only `created_at`, deliberately no `updated_at`: rows are never updated.
     */
public function up(): void
⋮----
Schema::create('stock_movements', function (Blueprint $table) {
⋮----
$table->uuid('id')->primary();
$table->foreignUuid('product_id')->constrained('products')->restrictOnDelete();
$table->foreignUuid('warehouse_id')->constrained('warehouses')->restrictOnDelete();
$table->enum('type', array_column(MovementType::cases(), 'value'));
$table->integer('quantity');
$table->foreignId('actor_id')->nullable()->constrained('users')->nullOnDelete();
$table->string('reason')->nullable();
$table->nullableUuidMorphs('reference');
$table->timestamp('created_at')->useCurrent();
⋮----
$table->index(['product_id', 'warehouse_id', 'created_at']);
$table->index('type');
⋮----
public function down(): void
⋮----
Schema::dropIfExists('stock_movements');
````

## File: database/migrations/2026_07_07_003009_create_stock_levels_table.php
````php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
⋮----
/**
     * Denormalized projection of stock_movements, and the row locked
     * (SELECT ... FOR UPDATE) during reservation/confirmation/transfer.
     * `available` is deliberately NOT a column — it is always computed as
     * on_hand - reserved. See docs/project/canonical-decisions.md §6.
     */
public function up(): void
⋮----
Schema::create('stock_levels', function (Blueprint $table) {
⋮----
$table->uuid('id')->primary();
$table->foreignUuid('product_id')->constrained('products')->restrictOnDelete();
$table->foreignUuid('warehouse_id')->constrained('warehouses')->restrictOnDelete();
$table->unsignedInteger('on_hand')->default(0);
$table->unsignedInteger('reserved')->default(0);
$table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
⋮----
$table->unique(['product_id', 'warehouse_id']);
⋮----
public function down(): void
⋮----
Schema::dropIfExists('stock_levels');
````

## File: database/migrations/2026_07_07_003010_create_orders_table.php
````php
use App\Enums\OrderChannel;
use App\Enums\OrderStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
⋮----
public function up(): void
⋮----
Schema::create('orders', function (Blueprint $table) {
⋮----
$table->uuid('id')->primary();
$table->foreignId('user_id')->constrained('users')->restrictOnDelete();
$table->enum('channel', array_column(OrderChannel::cases(), 'value'));
$table->enum('status', array_column(OrderStatus::cases(), 'value'))->default(OrderStatus::Pending->value);
$table->decimal('subtotal', 12, 2);
$table->decimal('tax', 12, 2);
$table->decimal('total', 12, 2);
$table->timestamp('reserved_until')->nullable();
$table->timestamps();
⋮----
$table->index(['status', 'created_at']);
⋮----
public function down(): void
⋮----
Schema::dropIfExists('orders');
````

## File: database/migrations/2026_07_07_003011_create_order_items_table.php
````php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
⋮----
public function up(): void
⋮----
Schema::create('order_items', function (Blueprint $table) {
⋮----
$table->uuid('id')->primary();
$table->foreignUuid('order_id')->constrained('orders')->cascadeOnDelete();
$table->foreignUuid('product_id')->constrained('products')->restrictOnDelete();
$table->foreignUuid('warehouse_id')->constrained('warehouses')->restrictOnDelete();
$table->unsignedInteger('quantity');
$table->decimal('unit_price', 12, 2);
$table->decimal('line_total', 12, 2);
⋮----
public function down(): void
⋮----
Schema::dropIfExists('order_items');
````

## File: database/migrations/2026_07_07_003012_create_quotes_table.php
````php
use App\Enums\QuoteStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
⋮----
public function up(): void
⋮----
Schema::create('quotes', function (Blueprint $table) {
⋮----
$table->uuid('id')->primary();
$table->foreignUuid('business_account_id')->constrained('business_accounts')->restrictOnDelete();
$table->enum('status', array_column(QuoteStatus::cases(), 'value'))->default(QuoteStatus::Draft->value);
$table->decimal('subtotal', 12, 2);
$table->decimal('tax', 12, 2);
$table->decimal('total', 12, 2);
$table->date('expires_at')->nullable();
$table->timestamps();
⋮----
public function down(): void
⋮----
Schema::dropIfExists('quotes');
````

## File: database/migrations/2026_07_07_003013_create_quote_items_table.php
````php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
⋮----
public function up(): void
⋮----
Schema::create('quote_items', function (Blueprint $table) {
⋮----
$table->uuid('id')->primary();
$table->foreignUuid('quote_id')->constrained('quotes')->cascadeOnDelete();
$table->foreignUuid('product_id')->constrained('products')->restrictOnDelete();
$table->unsignedInteger('quantity');
$table->decimal('unit_price', 12, 2);
⋮----
public function down(): void
⋮----
Schema::dropIfExists('quote_items');
````

## File: database/migrations/2026_07_07_003014_create_purchase_orders_table.php
````php
use App\Enums\PurchaseOrderStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
⋮----
public function up(): void
⋮----
Schema::create('purchase_orders', function (Blueprint $table) {
⋮----
$table->uuid('id')->primary();
$table->foreignUuid('quote_id')->nullable()->constrained('quotes')->nullOnDelete();
$table->foreignUuid('business_account_id')->constrained('business_accounts')->restrictOnDelete();
$table->enum('status', array_column(PurchaseOrderStatus::cases(), 'value'))
->default(PurchaseOrderStatus::PendingApproval->value);
$table->decimal('subtotal', 12, 2);
$table->decimal('tax', 12, 2);
$table->decimal('total', 12, 2);
$table->date('due_date')->nullable();
$table->timestamps();
⋮----
$table->index(['status', 'created_at']);
⋮----
public function down(): void
⋮----
Schema::dropIfExists('purchase_orders');
````

## File: database/migrations/2026_07_07_003015_create_po_items_table.php
````php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
⋮----
public function up(): void
⋮----
Schema::create('po_items', function (Blueprint $table) {
⋮----
$table->uuid('id')->primary();
$table->foreignUuid('purchase_order_id')->constrained('purchase_orders')->cascadeOnDelete();
$table->foreignUuid('product_id')->constrained('products')->restrictOnDelete();
$table->foreignUuid('warehouse_id')->constrained('warehouses')->restrictOnDelete();
$table->unsignedInteger('quantity');
$table->decimal('unit_price', 12, 2);
⋮----
public function down(): void
⋮----
Schema::dropIfExists('po_items');
````

## File: database/migrations/2026_07_07_003016_create_po_approvals_table.php
````php
use App\Enums\ApprovalDecision;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
⋮----
public function up(): void
⋮----
Schema::create('po_approvals', function (Blueprint $table) {
⋮----
$table->uuid('id')->primary();
$table->foreignUuid('purchase_order_id')->constrained('purchase_orders')->cascadeOnDelete();
$table->foreignId('approver_id')->constrained('users')->restrictOnDelete();
$table->enum('decision', array_column(ApprovalDecision::cases(), 'value'));
$table->string('note')->nullable();
$table->timestamp('created_at')->useCurrent();
⋮----
public function down(): void
⋮----
Schema::dropIfExists('po_approvals');
````

## File: database/migrations/2026_07_07_003017_create_payments_table.php
````php
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
⋮----
public function up(): void
⋮----
Schema::create('payments', function (Blueprint $table) {
⋮----
$table->uuid('id')->primary();
$table->uuidMorphs('payable');
$table->enum('method', array_column(PaymentMethod::cases(), 'value'));
$table->enum('status', array_column(PaymentStatus::cases(), 'value'))->default(PaymentStatus::Pending->value);
$table->string('gateway_ref')->nullable()->unique();
$table->decimal('amount', 12, 2);
$table->json('meta')->nullable();
$table->timestamps();
⋮----
public function down(): void
⋮----
Schema::dropIfExists('payments');
````

## File: database/migrations/2026_07_07_003018_create_import_batches_table.php
````php
use App\Enums\ImportEntity;
use App\Enums\ImportStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
⋮----
public function up(): void
⋮----
Schema::create('import_batches', function (Blueprint $table) {
⋮----
$table->uuid('id')->primary();
$table->foreignId('uploader_id')->constrained('users')->restrictOnDelete();
$table->enum('entity', array_column(ImportEntity::cases(), 'value'));
$table->enum('status', array_column(ImportStatus::cases(), 'value'))->default(ImportStatus::Pending->value);
$table->unsignedInteger('total_rows')->default(0);
$table->unsignedInteger('success_rows')->default(0);
$table->unsignedInteger('failed_rows')->default(0);
$table->timestamps();
⋮----
public function down(): void
⋮----
Schema::dropIfExists('import_batches');
````

## File: database/migrations/2026_07_07_003019_create_import_rows_table.php
````php
use App\Enums\ImportRowStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
⋮----
public function up(): void
⋮----
Schema::create('import_rows', function (Blueprint $table) {
⋮----
$table->uuid('id')->primary();
$table->foreignUuid('import_batch_id')->constrained('import_batches')->cascadeOnDelete();
$table->unsignedInteger('row_number');
$table->json('payload');
$table->enum('status', array_column(ImportRowStatus::cases(), 'value'))->default(ImportRowStatus::Pending->value);
$table->string('error')->nullable();
⋮----
public function down(): void
⋮----
Schema::dropIfExists('import_rows');
````

## File: database/migrations/2026_07_07_003020_create_activity_log_table.php
````php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
⋮----
/**
     * Custom activity log (no spatie/laravel-activitylog package), per
     * Enterprise PRD §6.9: id, causer_id, subject_type, subject_id, event,
     * properties json, created_at.
     *
     * `subject_id` is a plain string rather than `uuidMorphs()`/`morphs()`
     * because subjects span both UUID-keyed tables (Product, Order, ...)
     * and the existing bigint-keyed `users`/`roles`/`permissions` tables —
     * see the ERD mismatch note in canonical-decisions.md / this session's
     * output about `users.id` not being a UUID.
     */
public function up(): void
⋮----
Schema::create('activity_log', function (Blueprint $table) {
⋮----
$table->uuid('id')->primary();
$table->foreignId('causer_id')->nullable()->constrained('users')->nullOnDelete();
$table->string('subject_type')->nullable();
$table->string('subject_id')->nullable();
$table->string('event');
$table->json('properties')->nullable();
$table->timestamp('created_at')->useCurrent();
⋮----
$table->index(['subject_type', 'subject_id']);
⋮----
public function down(): void
⋮----
Schema::dropIfExists('activity_log');
````

## File: database/migrations/2026_07_07_115907_add_user_id_to_suppliers_table.php
````php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
⋮----
/**
     * Links a Vendor/Supplier-role user to the supplier record they manage,
     * mirroring business_accounts.user_id for Business Buyers. Needed so
     * ProductPolicy/PriceListPolicy can enforce "own products / own price
     * list items only" (Enterprise PRD §3 permission matrix, "own" cells)
     * — nothing in the original schema linked a login user to a supplier.
     *
     * Nullable: not every supplier has a portal login (many are just
     * catalog metadata entered by staff).
     */
public function up(): void
⋮----
Schema::table('suppliers', function (Blueprint $table) {
$table->foreignId('user_id')->nullable()->unique()->after('id')->constrained('users')->nullOnDelete();
⋮----
public function down(): void
⋮----
$table->dropConstrainedForeignId('user_id');
````

## File: database/migrations/2026_07_07_181917_add_warehouse_id_to_teams_table.php
````php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
⋮----
/**
     * Maps each warehouse to exactly one Laratrust team, per the Enterprise
     * PRD §6.1: "A warehouses.id may equal a teams.id, or teams carries a
     * warehouse_id FK — implementation detail; the app maps each warehouse
     * to exactly one team." `teams.id` is a Laratrust bigint, `warehouses.id`
     * is our own UUID, so a shared-PK approach isn't possible — this adds
     * the FK column instead.
     *
     * Inventory Manager role assignments scoped to a team (via
     * role_user.team_id) are how stock.move/stock.transfer become
     * warehouse-scoped — see WarehouseScopeMiddleware / StockPolicy.
     */
public function up(): void
⋮----
Schema::table('teams', function (Blueprint $table) {
$table->uuid('warehouse_id')->nullable()->unique()->after('id');
$table->foreign('warehouse_id')->references('id')->on('warehouses')->nullOnDelete();
⋮----
public function down(): void
⋮----
$table->dropForeign(['warehouse_id']);
$table->dropColumn('warehouse_id');
````

## File: database/migrations/2026_07_07_222101_create_oauth_auth_codes_table.php
````php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
⋮----
/**
     * Run the migrations.
     */
public function up(): void
⋮----
Schema::create('oauth_auth_codes', function (Blueprint $table) {
$table->char('id', 80)->primary();
$table->foreignId('user_id')->index();
$table->foreignUuid('client_id');
$table->text('scopes')->nullable();
$table->boolean('revoked');
$table->dateTime('expires_at')->nullable();
⋮----
/**
     * Reverse the migrations.
     */
public function down(): void
⋮----
Schema::dropIfExists('oauth_auth_codes');
⋮----
/**
     * Get the migration connection name.
     */
public function getConnection(): ?string
````

## File: database/migrations/2026_07_07_222102_create_oauth_access_tokens_table.php
````php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
⋮----
/**
     * Run the migrations.
     */
public function up(): void
⋮----
Schema::create('oauth_access_tokens', function (Blueprint $table) {
$table->char('id', 80)->primary();
$table->foreignId('user_id')->nullable()->index();
$table->foreignUuid('client_id');
$table->string('name')->nullable();
$table->text('scopes')->nullable();
$table->boolean('revoked');
$table->timestamps();
$table->dateTime('expires_at')->nullable();
⋮----
/**
     * Reverse the migrations.
     */
public function down(): void
⋮----
Schema::dropIfExists('oauth_access_tokens');
⋮----
/**
     * Get the migration connection name.
     */
public function getConnection(): ?string
````

## File: database/migrations/2026_07_07_222103_create_oauth_refresh_tokens_table.php
````php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
⋮----
/**
     * Run the migrations.
     */
public function up(): void
⋮----
Schema::create('oauth_refresh_tokens', function (Blueprint $table) {
$table->char('id', 80)->primary();
$table->char('access_token_id', 80)->index();
$table->boolean('revoked');
$table->dateTime('expires_at')->nullable();
⋮----
/**
     * Reverse the migrations.
     */
public function down(): void
⋮----
Schema::dropIfExists('oauth_refresh_tokens');
⋮----
/**
     * Get the migration connection name.
     */
public function getConnection(): ?string
````

## File: database/migrations/2026_07_07_222104_create_oauth_clients_table.php
````php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
⋮----
/**
     * Run the migrations.
     */
public function up(): void
⋮----
Schema::create('oauth_clients', function (Blueprint $table) {
$table->uuid('id')->primary();
$table->nullableMorphs('owner');
$table->string('name');
$table->string('secret')->nullable();
$table->string('provider')->nullable();
$table->text('redirect_uris');
$table->text('grant_types');
$table->boolean('revoked');
$table->timestamps();
⋮----
/**
     * Reverse the migrations.
     */
public function down(): void
⋮----
Schema::dropIfExists('oauth_clients');
⋮----
/**
     * Get the migration connection name.
     */
public function getConnection(): ?string
````

## File: database/migrations/2026_07_07_222105_create_oauth_device_codes_table.php
````php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
⋮----
/**
     * Run the migrations.
     */
public function up(): void
⋮----
Schema::create('oauth_device_codes', function (Blueprint $table) {
$table->char('id', 80)->primary();
$table->foreignId('user_id')->nullable()->index();
$table->foreignUuid('client_id')->index();
$table->char('user_code', 8)->unique();
$table->text('scopes');
$table->boolean('revoked');
$table->dateTime('user_approved_at')->nullable();
$table->dateTime('last_polled_at')->nullable();
$table->dateTime('expires_at')->nullable();
⋮----
/**
     * Reverse the migrations.
     */
public function down(): void
⋮----
Schema::dropIfExists('oauth_device_codes');
⋮----
/**
     * Get the migration connection name.
     */
public function getConnection(): ?string
````

## File: database/migrations/2026_07_07_222923_add_fake_to_payments_method_enum.php
````php
use App\Enums\PaymentMethod;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
⋮----
/**
 * Widens payments.method to include 'fake_gateway' (the demo/test gateway used by
 * B2C checkout — see app/Payments/FakeGateway.php). Uses the fluent
 * Blueprint::change() API rather than raw SQL so it runs on both MySQL (dev/
 * prod) and SQLite (the test suite's default connection, which recreates
 * the table under the hood for column changes).
 */
⋮----
public function up(): void
⋮----
Schema::table('payments', function (Blueprint $table) {
$table->enum('method', array_column(PaymentMethod::cases(), 'value'))->change();
⋮----
public function down(): void
⋮----
$values = collect(PaymentMethod::cases())
->reject(fn (PaymentMethod $m) => $m === PaymentMethod::FakeGateway)
->map(fn (PaymentMethod $m) => $m->value)
->all();
⋮----
$table->enum('method', $values)->change();
````

## File: database/migrations/2026_07_08_000001_rename_fake_payment_method_to_fake_gateway.php
````php
use App\Enums\PaymentMethod;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
⋮----
public function up(): void
⋮----
DB::table('payments')
->where('method', 'fake')
->update(['method' => PaymentMethod::FakeGateway->value]);
⋮----
Schema::table('payments', function (Blueprint $table) {
$table->enum('method', array_column(PaymentMethod::cases(), 'value'))->change();
⋮----
public function down(): void
⋮----
->where('method', PaymentMethod::FakeGateway->value)
->update(['method' => 'fake']);
⋮----
$values = collect(PaymentMethod::cases())
->map(fn (PaymentMethod $method) => $method === PaymentMethod::FakeGateway ? 'fake' : $method->value)
->all();
⋮----
Schema::table('payments', function (Blueprint $table) use ($values) {
$table->enum('method', $values)->change();
````

## File: database/migrations/2026_07_08_000002_add_warehouses_and_file_metadata_to_import_batches.php
````php
use App\Enums\ImportEntity;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
⋮----
public function up(): void
⋮----
Schema::table('import_batches', function (Blueprint $table) {
$table->string('file_path')->nullable()->after('entity');
$table->string('original_filename')->nullable()->after('file_path');
$table->enum('entity', array_column(ImportEntity::cases(), 'value'))->change();
⋮----
public function down(): void
⋮----
$table->dropColumn(['file_path', 'original_filename']);
⋮----
$values = collect(ImportEntity::cases())
->reject(fn (ImportEntity $entity) => $entity === ImportEntity::Warehouses)
->map(fn (ImportEntity $entity) => $entity->value)
->all();
⋮----
$table->enum('entity', $values)->change();
````

## File: database/migrations/2026_07_08_020718_add_report_indexes_to_payments_table.php
````php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
⋮----
/**
 * Supports the Payments report's status + date-range filtering
 * (Reports/Payments.jsx) without a full table scan.
 */
⋮----
public function up(): void
⋮----
Schema::table('payments', function (Blueprint $table) {
$table->index(['status', 'created_at']);
$table->index('method');
⋮----
public function down(): void
⋮----
$table->dropIndex(['status', 'created_at']);
$table->dropIndex(['method']);
````

## File: database/migrations/2026_07_08_020719_add_report_indexes_to_import_batches_table.php
````php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
⋮----
/**
 * Supports the Imports report's status + date-range filtering
 * (Reports/Imports.jsx) without a full table scan.
 */
⋮----
public function up(): void
⋮----
Schema::table('import_batches', function (Blueprint $table) {
$table->index(['status', 'created_at']);
⋮----
public function down(): void
⋮----
$table->dropIndex(['status', 'created_at']);
````

## File: database/migrations/2026_07_08_020720_add_report_indexes_to_activity_log_table.php
````php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
⋮----
/**
 * Supports the Audit Log page's causer + date-range filtering
 * (Admin/AuditLog/Index.jsx) without a full table scan. The migration
 * that created activity_log already indexes (subject_type, subject_id).
 */
⋮----
public function up(): void
⋮----
Schema::table('activity_log', function (Blueprint $table) {
$table->index(['causer_id', 'created_at']);
$table->index('event');
⋮----
public function down(): void
⋮----
$table->dropIndex(['causer_id', 'created_at']);
$table->dropIndex(['event']);
````

## File: database/seeders/DatabaseSeeder.php
````php
namespace Database\Seeders;
⋮----
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
⋮----
class DatabaseSeeder extends Seeder
⋮----
/**
     * Seed the application's database.
     *
     * Flushes the cache first. `migrate:fresh` resets bigint auto-increment
     * IDs (users/roles/permissions all use bigint PKs — see the ERD
     * deviation note in CLAUDE.md), so a freshly-seeded user can be handed
     * the exact same numeric ID a *different* user had in a previous
     * seeding pass. Laratrust's permission cache is keyed by that ID
     * (`laratrust_roles_for_users_{id}`) — `migrate:fresh` doesn't touch
     * Redis, so a stale "this ID has no roles" entry from before the reset
     * survives and is silently served to the new user, making a
     * newly-seeded SuperAdmin look unauthorized everywhere until the cache
     * happens to expire or is cleared by hand. See docs/technical/cache.md
     * §"Known failure mode: stale Laratrust cache after migrate:fresh".
     */
public function run(): void
⋮----
Cache::flush();
⋮----
$this->call([
````

## File: database/seeders/DemoBusinessAccountSeeder.php
````php
namespace Database\Seeders;
⋮----
use App\Enums\UserRole;
use App\Models\BusinessAccount;
use App\Models\User;
use Illuminate\Database\Seeder;
⋮----
/**
 * Demo Business Buyer user + linked business_accounts row.
 * Requires RolePermissionSeeder to have run first (for the role to exist).
 */
class DemoBusinessAccountSeeder extends Seeder
⋮----
public function run(): void
⋮----
$buyer = User::query()->firstOrCreate(
⋮----
if (! $buyer->hasRole(UserRole::BusinessBuyer->value)) {
$buyer->addRole(UserRole::BusinessBuyer->value);
⋮----
BusinessAccount::query()->firstOrCreate(
````

## File: database/seeders/DemoCatalogSeeder.php
````php
namespace Database\Seeders;
⋮----
use App\Enums\MovementType;
use App\Enums\PriceListType;
use App\Models\Category;
use App\Models\PriceList;
use App\Models\Product;
use App\Models\StockLevel;
use App\Models\StockMovement;
use App\Models\Supplier;
use App\Models\Warehouse;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
⋮----
/**
 * Demo categories, suppliers, products, price lists, and opening stock.
 * Requires DemoWarehouseSeeder to have run first.
 *
 * Opening stock is recorded as `purchase_in` ledger rows (not just a
 * stock_levels insert), matching FR-7.5 / docs/project/canonical-decisions.md §6:
 * stock_levels is always a projection of stock_movements, never a
 * standalone source of truth.
 */
class DemoCatalogSeeder extends Seeder
⋮----
public function run(): void
⋮----
$electronics = Category::query()->firstOrCreate(
⋮----
$accessories = Category::query()->firstOrCreate(
⋮----
$supplier = Supplier::query()->firstOrCreate(
⋮----
])->map(fn (array $attributes) => [
⋮----
'product' => Product::query()->firstOrCreate(
⋮----
$retailPriceList = PriceList::query()->firstOrCreate(
⋮----
$tierPriceList = PriceList::query()->firstOrCreate(
⋮----
$retailPriceList->items()->firstOrCreate(
⋮----
$tierPriceList->items()->firstOrCreate(
⋮----
$warehouses = Warehouse::query()->get();
⋮----
if (StockLevel::query()
->where('product_id', $entry['product']->id)
->where('warehouse_id', $warehouse->id)
->exists()
⋮----
DB::transaction(function () use ($entry, $warehouse, $openingQuantity) {
StockMovement::query()->create([
⋮----
StockLevel::query()->create([
````

## File: database/seeders/DemoUserSeeder.php
````php
namespace Database\Seeders;
⋮----
use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
⋮----
/**
 * Creates a demo SuperAdmin account for local development/manual testing.
 * Requires RolePermissionSeeder to have run first.
 */
class DemoUserSeeder extends Seeder
⋮----
public function run(): void
⋮----
$superAdmin = User::query()->firstOrCreate(
⋮----
if (! $superAdmin->hasRole(UserRole::SuperAdmin->value)) {
$superAdmin->addRole(UserRole::SuperAdmin->value);
````

## File: database/seeders/DemoWarehouseSeeder.php
````php
namespace Database\Seeders;
⋮----
use App\Models\Warehouse;
use Illuminate\Database\Seeder;
⋮----
class DemoWarehouseSeeder extends Seeder
⋮----
/**
     * Run the database seeds.
     */
public function run(): void
⋮----
])->each(fn (array $attributes) => Warehouse::query()->firstOrCreate(
````

## File: database/seeders/RolePermissionSeeder.php
````php
namespace Database\Seeders;
⋮----
use App\Enums\PermissionName;
use App\Enums\UserRole;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
⋮----
/**
 * Seeds the six roles and full permission catalog from the Enterprise PRD §3
 * permission matrix, and wires each role to its permissions.
 *
 * Cells marked "own" / "team" / "self" in the PRD matrix still grant the base
 * permission to the role here — that scoping is enforced at the
 * controller/service layer (Policies for own/self, Laratrust teams for
 * warehouse-scoped "team" permissions), not by omitting the permission.
 * See docs/project/canonical-decisions.md §3.
 */
class RolePermissionSeeder extends Seeder
⋮----
/**
     * @var array<string, list<PermissionName>>
     */
⋮----
// SuperAdmin is granted every permission separately below.
⋮----
PermissionName::ProductManage,   // own price-list items only (Policy)
PermissionName::StockRead,       // own products only (Policy)
PermissionName::PricelistManage, // own price-list only (Policy)
⋮----
PermissionName::SaleCreate, // self (own orders only, via Policy)
⋮----
public function run(): void
⋮----
$permissions = collect(PermissionName::cases())->mapWithKeys(
⋮----
$permission->value => Permission::query()->firstOrCreate(
⋮----
['display_name' => $permission->label()]
⋮----
$roles = collect(UserRole::cases())->mapWithKeys(
⋮----
$role->value => Role::query()->firstOrCreate(
⋮----
['display_name' => $role->label(), 'description' => $role->description()]
⋮----
/** @var Role $superAdmin */
⋮----
$superAdmin->syncPermissions($permissions->values()->all());
⋮----
$roles[$roleName]->syncPermissions(
⋮----
->map(fn (PermissionName $permission) => $permissions[$permission->value])
->all()
````

## File: database/.gitignore
````
*.sqlite*
````

## File: docker/entrypoint.sh
````bash
#!/bin/sh
set -e

cd /var/www/html

# app, queue, and scheduler all boot from this same image/entrypoint and
# share both the bind-mounted project directory (.env) and the named
# `vendor` volume. Without a mutex, three concurrent `composer install`
# runs race on the same files and corrupt vendor/. `storage/app` is already
# gitignored, so use it as the lock location.
LOCK_DIR="storage/app/.docker-setup.lock"

attempt=0
while ! mkdir "$LOCK_DIR" 2>/dev/null; do
    attempt=$((attempt + 1))
    if [ -f vendor/autoload.php ] && [ -f .env ]; then
        break
    fi
    if [ "$attempt" -gt 150 ]; then
        echo "entrypoint: timed out waiting for setup lock at $LOCK_DIR" >&2
        break
    fi
    sleep 2
done

if [ ! -f .env ]; then
    cp .env.example .env
fi

if [ ! -f vendor/autoload.php ]; then
    composer install --no-interaction --prefer-dist
fi

if ! grep -q "^APP_KEY=base64" .env 2>/dev/null; then
    php artisan key:generate --ansi --force
fi

rmdir "$LOCK_DIR" 2>/dev/null || true

exec "$@"
````

## File: docker/php.ini
````ini
; StockFlow local development overrides. Not tuned for production.

memory_limit = 512M
upload_max_filesize = 64M
post_max_size = 64M
max_execution_time = 120
max_input_time = 120

; Excel import (FR-7.x) involves multi-row files; give the CLI/worker room.
max_input_vars = 5000

; Dev-friendly error visibility. APP_DEBUG in .env still governs Laravel's
; own error pages; this only controls raw PHP-level errors/warnings.
display_errors = On
error_reporting = E_ALL

; Opcache: validate timestamps every request so edited files are picked up
; immediately without a container restart. Do not use in production.
opcache.enable = 1
opcache.validate_timestamps = 1
opcache.revalidate_freq = 0

date.timezone = UTC
````

## File: docs/technical/cache.md
````markdown
# Cache keys and invalidation

StockFlow uses Redis (`CACHE_STORE=redis`, tag-capable) for three independent caches.
Each has its own tag, its own TTL, and its own invalidation trigger — they never share
a tag, so flushing one never affects another.

| Tag | Owner | TTL | Invalidation |
| --- | --- | --- | --- |
| `catalog` | `CatalogService` | 3600s (1h) | Flushed on **every** catalog write (product/category/supplier/price-list create/update/delete) |
| `stock-levels` | `StockService` | 30s | Flushed on **every** stock movement (any of `purchaseIn`/`reserve`/`release`/`confirmSale`/`transfer`/`adjust`) |
| — (Laratrust internal) | Laratrust package | package default (1 day) | Flushed automatically by Laratrust on role/permission assignment changes |
| `dashboard:kpis:*` | `DashboardService` | 60s | Time-based only — no write-triggered flush (see below) |

## `catalog` — CatalogService

**Keys**: `catalog:{entity}:{md5(json_encode($parts))}`, e.g.
`catalog:products:<hash of [page, perPage, filters]>`, `catalog:categories:flat`,
`catalog:retail_price:<hash of [productId, quantity]>`.

**Read side** (`app/Services/CatalogService.php`): every list/lookup method wraps its
repository call in `Cache::tags(['catalog'])->remember($key, 3600, ...)`.

**Write side**: every mutating method (`createProduct`, `updateProduct`,
`deleteProduct`, `createCategory`, `deleteCategory`, `createSupplier`,
`deleteSupplier`, `createPriceList`, `createPriceListItem`, `updatePriceListItem`,
`deletePriceListItem`) calls `Cache::tags(['catalog'])->flush()` immediately after
the write, inside the same method (not deferred, not queued).

**Why flush-the-whole-tag instead of busting individual keys**: products, categories,
and price lists all influence each other's listings (a category rename changes what
shows in the product filter dropdown, a new price list item changes
`retailPriceFor()`'s result for that product, etc.). Cache keys are also
paginated/filtered (page number + arbitrary filter combinations are part of the key),
so there's no small, enumerable set of keys to bust individually — a full tag flush is
both simpler and correct. Given `catalog.read` traffic vastly outnumbers
`product.manage`/`category.manage`/`pricelist.manage` writes, this trade is cheap.

**Tested by**: `tests/Feature/Catalog/CatalogCacheTest.php` — cache invalidates on
product create, product update, category create, price-list create, and a dedicated
test that round-trips through *real* Redis (not the test suite's default `array`
driver) to catch serialization bugs the array driver can't.

## `stock-levels` — StockService::listLevels()

**Keys**: `stock:levels:{md5(json_encode([page, perPage, filters]))}`.

**Read side**: only `StockService::listLevels()` (the Stock/Levels report page) is
cached. TTL is deliberately short (30s, vs. catalog's 1h) — flush-on-write is the
primary invalidation mechanism; the TTL is just a backstop against a future write path
that forgets to flush.

**Write side**: `StockService::recordMovement()` — the single private method every
mutating method (`purchaseIn`, `reserve`, `release`, `confirmSale`, `transfer`,
`adjust`) funnels through to append a `stock_movements` row — calls
`Cache::tags(['stock-levels'])->flush()` right after the insert. Because every
mutation goes through this one choke point, there's no per-method flush call to
forget to add when a new mutation type is introduced.

**What is *never* cached, and why** — this is the "carefully" in "cached carefully":

- `findLevel()`, `lockLevelForUpdate()`, `lockOrCreateLevel()` — these back every
  stock mutation's row lock. Caching a value that's about to be checked against a
  `lockForUpdate()`'d row would defeat the whole no-oversell guarantee; the lock
  itself already serializes concurrent access, so there's nothing to gain from
  caching and everything to lose from staleness.
- `bestWarehouseFor()` (via `levelsForProductOrderedByAvailability()`) — a
  B2C/B2B fulfillment *placement heuristic*. It's cheap (single indexed query) and
  feeds directly into which warehouse gets a reservation attempt; a stale result
  could pick an already-empty warehouse. `reserve()` re-validates under lock
  regardless, so this wouldn't cause an oversell, but it would produce confusing
  "picked the wrong warehouse" behavior for no real performance benefit.
- `reconcile()`'s `allLevels()`/`ledgerTotals()` — reconciliation exists specifically
  to *prove* `stock_levels` matches the ledger. Caching either side of that proof
  would make `stock:reconcile` capable of reporting a false pass.

**Tested by**: `tests/Feature/Stock/StockLevelCacheTest.php` — cache invalidates
after a plain movement (`purchaseIn`) and after an adjustment
(`POST /stock/adjustments`).

## Laratrust permission cache

Laratrust (the roles/permissions package) maintains its own Redis-backed cache,
independent of the two above, keyed per-user (`laratrust_roles_for_users_{id}`) and
per-role. It self-invalidates on every mutation of the underlying pivot data —
`User::addRole()`/`removeRole()`/`syncRoles()` and `Role::addPermission()`/
`removePermission()`/`syncPermissions()` all call `flushCache()` internally as part
of the same method call, before returning. `RoleAssignmentService::syncRoles()` and
`RolePermissionService::syncPermissions()` (this app's own wrappers, which also
record an audit-log entry) don't need to do anything extra — the flush already
happened by the time those methods return.

**Tested by**:
`tests/Feature/Admin/AuthorizationTest.php::test_permission_cache_flushes_after_role_change`
(user role assignment) and
`tests/Feature/Admin/RolePermissionManagementTest.php::test_a_users_permissions_reflect_updated_role_permissions_immediately`
(role permission set changes).

### ⚠️ Known failure mode: stale Laratrust cache after `migrate:fresh`

`migrate:fresh` drops and recreates every table, which resets bigint auto-increment
IDs (`users`, `roles`, `permissions` — see the UUID-deviation note in `CLAUDE.md`)
back to 1. **`migrate:fresh` does not touch Redis.** If a previous seeding pass
cached "user #1 has no roles" (e.g. because something checked permissions for a
plain customer that happened to get ID 1), and a fresh reset+reseed hands ID 1 to
the new SuperAdmin, that stale negative cache entry is served to the new user —
they look completely unauthorized (can't open `/admin/users`, `/admin/roles`,
anything gated by a permission) even though the `role_user` pivot table is correct.

**Fix**: `DatabaseSeeder::run()` calls `Cache::flush()` before seeding anything, so
every `db:seed` (including as part of `migrate:fresh --seed`) starts from a clean
cache regardless of how it was invoked. `make fresh` additionally runs
`php artisan cache:clear` as a second layer of defense for the
`migrate:fresh` (no `--seed`) + separate `db:seed` two-step flow.

If you ever see a freshly-seeded user failing permission checks that look
correct in the database, this is almost always the cause — run
`php artisan cache:clear` before assuming it's a code bug (this is also
documented as a general gotcha in `CLAUDE.md`).

**Regression test**: `tests/Feature/Admin/SeededSuperAdminAccessTest.php` — poisons
the cache for user ID 1 *before* seeding, then asserts the seeded SuperAdmin (which
gets ID 1) can still reach `/admin/users` and `/admin/roles`.

## `dashboard:kpis:*` — DashboardService

**Keys**: `dashboard:kpis:staff` (one shared entry for every staff viewer) or
`dashboard:kpis:business_account:{id}` (one per Business Buyer).

Cached for 60 seconds with no write-triggered flush at all — this is a deliberate
difference from the other two caches. Dashboard KPIs (low-stock count, pending
approvals, today's sales, etc.) change on essentially every write across the whole
app (every order, every stock movement, every payment); wiring a flush into all of
those call sites would mean touching every write path in the system for a page
that's read-only and not correctness-critical. A dashboard that's accurate "as of
the last minute" is an acceptable trade StockFlow makes deliberately; nothing that
reads `stock_levels`/`orders`/`payments` directly for a business decision (checkout,
approval, settlement) ever goes through this cache.

## Local commands

```bash
# Clear everything (all tags, all keys) — safe, always correct, just slower on the next request:
docker compose exec app php artisan cache:clear

# Flush just one tag from tinker, if you want to leave the others warm:
docker compose exec app php artisan tinker --execute="Cache::tags(['catalog'])->flush();"
docker compose exec app php artisan tinker --execute="Cache::tags(['stock-levels'])->flush();"

# Inspect what's actually in Redis:
docker compose exec app php artisan tinker --execute="print_r(app('redis')->connection('cache')->keys('*'));"
```
````

## File: docs/technical/indexing.md
````markdown
# Indexing and hot queries

All `EXPLAIN` output below was run against the real `stockflow` MySQL 8 dev
database (`docker compose exec app php artisan tinker`), not SQLite — the test
suite's default connection doesn't have real B-tree/FULLTEXT index selection
behavior to validate against (see `CLAUDE.md`'s gotcha on this). Row counts are
small (demo-seed scale), so `rows` estimates below are not representative of
production volume — what matters is `type`/`key`, i.e. whether the optimizer
*can* use an index at all, not how many rows it currently scans.

## Index inventory

| Table | Index | Columns | Serves |
| --- | --- | --- | --- |
| `stock_movements` | `stock_movements_product_id_warehouse_id_created_at_index` | `(product_id, warehouse_id, created_at)` | Ledger lookups for one (product, warehouse) pair ordered by time — `StockRepository::movementsFor()`, the Stock Movement report, `reconcile()`'s per-pair math |
| `stock_movements` | `stock_movements_type_index` | `(type)` | Movement-type filter on the Stock Movement report |
| `stock_movements` | `stock_movements_reference_type_reference_id_index` | `(reference_type, reference_id)` | Looking up every movement caused by one Order/PurchaseOrder |
| `stock_levels` | `stock_levels_product_id_warehouse_id_unique` | `(product_id, warehouse_id)` UNIQUE | The row every stock mutation locks (`lockForUpdate()`/`lockOrCreateLevel()`) — this is *the* hot-path index in the whole schema |
| `orders` | `orders_status_created_at_index` | `(status, created_at)` | Sales report status + date-range filter, `expiredReservations()` |
| `payments` | `payments_status_created_at_index` | `(status, created_at)` | Payments report status + date-range filter |
| `payments` | `payments_method_index` | `(method)` | Payments report method filter |
| `payments` | `payments_gateway_ref_unique` | `(gateway_ref)` UNIQUE | Webhook idempotency (`findByGatewayRef()`) — dedupes duplicate provider callbacks |
| `import_batches` | `import_batches_status_created_at_index` | `(status, created_at)` | Import History report status + date-range filter |
| `activity_log` | `activity_log_causer_id_created_at_index` | `(causer_id, created_at)` | Audit Log report user + date-range filter |
| `activity_log` | `activity_log_event_index` | `(event)` | Audit Log report event filter |
| `activity_log` | `activity_log_subject_type_subject_id_index` | `(subject_type, subject_id)` | Looking up every audit entry about one record |
| `products` | `products_name_fulltext` | FULLTEXT `(name)` | Product search |
| `products` | `products_sku_unique` | `(sku)` UNIQUE | SKU lookups, Excel import upserts |
| `teams` | `teams_warehouse_id_unique` | `(warehouse_id)` UNIQUE | Warehouse ↔ Laratrust team mapping (`WarehouseAccess`) |

Every `foreignId`/`foreignUuid()` column also gets Laravel's automatic
single-column index for the FK itself (visible as `*_foreign` in `SHOW INDEX`) —
not listed individually above, but present on `order_items.product_id`,
`order_items.warehouse_id`, `po_items.product_id`, `po_items.warehouse_id`, etc.

## Hot query EXPLAIN plans

### 1. Stock ledger lookup for one (product, warehouse) pair

```sql
SELECT * FROM stock_movements
WHERE product_id = ? AND warehouse_id = ?
ORDER BY created_at DESC;
```

```
type: ref | key: stock_movements_product_id_warehouse_id_created_at_index
key_len: 288 | ref: const,const | Extra: Backward index scan
```

Index seek on the leading two columns, and the trailing `created_at` column
satisfies the `ORDER BY` without a filesort (`Backward index scan` — MySQL walks
the index in reverse instead of sorting).

### 2. Stock level row lock (the reservation/confirm/release/adjust hot path)

```sql
SELECT * FROM stock_levels
WHERE product_id = ? AND warehouse_id = ?
FOR UPDATE;
```

```
type: const | key: stock_levels_product_id_warehouse_id_unique
key_len: 288 | ref: const,const
```

`type: const` — the unique index guarantees at most one matching row, so MySQL
treats this as a constant lookup. This is the single most important index in the
schema: every `StockService` mutation (`reserve`, `release`, `confirmSale`,
`transfer`, `adjust`, `purchaseIn`) locks through this exact index, under real
concurrency (proven by `tests/Feature/Stock/StockConcurrencyTest.php`).

### 3. Sales report — status filter, newest first

```sql
SELECT * FROM orders WHERE status = ? ORDER BY created_at DESC LIMIT 20;
```

```
type: ref | key: orders_status_created_at_index
key_len: 1 | ref: const | Extra: Backward index scan
```

### 4. Payments report — status + date range, newest first

```sql
SELECT * FROM payments
WHERE status = ? AND created_at >= ?
ORDER BY created_at DESC LIMIT 20;
```

```
type: range | key: payments_status_created_at_index
Extra: Using index condition; Backward index scan
```

### 5. Import History report — status filter, newest first

```sql
SELECT * FROM import_batches WHERE status = ? ORDER BY created_at DESC LIMIT 20;
```

```
type: ref | key: import_batches_status_created_at_index
Extra: Backward index scan
```

### 6. Audit Log report — user filter, newest first

```sql
SELECT * FROM activity_log WHERE causer_id = ? ORDER BY created_at DESC LIMIT 20;
```

```
type: ref | key: activity_log_causer_id_created_at_index
Extra: Backward index scan
```

### 7. Product search

```sql
SELECT * FROM products WHERE MATCH(name) AGAINST(? IN NATURAL LANGUAGE MODE);
```

```
type: fulltext | key: products_name_fulltext
```

### 8. Low Stock report — **the one query that can't use an index**

```sql
SELECT product_id, warehouse_id, (on_hand - reserved) AS available
FROM stock_levels
WHERE (on_hand - reserved) <= ?;
```

```
type: ALL | key: (none) | Extra: Using where
```

`on_hand - reserved` is a computed expression, not a stored column — no plain
B-tree index can serve an inequality on it (MySQL 8 supports functional indexes
on a stored generated column, which would fix this, but `available` is
deliberately *never* a stored column anywhere in this schema — see
`docs/project/canonical-decisions.md` §6, "`available` is always computed, never
stored"). This is a **deliberate, accepted trade-off**: `stock_levels` has one
row per `(product, warehouse)` pair — hundreds to low thousands of rows even at
a large multi-warehouse catalog's scale, not millions — so a full table scan
here is cheap in absolute terms even though `EXPLAIN` shows `type: ALL`. Do not
"fix" this by adding a stored/generated `available` column without an explicit
decision — it would violate the ledger-is-truth invariant that
`stock_levels` is a projection, not a place additional derived state lives.

## Verifying after a schema change

```bash
# Open a MySQL shell against the same DB the app uses:
docker compose exec app php artisan tinker

# Then, in tinker:
DB::select('EXPLAIN SELECT ...');

# Or list every index on a table directly:
DB::select('SHOW INDEX FROM stock_movements');
```

`tests/Feature/Schema/DatabaseSchemaTest.php` (real MySQL, not SQLite) asserts
the unique/FULLTEXT constraints this document describes actually exist —
re-run it after any migration that touches an indexed column:

```bash
docker compose exec app php artisan test --filter=DatabaseSchemaTest
```
````

## File: lang/en/auth.php
````php
/*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. Deliberately generic —
    | it must not reveal whether the email or the password was wrong.
    |
    */
````

## File: public/.htaccess
````
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Handle X-XSRF-Token Header
    RewriteCond %{HTTP:x-xsrf-token} .
    RewriteRule .* - [E=HTTP_X_XSRF_TOKEN:%{HTTP:X-XSRF-Token}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
````

## File: public/index.php
````php
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
⋮----
// Determine if the application is in maintenance mode...
⋮----
// Register the Composer autoloader...
⋮----
// Bootstrap Laravel and handle the request...
/** @var Application $app */
⋮----
$app->handleRequest(Request::capture());
````

## File: public/robots.txt
````
User-agent: *
Disallow:
````

## File: resources/css/app.css
````css
@source '../../vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php';
⋮----
@theme {
````

## File: resources/js/Components/AddToCartButton.jsx
````javascript
/**
 * Posts to POST /cart/items — guest-accessible, never reserves stock (see
 * CartService's docblock). `canAddToCart` mirrors StorefrontCatalogService::
 * presentProduct()'s `can_add_to_cart` (false once stock_status is
 * out_of_stock) — server-side CartService::add() is the real gate; this is
 * just avoiding a pointless round trip for an obviously-blocked action.
 */
export default function AddToCartButton(
⋮----
function addToCart(event)
⋮----
````

## File: resources/js/Components/Breadcrumbs.jsx
````javascript
/**
 * items: [{ label: string, href?: string }] — the last item (no href) renders as plain text.
 */
export default function Breadcrumbs(
````

## File: resources/js/Components/Button.jsx
````javascript
export default function Button({
    as: Component = 'button',
    type = 'button',
    variant = 'primary',
    className = '',
    disabled = false,
    children,
    ...props
})
````

## File: resources/js/Components/CartSummary.jsx
````javascript
/**
 * Server-computed totals only (Controller rule #4 — totals are never
 * computed client-side). `checkoutHref` defaults to /checkout, which is
 * gated by `checkout.guard` — a guest clicking through gets redirected to
 * /login with the "Please log in to complete your order." flash message.
 */
export default function CartSummary(
````

## File: resources/js/Components/CategoryNav.jsx
````javascript
/**
 * Top-level categories with their children — expects the tree shape
 * produced by CategoryRepository::allWithChildren() (shared globally as
 * the `publicCategories` Inertia prop).
 */
export default function CategoryNav(
````

## File: resources/js/Components/FlashMessage.jsx
````javascript
export default function FlashMessage()
````

## File: resources/js/Components/Input.jsx
````javascript

````

## File: resources/js/Components/Pagination.jsx
````javascript
/**
 * Expects the `links` array shape produced by Laravel's paginator
 * (e.g. `$paginator->linkCollection()` / the `links` meta on an API resource):
 * [{ url: string|null, label: string, active: boolean }]
 */
export default function Pagination(
````

## File: resources/js/Components/PermissionGate.jsx
````javascript
/**
 * Client-side visibility helper only — this is cosmetic, not a security boundary.
 * The server (route middleware / policies) always re-enforces authorization;
 * see docs/project/canonical-decisions.md.
 *
 * Usage:
 *   <PermissionGate permission="stock.move">...</PermissionGate>
 *   <PermissionGate role="SuperAdmin">...</PermissionGate>
 *   <PermissionGate any={['stock.move', 'stock.transfer']}>...</PermissionGate>
 */
export default function PermissionGate(
````

## File: resources/js/Components/PriceLabel.jsx
````javascript
/**
 * Formats the retail unit price string StorefrontCatalogService::
 * presentProduct() returns (a decimal string, e.g. "100.00", or null if no
 * active retail price is configured for the product).
 */
export default function PriceLabel(
````

## File: resources/js/Components/ProductCard.jsx
````javascript
/**
 * Expects the public-safe product payload from
 * StorefrontCatalogService::presentProduct().
 */
export default function ProductCard(
````

## File: resources/js/Components/QuantitySelector.jsx
````javascript
/**
 * Plain number input clamped to >= 1 client-side; the server re-validates
 * (`quantity: min:1` on AddToCartRequest / `min:0` on UpdateCartItemRequest)
 * regardless, so this is a UX convenience, not the authoritative check.
 */
export default function QuantitySelector(
````

## File: resources/js/Components/Select.jsx
````javascript

````

## File: resources/js/Components/StockBadge.jsx
````javascript
/**
 * Public stock label only — never renders an exact quantity. Expects the
 * `stock_status`/`stock_label` pair produced by
 * StorefrontCatalogService::presentProduct() (StockAvailabilityService's
 * in_stock/low_stock/out_of_stock vocabulary).
 */
export default function StockBadge(
````

## File: resources/js/Components/Table.jsx
````javascript
export default function Table(
````

## File: resources/js/Layouts/AppLayout.jsx
````javascript
export default function AppLayout(
⋮----
function handleLogout(event)
````

## File: resources/js/Layouts/GuestLayout.jsx
````javascript
export default function GuestLayout(
````

## File: resources/js/Layouts/StorefrontLayout.jsx
````javascript
/**
 * Public storefront shell — used by every guest-accessible page (Home,
 * Products, Categories, Search, Cart). Unlike AppLayout, this never
 * assumes an authenticated user: the header shows Login/Register for a
 * guest and a "Log out" + "My orders" link once authenticated, and never
 * hides the storefront itself behind a permission check.
 */
export default function StorefrontLayout(
⋮----
function handleLogout(event)
⋮----
function handleSearch(event)
````

## File: resources/js/Pages/Admin/AuditLog/Index.jsx
````javascript
export default function Index(
⋮----
function applyFilters(e)
⋮----

⋮----
render: (row)
````

## File: resources/js/Pages/Admin/Permissions/Matrix.jsx
````javascript
export default function Matrix(
````

## File: resources/js/Pages/Admin/Roles/Index.jsx
````javascript
export default function Index(
⋮----
function toggleExpand(role)
⋮----
function togglePermission(name)
⋮----
function save(role)
⋮----
onFinish: ()
onSuccess: ()
````

## File: resources/js/Pages/Admin/Users/Edit.jsx
````javascript
export default function Edit(
⋮----
function toggleRole(roleName)
⋮----
function submit(event)
````

## File: resources/js/Pages/Admin/Users/Index.jsx
````javascript
export default function Index(
⋮----
render: (row)
````

## File: resources/js/Pages/Auth/Login.jsx
````javascript
export default function Login()
⋮----
function submit(event)
⋮----
onFinish: ()
````

## File: resources/js/Pages/Catalog/Categories/Index.jsx
````javascript
export default function Index(
⋮----
function submit(event)
⋮----
post('/catalog/categories',
⋮----
function destroy(category)
````

## File: resources/js/Pages/Catalog/PriceLists/Index.jsx
````javascript
function AddItemForm(
⋮----
function submit(event)
⋮----
post(`/catalog/price-lists/$
⋮----
function ItemRow(
⋮----
function save(event)
⋮----
function destroy()
⋮----
export default function Index(
⋮----
post('/catalog/price-lists',
````

## File: resources/js/Pages/Catalog/Products/Create.jsx
````javascript
export default function Create(
⋮----
function submit(event)
````

## File: resources/js/Pages/Catalog/Products/Edit.jsx
````javascript
export default function Edit(
⋮----
function submit(event)
````

## File: resources/js/Pages/Catalog/Products/Index.jsx
````javascript
export default function Index(
⋮----
function applyFilters(event)
⋮----
render: (row)
⋮----
````

## File: resources/js/Pages/Catalog/Products/Show.jsx
````javascript
export default function Show(
⋮----
function destroy()
⋮----
function addToCart(event)
````

## File: resources/js/Pages/Catalog/Suppliers/Index.jsx
````javascript
export default function Index(
⋮----
function submit(event)
⋮----
post('/catalog/suppliers',
⋮----
function destroy(supplier)
⋮----

⋮----
render: (row)
````

## File: resources/js/Pages/Errors/Forbidden.jsx
````javascript
export default function Forbidden()
````

## File: resources/js/Pages/Errors/NotFound.jsx
````javascript
export default function NotFound()
````

## File: resources/js/Pages/Import/Create.jsx
````javascript
export default function Create(
⋮----
function submit(event)
````

## File: resources/js/Pages/Import/ErrorReport.jsx
````javascript
function Payload(
⋮----
export default function ErrorReport(
⋮----
````

## File: resources/js/Pages/Import/Index.jsx
````javascript
function statusClass(status)
⋮----
export default function Index(
⋮----
render: (row)
⋮----

⋮----
render: (row) => `$
````

## File: resources/js/Pages/Import/Show.jsx
````javascript
function statusClass(status)
⋮----
function Payload(
⋮----
export default function Show(
⋮----
render: (row)
⋮----
````

## File: resources/js/Pages/Payments/BankTransferReview.jsx
````javascript
export default function BankTransferReview(
⋮----
function submit(event)
````

## File: resources/js/Pages/Payments/FakeGateway.jsx
````javascript
export default function FakeGateway(
⋮----
function submit(event)
````

## File: resources/js/Pages/Payments/Index.jsx
````javascript
export default function Index(
⋮----
render: (row)
````

## File: resources/js/Pages/Payments/Show.jsx
````javascript
export default function Show(
⋮----
function settle()
⋮----
function Field(
````

## File: resources/js/Pages/Procurement/PurchaseOrders/Approve.jsx
````javascript
export default function Approve(
⋮----
function approve(event)
⋮----
function reject(event)
````

## File: resources/js/Pages/Procurement/PurchaseOrders/BankTransferSettlement.jsx
````javascript
export default function BankTransferSettlement(
⋮----
function submit(event)
````

## File: resources/js/Pages/Procurement/PurchaseOrders/Index.jsx
````javascript
export default function Index(
⋮----
render: (row)
⋮----
````

## File: resources/js/Pages/Procurement/PurchaseOrders/Show.jsx
````javascript
export default function Show(
⋮----
function close()
⋮----
````

## File: resources/js/Pages/Procurement/Quotes/Create.jsx
````javascript
export default function Create(
⋮----
function updateLine(index, field, value)
⋮----
function addLine()
⋮----
function removeLine(index)
⋮----
function submit(event)
````

## File: resources/js/Pages/Procurement/Quotes/Index.jsx
````javascript
export default function Index(
⋮----
render: (row)
⋮----
````

## File: resources/js/Pages/Procurement/Quotes/Price.jsx
````javascript
export default function Price(
⋮----
function submit(event)
````

## File: resources/js/Pages/Procurement/Quotes/Show.jsx
````javascript
export default function Show(
⋮----
function accept()
⋮----
function reject()
⋮----
````

## File: resources/js/Pages/Reports/Imports.jsx
````javascript
export default function Imports(
⋮----
function applyFilters(e)
⋮----
render: (row)
⋮----
````

## File: resources/js/Pages/Reports/LowStock.jsx
````javascript
export default function LowStock(
⋮----
function applyFilters(e)
⋮----

⋮----
render: (row) => <span className="font-semibold text-red-600">
````

## File: resources/js/Pages/Reports/Payments.jsx
````javascript
export default function Payments(
⋮----
function applyFilters(e)
⋮----
````

## File: resources/js/Pages/Reports/Sales.jsx
````javascript
export default function Sales(
⋮----
function applyFilters(e)
⋮----
````

## File: resources/js/Pages/Reports/StockMovements.jsx
````javascript
export default function StockMovements(
⋮----
function applyFilters(e)
⋮----

⋮----
render: (row)
````

## File: resources/js/Pages/Sales/Checkout/Create.jsx
````javascript
export default function Create(
⋮----
function submit(event)
⋮----
````

## File: resources/js/Pages/Sales/Orders/Index.jsx
````javascript
export default function Index(
⋮----
render: (row)
⋮----
````

## File: resources/js/Pages/Sales/Orders/Show.jsx
````javascript
export default function Show(
⋮----
function fulfill()
⋮----

⋮----
render: (row)
````

## File: resources/js/Pages/Sales/Payments/Show.jsx
````javascript
export default function Show(
⋮----
function settle()
````

## File: resources/js/Pages/Stock/Adjustments/Create.jsx
````javascript
export default function Create(
⋮----
function submit(event)
````

## File: resources/js/Pages/Stock/Levels/Index.jsx
````javascript
export default function Index(
⋮----
function applyFilters(event)
⋮----

⋮----
render: (row)
````

## File: resources/js/Pages/Stock/Movements/Index.jsx
````javascript
export default function Index(
⋮----
function applyFilters(event)
⋮----

⋮----
render: (row)
````

## File: resources/js/Pages/Stock/Reconciliation/Show.jsx
````javascript
export default function Show(
⋮----
function applyFilters(event)
⋮----
function runReconciliation()
⋮----
onStart: ()
onFinish: ()
⋮----
render: (row)
````

## File: resources/js/Pages/Stock/Transfers/Create.jsx
````javascript
export default function Create(
⋮----
function submit(event)
````

## File: resources/js/Pages/Storefront/Cart/Show.jsx
````javascript
export default function Show(
⋮----
function updateQuantity(productId, quantity)
⋮----
function remove(productId)
⋮----
function clearCart()
⋮----

⋮----
render: (row)
````

## File: resources/js/Pages/Storefront/Categories/Show.jsx
````javascript
export default function Show(
⋮----
function applyFilters(event)
````

## File: resources/js/Pages/Storefront/Products/Index.jsx
````javascript
export default function Index(
⋮----
function applyFilters(event)
````

## File: resources/js/Pages/Storefront/Products/Show.jsx
````javascript
export default function Show(
````

## File: resources/js/Pages/Storefront/Home.jsx
````javascript
export default function Home(
````

## File: resources/js/Pages/Storefront/Search.jsx
````javascript
export default function Search(
⋮----
function submit(event)
````

## File: resources/js/Pages/Dashboard.jsx
````javascript
function Card(
⋮----
function QuickLink(
⋮----
export default function Dashboard(
````

## File: resources/js/app.jsx
````javascript
title: (title) => (title ? `$
resolve: (name)
setup(
⋮----
function resolvePage(name)
````

## File: resources/views/vendor/laratrust/panel/permissions/index.blade.php
````php

````

## File: resources/views/vendor/laratrust/panel/roles/index.blade.php
````php

````

## File: resources/views/vendor/laratrust/panel/roles/show.blade.php
````php

````

## File: resources/views/vendor/laratrust/panel/roles-assignment/edit.blade.php
````php

````

## File: resources/views/vendor/laratrust/panel/roles-assignment/index.blade.php
````php

````

## File: resources/views/vendor/laratrust/panel/edit.blade.php
````php

````

## File: resources/views/vendor/laratrust/panel/layout.blade.php
````php

````

## File: resources/views/vendor/laratrust/panel/pagination.blade.php
````php

````

## File: resources/views/app.blade.php
````php

````

## File: routes/api.php
````php
use App\Http\Controllers\Api\V1\CatalogController;
use App\Http\Controllers\Api\V1\PaymentController;
use App\Http\Controllers\Api\V1\PurchaseOrderController;
use App\Http\Controllers\Api\V1\QuoteController;
use App\Http\Controllers\Api\V1\StockAvailabilityController;
use Illuminate\Support\Facades\Route;
⋮----
Route::prefix('v1')
->middleware(['api.json', 'api.client-principal', 'auth:api', 'throttle:api'])
->group(function () {
Route::get('/catalog/products', [CatalogController::class, 'products'])
->middleware(['scope:catalog:read', 'permission:catalog.read,guard:api']);
⋮----
Route::get('/stock/availability', StockAvailabilityController::class)
->middleware(['scope:stock:read', 'permission:stock.read,guard:api']);
⋮----
Route::prefix('b2b')->group(function () {
Route::get('/quotes', [QuoteController::class, 'index'])
->middleware(['scope:orders:write', 'permission:quote.request|quote.price|po.approve,guard:api']);
Route::post('/quotes', [QuoteController::class, 'store'])
->middleware(['scope:orders:write', 'permission:quote.request,guard:api']);
⋮----
Route::get('/purchase-orders', [PurchaseOrderController::class, 'index'])
->middleware(['scope:orders:write', 'permission:quote.request|po.approve|payment.settle,guard:api']);
Route::post('/purchase-orders/{purchaseOrder}/accept', [PurchaseOrderController::class, 'accept'])
⋮----
Route::get('/payments', [PaymentController::class, 'index'])
->middleware(['scope:payments:write', 'permission:quote.request|payment.settle,guard:api']);
Route::post('/payments/bank-transfer-proof', [PaymentController::class, 'bankTransferProof'])
````

## File: routes/console.php
````php
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
⋮----
Artisan::command('inspire', function () {
$this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
⋮----
// Releases abandoned B2C checkout reservations — see
// App\Console\Commands\StockReleaseExpiredReservationsCommand.
Schedule::command('stock:release-expired-reservations')->everyMinute();
````

## File: routes/web.php
````php
use App\Http\Controllers\Web\Admin\AuditLogController;
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
use Illuminate\Support\Facades\Route;
⋮----
/*
|--------------------------------------------------------------------------
| Web Routes (Inertia)
|--------------------------------------------------------------------------
|
| Human UI only. Session auth via the `web` guard. No API routes belong
| here — see docs/project/canonical-decisions.md.
|
*/
⋮----
// Public storefront: no `auth`, no `permission` middleware anywhere in this
// section — guests must reach all of it with no login (see Guest rules
// #1-#7 in the storefront requirements). Staff/business users still reach
// `/dashboard` explicitly (post-login redirect target); `/` itself is the
// storefront for everyone, guest or authenticated.
Route::get('/', HomeController::class)->name('home');
Route::get('/products', [ProductBrowseController::class, 'index'])->name('storefront.products.index');
Route::get('/products/{sku}', [ProductBrowseController::class, 'show'])->name('storefront.products.show');
Route::get('/categories/{category:slug}', [CategoryBrowseController::class, 'show'])->name('storefront.categories.show');
Route::get('/search', [SearchController::class, 'index'])->name('storefront.search');
⋮----
// Session cart: also guest-accessible (Guest rules #8-#11). Never reserves
// stock or writes anything but the session — see CartService's docblock.
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::middleware('throttle:cart')->group(function () {
Route::post('/cart/items', [CartController::class, 'store'])->name('cart.items.store');
Route::patch('/cart/items/{item}', [CartController::class, 'update'])->name('cart.items.update');
Route::delete('/cart/items/{item}', [CartController::class, 'destroy'])->name('cart.items.destroy');
Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');
⋮----
// Checkout entry gate: `checkout.guard` redirects an unauthenticated
// visitor to /login with a specific flash message (Guest rule #18) before
// CheckoutController (and its own `sale.create` OrderPolicy check) ever
// runs — see EnsureCheckoutIsAuthenticated's docblock for why this is a
// middleware rather than a wrapper controller.
Route::middleware('checkout.guard')->group(function () {
Route::get('/checkout', [CheckoutController::class, 'create'])->name('checkout.create');
Route::post('/checkout', [CheckoutController::class, 'store'])
->name('checkout.store')->middleware('throttle:checkout');
⋮----
Route::middleware('guest')->group(function () {
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->middleware('throttle:login');
⋮----
Route::middleware('auth')->group(function () {
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
⋮----
Route::get('/dashboard', DashboardController::class)->name('dashboard');
⋮----
Route::prefix('admin')->name('admin.')->group(function () {
Route::middleware('permission:user.manage')->group(function () {
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{user}/roles', [UserController::class, 'editRoles'])->name('users.edit-roles');
⋮----
Route::put('/users/{user}/roles', [UserController::class, 'updateRoles'])
->name('users.update-roles')
->middleware('permission:role.manage');
⋮----
Route::middleware('permission:role.manage')->group(function () {
Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
Route::put('/roles/{role}/permissions', [RoleController::class, 'updatePermissions'])
->name('roles.update-permissions');
Route::get('/permissions/matrix', [PermissionMatrixController::class, 'index'])->name('permissions.matrix');
⋮----
Route::get('/audit-log', [AuditLogController::class, 'index'])
->name('audit-log.index')->middleware('permission:audit.read');
⋮----
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
⋮----
Route::get('/categories', [CategoryController::class, 'index'])
->name('categories.index')->middleware('permission:catalog.read');
Route::post('/categories', [CategoryController::class, 'store'])
->name('categories.store')->middleware('permission:category.manage');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
->name('categories.destroy')->middleware('permission:category.manage');
⋮----
Route::get('/suppliers', [SupplierController::class, 'index'])
->name('suppliers.index')->middleware('permission:catalog.read');
Route::post('/suppliers', [SupplierController::class, 'store'])
->name('suppliers.store')->middleware('permission:product.manage');
Route::delete('/suppliers/{supplier}', [SupplierController::class, 'destroy'])
->name('suppliers.destroy')->middleware('permission:product.manage');
⋮----
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
⋮----
Route::prefix('stock')->name('stock.')->group(function () {
Route::get('/levels', [StockLevelController::class, 'index'])
->name('levels.index')->middleware('permission:stock.read');
⋮----
Route::get('/movements', [StockMovementController::class, 'index'])
->name('movements.index')->middleware('permission:stock.read');
⋮----
// Route order matters: /adjustments/create must be registered
// before a wildcard could ever be added under /adjustments.
Route::get('/adjustments/create', [StockAdjustmentController::class, 'create'])
->name('adjustments.create')->middleware('permission:stock.move');
Route::post('/adjustments', [StockAdjustmentController::class, 'store'])
->name('adjustments.store')->middleware(['permission:stock.move', 'warehouse.scope:stock.move']);
⋮----
Route::get('/transfers/create', [StockTransferController::class, 'create'])
->name('transfers.create')->middleware('permission:stock.transfer');
Route::post('/transfers', [StockTransferController::class, 'store'])
->name('transfers.store')->middleware(['permission:stock.transfer', 'warehouse.scope:stock.transfer']);
⋮----
Route::get('/reconcile', [StockReconciliationController::class, 'show'])
->name('reconcile.show')->middleware('permission:stock.move|audit.read');
Route::post('/reconcile', [StockReconciliationController::class, 'run'])
->name('reconcile.run')->middleware('permission:stock.move|audit.read');
⋮----
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
⋮----
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
Route::get('/payments', [PaymentController::class, 'index'])
->name('payments.index')->middleware('permission:payment.settle');
Route::get('/payments/{payment}', [PaymentController::class, 'show'])->name('payments.show');
Route::get('/payments/{payment}/fake-gateway', [PaymentController::class, 'fakeGateway'])
->name('payments.fake-gateway');
Route::post('/payments/{payment}/fake-gateway', [PaymentController::class, 'simulateFakeGateway'])
->name('payments.fake-gateway.store');
⋮----
Route::middleware('permission:import.run')->prefix('imports')->name('imports.')->group(function () {
Route::get('/', [ImportController::class, 'index'])->name('index');
Route::get('/create', [ImportController::class, 'create'])->name('create');
Route::post('/', [ImportController::class, 'store'])->name('store');
Route::get('/{importBatch}/errors', [ImportController::class, 'errorReport'])->name('errors');
Route::get('/{importBatch}/errors/download', [ImportController::class, 'downloadErrorReport'])->name('errors.download');
Route::get('/{importBatch}', [ImportController::class, 'show'])->name('show');
⋮----
// Staff-only actions (payment.settle) — record-level enforcement is in
// OrderPolicy::fulfill() / PaymentPolicy::settle(), this is the coarse
// route gate.
Route::post('/orders/{order}/fulfill', [OrderController::class, 'fulfill'])
->name('orders.fulfill')->middleware('permission:payment.settle');
Route::post('/payments/{payment}/settle', [PaymentController::class, 'settle'])
->name('payments.settle')->middleware('permission:payment.settle');
⋮----
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
⋮----
Route::get('/purchase-orders', [PurchaseOrderController::class, 'index'])->name('purchase-orders.index');
Route::get('/purchase-orders/{purchaseOrder}/approve', [PurchaseOrderController::class, 'approveCreate'])
->name('purchase-orders.approve.create')->middleware('permission:po.approve');
Route::post('/purchase-orders/{purchaseOrder}/approve', [PurchaseOrderController::class, 'approve'])
->name('purchase-orders.approve.store')->middleware('permission:po.approve');
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
⋮----
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
````

## File: routes/webhooks.php
````php
use App\Http\Controllers\Webhooks\FakeGatewayWebhookController;
use App\Http\Controllers\Webhooks\FawryWebhookController;
use App\Http\Controllers\Webhooks\PaymobWebhookController;
use Illuminate\Support\Facades\Route;
⋮----
Route::post('/paymob', PaymobWebhookController::class)->name('webhooks.paymob');
Route::post('/fawry', FawryWebhookController::class)->name('webhooks.fawry');
Route::post('/fake-gateway', FakeGatewayWebhookController::class)->name('webhooks.fake-gateway');
````

## File: tests/Concerns/SetsUpCheckoutFixtures.php
````php
namespace Tests\Concerns;
⋮----
use App\Enums\PriceListType;
use App\Enums\UserRole;
use App\Models\PriceList;
use App\Models\PriceListItem;
use App\Models\Product;
use App\Models\User;
use App\Models\Warehouse;
use App\Services\StockService;
⋮----
/**
 * Shared fixtures for the B2C checkout module's tests: a priced,
 * in-stock product and the roles that can buy/settle it.
 */
trait SetsUpCheckoutFixtures
⋮----
private function retailCustomer(): User
⋮----
$user = User::factory()->create();
$user->addRole(UserRole::RetailCustomer->value);
⋮----
private function salesCashier(): User
⋮----
$user->addRole(UserRole::SalesCashier->value);
⋮----
/**
     * @return array{product: Product, warehouse: Warehouse}
     */
private function productWithRetailStock(int $quantity = 10, string $price = '100.00'): array
⋮----
$product = Product::factory()->create();
$warehouse = Warehouse::factory()->create();
⋮----
$priceList = PriceList::factory()->create([
⋮----
PriceListItem::factory()->create([
⋮----
app(StockService::class)->purchaseIn($product, $warehouse, $quantity, null, null);
````

## File: tests/Concerns/SetsUpProcurementFixtures.php
````php
namespace Tests\Concerns;
⋮----
use App\Enums\UserRole;
use App\Models\BusinessAccount;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Warehouse;
use App\Services\StockService;
⋮----
/**
 * Shared fixtures for the B2B procurement module's tests.
 */
trait SetsUpProcurementFixtures
⋮----
/**
     * @return array{0: User, 1: BusinessAccount}
     */
private function businessBuyer(string $creditLimit = '100000.00', string $outstandingBalance = '0.00'): array
⋮----
$user = User::factory()->create();
$user->addRole(UserRole::BusinessBuyer->value);
⋮----
$account = BusinessAccount::factory()->create([
⋮----
private function inventoryManager(): User
⋮----
$user->addRole(UserRole::InventoryManager->value);
⋮----
private function salesCashier(): User
⋮----
$user->addRole(UserRole::SalesCashier->value);
⋮----
/**
     * @return array{0: User, 1: Supplier}
     */
private function vendor(): array
⋮----
$user->addRole(UserRole::VendorSupplier->value);
$supplier = Supplier::factory()->create(['user_id' => $user->id]);
⋮----
/**
     * @return array{product: Product, warehouse: Warehouse}
     */
private function productWithStock(?Supplier $supplier = null, int $quantity = 10): array
⋮----
$product = Product::factory()->create([
'supplier_id' => $supplier?->id ?? Supplier::factory(),
⋮----
$warehouse = Warehouse::factory()->create();
⋮----
app(StockService::class)->purchaseIn($product, $warehouse, $quantity, null, null);
````

## File: tests/Concerns/UsesRealMysqlDatabase.php
````php
namespace Tests\Concerns;
⋮----
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use PDO;
⋮----
/**
 * Switches the test to a real MySQL connection instead of the suite's
 * default SQLite `:memory:` (see phpunit.xml) — for tests that need real
 * InnoDB semantics: FULLTEXT indexes, real FK/unique-constraint
 * enforcement, `SELECT ... FOR UPDATE` row locking, and real
 * (de)serialization. SQLite fakes some of these or doesn't support them at
 * all (e.g. it has no row-level locking, so a no-oversell concurrency test
 * against SQLite wouldn't actually prove anything).
 *
 * Always targets a dedicated `stockflow_testing` database on the same
 * server as dev — never the dev database itself.
 *
 * Usage: `use UsesRealMysqlDatabase;` in a test class, call
 * `$this->useRealMysqlDatabase();` in setUp() (after parent::setUp()),
 * and `$this->restoreOriginalDatabaseConnection();` in tearDown() (before
 * parent::tearDown()). Migrate the schema once per test class with a
 * `private static bool $migrated` guard — see DatabaseSchemaTest for the
 * pattern.
 */
trait UsesRealMysqlDatabase
⋮----
private string $originalDefaultConnection;
⋮----
private function useRealMysqlDatabase(): void
⋮----
$this->originalDefaultConnection = Config::get('database.default');
⋮----
// The app's normal DB user only has grants on the dev database, so
// bootstrap the dedicated test database (and its grant) as root.
⋮----
$root->exec(
⋮----
$root->exec("GRANT ALL PRIVILEGES ON `{$testDatabase}`.* TO '{$appUser}'@'%'");
$root->exec('FLUSH PRIVILEGES');
⋮----
Config::set('database.connections.mysql.database', $testDatabase);
Config::set('database.default', 'mysql');
DB::purge('mysql');
⋮----
private function migrateRealMysqlDatabaseOnce(): void
⋮----
Artisan::call('migrate:fresh', ['--database' => 'mysql', '--force' => true]);
⋮----
/**
     * Restore the suite's default (SQLite in-memory) connection so this
     * switch can never bleed into other test classes regardless of run
     * order.
     */
private function restoreOriginalDatabaseConnection(): void
⋮----
Config::set('database.default', $this->originalDefaultConnection);
````

## File: tests/Concurrency/reserve_once.php
````php
use App\Models\Product;
use App\Models\Warehouse;
use App\Services\StockService;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;
⋮----
/**
 * Standalone worker process for StockServiceConcurrencyTest — deliberately
 * NOT a Symfony\Process\Process-based helper (that package isn't a project
 * dependency) or an artisan command (reserving stock from the CLI with no
 * actor isn't a real product capability). It boots its own Laravel
 * application instance, connected to the same real MySQL test database as
 * the parent test process, and attempts exactly one StockService::reserve()
 * call. Two of these are launched concurrently via proc_open() so the
 * lockForUpdate() row lock in lockOrCreateLevel() is genuinely contended
 * between two separate DB connections/transactions.
 *
 * Usage: php reserve_once.php <productId> <warehouseId> <quantity>
 * Prints exactly "OK" or "FAIL:<ExceptionClass>" to stdout.
 */
⋮----
/** @var Application $app */
⋮----
/** @var Kernel $kernel */
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();
⋮----
$product = Product::query()->findOrFail($productId);
$warehouse = Warehouse::query()->findOrFail($warehouseId);
⋮----
app(StockService::class)->reserve($product, $warehouse, (int) $quantity, null, null);
````

## File: tests/Feature/Admin/AuditLogTest.php
````php
namespace Tests\Feature\Admin;
⋮----
use App\Enums\UserRole;
use App\Models\ActivityLog;
use App\Models\Product;
use App\Models\User;
use App\Models\Warehouse;
use App\Services\StockService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
⋮----
/**
 * Requirement #2 of the admin/audit/dashboard/reports module: activity_log
 * records user/role changes, permission changes, stock adjustments, PO
 * approvals, and payment settlement — plus requirement #7's route
 * protection (`audit.read`).
 */
class AuditLogTest extends TestCase
⋮----
protected function setUp(): void
⋮----
parent::setUp();
⋮----
$this->seed(RolePermissionSeeder::class);
⋮----
private function auditor(): User
⋮----
$user = User::factory()->create();
$user->addRole(UserRole::InventoryManager->value);
⋮----
public function test_audit_read_holder_can_view_audit_log(): void
⋮----
$auditor = $this->auditor();
⋮----
$this->actingAs($auditor)->get('/admin/audit-log')->assertOk();
⋮----
public function test_unauthorized_user_cannot_view_audit_log(): void
⋮----
$customer = User::factory()->create();
$customer->addRole(UserRole::RetailCustomer->value);
⋮----
$this->actingAs($customer)->get('/admin/audit-log')->assertForbidden();
⋮----
public function test_guest_cannot_view_audit_log(): void
⋮----
$this->get('/admin/audit-log')->assertRedirect('/login');
⋮----
public function test_stock_adjustment_is_audited(): void
⋮----
$manager = $this->auditor();
$product = Product::factory()->create();
$warehouse = Warehouse::factory()->create();
app(StockService::class)->purchaseIn($product, $warehouse, 20, $manager, null);
⋮----
app(StockService::class)->adjust($product, $warehouse, -5, $manager, 'Cycle count correction');
⋮----
$this->assertDatabaseHas('activity_log', [
⋮----
public function test_audit_log_entries_are_filterable_by_event(): void
⋮----
app(StockService::class)->adjust($product, $warehouse, -5, $manager, 'Damaged');
⋮----
$response = $this->actingAs($manager)->get('/admin/audit-log?event=stock.adjusted');
⋮----
$response->assertOk();
$this->assertSame(1, ActivityLog::query()->where('event', 'stock.adjusted')->count());
````

## File: tests/Feature/Admin/AuthorizationTest.php
````php
namespace Tests\Feature\Admin;
⋮----
use App\Enums\UserRole;
use App\Models\User;
use App\Services\RoleAssignmentService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;
⋮----
class AuthorizationTest extends TestCase
⋮----
protected function setUp(): void
⋮----
parent::setUp();
⋮----
$this->seed(RolePermissionSeeder::class);
⋮----
public function test_super_admin_can_view_permission_matrix(): void
⋮----
$admin = User::factory()->create();
$admin->addRole(UserRole::SuperAdmin->value);
⋮----
$response = $this->actingAs($admin)->get('/admin/permissions/matrix');
⋮----
$response->assertOk();
$response->assertInertia(fn (Assert $page) => $page
->component('Admin/Permissions/Matrix')
->has('roles', 6)
->has('permissions', 17)
⋮----
public function test_retail_customer_cannot_view_admin_pages(): void
⋮----
$retailCustomer = User::factory()->create();
$retailCustomer->addRole(UserRole::RetailCustomer->value);
⋮----
$this->actingAs($retailCustomer)->get('/admin/users')->assertForbidden();
$this->actingAs($retailCustomer)->get('/admin/roles')->assertForbidden();
$this->actingAs($retailCustomer)->get('/admin/permissions/matrix')->assertForbidden();
⋮----
public function test_assigning_and_removing_role_updates_permissions(): void
⋮----
$target = User::factory()->create();
$this->assertFalse($target->isAbleTo('stock.move'));
⋮----
$this->actingAs($admin)->put("/admin/users/{$target->id}/roles", [
⋮----
])->assertRedirect();
⋮----
$target->refresh();
$this->assertTrue($target->isAbleTo('stock.move'));
$this->assertTrue($target->isAbleTo('stock.transfer'));
⋮----
public function test_permission_cache_flushes_after_role_change(): void
⋮----
$user = User::factory()->create();
⋮----
// First check populates the cache with "no roles".
$this->assertFalse($user->isAbleTo('stock.move'));
$this->assertTrue(Cache::has($rolesCacheKey));
⋮----
app(RoleAssignmentService::class)->syncRoles($user, [UserRole::InventoryManager->value]);
⋮----
// The mutation must have flushed the stale cache entry immediately.
$this->assertFalse(Cache::has($rolesCacheKey));
⋮----
// Re-checking now reflects the new role, proving no stale cache was served.
$user = $user->fresh();
$this->assertTrue($user->isAbleTo('stock.move'));
````

## File: tests/Feature/Admin/HorizonAccessTest.php
````php
namespace Tests\Feature\Admin;
⋮----
use App\Enums\UserRole;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;
⋮----
/**
 * Horizon exposes queue payloads and failure details with no equivalent
 * permission in the PRD's matrix, so HorizonServiceProvider::gate()
 * restricts it to SuperAdmin directly rather than a granular permission.
 */
class HorizonAccessTest extends TestCase
⋮----
protected function setUp(): void
⋮----
parent::setUp();
$this->seed(RolePermissionSeeder::class);
⋮----
public function test_super_admin_can_view_horizon(): void
⋮----
$admin = User::factory()->create();
$admin->addRole(UserRole::SuperAdmin->value);
⋮----
$this->assertTrue(Gate::forUser($admin)->allows('viewHorizon'));
⋮----
public function test_non_super_admin_cannot_view_horizon(): void
⋮----
$manager = User::factory()->create();
$manager->addRole(UserRole::InventoryManager->value);
⋮----
$this->assertFalse(Gate::forUser($manager)->allows('viewHorizon'));
⋮----
public function test_guest_cannot_view_horizon(): void
⋮----
$this->assertFalse(Gate::forUser(null)->allows('viewHorizon'));
````

## File: tests/Feature/Admin/PaymentSettlementAuditTest.php
````php
namespace Tests\Feature\Admin;
⋮----
use App\Enums\PaymentMethod;
use App\Services\OrderService;
use App\Services\PaymentService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\SetsUpCheckoutFixtures;
use Tests\TestCase;
⋮----
class PaymentSettlementAuditTest extends TestCase
⋮----
protected function setUp(): void
⋮----
parent::setUp();
⋮----
$this->seed(RolePermissionSeeder::class);
⋮----
public function test_payment_settlement_is_audited(): void
⋮----
$customer = $this->retailCustomer();
['product' => $product] = $this->productWithRetailStock(quantity: 10);
⋮----
$order = app(OrderService::class)->checkout($customer, [
⋮----
$payment = $order->payments()->latest()->first();
$staff = $this->salesCashier();
⋮----
app(PaymentService::class)->settleManually($payment, $staff);
⋮----
$this->assertDatabaseHas('activity_log', [
````

## File: tests/Feature/Admin/PurchaseOrderApprovalAuditTest.php
````php
namespace Tests\Feature\Admin;
⋮----
use App\Services\PurchaseOrderService;
use App\Services\QuoteService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\SetsUpProcurementFixtures;
use Tests\TestCase;
⋮----
class PurchaseOrderApprovalAuditTest extends TestCase
⋮----
protected function setUp(): void
⋮----
parent::setUp();
⋮----
$this->seed(RolePermissionSeeder::class);
⋮----
public function test_po_approval_is_audited(): void
⋮----
[$buyer, $account] = $this->businessBuyer();
['product' => $product] = $this->productWithStock();
$approver = $this->inventoryManager();
⋮----
$quote = app(QuoteService::class)->request($account, [
⋮----
$quote = app(QuoteService::class)->price($quote, [$quote->items->first()->id => '50.00']);
$purchaseOrder = app(PurchaseOrderService::class)->createFromQuote($quote, $buyer);
⋮----
app(PurchaseOrderService::class)->approve($purchaseOrder, $approver);
⋮----
$this->assertDatabaseHas('activity_log', [
⋮----
public function test_po_rejection_is_audited(): void
⋮----
app(PurchaseOrderService::class)->reject($purchaseOrder, $approver, 'Not viable.');
````

## File: tests/Feature/Admin/RolePermissionManagementTest.php
````php
namespace Tests\Feature\Admin;
⋮----
use App\Enums\PermissionName;
use App\Enums\UserRole;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
⋮----
/**
 * Module 4: role/permission management improvements — a `role.manage`
 * holder can edit a role's own permission set (not just which roles a
 * user has). Requirement #2: permission changes are audited.
 */
class RolePermissionManagementTest extends TestCase
⋮----
protected function setUp(): void
⋮----
parent::setUp();
⋮----
$this->seed(RolePermissionSeeder::class);
⋮----
private function admin(): User
⋮----
$user = User::factory()->create();
$user->addRole(UserRole::SuperAdmin->value);
⋮----
public function test_role_manage_holder_can_update_a_roles_permissions(): void
⋮----
$admin = $this->admin();
$role = Role::query()->where('name', UserRole::SalesCashier->value)->firstOrFail();
⋮----
$response = $this->actingAs($admin)->put("/admin/roles/{$role->id}/permissions", [
⋮----
$response->assertRedirect('/admin/roles');
⋮----
$role->refresh();
$this->assertSame(
⋮----
$role->permissions()->pluck('name')->sort()->values()->all()
⋮----
$this->assertTrue($role->hasPermission(PermissionName::CatalogRead->value));
$this->assertTrue($role->hasPermission(PermissionName::AuditRead->value));
$this->assertFalse($role->hasPermission(PermissionName::SaleCreate->value));
⋮----
public function test_role_permission_change_is_audited(): void
⋮----
$this->actingAs($admin)->put("/admin/roles/{$role->id}/permissions", [
⋮----
$this->assertDatabaseHas('activity_log', [
⋮----
public function test_unauthorized_user_cannot_update_role_permissions(): void
⋮----
$customer = User::factory()->create();
$customer->addRole(UserRole::RetailCustomer->value);
⋮----
$this->actingAs($customer)->put("/admin/roles/{$role->id}/permissions", [
⋮----
])->assertForbidden();
⋮----
public function test_a_users_permissions_reflect_updated_role_permissions_immediately(): void
⋮----
$cashier = User::factory()->create();
$cashier->addRole(UserRole::SalesCashier->value);
⋮----
$this->assertFalse($cashier->isAbleTo(PermissionName::AuditRead->value));
⋮----
$this->assertTrue($cashier->fresh()->isAbleTo(PermissionName::AuditRead->value));
````

## File: tests/Feature/Admin/SeededSuperAdminAccessTest.php
````php
namespace Tests\Feature\Admin;
⋮----
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
⋮----
/**
 * Regression test for a real bug: `migrate:fresh` resets bigint
 * auto-increment IDs but never touches Redis, so a stale Laratrust
 * permission-cache entry from a *previous* user that held the same
 * numeric ID (e.g. "user #1 has no roles") survives the reset and gets
 * served to the newly-seeded SuperAdmin, making them look unauthorized
 * everywhere. Fixed by `DatabaseSeeder::run()` flushing the cache before
 * seeding — see docs/technical/cache.md.
 */
class SeededSuperAdminAccessTest extends TestCase
⋮----
public function test_seeded_super_admin_can_access_admin_pages_even_with_a_poisoned_permission_cache(): void
⋮----
// Poison the cache for user ID 1 *before* seeding runs — exactly
// what happens when a previous migrate:fresh cycle cached "no
// roles" for whichever user happened to hold ID 1 back then.
⋮----
$ghost->hasRole('super-admin');
⋮----
$this->seed(DatabaseSeeder::class);
⋮----
$admin = User::where('email', 'admin@stockflow.test')->firstOrFail();
$this->assertSame(1, $admin->id);
$this->assertTrue($admin->hasRole('super-admin'));
⋮----
$this->actingAs($admin)->get('/admin/users')->assertOk();
$this->actingAs($admin)->get('/admin/roles')->assertOk();
````

## File: tests/Feature/Admin/UserRoleManagementTest.php
````php
namespace Tests\Feature\Admin;
⋮----
use App\Enums\UserRole;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;
⋮----
/**
 * Modules 3/4: user management + role/permission management improvements.
 * Requirement #2: user/role changes are audited.
 */
class UserRoleManagementTest extends TestCase
⋮----
protected function setUp(): void
⋮----
parent::setUp();
⋮----
$this->seed(RolePermissionSeeder::class);
⋮----
private function admin(): User
⋮----
$user = User::factory()->create();
$user->addRole(UserRole::SuperAdmin->value);
⋮----
public function test_user_manage_holder_can_view_users_index(): void
⋮----
$admin = $this->admin();
⋮----
$this->actingAs($admin)->get('/admin/users')->assertOk();
⋮----
public function test_unauthorized_user_cannot_view_users_index(): void
⋮----
$customer = User::factory()->create();
$customer->addRole(UserRole::RetailCustomer->value);
⋮----
$this->actingAs($customer)->get('/admin/users')->assertForbidden();
⋮----
public function test_edit_roles_page_renders_admin_users_edit_component(): void
⋮----
$target = User::factory()->create();
⋮----
$response = $this->actingAs($admin)->get("/admin/users/{$target->id}/roles");
⋮----
$response->assertOk();
$response->assertInertia(fn (Assert $page) => $page->component('Admin/Users/Edit'));
⋮----
public function test_updating_user_roles_is_audited(): void
⋮----
$this->actingAs($admin)->put("/admin/users/{$target->id}/roles", [
⋮----
])->assertRedirect();
⋮----
$this->assertTrue($target->fresh()->hasRole(UserRole::SalesCashier->value));
$this->assertDatabaseHas('activity_log', [
````

## File: tests/Feature/Api/V1/ExternalB2bApiTest.php
````php
namespace Tests\Feature\Api\V1;
⋮----
use App\Enums\QuoteStatus;
use App\Enums\UserRole;
use App\Models\BusinessAccount;
use App\Models\Category;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\Quote;
use App\Models\User;
use App\Services\QuoteService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\Client;
use Laravel\Passport\Passport;
use Mockery;
use Tests\TestCase;
⋮----
class ExternalB2bApiTest extends TestCase
⋮----
private static bool $passportKeysGenerated = false;
⋮----
protected function setUp(): void
⋮----
parent::setUp();
⋮----
Artisan::call('passport:keys', ['--force' => true]);
⋮----
$this->seed(RolePermissionSeeder::class);
⋮----
public function test_unauthenticated_api_request_returns_401(): void
⋮----
$this->getJson('/api/v1/catalog/products')
->assertUnauthorized();
⋮----
public function test_token_without_required_scope_returns_403(): void
⋮----
$user = $this->inventoryManager();
⋮----
Passport::actingAs($user, ['stock:read']);
⋮----
->assertForbidden();
⋮----
public function test_b2b_client_can_read_catalog_with_catalog_read_scope(): void
⋮----
$user = $this->businessBuyer();
$category = Category::factory()->create(['name' => 'API Category']);
Product::factory()->create([
⋮----
Passport::actingAs($user, ['catalog:read']);
⋮----
->assertOk()
->assertJsonPath('data.0.sku', 'API-SKU-001')
->assertJsonPath('meta.total', 1);
⋮----
public function test_service_client_can_read_catalog_with_client_credentials_scope(): void
⋮----
$client = Client::factory()->asClientCredentials()->create();
$category = Category::factory()->create(['name' => 'Service API Category']);
⋮----
Passport::actingAsClient($client, ['catalog:read']);
⋮----
$this->withHeader('Authorization', 'Bearer service-token')
->getJson('/api/v1/catalog/products')
⋮----
->assertJsonPath('data.0.sku', 'SERVICE-SKU-001')
⋮----
public function test_business_buyer_can_create_quote(): void
⋮----
$product = Product::factory()->create(['sku' => 'RFQ-SKU-001']);
⋮----
Passport::actingAs($user, ['orders:write']);
⋮----
$this->postJson('/api/v1/b2b/quotes', [
⋮----
->assertCreated()
->assertJsonPath('data.status', QuoteStatus::Draft->value)
->assertJsonPath('data.items.0.product.sku', 'RFQ-SKU-001');
⋮----
$this->assertDatabaseHas('quotes', [
⋮----
public function test_business_buyer_cannot_see_another_buyer_purchase_order(): void
⋮----
$buyer = $this->businessBuyer();
$otherBuyer = $this->businessBuyer();
$ownPo = PurchaseOrder::factory()->create(['business_account_id' => $buyer->businessAccount->id]);
$otherPo = PurchaseOrder::factory()->create(['business_account_id' => $otherBuyer->businessAccount->id]);
⋮----
Passport::actingAs($buyer, ['orders:write']);
⋮----
$response = $this->getJson('/api/v1/b2b/purchase-orders')
->assertOk();
⋮----
$ids = collect($response->json('data'))->pluck('id');
⋮----
$this->assertTrue($ids->contains($ownPo->id));
$this->assertFalse($ids->contains($otherPo->id));
⋮----
public function test_api_quote_creation_uses_same_quote_service_as_web_flow(): void
⋮----
$product = Product::factory()->create();
$quote = Quote::factory()->create(['business_account_id' => $user->businessAccount->id]);
⋮----
$mock = Mockery::mock(QuoteService::class);
$mock->shouldReceive('request')
->once()
->withArgs(function (BusinessAccount $businessAccount, array $lines) use ($user, $product) {
return $businessAccount->is($user->businessAccount)
⋮----
->andReturn($quote);
⋮----
$this->app->instance(QuoteService::class, $mock);
⋮----
->assertJsonPath('data.id', $quote->id);
⋮----
private function inventoryManager(): User
⋮----
$user = User::factory()->create();
$user->addRole(UserRole::InventoryManager->value);
⋮----
private function businessBuyer(): User
⋮----
$user->addRole(UserRole::BusinessBuyer->value);
BusinessAccount::factory()->create(['user_id' => $user->id]);
$user->load('businessAccount');
````

## File: tests/Feature/Auth/AuthenticationTest.php
````php
namespace Tests\Feature\Auth;
⋮----
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;
⋮----
class AuthenticationTest extends TestCase
⋮----
public function test_login_page_renders(): void
⋮----
$response = $this->get('/login');
⋮----
$response->assertOk();
$response->assertInertia(fn (Assert $page) => $page->component('Auth/Login'));
⋮----
public function test_users_can_authenticate_with_valid_credentials(): void
⋮----
$user = User::factory()->create();
⋮----
$response = $this->post('/login', [
⋮----
$this->assertAuthenticatedAs($user);
$response->assertRedirect('/dashboard');
⋮----
public function test_users_cannot_authenticate_with_invalid_password(): void
⋮----
$response = $this->from('/login')->post('/login', [
⋮----
$this->assertGuest();
$response->assertSessionHasErrors('email');
⋮----
/**
     * A wrong password and a non-existent email must produce the identical
     * error (same key, same generic message) so a caller can't distinguish
     * "no such account" from "wrong password" for a real one.
     */
public function test_invalid_credentials_do_not_leak_which_field_was_wrong(): void
⋮----
$wrongPassword = $this->from('/login')->post('/login', [
⋮----
$unknownEmail = $this->from('/login')->post('/login', [
⋮----
$wrongPassword->assertSessionHasErrors(['email' => __('auth.failed')]);
$unknownEmail->assertSessionHasErrors(['email' => __('auth.failed')]);
⋮----
public function test_authenticated_users_can_log_out(): void
⋮----
$this->actingAs($user)->get('/dashboard')->assertOk();
⋮----
$response = $this->post('/logout');
⋮----
$response->assertRedirect('/login');
⋮----
// The session must be fully invalidated, not just logged out of the
// guard: a previously authenticated request to a protected route
// must now be rejected.
$this->get('/dashboard')->assertRedirect('/login');
````

## File: tests/Feature/Catalog/CatalogCacheTest.php
````php
namespace Tests\Feature\Catalog;
⋮----
use App\Enums\UserRole;
use App\Models\Category;
use App\Models\PriceList;
use App\Models\Product;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;
⋮----
/**
 * Proves requirement #4/#5: catalog listings are cached (Redis, tag
 * 'catalog' — see CatalogService), and every product/category/price-list
 * write flushes that cache so the next read is never stale.
 */
class CatalogCacheTest extends TestCase
⋮----
protected function setUp(): void
⋮----
parent::setUp();
⋮----
$this->seed(RolePermissionSeeder::class);
⋮----
private function inventoryManager(): User
⋮----
$user = User::factory()->create();
$user->addRole(UserRole::InventoryManager->value);
⋮----
public function test_product_listing_cache_invalidates_after_creating_a_product(): void
⋮----
$manager = $this->inventoryManager();
Product::factory()->count(2)->create();
⋮----
$this->actingAs($manager)
->get('/catalog/products')
->assertInertia(fn (Assert $page) => $page->has('products.data', 2));
⋮----
$category = Category::factory()->create();
$this->actingAs($manager)->post('/catalog/products', [
⋮----
])->assertRedirect();
⋮----
// If the cache had not been flushed, this would still report 2.
⋮----
->assertInertia(fn (Assert $page) => $page->has('products.data', 3));
⋮----
public function test_product_listing_cache_invalidates_after_updating_a_product(): void
⋮----
$product = Product::factory()->create(['name' => 'Original Name']);
⋮----
// Warm the cache with the pre-update listing.
⋮----
->assertInertia(fn (Assert $page) => $page->where('products.data.0.name', 'Original Name'));
⋮----
$this->actingAs($manager)->put("/catalog/products/{$product->id}", [
⋮----
// If the cache had not been flushed, this would still report the
// original name.
⋮----
->assertInertia(fn (Assert $page) => $page->where('products.data.0.name', 'Updated Name'));
⋮----
public function test_category_listing_cache_invalidates_after_creating_a_category(): void
⋮----
Category::factory()->create();
⋮----
->get('/catalog/categories')
->assertInertia(fn (Assert $page) => $page->has('categories', 1));
⋮----
$this->actingAs($manager)->post('/catalog/categories', [
⋮----
->assertInertia(fn (Assert $page) => $page->has('categories', 2));
⋮----
public function test_price_list_listing_cache_invalidates_after_creating_a_price_list(): void
⋮----
PriceList::factory()->create();
⋮----
->get('/catalog/price-lists')
->assertInertia(fn (Assert $page) => $page->has('priceLists.data', 1));
⋮----
$this->actingAs($manager)->post('/catalog/price-lists', [
⋮----
->assertInertia(fn (Assert $page) => $page->has('priceLists.data', 2));
⋮----
/**
     * Regression test: the ArrayStore cache driver used by the rest of this
     * suite (see phpunit.xml) never actually serializes values, so it can't
     * catch bugs in the real Redis (de)serialization path. This test
     * switches to the app's real `redis` cache store — the same one dev/prod
     * use — and reads a cached catalog listing TWICE (the second read is a
     * genuine cache hit requiring unserialize()), proving cached Eloquent
     * Collections/Paginators survive a real Redis round-trip intact.
     */
public function test_catalog_cache_survives_a_real_redis_round_trip(): void
⋮----
$originalDefault = Config::get('cache.default');
Config::set('cache.default', 'redis');
Cache::forgetDriver('redis');
Cache::tags(['catalog'])->flush();
⋮----
Category::factory()->count(2)->create();
⋮----
->assertOk()
⋮----
// Second request is a real cache hit against Redis.
⋮----
Config::set('cache.default', $originalDefault);
````

## File: tests/Feature/Catalog/PriceListItemOwnershipTest.php
````php
namespace Tests\Feature\Catalog;
⋮----
use App\Enums\UserRole;
use App\Models\PriceList;
use App\Models\PriceListItem;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
⋮----
/**
 * Proves requirement #6: a Vendor may manage price list items only for
 * their own products (Enterprise PRD §3, pricelist.manage "own" cell).
 */
class PriceListItemOwnershipTest extends TestCase
⋮----
protected function setUp(): void
⋮----
parent::setUp();
⋮----
$this->seed(RolePermissionSeeder::class);
⋮----
private function vendor(): array
⋮----
$user = User::factory()->create();
$user->addRole(UserRole::VendorSupplier->value);
$supplier = Supplier::factory()->create(['user_id' => $user->id]);
$product = Product::factory()->create(['supplier_id' => $supplier->id]);
⋮----
public function test_vendor_can_update_their_own_price_list_item(): void
⋮----
[$vendorA, , $productA] = $this->vendor();
$priceList = PriceList::factory()->create();
$item = PriceListItem::factory()->create([
⋮----
$response = $this->actingAs($vendorA)->put("/catalog/price-list-items/{$item->id}", [
⋮----
$response->assertRedirect();
$this->assertDatabaseHas('price_list_items', ['id' => $item->id, 'unit_price' => 25.50]);
⋮----
public function test_vendor_cannot_edit_another_vendors_price_list_item(): void
⋮----
[$vendorA] = $this->vendor();
[, , $productB] = $this->vendor();
⋮----
$itemB = PriceListItem::factory()->create([
⋮----
$response = $this->actingAs($vendorA)->put("/catalog/price-list-items/{$itemB->id}", [
⋮----
$response->assertForbidden();
$this->assertDatabaseHas('price_list_items', ['id' => $itemB->id, 'unit_price' => 10]);
⋮----
public function test_vendor_cannot_delete_another_vendors_price_list_item(): void
⋮----
$response = $this->actingAs($vendorA)->delete("/catalog/price-list-items/{$itemB->id}");
⋮----
$this->assertDatabaseHas('price_list_items', ['id' => $itemB->id]);
⋮----
public function test_vendor_cannot_add_an_item_for_another_vendors_product(): void
⋮----
$response = $this->actingAs($vendorA)->post("/catalog/price-lists/{$priceList->id}/items", [
⋮----
$this->assertDatabaseMissing('price_list_items', ['product_id' => $productB->id]);
⋮----
public function test_inventory_manager_can_edit_any_price_list_item(): void
⋮----
[, , $product] = $this->vendor();
⋮----
$manager = User::factory()->create();
$manager->addRole(UserRole::InventoryManager->value);
⋮----
$response = $this->actingAs($manager)->put("/catalog/price-list-items/{$item->id}", [
⋮----
$this->assertDatabaseHas('price_list_items', ['id' => $item->id, 'unit_price' => 42]);
````

## File: tests/Feature/Catalog/ProductManagementTest.php
````php
namespace Tests\Feature\Catalog;
⋮----
use App\Enums\UserRole;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
⋮----
class ProductManagementTest extends TestCase
⋮----
protected function setUp(): void
⋮----
parent::setUp();
⋮----
$this->seed(RolePermissionSeeder::class);
⋮----
private function inventoryManager(): User
⋮----
$user = User::factory()->create();
$user->addRole(UserRole::InventoryManager->value);
⋮----
public function test_authorized_user_can_create_a_product(): void
⋮----
$manager = $this->inventoryManager();
$category = Category::factory()->create();
⋮----
$response = $this->actingAs($manager)->post('/catalog/products', [
⋮----
$response->assertRedirect();
$this->assertDatabaseHas('products', ['sku' => 'SKU-NEW-001', 'name' => 'New Widget']);
⋮----
public function test_authorized_user_can_update_a_product(): void
⋮----
$product = Product::factory()->create(['name' => 'Old Name']);
⋮----
$response = $this->actingAs($manager)->put("/catalog/products/{$product->id}", [
⋮----
$this->assertDatabaseHas('products', ['id' => $product->id, 'name' => 'Updated Name']);
⋮----
public function test_unauthorized_user_gets_403_creating_a_product(): void
⋮----
$retail = User::factory()->create();
$retail->addRole(UserRole::RetailCustomer->value);
⋮----
$response = $this->actingAs($retail)->post('/catalog/products', [
⋮----
$response->assertForbidden();
$this->assertDatabaseMissing('products', ['sku' => 'SKU-BLOCKED-001']);
⋮----
public function test_unauthorized_user_gets_403_viewing_product_create_page(): void
⋮----
$this->actingAs($retail)->get('/catalog/products/create')->assertForbidden();
⋮----
public function test_product_sku_must_be_unique_on_create(): void
⋮----
$existing = Product::factory()->create(['sku' => 'SKU-DUPLICATE']);
⋮----
$response->assertSessionHasErrors('sku');
$this->assertSame(1, Product::query()->where('sku', 'SKU-DUPLICATE')->count());
⋮----
public function test_product_sku_must_be_unique_on_update_excluding_itself(): void
⋮----
$productA = Product::factory()->create(['sku' => 'SKU-A']);
$productB = Product::factory()->create(['sku' => 'SKU-B']);
⋮----
// Updating A with its own (unchanged) SKU must succeed.
$this->actingAs($manager)->put("/catalog/products/{$productA->id}", [
⋮----
])->assertRedirect();
⋮----
// Updating A to collide with B's SKU must fail.
$response = $this->actingAs($manager)->put("/catalog/products/{$productA->id}", [
````

## File: tests/Feature/Import/ImportWorkflowTest.php
````php
namespace Tests\Feature\Import;
⋮----
use App\Enums\ImportEntity;
use App\Enums\ImportRowStatus;
use App\Enums\ImportStatus;
use App\Enums\MovementType;
use App\Enums\UserRole;
use App\Jobs\ImportCatalogJob;
use App\Models\Category;
use App\Models\ImportBatch;
use App\Models\Product;
use App\Models\StockLevel;
use App\Models\StockMovement;
use App\Models\User;
use App\Models\Warehouse;
use App\Services\ImportService;
use App\Services\StockService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Inertia\Testing\AssertableInertia as Assert;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Tests\TestCase;
⋮----
class ImportWorkflowTest extends TestCase
⋮----
protected function setUp(): void
⋮----
parent::setUp();
⋮----
Storage::fake('local');
$this->seed(RolePermissionSeeder::class);
⋮----
public function test_authorized_inventory_manager_can_upload_import(): void
⋮----
Queue::fake();
⋮----
$manager = $this->inventoryManager();
$file = $this->spreadsheetFile([
⋮----
$response = $this->actingAs($manager)->post('/imports', [
⋮----
$response->assertRedirect();
$this->assertDatabaseHas('import_batches', [
⋮----
Queue::assertPushed(ImportCatalogJob::class);
⋮----
public function test_unauthorized_user_gets_403_uploading_import(): void
⋮----
$customer = User::factory()->create();
$customer->addRole(UserRole::RetailCustomer->value);
⋮----
$response = $this->actingAs($customer)->post('/imports', [
⋮----
'file' => $this->spreadsheetFile([
⋮----
$response->assertForbidden();
$this->assertDatabaseCount('import_batches', 0);
⋮----
public function test_valid_products_import_successfully(): void
⋮----
Category::factory()->create(['slug' => 'widgets', 'name' => 'Widgets']);
⋮----
$this->startImport($manager, ImportEntity::Products, [
⋮----
$this->assertDatabaseHas('products', [
⋮----
$batch = ImportBatch::query()->latest()->first();
$this->assertSame(ImportStatus::Completed, $batch->status);
$this->assertSame(1, $batch->success_rows);
$this->assertSame(0, $batch->failed_rows);
⋮----
public function test_invalid_rows_are_reported_without_failing_whole_file(): void
⋮----
$this->assertDatabaseHas('products', ['sku' => 'SKU-IMPORT-003']);
$this->assertDatabaseHas('import_rows', ['status' => ImportRowStatus::Failed->value]);
⋮----
$this->assertSame(2, $batch->total_rows);
⋮----
$this->assertSame(1, $batch->failed_rows);
$this->assertNotNull($batch->rows()->where('status', ImportRowStatus::Failed->value)->first()->error);
⋮----
public function test_duplicate_sku_reimport_updates_existing_product(): void
⋮----
$this->assertSame(1, Product::query()->where('sku', 'SKU-REIMPORT-001')->count());
$this->assertSame('New name', Product::query()->where('sku', 'SKU-REIMPORT-001')->first()->name);
⋮----
public function test_opening_stock_import_creates_stock_movements(): void
⋮----
$product = Product::factory()->create(['sku' => 'SKU-STOCK-001']);
$warehouse = Warehouse::factory()->create(['code' => 'MAIN']);
⋮----
$this->startImport($manager, ImportEntity::OpeningStock, [
⋮----
$this->assertDatabaseHas('stock_movements', [
⋮----
public function test_opening_stock_import_updates_stock_levels(): void
⋮----
$product = Product::factory()->create(['sku' => 'SKU-STOCK-002']);
⋮----
$level = StockLevel::query()
->where('product_id', $product->id)
->where('warehouse_id', $warehouse->id)
->first();
⋮----
$this->assertSame(9, $level->on_hand);
$this->assertSame(0, $level->reserved);
$this->assertSame(1, StockMovement::query()->where('product_id', $product->id)->count());
⋮----
$reconciliation = app(StockService::class)->reconcile($product, $warehouse)->first();
$this->assertTrue($reconciliation['on_hand_matches']);
$this->assertTrue($reconciliation['reserved_matches']);
⋮----
public function test_import_progress_is_trackable(): void
⋮----
$this->actingAs($manager)
->get("/imports/{$batch->id}")
->assertOk()
->assertInertia(fn (Assert $page) => $page
->component('Import/Show')
->where('batch.total_rows', 2)
->where('batch.success_rows', 1)
->where('batch.failed_rows', 1)
->has('rows.data', 2));
⋮----
private function inventoryManager(): User
⋮----
$user = User::factory()->create();
$user->addRole(UserRole::InventoryManager->value);
⋮----
/**
     * @param  array<int, array<int, mixed>>  $rows
     */
private function startImport(User $manager, ImportEntity $entity, array $rows): ImportBatch
⋮----
app(ImportService::class)->start($manager, $entity, $this->spreadsheetFile($rows));
⋮----
return ImportBatch::query()->latest()->first();
⋮----
private function spreadsheetFile(array $rows, string $filename = 'import.xlsx'): UploadedFile
⋮----
$sheet = $spreadsheet->getActiveSheet();
⋮----
$cell = Coordinate::stringFromColumnIndex($columnIndex + 1).($rowIndex + 1);
$sheet->setCellValue($cell, $value);
⋮----
(new Xlsx($spreadsheet))->save($xlsxPath);
$spreadsheet->disconnectWorksheets();
````

## File: tests/Feature/Payments/PaymentWebhookTest.php
````php
namespace Tests\Feature\Payments;
⋮----
use App\Enums\MovementType;
use App\Enums\OrderChannel;
use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\StockMovement;
use App\Services\PaymentService;
use App\Services\StockService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\SetsUpCheckoutFixtures;
use Tests\TestCase;
⋮----
class PaymentWebhookTest extends TestCase
⋮----
protected function setUp(): void
⋮----
parent::setUp();
⋮----
$this->seed(RolePermissionSeeder::class);
⋮----
public function test_fake_gateway_success_marks_payment_paid_and_confirms_order(): void
⋮----
['order' => $order, 'payment' => $payment, 'product' => $product, 'warehouse' => $warehouse] = $this->reservedOrderWithFakePayment(3);
⋮----
$this->postJson('/webhooks/v1/fake-gateway', [
⋮----
])->assertOk();
⋮----
$this->assertSame(PaymentStatus::Paid, $payment->fresh()->status);
$this->assertSame(OrderStatus::Confirmed, $order->fresh()->status);
⋮----
$level = app(StockService::class)->reconcile($product, $warehouse)->first();
$this->assertSame(7, $level['on_hand']);
$this->assertSame(0, $level['reserved']);
⋮----
public function test_fake_gateway_failure_marks_payment_failed_and_does_not_reduce_stock(): void
⋮----
$this->assertSame(PaymentStatus::Failed, $payment->fresh()->status);
$this->assertSame(OrderStatus::Cancelled, $order->fresh()->status);
⋮----
$this->assertSame(10, $level['on_hand']);
⋮----
public function test_duplicate_fake_gateway_webhook_is_a_no_op(): void
⋮----
['payment' => $payment, 'product' => $product, 'warehouse' => $warehouse] = $this->reservedOrderWithFakePayment(2);
⋮----
$this->postJson('/webhooks/v1/fake-gateway', $payload)->assertOk();
$saleOutCount = StockMovement::query()->where('type', MovementType::SaleOut->value)->count();
⋮----
$this->assertSame($saleOutCount, StockMovement::query()->where('type', MovementType::SaleOut->value)->count());
⋮----
$this->assertSame(8, $level['on_hand']);
⋮----
public function test_gateway_ref_uniqueness_prevents_duplicate_processing(): void
⋮----
Payment::factory()->create(['gateway_ref' => 'gateway-duplicate']);
$payment = Payment::factory()->create(['gateway_ref' => null]);
⋮----
$this->expectException(QueryException::class);
⋮----
$payment->update(['gateway_ref' => 'gateway-duplicate']);
⋮----
/**
     * @return array<string, mixed>
     */
private function reservedOrderWithFakePayment(int $quantity): array
⋮----
$customer = $this->retailCustomer();
['product' => $product, 'warehouse' => $warehouse] = $this->productWithRetailStock(quantity: 10);
⋮----
$order = Order::query()->create([
⋮----
'reserved_until' => now()->addMinutes(30),
⋮----
OrderItem::query()->create([
⋮----
app(StockService::class)->reserve($product, $warehouse, $quantity, $customer, $order);
⋮----
$payment = app(PaymentService::class)->initiate($order, PaymentMethod::FakeGateway, $total);
````

## File: tests/Feature/Procurement/BankTransferSettlementTest.php
````php
namespace Tests\Feature\Procurement;
⋮----
use App\Enums\PaymentStatus;
use App\Enums\PurchaseOrderStatus;
use App\Services\PurchaseOrderService;
use App\Services\QuoteService;
use App\Services\StockService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\SetsUpProcurementFixtures;
use Tests\TestCase;
⋮----
/**
 * Scenario 10: Bank Transfer settlement converts reservation to sale_out.
 */
class BankTransferSettlementTest extends TestCase
⋮----
protected function setUp(): void
⋮----
parent::setUp();
⋮----
$this->seed(RolePermissionSeeder::class);
⋮----
public function test_bank_transfer_settlement_converts_reservation_to_sale_out(): void
⋮----
[$buyer, $account] = $this->businessBuyer();
['product' => $product, 'warehouse' => $warehouse] = $this->productWithStock(quantity: 10);
⋮----
$quote = app(QuoteService::class)->request($account, [
⋮----
$quote = app(QuoteService::class)->price($quote, [$quote->items->first()->id => '100.00']);
$purchaseOrder = app(PurchaseOrderService::class)->createFromQuote($quote, $buyer);
⋮----
$approver = $this->inventoryManager();
app(PurchaseOrderService::class)->approve($purchaseOrder, $approver);
⋮----
// Sanity check: reserved, not yet sold, credit consumed.
$level = app(StockService::class)->reconcile($product, $warehouse)->first();
$this->assertSame(10, $level['on_hand']);
$this->assertSame(4, $level['reserved']);
$this->assertSame('456.00', $account->fresh()->outstanding_balance);
⋮----
$settler = $this->salesCashier();
$response = $this->actingAs($settler)->post("/procurement/purchase-orders/{$purchaseOrder->id}/bank-transfer", [
⋮----
$response->assertRedirect("/procurement/purchase-orders/{$purchaseOrder->id}");
⋮----
$purchaseOrder->refresh();
$this->assertSame(PurchaseOrderStatus::Fulfilled, $purchaseOrder->status);
⋮----
$payment = $purchaseOrder->payments()->latest()->first();
$this->assertSame('bank_transfer', $payment->method->value);
$this->assertSame(PaymentStatus::Paid, $payment->status);
⋮----
// Reservation converted to a completed sale: on_hand decreases,
// reserved returns to zero, ledger still balances.
⋮----
$this->assertSame(6, $level['on_hand']);
$this->assertSame(0, $level['reserved']);
$this->assertTrue($level['on_hand_matches']);
$this->assertTrue($level['reserved_matches']);
⋮----
// Debt is paid off.
$this->assertSame('0.00', $account->fresh()->outstanding_balance);
⋮----
public function test_business_buyer_cannot_settle_their_own_purchase_order(): void
⋮----
['product' => $product] = $this->productWithStock();
⋮----
$quote = app(QuoteService::class)->price($quote, [$quote->items->first()->id => '50.00']);
⋮----
app(PurchaseOrderService::class)->approve($purchaseOrder, $this->inventoryManager());
⋮----
$this->actingAs($buyer)->post("/procurement/purchase-orders/{$purchaseOrder->id}/bank-transfer")
->assertForbidden();
````

## File: tests/Feature/Procurement/PurchaseOrderApprovalTest.php
````php
namespace Tests\Feature\Procurement;
⋮----
use App\Enums\ApprovalDecision;
use App\Enums\PurchaseOrderStatus;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\Warehouse;
use App\Services\PurchaseOrderService;
use App\Services\QuoteService;
use App\Services\StockService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\SetsUpProcurementFixtures;
use Tests\TestCase;
⋮----
/**
 * Scenarios 5–8 of the B2B procurement module.
 */
class PurchaseOrderApprovalTest extends TestCase
⋮----
protected function setUp(): void
⋮----
parent::setUp();
⋮----
$this->seed(RolePermissionSeeder::class);
⋮----
/**
     * @return array{purchaseOrder: PurchaseOrder, product: Product, warehouse: Warehouse}
     */
private function pendingPurchaseOrder(string $creditLimit = '100000.00', int $stockQuantity = 10, int $orderQuantity = 4): array
⋮----
[$buyer, $account] = $this->businessBuyer(creditLimit: $creditLimit);
['product' => $product, 'warehouse' => $warehouse] = $this->productWithStock(quantity: $stockQuantity);
⋮----
$quote = app(QuoteService::class)->request($account, [
⋮----
$quote = app(QuoteService::class)->price($quote, [$quote->items->first()->id => '100.00']);
$purchaseOrder = app(PurchaseOrderService::class)->createFromQuote($quote, $buyer);
⋮----
public function test_approver_can_approve_if_credit_is_enough(): void
⋮----
['purchaseOrder' => $purchaseOrder] = $this->pendingPurchaseOrder();
$approver = $this->inventoryManager();
⋮----
$response = $this->actingAs($approver)->post("/procurement/purchase-orders/{$purchaseOrder->id}/approve", [
⋮----
$response->assertRedirect("/procurement/purchase-orders/{$purchaseOrder->id}");
⋮----
$purchaseOrder->refresh();
$this->assertSame(PurchaseOrderStatus::Approved, $purchaseOrder->status);
$this->assertCount(1, $purchaseOrder->approvals);
$this->assertSame(ApprovalDecision::Approved, $purchaseOrder->approvals->first()->decision);
⋮----
public function test_approval_reserves_stock(): void
⋮----
['purchaseOrder' => $purchaseOrder, 'product' => $product, 'warehouse' => $warehouse] = $this->pendingPurchaseOrder(
⋮----
$this->actingAs($approver)->post("/procurement/purchase-orders/{$purchaseOrder->id}/approve");
⋮----
$level = app(StockService::class)->reconcile($product, $warehouse)->first();
$this->assertSame(10, $level['on_hand']);
$this->assertSame(4, $level['reserved']);
$this->assertTrue($level['reserved_matches']);
⋮----
// subtotal 4*100=400.00, +14% VAT = 456.00 total, which is what
// gets added to outstanding_balance on approval.
$account = $purchaseOrder->businessAccount->fresh();
$this->assertSame('456.00', $account->outstanding_balance);
⋮----
public function test_approval_fails_if_credit_limit_exceeded(): void
⋮----
// Credit limit of 100 can't absorb a PO with a total well over it.
⋮----
$response = $this->actingAs($approver)->post("/procurement/purchase-orders/{$purchaseOrder->id}/approve");
⋮----
$response->assertRedirect();
$response->assertSessionHas('flash.error');
⋮----
$this->assertSame(PurchaseOrderStatus::PendingApproval, $purchaseOrder->status);
$this->assertCount(0, $purchaseOrder->approvals);
⋮----
$this->assertSame(0, $level['reserved']);
⋮----
public function test_rejected_purchase_order_does_not_reserve_stock(): void
⋮----
['purchaseOrder' => $purchaseOrder, 'product' => $product, 'warehouse' => $warehouse] = $this->pendingPurchaseOrder();
⋮----
$response = $this->actingAs($approver)->post("/procurement/purchase-orders/{$purchaseOrder->id}/reject", [
⋮----
$this->assertSame(PurchaseOrderStatus::Rejected, $purchaseOrder->status);
$this->assertSame(ApprovalDecision::Rejected, $purchaseOrder->approvals->first()->decision);
⋮----
$this->assertSame('0.00', $account->outstanding_balance);
⋮----
public function test_sales_cashier_cannot_approve_a_purchase_order(): void
⋮----
$cashier = $this->salesCashier();
⋮----
$this->actingAs($cashier)->post("/procurement/purchase-orders/{$purchaseOrder->id}/approve")
->assertForbidden();
````

## File: tests/Feature/Procurement/PurchaseOrderAuthorizationTest.php
````php
namespace Tests\Feature\Procurement;
⋮----
use App\Services\PurchaseOrderService;
use App\Services\QuoteService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\SetsUpProcurementFixtures;
use Tests\TestCase;
⋮----
/**
 * Scenario 9: Business Buyer cannot view another account's PO.
 */
class PurchaseOrderAuthorizationTest extends TestCase
⋮----
protected function setUp(): void
⋮----
parent::setUp();
⋮----
$this->seed(RolePermissionSeeder::class);
⋮----
public function test_business_buyer_cannot_view_another_account_purchase_order(): void
⋮----
[$ownerBuyer, $ownerAccount] = $this->businessBuyer();
[$strangerBuyer] = $this->businessBuyer();
['product' => $product] = $this->productWithStock();
⋮----
$quote = app(QuoteService::class)->request($ownerAccount, [
⋮----
$quote = app(QuoteService::class)->price($quote, [$quote->items->first()->id => '50.00']);
$purchaseOrder = app(PurchaseOrderService::class)->createFromQuote($quote, $ownerBuyer);
⋮----
$this->actingAs($strangerBuyer)->get("/procurement/purchase-orders/{$purchaseOrder->id}")->assertForbidden();
$this->actingAs($ownerBuyer)->get("/procurement/purchase-orders/{$purchaseOrder->id}")->assertOk();
⋮----
public function test_business_buyer_cannot_view_another_account_quote(): void
⋮----
[, $ownerAccount] = $this->businessBuyer();
⋮----
$this->actingAs($strangerBuyer)->get("/procurement/quotes/{$quote->id}")->assertForbidden();
⋮----
public function test_staff_with_po_approve_can_view_any_purchase_order(): void
⋮----
$approver = $this->inventoryManager();
⋮----
$this->actingAs($approver)->get("/procurement/purchase-orders/{$purchaseOrder->id}")->assertOk();
````

## File: tests/Feature/Procurement/QuoteWorkflowTest.php
````php
namespace Tests\Feature\Procurement;
⋮----
use App\Enums\PurchaseOrderStatus;
use App\Enums\QuoteStatus;
use App\Models\PurchaseOrder;
use App\Models\Quote;
use App\Services\QuoteService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\SetsUpProcurementFixtures;
use Tests\TestCase;
⋮----
/**
 * Scenarios 1–4 of the B2B procurement module.
 */
class QuoteWorkflowTest extends TestCase
⋮----
protected function setUp(): void
⋮----
parent::setUp();
⋮----
$this->seed(RolePermissionSeeder::class);
⋮----
public function test_business_buyer_can_create_quote(): void
⋮----
[$buyer] = $this->businessBuyer();
['product' => $product] = $this->productWithStock();
⋮----
$response = $this->actingAs($buyer)->post('/procurement/quotes', [
⋮----
$quote = Quote::query()->firstOrFail();
$response->assertRedirect("/procurement/quotes/{$quote->id}");
⋮----
$this->assertSame(QuoteStatus::Draft, $quote->status);
$this->assertCount(1, $quote->items);
$this->assertSame(5, $quote->items->first()->quantity);
⋮----
public function test_vendor_and_inventory_manager_can_price_quote(): void
⋮----
[, $account] = $this->businessBuyer();
[$vendorUser, $supplier] = $this->vendor();
['product' => $vendorProduct] = $this->productWithStock($supplier);
['product' => $otherProduct] = $this->productWithStock();
⋮----
$vendorQuote = app(QuoteService::class)->request($account, [
⋮----
$response = $this->actingAs($vendorUser)->post("/procurement/quotes/{$vendorQuote->id}/price", [
'prices' => [$vendorQuote->items->first()->id => '150.00'],
⋮----
$response->assertRedirect();
⋮----
$vendorQuote->refresh();
$this->assertSame(QuoteStatus::Sent, $vendorQuote->status);
$this->assertSame('150.00', $vendorQuote->items->first()->fresh()->unit_price);
$this->assertSame('300.00', $vendorQuote->subtotal);
$this->assertSame('42.00', $vendorQuote->tax);
$this->assertSame('342.00', $vendorQuote->total);
⋮----
$manager = $this->inventoryManager();
$managerQuote = app(QuoteService::class)->request($account, [
⋮----
$this->actingAs($manager)->post("/procurement/quotes/{$managerQuote->id}/price", [
'prices' => [$managerQuote->items->first()->id => '99.00'],
])->assertRedirect();
⋮----
$this->assertSame(QuoteStatus::Sent, $managerQuote->fresh()->status);
⋮----
public function test_vendor_cannot_price_a_quote_outside_their_own_products(): void
⋮----
[$vendorUser] = $this->vendor();
['product' => $otherVendorsProduct] = $this->productWithStock();
⋮----
$quote = app(QuoteService::class)->request($account, [
⋮----
$this->actingAs($vendorUser)->post("/procurement/quotes/{$quote->id}/price", [
'prices' => [$quote->items->first()->id => '10.00'],
])->assertForbidden();
⋮----
public function test_accepted_quote_creates_purchase_order_in_pending_approval(): void
⋮----
[$buyer, $account] = $this->businessBuyer();
⋮----
$quote = app(QuoteService::class)->price($quote, [$quote->items->first()->id => '100.00']);
⋮----
$response = $this->actingAs($buyer)->post("/procurement/quotes/{$quote->id}/accept");
⋮----
$purchaseOrder = PurchaseOrder::query()->where('quote_id', $quote->id)->firstOrFail();
$response->assertRedirect("/procurement/purchase-orders/{$purchaseOrder->id}");
⋮----
$this->assertSame(QuoteStatus::Accepted, $quote->fresh()->status);
$this->assertSame(PurchaseOrderStatus::PendingApproval, $purchaseOrder->status);
$this->assertCount(1, $purchaseOrder->items);
$this->assertSame($quote->total, $purchaseOrder->total);
⋮----
public function test_rejected_quote_cannot_create_purchase_order(): void
⋮----
$quote = app(QuoteService::class)->price($quote, [$quote->items->first()->id => '10.00']);
app(QuoteService::class)->reject($quote);
⋮----
$this->actingAs($buyer)->post("/procurement/quotes/{$quote->id}/accept")
->assertRedirect()
->assertSessionHas('flash.error');
⋮----
$this->assertSame(0, PurchaseOrder::query()->count());
⋮----
public function test_expired_quote_cannot_create_purchase_order(): void
⋮----
$quote->forceFill(['expires_at' => now()->subDay()->toDateString()])->save();
⋮----
$this->assertSame(QuoteStatus::Sent, $quote->fresh()->status);
````

## File: tests/Feature/Reports/ReportsTest.php
````php
namespace Tests\Feature\Reports;
⋮----
use App\Enums\PaymentMethod;
use App\Enums\UserRole;
use App\Models\User;
use App\Services\OrderService;
use App\Services\StockService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\Concerns\SetsUpCheckoutFixtures;
use Tests\TestCase;
⋮----
/**
 * Modules 5–9: five reports. Requirement #4 (paginated), #7 (route
 * protection), and basic rendering for each.
 */
class ReportsTest extends TestCase
⋮----
protected function setUp(): void
⋮----
parent::setUp();
⋮----
$this->seed(RolePermissionSeeder::class);
⋮----
private function inventoryManager(): User
⋮----
$user = User::factory()->create();
$user->addRole(UserRole::InventoryManager->value);
⋮----
// --- Low stock report -------------------------------------------------
⋮----
public function test_stock_read_holder_can_view_low_stock_report(): void
⋮----
$manager = $this->inventoryManager();
['product' => $product, 'warehouse' => $warehouse] = $this->productWithRetailStock(quantity: 3);
⋮----
$response = $this->actingAs($manager)->get('/reports/low-stock?threshold=10');
⋮----
$response->assertOk();
$response->assertInertia(fn (Assert $page) => $page
->component('Reports/LowStock')
->has('levels.data', 1)
->where('levels.data.0.product.id', $product->id)
->where('levels.data.0.warehouse.id', $warehouse->id)
⋮----
public function test_unauthorized_user_cannot_view_low_stock_report(): void
⋮----
$customer = $this->retailCustomer();
⋮----
$this->actingAs($customer)->get('/reports/low-stock')->assertForbidden();
⋮----
// --- Stock movement report --------------------------------------------
⋮----
public function test_stock_movement_report_renders_and_is_paginated(): void
⋮----
['product' => $product, 'warehouse' => $warehouse] = $this->productWithRetailStock(quantity: 0);
⋮----
app(StockService::class)->purchaseIn($product, $warehouse, 5, $manager, null);
⋮----
$response = $this->actingAs($manager)->get('/reports/stock-movements');
⋮----
->component('Reports/StockMovements')
->has('movements.data', 3)
->has('movements.links')
⋮----
public function test_unauthorized_user_cannot_view_stock_movement_report(): void
⋮----
$this->actingAs($customer)->get('/reports/stock-movements')->assertForbidden();
⋮----
// --- Sales report -------------------------------------------------
⋮----
public function test_payment_settle_holder_can_view_sales_report(): void
⋮----
$staff = $this->salesCashier();
⋮----
['product' => $product] = $this->productWithRetailStock(quantity: 5);
⋮----
app(OrderService::class)->checkout($customer, [
⋮----
$response = $this->actingAs($staff)->get('/reports/sales');
⋮----
->component('Reports/Sales')
->has('orders.data', 1)
⋮----
public function test_unauthorized_user_cannot_view_sales_report(): void
⋮----
$this->actingAs($customer)->get('/reports/sales')->assertForbidden();
⋮----
// --- Payments report -------------------------------------------------
⋮----
public function test_payment_settle_holder_can_view_payments_report(): void
⋮----
$response = $this->actingAs($staff)->get('/reports/payments');
⋮----
->component('Reports/Payments')
->has('payments.data', 1)
⋮----
public function test_payments_report_filters_by_status(): void
⋮----
$response = $this->actingAs($staff)->get('/reports/payments?status=paid');
⋮----
->has('payments.data', 0)
⋮----
public function test_unauthorized_user_cannot_view_payments_report(): void
⋮----
$this->actingAs($customer)->get('/reports/payments')->assertForbidden();
⋮----
// --- Imports report -------------------------------------------------
⋮----
public function test_import_run_holder_can_view_imports_report(): void
⋮----
$response = $this->actingAs($manager)->get('/reports/imports');
⋮----
$response->assertInertia(fn (Assert $page) => $page->component('Reports/Imports'));
⋮----
public function test_unauthorized_user_cannot_view_imports_report(): void
⋮----
$this->actingAs($customer)->get('/reports/imports')->assertForbidden();
````

## File: tests/Feature/Sales/CheckoutTest.php
````php
namespace Tests\Feature\Sales;
⋮----
use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\StockMovement;
use App\Services\StockService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\SetsUpCheckoutFixtures;
use Tests\TestCase;
⋮----
/**
 * Scenarios 1, 2, 3, 6, 7 of the B2C checkout module.
 */
class CheckoutTest extends TestCase
⋮----
protected function setUp(): void
⋮----
parent::setUp();
⋮----
$this->seed(RolePermissionSeeder::class);
⋮----
public function test_customer_can_checkout(): void
⋮----
$customer = $this->retailCustomer();
['product' => $product] = $this->productWithRetailStock(quantity: 10, price: '100.00');
⋮----
$this->actingAs($customer)->post('/cart/items', ['product_id' => $product->id, 'quantity' => 2])
->assertRedirect();
⋮----
$response = $this->actingAs($customer)->post('/checkout', ['payment_method' => 'cod']);
⋮----
$order = Order::query()->where('user_id', $customer->id)->firstOrFail();
$response->assertRedirect("/orders/{$order->id}");
⋮----
$this->assertSame(OrderStatus::Reserved, $order->status);
$this->assertNotNull($order->reserved_until);
// subtotal 200.00, VAT 14% = 28.00, total 228.00
$this->assertSame('200.00', $order->subtotal);
$this->assertSame('28.00', $order->tax);
$this->assertSame('228.00', $order->total);
⋮----
public function test_checkout_reserves_all_lines(): void
⋮----
['product' => $productA, 'warehouse' => $warehouseA] = $this->productWithRetailStock(quantity: 10);
['product' => $productB, 'warehouse' => $warehouseB] = $this->productWithRetailStock(quantity: 5);
⋮----
$this->actingAs($customer)->post('/cart/items', ['product_id' => $productA->id, 'quantity' => 3]);
$this->actingAs($customer)->post('/cart/items', ['product_id' => $productB->id, 'quantity' => 2]);
$this->actingAs($customer)->post('/checkout', ['payment_method' => 'cod']);
⋮----
$this->assertCount(2, $order->items);
⋮----
$levelA = $stock->reconcile($productA, $warehouseA)->first();
$this->assertSame(3, $levelA['reserved']);
$this->assertTrue($levelA['reserved_matches']);
⋮----
$levelB = $stock->reconcile($productB, $warehouseB)->first();
$this->assertSame(2, $levelB['reserved']);
$this->assertTrue($levelB['reserved_matches']);
⋮----
public function test_partial_availability_fails_without_partial_writes(): void
⋮----
['product' => $available] = $this->productWithRetailStock(quantity: 10);
['product' => $scarce] = $this->productWithRetailStock(quantity: 1);
⋮----
$this->actingAs($customer)->post('/cart/items', ['product_id' => $available->id, 'quantity' => 5]);
// Requesting more than the single unit in stock.
$this->actingAs($customer)->post('/cart/items', ['product_id' => $scarce->id, 'quantity' => 5]);
⋮----
$ordersBefore = Order::query()->count();
$itemsBefore = OrderItem::query()->count();
$movementsBefore = StockMovement::query()->count();
⋮----
$response->assertRedirect();
$response->assertSessionHas('flash.error');
⋮----
$this->assertSame($ordersBefore, Order::query()->count());
$this->assertSame($itemsBefore, OrderItem::query()->count());
$this->assertSame($movementsBefore, StockMovement::query()->count());
⋮----
public function test_fake_payment_success_confirms_order(): void
⋮----
['product' => $product, 'warehouse' => $warehouse] = $this->productWithRetailStock(quantity: 10);
⋮----
$this->actingAs($customer)->post('/cart/items', ['product_id' => $product->id, 'quantity' => 4]);
$this->actingAs($customer)->post('/checkout', ['payment_method' => 'fake_gateway', 'outcome' => 'succeed']);
⋮----
$this->assertSame(OrderStatus::Confirmed, $order->status);
⋮----
$payment = $order->payments()->latest()->first();
$this->assertSame(PaymentStatus::Paid, $payment->status);
⋮----
$level = app(StockService::class)->reconcile($product, $warehouse)->first();
$this->assertSame(6, $level['on_hand']);
$this->assertSame(0, $level['reserved']);
$this->assertTrue($level['on_hand_matches']);
$this->assertTrue($level['reserved_matches']);
⋮----
public function test_fake_payment_failure_does_not_confirm_order(): void
⋮----
$this->actingAs($customer)->post('/checkout', ['payment_method' => 'fake_gateway', 'outcome' => 'fail']);
⋮----
$this->assertSame(OrderStatus::Cancelled, $order->status);
⋮----
$this->assertSame(PaymentStatus::Failed, $payment->status);
⋮----
$this->assertSame(10, $level['on_hand']);
````

## File: tests/Feature/Sales/CodReservationTest.php
````php
namespace Tests\Feature\Sales;
⋮----
use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Services\OrderService;
use App\Services\StockService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\SetsUpCheckoutFixtures;
use Tests\TestCase;
⋮----
/**
 * Scenario 5: COD keeps reservation until delivery confirmation.
 */
class CodReservationTest extends TestCase
⋮----
protected function setUp(): void
⋮----
parent::setUp();
⋮----
$this->seed(RolePermissionSeeder::class);
⋮----
public function test_cod_keeps_reservation_until_delivery_confirmation(): void
⋮----
$customer = $this->retailCustomer();
['product' => $product, 'warehouse' => $warehouse] = $this->productWithRetailStock(quantity: 10);
⋮----
$order = app(OrderService::class)->checkout($customer, [
⋮----
// Checkout alone must NOT confirm the sale — reservation stays intact.
$this->assertSame(OrderStatus::Reserved, $order->status);
$payment = $order->payments()->latest()->first();
$this->assertSame(PaymentStatus::Pending, $payment->status);
⋮----
$level = $stock->reconcile($product, $warehouse)->first();
$this->assertSame(10, $level['on_hand']);
$this->assertSame(3, $level['reserved']);
⋮----
// Staff confirms delivery/settles the COD payment...
$staff = $this->salesCashier();
$this->actingAs($staff)->post("/payments/{$payment->id}/settle")->assertRedirect();
⋮----
// ...only now does the reservation convert to a completed sale.
$order->refresh();
$this->assertSame(OrderStatus::Confirmed, $order->status);
⋮----
$this->assertSame(7, $level['on_hand']);
$this->assertSame(0, $level['reserved']);
⋮----
public function test_retail_customer_cannot_settle_their_own_cod_payment(): void
⋮----
['product' => $product] = $this->productWithRetailStock();
⋮----
$this->actingAs($customer)->post("/payments/{$payment->id}/settle")->assertForbidden();
````

## File: tests/Feature/Sales/OrderAuthorizationTest.php
````php
namespace Tests\Feature\Sales;
⋮----
use App\Enums\PaymentMethod;
use App\Services\OrderService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\SetsUpCheckoutFixtures;
use Tests\TestCase;
⋮----
/**
 * Scenario 4: unauthorized customer cannot view another customer's order.
 */
class OrderAuthorizationTest extends TestCase
⋮----
protected function setUp(): void
⋮----
parent::setUp();
⋮----
$this->seed(RolePermissionSeeder::class);
⋮----
public function test_unauthorized_customer_cannot_view_another_customer_order(): void
⋮----
$owner = $this->retailCustomer();
$stranger = $this->retailCustomer();
['product' => $product] = $this->productWithRetailStock();
⋮----
$order = app(OrderService::class)->checkout($owner, [
⋮----
$this->actingAs($stranger)->get("/orders/{$order->id}")->assertForbidden();
$this->actingAs($owner)->get("/orders/{$order->id}")->assertOk();
⋮----
public function test_staff_with_payment_settle_can_view_any_order(): void
⋮----
$staff = $this->salesCashier();
⋮----
$this->actingAs($staff)->get("/orders/{$order->id}")->assertOk();
⋮----
public function test_guest_cannot_view_orders_index(): void
⋮----
$this->get('/orders')->assertRedirect('/login');
````

## File: tests/Feature/Sales/ReservationExpiryTest.php
````php
namespace Tests\Feature\Sales;
⋮----
use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Services\OrderService;
use App\Services\StockService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\Concerns\SetsUpCheckoutFixtures;
use Tests\TestCase;
⋮----
/**
 * Scenario 8: expired unpaid reservation releases stock.
 */
class ReservationExpiryTest extends TestCase
⋮----
protected function setUp(): void
⋮----
parent::setUp();
⋮----
$this->seed(RolePermissionSeeder::class);
⋮----
public function test_expired_unpaid_reservation_releases_stock(): void
⋮----
$customer = $this->retailCustomer();
['product' => $product, 'warehouse' => $warehouse] = $this->productWithRetailStock(quantity: 10);
⋮----
$order = app(OrderService::class)->checkout($customer, [
⋮----
$this->assertSame(OrderStatus::Reserved, $order->status);
⋮----
// Simulate time passing — reserved_until is in the past now.
$order->forceFill(['reserved_until' => now()->subMinute()])->save();
⋮----
$this->artisan('stock:release-expired-reservations')
->expectsOutputToContain('Released 1 expired reservation(s).')
->assertExitCode(0);
⋮----
$order->refresh();
$this->assertSame(OrderStatus::Cancelled, $order->status);
⋮----
$payment = $order->payments()->latest()->first();
$this->assertSame(PaymentStatus::Failed, $payment->status);
⋮----
$level = app(StockService::class)->reconcile($product, $warehouse)->first();
$this->assertSame(10, $level['on_hand']);
$this->assertSame(0, $level['reserved']);
$this->assertTrue($level['on_hand_matches']);
$this->assertTrue($level['reserved_matches']);
⋮----
public function test_non_expired_reservation_is_left_alone(): void
⋮----
['product' => $product] = $this->productWithRetailStock(quantity: 10);
⋮----
Artisan::call('stock:release-expired-reservations');
````

## File: tests/Feature/Schema/DatabaseSchemaTest.php
````php
namespace Tests\Feature\Schema;
⋮----
use App\Enums\ApprovalDecision;
use App\Enums\ImportEntity;
use App\Enums\ImportStatus;
use App\Enums\MovementType;
use App\Models\BusinessAccount;
use App\Models\Category;
use App\Models\ImportBatch;
use App\Models\ImportRow;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\PoApproval;
use App\Models\PoItem;
use App\Models\PriceList;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\Quote;
use App\Models\QuoteItem;
use App\Models\StockLevel;
use App\Models\StockMovement;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\Concerns\UsesRealMysqlDatabase;
use Tests\TestCase;
⋮----
/**
 * Schema-level tests for the base StockFlow database, per
 * docs/project/canonical-decisions.md §5/§6 and the Enterprise PRD §6.
 *
 * These deliberately run against real MySQL (a dedicated `stockflow_testing`
 * database on the same server as dev, never the dev database itself) rather
 * than the suite's default SQLite `:memory:` connection: FULLTEXT indexes,
 * MySQL ENUM columns, and real FK/unique-constraint enforcement don't behave
 * identically on SQLite. This mirrors the PRD's own requirement that the
 * no-oversell concurrency test run against MySQL, not SQLite.
 */
class DatabaseSchemaTest extends TestCase
⋮----
private static bool $migrated = false;
⋮----
protected function setUp(): void
⋮----
parent::setUp();
⋮----
$this->useRealMysqlDatabase();
⋮----
$this->migrateRealMysqlDatabaseOnce();
⋮----
protected function tearDown(): void
⋮----
$this->restoreOriginalDatabaseConnection();
⋮----
parent::tearDown();
⋮----
public function test_migrations_run_successfully(): void
⋮----
$this->assertTrue(
Schema::connection('mysql')->hasTable($table),
⋮----
public function test_products_sku_is_unique(): void
⋮----
Product::factory()->create(['sku' => 'DUPLICATE-SKU']);
⋮----
$this->expectException(QueryException::class);
⋮----
public function test_stock_levels_has_unique_product_and_warehouse(): void
⋮----
$level = StockLevel::factory()->create();
⋮----
StockLevel::factory()->create([
⋮----
public function test_payments_gateway_ref_is_unique(): void
⋮----
Payment::factory()->create(['gateway_ref' => 'DUPLICATE-REF']);
⋮----
public function test_products_name_has_a_fulltext_index(): void
⋮----
$indexes = DB::connection('mysql')->select(
⋮----
$this->assertNotEmpty($indexes, 'Expected a FULLTEXT index on products.name.');
$this->assertSame('FULLTEXT', $indexes[0]->Index_type);
⋮----
public function test_available_stock_is_computed_not_stored(): void
⋮----
$this->assertFalse(
Schema::connection('mysql')->hasColumn('stock_levels', 'available'),
⋮----
$level = StockLevel::factory()->create(['on_hand' => 50, 'reserved' => 12]);
⋮----
$this->assertSame(38, $level->available);
⋮----
public function test_products_table_has_no_quantity_column(): void
⋮----
$this->assertFalse(Schema::connection('mysql')->hasColumn('products', 'quantity'));
⋮----
public function test_catalog_relationships_resolve_correctly(): void
⋮----
$parent = Category::factory()->create(['name' => 'Electronics', 'slug' => 'electronics-rel-test']);
$child = Category::factory()->create(['parent_id' => $parent->id, 'name' => 'Phones', 'slug' => 'phones-rel-test']);
$supplier = Supplier::factory()->create();
$product = Product::factory()->create(['category_id' => $child->id, 'supplier_id' => $supplier->id]);
⋮----
$this->assertTrue($child->parent->is($parent));
$this->assertTrue($parent->children->contains($child));
$this->assertTrue($product->category->is($child));
$this->assertTrue($product->supplier->is($supplier));
$this->assertTrue($supplier->products->contains($product));
⋮----
public function test_stock_ledger_and_projection_relationships_resolve_correctly(): void
⋮----
$warehouse = Warehouse::factory()->create();
$product = Product::factory()->create();
$actor = User::factory()->create();
⋮----
$movement = StockMovement::query()->create([
⋮----
$level = StockLevel::factory()->create([
⋮----
$this->assertTrue($movement->product->is($product));
$this->assertTrue($movement->warehouse->is($warehouse));
$this->assertTrue($movement->actor->is($actor));
$this->assertTrue($level->product->is($product));
$this->assertTrue($level->warehouse->is($warehouse));
$this->assertTrue($product->stockMovements->contains($movement));
$this->assertTrue($product->stockLevels->contains($level));
⋮----
public function test_pricing_relationships_resolve_correctly(): void
⋮----
$priceList = PriceList::factory()->create();
⋮----
$item = $priceList->items()->create([
⋮----
$this->assertTrue($priceList->items->contains($item));
$this->assertTrue($item->priceList->is($priceList));
$this->assertTrue($item->product->is($product));
$this->assertTrue($product->priceListItems->contains($item));
⋮----
public function test_b2c_order_relationships_resolve_correctly(): void
⋮----
$order = Order::factory()->create();
⋮----
$item = OrderItem::query()->create([
⋮----
$payment = Payment::factory()->create([
⋮----
$this->assertTrue($order->user->is($order->user));
$this->assertTrue($order->items->contains($item));
$this->assertTrue($item->order->is($order));
⋮----
$this->assertTrue($item->warehouse->is($warehouse));
$this->assertTrue($order->payments->contains($payment));
$this->assertTrue($payment->payable->is($order));
⋮----
public function test_b2b_quote_to_purchase_order_relationships_resolve_correctly(): void
⋮----
$businessAccount = BusinessAccount::factory()->create();
$quote = Quote::factory()->create(['business_account_id' => $businessAccount->id]);
⋮----
$quoteItem = QuoteItem::query()->create([
⋮----
$purchaseOrder = PurchaseOrder::factory()->create([
⋮----
$poItem = PoItem::query()->create([
⋮----
$approver = User::factory()->create();
$approval = PoApproval::query()->create([
⋮----
$payment = Payment::factory()->forPurchaseOrder($purchaseOrder)->create();
⋮----
$this->assertTrue($businessAccount->user->is($businessAccount->user));
$this->assertTrue($businessAccount->quotes->contains($quote));
$this->assertTrue($quote->businessAccount->is($businessAccount));
$this->assertTrue($quote->items->contains($quoteItem));
$this->assertTrue($purchaseOrder->quote->is($quote));
$this->assertTrue($purchaseOrder->businessAccount->is($businessAccount));
$this->assertTrue($purchaseOrder->items->contains($poItem));
$this->assertTrue($purchaseOrder->approvals->contains($approval));
$this->assertTrue($approval->approver->is($approver));
$this->assertTrue($purchaseOrder->payments->contains($payment));
$this->assertTrue($payment->payable->is($purchaseOrder));
⋮----
public function test_import_relationships_resolve_correctly(): void
⋮----
$uploader = User::factory()->create();
$batch = ImportBatch::query()->create([
⋮----
$row = ImportRow::query()->create([
⋮----
$this->assertTrue($batch->uploader->is($uploader));
$this->assertTrue($batch->rows->contains($row));
$this->assertTrue($row->importBatch->is($batch));
````

## File: tests/Feature/Stock/StockConcurrencyTest.php
````php
namespace Tests\Feature\Stock;
⋮----
use App\Models\Product;
use App\Models\Warehouse;
use App\Services\StockService;
use Tests\Concerns\UsesRealMysqlDatabase;
use Tests\TestCase;
⋮----
/**
 * Proves no-oversell under real concurrency (rule #10/#9 in
 * docs/project/canonical-decisions.md §6) — two genuinely separate DB
 * connections racing to reserve the last unit of stock. This needs real
 * MySQL row locking (SELECT ... FOR UPDATE), which SQLite (the suite's
 * default) can't provide, so it uses UsesRealMysqlDatabase like
 * DatabaseSchemaTest.
 */
class StockConcurrencyTest extends TestCase
⋮----
private static bool $migrated = false;
⋮----
protected function setUp(): void
⋮----
parent::setUp();
⋮----
$this->useRealMysqlDatabase();
⋮----
$this->migrateRealMysqlDatabaseOnce();
⋮----
protected function tearDown(): void
⋮----
$this->restoreOriginalDatabaseConnection();
⋮----
parent::tearDown();
⋮----
public function test_concurrent_reservation_for_last_unit_gives_exactly_one_success(): void
⋮----
$product = Product::factory()->create();
$warehouse = Warehouse::factory()->create();
⋮----
app(StockService::class)->purchaseIn($product, $warehouse, 1, null, null);
⋮----
[$outputA, $outputB] = $this->runConcurrentReservations($product->id, $warehouse->id);
⋮----
$this->assertCount(1, $successes, "Expected exactly one success, got: {$outputA} / {$outputB}");
$this->assertCount(1, $failures);
$this->assertStringContainsString('OutOfStockException', array_values($failures)[0]);
⋮----
$level = app(StockService::class)->reconcile($product, $warehouse)->first();
$this->assertSame(1, $level['on_hand']);
$this->assertSame(1, $level['reserved']);
$this->assertTrue($level['on_hand_matches']);
$this->assertTrue($level['reserved_matches']);
⋮----
/**
     * @return array{0: string, 1: string}
     */
private function runConcurrentReservations(string $productId, string $warehouseId): array
````

## File: tests/Feature/Stock/StockLevelCacheTest.php
````php
namespace Tests\Feature\Stock;
⋮----
use App\Enums\UserRole;
use App\Models\Product;
use App\Models\User;
use App\Models\Warehouse;
use App\Services\StockService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;
⋮----
/**
 * Proves requirement #3 of the hardening pass: stock level reads
 * (Stock/Levels index — StockService::listLevels()) are cached, and every
 * stock movement flushes that cache so the next read is never stale. See
 * docs/technical/cache.md §"Stock levels — cached carefully".
 */
class StockLevelCacheTest extends TestCase
⋮----
protected function setUp(): void
⋮----
parent::setUp();
⋮----
$this->seed(RolePermissionSeeder::class);
⋮----
private function inventoryManager(): User
⋮----
$user = User::factory()->create();
$user->addRole(UserRole::InventoryManager->value);
⋮----
public function test_stock_level_cache_invalidates_after_a_stock_movement(): void
⋮----
$manager = $this->inventoryManager();
$product = Product::factory()->create();
$warehouse = Warehouse::factory()->create();
⋮----
app(StockService::class)->purchaseIn($product, $warehouse, 10, $manager, null);
⋮----
// Warm the cache with the pre-movement on_hand value.
$this->actingAs($manager)->get($query)
->assertInertia(fn (Assert $page) => $page->where('levels.data.0.on_hand', 10));
⋮----
app(StockService::class)->purchaseIn($product, $warehouse, 5, $manager, null);
⋮----
// If the cache had not been flushed by the second purchaseIn(),
// this would still report 10.
⋮----
->assertInertia(fn (Assert $page) => $page->where('levels.data.0.on_hand', 15));
⋮----
public function test_stock_level_cache_invalidates_after_an_adjustment(): void
⋮----
// SuperAdmin, not Inventory Manager — WarehouseScopeMiddleware
// requires an Inventory Manager to be team-scoped to the specific
// warehouse, which isn't this test's concern (see
// StockWarehouseScopeTest for that).
$admin = User::factory()->create();
$admin->addRole(UserRole::SuperAdmin->value);
⋮----
app(StockService::class)->purchaseIn($product, $warehouse, 20, $admin, null);
⋮----
$this->actingAs($admin)->get($query)
->assertInertia(fn (Assert $page) => $page->where('levels.data.0.on_hand', 20));
⋮----
$this->actingAs($admin)->post('/stock/adjustments', [
⋮----
])->assertRedirect();
````

## File: tests/Feature/Stock/StockWarehouseScopeTest.php
````php
namespace Tests\Feature\Stock;
⋮----
use App\Enums\UserRole;
use App\Models\Product;
use App\Models\User;
use App\Models\Warehouse;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
⋮----
/**
 * Proves warehouse-team scoping (docs/project/canonical-decisions.md §3):
 * an Inventory Manager assigned to one warehouse's Laratrust team cannot
 * move stock in a warehouse outside that team, at both layers that enforce
 * it — the FormRequest's policy check and WarehouseScopeMiddleware.
 */
class StockWarehouseScopeTest extends TestCase
⋮----
protected function setUp(): void
⋮----
parent::setUp();
⋮----
$this->seed(RolePermissionSeeder::class);
⋮----
public function test_inventory_manager_cannot_move_stock_outside_assigned_warehouse_team(): void
⋮----
$ownWarehouse = Warehouse::factory()->create();
$otherWarehouse = Warehouse::factory()->create();
$product = Product::factory()->create();
⋮----
$manager = User::factory()->create();
$manager->addRole(UserRole::InventoryManager->value, $ownWarehouse->fresh()->team);
⋮----
$response = $this->actingAs($manager)->post('/stock/adjustments', [
⋮----
$response->assertForbidden();
$this->assertDatabaseMissing('stock_movements', [
⋮----
public function test_inventory_manager_can_move_stock_inside_assigned_warehouse_team(): void
⋮----
$response->assertRedirect();
$this->assertDatabaseHas('stock_movements', [
⋮----
public function test_super_admin_can_move_stock_in_any_warehouse(): void
⋮----
$warehouse = Warehouse::factory()->create();
⋮----
$admin = User::factory()->create();
$admin->addRole(UserRole::SuperAdmin->value);
⋮----
$response = $this->actingAs($admin)->post('/stock/adjustments', [
````

## File: tests/Feature/Storefront/CheckoutGateTest.php
````php
namespace Tests\Feature\Storefront;
⋮----
use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\StockMovement;
use App\Services\StockService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\SetsUpCheckoutFixtures;
use Tests\TestCase;
⋮----
/**
 * The /checkout auth gate: a guest must never create an order, payment, or
 * stock reservation, and must be redirected to /login with a specific
 * flash message. An authenticated Retail Customer must still be able to
 * check out normally, with the cart carried over from before login. See
 * the storefront requirements' Guest rules #12-#18 and Authenticated
 * Retail Customer rules #1-#4.
 */
class CheckoutGateTest extends TestCase
⋮----
protected function setUp(): void
⋮----
parent::setUp();
$this->seed(RolePermissionSeeder::class);
⋮----
public function test_guest_visiting_checkout_is_redirected_to_login_with_flash_message(): void
⋮----
$response = $this->get('/checkout');
⋮----
$response->assertRedirect('/login');
$response->assertSessionHas('flash.error', 'Please log in to complete your order.');
⋮----
public function test_guest_posting_to_checkout_is_redirected_to_login_without_creating_an_order(): void
⋮----
['product' => $product] = $this->productWithRetailStock(quantity: 10);
$this->post('/cart/items', ['product_id' => $product->id, 'quantity' => 1]);
⋮----
$response = $this->post('/checkout', ['payment_method' => 'cod']);
⋮----
public function test_guest_cannot_create_a_final_order(): void
⋮----
$this->post('/checkout', ['payment_method' => 'cod']);
⋮----
$this->assertSame(0, Order::query()->count());
$this->assertSame(0, OrderItem::query()->count());
⋮----
public function test_guest_cannot_create_a_payment(): void
⋮----
$this->post('/checkout', ['payment_method' => 'fake_gateway', 'outcome' => 'succeed']);
⋮----
$this->assertSame(0, Payment::query()->count());
⋮----
public function test_guest_cannot_reserve_stock(): void
⋮----
// productWithRetailStock() itself writes one purchase_in movement —
// the assertion is that checkout adds none on top of it, not that
// the ledger is empty.
$movementsBefore = StockMovement::query()->count();
⋮----
$this->assertSame($movementsBefore, StockMovement::query()->count());
⋮----
public function test_authenticated_retail_customer_can_access_checkout(): void
⋮----
$customer = $this->retailCustomer();
⋮----
$this->actingAs($customer)->get('/checkout')->assertOk();
⋮----
public function test_authenticated_retail_customer_can_create_order_from_cart(): void
⋮----
['product' => $product] = $this->productWithRetailStock(quantity: 10, price: '30.00');
⋮----
// Cart built while still a guest — the requirement is that it
// survives the guest -> authenticated transition.
$this->post('/cart/items', ['product_id' => $product->id, 'quantity' => 2]);
⋮----
$response = $this->actingAs($customer)->post('/checkout', ['payment_method' => 'cod']);
⋮----
$order = Order::query()->where('user_id', $customer->id)->first();
$this->assertNotNull($order);
$response->assertRedirect("/orders/{$order->id}");
$this->assertSame(OrderStatus::Reserved, $order->status);
⋮----
public function test_stock_reservation_happens_only_during_authenticated_checkout(): void
⋮----
['product' => $product, 'warehouse' => $warehouse] = $this->productWithRetailStock(quantity: 10);
⋮----
// Adding to cart as a guest must not move the needle at all —
// productWithRetailStock() itself writes one purchase_in movement,
// so compare against that baseline rather than assuming zero.
⋮----
$this->post('/cart/items', ['product_id' => $product->id, 'quantity' => 3]);
⋮----
$this->actingAs($customer)->post('/checkout', ['payment_method' => 'cod']);
⋮----
$level = app(StockService::class)->reconcile($product, $warehouse)->first();
$this->assertSame(3, $level['reserved']);
$this->assertTrue($level['reserved_matches']);
````

## File: tests/Feature/Storefront/GuestCartTest.php
````php
namespace Tests\Feature\Storefront;
⋮----
use App\Models\Product;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\Concerns\SetsUpCheckoutFixtures;
use Tests\TestCase;
⋮----
/**
 * Guest session cart: add/update/remove, persistence, and the "never
 * reserves stock, never writes anything but the session" invariant. See
 * the storefront requirements' Guest rules #8-#17 and Cart rules #1-#10.
 */
class GuestCartTest extends TestCase
⋮----
protected function setUp(): void
⋮----
parent::setUp();
$this->seed(RolePermissionSeeder::class);
⋮----
public function test_guest_can_add_active_in_stock_product_to_session_cart(): void
⋮----
['product' => $product] = $this->productWithRetailStock(quantity: 10, price: '25.00');
⋮----
$response = $this->post('/cart/items', ['product_id' => $product->id, 'quantity' => 2]);
⋮----
$response->assertRedirect('/cart');
$response->assertSessionHas('flash.success');
⋮----
$this->get('/cart')->assertInertia(fn (Assert $page) => $page
->component('Storefront/Cart/Show')
->has('lines', 1)
->where('lines.0.quantity', 2)
->where('subtotal', '50.00')
⋮----
public function test_guest_cannot_add_inactive_product_to_cart(): void
⋮----
$product = Product::factory()->create(['is_active' => false]);
⋮----
$response = $this->post('/cart/items', ['product_id' => $product->id, 'quantity' => 1]);
⋮----
$response->assertRedirect();
$response->assertSessionHas('flash.error');
⋮----
$this->get('/cart')->assertInertia(fn (Assert $page) => $page->has('lines', 0));
⋮----
public function test_guest_cannot_add_out_of_stock_product_to_cart(): void
⋮----
['product' => $product] = $this->productWithRetailStock(quantity: 0);
⋮----
public function test_guest_can_update_cart_quantity(): void
⋮----
['product' => $product] = $this->productWithRetailStock(quantity: 10);
$this->post('/cart/items', ['product_id' => $product->id, 'quantity' => 1]);
⋮----
$response = $this->patch("/cart/items/{$product->id}", ['quantity' => 4]);
⋮----
$this->get('/cart')->assertInertia(fn (Assert $page) => $page->where('lines.0.quantity', 4));
⋮----
public function test_guest_can_remove_cart_item(): void
⋮----
$response = $this->delete("/cart/items/{$product->id}");
⋮----
public function test_guest_can_clear_the_whole_cart(): void
⋮----
['product' => $productA] = $this->productWithRetailStock(quantity: 10);
['product' => $productB] = $this->productWithRetailStock(quantity: 10);
$this->post('/cart/items', ['product_id' => $productA->id, 'quantity' => 1]);
$this->post('/cart/items', ['product_id' => $productB->id, 'quantity' => 1]);
⋮----
$response = $this->delete('/cart');
⋮----
public function test_guest_cart_persists_across_requests_in_session(): void
⋮----
// Reuse the same session across requests (default TestCase behavior
// keeps cookies within one test), simulating a guest browsing
// multiple pages without logging in.
$this->post('/cart/items', ['product_id' => $product->id, 'quantity' => 3]);
⋮----
$this->get('/products')->assertInertia(fn (Assert $page) => $page->where('cart.count', 3));
$this->get('/cart')->assertInertia(fn (Assert $page) => $page->where('lines.0.quantity', 3));
⋮----
public function test_cart_count_is_shared_with_every_inertia_response(): void
⋮----
$this->post('/cart/items', ['product_id' => $product->id, 'quantity' => 2]);
⋮----
$this->get('/')->assertInertia(fn (Assert $page) => $page->where('cart.count', 2));
⋮----
public function test_guest_cart_remains_available_after_login(): void
⋮----
$customer = $this->retailCustomer();
⋮----
$this->actingAs($customer)
->get('/cart')
->assertInertia(fn (Assert $page) => $page->has('lines', 1)->where('lines.0.quantity', 2));
````

## File: tests/Feature/Storefront/PublicBrowsingTest.php
````php
namespace Tests\Feature\Storefront;
⋮----
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\Concerns\SetsUpCheckoutFixtures;
use Tests\TestCase;
⋮----
/**
 * Guest storefront browsing: home, listing, search, category filter,
 * product detail — no auth required anywhere in this file. See the
 * storefront requirements' Guest rules #1-#7 and Product visibility
 * rules #1-#2.
 */
class PublicBrowsingTest extends TestCase
⋮----
public function test_guest_can_view_home_page(): void
⋮----
['product' => $product] = $this->productWithRetailStock();
⋮----
$this->get('/')
->assertOk()
->assertInertia(fn (Assert $page) => $page
->component('Storefront/Home')
->has('featuredProducts', 1)
->where('featuredProducts.0.sku', $product->sku)
⋮----
public function test_guest_can_view_public_product_listing(): void
⋮----
$this->productWithRetailStock();
⋮----
$this->get('/products')
⋮----
->component('Storefront/Products/Index')
->has('products.data', 2)
⋮----
public function test_guest_can_search_products(): void
⋮----
$product = Product::factory()->create(['name' => 'Wireless Mouse']);
Product::factory()->create(['name' => 'Desk Lamp']);
⋮----
$this->get('/search?q=Wireless')
⋮----
->component('Storefront/Search')
->has('products.data', 1)
->where('products.data.0.sku', $product->sku)
⋮----
public function test_guest_can_filter_products_by_category(): void
⋮----
$categoryA = Category::factory()->create();
$categoryB = Category::factory()->create();
⋮----
$productA = Product::factory()->create(['category_id' => $categoryA->id]);
Product::factory()->create(['category_id' => $categoryB->id]);
⋮----
$this->get("/categories/{$categoryA->slug}")
⋮----
->component('Storefront/Categories/Show')
⋮----
->where('products.data.0.sku', $productA->sku)
⋮----
public function test_guest_can_view_active_product_detail_by_sku(): void
⋮----
['product' => $product] = $this->productWithRetailStock(quantity: 50, price: '49.99');
⋮----
$this->get("/products/{$product->sku}")
⋮----
->component('Storefront/Products/Show')
->where('product.sku', $product->sku)
->where('product.price', '49.99')
->where('product.stock_status', 'in_stock')
->missing('product.quantity')
->missing('product.on_hand')
->missing('product.available')
⋮----
public function test_inactive_product_is_not_visible_in_public_listing(): void
⋮----
Product::factory()->create(['is_active' => false]);
⋮----
->assertInertia(fn (Assert $page) => $page->has('products.data', 0));
⋮----
public function test_guest_cannot_view_inactive_product_detail(): void
⋮----
$product = Product::factory()->create(['is_active' => false]);
⋮----
$this->get("/products/{$product->sku}")->assertNotFound();
⋮----
public function test_guest_cannot_view_nonexistent_product_detail(): void
⋮----
$this->get('/products/NO-SUCH-SKU')->assertNotFound();
````

## File: tests/Feature/Storefront/StorefrontCacheTest.php
````php
namespace Tests\Feature\Storefront;
⋮----
use App\Enums\UserRole;
use App\Models\Product;
use App\Models\User;
use App\Services\CatalogService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;
⋮----
/**
 * Public product/category listings are cached under the same 'catalog' tag
 * CatalogService already uses (StorefrontCatalogService reuses
 * CatalogService::listCategories() directly for categories, and shares the
 * tag for its own product-listing cache keys) — so a write through the
 * existing admin CatalogService flushes both. See docs/technical/cache.md
 * and the storefront requirements' Caching rules #1-#3.
 */
class StorefrontCacheTest extends TestCase
⋮----
private function inventoryManager(): User
⋮----
$this->seed(RolePermissionSeeder::class);
$user = User::factory()->create();
$user->addRole(UserRole::InventoryManager->value);
⋮----
public function test_public_product_cache_invalidates_after_product_update(): void
⋮----
$manager = $this->inventoryManager();
$product = Product::factory()->create(['name' => 'Original Name']);
⋮----
$this->get('/products')->assertInertia(fn (Assert $page) => $page
->where('products.data.0.name', 'Original Name')
⋮----
$this->actingAs($manager)->put("/catalog/products/{$product->id}", [
⋮----
])->assertRedirect();
⋮----
->where('products.data.0.name', 'Updated Name')
⋮----
public function test_public_category_cache_invalidates_after_category_creation(): void
⋮----
// publicCategories is shared on every Inertia response — warm the
// cache with the pre-creation (empty) state first.
$this->get('/')->assertInertia(fn (Assert $page) => $page->has('publicCategories', 0));
⋮----
app(CatalogService::class)->createCategory(['name' => 'New Category', 'slug' => 'new-category']);
⋮----
$this->get('/')->assertInertia(fn (Assert $page) => $page
->has('publicCategories', 1)
->where('publicCategories.0.name', 'New Category')
````

## File: tests/Feature/DashboardTest.php
````php
namespace Tests\Feature;
⋮----
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;
⋮----
class DashboardTest extends TestCase
⋮----
public function test_guests_are_redirected_to_login(): void
⋮----
$response = $this->get('/dashboard');
⋮----
$response->assertRedirect('/login');
⋮----
public function test_authenticated_users_receive_an_inertia_dashboard_response(): void
⋮----
$user = User::factory()->create();
⋮----
$response = $this->actingAs($user)->get('/dashboard');
⋮----
$response->assertOk();
$response->assertInertia(fn (Assert $page) => $page
->component('Dashboard')
->where('auth.user.email', $user->email)
````

## File: tests/Feature/ExampleTest.php
````php
namespace Tests\Feature;
⋮----
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
⋮----
class ExampleTest extends TestCase
⋮----
/**
     * / is the public storefront home page — guests no longer get bounced
     * to /login, see the storefront requirements' Guest rule #1. Superseded
     * the previous "guests are redirected to login" expectation.
     */
public function test_guests_can_view_the_home_page(): void
⋮----
$response = $this->get('/');
⋮----
$response->assertOk();
````

## File: tests/Feature/RateLimitingTest.php
````php
namespace Tests\Feature;
⋮----
use App\Enums\UserRole;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\RateLimiter;
use Tests\TestCase;
⋮----
/**
 * Hardening requirement #6/#9: login, checkout, and payment-webhook routes
 * are rate limited (see AppServiceProvider::boot()). /api/v1's `api`
 * limiter already existed and is covered by tests/Feature/Api.
 */
class RateLimitingTest extends TestCase
⋮----
protected function setUp(): void
⋮----
parent::setUp();
⋮----
$this->seed(RolePermissionSeeder::class);
⋮----
public function test_login_is_rate_limited_per_ip_and_email(): void
⋮----
$this->post('/login', ['email' => 'nobody@test.com', 'password' => 'wrong'])
->assertStatus(302);
⋮----
->assertStatus(429);
⋮----
public function test_login_rate_limit_is_scoped_per_email_not_globally(): void
⋮----
RateLimiter::clear('login');
⋮----
$this->post('/login', ['email' => 'victim@test.com', 'password' => 'wrong'])
⋮----
// A different email from the same IP is not caught by the first
// email's lockout.
$this->post('/login', ['email' => 'someone-else@test.com', 'password' => 'wrong'])
⋮----
public function test_checkout_is_rate_limited_per_user(): void
⋮----
$customer = User::factory()->create();
$customer->addRole(UserRole::RetailCustomer->value);
⋮----
$this->actingAs($customer)->post('/checkout', ['payment_method' => 'cod']);
⋮----
$this->actingAs($customer)->post('/checkout', ['payment_method' => 'cod'])
⋮----
public function test_payment_webhook_is_rate_limited_per_ip(): void
⋮----
$this->postJson('/webhooks/v1/fake-gateway', []);
⋮----
$this->postJson('/webhooks/v1/fake-gateway', [])
````

## File: tests/Feature/SecurityHeadersTest.php
````php
namespace Tests\Feature;
⋮----
use Tests\TestCase;
⋮----
class SecurityHeadersTest extends TestCase
⋮----
public function test_responses_include_baseline_security_headers(): void
⋮----
$response = $this->get('/login');
⋮----
$response->assertHeader('X-Content-Type-Options', 'nosniff');
$response->assertHeader('X-Frame-Options', 'DENY');
$response->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
$response->assertHeader('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');
````

## File: tests/Unit/Services/ServiceContainerResolutionTest.php
````php
namespace Tests\Unit\Services;
⋮----
use App\Repositories\Contracts\ImportRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\PurchaseOrderRepositoryInterface;
use App\Repositories\Contracts\QuoteRepositoryInterface;
use App\Repositories\Contracts\StockRepositoryInterface;
use App\Repositories\ImportRepository;
use App\Repositories\OrderRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\ProductRepository;
use App\Repositories\PurchaseOrderRepository;
use App\Repositories\QuoteRepository;
use App\Repositories\StockRepository;
use App\Services\CatalogService;
use App\Services\ImportService;
use App\Services\OrderService;
use App\Services\PaymentService;
use App\Services\PurchaseOrderService;
use App\Services\QuoteService;
use App\Services\StockService;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;
⋮----
/**
 * Proves the shared backend architecture (Controller → FormRequest →
 * Service → Repository → Model) is correctly wired end to end at the
 * container level: every service resolves, and does so with its repository
 * dependencies satisfied via the bound interfaces (not concrete classes),
 * per docs/project/canonical-decisions.md §2.
 */
class ServiceContainerResolutionTest extends TestCase
⋮----
/**
     * @return array<string, array{0: class-string}>
     */
public static function serviceClasses(): array
⋮----
public function test_service_resolves_from_the_container(string $serviceClass): void
⋮----
$service = $this->app->make($serviceClass);
⋮----
$this->assertInstanceOf($serviceClass, $service);
⋮----
/**
     * @return array<string, array{0: class-string, 1: class-string}>
     */
public static function repositoryBindings(): array
⋮----
public function test_repository_interface_resolves_to_its_concrete_implementation(
⋮----
$repository = $this->app->make($interface);
⋮----
$this->assertInstanceOf($concrete, $repository);
````

## File: tests/Unit/Services/StockServiceTest.php
````php
namespace Tests\Unit\Services;
⋮----
use App\Enums\MovementType;
use App\Exceptions\InvalidStateTransitionException;
use App\Exceptions\OutOfStockException;
use App\Models\Product;
use App\Models\StockMovement;
use App\Models\User;
use App\Models\Warehouse;
use App\Services\StockService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
⋮----
/**
 * Unit-level proof of the stock engine's 12 invariants from
 * docs/project/canonical-decisions.md §6. Runs against the suite's default
 * SQLite connection — no real concurrency is exercised here (see
 * tests/Feature/Stock/StockConcurrencyTest.php for that), just correctness
 * of each operation in isolation.
 */
class StockServiceTest extends TestCase
⋮----
private StockService $stock;
⋮----
protected function setUp(): void
⋮----
parent::setUp();
⋮----
public function test_purchase_in_increases_on_hand(): void
⋮----
$product = Product::factory()->create();
$warehouse = Warehouse::factory()->create();
$actor = User::factory()->create();
⋮----
$level = $this->stock->purchaseIn($product, $warehouse, 50, $actor, null);
⋮----
$this->assertSame(50, $level->on_hand);
$this->assertSame(0, $level->reserved);
$this->assertDatabaseHas('stock_movements', [
⋮----
public function test_reserve_increases_reserved_and_keeps_on_hand(): void
⋮----
$this->stock->purchaseIn($product, $warehouse, 100, null, null);
⋮----
$level = $this->stock->reserve($product, $warehouse, 30, null, null);
⋮----
$this->assertSame(100, $level->on_hand);
$this->assertSame(30, $level->reserved);
$this->assertSame(70, $level->available);
⋮----
public function test_reserve_fails_if_available_is_less_than_requested_quantity(): void
⋮----
$this->stock->purchaseIn($product, $warehouse, 10, null, null);
$this->stock->reserve($product, $warehouse, 10, null, null);
⋮----
$this->expectException(OutOfStockException::class);
⋮----
$this->stock->reserve($product, $warehouse, 1, null, null);
⋮----
public function test_reserve_does_not_write_a_movement_or_mutate_level_when_it_fails(): void
⋮----
$this->stock->purchaseIn($product, $warehouse, 5, null, null);
⋮----
$this->stock->reserve($product, $warehouse, 999, null, null);
$this->fail('Expected OutOfStockException.');
⋮----
// expected
⋮----
$this->assertSame(0, StockMovement::query()->where('type', MovementType::Reservation->value)->count());
$this->assertSame(5, $this->stock->reconcile($product, $warehouse)->first()['on_hand']);
⋮----
public function test_release_decreases_reserved(): void
⋮----
$this->stock->reserve($product, $warehouse, 40, null, null);
⋮----
$level = $this->stock->release($product, $warehouse, 15, null, null);
⋮----
$this->assertSame(25, $level->reserved);
⋮----
public function test_release_fails_when_releasing_more_than_reserved(): void
⋮----
$this->stock->reserve($product, $warehouse, 5, null, null);
⋮----
$this->expectException(InvalidStateTransitionException::class);
⋮----
$this->stock->release($product, $warehouse, 6, null, null);
⋮----
public function test_confirm_sale_decreases_reserved_and_on_hand(): void
⋮----
$this->stock->reserve($product, $warehouse, 20, null, null);
⋮----
$level = $this->stock->confirmSale($product, $warehouse, 20, null, null);
⋮----
$this->assertSame(80, $level->on_hand);
⋮----
public function test_confirm_sale_fails_when_confirming_more_than_reserved(): void
⋮----
$this->stock->reserve($product, $warehouse, 3, null, null);
⋮----
$this->stock->confirmSale($product, $warehouse, 4, null, null);
⋮----
public function test_transfer_creates_paired_transfer_out_and_transfer_in(): void
⋮----
$from = Warehouse::factory()->create();
$to = Warehouse::factory()->create();
$this->stock->purchaseIn($product, $from, 60, null, null);
⋮----
$result = $this->stock->transfer($product, $from, $to, 25, null, null);
⋮----
$this->assertSame(35, $result['from']->on_hand);
$this->assertSame(25, $result['to']->on_hand);
⋮----
public function test_transfer_is_atomic_no_partial_movements_when_it_fails(): void
⋮----
$this->stock->purchaseIn($product, $from, 10, null, null);
⋮----
$this->stock->transfer($product, $from, $to, 999, null, null);
⋮----
$this->assertSame(0, StockMovement::query()->whereIn('type', [
⋮----
])->count());
⋮----
$reconciled = $this->stock->reconcile($product)->keyBy('warehouse_id');
$this->assertSame(10, $reconciled[$from->id]['on_hand']);
$this->assertArrayNotHasKey($to->id, $reconciled->toArray());
⋮----
public function test_adjustment_records_reason_and_actor(): void
⋮----
$this->stock->purchaseIn($product, $warehouse, 20, null, null);
⋮----
$level = $this->stock->adjust($product, $warehouse, -5, $actor, 'Cycle count correction');
⋮----
$this->assertSame(15, $level->on_hand);
⋮----
public function test_adjustment_cannot_take_on_hand_negative(): void
⋮----
$this->stock->adjust($product, $warehouse, -6, null, 'Damaged stock');
⋮----
public function test_reconciliation_proves_ledger_equals_stock_levels(): void
⋮----
$warehouseA = Warehouse::factory()->create();
$warehouseB = Warehouse::factory()->create();
⋮----
$this->stock->purchaseIn($product, $warehouseA, 100, null, null);
$this->stock->reserve($product, $warehouseA, 30, null, null);
$this->stock->confirmSale($product, $warehouseA, 10, null, null);
$this->stock->transfer($product, $warehouseA, $warehouseB, 20, null, null);
$this->stock->adjust($product, $warehouseB, -2, null, 'Damage');
⋮----
$results = $this->stock->reconcile($product);
⋮----
$this->assertCount(2, $results);
⋮----
$this->assertTrue($row['on_hand_matches'], "on_hand mismatch for warehouse {$row['warehouse_id']}");
$this->assertTrue($row['reserved_matches'], "reserved mismatch for warehouse {$row['warehouse_id']}");
⋮----
public function test_reconciliation_detects_a_drifted_projection(): void
⋮----
$this->stock->purchaseIn($product, $warehouse, 40, null, null);
⋮----
// Simulate ledger/projection drift directly (bypassing the service,
// which is exactly what reconcile() exists to catch).
$product->stockLevels()->where('warehouse_id', $warehouse->id)->update(['on_hand' => 999]);
⋮----
$row = $this->stock->reconcile($product, $warehouse)->first();
⋮----
$this->assertFalse($row['on_hand_matches']);
$this->assertSame(999, $row['on_hand']);
$this->assertSame(40, $row['ledger_on_hand']);
````

## File: tests/Unit/ExampleTest.php
````php
namespace Tests\Unit;
⋮----
use PHPUnit\Framework\TestCase;
⋮----
class ExampleTest extends TestCase
⋮----
/**
     * A basic test example.
     */
public function test_that_true_is_true(): void
⋮----
$this->assertTrue(true);
````

## File: tests/TestCase.php
````php
namespace Tests;
⋮----
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
⋮----
abstract class TestCase extends BaseTestCase
⋮----
//
````

## File: .editorconfig
````
root = true

[*]
charset = utf-8
end_of_line = lf
indent_size = 4
indent_style = space
insert_final_newline = true
trim_trailing_whitespace = true

[*.md]
trim_trailing_whitespace = false

[*.{yml,yaml}]
indent_size = 2

[{compose,docker-compose}.{yml,yaml}]
indent_size = 4
````

## File: .gitattributes
````
* text=auto eol=lf

*.blade.php diff=html
*.css diff=css
*.html diff=html
*.md diff=markdown
*.php diff=php

/.github export-ignore
CHANGELOG.md export-ignore
.styleci.yml export-ignore
````

## File: .gitignore
````
*.log
.DS_Store
.env
.env.backup
.env.production
.phpactor.json
.phpunit.result.cache
/.codex
/.cursor/
/.idea
/.nova
/.phpunit.cache
/.vscode
/.zed
/auth.json
/node_modules
/public/build
/public/fonts-manifest.dev.json
/public/hot
/public/storage
/storage/*.key
/storage/pail
/vendor
_ide_helper.php
Homestead.json
Homestead.yaml
Thumbs.db
````

## File: .npmrc
````
ignore-scripts=true
audit=true
````

## File: artisan
````
#!/usr/bin/env php
<?php

use Illuminate\Foundation\Application;
use Symfony\Component\Console\Input\ArgvInput;

define('LARAVEL_START', microtime(true));

// Register the Composer autoloader...
require __DIR__.'/vendor/autoload.php';

// Bootstrap Laravel and handle the command...
/** @var Application $app */
$app = require_once __DIR__.'/bootstrap/app.php';

$status = $app->handleCommand(new ArgvInput);

exit($status);
````

## File: composer.json
````json
{
    "$schema": "https://getcomposer.org/schema.json",
    "name": "laravel/laravel",
    "type": "project",
    "description": "The skeleton application for the Laravel framework.",
    "keywords": ["laravel", "framework"],
    "license": "MIT",
    "require": {
        "php": "^8.3",
        "inertiajs/inertia-laravel": "^3.1",
        "laravel/framework": "^13.8",
        "laravel/horizon": "^5.47",
        "laravel/passport": "^13.7",
        "laravel/tinker": "^3.0",
        "maatwebsite/excel": "^3.1",
        "predis/predis": "^3.5",
        "santigarcor/laratrust": "^8.5"
    },
    "require-dev": {
        "fakerphp/faker": "^1.23",
        "larastan/larastan": "^3.0",
        "laravel/pail": "^1.2.5",
        "laravel/pao": "^1.0.6",
        "laravel/pint": "^1.27",
        "mockery/mockery": "^1.6",
        "nunomaduro/collision": "^8.6",
        "phpunit/phpunit": "^12.5.12"
    },
    "autoload": {
        "psr-4": {
            "App\\": "app/",
            "Database\\Factories\\": "database/factories/",
            "Database\\Seeders\\": "database/seeders/"
        }
    },
    "autoload-dev": {
        "psr-4": {
            "Tests\\": "tests/"
        }
    },
    "scripts": {
        "setup": [
            "composer install",
            "@php -r \"file_exists('.env') || copy('.env.example', '.env');\"",
            "@php artisan key:generate",
            "@php artisan migrate --force",
            "npm install --ignore-scripts",
            "npm run build"
        ],
        "dev": [
            "Composer\\Config::disableProcessTimeout",
            "npx concurrently -c \"#93c5fd,#c4b5fd,#fb7185,#fdba74\" \"php artisan serve\" \"php artisan queue:listen --tries=1 --timeout=0\" \"php artisan pail --timeout=0\" \"npm run dev\" --names=server,queue,logs,vite --kill-others"
        ],
        "test": [
            "@php artisan config:clear --ansi @no_additional_args",
            "@php artisan test"
        ],
        "stan": [
            "./vendor/bin/phpstan analyse --memory-limit=1G"
        ],
        "pint": [
            "./vendor/bin/pint"
        ],
        "pint-test": [
            "./vendor/bin/pint --test"
        ],
        "post-autoload-dump": [
            "Illuminate\\Foundation\\ComposerScripts::postAutoloadDump",
            "@php artisan package:discover --ansi"
        ],
        "post-update-cmd": [
            "@php artisan vendor:publish --tag=laravel-assets --ansi --force"
        ],
        "post-root-package-install": [
            "@php -r \"file_exists('.env') || copy('.env.example', '.env');\""
        ],
        "post-create-project-cmd": [
            "@php artisan key:generate --ansi",
            "@php -r \"file_exists('database/database.sqlite') || touch('database/database.sqlite');\"",
            "@php artisan migrate --graceful --ansi"
        ],
        "pre-package-uninstall": [
            "Illuminate\\Foundation\\ComposerScripts::prePackageUninstall"
        ]
    },
    "extra": {
        "laravel": {
            "dont-discover": []
        }
    },
    "config": {
        "optimize-autoloader": true,
        "preferred-install": "dist",
        "sort-packages": true,
        "allow-plugins": {
            "pestphp/pest-plugin": true,
            "php-http/discovery": true
        }
    },
    "minimum-stability": "stable",
    "prefer-stable": true
}
````

## File: docker-compose.yml
````yaml
name: stockflow

x-app-image: &app-image
  build:
    context: .
    dockerfile: Dockerfile
  image: stockflow-app
  working_dir: /var/www/html
  volumes:
    - .:/var/www/html
    - stockflow-vendor:/var/www/html/vendor
  # Deliberately NOT using `env_file: .env` here: that would inject every
  # .env key as a real container-level OS environment variable, which then
  # takes precedence over phpunit.xml's <env> test overrides (PHPUnit won't
  # clobber an already-set OS env var unless force="true" is set). Laravel
  # reads .env itself from the bind-mounted file below; only the handful of
  # values that must differ for Docker networking are set explicitly here.
  environment:
    DB_HOST: mysql
    DB_PORT: 3306
    REDIS_HOST: redis
    REDIS_PORT: 6379
  depends_on:
    mysql:
      condition: service_healthy
    redis:
      condition: service_healthy
  networks:
    - stockflow

services:
  app:
    <<: *app-image
    container_name: stockflow-app
    ports:
      - "${APP_PORT:-8000}:8000"

  # Horizon supervises the redis queue workers (replacing a plain
  # `queue:work` process) and gives an admin dashboard (/horizon, gated to
  # SuperAdmin — see HorizonServiceProvider::gate()) for throughput, retry,
  # and failed-job visibility. Config: config/horizon.php `environments`.
  queue:
    <<: *app-image
    container_name: stockflow-queue
    command: ["php", "artisan", "horizon"]

  scheduler:
    <<: *app-image
    container_name: stockflow-scheduler
    command: ["sh", "-c", "while true; do php artisan schedule:run --verbose --no-interaction; sleep 60; done"]

  vite:
    image: node:20-alpine
    container_name: stockflow-vite
    working_dir: /var/www/html
    command: sh -c "npm install && npm run dev -- --host 0.0.0.0"
    environment:
      VITE_DEV_SERVER_HOST: 0.0.0.0
    volumes:
      - .:/var/www/html
      - stockflow-node-modules:/var/www/html/node_modules
    ports:
      - "${VITE_PORT:-5173}:5173"
    networks:
      - stockflow

  mysql:
    image: mysql:8.0
    container_name: stockflow-mysql
    restart: unless-stopped
    environment:
      MYSQL_DATABASE: ${DB_DATABASE:-stockflow}
      MYSQL_USER: ${DB_USERNAME:-stockflow}
      MYSQL_PASSWORD: ${DB_PASSWORD:-stockflow}
      MYSQL_ROOT_PASSWORD: ${DB_ROOT_PASSWORD:-stockflow_root}
    ports:
      - "${FORWARD_DB_PORT:-3306}:3306"
    volumes:
      - stockflow-mysql:/var/lib/mysql
    healthcheck:
      test: ["CMD", "mysqladmin", "ping", "-h", "127.0.0.1", "-u", "root", "-p${DB_ROOT_PASSWORD:-stockflow_root}"]
      interval: 5s
      timeout: 5s
      retries: 20
    networks:
      - stockflow

  redis:
    image: redis:7-alpine
    container_name: stockflow-redis
    restart: unless-stopped
    ports:
      - "${FORWARD_REDIS_PORT:-6379}:6379"
    volumes:
      - stockflow-redis:/data
    healthcheck:
      test: ["CMD", "redis-cli", "ping"]
      interval: 5s
      timeout: 5s
      retries: 20
    networks:
      - stockflow

networks:
  stockflow:
    driver: bridge

volumes:
  stockflow-mysql:
  stockflow-redis:
  stockflow-vendor:
  stockflow-node-modules:
````

## File: Dockerfile
````dockerfile
# StockFlow — local development PHP image.
# Used by the `app`, `queue`, and `scheduler` services in docker-compose.yml.
# This is a dev image (not hardened/optimized for production).
#
# PHP 8.4 matches the installed laravel/framework v13 lock file (symfony/*
# v8.1 requires PHP >=8.4.1). Laravel 12 itself supports PHP 8.2-8.4, so this
# stays compatible if the app is ever pinned back to ^12.0.

FROM php:8.4-cli-bookworm

WORKDIR /var/www/html

# System packages needed to build common PHP extensions + Composer + zip handling.
RUN apt-get update && apt-get install -y --no-install-recommends \
        git \
        unzip \
        libzip-dev \
        libpng-dev \
        libjpeg62-turbo-dev \
        libfreetype6-dev \
        libonig-dev \
        default-mysql-client \
    && rm -rf /var/lib/apt/lists/*

# Core extensions Laravel needs: pdo_mysql (MySQL 8), mbstring, bcmath, zip, pcntl
# (queue worker signal handling), gd (PhpSpreadsheet/Laravel Excel).
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
        pdo_mysql \
        mbstring \
        bcmath \
        zip \
        pcntl \
        gd

COPY docker/php.ini /usr/local/etc/php/conf.d/99-stockflow.ini

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 8000

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
````

## File: Makefile
````makefile
.DEFAULT_GOAL := help
COMPOSE := docker compose

.PHONY: help start stop restart build logs shell migrate fresh test pint stan quality npm-dev npm-build

help: ## Show this help
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "  \033[36m%-12s\033[0m %s\n", $$1, $$2}'

start: ## Build (if needed) and start the full stack in the background
	@test -f .env || cp .env.example .env
	$(COMPOSE) up -d --build

stop: ## Stop all containers (keeps volumes: db/redis data, vendor, node_modules)
	$(COMPOSE) down

restart: ## Restart all containers
	$(COMPOSE) restart

build: ## Rebuild the app image (after Dockerfile/composer.json changes)
	$(COMPOSE) build

logs: ## Tail logs from all services
	$(COMPOSE) logs -f

shell: ## Open a shell inside the app container
	$(COMPOSE) exec app sh

migrate: ## Run database migrations inside the app container
	$(COMPOSE) exec app php artisan migrate

fresh: ## Drop all tables, re-run migrations, and clear the cache (migrate:fresh doesn't touch Redis — see docs/technical/cache.md)
	$(COMPOSE) exec app php artisan migrate:fresh
	$(COMPOSE) exec app php artisan cache:clear

test: ## Run the PHPUnit/Pest test suite inside the app container
	$(COMPOSE) exec app php artisan test

pint: ## Check code style (Laravel Pint) without fixing
	$(COMPOSE) exec app ./vendor/bin/pint --test

pint-fix: ## Fix code style (Laravel Pint)
	$(COMPOSE) exec app ./vendor/bin/pint

stan: ## Run static analysis (PHPStan/Larastan)
	$(COMPOSE) exec app ./vendor/bin/phpstan analyse --memory-limit=1G

quality: pint stan test ## Run the full local quality gate: style, static analysis, tests

npm-dev: ## Follow the Vite dev server logs (already running as the `vite` service)
	$(COMPOSE) logs -f vite

npm-build: ## Build production frontend assets inside the vite container
	$(COMPOSE) run --rm vite npm run build
````

## File: package.json
````json
{
    "$schema": "https://www.schemastore.org/package.json",
    "private": true,
    "type": "module",
    "scripts": {
        "build": "vite build",
        "dev": "vite"
    },
    "devDependencies": {
        "@tailwindcss/vite": "^4.0.0",
        "@vitejs/plugin-react": "^6.0.3",
        "concurrently": "^9.0.1",
        "laravel-vite-plugin": "^3.1",
        "tailwindcss": "^4.0.0",
        "vite": "^8.0.0"
    },
    "dependencies": {
        "@inertiajs/react": "^3.6.0",
        "react": "^19.2.7",
        "react-dom": "^19.2.7"
    }
}
````

## File: phpstan-baseline.neon
````
parameters:
	ignoreErrors:
		-
			message: '#^Using nullsafe property access "\?\-\>name" on left side of \?\? is unnecessary\. Use \-\> instead\.$#'
			identifier: nullsafe.neverNull
			count: 1
			path: app/Auth/ApiClientPrincipal.php

		-
			message: '#^Call to an undefined method Illuminate\\Contracts\\Pagination\\LengthAwarePaginator\:\:getCollection\(\)\.$#'
			identifier: method.notFound
			count: 1
			path: app/Http/Controllers/Api/V1/ApiController.php

		-
			message: '#^Call to an undefined method Illuminate\\Contracts\\Pagination\\LengthAwarePaginator\:\:getCollection\(\)\.$#'
			identifier: method.notFound
			count: 1
			path: app/Http/Controllers/Api/V1/PaymentController.php

		-
			message: '#^Call to an undefined method Illuminate\\Contracts\\Pagination\\LengthAwarePaginator\:\:getCollection\(\)\.$#'
			identifier: method.notFound
			count: 1
			path: app/Http/Controllers/Api/V1/PurchaseOrderController.php

		-
			message: '#^Parameter \#1 \$businessAccount of method App\\Services\\PurchaseOrderService\:\:listForViewer\(\) expects App\\Models\\BusinessAccount\|null, Illuminate\\Database\\Eloquent\\Model\|null given\.$#'
			identifier: argument.type
			count: 1
			path: app/Http/Controllers/Api/V1/PurchaseOrderController.php

		-
			message: '#^Call to an undefined method Illuminate\\Contracts\\Pagination\\LengthAwarePaginator\:\:getCollection\(\)\.$#'
			identifier: method.notFound
			count: 1
			path: app/Http/Controllers/Api/V1/QuoteController.php

		-
			message: '#^Parameter \#1 \$businessAccount of method App\\Services\\QuoteService\:\:request\(\) expects App\\Models\\BusinessAccount, Illuminate\\Database\\Eloquent\\Model\|null given\.$#'
			identifier: argument.type
			count: 1
			path: app/Http/Controllers/Api/V1/QuoteController.php

		-
			message: '#^Parameter \#2 \$businessAccount of method App\\Services\\QuoteService\:\:listForViewer\(\) expects App\\Models\\BusinessAccount\|null, Illuminate\\Database\\Eloquent\\Model\|null given\.$#'
			identifier: argument.type
			count: 1
			path: app/Http/Controllers/Api/V1/QuoteController.php

		-
			message: '#^Call to an undefined method Illuminate\\Contracts\\Pagination\\LengthAwarePaginator\:\:through\(\)\.$#'
			identifier: method.notFound
			count: 1
			path: app/Http/Controllers/Web/Admin/AuditLogController.php

		-
			message: '#^Parameter \#1 \$callback of method Illuminate\\Database\\Eloquent\\Collection\<int,Illuminate\\Database\\Eloquent\\Model\>\:\:map\(\) expects callable\(Illuminate\\Database\\Eloquent\\Model, int\)\: array\{id\: string, name\: string, slug\: string\}, Closure\(App\\Models\\Category\)\: array\{id\: string, name\: string, slug\: string\} given\.$#'
			identifier: argument.type
			count: 1
			path: app/Http/Controllers/Web/Catalog/CategoryController.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$id\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Controllers/Web/Catalog/PriceListController.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$min_qty\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Controllers/Web/Catalog/PriceListController.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$product\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Controllers/Web/Catalog/PriceListController.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$unit_price\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Controllers/Web/Catalog/PriceListController.php

		-
			message: '#^Call to an undefined method Illuminate\\Contracts\\Pagination\\LengthAwarePaginator\:\:through\(\)\.$#'
			identifier: method.notFound
			count: 1
			path: app/Http/Controllers/Web/Catalog/PriceListController.php

		-
			message: '#^Cannot access property \$value on string\.$#'
			identifier: property.nonObject
			count: 1
			path: app/Http/Controllers/Web/Catalog/PriceListController.php

		-
			message: '#^Parameter \#1 \$callback of method Illuminate\\Database\\Eloquent\\Collection\<int,Illuminate\\Database\\Eloquent\\Model\>\:\:map\(\) contains unresolvable type\.$#'
			identifier: argument.unresolvableType
			count: 1
			path: app/Http/Controllers/Web/Catalog/PriceListController.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$id\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Controllers/Web/Catalog/ProductController.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$min_qty\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Controllers/Web/Catalog/ProductController.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$priceList\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Controllers/Web/Catalog/ProductController.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$unit_price\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Controllers/Web/Catalog/ProductController.php

		-
			message: '#^Call to an undefined method Illuminate\\Contracts\\Pagination\\LengthAwarePaginator\:\:through\(\)\.$#'
			identifier: method.notFound
			count: 1
			path: app/Http/Controllers/Web/Catalog/ProductController.php

		-
			message: '#^Parameter \#1 \$callback of method Illuminate\\Database\\Eloquent\\Collection\<int,Illuminate\\Database\\Eloquent\\Model\>\:\:map\(\) contains unresolvable type\.$#'
			identifier: argument.unresolvableType
			count: 1
			path: app/Http/Controllers/Web/Catalog/ProductController.php

		-
			message: '#^Call to an undefined method Illuminate\\Contracts\\Pagination\\LengthAwarePaginator\:\:through\(\)\.$#'
			identifier: method.notFound
			count: 1
			path: app/Http/Controllers/Web/Catalog/SupplierController.php

		-
			message: '#^Call to an undefined method Illuminate\\Contracts\\Pagination\\LengthAwarePaginator\:\:through\(\)\.$#'
			identifier: method.notFound
			count: 2
			path: app/Http/Controllers/Web/Import/ImportController.php

		-
			message: '#^Cannot access property \$value on string\.$#'
			identifier: property.nonObject
			count: 4
			path: app/Http/Controllers/Web/Import/ImportController.php

		-
			message: '#^Cannot call method label\(\) on string\.$#'
			identifier: method.nonObject
			count: 3
			path: app/Http/Controllers/Web/Import/ImportController.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$amount\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Controllers/Web/Procurement/PurchaseOrderController.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$approver\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Controllers/Web/Procurement/PurchaseOrderController.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$created_at\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Controllers/Web/Procurement/PurchaseOrderController.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$credit_limit\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Controllers/Web/Procurement/PurchaseOrderController.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$decision\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Controllers/Web/Procurement/PurchaseOrderController.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$id\.$#'
			identifier: property.notFound
			count: 3
			path: app/Http/Controllers/Web/Procurement/PurchaseOrderController.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$method\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Controllers/Web/Procurement/PurchaseOrderController.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$note\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Controllers/Web/Procurement/PurchaseOrderController.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$outstanding_balance\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Controllers/Web/Procurement/PurchaseOrderController.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$product\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Controllers/Web/Procurement/PurchaseOrderController.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$quantity\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Controllers/Web/Procurement/PurchaseOrderController.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$status\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Controllers/Web/Procurement/PurchaseOrderController.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$unit_price\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Controllers/Web/Procurement/PurchaseOrderController.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$warehouse\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Controllers/Web/Procurement/PurchaseOrderController.php

		-
			message: '#^Call to an undefined method Illuminate\\Contracts\\Pagination\\LengthAwarePaginator\:\:through\(\)\.$#'
			identifier: method.notFound
			count: 1
			path: app/Http/Controllers/Web/Procurement/PurchaseOrderController.php

		-
			message: '#^Cannot access property \$value on string\.$#'
			identifier: property.nonObject
			count: 3
			path: app/Http/Controllers/Web/Procurement/PurchaseOrderController.php

		-
			message: '#^Cannot call method label\(\) on string\.$#'
			identifier: method.nonObject
			count: 2
			path: app/Http/Controllers/Web/Procurement/PurchaseOrderController.php

		-
			message: '#^Parameter \#1 \$businessAccount of method App\\Services\\PurchaseOrderService\:\:listForViewer\(\) expects App\\Models\\BusinessAccount\|null, Illuminate\\Database\\Eloquent\\Model\|null given\.$#'
			identifier: argument.type
			count: 1
			path: app/Http/Controllers/Web/Procurement/PurchaseOrderController.php

		-
			message: '#^Parameter \#1 \$callback of method Illuminate\\Database\\Eloquent\\Collection\<int,Illuminate\\Database\\Eloquent\\Model\>\:\:map\(\) contains unresolvable type\.$#'
			identifier: argument.unresolvableType
			count: 3
			path: app/Http/Controllers/Web/Procurement/PurchaseOrderController.php

		-
			message: '#^Parameter \#2 \$num2 of function bcadd expects numeric\-string, float given\.$#'
			identifier: argument.type
			count: 1
			path: app/Http/Controllers/Web/Procurement/PurchaseOrderController.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$id\.$#'
			identifier: property.notFound
			count: 3
			path: app/Http/Controllers/Web/Procurement/QuoteController.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$product\.$#'
			identifier: property.notFound
			count: 2
			path: app/Http/Controllers/Web/Procurement/QuoteController.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$product_id\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Controllers/Web/Procurement/QuoteController.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$quantity\.$#'
			identifier: property.notFound
			count: 3
			path: app/Http/Controllers/Web/Procurement/QuoteController.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$status\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Controllers/Web/Procurement/QuoteController.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$unit_price\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Controllers/Web/Procurement/QuoteController.php

		-
			message: '#^Call to an undefined method Illuminate\\Contracts\\Pagination\\LengthAwarePaginator\:\:through\(\)\.$#'
			identifier: method.notFound
			count: 1
			path: app/Http/Controllers/Web/Procurement/QuoteController.php

		-
			message: '#^Cannot access property \$value on string\.$#'
			identifier: property.nonObject
			count: 3
			path: app/Http/Controllers/Web/Procurement/QuoteController.php

		-
			message: '#^Cannot call method label\(\) on string\.$#'
			identifier: method.nonObject
			count: 2
			path: app/Http/Controllers/Web/Procurement/QuoteController.php

		-
			message: '#^Parameter \#1 \$businessAccount of method App\\Services\\QuoteService\:\:request\(\) expects App\\Models\\BusinessAccount, Illuminate\\Database\\Eloquent\\Model given\.$#'
			identifier: argument.type
			count: 1
			path: app/Http/Controllers/Web/Procurement/QuoteController.php

		-
			message: '#^Parameter \#1 \$callback of method Illuminate\\Database\\Eloquent\\Collection\<int,Illuminate\\Database\\Eloquent\\Model\>\:\:map\(\) contains unresolvable type\.$#'
			identifier: argument.unresolvableType
			count: 3
			path: app/Http/Controllers/Web/Procurement/QuoteController.php

		-
			message: '#^Parameter \#2 \$businessAccount of method App\\Services\\QuoteService\:\:listForViewer\(\) expects App\\Models\\BusinessAccount\|null, Illuminate\\Database\\Eloquent\\Model\|null given\.$#'
			identifier: argument.type
			count: 1
			path: app/Http/Controllers/Web/Procurement/QuoteController.php

		-
			message: '#^Call to an undefined method Illuminate\\Contracts\\Pagination\\LengthAwarePaginator\:\:through\(\)\.$#'
			identifier: method.notFound
			count: 5
			path: app/Http/Controllers/Web/Reports/ReportController.php

		-
			message: '#^Cannot access property \$value on string\.$#'
			identifier: property.nonObject
			count: 1
			path: app/Http/Controllers/Web/Reports/ReportController.php

		-
			message: '#^Cannot call method label\(\) on string\.$#'
			identifier: method.nonObject
			count: 1
			path: app/Http/Controllers/Web/Reports/ReportController.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$amount\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Controllers/Web/Sales/OrderController.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$created_at\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Controllers/Web/Sales/OrderController.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$id\.$#'
			identifier: property.notFound
			count: 2
			path: app/Http/Controllers/Web/Sales/OrderController.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$line_total\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Controllers/Web/Sales/OrderController.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$method\.$#'
			identifier: property.notFound
			count: 2
			path: app/Http/Controllers/Web/Sales/OrderController.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$product\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Controllers/Web/Sales/OrderController.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$quantity\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Controllers/Web/Sales/OrderController.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$status\.$#'
			identifier: property.notFound
			count: 2
			path: app/Http/Controllers/Web/Sales/OrderController.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$unit_price\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Controllers/Web/Sales/OrderController.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$warehouse\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Controllers/Web/Sales/OrderController.php

		-
			message: '#^Call to an undefined method Illuminate\\Contracts\\Pagination\\LengthAwarePaginator\:\:through\(\)\.$#'
			identifier: method.notFound
			count: 1
			path: app/Http/Controllers/Web/Sales/OrderController.php

		-
			message: '#^Cannot access property \$value on string\.$#'
			identifier: property.nonObject
			count: 2
			path: app/Http/Controllers/Web/Sales/OrderController.php

		-
			message: '#^Cannot call method label\(\) on string\.$#'
			identifier: method.nonObject
			count: 2
			path: app/Http/Controllers/Web/Sales/OrderController.php

		-
			message: '#^Parameter \#1 \$callback of method Illuminate\\Database\\Eloquent\\Collection\<int,Illuminate\\Database\\Eloquent\\Model\>\:\:map\(\) contains unresolvable type\.$#'
			identifier: argument.unresolvableType
			count: 2
			path: app/Http/Controllers/Web/Sales/OrderController.php

		-
			message: '#^Call to an undefined method Illuminate\\Contracts\\Pagination\\LengthAwarePaginator\:\:through\(\)\.$#'
			identifier: method.notFound
			count: 1
			path: app/Http/Controllers/Web/Sales/PaymentController.php

		-
			message: '#^Cannot access property \$value on string\.$#'
			identifier: property.nonObject
			count: 5
			path: app/Http/Controllers/Web/Sales/PaymentController.php

		-
			message: '#^Cannot call method isPlaceholder\(\) on string\.$#'
			identifier: method.nonObject
			count: 1
			path: app/Http/Controllers/Web/Sales/PaymentController.php

		-
			message: '#^Cannot call method label\(\) on string\.$#'
			identifier: method.nonObject
			count: 2
			path: app/Http/Controllers/Web/Sales/PaymentController.php

		-
			message: '#^Call to an undefined method Illuminate\\Contracts\\Pagination\\LengthAwarePaginator\:\:through\(\)\.$#'
			identifier: method.notFound
			count: 1
			path: app/Http/Controllers/Web/Stock/StockLevelController.php

		-
			message: '#^Call to an undefined method Illuminate\\Contracts\\Pagination\\LengthAwarePaginator\:\:through\(\)\.$#'
			identifier: method.notFound
			count: 1
			path: app/Http/Controllers/Web/Stock/StockMovementController.php

		-
			message: '#^Cannot access property \$value on string\.$#'
			identifier: property.nonObject
			count: 1
			path: app/Http/Controllers/Web/Stock/StockMovementController.php

		-
			message: '#^Cannot call method label\(\) on string\.$#'
			identifier: method.nonObject
			count: 1
			path: app/Http/Controllers/Web/Stock/StockMovementController.php

		-
			message: '#^Cannot access property \$value on string\.$#'
			identifier: property.nonObject
			count: 1
			path: app/Http/Controllers/Webhooks/FakeGatewayWebhookController.php

		-
			message: '#^Cannot access property \$value on string\.$#'
			identifier: property.nonObject
			count: 1
			path: app/Http/Controllers/Webhooks/FawryWebhookController.php

		-
			message: '#^Cannot access property \$value on string\.$#'
			identifier: property.nonObject
			count: 1
			path: app/Http/Controllers/Webhooks/PaymobWebhookController.php

		-
			message: '#^Using nullsafe property access on non\-nullable type mixed\. Use \-\> instead\.$#'
			identifier: nullsafe.neverNull
			count: 1
			path: app/Http/Requests/Api/V1/StoreQuoteRequest.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$user_id\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Requests/Catalog/StorePriceListItemRequest.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\PaymentResource\:\:\$amount\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Resources/Api/V1/PaymentResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\PaymentResource\:\:\$created_at\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Resources/Api/V1/PaymentResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\PaymentResource\:\:\$gateway_ref\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Resources/Api/V1/PaymentResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\PaymentResource\:\:\$id\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Resources/Api/V1/PaymentResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\PaymentResource\:\:\$meta\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Resources/Api/V1/PaymentResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\PaymentResource\:\:\$method\.$#'
			identifier: property.notFound
			count: 2
			path: app/Http/Resources/Api/V1/PaymentResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\PaymentResource\:\:\$payable\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Resources/Api/V1/PaymentResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\PaymentResource\:\:\$status\.$#'
			identifier: property.notFound
			count: 2
			path: app/Http/Resources/Api/V1/PaymentResource.php

		-
			message: '#^Cannot access property \$value on string\.$#'
			identifier: property.nonObject
			count: 1
			path: app/Http/Resources/Api/V1/PaymentResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\ProductResource\:\:\$category\.$#'
			identifier: property.notFound
			count: 3
			path: app/Http/Resources/Api/V1/ProductResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\ProductResource\:\:\$description\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Resources/Api/V1/ProductResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\ProductResource\:\:\$id\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Resources/Api/V1/ProductResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\ProductResource\:\:\$is_active\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Resources/Api/V1/ProductResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\ProductResource\:\:\$name\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Resources/Api/V1/ProductResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\ProductResource\:\:\$sku\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Resources/Api/V1/ProductResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\ProductResource\:\:\$supplier\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Resources/Api/V1/ProductResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\PurchaseOrderResource\:\:\$businessAccount\.$#'
			identifier: property.notFound
			count: 4
			path: app/Http/Resources/Api/V1/PurchaseOrderResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\PurchaseOrderResource\:\:\$created_at\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Resources/Api/V1/PurchaseOrderResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\PurchaseOrderResource\:\:\$due_date\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Resources/Api/V1/PurchaseOrderResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\PurchaseOrderResource\:\:\$id\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Resources/Api/V1/PurchaseOrderResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\PurchaseOrderResource\:\:\$items\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Resources/Api/V1/PurchaseOrderResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\PurchaseOrderResource\:\:\$payments\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Resources/Api/V1/PurchaseOrderResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\PurchaseOrderResource\:\:\$quote_id\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Resources/Api/V1/PurchaseOrderResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\PurchaseOrderResource\:\:\$status\.$#'
			identifier: property.notFound
			count: 2
			path: app/Http/Resources/Api/V1/PurchaseOrderResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\PurchaseOrderResource\:\:\$subtotal\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Resources/Api/V1/PurchaseOrderResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\PurchaseOrderResource\:\:\$tax\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Resources/Api/V1/PurchaseOrderResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\PurchaseOrderResource\:\:\$total\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Resources/Api/V1/PurchaseOrderResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\QuoteResource\:\:\$businessAccount\.$#'
			identifier: property.notFound
			count: 2
			path: app/Http/Resources/Api/V1/QuoteResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\QuoteResource\:\:\$created_at\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Resources/Api/V1/QuoteResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\QuoteResource\:\:\$expires_at\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Resources/Api/V1/QuoteResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\QuoteResource\:\:\$id\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Resources/Api/V1/QuoteResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\QuoteResource\:\:\$items\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Resources/Api/V1/QuoteResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\QuoteResource\:\:\$purchaseOrders\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Resources/Api/V1/QuoteResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\QuoteResource\:\:\$status\.$#'
			identifier: property.notFound
			count: 2
			path: app/Http/Resources/Api/V1/QuoteResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\QuoteResource\:\:\$subtotal\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Resources/Api/V1/QuoteResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\QuoteResource\:\:\$tax\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Resources/Api/V1/QuoteResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\QuoteResource\:\:\$total\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Resources/Api/V1/QuoteResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\StockAvailabilityResource\:\:\$available\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Resources/Api/V1/StockAvailabilityResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\StockAvailabilityResource\:\:\$on_hand\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Resources/Api/V1/StockAvailabilityResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\StockAvailabilityResource\:\:\$product\.$#'
			identifier: property.notFound
			count: 3
			path: app/Http/Resources/Api/V1/StockAvailabilityResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\StockAvailabilityResource\:\:\$reserved\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Resources/Api/V1/StockAvailabilityResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\StockAvailabilityResource\:\:\$updated_at\.$#'
			identifier: property.notFound
			count: 1
			path: app/Http/Resources/Api/V1/StockAvailabilityResource.php

		-
			message: '#^Access to an undefined property App\\Http\\Resources\\Api\\V1\\StockAvailabilityResource\:\:\$warehouse\.$#'
			identifier: property.notFound
			count: 3
			path: app/Http/Resources/Api/V1/StockAvailabilityResource.php

		-
			message: '#^Property App\\Imports\\CatalogRowsImport\:\:\$rows \(Illuminate\\Support\\Collection\<int, array\<string, mixed\>\>\) does not accept Illuminate\\Support\\Collection\<int, array\<mixed\>\>\.$#'
			identifier: assign.propertyType
			count: 1
			path: app/Imports/CatalogRowsImport.php

		-
			message: '#^Called ''env'' outside of the config directory which returns null when the config is cached, use ''config''\.$#'
			identifier: larastan.noEnvCallsOutsideOfConfig
			count: 1
			path: app/Payments/FawryGateway.php

		-
			message: '#^Called ''env'' outside of the config directory which returns null when the config is cached, use ''config''\.$#'
			identifier: larastan.noEnvCallsOutsideOfConfig
			count: 1
			path: app/Payments/PaymobGateway.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$user_id\.$#'
			identifier: property.notFound
			count: 1
			path: app/Policies/PaymentPolicy.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$supplier\.$#'
			identifier: property.notFound
			count: 1
			path: app/Policies/PriceListPolicy.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$user_id\.$#'
			identifier: property.notFound
			count: 1
			path: app/Policies/ProductPolicy.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$user_id\.$#'
			identifier: property.notFound
			count: 1
			path: app/Policies/PurchaseOrderPolicy.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$product\.$#'
			identifier: property.notFound
			count: 1
			path: app/Policies/QuotePolicy.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$user_id\.$#'
			identifier: property.notFound
			count: 1
			path: app/Policies/QuotePolicy.php

		-
			message: '#^Method App\\Repositories\\StockRepository\:\:ledgerTotals\(\) should return Illuminate\\Support\\Collection\<int, object\{product_id\: string, warehouse_id\: string, ledger_on_hand\: int, ledger_reserved\: int\}\> but returns Illuminate\\Support\\Collection\<int, object\{product_id\: mixed, warehouse_id\: mixed, ledger_on_hand\: int, ledger_reserved\: int\}&stdClass\>\.$#'
			identifier: return.type
			count: 1
			path: app/Repositories/StockRepository.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$name\.$#'
			identifier: property.notFound
			count: 1
			path: app/Services/DashboardService.php

		-
			message: '#^Parameter \#1 \$businessAccount of method App\\Services\\DashboardService\:\:businessBuyerKpis\(\) expects App\\Models\\BusinessAccount, Illuminate\\Database\\Eloquent\\Model given\.$#'
			identifier: argument.type
			count: 1
			path: app/Services/DashboardService.php

		-
			message: '#^Parameter \#1 \$businessAccount of method App\\Services\\DashboardService\:\:cacheKey\(\) expects App\\Models\\BusinessAccount, Illuminate\\Database\\Eloquent\\Model given\.$#'
			identifier: argument.type
			count: 1
			path: app/Services/DashboardService.php

		-
			message: '#^Parameter \#1 \$callback of method Illuminate\\Support\\Collection\<int,App\\Models\\ActivityLog\>\:\:map\(\) contains unresolvable type\.$#'
			identifier: argument.unresolvableType
			count: 1
			path: app/Services/DashboardService.php

		-
			message: '#^Match expression does not handle remaining value\: string$#'
			identifier: match.unhandled
			count: 1
			path: app/Services/ImportService.php

		-
			message: '#^Parameter \#1 \$data of static method Illuminate\\Support\\Facades\\Validator\:\:make\(\) expects array, string given\.$#'
			identifier: argument.type
			count: 1
			path: app/Services/ImportService.php

		-
			message: '#^Parameter \#1 \$entity of method App\\Services\\ImportService\:\:flushCatalogCache\(\) expects App\\Enums\\ImportEntity, string given\.$#'
			identifier: argument.type
			count: 2
			path: app/Services/ImportService.php

		-
			message: '#^Parameter \#4 \$actor of method App\\Services\\StockService\:\:adjust\(\) expects App\\Models\\User\|null, Illuminate\\Database\\Eloquent\\Model\|null given\.$#'
			identifier: argument.type
			count: 1
			path: app/Services/ImportService.php

		-
			message: '#^Parameter \#4 \$actor of method App\\Services\\StockService\:\:purchaseIn\(\) expects App\\Models\\User\|null, Illuminate\\Database\\Eloquent\\Model\|null given\.$#'
			identifier: argument.type
			count: 1
			path: app/Services/ImportService.php

		-
			message: '#^Using nullsafe property access "\?\-\>on_hand" on left side of \?\? is unnecessary\. Use \-\> instead\.$#'
			identifier: nullsafe.neverNull
			count: 1
			path: app/Services/ImportService.php

		-
			message: '#^Using nullsafe property access "\?\-\>reserved" on left side of \?\? is unnecessary\. Use \-\> instead\.$#'
			identifier: nullsafe.neverNull
			count: 1
			path: app/Services/ImportService.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$product\.$#'
			identifier: property.notFound
			count: 2
			path: app/Services/OrderService.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$quantity\.$#'
			identifier: property.notFound
			count: 2
			path: app/Services/OrderService.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$warehouse\.$#'
			identifier: property.notFound
			count: 2
			path: app/Services/OrderService.php

		-
			message: '#^Cannot access property \$value on string\.$#'
			identifier: property.nonObject
			count: 3
			path: app/Services/OrderService.php

		-
			message: '#^Parameter \#1 \$payment of method App\\Services\\PaymentService\:\:markFailed\(\) expects App\\Models\\Payment, Illuminate\\Database\\Eloquent\\Model given\.$#'
			identifier: argument.type
			count: 1
			path: app/Services/OrderService.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$id\.$#'
			identifier: property.notFound
			count: 1
			path: app/Services/PaymentService.php

		-
			message: '#^Cannot access property \$value on string\.$#'
			identifier: property.nonObject
			count: 2
			path: app/Services/PaymentService.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$product\.$#'
			identifier: property.notFound
			count: 3
			path: app/Services/PurchaseOrderService.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$product_id\.$#'
			identifier: property.notFound
			count: 2
			path: app/Services/PurchaseOrderService.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$quantity\.$#'
			identifier: property.notFound
			count: 5
			path: app/Services/PurchaseOrderService.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$unit_price\.$#'
			identifier: property.notFound
			count: 1
			path: app/Services/PurchaseOrderService.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$warehouse\.$#'
			identifier: property.notFound
			count: 2
			path: app/Services/PurchaseOrderService.php

		-
			message: '#^Cannot access property \$value on string\.$#'
			identifier: property.nonObject
			count: 4
			path: app/Services/PurchaseOrderService.php

		-
			message: '#^Parameter \#1 \$num1 of function bcadd expects numeric\-string, float given\.$#'
			identifier: argument.type
			count: 1
			path: app/Services/PurchaseOrderService.php

		-
			message: '#^Parameter \#1 \$num1 of function bcsub expects numeric\-string, float given\.$#'
			identifier: argument.type
			count: 1
			path: app/Services/PurchaseOrderService.php

		-
			message: '#^Parameter \#2 \$num2 of function bcadd expects numeric\-string, float given\.$#'
			identifier: argument.type
			count: 1
			path: app/Services/PurchaseOrderService.php

		-
			message: '#^Parameter \#2 \$num2 of function bccomp expects numeric\-string, float given\.$#'
			identifier: argument.type
			count: 1
			path: app/Services/PurchaseOrderService.php

		-
			message: '#^Parameter \#2 \$num2 of function bcsub expects numeric\-string, float given\.$#'
			identifier: argument.type
			count: 1
			path: app/Services/PurchaseOrderService.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$id\.$#'
			identifier: property.notFound
			count: 2
			path: app/Services/QuoteService.php

		-
			message: '#^Access to an undefined property Illuminate\\Database\\Eloquent\\Model\:\:\$quantity\.$#'
			identifier: property.notFound
			count: 1
			path: app/Services/QuoteService.php

		-
			message: '#^Cannot access property \$value on string\.$#'
			identifier: property.nonObject
			count: 3
			path: app/Services/QuoteService.php

		-
			message: '#^Cannot call method isPast\(\) on string\.$#'
			identifier: method.nonObject
			count: 1
			path: app/Services/QuoteService.php

		-
			message: '#^Call to an undefined method Illuminate\\Contracts\\Pagination\\LengthAwarePaginator\:\:through\(\)\.$#'
			identifier: method.notFound
			count: 1
			path: app/Services/StorefrontCatalogService.php

		-
			message: '#^Using nullsafe property access "\?\-\>id" on left side of \?\? is unnecessary\. Use \-\> instead\.$#'
			identifier: nullsafe.neverNull
			count: 1
			path: database/factories/PaymentFactory.php
````

## File: phpstan.neon
````
includes:
    - vendor/larastan/larastan/extension.neon
    - phpstan-baseline.neon

parameters:
    paths:
        - app
        - database
        - routes

    # Level 5: catches real bugs (wrong argument types, undefined methods/
    # properties, always-true/false conditions) without the noise of
    # strict-typing levels 7-9, which would require a much larger upfront
    # annotation pass across a codebase this size to get to zero baseline
    # findings. Raise incrementally as the codebase matures, not in one
    # jump.
    level: 5

    # Models here declare enum casts via a `casts()` method (Laravel 11+
    # style) rather than the old `$casts` property array. Larastan's model
    # reflection resolves the cast type correctly, but PHPDoc-derived
    # property types elsewhere in the call chain (e.g. a closure parameter
    # typed from an untyped array) still get treated as the literal PHPDoc
    # type. Without this, PHPStan reports ~250 false-positive "strict
    # comparison always true/false" findings across every Service with a
    # status-enum state machine. This is a standard, documented Larastan
    # setting for exactly this situation — see
    # https://phpstan.org/user-guide/discovering-symbols#php-doc-types.
    treatPhpDocTypesAsCertain: false

    tmpDir: storage/phpstan
````

## File: phpunit.xml
````xml
<?xml version="1.0" encoding="UTF-8"?>
<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:noNamespaceSchemaLocation="vendor/phpunit/phpunit/phpunit.xsd"
         bootstrap="vendor/autoload.php"
         colors="true"
>
    <testsuites>
        <testsuite name="Unit">
            <directory>tests/Unit</directory>
        </testsuite>
        <testsuite name="Feature">
            <directory>tests/Feature</directory>
        </testsuite>
    </testsuites>
    <source>
        <include>
            <directory>app</directory>
        </include>
    </source>
    <php>
        <!--
            force="true" on the connection/driver overrides below: when tests
            run inside the Docker `app` container, DB_CONNECTION/REDIS_* etc.
            may already be set as real container-level environment variables
            (see docker-compose.yml). PHPUnit's <env> otherwise refuses to
            overwrite an already-set OS env var, which would silently point
            feature tests at the dev MySQL/Redis instead of this isolated
            testing config.
        -->
        <env name="APP_ENV" value="testing"/>
        <env name="APP_MAINTENANCE_DRIVER" value="file"/>
        <env name="BCRYPT_ROUNDS" value="4"/>
        <env name="BROADCAST_CONNECTION" value="null"/>
        <env name="CACHE_STORE" value="array" force="true"/>
        <env name="DB_CONNECTION" value="sqlite" force="true"/>
        <env name="DB_DATABASE" value=":memory:" force="true"/>
        <env name="DB_URL" value=""/>
        <env name="MAIL_MAILER" value="array"/>
        <env name="QUEUE_CONNECTION" value="sync" force="true"/>
        <env name="SESSION_DRIVER" value="array" force="true"/>
        <env name="PULSE_ENABLED" value="false"/>
        <env name="TELESCOPE_ENABLED" value="false"/>
        <env name="NIGHTWATCH_ENABLED" value="false"/>
    </php>
</phpunit>
````

## File: pint.json
````json
{
    "preset": "laravel",
    "rules": {
        "no_unused_imports": true,
        "single_quote": true,
        "trailing_comma_in_multiline": true,
        "ordered_imports": {
            "sort_algorithm": "alpha"
        }
    }
}
````

## File: README.md
````markdown
# StockFlow

B2B/B2C e-commerce & inventory platform. Laravel 13.18.1 + Inertia.js + React, one
app — no separate frontend, no Next.js, no React Router. See
[`docs/project/canonical-decisions.md`](../docs/project/canonical-decisions.md) for
the full set of architecture decisions.

Stock is the source of truth: every purchase-in, sale-out, reservation, release,
transfer, and adjustment is an immutable ledger entry (`stock_movements`); current
stock (`stock_levels`) is a projection that must always be derivable from that
ledger — `php artisan stock:reconcile` proves it.

## What's built so far

- **Auth & authorization**: session login/logout (`web` guard only), Laratrust
  roles/permissions with warehouse-scoped teams (one Laratrust team per warehouse),
  Admin UI for user/role management and a read-only permission matrix.
- **Catalog module**: products/categories/suppliers/price-lists CRUD, Redis-cached
  reads, vendor-scoped price-list-item ownership.
- **Stock engine** (the ledger/projection core): `StockService::purchaseIn() /
  reserve() / release() / confirmSale() / transfer() / adjust() / reconcile()`, all
  transactional and row-locked (see "The stock engine" below), plus a web UI
  (`/stock/levels`, `/stock/movements`, `/stock/adjustments`, `/stock/transfers`,
  `/stock/reconcile`) and `php artisan stock:reconcile`.
- **B2C checkout module**: session-backed cart → checkout → payment → fulfillment.
  `OrderService` owns `pending → reserved → confirmed → fulfilled` (or `cancelled`);
  see "B2C checkout" below. Web UI at `/cart`, `/checkout`, `/orders`, `/orders/
  {order}`, `/payments/{payment}`.
- **B2B procurement module**: RFQ → quote → purchase order → approval → Bank
  Transfer settlement. `QuoteService` + `PurchaseOrderService` own two linked
  state machines; see "B2B procurement" below. Web UI at `/procurement/quotes/*`
  and `/procurement/purchase-orders/*`.
- **Payment architecture**: gateway drivers behind `PaymentGateway`, signed/idempotent
  webhook routes under `/webhooks/v1`, unique `payments.gateway_ref`, and atomic
  reservation → `sale_out` conversion inside `PaymentService`.
- **Excel import**: `/imports` UI for categories, products, warehouses, suppliers,
  price lists, and opening stock. Uploads create `import_batches`, queued jobs create
  per-row `import_rows`, valid rows upsert by natural key, failed rows are reported,
  and opening stock writes through `StockService`.
- **External B2B API**: Passport-secured `/api/v1` JSON endpoints for catalog,
  stock availability, B2B quotes/POs, and bank-transfer payment proof submission.
  The API uses the same services as the Inertia controllers and returns `{data, meta}`.
- **Admin, audit, dashboard & reports**: `AuditService` records user/role changes,
  permission changes, stock adjustments, PO approvals, and payment settlement to
  `activity_log`; role/permission editing is inline on `/admin/roles`; a cached
  dashboard KPI bundle; five paginated, filtered, indexed reports (low stock, stock
  movements, sales, payments, import history). See "Admin, audit, dashboard &
  reports" below.
- **Hardening**: Redis-cached stock levels report with flush-on-write
  invalidation, rate limiting (login/checkout/webhook/API), Laravel Horizon
  (queue dashboard, SuperAdmin-gated), baseline security headers on every
  response, Laravel Pint + Larastan static analysis, and a GitHub Actions CI
  gate. See "Hardening" below.
- Not yet built: real Paymob/Fawry provider API calls/credentials.

## Requirements

- Docker + Docker Compose (recommended — see "Local setup" below)
- If running outside Docker: PHP 8.2+, Composer, Node 20+/npm, MySQL 8, Redis

## Local setup (Docker)

```bash
# from the stockflow/ directory
make start        # builds (if needed) and starts app, mysql, redis, queue, scheduler, vite
make migrate       # run migrations
docker compose exec app php artisan db:seed   # demo roles/users/warehouses/catalog
```

`make help` lists all available targets (`start`, `stop`, `restart`, `build`, `logs`,
`shell`, `migrate`, `fresh`, `test`, `pint`, `pint-fix`, `stan`, `quality`,
`npm-dev`, `npm-build`). `make quality` runs the full local gate (style + static
analysis + tests) in one command — the same three steps CI runs.

Visit `http://127.0.0.1:8000`. Guests are redirected to `/login`; authenticated users
land on `/dashboard`. `DemoUserSeeder` creates a SuperAdmin login and
`DemoBusinessAccountSeeder` creates a Business Buyer login (`buyer@stockflow.test`,
password `password`) with a linked `business_accounts` row — both need
`RolePermissionSeeder` to have run first, which a plain `db:seed` handles since
seeders run in order.

## Local setup (without Docker)

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
# point DB_HOST at your local MySQL/Redis instances in .env
php artisan migrate --seed
composer run dev   # Laravel server + queue listener + Pail + Vite dev server, concurrently
```

## Tests

```bash
make test
# or: docker compose exec app php artisan test
```

The suite runs against SQLite `:memory:` by default (see `phpunit.xml`). A handful of
tests need real MySQL semantics (FULLTEXT indexes, real unique constraints, real row
locking, real Redis serialization) and switch to a dedicated `stockflow_testing`
database at runtime via the `Tests\Concerns\UsesRealMysqlDatabase` trait — they never
touch the dev database. Notably:

- `tests/Feature/Schema/DatabaseSchemaTest.php` — schema-level invariants.
- `tests/Feature/Stock/StockConcurrencyTest.php` — proves no-oversell under real
  concurrency: two separate OS processes race `StockService::reserve()` for the last
  unit of stock via real `SELECT ... FOR UPDATE` row locking; exactly one succeeds.
- `tests/Feature/Catalog/CatalogCacheTest.php` — one test round-trips through real
  Redis instead of the array cache driver.

## External API

Passport is installed only for external `/api/v1` clients. Browser UI continues to
use session auth through the `web` guard.

```bash
composer require laravel/passport
php artisan vendor:publish --tag=passport-config
php artisan vendor:publish --tag=passport-migrations
php artisan migrate
php artisan passport:keys
php artisan passport:client --password --provider=users --name="StockFlow B2B Password Grant"
php artisan passport:client --client --name="StockFlow Integration"
```

Access tokens last 15 minutes; refresh tokens last 30 days and rotate on use. API
docs live at [`docs/api-v1.md`](../docs/api-v1.md). Routes are under `/api/v1` and
require `auth:api`, Passport scopes, Laratrust permissions/policies, JSON headers,
and rate limiting.

Password-grant tokens are for B2B users and are required for quote, PO, and payment
workflows because those routes need `User` policies and business-account ownership.
Client-credentials tokens are accepted as scoped service principals for read-only
catalog and stock availability endpoints.

## Building for production

```bash
make npm-build
# or: docker compose exec vite npm run build
```

## The stock engine

`app/Services/StockService.php` is the only place `stock_movements` /
`stock_levels` are ever written. Every mutation:

1. runs inside `DB::transaction()` — the Service owns the transaction boundary,
   never the Repository or Controller;
2. locks the affected `stock_levels` row(s) via `lockForUpdate()`
   (`StockRepository::lockOrCreateLevel()` — creates the row first if it doesn't
   exist yet, race-safe against a concurrent creator via a unique-constraint
   catch-and-relock fallback);
3. appends exactly one immutable `stock_movements` row (`transfer()` appends two: a
   paired `transfer_out` + `transfer_in`, both warehouse rows locked in a
   deterministic sorted-UUID order so opposite-direction concurrent transfers
   between the same two warehouses can't deadlock);
4. updates the `stock_levels` projection to match.

`available` (`on_hand - reserved`) is always computed, never stored. No operation
lets `on_hand` or `reserved` go negative, and `reserve()`/`transfer()` reject a
request once `available < quantity` — even under concurrency, because the row lock
serializes competing transactions onto the same up-to-date numbers.

`reconcile()` (and `php artisan stock:reconcile`) independently sums
`stock_movements.quantity` per (product, warehouse) — grouped by which movement
types affect `on_hand` vs. `reserved` — and compares it against the `stock_levels`
row. CI can run `php artisan stock:reconcile` and treat a non-zero exit code as a
ledger/projection drift.

Warehouse-scoped authorization: `StockPolicy` + `WarehouseScopeMiddleware` check
that the acting user's Laratrust team includes every warehouse a `stock.move` /
`stock.transfer` request touches (`app/Support/WarehouseAccess.php`); SuperAdmin
bypasses team scoping. See `docs/project/canonical-decisions.md` §3/§6 for the full
rationale.

## B2C checkout

`OrderService` state machine: `pending → reserved → confirmed → fulfilled`, or
`pending`/`reserved → cancelled`. Every stock mutation is delegated to
`StockService` (`reserve()`/`confirmSale()`/`release()`) — `OrderService` never
writes `stock_movements` itself.

`checkout()` prices every cart line from the active `b2c_retail` price list
(`CatalogService::retailPriceFor()`), picks a fulfillment warehouse
(`StockService::bestWarehouseFor()` — most-available-stock heuristic, not a
customer choice), and reserves every line inside one `DB::transaction()`. Any line
failing rolls back the whole checkout — no `Order`/`OrderItem` row is left behind.
VAT is a fixed 14%, computed with `bcmath` to avoid float rounding drift on money.
`orders.reserved_until` (30 minutes from checkout) is released by
`php artisan stock:release-expired-reservations`, scheduled every minute.

Payment methods (`app/Payments/*Gateway.php`, resolved by
`PaymentService::resolveGateway()`): `fake_gateway` is demo/test-only and uses the
same verified webhook path as real providers; `cod` stays pending until authorized
staff confirms cash collection; `paymob`/`fawry` are signed-webhook placeholders
with explicit TODOs for real provider contracts/credentials; `bank_transfer` is
staff-settled for B2B. `PaymentService` locks the payment row and marks it
`paid`/`failed` inside the same DB transaction that confirms the order or releases
the reservation, so duplicate callbacks are no-ops and cannot reduce stock twice.
Cart is session-backed (`CartService`) — not a DB table, since only *order
creation* is required to be database-backed.

## B2B procurement

Two linked state machines:

- **Quote** (`QuoteService`): `draft → sent → accepted | rejected | expired`.
  `request()` creates a `draft` quote from a Business Buyer's desired
  products/quantities — no prices yet. A Vendor (their own products only — "own
  pricing context") or Inventory Manager prices every line via `price()`, which
  moves the quote to `sent` with a 14-day expiry. The Business Buyer then
  `accept()`s or `reject()`s it.
- **Purchase Order** (`PurchaseOrderService`): `pending_approval → approved →
  fulfilled → closed`, or `pending_approval → rejected`.

`QuoteService::accept()` is never called from a controller directly — only
`PurchaseOrderService::createFromQuote()` calls it, inside the same
`DB::transaction()` that creates the `PurchaseOrder` and its `PoItem`s, so
"accept the quote" and "create the PO" always happen together or neither does.
**Creating the PO does not reserve stock** — it only picks a fulfillment warehouse
per line; reservation happens only when an approver calls `approve()`.

`approve()`:
1. locks the `business_accounts` row (`BusinessAccountRepository::lockForUpdate()`
   — so two concurrent approvals against the same account can't both pass against
   a stale balance);
2. checks `outstanding_balance + PO total <= credit_limit` (via `bccomp`, not
   float comparison) — throws `CreditLimitExceededException` if it would be
   exceeded, leaving the PO untouched (`pending_approval`, no stock reserved);
3. records a `po_approvals` row, reserves every line via `StockService::reserve()`,
   and adds the PO total to `outstanding_balance` (the buyer now owes it under net
   terms).

Bank Transfer settlement (`POST /procurement/purchase-orders/{po}/bank-transfer`)
initiates and settles a `bank_transfer` `Payment` through `PaymentService`.
`PaymentService::settleManually()` then runs the payment update and
`PurchaseOrderService::settle()` inside one transaction, converting every line's
reservation into a completed sale (`StockService::confirmSale()`) and paying down
`outstanding_balance`.

`QuotePolicy`/`PurchaseOrderPolicy` enforce "own account" (Business Buyer) / "own
pricing context" (Vendor) record-level scoping; staff holding `po.approve` or
`payment.settle` can see/act on any. `PaymentPolicy` branches on payable type
(`Order` for B2C, `PurchaseOrder` for B2B) since both share the polymorphic
`payments` table.

## Admin, audit, dashboard & reports

`AuditService::record()` is the only writer of `activity_log` (the same pattern as
`StockService` being the only writer of `stock_movements`) — called from inside
`StockService::adjust()`, `PurchaseOrderService::approve()`/`reject()`,
`PaymentService`'s settlement path (covers manual settlement, webhook confirmation,
and the Fake Gateway simulator uniformly, since all three funnel through the same
method), `RoleAssignmentService::syncRoles()`, and `RolePermissionService::
syncPermissions()` — never from a Controller directly, so an entry can't exist
without the action it describes having actually committed (both happen inside the
same `DB::transaction()`). Fixed event vocabulary: `stock.adjusted`, `po.approved`,
`po.rejected`, `payment.settled`, `user.roles_updated`, `role.permissions_updated`.
View/filter at `/admin/audit-log` (`audit.read`; filters: event, user, date range).

`RolePermissionService` lets a `role.manage` holder edit a role's own permission
set inline from `/admin/roles` (Laratrust's `Role::syncPermissions()` already
invalidates the permission cache for every user holding that role — no extra
cache-busting step needed). `/admin/users/{user}/roles` (page component
`Admin/Users/Edit`) still handles which roles a user has.

`DashboardService::kpisFor()` returns a small COUNT/SUM bundle — `low_stock_count`,
`pending_po_approvals`, `pending_payments`, `todays_sales_total`,
`recent_activity` for staff; `pending_po_approvals`, `credit_limit`,
`outstanding_balance` for a Business Buyer; `{scope: 'none'}` for anyone else
(a bare Retail Customer isn't shown store-wide numbers) — cached for 60 seconds per
viewer scope (staff share one cache entry; a Business Buyer gets one scoped to
their `business_account_id`). A short TTL, not CatalogService's tag-and-flush
pattern: dashboard reads don't vastly outnumber writes the way catalog reads do.

Five reports, each a paginated + filtered + indexed `ReportService` call:

| Report | Route | Permission | Filters |
| --- | --- | --- | --- |
| Low stock | `/reports/low-stock` | `stock.read` | product, warehouse, threshold |
| Stock movements | `/reports/stock-movements` | `stock.read` | product, warehouse, type, user, date range |
| Sales | `/reports/sales` | `payment.settle` | product, warehouse, status, user, date range |
| Payments | `/reports/payments` | `payment.settle` | status, method, user, date range |
| Import history | `/reports/imports` | `import.run\|audit.read` | status, entity, user, date range |

Not every report exposes all five filter dimensions (date range/product/warehouse/
status/user) — only the ones that actually exist on the underlying table. Payments
have no product/warehouse column, so "user" maps to the payment's payable owner
instead (`Order.user_id` or `PurchaseOrder.businessAccount.user_id`) and
product/warehouse are omitted. Import batches span many rows/entities rather than
one product, so `entity` stands in for "product". New indexes added for these
reports: `payments(status, created_at)` + `payments(method)`,
`import_batches(status, created_at)`, `activity_log(causer_id, created_at)` +
`activity_log(event)`; the Stock Movement report reuses the existing
`stock_movements(product_id, warehouse_id, created_at)` index, and Sales reuses
`orders(status, created_at)`.

## Excel imports

Installed package:

```bash
composer require maatwebsite/excel
```

The UI lives at `/imports` and requires `import.run` (seeded for SuperAdmin and
Inventory Manager). `make start` already runs the queue worker; without Docker,
`composer run dev` starts the queue listener alongside Laravel and Vite.

Supported entities and natural keys:

- `categories`: `slug` (or generated from `name`), optional `parent_slug`.
- `products`: `sku`, with `category_slug` or `category_name`.
- `warehouses`: `code`.
- `suppliers`: `email` when present, otherwise `name`.
- `price_lists`: `name` + `type` for the list, `sku` + `min_qty` for items.
- `opening_stock`: `sku` + `warehouse_code`; `quantity` is the target on-hand value.

Manual test flow:

1. Log in as a SuperAdmin or Inventory Manager.
2. Open `/imports/create`, select an entity, and upload `.xlsx`, `.xls`, `.csv`, or
   `.txt`.
3. Open the resulting batch page at `/imports/{batch}` and refresh until status is
   `Completed`.
4. If failures exist, open `/imports/{batch}/errors` or download the CSV report.
5. For `opening_stock`, run `php artisan stock:reconcile`; it should report no
   ledger/projection drift.

## Hardening

Full detail (cache keys/TTLs/invalidation triggers, index inventory, real
`EXPLAIN` plans) lives in [`docs/technical/cache.md`](docs/technical/cache.md)
and [`docs/technical/indexing.md`](docs/technical/indexing.md). Summary:

- **Caching**: `CatalogService` (tag `catalog`, flush-on-write) and
  `StockService::listLevels()` — the Stock/Levels report page only — (tag
  `stock-levels`, 30s TTL, flushed on every `recordMovement()` call). Every
  other stock read stays live/uncached deliberately: caching a locked-mutation
  decision or `reconcile()`'s ledger/projection proof would defeat the point of
  the ledger. `DashboardService::kpisFor()` uses a short 60s TTL cache instead
  of tag-and-flush, since dashboard reads don't vastly outnumber writes.
- **Laratrust permission cache**: self-invalidates on every `addRole()` /
  `removeRole()` / `syncRoles()` / `syncPermissions()` call — no manual
  cache-busting needed in application code. One real gotcha this pass fixed:
  `migrate:fresh` resets bigint auto-increment IDs but never touches Redis, so
  a stale permission-cache entry from a *previous* user with the same ID could
  survive a reset and get served to a freshly-seeded SuperAdmin.
  `DatabaseSeeder::run()` now flushes the cache before seeding; `make fresh`
  also runs `cache:clear` as a second layer of defense. Regression test:
  `tests/Feature/Admin/SeededSuperAdminAccessTest.php`.
- **Rate limiting** (`AppServiceProvider::boot()`): `login` (5/min, keyed by
  IP+email — so one attacker IP can't lock out a legitimate email, and one
  email being hammered from many IPs still throttles), `checkout` (10/min per
  authenticated user), `webhook` (60/min per IP, applied to the whole
  `/webhooks/v1` group), `api` (120/min per token/IP).
- **Queue / Horizon**: `QUEUE_CONNECTION=redis`. The `queue` Docker Compose
  service runs `php artisan horizon`, which supervises workers and exposes a
  dashboard at `/horizon` (throughput, retries, failed jobs) gated to
  SuperAdmin only (`HorizonServiceProvider::gate()`) — Horizon shows job
  payloads/failure details with no equivalent entry in the PRD permission
  matrix, so it's a direct role check rather than a new granular permission.
  `config/horizon.php`'s `defaults.tries`/`backoff` (3/3) preserve the retry
  behavior the previous plain `queue:work --tries=3 --backoff=3` process gave
  `ImportCatalogJob` (which declares no `$tries` of its own).
- **Scheduler**: `stock:release-expired-reservations` runs every minute
  (`routes/console.php`), releasing B2C checkout reservations whose
  `reserved_until` has passed. `scheduler` Docker Compose service loops
  `artisan schedule:run` every 60s.
- **Reconciliation**: `php artisan stock:reconcile` independently sums
  `stock_movements` per (product, warehouse) and diffs it against
  `stock_levels`; non-zero exit on drift, safe to run in CI/cron.
- **Security headers**: `App\Http\Middleware\SecurityHeaders`, registered
  globally, sets `X-Content-Type-Options: nosniff`, `X-Frame-Options: DENY`,
  `Referrer-Policy: strict-origin-when-cross-origin`,
  `Permissions-Policy: camera=(), microphone=(), geolocation=()` on every
  response, plus `Strict-Transport-Security` on HTTPS requests. No CSP yet —
  the React bundle has no nonce plumbing and a naive policy would break
  inline styles some UI libraries rely on; deliberately deferred.
- **Code quality gate**: `pint.json` (Laravel preset), `phpstan.neon` +
  `phpstan-baseline.neon` (Larastan level 5 — 250 pre-existing findings
  baselined, mostly a documented Larastan false-positive class around enum
  `casts()` methods, not real bugs). `make quality` runs pint + stan + the
  full test suite locally; `.github/workflows/ci.yml` runs the same three
  gates on every push/PR against real MySQL + Redis service containers (only
  a handful of tests need them — see `tests/Concerns/UsesRealMysqlDatabase.php`
  — the rest of the suite runs on SQLite in-memory).

### Final hardening checklist

- [x] Redis caching — catalog (pre-existing) + stock levels report (new)
- [x] Cache invalidation — flush-on-write for both, documented in `docs/technical/cache.md`
- [x] Laratrust permission cache — self-invalidating; stale-cache-after-reset bug fixed + regression-tested
- [x] MySQL indexes — inventoried with real `EXPLAIN` plans in `docs/technical/indexing.md`
- [x] EXPLAIN validation notes — 8 real query plans captured against dev MySQL
- [x] Rate limiting — login, checkout, payment webhook, `/api/v1` (pre-existing)
- [x] Scheduler — `stock:release-expired-reservations` every minute (pre-existing, re-verified)
- [x] Queue workers — `queue:work` replaced by Horizon-supervised workers
- [x] Reconciliation — `stock:reconcile` (pre-existing, re-verified: 0 drift)
- [x] CI quality gates — GitHub Actions: pint, stan, full test suite
- [x] Test coverage — added: `SeededSuperAdminAccessTest`, `StockLevelCacheTest` (×2), `CatalogCacheTest` product-update case, `RateLimitingTest` (×4), `HorizonAccessTest` (×3), `SecurityHeadersTest`
- [x] Security headers — `SecurityHeaders` middleware, global
- [x] Laravel Pint — `pint.json`, clean across 299 files
- [x] PHPStan/Larastan — level 5, baseline generated, 2 real issues fixed (`StockLevel` model docblocks)
- [x] SuperAdmin unauthorized-access bug — fixed at the root cause (seeder cache flush), not just cleared once

Verification commands run before considering this pass complete:
`php artisan test` (159 passed), `./vendor/bin/pint --test` (299 files, clean),
`./vendor/bin/phpstan analyse` (no errors against baseline), `npm run build`
(clean production build).

## Project structure notes

- `routes/web.php` — Inertia page routes only (session/`web` guard). No API routes.
- `routes/api.php` — external Passport B2B API only, mounted as `/api/v1`.
- `routes/webhooks.php` — `/webhooks/v1/paymob`, `/webhooks/v1/fawry`, and
  `/webhooks/v1/fake-gateway`; mounted without the web/session/CSRF stack and
  signature-verified where the provider supports it.
- `app/Http/Controllers/Web/` — Inertia controllers, one folder per module
  (`Auth/`, `Admin/`, `Catalog/`, `Stock/`, `Sales/`, `Procurement/`, `Import/`,
  `Reports/`).
- `app/Http/Controllers/Api/V1/` — JSON API controllers for external B2B/system
  clients; thin wrappers around the same Services used by Web controllers.
- `app/Http/Controllers/Webhooks/` — Paymob/Fawry/Fake Gateway webhook endpoints.
- Layering: **Controller → FormRequest → Service → Repository → Model.** Controllers
  never call Eloquent directly; FormRequests own `authorize()`/`rules()`; Services
  own business rules/transactions; Repositories own Eloquent queries; Policies own
  record-level authorization.
- `resources/js/Pages/` — Inertia pages, resolved by `resources/js/app.jsx`, one
  folder per module (`Auth/`, `Admin/`, `Catalog/`, `Stock/`, `Sales/`,
  `Procurement/`, `Import/`, `Reports/`).
- `resources/js/Layouts/` — `AppLayout` (authenticated shell, renders
  `FlashMessage`) and `GuestLayout` (centered card, used by the login page).
- `resources/js/Components/` — shared UI primitives: `Button`, `Input`, `Select`,
  `Table`, `Pagination`, `Breadcrumbs`, `FlashMessage`, `PermissionGate`.
- `app/Http/Middleware/HandleInertiaRequests.php` — shares `auth.user`,
  `auth.roles`, `auth.permissions`, and `flash.success`/`flash.error` on every
  Inertia response.
- `app/Console/Commands/` — `stock:reconcile` and
  `stock:release-expired-reservations` (both fully implemented and scheduled).

## Permissions (Laratrust)

Seeded by `RolePermissionSeeder` per the Enterprise PRD §3 permission matrix:
`catalog.read`, `product.manage`, `category.manage`, `warehouse.manage`,
`stock.read`, `stock.move`, `stock.transfer`, `import.run`, `pricelist.manage`,
`sale.create`, `quote.request`, `quote.price`, `po.approve`, `payment.settle`,
`user.manage`, `role.manage`, `audit.read`.

## Not yet built

- Real Paymob/Fawry API calls, credentials, and provider-specific signature
  canonicalization. Placeholder drivers reject unsigned callbacks and document the
  TODOs.
````

## File: vite.config.js
````javascript
// Set by docker-compose's `vite` service so the dev server binds to
// all interfaces inside the container and the browser (on the host)
// can still reach the HMR websocket via the mapped port.
````
