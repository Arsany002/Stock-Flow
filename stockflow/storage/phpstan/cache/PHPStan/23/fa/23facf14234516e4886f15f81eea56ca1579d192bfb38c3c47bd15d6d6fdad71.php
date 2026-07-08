<?php declare(strict_types = 1);

// odsl-/var/www/html/app/Exceptions/PricingUnavailableException.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Exceptions\PricingUnavailableException
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.4.23-30131673b842239e5f35110763b07d5aab99bb19f6fe2aa24299d52ac888b341',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Exceptions\\PricingUnavailableException',
        'filename' => '/var/www/html/app/Exceptions/PricingUnavailableException.php',
      ),
    ),
    'namespace' => 'App\\Exceptions',
    'name' => 'App\\Exceptions\\PricingUnavailableException',
    'shortName' => 'PricingUnavailableException',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Thrown when a checkout line has no applicable price — no active
 * `b2c_retail` price list item covers the product/quantity. A pricing gap
 * is a catalog-data problem, not a stock problem, so it\'s kept distinct
 * from OutOfStockException even though both abort checkout the same way.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 11,
    'endLine' => 20,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'App\\Exceptions\\DomainException',
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
      'forProduct' => 
      array (
        'name' => 'forProduct',
        'parameters' => 
        array (
          'productId' => 
          array (
            'name' => 'productId',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'string',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 13,
            'endLine' => 13,
            'startColumn' => 39,
            'endColumn' => 55,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'self',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 13,
        'endLine' => 19,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'App\\Exceptions',
        'declaringClassName' => 'App\\Exceptions\\PricingUnavailableException',
        'implementingClassName' => 'App\\Exceptions\\PricingUnavailableException',
        'currentClassName' => 'App\\Exceptions\\PricingUnavailableException',
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