# StockFlow

B2B/B2C e-commerce & inventory platform. Laravel 13.18.1 + Inertia.js + React,
one app — no separate frontend, no Next.js, no React Router.

The active project lives in [`stockflow/`](stockflow/). Use
[`stockflow/README.md`](stockflow/README.md) for setup, build, test, and manual QA
instructions.

Current major modules include session auth, Laratrust authorization, catalog CRUD,
the stock ledger/projection engine, B2C checkout, B2B quote/PO procurement, payment
drivers, Excel import, Passport-secured `/api/v1`, and `/webhooks/v1` payment
callback routes. Real Paymob/Fawry provider credentials/contracts are still future
work.
