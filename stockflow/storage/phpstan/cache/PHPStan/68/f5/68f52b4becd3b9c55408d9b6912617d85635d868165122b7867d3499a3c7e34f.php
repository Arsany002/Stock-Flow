<?php declare(strict_types = 1);

// odsl-/var/www/html/app/Providers/RepositoryServiceProvider.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Providers\RepositoryServiceProvider
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.4.23-12de00c91ea1a00c403d688ce946120029342f10683f11e4d8ae0e49817ebd2f',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Providers\\RepositoryServiceProvider',
        'filename' => '/var/www/html/app/Providers/RepositoryServiceProvider.php',
      ),
    ),
    'namespace' => 'App\\Providers',
    'name' => 'App\\Providers\\RepositoryServiceProvider',
    'shortName' => 'RepositoryServiceProvider',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Binds each repository contract to its Eloquent implementation, so
 * Services can depend on the interface (see
 * docs/project/canonical-decisions.md §2 — Controller → Service →
 * Repository → Model).
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 39,
    'endLine' => 59,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'Illuminate\\Support\\ServiceProvider',
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
      'bindings' => 
      array (
        'declaringClassName' => 'App\\Providers\\RepositoryServiceProvider',
        'implementingClassName' => 'App\\Providers\\RepositoryServiceProvider',
        'name' => 'bindings',
        'modifiers' => 1,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'default' => 
        array (
          'code' => '[\\App\\Repositories\\Contracts\\ProductRepositoryInterface::class => \\App\\Repositories\\ProductRepository::class, \\App\\Repositories\\Contracts\\CategoryRepositoryInterface::class => \\App\\Repositories\\CategoryRepository::class, \\App\\Repositories\\Contracts\\SupplierRepositoryInterface::class => \\App\\Repositories\\SupplierRepository::class, \\App\\Repositories\\Contracts\\PriceListRepositoryInterface::class => \\App\\Repositories\\PriceListRepository::class, \\App\\Repositories\\Contracts\\StockRepositoryInterface::class => \\App\\Repositories\\StockRepository::class, \\App\\Repositories\\Contracts\\WarehouseRepositoryInterface::class => \\App\\Repositories\\WarehouseRepository::class, \\App\\Repositories\\Contracts\\OrderRepositoryInterface::class => \\App\\Repositories\\OrderRepository::class, \\App\\Repositories\\Contracts\\QuoteRepositoryInterface::class => \\App\\Repositories\\QuoteRepository::class, \\App\\Repositories\\Contracts\\PurchaseOrderRepositoryInterface::class => \\App\\Repositories\\PurchaseOrderRepository::class, \\App\\Repositories\\Contracts\\PaymentRepositoryInterface::class => \\App\\Repositories\\PaymentRepository::class, \\App\\Repositories\\Contracts\\ImportRepositoryInterface::class => \\App\\Repositories\\ImportRepository::class, \\App\\Repositories\\Contracts\\BusinessAccountRepositoryInterface::class => \\App\\Repositories\\BusinessAccountRepository::class, \\App\\Repositories\\Contracts\\AuditLogRepositoryInterface::class => \\App\\Repositories\\AuditLogRepository::class]',
          'attributes' => 
          array (
            'startLine' => 44,
            'endLine' => 58,
            'startTokenPos' => 164,
            'startFilePos' => 1760,
            'endTokenPos' => 309,
            'endFilePos' => 2717,
          ),
        ),
        'docComment' => '/**
 * @var array<class-string, class-string>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 44,
        'endLine' => 58,
        'startColumn' => 5,
        'endColumn' => 6,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
    ),
    'immediateMethods' => 
    array (
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