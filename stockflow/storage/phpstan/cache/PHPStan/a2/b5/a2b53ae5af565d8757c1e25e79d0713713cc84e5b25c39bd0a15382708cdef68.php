<?php declare(strict_types = 1);

// ftm-/var/www/html/app/Services/PurchaseOrderService.php
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v5-2.3.2',
   'data' => 
  array (
    0 => 
    array (
      '1bec5e517b137734ef55aa88e6f8607c' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'approvaldecision' => 'App\\Enums\\ApprovalDecision',
          'purchaseorderstatus' => 'App\\Enums\\PurchaseOrderStatus',
          'creditlimitexceededexception' => 'App\\Exceptions\\CreditLimitExceededException',
          'invalidstatetransitionexception' => 'App\\Exceptions\\InvalidStateTransitionException',
          'outofstockexception' => 'App\\Exceptions\\OutOfStockException',
          'businessaccount' => 'App\\Models\\BusinessAccount',
          'poapproval' => 'App\\Models\\PoApproval',
          'poitem' => 'App\\Models\\PoItem',
          'purchaseorder' => 'App\\Models\\PurchaseOrder',
          'quote' => 'App\\Models\\Quote',
          'user' => 'App\\Models\\User',
          'businessaccountrepositoryinterface' => 'App\\Repositories\\Contracts\\BusinessAccountRepositoryInterface',
          'purchaseorderrepositoryinterface' => 'App\\Repositories\\Contracts\\PurchaseOrderRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'db' => 'Illuminate\\Support\\Facades\\DB',
        ),
         'className' => 'App\\Services\\PurchaseOrderService',
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
      '4307d90dc001e5bd72eaf20249a0a5e8' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'approvaldecision' => 'App\\Enums\\ApprovalDecision',
          'purchaseorderstatus' => 'App\\Enums\\PurchaseOrderStatus',
          'creditlimitexceededexception' => 'App\\Exceptions\\CreditLimitExceededException',
          'invalidstatetransitionexception' => 'App\\Exceptions\\InvalidStateTransitionException',
          'outofstockexception' => 'App\\Exceptions\\OutOfStockException',
          'businessaccount' => 'App\\Models\\BusinessAccount',
          'poapproval' => 'App\\Models\\PoApproval',
          'poitem' => 'App\\Models\\PoItem',
          'purchaseorder' => 'App\\Models\\PurchaseOrder',
          'quote' => 'App\\Models\\Quote',
          'user' => 'App\\Models\\User',
          'businessaccountrepositoryinterface' => 'App\\Repositories\\Contracts\\BusinessAccountRepositoryInterface',
          'purchaseorderrepositoryinterface' => 'App\\Repositories\\Contracts\\PurchaseOrderRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'db' => 'Illuminate\\Support\\Facades\\DB',
        ),
         'className' => 'App\\Services\\PurchaseOrderService',
         'functionName' => '__construct',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'App\\Services',
           'uses' => 
          array (
            'approvaldecision' => 'App\\Enums\\ApprovalDecision',
            'purchaseorderstatus' => 'App\\Enums\\PurchaseOrderStatus',
            'creditlimitexceededexception' => 'App\\Exceptions\\CreditLimitExceededException',
            'invalidstatetransitionexception' => 'App\\Exceptions\\InvalidStateTransitionException',
            'outofstockexception' => 'App\\Exceptions\\OutOfStockException',
            'businessaccount' => 'App\\Models\\BusinessAccount',
            'poapproval' => 'App\\Models\\PoApproval',
            'poitem' => 'App\\Models\\PoItem',
            'purchaseorder' => 'App\\Models\\PurchaseOrder',
            'quote' => 'App\\Models\\Quote',
            'user' => 'App\\Models\\User',
            'businessaccountrepositoryinterface' => 'App\\Repositories\\Contracts\\BusinessAccountRepositoryInterface',
            'purchaseorderrepositoryinterface' => 'App\\Repositories\\Contracts\\PurchaseOrderRepositoryInterface',
            'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
            'db' => 'Illuminate\\Support\\Facades\\DB',
          ),
           'className' => 'App\\Services\\PurchaseOrderService',
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
      'c9adec39aa8652ba231a969c6d104c90' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'approvaldecision' => 'App\\Enums\\ApprovalDecision',
          'purchaseorderstatus' => 'App\\Enums\\PurchaseOrderStatus',
          'creditlimitexceededexception' => 'App\\Exceptions\\CreditLimitExceededException',
          'invalidstatetransitionexception' => 'App\\Exceptions\\InvalidStateTransitionException',
          'outofstockexception' => 'App\\Exceptions\\OutOfStockException',
          'businessaccount' => 'App\\Models\\BusinessAccount',
          'poapproval' => 'App\\Models\\PoApproval',
          'poitem' => 'App\\Models\\PoItem',
          'purchaseorder' => 'App\\Models\\PurchaseOrder',
          'quote' => 'App\\Models\\Quote',
          'user' => 'App\\Models\\User',
          'businessaccountrepositoryinterface' => 'App\\Repositories\\Contracts\\BusinessAccountRepositoryInterface',
          'purchaseorderrepositoryinterface' => 'App\\Repositories\\Contracts\\PurchaseOrderRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'db' => 'Illuminate\\Support\\Facades\\DB',
        ),
         'className' => 'App\\Services\\PurchaseOrderService',
         'functionName' => 'find',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'App\\Services',
           'uses' => 
          array (
            'approvaldecision' => 'App\\Enums\\ApprovalDecision',
            'purchaseorderstatus' => 'App\\Enums\\PurchaseOrderStatus',
            'creditlimitexceededexception' => 'App\\Exceptions\\CreditLimitExceededException',
            'invalidstatetransitionexception' => 'App\\Exceptions\\InvalidStateTransitionException',
            'outofstockexception' => 'App\\Exceptions\\OutOfStockException',
            'businessaccount' => 'App\\Models\\BusinessAccount',
            'poapproval' => 'App\\Models\\PoApproval',
            'poitem' => 'App\\Models\\PoItem',
            'purchaseorder' => 'App\\Models\\PurchaseOrder',
            'quote' => 'App\\Models\\Quote',
            'user' => 'App\\Models\\User',
            'businessaccountrepositoryinterface' => 'App\\Repositories\\Contracts\\BusinessAccountRepositoryInterface',
            'purchaseorderrepositoryinterface' => 'App\\Repositories\\Contracts\\PurchaseOrderRepositoryInterface',
            'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
            'db' => 'Illuminate\\Support\\Facades\\DB',
          ),
           'className' => 'App\\Services\\PurchaseOrderService',
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
      '29460521553cc0c06b23b66c732b1637' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'approvaldecision' => 'App\\Enums\\ApprovalDecision',
          'purchaseorderstatus' => 'App\\Enums\\PurchaseOrderStatus',
          'creditlimitexceededexception' => 'App\\Exceptions\\CreditLimitExceededException',
          'invalidstatetransitionexception' => 'App\\Exceptions\\InvalidStateTransitionException',
          'outofstockexception' => 'App\\Exceptions\\OutOfStockException',
          'businessaccount' => 'App\\Models\\BusinessAccount',
          'poapproval' => 'App\\Models\\PoApproval',
          'poitem' => 'App\\Models\\PoItem',
          'purchaseorder' => 'App\\Models\\PurchaseOrder',
          'quote' => 'App\\Models\\Quote',
          'user' => 'App\\Models\\User',
          'businessaccountrepositoryinterface' => 'App\\Repositories\\Contracts\\BusinessAccountRepositoryInterface',
          'purchaseorderrepositoryinterface' => 'App\\Repositories\\Contracts\\PurchaseOrderRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'db' => 'Illuminate\\Support\\Facades\\DB',
        ),
         'className' => 'App\\Services\\PurchaseOrderService',
         'functionName' => 'listForViewer',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'App\\Services',
           'uses' => 
          array (
            'approvaldecision' => 'App\\Enums\\ApprovalDecision',
            'purchaseorderstatus' => 'App\\Enums\\PurchaseOrderStatus',
            'creditlimitexceededexception' => 'App\\Exceptions\\CreditLimitExceededException',
            'invalidstatetransitionexception' => 'App\\Exceptions\\InvalidStateTransitionException',
            'outofstockexception' => 'App\\Exceptions\\OutOfStockException',
            'businessaccount' => 'App\\Models\\BusinessAccount',
            'poapproval' => 'App\\Models\\PoApproval',
            'poitem' => 'App\\Models\\PoItem',
            'purchaseorder' => 'App\\Models\\PurchaseOrder',
            'quote' => 'App\\Models\\Quote',
            'user' => 'App\\Models\\User',
            'businessaccountrepositoryinterface' => 'App\\Repositories\\Contracts\\BusinessAccountRepositoryInterface',
            'purchaseorderrepositoryinterface' => 'App\\Repositories\\Contracts\\PurchaseOrderRepositoryInterface',
            'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
            'db' => 'Illuminate\\Support\\Facades\\DB',
          ),
           'className' => 'App\\Services\\PurchaseOrderService',
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
      '1ef0e002993a76a5ba14a3de61588e11' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'approvaldecision' => 'App\\Enums\\ApprovalDecision',
          'purchaseorderstatus' => 'App\\Enums\\PurchaseOrderStatus',
          'creditlimitexceededexception' => 'App\\Exceptions\\CreditLimitExceededException',
          'invalidstatetransitionexception' => 'App\\Exceptions\\InvalidStateTransitionException',
          'outofstockexception' => 'App\\Exceptions\\OutOfStockException',
          'businessaccount' => 'App\\Models\\BusinessAccount',
          'poapproval' => 'App\\Models\\PoApproval',
          'poitem' => 'App\\Models\\PoItem',
          'purchaseorder' => 'App\\Models\\PurchaseOrder',
          'quote' => 'App\\Models\\Quote',
          'user' => 'App\\Models\\User',
          'businessaccountrepositoryinterface' => 'App\\Repositories\\Contracts\\BusinessAccountRepositoryInterface',
          'purchaseorderrepositoryinterface' => 'App\\Repositories\\Contracts\\PurchaseOrderRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'db' => 'Illuminate\\Support\\Facades\\DB',
        ),
         'className' => 'App\\Services\\PurchaseOrderService',
         'functionName' => 'createFromQuote',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'App\\Services',
           'uses' => 
          array (
            'approvaldecision' => 'App\\Enums\\ApprovalDecision',
            'purchaseorderstatus' => 'App\\Enums\\PurchaseOrderStatus',
            'creditlimitexceededexception' => 'App\\Exceptions\\CreditLimitExceededException',
            'invalidstatetransitionexception' => 'App\\Exceptions\\InvalidStateTransitionException',
            'outofstockexception' => 'App\\Exceptions\\OutOfStockException',
            'businessaccount' => 'App\\Models\\BusinessAccount',
            'poapproval' => 'App\\Models\\PoApproval',
            'poitem' => 'App\\Models\\PoItem',
            'purchaseorder' => 'App\\Models\\PurchaseOrder',
            'quote' => 'App\\Models\\Quote',
            'user' => 'App\\Models\\User',
            'businessaccountrepositoryinterface' => 'App\\Repositories\\Contracts\\BusinessAccountRepositoryInterface',
            'purchaseorderrepositoryinterface' => 'App\\Repositories\\Contracts\\PurchaseOrderRepositoryInterface',
            'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
            'db' => 'Illuminate\\Support\\Facades\\DB',
          ),
           'className' => 'App\\Services\\PurchaseOrderService',
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
      'bc880316b07f937830fd8ba6004397d8' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'approvaldecision' => 'App\\Enums\\ApprovalDecision',
          'purchaseorderstatus' => 'App\\Enums\\PurchaseOrderStatus',
          'creditlimitexceededexception' => 'App\\Exceptions\\CreditLimitExceededException',
          'invalidstatetransitionexception' => 'App\\Exceptions\\InvalidStateTransitionException',
          'outofstockexception' => 'App\\Exceptions\\OutOfStockException',
          'businessaccount' => 'App\\Models\\BusinessAccount',
          'poapproval' => 'App\\Models\\PoApproval',
          'poitem' => 'App\\Models\\PoItem',
          'purchaseorder' => 'App\\Models\\PurchaseOrder',
          'quote' => 'App\\Models\\Quote',
          'user' => 'App\\Models\\User',
          'businessaccountrepositoryinterface' => 'App\\Repositories\\Contracts\\BusinessAccountRepositoryInterface',
          'purchaseorderrepositoryinterface' => 'App\\Repositories\\Contracts\\PurchaseOrderRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'db' => 'Illuminate\\Support\\Facades\\DB',
        ),
         'className' => 'App\\Services\\PurchaseOrderService',
         'functionName' => 'approve',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'App\\Services',
           'uses' => 
          array (
            'approvaldecision' => 'App\\Enums\\ApprovalDecision',
            'purchaseorderstatus' => 'App\\Enums\\PurchaseOrderStatus',
            'creditlimitexceededexception' => 'App\\Exceptions\\CreditLimitExceededException',
            'invalidstatetransitionexception' => 'App\\Exceptions\\InvalidStateTransitionException',
            'outofstockexception' => 'App\\Exceptions\\OutOfStockException',
            'businessaccount' => 'App\\Models\\BusinessAccount',
            'poapproval' => 'App\\Models\\PoApproval',
            'poitem' => 'App\\Models\\PoItem',
            'purchaseorder' => 'App\\Models\\PurchaseOrder',
            'quote' => 'App\\Models\\Quote',
            'user' => 'App\\Models\\User',
            'businessaccountrepositoryinterface' => 'App\\Repositories\\Contracts\\BusinessAccountRepositoryInterface',
            'purchaseorderrepositoryinterface' => 'App\\Repositories\\Contracts\\PurchaseOrderRepositoryInterface',
            'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
            'db' => 'Illuminate\\Support\\Facades\\DB',
          ),
           'className' => 'App\\Services\\PurchaseOrderService',
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
      'c17bda47fbb8557f184a804fc653c8e1' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'approvaldecision' => 'App\\Enums\\ApprovalDecision',
          'purchaseorderstatus' => 'App\\Enums\\PurchaseOrderStatus',
          'creditlimitexceededexception' => 'App\\Exceptions\\CreditLimitExceededException',
          'invalidstatetransitionexception' => 'App\\Exceptions\\InvalidStateTransitionException',
          'outofstockexception' => 'App\\Exceptions\\OutOfStockException',
          'businessaccount' => 'App\\Models\\BusinessAccount',
          'poapproval' => 'App\\Models\\PoApproval',
          'poitem' => 'App\\Models\\PoItem',
          'purchaseorder' => 'App\\Models\\PurchaseOrder',
          'quote' => 'App\\Models\\Quote',
          'user' => 'App\\Models\\User',
          'businessaccountrepositoryinterface' => 'App\\Repositories\\Contracts\\BusinessAccountRepositoryInterface',
          'purchaseorderrepositoryinterface' => 'App\\Repositories\\Contracts\\PurchaseOrderRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'db' => 'Illuminate\\Support\\Facades\\DB',
        ),
         'className' => 'App\\Services\\PurchaseOrderService',
         'functionName' => 'reject',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'App\\Services',
           'uses' => 
          array (
            'approvaldecision' => 'App\\Enums\\ApprovalDecision',
            'purchaseorderstatus' => 'App\\Enums\\PurchaseOrderStatus',
            'creditlimitexceededexception' => 'App\\Exceptions\\CreditLimitExceededException',
            'invalidstatetransitionexception' => 'App\\Exceptions\\InvalidStateTransitionException',
            'outofstockexception' => 'App\\Exceptions\\OutOfStockException',
            'businessaccount' => 'App\\Models\\BusinessAccount',
            'poapproval' => 'App\\Models\\PoApproval',
            'poitem' => 'App\\Models\\PoItem',
            'purchaseorder' => 'App\\Models\\PurchaseOrder',
            'quote' => 'App\\Models\\Quote',
            'user' => 'App\\Models\\User',
            'businessaccountrepositoryinterface' => 'App\\Repositories\\Contracts\\BusinessAccountRepositoryInterface',
            'purchaseorderrepositoryinterface' => 'App\\Repositories\\Contracts\\PurchaseOrderRepositoryInterface',
            'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
            'db' => 'Illuminate\\Support\\Facades\\DB',
          ),
           'className' => 'App\\Services\\PurchaseOrderService',
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
      '66fca6a5ffe51634be09c3cb879a5dfb' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'approvaldecision' => 'App\\Enums\\ApprovalDecision',
          'purchaseorderstatus' => 'App\\Enums\\PurchaseOrderStatus',
          'creditlimitexceededexception' => 'App\\Exceptions\\CreditLimitExceededException',
          'invalidstatetransitionexception' => 'App\\Exceptions\\InvalidStateTransitionException',
          'outofstockexception' => 'App\\Exceptions\\OutOfStockException',
          'businessaccount' => 'App\\Models\\BusinessAccount',
          'poapproval' => 'App\\Models\\PoApproval',
          'poitem' => 'App\\Models\\PoItem',
          'purchaseorder' => 'App\\Models\\PurchaseOrder',
          'quote' => 'App\\Models\\Quote',
          'user' => 'App\\Models\\User',
          'businessaccountrepositoryinterface' => 'App\\Repositories\\Contracts\\BusinessAccountRepositoryInterface',
          'purchaseorderrepositoryinterface' => 'App\\Repositories\\Contracts\\PurchaseOrderRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'db' => 'Illuminate\\Support\\Facades\\DB',
        ),
         'className' => 'App\\Services\\PurchaseOrderService',
         'functionName' => 'settle',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'App\\Services',
           'uses' => 
          array (
            'approvaldecision' => 'App\\Enums\\ApprovalDecision',
            'purchaseorderstatus' => 'App\\Enums\\PurchaseOrderStatus',
            'creditlimitexceededexception' => 'App\\Exceptions\\CreditLimitExceededException',
            'invalidstatetransitionexception' => 'App\\Exceptions\\InvalidStateTransitionException',
            'outofstockexception' => 'App\\Exceptions\\OutOfStockException',
            'businessaccount' => 'App\\Models\\BusinessAccount',
            'poapproval' => 'App\\Models\\PoApproval',
            'poitem' => 'App\\Models\\PoItem',
            'purchaseorder' => 'App\\Models\\PurchaseOrder',
            'quote' => 'App\\Models\\Quote',
            'user' => 'App\\Models\\User',
            'businessaccountrepositoryinterface' => 'App\\Repositories\\Contracts\\BusinessAccountRepositoryInterface',
            'purchaseorderrepositoryinterface' => 'App\\Repositories\\Contracts\\PurchaseOrderRepositoryInterface',
            'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
            'db' => 'Illuminate\\Support\\Facades\\DB',
          ),
           'className' => 'App\\Services\\PurchaseOrderService',
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
      '19169d8a8aacacec5656cd5063bd750e' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'approvaldecision' => 'App\\Enums\\ApprovalDecision',
          'purchaseorderstatus' => 'App\\Enums\\PurchaseOrderStatus',
          'creditlimitexceededexception' => 'App\\Exceptions\\CreditLimitExceededException',
          'invalidstatetransitionexception' => 'App\\Exceptions\\InvalidStateTransitionException',
          'outofstockexception' => 'App\\Exceptions\\OutOfStockException',
          'businessaccount' => 'App\\Models\\BusinessAccount',
          'poapproval' => 'App\\Models\\PoApproval',
          'poitem' => 'App\\Models\\PoItem',
          'purchaseorder' => 'App\\Models\\PurchaseOrder',
          'quote' => 'App\\Models\\Quote',
          'user' => 'App\\Models\\User',
          'businessaccountrepositoryinterface' => 'App\\Repositories\\Contracts\\BusinessAccountRepositoryInterface',
          'purchaseorderrepositoryinterface' => 'App\\Repositories\\Contracts\\PurchaseOrderRepositoryInterface',
          'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
          'db' => 'Illuminate\\Support\\Facades\\DB',
        ),
         'className' => 'App\\Services\\PurchaseOrderService',
         'functionName' => 'close',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'App\\Services',
           'uses' => 
          array (
            'approvaldecision' => 'App\\Enums\\ApprovalDecision',
            'purchaseorderstatus' => 'App\\Enums\\PurchaseOrderStatus',
            'creditlimitexceededexception' => 'App\\Exceptions\\CreditLimitExceededException',
            'invalidstatetransitionexception' => 'App\\Exceptions\\InvalidStateTransitionException',
            'outofstockexception' => 'App\\Exceptions\\OutOfStockException',
            'businessaccount' => 'App\\Models\\BusinessAccount',
            'poapproval' => 'App\\Models\\PoApproval',
            'poitem' => 'App\\Models\\PoItem',
            'purchaseorder' => 'App\\Models\\PurchaseOrder',
            'quote' => 'App\\Models\\Quote',
            'user' => 'App\\Models\\User',
            'businessaccountrepositoryinterface' => 'App\\Repositories\\Contracts\\BusinessAccountRepositoryInterface',
            'purchaseorderrepositoryinterface' => 'App\\Repositories\\Contracts\\PurchaseOrderRepositoryInterface',
            'lengthawarepaginator' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
            'db' => 'Illuminate\\Support\\Facades\\DB',
          ),
           'className' => 'App\\Services\\PurchaseOrderService',
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
      '/var/www/html/app/Services/PurchaseOrderService.php' => 'd4489f94faf3c2c2438b4efd53cdf02b314c7acfdc7fa2095b4268db98c2f5ee',
    ),
  ),
));