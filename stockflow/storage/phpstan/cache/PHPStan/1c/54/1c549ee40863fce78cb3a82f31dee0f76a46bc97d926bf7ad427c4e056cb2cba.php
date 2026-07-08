<?php declare(strict_types = 1);

// odsl-/var/www/html/database/seeders/RolePermissionSeeder.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Database\Seeders\RolePermissionSeeder
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.4.23-c3aa0ec65c835e8c0ccf2b74450f3c6439f2078937bd85b92450ff6a384a9d46',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Database\\Seeders\\RolePermissionSeeder',
        'filename' => '/var/www/html/database/seeders/RolePermissionSeeder.php',
      ),
    ),
    'namespace' => 'Database\\Seeders',
    'name' => 'Database\\Seeders\\RolePermissionSeeder',
    'shortName' => 'RolePermissionSeeder',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Seeds the six roles and full permission catalog from the Enterprise PRD §3
 * permission matrix, and wires each role to its permissions.
 *
 * Cells marked "own" / "team" / "self" in the PRD matrix still grant the base
 * permission to the role here — that scoping is enforced at the
 * controller/service layer (Policies for own/self, Laratrust teams for
 * warehouse-scoped "team" permissions), not by omitting the permission.
 * See docs/project/canonical-decisions.md §3.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 21,
    'endLine' => 97,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'Illuminate\\Database\\Seeder',
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
      'MATRIX' => 
      array (
        'declaringClassName' => 'Database\\Seeders\\RolePermissionSeeder',
        'implementingClassName' => 'Database\\Seeders\\RolePermissionSeeder',
        'name' => 'MATRIX',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '[
    // SuperAdmin is granted every permission separately below.
    \\App\\Enums\\UserRole::InventoryManager->value => [\\App\\Enums\\PermissionName::CatalogRead, \\App\\Enums\\PermissionName::ProductManage, \\App\\Enums\\PermissionName::CategoryManage, \\App\\Enums\\PermissionName::StockMove, \\App\\Enums\\PermissionName::StockTransfer, \\App\\Enums\\PermissionName::StockRead, \\App\\Enums\\PermissionName::ImportRun, \\App\\Enums\\PermissionName::PricelistManage, \\App\\Enums\\PermissionName::QuotePrice, \\App\\Enums\\PermissionName::PoApprove, \\App\\Enums\\PermissionName::PaymentSettle, \\App\\Enums\\PermissionName::AuditRead],
    \\App\\Enums\\UserRole::SalesCashier->value => [\\App\\Enums\\PermissionName::CatalogRead, \\App\\Enums\\PermissionName::StockRead, \\App\\Enums\\PermissionName::SaleCreate, \\App\\Enums\\PermissionName::PaymentSettle],
    \\App\\Enums\\UserRole::VendorSupplier->value => [
        \\App\\Enums\\PermissionName::CatalogRead,
        \\App\\Enums\\PermissionName::ProductManage,
        // own price-list items only (Policy)
        \\App\\Enums\\PermissionName::StockRead,
        // own products only (Policy)
        \\App\\Enums\\PermissionName::PricelistManage,
        // own price-list only (Policy)
        \\App\\Enums\\PermissionName::QuotePrice,
    ],
    \\App\\Enums\\UserRole::BusinessBuyer->value => [\\App\\Enums\\PermissionName::CatalogRead, \\App\\Enums\\PermissionName::QuoteRequest],
    \\App\\Enums\\UserRole::RetailCustomer->value => [\\App\\Enums\\PermissionName::CatalogRead, \\App\\Enums\\PermissionName::SaleCreate],
]',
          'attributes' => 
          array (
            'startLine' => 26,
            'endLine' => 63,
            'startTokenPos' => 54,
            'startFilePos' => 797,
            'endTokenPos' => 256,
            'endFilePos' => 2325,
          ),
        ),
        'docComment' => '/**
 * @var array<string, list<PermissionName>>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 26,
        'endLine' => 63,
        'startColumn' => 5,
        'endColumn' => 6,
      ),
    ),
    'immediateProperties' => 
    array (
    ),
    'immediateMethods' => 
    array (
      'run' => 
      array (
        'name' => 'run',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 65,
        'endLine' => 96,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Database\\Seeders',
        'declaringClassName' => 'Database\\Seeders\\RolePermissionSeeder',
        'implementingClassName' => 'Database\\Seeders\\RolePermissionSeeder',
        'currentClassName' => 'Database\\Seeders\\RolePermissionSeeder',
        'aliasName' => NULL,
      ),
    ),
    'traitsData' => 
    array (
      'aliases' => 
      array (
      ),
      'modifiers' => 
      array (
      ),
      'precedences' => 
      array (
      ),
      'hashes' => 
      array (
      ),
    ),
  ),
));