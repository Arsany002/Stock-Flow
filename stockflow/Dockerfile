# StockFlow — local development PHP image.
# Used by the `app`, `queue`, and `scheduler` services in docker-compose.yml.
# This is a dev image (not hardened/optimized for production).
#
# PHP 8.4 matches the installed laravel/framework v13 lock file (symfony/*
# v8.1 requires PHP >=8.4.1). Laravel 12 itself supports PHP 8.2-8.4, so this
# stays compatible if the app is ever pinned back to ^12.0.

FROM php:8.4-cli-bookworm

WORKDIR /var/www/html

# System packages needed to build common PHP extensions + Composer + zip handling.
RUN apt-get update && apt-get install -y --no-install-recommends \
        git \
        unzip \
        libzip-dev \
        libpng-dev \
        libjpeg62-turbo-dev \
        libfreetype6-dev \
        libonig-dev \
        default-mysql-client \
    && rm -rf /var/lib/apt/lists/*

# Core extensions Laravel needs: pdo_mysql (MySQL 8), mbstring, bcmath, zip, pcntl
# (queue worker signal handling), gd (PhpSpreadsheet/Laravel Excel).
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
        pdo_mysql \
        mbstring \
        bcmath \
        zip \
        pcntl \
        gd

COPY docker/php.ini /usr/local/etc/php/conf.d/99-stockflow.ini

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 8000

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
