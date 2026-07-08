<?php declare(strict_types = 1);

// osfsl-/var/www/html/vendor/composer/../psr/http-factory/src/ServerRequestFactoryInterface.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Psr\Http\Message\ServerRequestFactoryInterface
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-8584390af1bc3c624918525e725a7cfa639366c15bb7a3c7c065d04d8a20703b-8.4.23-6.70.0.3',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Psr\\Http\\Message\\ServerRequestFactoryInterface',
        'filename' => '/var/www/html/vendor/composer/../psr/http-factory/src/ServerRequestFactoryInterface.php',
      ),
    ),
    'namespace' => 'Psr\\Http\\Message',
    'name' => 'Psr\\Http\\Message\\ServerRequestFactoryInterface',
    'shortName' => 'ServerRequestFactoryInterface',
    'isInterface' => true,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 5,
    'endLine' => 24,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
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
      'createServerRequest' => 
      array (
        'name' => 'createServerRequest',
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
            'startLine' => 23,
            'endLine' => 23,
            'startColumn' => 41,
            'endColumn' => 54,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'uri' => 
          array (
            'name' => 'uri',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 23,
            'endLine' => 23,
            'startColumn' => 57,
            'endColumn' => 60,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
          'serverParams' => 
          array (
            'name' => 'serverParams',
            'default' => 
            array (
              'code' => '[]',
              'attributes' => 
              array (
                'startLine' => 23,
                'endLine' => 23,
                'startTokenPos' => 35,
                'startFilePos' => 896,
                'endTokenPos' => 36,
                'endFilePos' => 897,
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
            'startLine' => 23,
            'endLine' => 23,
            'startColumn' => 63,
            'endColumn' => 86,
            'parameterIndex' => 2,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'Psr\\Http\\Message\\ServerRequestInterface',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create a new server request.
 *
 * Note that server-params are taken precisely as given - no parsing/processing
 * of the given values is performed, and, in particular, no attempt is made to
 * determine the HTTP method or URI, which must be provided explicitly.
 *
 * @param string $method The HTTP method associated with the request.
 * @param UriInterface|string $uri The URI associated with the request. If
 *     the value is a string, the factory MUST create a UriInterface
 *     instance based on it.
 * @param array $serverParams Array of SAPI parameters with which to seed
 *     the generated request instance.
 *
 * @return ServerRequestInterface
 */',
        'startLine' => 23,
        'endLine' => 23,
        'startColumn' => 5,
        'endColumn' => 112,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Psr\\Http\\Message',
        'declaringClassName' => 'Psr\\Http\\Message\\ServerRequestFactoryInterface',
        'implementingClassName' => 'Psr\\Http\\Message\\ServerRequestFactoryInterface',
        'currentClassName' => 'Psr\\Http\\Message\\ServerRequestFactoryInterface',
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