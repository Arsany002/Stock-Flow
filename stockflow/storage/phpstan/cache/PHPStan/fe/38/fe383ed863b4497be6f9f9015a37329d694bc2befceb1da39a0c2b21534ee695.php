<?php declare(strict_types = 1);

// odsl-/var/www/html/app/Http/Requests/Catalog/StorePriceListItemRequest.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Http\Requests\Catalog\StorePriceListItemRequest
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.4.23-4184174242f6b3677003074e7d0a38f1cfc6e5f6ccdca3eb892a8c7645a83421',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Http\\Requests\\Catalog\\StorePriceListItemRequest',
        'filename' => '/var/www/html/app/Http/Requests/Catalog/StorePriceListItemRequest.php',
      ),
    ),
    'namespace' => 'App\\Http\\Requests\\Catalog',
    'name' => 'App\\Http\\Requests\\Catalog\\StorePriceListItemRequest',
    'shortName' => 'StorePriceListItemRequest',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 10,
    'endLine' => 48,
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
 * A Vendor may only add items for their own products (Enterprise PRD
 * §3, pricelist.manage "own"). There\'s no PriceListItem yet to hand to
 * a Policy at create time, so the ownership check is done here against
 * the submitted product_id.
 */',
        'startLine' => 18,
        'endLine' => 35,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Requests\\Catalog',
        'declaringClassName' => 'App\\Http\\Requests\\Catalog\\StorePriceListItemRequest',
        'implementingClassName' => 'App\\Http\\Requests\\Catalog\\StorePriceListItemRequest',
        'currentClassName' => 'App\\Http\\Requests\\Catalog\\StorePriceListItemRequest',
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
        'startLine' => 40,
        'endLine' => 47,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Requests\\Catalog',
        'declaringClassName' => 'App\\Http\\Requests\\Catalog\\StorePriceListItemRequest',
        'implementingClassName' => 'App\\Http\\Requests\\Catalog\\StorePriceListItemRequest',
        'currentClassName' => 'App\\Http\\Requests\\Catalog\\StorePriceListItemRequest',
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