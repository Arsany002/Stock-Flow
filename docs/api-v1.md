# StockFlow API v1

External B2B/system API only. Human browser UI stays on Inertia + session auth and
must not use Passport tokens.

Base URL: `/api/v1`

## Passport Setup

```bash
composer require laravel/passport
php artisan vendor:publish --tag=passport-config
php artisan vendor:publish --tag=passport-migrations
php artisan migrate
php artisan passport:keys
php artisan passport:client --password --provider=users --name="StockFlow B2B Password Grant"
php artisan passport:client --client --name="StockFlow Integration"
```

Access tokens expire after 15 minutes. Refresh tokens expire after 30 days and are
revoked on use. Supported scopes:

- `catalog:read`
- `orders:write`
- `stock:read`
- `payments:write`

## Tokens

Password grant:

```http
POST /oauth/token
Content-Type: application/json
Accept: application/json

{
  "grant_type": "password",
  "client_id": "password-client-id",
  "client_secret": "password-client-secret",
  "username": "buyer@stockflow.test",
  "password": "password",
  "scope": "catalog:read orders:write stock:read payments:write"
}
```

Client credentials grant:

```http
POST /oauth/token
Content-Type: application/json
Accept: application/json

{
  "grant_type": "client_credentials",
  "client_id": "integration-client-id",
  "client_secret": "integration-client-secret",
  "scope": "catalog:read stock:read"
}
```

Use the returned token as `Authorization: Bearer <access_token>`.

Password-grant tokens authenticate a real `users` row and are required for B2B
quote, purchase-order, and payment workflows because those routes enforce
business-account ownership with Laratrust permissions and policies. Client-credentials
tokens authenticate a service integration and are intentionally accepted only for
read-oriented catalog and stock endpoints; their service principal maps
`catalog.read` and `stock.read` to the corresponding Passport scopes.

## Response Envelope

All API responses are JSON:

```json
{
  "data": {},
  "meta": {}
}
```

Paginated responses include pagination fields in `meta`.

## Endpoints

### GET `/catalog/products`

Scope: `catalog:read`

Permission: `catalog.read`

Auth: password grant user token or client-credentials service token.

Query: `search`, `category_id`, `per_page`

```json
{
  "data": [
    {
      "id": "uuid",
      "sku": "SKU-PHONE-001",
      "name": "Smartphone",
      "description": "Retail catalog item",
      "is_active": true,
      "category": { "id": "uuid", "name": "Electronics", "slug": "electronics" }
    }
  ],
  "meta": { "current_page": 1, "per_page": 15, "total": 1 }
}
```

### GET `/stock/availability`

Scope: `stock:read`

Permission: `stock.read`

Auth: password grant user token or client-credentials service token.

Query: `product_id`, `warehouse_id`, `per_page`

```json
{
  "data": [
    {
      "product": { "id": "uuid", "sku": "SKU-PHONE-001", "name": "Smartphone" },
      "warehouse": { "id": "uuid", "code": "CAI-1", "name": "Cairo Warehouse" },
      "on_hand": 25,
      "reserved": 3,
      "available": 22,
      "updated_at": "2026-07-08T12:00:00.000000Z"
    }
  ],
  "meta": { "current_page": 1, "per_page": 15, "total": 1 }
}
```

### POST `/b2b/quotes`

Scope: `orders:write`

Permission: `quote.request`

Auth: password grant user token only.

```json
{
  "lines": [
    { "product_id": "uuid", "quantity": 10 }
  ]
}
```

Response: `201 Created`

```json
{
  "data": {
    "id": "uuid",
    "status": "draft",
    "items": [
      {
        "product": { "id": "uuid", "sku": "SKU-PHONE-001", "name": "Smartphone" },
        "quantity": 10,
        "unit_price": "0.00"
      }
    ]
  },
  "meta": {}
}
```

### GET `/b2b/quotes`

Scope: `orders:write`

Permissions: `quote.request`, `quote.price`, or `po.approve`

Business Buyers see only quotes for their own `business_accounts` row. Vendor and
staff visibility follows `QuotePolicy`.

### GET `/b2b/purchase-orders`

Scope: `orders:write`

Permissions: `quote.request`, `po.approve`, or `payment.settle`

Business Buyers see only their own account's POs. Staff with approval/settlement
permissions can see all.

### POST `/b2b/purchase-orders/{purchaseOrder}/accept`

Scope: `orders:write`

Permissions: `quote.request`, `po.approve`, or `payment.settle`

This endpoint acknowledges an existing purchase order for API compatibility. The
canonical state change is quote acceptance, which creates the PO; this route does not
invent an extra PO status.

### GET `/b2b/payments`

Scope: `payments:write`

Permissions: `quote.request` or `payment.settle`

Auth: password grant user token only.

Business Buyers see their own PO payments. Staff with `payment.settle` can see all.

### POST `/b2b/payments/bank-transfer-proof`

Scope: `payments:write`

Permissions: `quote.request` or `payment.settle`

```json
{
  "purchase_order_id": "uuid",
  "reference": "BANK-REF-1001",
  "proof_url": "https://example.com/proofs/bank-ref-1001.pdf",
  "proof_note": "Transfer from company account"
}
```

Response: `201 Created`

```json
{
  "data": {
    "id": "uuid",
    "method": "bank_transfer",
    "status": "pending",
    "amount": "1140.00",
    "gateway_ref": "bank_transfer:BANK-REF-1001"
  },
  "meta": {
    "note": "Bank transfer proof recorded. Finance must settle the payment before stock is converted to sale_out."
  }
}
```

## Errors

- `401 Unauthorized`: missing/invalid bearer token.
- `403 Forbidden`: token lacks scope, Laratrust permission, or policy access.
- `406 Not Acceptable`: missing JSON `Accept` header.
- `415 Unsupported Media Type`: non-JSON request body.
- `422 Unprocessable Entity`: validation/domain rule failure.
- `429 Too Many Requests`: API rate limit exceeded.
