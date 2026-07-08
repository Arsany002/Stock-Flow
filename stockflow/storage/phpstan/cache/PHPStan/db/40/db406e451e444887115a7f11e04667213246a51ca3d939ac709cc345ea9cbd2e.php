<?php declare(strict_types = 1);

// osfsl-/var/www/html/vendor/composer/../symfony/psr-http-message-bridge/HttpMessageFactoryInterface.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Symfony\Bridge\PsrHttpMessage\HttpMessageFactoryInterface
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-717c03f85d4ee0898d510b03dc3d288d8b5c5d831667c3e94106c12c1450a2c6-8.4.23-6.70.0.3',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Symfony\\Bridge\\PsrHttpMessage\\HttpMessageFactoryInterface',
        'filename' => '/var/www/html/vendor/composer/../symfony/psr-http-message-bridge/HttpMessageFactoryInterface.php',
      ),
    ),
    'namespace' => 'Symfony\\Bridge\\PsrHttpMessage',
    'name' => 'Symfony\\Bridge\\PsrHttpMessage\\HttpMessageFactoryInterface',
    'shortName' => 'HttpMessageFactoryInterface',
    'isInterface' => true,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Creates PSR HTTP Request and Response instances from Symfony ones.
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 24,
    'endLine' => 35,
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
      'createRequest' => 
      array (
        'name' => 'createRequest',
        'parameters' => 
        array (
          'symfonyRequest' => 
          array (
            'name' => 'symfonyRequest',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Symfony\\Component\\HttpFoundation\\Request',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 29,
            'endLine' => 29,
            'startColumn' => 35,
            'endColumn' => 57,
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
            'name' => 'Psr\\Http\\Message\\ServerRequestInterface',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Creates a PSR-7 Request instance from a Symfony one.
 */',
        'startLine' => 29,
        'endLine' => 29,
        'startColumn' => 5,
        'endColumn' => 83,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Symfony\\Bridge\\PsrHttpMessage',
        'declaringClassName' => 'Symfony\\Bridge\\PsrHttpMessage\\HttpMessageFactoryInterface',
        'implementingClassName' => 'Symfony\\Bridge\\PsrHttpMessage\\HttpMessageFactoryInterface',
        'currentClassName' => 'Symfony\\Bridge\\PsrHttpMessage\\HttpMessageFactoryInterface',
        'aliasName' => NULL,
      ),
      'createResponse' => 
      array (
        'name' => 'createResponse',
        'parameters' => 
        array (
          'symfonyResponse' => 
          array (
            'name' => 'symfonyResponse',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Symfony\\Component\\HttpFoundation\\Response',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 34,
            'endLine' => 34,
            'startColumn' => 36,
            'endColumn' => 60,
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
            'name' => 'Psr\\Http\\Message\\ResponseInterface',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Creates a PSR-7 Response instance from a Symfony one.
 */',
        'startLine' => 34,
        'endLine' => 34,
        'startColumn' => 5,
        'endColumn' => 81,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Symfony\\Bridge\\PsrHttpMessage',
        'declaringClassName' => 'Symfony\\Bridge\\PsrHttpMessage\\HttpMessageFactoryInterface',
        'implementingClassName' => 'Symfony\\Bridge\\PsrHttpMessage\\HttpMessageFactoryInterface',
        'currentClassName' => 'Symfony\\Bridge\\PsrHttpMessage\\HttpMessageFactoryInterface',
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