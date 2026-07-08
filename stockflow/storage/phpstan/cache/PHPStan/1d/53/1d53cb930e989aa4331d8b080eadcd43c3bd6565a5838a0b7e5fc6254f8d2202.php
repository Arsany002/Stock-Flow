<?php declare(strict_types = 1);

// osfsl-/var/www/html/vendor/composer/../psr/http-message/src/ServerRequestInterface.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Psr\Http\Message\ServerRequestInterface
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-43c218d6c4426c7f1d354b20736ec77be924b94e7c1b11786057de6c3f3f66e8-8.4.23-6.70.0.3',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Psr\\Http\\Message\\ServerRequestInterface',
        'filename' => '/var/www/html/vendor/composer/../psr/http-message/src/ServerRequestInterface.php',
      ),
    ),
    'namespace' => 'Psr\\Http\\Message',
    'name' => 'Psr\\Http\\Message\\ServerRequestInterface',
    'shortName' => 'ServerRequestInterface',
    'isInterface' => true,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Representation of an incoming, server-side HTTP request.
 *
 * Per the HTTP specification, this interface includes properties for
 * each of the following:
 *
 * - Protocol version
 * - HTTP method
 * - URI
 * - Headers
 * - Message body
 *
 * Additionally, it encapsulates all data as it has arrived to the
 * application from the CGI and/or PHP environment, including:
 *
 * - The values represented in $_SERVER.
 * - Any cookies provided (generally via $_COOKIE)
 * - Query string arguments (generally via $_GET, or as parsed via parse_str())
 * - Upload files, if any (as represented by $_FILES)
 * - Deserialized body parameters (generally from $_POST)
 *
 * $_SERVER values MUST be treated as immutable, as they represent application
 * state at the time of request; as such, no methods are provided to allow
 * modification of those values. The other values provide such methods, as they
 * can be restored from $_SERVER or the request body, and may need treatment
 * during the application (e.g., body parameters may be deserialized based on
 * content type).
 *
 * Additionally, this interface recognizes the utility of introspecting a
 * request to derive and match additional parameters (e.g., via URI path
 * matching, decrypting cookie values, deserializing non-form-encoded body
 * content, matching authorization headers to users, etc). These parameters
 * are stored in an "attributes" property.
 *
 * Requests are considered immutable; all methods that might change state MUST
 * be implemented such that they retain the internal state of the current
 * message and return an instance that contains the changed state.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 43,
    'endLine' => 261,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
      0 => 'Psr\\Http\\Message\\RequestInterface',
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
      'getServerParams' => 
      array (
        'name' => 'getServerParams',
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
 * Retrieve server parameters.
 *
 * Retrieves data related to the incoming request environment,
 * typically derived from PHP\'s $_SERVER superglobal. The data IS NOT
 * REQUIRED to originate from $_SERVER.
 *
 * @return array
 */',
        'startLine' => 54,
        'endLine' => 54,
        'startColumn' => 5,
        'endColumn' => 45,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Psr\\Http\\Message',
        'declaringClassName' => 'Psr\\Http\\Message\\ServerRequestInterface',
        'implementingClassName' => 'Psr\\Http\\Message\\ServerRequestInterface',
        'currentClassName' => 'Psr\\Http\\Message\\ServerRequestInterface',
        'aliasName' => NULL,
      ),
      'getCookieParams' => 
      array (
        'name' => 'getCookieParams',
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
 * Retrieve cookies.
 *
 * Retrieves cookies sent by the client to the server.
 *
 * The data MUST be compatible with the structure of the $_COOKIE
 * superglobal.
 *
 * @return array
 */',
        'startLine' => 66,
        'endLine' => 66,
        'startColumn' => 5,
        'endColumn' => 45,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Psr\\Http\\Message',
        'declaringClassName' => 'Psr\\Http\\Message\\ServerRequestInterface',
        'implementingClassName' => 'Psr\\Http\\Message\\ServerRequestInterface',
        'currentClassName' => 'Psr\\Http\\Message\\ServerRequestInterface',
        'aliasName' => NULL,
      ),
      'withCookieParams' => 
      array (
        'name' => 'withCookieParams',
        'parameters' => 
        array (
          'cookies' => 
          array (
            'name' => 'cookies',
            'default' => NULL,
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
            'startLine' => 85,
            'endLine' => 85,
            'startColumn' => 38,
            'endColumn' => 51,
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
 * Return an instance with the specified cookies.
 *
 * The data IS NOT REQUIRED to come from the $_COOKIE superglobal, but MUST
 * be compatible with the structure of $_COOKIE. Typically, this data will
 * be injected at instantiation.
 *
 * This method MUST NOT update the related Cookie header of the request
 * instance, nor related values in the server params.
 *
 * This method MUST be implemented in such a way as to retain the
 * immutability of the message, and MUST return an instance that has the
 * updated cookie values.
 *
 * @param array $cookies Array of key/value pairs representing cookies.
 * @return static
 */',
        'startLine' => 85,
        'endLine' => 85,
        'startColumn' => 5,
        'endColumn' => 77,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Psr\\Http\\Message',
        'declaringClassName' => 'Psr\\Http\\Message\\ServerRequestInterface',
        'implementingClassName' => 'Psr\\Http\\Message\\ServerRequestInterface',
        'currentClassName' => 'Psr\\Http\\Message\\ServerRequestInterface',
        'aliasName' => NULL,
      ),
      'getQueryParams' => 
      array (
        'name' => 'getQueryParams',
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
 * Retrieve query string arguments.
 *
 * Retrieves the deserialized query string arguments, if any.
 *
 * Note: the query params might not be in sync with the URI or server
 * params. If you need to ensure you are only getting the original
 * values, you may need to parse the query string from `getUri()->getQuery()`
 * or from the `QUERY_STRING` server param.
 *
 * @return array
 */',
        'startLine' => 99,
        'endLine' => 99,
        'startColumn' => 5,
        'endColumn' => 44,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Psr\\Http\\Message',
        'declaringClassName' => 'Psr\\Http\\Message\\ServerRequestInterface',
        'implementingClassName' => 'Psr\\Http\\Message\\ServerRequestInterface',
        'currentClassName' => 'Psr\\Http\\Message\\ServerRequestInterface',
        'aliasName' => NULL,
      ),
      'withQueryParams' => 
      array (
        'name' => 'withQueryParams',
        'parameters' => 
        array (
          'query' => 
          array (
            'name' => 'query',
            'default' => NULL,
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
            'startLine' => 123,
            'endLine' => 123,
            'startColumn' => 37,
            'endColumn' => 48,
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
 * Return an instance with the specified query string arguments.
 *
 * These values SHOULD remain immutable over the course of the incoming
 * request. They MAY be injected during instantiation, such as from PHP\'s
 * $_GET superglobal, or MAY be derived from some other value such as the
 * URI. In cases where the arguments are parsed from the URI, the data
 * MUST be compatible with what PHP\'s parse_str() would return for
 * purposes of how duplicate query parameters are handled, and how nested
 * sets are handled.
 *
 * Setting query string arguments MUST NOT change the URI stored by the
 * request, nor the values in the server params.
 *
 * This method MUST be implemented in such a way as to retain the
 * immutability of the message, and MUST return an instance that has the
 * updated query string arguments.
 *
 * @param array $query Array of query string arguments, typically from
 *     $_GET.
 * @return static
 */',
        'startLine' => 123,
        'endLine' => 123,
        'startColumn' => 5,
        'endColumn' => 74,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Psr\\Http\\Message',
        'declaringClassName' => 'Psr\\Http\\Message\\ServerRequestInterface',
        'implementingClassName' => 'Psr\\Http\\Message\\ServerRequestInterface',
        'currentClassName' => 'Psr\\Http\\Message\\ServerRequestInterface',
        'aliasName' => NULL,
      ),
      'getUploadedFiles' => 
      array (
        'name' => 'getUploadedFiles',
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
 * Retrieve normalized file upload data.
 *
 * This method returns upload metadata in a normalized tree, with each leaf
 * an instance of Psr\\Http\\Message\\UploadedFileInterface.
 *
 * These values MAY be prepared from $_FILES or the message body during
 * instantiation, or MAY be injected via withUploadedFiles().
 *
 * @return array An array tree of UploadedFileInterface instances; an empty
 *     array MUST be returned if no data is present.
 */',
        'startLine' => 137,
        'endLine' => 137,
        'startColumn' => 5,
        'endColumn' => 46,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Psr\\Http\\Message',
        'declaringClassName' => 'Psr\\Http\\Message\\ServerRequestInterface',
        'implementingClassName' => 'Psr\\Http\\Message\\ServerRequestInterface',
        'currentClassName' => 'Psr\\Http\\Message\\ServerRequestInterface',
        'aliasName' => NULL,
      ),
      'withUploadedFiles' => 
      array (
        'name' => 'withUploadedFiles',
        'parameters' => 
        array (
          'uploadedFiles' => 
          array (
            'name' => 'uploadedFiles',
            'default' => NULL,
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
            'startLine' => 150,
            'endLine' => 150,
            'startColumn' => 39,
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
            'name' => 'Psr\\Http\\Message\\ServerRequestInterface',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create a new instance with the specified uploaded files.
 *
 * This method MUST be implemented in such a way as to retain the
 * immutability of the message, and MUST return an instance that has the
 * updated body parameters.
 *
 * @param array $uploadedFiles An array tree of UploadedFileInterface instances.
 * @return static
 * @throws \\InvalidArgumentException if an invalid structure is provided.
 */',
        'startLine' => 150,
        'endLine' => 150,
        'startColumn' => 5,
        'endColumn' => 84,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Psr\\Http\\Message',
        'declaringClassName' => 'Psr\\Http\\Message\\ServerRequestInterface',
        'implementingClassName' => 'Psr\\Http\\Message\\ServerRequestInterface',
        'currentClassName' => 'Psr\\Http\\Message\\ServerRequestInterface',
        'aliasName' => NULL,
      ),
      'getParsedBody' => 
      array (
        'name' => 'getParsedBody',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Retrieve any parameters provided in the request body.
 *
 * If the request Content-Type is either application/x-www-form-urlencoded
 * or multipart/form-data, and the request method is POST, this method MUST
 * return the contents of $_POST.
 *
 * Otherwise, this method may return any results of deserializing
 * the request body content; as parsing returns structured content, the
 * potential types MUST be arrays or objects only. A null value indicates
 * the absence of body content.
 *
 * @return null|array|object The deserialized body parameters, if any.
 *     These will typically be an array or object.
 */',
        'startLine' => 167,
        'endLine' => 167,
        'startColumn' => 5,
        'endColumn' => 36,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Psr\\Http\\Message',
        'declaringClassName' => 'Psr\\Http\\Message\\ServerRequestInterface',
        'implementingClassName' => 'Psr\\Http\\Message\\ServerRequestInterface',
        'currentClassName' => 'Psr\\Http\\Message\\ServerRequestInterface',
        'aliasName' => NULL,
      ),
      'withParsedBody' => 
      array (
        'name' => 'withParsedBody',
        'parameters' => 
        array (
          'data' => 
          array (
            'name' => 'data',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 197,
            'endLine' => 197,
            'startColumn' => 36,
            'endColumn' => 40,
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
 * Return an instance with the specified body parameters.
 *
 * These MAY be injected during instantiation.
 *
 * If the request Content-Type is either application/x-www-form-urlencoded
 * or multipart/form-data, and the request method is POST, use this method
 * ONLY to inject the contents of $_POST.
 *
 * The data IS NOT REQUIRED to come from $_POST, but MUST be the results of
 * deserializing the request body content. Deserialization/parsing returns
 * structured data, and, as such, this method ONLY accepts arrays or objects,
 * or a null value if nothing was available to parse.
 *
 * As an example, if content negotiation determines that the request data
 * is a JSON payload, this method could be used to create a request
 * instance with the deserialized parameters.
 *
 * This method MUST be implemented in such a way as to retain the
 * immutability of the message, and MUST return an instance that has the
 * updated body parameters.
 *
 * @param null|array|object $data The deserialized body data. This will
 *     typically be in an array or object.
 * @return static
 * @throws \\InvalidArgumentException if an unsupported argument type is
 *     provided.
 */',
        'startLine' => 197,
        'endLine' => 197,
        'startColumn' => 5,
        'endColumn' => 66,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Psr\\Http\\Message',
        'declaringClassName' => 'Psr\\Http\\Message\\ServerRequestInterface',
        'implementingClassName' => 'Psr\\Http\\Message\\ServerRequestInterface',
        'currentClassName' => 'Psr\\Http\\Message\\ServerRequestInterface',
        'aliasName' => NULL,
      ),
      'getAttributes' => 
      array (
        'name' => 'getAttributes',
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
 * Retrieve attributes derived from the request.
 *
 * The request "attributes" may be used to allow injection of any
 * parameters derived from the request: e.g., the results of path
 * match operations; the results of decrypting cookies; the results of
 * deserializing non-form-encoded message bodies; etc. Attributes
 * will be application and request specific, and CAN be mutable.
 *
 * @return array Attributes derived from the request.
 */',
        'startLine' => 210,
        'endLine' => 210,
        'startColumn' => 5,
        'endColumn' => 43,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Psr\\Http\\Message',
        'declaringClassName' => 'Psr\\Http\\Message\\ServerRequestInterface',
        'implementingClassName' => 'Psr\\Http\\Message\\ServerRequestInterface',
        'currentClassName' => 'Psr\\Http\\Message\\ServerRequestInterface',
        'aliasName' => NULL,
      ),
      'getAttribute' => 
      array (
        'name' => 'getAttribute',
        'parameters' => 
        array (
          'name' => 
          array (
            'name' => 'name',
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
            'startLine' => 227,
            'endLine' => 227,
            'startColumn' => 34,
            'endColumn' => 45,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'default' => 
          array (
            'name' => 'default',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 227,
                'endLine' => 227,
                'startTokenPos' => 183,
                'startFilePos' => 9094,
                'endTokenPos' => 183,
                'endFilePos' => 9097,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 227,
            'endLine' => 227,
            'startColumn' => 48,
            'endColumn' => 62,
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
 * Retrieve a single derived request attribute.
 *
 * Retrieves a single derived request attribute as described in
 * getAttributes(). If the attribute has not been previously set, returns
 * the default value as provided.
 *
 * This method obviates the need for a hasAttribute() method, as it allows
 * specifying a default value to return if the attribute is not found.
 *
 * @see getAttributes()
 * @param string $name The attribute name.
 * @param mixed $default Default value to return if the attribute does not exist.
 * @return mixed
 */',
        'startLine' => 227,
        'endLine' => 227,
        'startColumn' => 5,
        'endColumn' => 64,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Psr\\Http\\Message',
        'declaringClassName' => 'Psr\\Http\\Message\\ServerRequestInterface',
        'implementingClassName' => 'Psr\\Http\\Message\\ServerRequestInterface',
        'currentClassName' => 'Psr\\Http\\Message\\ServerRequestInterface',
        'aliasName' => NULL,
      ),
      'withAttribute' => 
      array (
        'name' => 'withAttribute',
        'parameters' => 
        array (
          'name' => 
          array (
            'name' => 'name',
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
            'startLine' => 244,
            'endLine' => 244,
            'startColumn' => 35,
            'endColumn' => 46,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'value' => 
          array (
            'name' => 'value',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 244,
            'endLine' => 244,
            'startColumn' => 49,
            'endColumn' => 54,
            'parameterIndex' => 1,
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
 * Return an instance with the specified derived request attribute.
 *
 * This method allows setting a single derived request attribute as
 * described in getAttributes().
 *
 * This method MUST be implemented in such a way as to retain the
 * immutability of the message, and MUST return an instance that has the
 * updated attribute.
 *
 * @see getAttributes()
 * @param string $name The attribute name.
 * @param mixed $value The value of the attribute.
 * @return static
 */',
        'startLine' => 244,
        'endLine' => 244,
        'startColumn' => 5,
        'endColumn' => 80,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Psr\\Http\\Message',
        'declaringClassName' => 'Psr\\Http\\Message\\ServerRequestInterface',
        'implementingClassName' => 'Psr\\Http\\Message\\ServerRequestInterface',
        'currentClassName' => 'Psr\\Http\\Message\\ServerRequestInterface',
        'aliasName' => NULL,
      ),
      'withoutAttribute' => 
      array (
        'name' => 'withoutAttribute',
        'parameters' => 
        array (
          'name' => 
          array (
            'name' => 'name',
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
            'startLine' => 260,
            'endLine' => 260,
            'startColumn' => 38,
            'endColumn' => 49,
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
 * Return an instance that removes the specified derived request attribute.
 *
 * This method allows removing a single derived request attribute as
 * described in getAttributes().
 *
 * This method MUST be implemented in such a way as to retain the
 * immutability of the message, and MUST return an instance that removes
 * the attribute.
 *
 * @see getAttributes()
 * @param string $name The attribute name.
 * @return static
 */',
        'startLine' => 260,
        'endLine' => 260,
        'startColumn' => 5,
        'endColumn' => 75,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Psr\\Http\\Message',
        'declaringClassName' => 'Psr\\Http\\Message\\ServerRequestInterface',
        'implementingClassName' => 'Psr\\Http\\Message\\ServerRequestInterface',
        'currentClassName' => 'Psr\\Http\\Message\\ServerRequestInterface',
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