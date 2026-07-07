#!/bin/sh
set -e

cd /var/www/html

# app, queue, and scheduler all boot from this same image/entrypoint and
# share both the bind-mounted project directory (.env) and the named
# `vendor` volume. Without a mutex, three concurrent `composer install`
# runs race on the same files and corrupt vendor/. `storage/app` is already
# gitignored, so use it as the lock location.
LOCK_DIR="storage/app/.docker-setup.lock"

attempt=0
while ! mkdir "$LOCK_DIR" 2>/dev/null; do
    attempt=$((attempt + 1))
    if [ -f vendor/autoload.php ] && [ -f .env ]; then
        break
    fi
    if [ "$attempt" -gt 150 ]; then
        echo "entrypoint: timed out waiting for setup lock at $LOCK_DIR" >&2
        break
    fi
    sleep 2
done

if [ ! -f .env ]; then
    cp .env.example .env
fi

if [ ! -f vendor/autoload.php ]; then
    composer install --no-interaction --prefer-dist
fi

if ! grep -q "^APP_KEY=base64" .env 2>/dev/null; then
    php artisan key:generate --ansi --force
fi

rmdir "$LOCK_DIR" 2>/dev/null || true

exec "$@"
