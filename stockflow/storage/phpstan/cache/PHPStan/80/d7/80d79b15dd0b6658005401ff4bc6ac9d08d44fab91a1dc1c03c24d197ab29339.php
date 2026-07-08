<?php declare(strict_types = 1);

// odsl-/var/www/html/app/Console/Commands/StockReleaseExpiredReservationsCommand.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Console\Commands\StockReleaseExpiredReservationsCommand
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.4.23-5ee0af6575905cc5fe20a77c18ba5396aa6c99338c7893bd09008183cc8bfa7e',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Console\\Commands\\StockReleaseExpiredReservationsCommand',
        'filename' => '/var/www/html/app/Console/Commands/StockReleaseExpiredReservationsCommand.php',
      ),
    ),
    'namespace' => 'App\\Console\\Commands',
    'name' => 'App\\Console\\Commands\\StockReleaseExpiredReservationsCommand',
    'shortName' => 'StockReleaseExpiredReservationsCommand',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Releases every B2C order reservation whose `orders.reserved_until` has
 * passed without payment — the counterpart to StockService\'s "no oversell"
 * guarantee (an abandoned/unpaid checkout can\'t hold stock hostage
 * indefinitely). Each release goes through OrderService::cancel(), which
 * calls StockService::release() per line inside its own transaction, so one
 * bad row can\'t block the rest of the batch.
 *
 * Registered on the scheduler (routes/console.php) to run every minute —
 * see requirement #6: the scheduled *job* wiring is intentionally minimal
 * (a plain Schedule::command(), no dedicated queued Job class/retry/backoff
 * policy), since the release logic itself needed to be fully correct, not
 * the scheduling infrastructure around it.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 22,
    'endLine' => 36,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'Illuminate\\Console\\Command',
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
      'signature' => 
      array (
        'declaringClassName' => 'App\\Console\\Commands\\StockReleaseExpiredReservationsCommand',
        'implementingClassName' => 'App\\Console\\Commands\\StockReleaseExpiredReservationsCommand',
        'name' => 'signature',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\'stock:release-expired-reservations\'',
          'attributes' => 
          array (
            'startLine' => 24,
            'endLine' => 24,
            'startTokenPos' => 35,
            'startFilePos' => 969,
            'endTokenPos' => 35,
            'endFilePos' => 1004,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 24,
        'endLine' => 24,
        'startColumn' => 5,
        'endColumn' => 64,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'description' => 
      array (
        'declaringClassName' => 'App\\Console\\Commands\\StockReleaseExpiredReservationsCommand',
        'implementingClassName' => 'App\\Console\\Commands\\StockReleaseExpiredReservationsCommand',
        'name' => 'description',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\'Release stock reservations for B2C orders whose reserved_until has passed unpaid.\'',
          'attributes' => 
          array (
            'startLine' => 26,
            'endLine' => 26,
            'startTokenPos' => 44,
            'startFilePos' => 1037,
            'endTokenPos' => 44,
            'endFilePos' => 1119,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 26,
        'endLine' => 26,
        'startColumn' => 5,
        'endColumn' => 113,
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
      'handle' => 
      array (
        'name' => 'handle',
        'parameters' => 
        array (
          'orders' => 
          array (
            'name' => 'orders',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Services\\OrderService',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 28,
            'endLine' => 28,
            'startColumn' => 28,
            'endColumn' => 47,
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
            'name' => 'int',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 28,
        'endLine' => 35,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Console\\Commands',
        'declaringClassName' => 'App\\Console\\Commands\\StockReleaseExpiredReservationsCommand',
        'implementingClassName' => 'App\\Console\\Commands\\StockReleaseExpiredReservationsCommand',
        'currentClassName' => 'App\\Console\\Commands\\StockReleaseExpiredReservationsCommand',
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