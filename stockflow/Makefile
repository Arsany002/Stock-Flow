.DEFAULT_GOAL := help
COMPOSE := docker compose

.PHONY: help start stop restart build logs shell migrate fresh test pint pint-fix stan quality npm-dev npm-build vite-fresh

help: ## Show this help
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "  \033[36m%-12s\033[0m %s\n", $$1, $$2}'

start: ## Build (if needed) and start the full stack in the background
	@test -f .env || cp .env.example .env
	$(COMPOSE) up -d --build

stop: ## Stop all containers (keeps volumes: db/redis data, vendor, node_modules)
	$(COMPOSE) down

restart: ## Restart all containers
	$(COMPOSE) restart

build: ## Rebuild the app image (after Dockerfile/composer.json changes)
	$(COMPOSE) build

logs: ## Tail logs from all services
	$(COMPOSE) logs -f

shell: ## Open a shell inside the app container
	$(COMPOSE) exec app sh

migrate: ## Run database migrations inside the app container
	$(COMPOSE) exec app php artisan migrate

fresh: ## Drop all tables, re-run migrations, and clear the cache (migrate:fresh doesn't touch Redis — see docs/technical/cache.md)
	$(COMPOSE) exec app php artisan migrate:fresh
	$(COMPOSE) exec app php artisan cache:clear

test: ## Run the PHPUnit/Pest test suite inside the app container
	$(COMPOSE) exec app php artisan test

pint: ## Check code style (Laravel Pint) without fixing
	$(COMPOSE) exec app ./vendor/bin/pint --test

pint-fix: ## Fix code style (Laravel Pint)
	$(COMPOSE) exec app ./vendor/bin/pint

stan: ## Run static analysis (PHPStan/Larastan)
	$(COMPOSE) exec app ./vendor/bin/phpstan analyse --memory-limit=1G

quality: pint stan test ## Run the full local quality gate: style, static analysis, tests

npm-dev: ## Follow the Vite dev server logs (already running as the `vite` service)
	$(COMPOSE) logs -f vite

npm-build: ## Build production frontend assets inside the vite container
	$(COMPOSE) run --rm vite npm run build

vite-fresh: ## Fix a blank/white-screen page caused by a stale Vite dep-optimization cache (import.meta.glob resolving empty)
	$(COMPOSE) exec vite sh -c "rm -rf node_modules/.vite"
	$(COMPOSE) restart vite
