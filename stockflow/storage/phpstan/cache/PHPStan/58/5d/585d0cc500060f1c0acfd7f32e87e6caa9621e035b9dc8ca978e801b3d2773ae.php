<?php declare(strict_types = 1);

// ftm-/var/www/html/app/Services/OrderService.php
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v5-2.3.2',
   'data' => 
  array (
    0 => 
    array (
      '053641840d5f5dab4c9e38cf13e8e20a' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'orderchannel' => 'App\\Enums\\OrderChannel',
          'orderstatus' => 'App\\Enums\\OrderStatus',
          'paymentmethod' => 'App\\Enums\\PaymentMethod',
          'paymentstatus' => 'App\\Enums\\PaymentStatus',
          'invalidstatetransitionexception' => 'App\\Exceptions\\InvalidStateTransitionException',
          'outofstockexception' => 'App\\Exceptions\\OutOfStockException',
          'pricingunavailableexception' => 'App\\Exceptions\\PricingUnavailableException',
          'order' => 'App\\Models\\Order',
          'orderitem' => 'App\\Models\\OrderItem',
          'product' => 'App\\Models\\Product',
          'user' => 'App\\Models\\User',
          'orderrepositoryinterface' => 'App\\Repositories\\Contracts\\OrderRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'invalidargumentexception' => 'InvalidArgumentException',
        ),
         'className' => 'App\\Services\\OrderService',
         'functionName' => NULL,
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      'f1b791125c649e699dab00de1787abb4' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'orderchannel' => 'App\\Enums\\OrderChannel',
          'orderstatus' => 'App\\Enums\\OrderStatus',
          'paymentmethod' => 'App\\Enums\\PaymentMethod',
          'paymentstatus' => 'App\\Enums\\PaymentStatus',
          'invalidstatetransitionexception' => 'App\\Exceptions\\InvalidStateTransitionException',
          'outofstockexception' => 'App\\Exceptions\\OutOfStockException',
          'pricingunavailableexception' => 'App\\Exceptions\\PricingUnavailableException',
          'order' => 'App\\Models\\Order',
          'orderitem' => 'App\\Models\\OrderItem',
          'product' => 'App\\Models\\Product',
          'user' => 'App\\Models\\User',
          'orderrepositoryinterface' => 'App\\Repositories\\Contracts\\OrderRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'invalidargumentexception' => 'InvalidArgumentException',
        ),
         'className' => 'App\\Services\\OrderService',
         'functionName' => '__construct',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'App\\Services',
           'uses' => 
          array (
            'orderchannel' => 'App\\Enums\\OrderChannel',
            'orderstatus' => 'App\\Enums\\OrderStatus',
            'paymentmethod' => 'App\\Enums\\PaymentMethod',
            'paymentstatus' => 'App\\Enums\\PaymentStatus',
            'invalidstatetransitionexception' => 'App\\Exceptions\\InvalidStateTransitionException',
            'outofstockexception' => 'App\\Exceptions\\OutOfStockException',
            'pricingunavailableexception' => 'App\\Exceptions\\PricingUnavailableException',
            'order' => 'App\\Models\\Order',
            'orderitem' => 'App\\Models\\OrderItem',
            'product' => 'App\\Models\\Product',
            'user' => 'App\\Models\\User',
            'orderrepositoryinterface' => 'App\\Repositories\\Contracts\\OrderRepositoryInterface',
            'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
            'db' => 'Illuminate\\Support\\Facades\\DB',
            'invalidargumentexception' => 'InvalidArgumentException',
          ),
           'className' => 'App\\Services\\OrderService',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '659bc8d76e6a1d1583ab82aea5f9fe98' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'orderchannel' => 'App\\Enums\\OrderChannel',
          'orderstatus' => 'App\\Enums\\OrderStatus',
          'paymentmethod' => 'App\\Enums\\PaymentMethod',
          'paymentstatus' => 'App\\Enums\\PaymentStatus',
          'invalidstatetransitionexception' => 'App\\Exceptions\\InvalidStateTransitionException',
          'outofstockexception' => 'App\\Exceptions\\OutOfStockException',
          'pricingunavailableexception' => 'App\\Exceptions\\PricingUnavailableException',
          'order' => 'App\\Models\\Order',
          'orderitem' => 'App\\Models\\OrderItem',
          'product' => 'App\\Models\\Product',
          'user' => 'App\\Models\\User',
          'orderrepositoryinterface' => 'App\\Repositories\\Contracts\\OrderRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'invalidargumentexception' => 'InvalidArgumentException',
        ),
         'className' => 'App\\Services\\OrderService',
         'functionName' => 'listForUser',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'App\\Services',
           'uses' => 
          array (
            'orderchannel' => 'App\\Enums\\OrderChannel',
            'orderstatus' => 'App\\Enums\\OrderStatus',
            'paymentmethod' => 'App\\Enums\\PaymentMethod',
            'paymentstatus' => 'App\\Enums\\PaymentStatus',
            'invalidstatetransitionexception' => 'App\\Exceptions\\InvalidStateTransitionException',
            'outofstockexception' => 'App\\Exceptions\\OutOfStockException',
            'pricingunavailableexception' => 'App\\Exceptions\\PricingUnavailableException',
            'order' => 'App\\Models\\Order',
            'orderitem' => 'App\\Models\\OrderItem',
            'product' => 'App\\Models\\Product',
            'user' => 'App\\Models\\User',
            'orderrepositoryinterface' => 'App\\Repositories\\Contracts\\OrderRepositoryInterface',
            'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
            'db' => 'Illuminate\\Support\\Facades\\DB',
            'invalidargumentexception' => 'InvalidArgumentException',
          ),
           'className' => 'App\\Services\\OrderService',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '71e77979d8cbd0f1fa4fbd2dea367e84' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'orderchannel' => 'App\\Enums\\OrderChannel',
          'orderstatus' => 'App\\Enums\\OrderStatus',
          'paymentmethod' => 'App\\Enums\\PaymentMethod',
          'paymentstatus' => 'App\\Enums\\PaymentStatus',
          'invalidstatetransitionexception' => 'App\\Exceptions\\InvalidStateTransitionException',
          'outofstockexception' => 'App\\Exceptions\\OutOfStockException',
          'pricingunavailableexception' => 'App\\Exceptions\\PricingUnavailableException',
          'order' => 'App\\Models\\Order',
          'orderitem' => 'App\\Models\\OrderItem',
          'product' => 'App\\Models\\Product',
          'user' => 'App\\Models\\User',
          'orderrepositoryinterface' => 'App\\Repositories\\Contracts\\OrderRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'invalidargumentexception' => 'InvalidArgumentException',
        ),
         'className' => 'App\\Services\\OrderService',
         'functionName' => 'find',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'App\\Services',
           'uses' => 
          array (
            'orderchannel' => 'App\\Enums\\OrderChannel',
            'orderstatus' => 'App\\Enums\\OrderStatus',
            'paymentmethod' => 'App\\Enums\\PaymentMethod',
            'paymentstatus' => 'App\\Enums\\PaymentStatus',
            'invalidstatetransitionexception' => 'App\\Exceptions\\InvalidStateTransitionException',
            'outofstockexception' => 'App\\Exceptions\\OutOfStockException',
            'pricingunavailableexception' => 'App\\Exceptions\\PricingUnavailableException',
            'order' => 'App\\Models\\Order',
            'orderitem' => 'App\\Models\\OrderItem',
            'product' => 'App\\Models\\Product',
            'user' => 'App\\Models\\User',
            'orderrepositoryinterface' => 'App\\Repositories\\Contracts\\OrderRepositoryInterface',
            'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
            'db' => 'Illuminate\\Support\\Facades\\DB',
            'invalidargumentexception' => 'InvalidArgumentException',
          ),
           'className' => 'App\\Services\\OrderService',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '0c597727718f828c76c66009f4873f4b' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'orderchannel' => 'App\\Enums\\OrderChannel',
          'orderstatus' => 'App\\Enums\\OrderStatus',
          'paymentmethod' => 'App\\Enums\\PaymentMethod',
          'paymentstatus' => 'App\\Enums\\PaymentStatus',
          'invalidstatetransitionexception' => 'App\\Exceptions\\InvalidStateTransitionException',
          'outofstockexception' => 'App\\Exceptions\\OutOfStockException',
          'pricingunavailableexception' => 'App\\Exceptions\\PricingUnavailableException',
          'order' => 'App\\Models\\Order',
          'orderitem' => 'App\\Models\\OrderItem',
          'product' => 'App\\Models\\Product',
          'user' => 'App\\Models\\User',
          'orderrepositoryinterface' => 'App\\Repositories\\Contracts\\OrderRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'invalidargumentexception' => 'InvalidArgumentException',
        ),
         'className' => 'App\\Services\\OrderService',
         'functionName' => 'checkout',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'App\\Services',
           'uses' => 
          array (
            'orderchannel' => 'App\\Enums\\OrderChannel',
            'orderstatus' => 'App\\Enums\\OrderStatus',
            'paymentmethod' => 'App\\Enums\\PaymentMethod',
            'paymentstatus' => 'App\\Enums\\PaymentStatus',
            'invalidstatetransitionexception' => 'App\\Exceptions\\InvalidStateTransitionException',
            'outofstockexception' => 'App\\Exceptions\\OutOfStockException',
            'pricingunavailableexception' => 'App\\Exceptions\\PricingUnavailableException',
            'order' => 'App\\Models\\Order',
            'orderitem' => 'App\\Models\\OrderItem',
            'product' => 'App\\Models\\Product',
            'user' => 'App\\Models\\User',
            'orderrepositoryinterface' => 'App\\Repositories\\Contracts\\OrderRepositoryInterface',
            'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
            'db' => 'Illuminate\\Support\\Facades\\DB',
            'invalidargumentexception' => 'InvalidArgumentException',
          ),
           'className' => 'App\\Services\\OrderService',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      'ac0b17467ae0615ae31b09a45bb329e8' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'orderchannel' => 'App\\Enums\\OrderChannel',
          'orderstatus' => 'App\\Enums\\OrderStatus',
          'paymentmethod' => 'App\\Enums\\PaymentMethod',
          'paymentstatus' => 'App\\Enums\\PaymentStatus',
          'invalidstatetransitionexception' => 'App\\Exceptions\\InvalidStateTransitionException',
          'outofstockexception' => 'App\\Exceptions\\OutOfStockException',
          'pricingunavailableexception' => 'App\\Exceptions\\PricingUnavailableException',
          'order' => 'App\\Models\\Order',
          'orderitem' => 'App\\Models\\OrderItem',
          'product' => 'App\\Models\\Product',
          'user' => 'App\\Models\\User',
          'orderrepositoryinterface' => 'App\\Repositories\\Contracts\\OrderRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'invalidargumentexception' => 'InvalidArgumentException',
        ),
         'className' => 'App\\Services\\OrderService',
         'functionName' => 'confirmPayment',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'App\\Services',
           'uses' => 
          array (
            'orderchannel' => 'App\\Enums\\OrderChannel',
            'orderstatus' => 'App\\Enums\\OrderStatus',
            'paymentmethod' => 'App\\Enums\\PaymentMethod',
            'paymentstatus' => 'App\\Enums\\PaymentStatus',
            'invalidstatetransitionexception' => 'App\\Exceptions\\InvalidStateTransitionException',
            'outofstockexception' => 'App\\Exceptions\\OutOfStockException',
            'pricingunavailableexception' => 'App\\Exceptions\\PricingUnavailableException',
            'order' => 'App\\Models\\Order',
            'orderitem' => 'App\\Models\\OrderItem',
            'product' => 'App\\Models\\Product',
            'user' => 'App\\Models\\User',
            'orderrepositoryinterface' => 'App\\Repositories\\Contracts\\OrderRepositoryInterface',
            'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
            'db' => 'Illuminate\\Support\\Facades\\DB',
            'invalidargumentexception' => 'InvalidArgumentException',
          ),
           'className' => 'App\\Services\\OrderService',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      'f9fba7fb1464f4cd3fb9e18cfb1e367b' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'orderchannel' => 'App\\Enums\\OrderChannel',
          'orderstatus' => 'App\\Enums\\OrderStatus',
          'paymentmethod' => 'App\\Enums\\PaymentMethod',
          'paymentstatus' => 'App\\Enums\\PaymentStatus',
          'invalidstatetransitionexception' => 'App\\Exceptions\\InvalidStateTransitionException',
          'outofstockexception' => 'App\\Exceptions\\OutOfStockException',
          'pricingunavailableexception' => 'App\\Exceptions\\PricingUnavailableException',
          'order' => 'App\\Models\\Order',
          'orderitem' => 'App\\Models\\OrderItem',
          'product' => 'App\\Models\\Product',
          'user' => 'App\\Models\\User',
          'orderrepositoryinterface' => 'App\\Repositories\\Contracts\\OrderRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'invalidargumentexception' => 'InvalidArgumentException',
        ),
         'className' => 'App\\Services\\OrderService',
         'functionName' => 'cancel',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'App\\Services',
           'uses' => 
          array (
            'orderchannel' => 'App\\Enums\\OrderChannel',
            'orderstatus' => 'App\\Enums\\OrderStatus',
            'paymentmethod' => 'App\\Enums\\PaymentMethod',
            'paymentstatus' => 'App\\Enums\\PaymentStatus',
            'invalidstatetransitionexception' => 'App\\Exceptions\\InvalidStateTransitionException',
            'outofstockexception' => 'App\\Exceptions\\OutOfStockException',
            'pricingunavailableexception' => 'App\\Exceptions\\PricingUnavailableException',
            'order' => 'App\\Models\\Order',
            'orderitem' => 'App\\Models\\OrderItem',
            'product' => 'App\\Models\\Product',
            'user' => 'App\\Models\\User',
            'orderrepositoryinterface' => 'App\\Repositories\\Contracts\\OrderRepositoryInterface',
            'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
            'db' => 'Illuminate\\Support\\Facades\\DB',
            'invalidargumentexception' => 'InvalidArgumentException',
          ),
           'className' => 'App\\Services\\OrderService',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '94ad6dc2daf694b9e3dd0f9f0362382e' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'orderchannel' => 'App\\Enums\\OrderChannel',
          'orderstatus' => 'App\\Enums\\OrderStatus',
          'paymentmethod' => 'App\\Enums\\PaymentMethod',
          'paymentstatus' => 'App\\Enums\\PaymentStatus',
          'invalidstatetransitionexception' => 'App\\Exceptions\\InvalidStateTransitionException',
          'outofstockexception' => 'App\\Exceptions\\OutOfStockException',
          'pricingunavailableexception' => 'App\\Exceptions\\PricingUnavailableException',
          'order' => 'App\\Models\\Order',
          'orderitem' => 'App\\Models\\OrderItem',
          'product' => 'App\\Models\\Product',
          'user' => 'App\\Models\\User',
          'orderrepositoryinterface' => 'App\\Repositories\\Contracts\\OrderRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'invalidargumentexception' => 'InvalidArgumentException',
        ),
         'className' => 'App\\Services\\OrderService',
         'functionName' => 'markFulfilled',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'App\\Services',
           'uses' => 
          array (
            'orderchannel' => 'App\\Enums\\OrderChannel',
            'orderstatus' => 'App\\Enums\\OrderStatus',
            'paymentmethod' => 'App\\Enums\\PaymentMethod',
            'paymentstatus' => 'App\\Enums\\PaymentStatus',
            'invalidstatetransitionexception' => 'App\\Exceptions\\InvalidStateTransitionException',
            'outofstockexception' => 'App\\Exceptions\\OutOfStockException',
            'pricingunavailableexception' => 'App\\Exceptions\\PricingUnavailableException',
            'order' => 'App\\Models\\Order',
            'orderitem' => 'App\\Models\\OrderItem',
            'product' => 'App\\Models\\Product',
            'user' => 'App\\Models\\User',
            'orderrepositoryinterface' => 'App\\Repositories\\Contracts\\OrderRepositoryInterface',
            'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
            'db' => 'Illuminate\\Support\\Facades\\DB',
            'invalidargumentexception' => 'InvalidArgumentException',
          ),
           'className' => 'App\\Services\\OrderService',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      'f088024fe028ea7d5ca42ccba366523d' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'orderchannel' => 'App\\Enums\\OrderChannel',
          'orderstatus' => 'App\\Enums\\OrderStatus',
          'paymentmethod' => 'App\\Enums\\PaymentMethod',
          'paymentstatus' => 'App\\Enums\\PaymentStatus',
          'invalidstatetransitionexception' => 'App\\Exceptions\\InvalidStateTransitionException',
          'outofstockexception' => 'App\\Exceptions\\OutOfStockException',
          'pricingunavailableexception' => 'App\\Exceptions\\PricingUnavailableException',
          'order' => 'App\\Models\\Order',
          'orderitem' => 'App\\Models\\OrderItem',
          'product' => 'App\\Models\\Product',
          'user' => 'App\\Models\\User',
          'orderrepositoryinterface' => 'App\\Repositories\\Contracts\\OrderRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'invalidargumentexception' => 'InvalidArgumentException',
        ),
         'className' => 'App\\Services\\OrderService',
         'functionName' => 'releaseExpiredReservations',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'App\\Services',
           'uses' => 
          array (
            'orderchannel' => 'App\\Enums\\OrderChannel',
            'orderstatus' => 'App\\Enums\\OrderStatus',
            'paymentmethod' => 'App\\Enums\\PaymentMethod',
            'paymentstatus' => 'App\\Enums\\PaymentStatus',
            'invalidstatetransitionexception' => 'App\\Exceptions\\InvalidStateTransitionException',
            'outofstockexception' => 'App\\Exceptions\\OutOfStockException',
            'pricingunavailableexception' => 'App\\Exceptions\\PricingUnavailableException',
            'order' => 'App\\Models\\Order',
            'orderitem' => 'App\\Models\\OrderItem',
            'product' => 'App\\Models\\Product',
            'user' => 'App\\Models\\User',
            'orderrepositoryinterface' => 'App\\Repositories\\Contracts\\OrderRepositoryInterface',
            'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
            'db' => 'Illuminate\\Support\\Facades\\DB',
            'invalidargumentexception' => 'InvalidArgumentException',
          ),
           'className' => 'App\\Services\\OrderService',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
    ),
    1 => 
    array (
      '/var/www/html/app/Services/OrderService.php' => '1f3686f780edece37d78b0f0cd8aa39e89f262292a3c682f0c66bdbc63ac21bb',
    ),
  ),
));