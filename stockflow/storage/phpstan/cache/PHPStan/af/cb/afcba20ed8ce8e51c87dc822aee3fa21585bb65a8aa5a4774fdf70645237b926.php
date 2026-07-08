<?php declare(strict_types = 1);

// odsl-/var/www/html/app/Http/Requests/Sales/AddToCartRequest.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Http\Requests\Sales\AddToCartRequest
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.4.23-330a03d98406d441c344c21c753f82ad17bbd249465c2ca65b1926e4f1f80614',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Http\\Requests\\Sales\\AddToCartRequest',
        'filename' => '/var/www/html/app/Http/Requests/Sales/AddToCartRequest.php',
      ),
    ),
    'namespace' => 'App\\Http\\Requests\\Sales',
    'name' => 'App\\Http\\Requests\\Sales\\AddToCartRequest',
    'shortName' => 'AddToCartRequest',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * The cart is session state, not a Model, so there\'s no Policy to defer
 * to — `permission:sale.create` on the route is the full gate (same
 * pattern as CategoryController\'s ownerless resources).
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 12,
    'endLine' => 29,
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
        'docComment' => NULL,
        'startLine' => 14,
        'endLine' => 17,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Requests\\Sales',
        'declaringClassName' => 'App\\Http\\Requests\\Sales\\AddToCartRequest',
        'implementingClassName' => 'App\\Http\\Requests\\Sales\\AddToCartRequest',
        'currentClassName' => 'App\\Http\\Requests\\Sales\\AddToCartRequest',
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
        'startLine' => 22,
        'endLine' => 28,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Requests\\Sales',
        'declaringClassName' => 'App\\Http\\Requests\\Sales\\AddToCartRequest',
        'implementingClassName' => 'App\\Http\\Requests\\Sales\\AddToCartRequest',
        'currentClassName' => 'App\\Http\\Requests\\Sales\\AddToCartRequest',
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