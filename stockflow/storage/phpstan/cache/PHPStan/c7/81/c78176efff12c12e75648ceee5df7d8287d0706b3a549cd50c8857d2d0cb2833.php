<?php declare(strict_types = 1);

// odsl-/var/www/html/app/Exceptions/CreditLimitExceededException.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Exceptions\CreditLimitExceededException
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.4.23-747086eb0f4bd38fad07587c526524c158fd8644da3eb7d6666282e3f5767d10',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Exceptions\\CreditLimitExceededException',
        'filename' => '/var/www/html/app/Exceptions/CreditLimitExceededException.php',
      ),
    ),
    'namespace' => 'App\\Exceptions',
    'name' => 'App\\Exceptions\\CreditLimitExceededException',
    'shortName' => 'CreditLimitExceededException',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Thrown during PO approval when a business account\'s outstanding_balance
 * plus the new PO total would exceed its credit_limit.
 *
 * @see docs/source/StockFlow-Enterprise-PRD.md.pdf FR-6.4.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 11,
    'endLine' => 25,
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
      'forBusinessAccount' => 
      array (
        'name' => 'forBusinessAccount',
        'parameters' => 
        array (
          'businessAccountId' => 
          array (
            'name' => 'businessAccountId',
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
            'startColumn' => 47,
            'endColumn' => 71,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'creditLimit' => 
          array (
            'name' => 'creditLimit',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'float',
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
            'startColumn' => 74,
            'endColumn' => 91,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
          'attemptedTotal' => 
          array (
            'name' => 'attemptedTotal',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'float',
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
            'startColumn' => 94,
            'endColumn' => 114,
            'parameterIndex' => 2,
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
        'endLine' => 24,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'App\\Exceptions',
        'declaringClassName' => 'App\\Exceptions\\CreditLimitExceededException',
        'implementingClassName' => 'App\\Exceptions\\CreditLimitExceededException',
        'currentClassName' => 'App\\Exceptions\\CreditLimitExceededException',
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