<?php declare(strict_types = 1);

// odsl-/var/www/html/app/Exceptions/PaymentVerificationException.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Exceptions\PaymentVerificationException
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.4.23-9bfd165e5c16af3592349784b64f79b27e7b4ed9212c79298f918e34f6c833bc',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Exceptions\\PaymentVerificationException',
        'filename' => '/var/www/html/app/Exceptions/PaymentVerificationException.php',
      ),
    ),
    'namespace' => 'App\\Exceptions',
    'name' => 'App\\Exceptions\\PaymentVerificationException',
    'shortName' => 'PaymentVerificationException',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Thrown when a payment webhook/callback fails signature verification, or
 * otherwise cannot be trusted enough to convert a reservation to sale_out.
 *
 * @see docs/project/canonical-decisions.md — webhooks are signature-verified
 *      and idempotent.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 12,
    'endLine' => 21,
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
      'invalidSignature' => 
      array (
        'name' => 'invalidSignature',
        'parameters' => 
        array (
          'method' => 
          array (
            'name' => 'method',
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
            'startLine' => 14,
            'endLine' => 14,
            'startColumn' => 45,
            'endColumn' => 58,
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
        'startLine' => 14,
        'endLine' => 20,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'App\\Exceptions',
        'declaringClassName' => 'App\\Exceptions\\PaymentVerificationException',
        'implementingClassName' => 'App\\Exceptions\\PaymentVerificationException',
        'currentClassName' => 'App\\Exceptions\\PaymentVerificationException',
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