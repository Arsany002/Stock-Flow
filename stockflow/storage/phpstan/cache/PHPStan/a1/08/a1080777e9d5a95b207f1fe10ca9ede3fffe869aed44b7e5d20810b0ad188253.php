<?php declare(strict_types = 1);

// odsl-/var/www/html/app/Exceptions/DomainException.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Exceptions\DomainException
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.4.23-62f29f061ed22a5bfaf1ad6517fa273ca3ca9cc2f6c6bd69ace185fe160489b8',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Exceptions\\DomainException',
        'filename' => '/var/www/html/app/Exceptions/DomainException.php',
      ),
    ),
    'namespace' => 'App\\Exceptions',
    'name' => 'App\\Exceptions\\DomainException',
    'shortName' => 'DomainException',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 64,
    'docComment' => '/**
 * Base type for exceptions that represent a domain/business-rule failure
 * (as opposed to an infrastructure error). Services throw these; the
 * exception handler and/or controllers translate them into the appropriate
 * HTTP response (validation error bag, 403, 409, ...).
 *
 * See docs/project/canonical-decisions.md §2 — "Exceptions represent domain
 * failures" is an architecture rule, not just a naming convention.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 16,
    'endLine' => 44,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'RuntimeException',
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
      'context' => 
      array (
        'declaringClassName' => 'App\\Exceptions\\DomainException',
        'implementingClassName' => 'App\\Exceptions\\DomainException',
        'name' => 'context',
        'modifiers' => 2,
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
          'code' => '[]',
          'attributes' => 
          array (
            'startLine' => 25,
            'endLine' => 25,
            'startTokenPos' => 36,
            'startFilePos' => 823,
            'endTokenPos' => 37,
            'endFilePos' => 824,
          ),
        ),
        'docComment' => '/**
 * Extra machine-readable context about the failure (e.g. product_id,
 * requested vs. available quantity). Safe to expose in API error
 * responses; never put secrets here.
 *
 * @var array<string, mixed>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 25,
        'endLine' => 25,
        'startColumn' => 5,
        'endColumn' => 34,
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
      '__construct' => 
      array (
        'name' => '__construct',
        'parameters' => 
        array (
          'message' => 
          array (
            'name' => 'message',
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
            'startLine' => 30,
            'endLine' => 30,
            'startColumn' => 33,
            'endColumn' => 47,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'context' => 
          array (
            'name' => 'context',
            'default' => 
            array (
              'code' => '[]',
              'attributes' => 
              array (
                'startLine' => 30,
                'endLine' => 30,
                'startTokenPos' => 59,
                'startFilePos' => 956,
                'endTokenPos' => 60,
                'endFilePos' => 957,
              ),
            ),
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'array',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 30,
            'endLine' => 30,
            'startColumn' => 50,
            'endColumn' => 68,
            'parameterIndex' => 1,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @param  array<string, mixed>  $context
 */',
        'startLine' => 30,
        'endLine' => 35,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Exceptions',
        'declaringClassName' => 'App\\Exceptions\\DomainException',
        'implementingClassName' => 'App\\Exceptions\\DomainException',
        'currentClassName' => 'App\\Exceptions\\DomainException',
        'aliasName' => NULL,
      ),
      'context' => 
      array (
        'name' => 'context',
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
 * @return array<string, mixed>
 */',
        'startLine' => 40,
        'endLine' => 43,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Exceptions',
        'declaringClassName' => 'App\\Exceptions\\DomainException',
        'implementingClassName' => 'App\\Exceptions\\DomainException',
        'currentClassName' => 'App\\Exceptions\\DomainException',
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