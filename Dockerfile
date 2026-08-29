# syntax=docker/dockerfile:1.7

ARG PHP_VERSION=8.4

# ============================================================
# Stage 1: Install PHP dependencies with Composer
# ============================================================
FROM php:${PHP_VERSION}-cli-alpine AS vendor

WORKDIR /app

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN apk add --no-cache \
    icu-libs \
    libzip

COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --no-scripts \
    --no-autoloader \
    --prefer-dist \
    --no-interaction \
    --no-progress

COPY . .

RUN composer dump-autoload \
    --no-dev \
    --optimize \
    --classmap-authoritative


# ============================================================
# Stage 2: Production runtime
# ============================================================
FROM php:${PHP_VERSION}-fpm-alpine AS runtime

# ------------------------------------------------------------
# System packages
# ------------------------------------------------------------
RUN apk add --no-cache \
    nginx \
    supervisor \
    tzdata \
    icu-libs \
    libzip \
    libpng \
    libjpeg-turbo \
    freetype \
    && apk add --no-cache --virtual .build-deps \
    $PHPIZE_DEPS \
    icu-dev \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    && docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
    bcmath \
    exif \
    gd \
    intl \
    opcache \
    pcntl \
    pdo_mysql \
    zip \
    && apk del .build-deps \
    && rm -rf /var/cache/apk/* /tmp/*

WORKDIR /var/www/html


# ============================================================
# PHP configuration
# ============================================================
COPY <<'EOF' /usr/local/etc/php/conf.d/zz-app.ini

memory_limit=256M
upload_max_filesize=10M
post_max_size=10M
max_execution_time=60
expose_php=Off
date.timezone=UTC

opcache.enable=1
opcache.enable_cli=0
opcache.memory_consumption=128
opcache.interned_strings_buffer=16
opcache.max_accelerated_files=20000
opcache.validate_timestamps=0

EOF


# ============================================================
# PHP-FPM configuration
# ============================================================
COPY <<'EOF' /usr/local/etc/php-fpm.d/zz-app.conf

[www]

user=www-data
group=www-data

listen=127.0.0.1:9000

pm=dynamic
pm.max_children=20
pm.start_servers=4
pm.min_spare_servers=2
pm.max_spare_servers=6
pm.max_requests=500

clear_env=no

catch_workers_output=yes
decorate_workers_output=no

access.log=/dev/null

php_admin_value[error_log]=/proc/self/fd/2
php_admin_flag[log_errors]=on

EOF


# ============================================================
# Nginx configuration
# ============================================================
COPY <<'EOF' /etc/nginx/nginx.conf

user nginx;

worker_processes auto;

error_log /dev/stderr notice;

pid /var/run/nginx.pid;

events {
    worker_connections 1024;
}

http {

    include /etc/nginx/mime.types;

    default_type application/octet-stream;

    access_log /dev/stdout;

    sendfile on;

    tcp_nopush on;

    keepalive_timeout 65;

    server_tokens off;

    client_max_body_size 10M;

    gzip on;

    gzip_vary on;

    gzip_min_length 1024;

    gzip_types
        text/plain
        text/css
        text/javascript
        application/javascript
        application/json
        image/svg+xml;

    server {

        listen 80 default_server;

        server_name _;

        root /var/www/html/public;

        index index.php;

        charset utf-8;

        location = /favicon.ico {
            access_log off;
            log_not_found off;
        }

        location = /robots.txt {
            access_log off;
            log_not_found off;
        }

        location = /healthz {
            access_log off;
            default_type text/plain;
            return 200 "ok\n";
        }

        location ~* \.(css|js|woff2?|ttf|eot|otf|jpg|jpeg|png|gif|ico|svg|webp)$ {

            expires 30d;

            add_header Cache-Control "public";

            try_files $uri =404;
        }

        location / {

            try_files $uri $uri/ /index.php?$query_string;
        }

        location ~ \.php$ {

            try_files $uri =404;

            fastcgi_pass 127.0.0.1:9000;

            fastcgi_index index.php;

            include fastcgi_params;

            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;

            fastcgi_param DOCUMENT_ROOT $document_root;

            fastcgi_hide_header X-Powered-By;

            fastcgi_read_timeout 60s;
        }

        location ~ /\.(?!well-known).* {

            deny all;
        }
    }
}

EOF


# ============================================================
# Supervisor
# ============================================================
COPY <<'EOF' /etc/supervisord.conf

[supervisord]

nodaemon=true

logfile=/dev/null

logfile_maxbytes=0

pidfile=/var/run/supervisord.pid


[program:php-fpm]

command=php-fpm --nodaemonize --force-stderr

autorestart=true

startretries=3

stdout_logfile=/dev/stdout

stdout_logfile_maxbytes=0

stderr_logfile=/dev/stderr

stderr_logfile_maxbytes=0


[program:nginx]

command=nginx -g "daemon off;"

autorestart=true

startretries=3

stdout_logfile=/dev/stdout

stdout_logfile_maxbytes=0

stderr_logfile=/dev/stderr

stderr_logfile_maxbytes=0

EOF


# ============================================================
# Application startup script
# ============================================================
COPY <<'EOF' /usr/local/bin/entrypoint.sh

#!/bin/sh

set -e

cd /var/www/html


echo "Preparing Laravel application..."


# ------------------------------------------------------------
# Create required directories
# ------------------------------------------------------------

mkdir -p \
    storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache \
    public/images


# ------------------------------------------------------------
# Permissions
# ------------------------------------------------------------

chown -R www-data:www-data \
    storage \
    bootstrap/cache \
    public/images

chmod -R ug+rw \
    storage \
    bootstrap/cache


# ------------------------------------------------------------
# Storage symlink
# ------------------------------------------------------------

if [ ! -L public/storage ]; then

    php artisan storage:link --quiet || true

fi


# ------------------------------------------------------------
# Optional database migrations
# ------------------------------------------------------------

if [ "${RUN_MIGRATIONS:-false}" = "true" ]; then

    echo "Running database migrations..."

    php artisan migrate --force

fi


# ------------------------------------------------------------
# Laravel caches
# ------------------------------------------------------------

echo "Caching Laravel configuration..."

php artisan config:cache

php artisan route:cache

php artisan view:cache


echo "Starting application..."


# ------------------------------------------------------------
# Start supervisor
# ------------------------------------------------------------

exec "$@"

EOF

RUN chmod +x /usr/local/bin/entrypoint.sh


# ============================================================
# Copy application
# ============================================================
COPY --from=vendor --chown=www-data:www-data /app /var/www/html


# Remove environment file from image
RUN rm -f .env


# Final permissions
RUN chown -R www-data:www-data \
    storage \
    bootstrap/cache \
    && chmod -R ug+rw \
    storage \
    bootstrap/cache


# ============================================================
# Container configuration
# ============================================================

EXPOSE 80


# Health check
HEALTHCHECK \
    --interval=30s \
    --timeout=5s \
    --start-period=30s \
    --retries=3 \
    CMD wget -q -O - http://127.0.0.1/healthz || exit 1


ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

CMD ["supervisord", "-c", "/etc/supervisord.conf"]