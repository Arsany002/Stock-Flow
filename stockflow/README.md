# StockFlow

B2B/B2C e-commerce & inventory platform. Laravel 12 + Inertia.js + React, one app —
no separate frontend, no Next.js, no React Router. See
[`docs/project/canonical-decisions.md`](../docs/project/canonical-decisions.md) for
the full set of architecture decisions.

This base scaffold currently contains only: session auth (login/logout), the Inertia
+ React setup, shared layouts/components, and a placeholder dashboard. No business
modules (catalog, stock, orders, procurement, payments) are built yet.

## Requirements

- PHP 8.2+
- Composer
- Node 20+ / npm
- SQLite (default) or MySQL 8 for local dev — the app ships configured for SQLite out
  of the box; switch `DB_CONNECTION` in `.env` to `mysql` to match the production
  target described in the PRD.

## Local setup

```bash
# from the stockflow/ directory
composer install
npm install

cp .env.example .env
php artisan key:generate

# SQLite is the default; create the file if it doesn't exist yet
touch database/database.sqlite

php artisan migrate

# run the Laravel dev server and Vite dev server together
composer run dev
```

`composer run dev` runs the Laravel server, queue listener, log watcher (Pail), and
Vite dev server concurrently. To run them separately instead:

```bash
php artisan serve
npm run dev
```

Visit `http://127.0.0.1:8000`. Guests are redirected to `/login`; authenticated users
land on `/dashboard`.

Create a user to log in with via `php artisan tinker`:

```php
\App\Models\User::factory()->create(['email' => 'admin@stockflow.test']);
```

The factory's default password is `password`.

## Tests

```bash
php artisan test
```

Feature tests cover: guest redirect on `/` and `/dashboard`, login page render,
successful/failed authentication, logout, and an authenticated Inertia response on
`/dashboard`.

## Building for production

```bash
npm run build
```

## Project structure notes

- `routes/web.php` — Inertia page routes only (session/`web` guard). No API routes.
- `app/Http/Controllers/Web/` — Inertia controllers (`Auth/`, `DashboardController`).
  Future API controllers will live under `app/Http/Controllers/Api/V1/` and payment
  webhooks under a `Webhooks/` group — neither exists yet (see canonical decisions).
- `resources/js/Pages/` — Inertia pages, resolved by `resources/js/app.jsx`.
- `resources/js/Layouts/` — `AppLayout` (authenticated shell) and `GuestLayout`
  (centered card, used by the login page).
- `resources/js/Components/` — shared UI primitives: `Button`, `Input`, `Select`,
  `Table`, `Pagination`, `FlashMessage`, `PermissionGate`.
- `app/Http/Middleware/HandleInertiaRequests.php` — shares `auth.user`,
  `auth.roles`, `auth.permissions`, `activeWarehouse`, and `flash.success` /
  `flash.error` on every Inertia response. `roles`/`permissions`/`activeWarehouse`
  are placeholders (empty/`null`) until Laratrust and warehouses are introduced.

## Not yet installed / built (by design)

- Laravel Passport (reserved for the external B2B API under `/api/v1` later).
- Laratrust roles/permissions.
- Any business module: catalog, stock ledger, B2C checkout, B2B quote/PO, Excel
  import, payments.
