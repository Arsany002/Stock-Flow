<?php

namespace App\Support\Access;

/**
 * Fixed vocabulary of ABAC-checkable actions — mirrors AuditLogController's
 * EVENTS pattern (a closed, named set rather than free-form strings
 * scattered across controllers/middleware). Used as the `{action}` segment
 * of `abac:{action},{permission}` / `adaptive.throttle:{profile},{action}`
 * route middleware, and stored verbatim in `permission_access_windows.action`.
 */
final class AccessAction
{
    public const AUTH_LOGIN = 'auth.login';

    public const AUTH_REGISTER = 'auth.register';

    public const STOREFRONT_BROWSE = 'storefront.browse';

    public const CART_MUTATE = 'cart.mutate';

    public const CHECKOUT_CONFIRM = 'checkout.confirm';

    public const PAYMENT_SETTLE = 'payment.settle';

    public const STOCK_MOVE = 'stock.move';

    public const STOCK_TRANSFER = 'stock.transfer';

    public const IMPORT_RUN = 'import.run';

    public const PO_APPROVE = 'po.approve';

    public const QUOTE_PRICE = 'quote.price';

    public const ADMIN_MANAGE = 'admin.manage';

    public const API_V1_READ = 'api.v1.read';

    public const API_V1_WRITE = 'api.v1.write';

    public const WEBHOOK_PAYMENT = 'webhook.payment';

    private function __construct() {}
}
