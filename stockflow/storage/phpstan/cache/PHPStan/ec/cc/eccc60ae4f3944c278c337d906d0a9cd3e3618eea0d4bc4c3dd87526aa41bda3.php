<?php declare(strict_types = 1);

// odsl-/var/www/html/app/Http/Requests/Catalog/StoreSupplierRequest.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Http\Requests\Catalog\StoreSupplierRequest
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.4.23-672272b807895c4a269f66762dc77edfe6a81dbd1711313501051b13150e4e2f',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Http\\Requests\\Catalog\\StoreSupplierRequest',
        'filename' => '/var/www/html/app/Http/Requests/Catalog/StoreSupplierRequest.php',
      ),
    ),
    'namespace' => 'App\\Http\\Requests\\Catalog',
    'name' => 'App\\Http\\Requests\\Catalog\\StoreSupplierRequest',
    'shortName' => 'StoreSupplierRequest',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 8,
    'endLine' => 32,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'Illuminate\\Foundation\\Http\\FormRequest',
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
    ),
    'immediateMethods' => 
    array (
      'authorize' => 
      array (
        'name' => 'authorize',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'bool',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Suppliers have no dedicated PRD permission; gated under
 * `product.manage` since they\'re a product-catalog concern managed by
 * the same roles (SuperAdmin, Inventory Manager).
 */',
        'startLine' => 15,
        'endLine' => 18,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Requests\\Catalog',
        'declaringClassName' => 'App\\Http\\Requests\\Catalog\\StoreSupplierRequest',
        'implementingClassName' => 'App\\Http\\Requests\\Catalog\\StoreSupplierRequest',
        'currentClassName' => 'App\\Http\\Requests\\Catalog\\StoreSupplierRequest',
        'aliasName' => NULL,
      ),
      'rules' => 
      array (
        'name' => 'rules',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @return array<string, array<int, mixed>>
 */',
        'startLine' => 23,
        'endLine' => 31,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Requests\\Catalog',
        'declaringClassName' => 'App\\Http\\Requests\\Catalog\\StoreSupplierRequest',
        'implementingClassName' => 'App\\Http\\Requests\\Catalog\\StoreSupplierRequest',
        'currentClassName' => 'App\\Http\\Requests\\Catalog\\StoreSupplierRequest',
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