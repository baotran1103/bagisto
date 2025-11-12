# ==========================================
# Base Stage: Common dependencies for all environments
# ==========================================
FROM php:8.3-fpm-alpine AS base

# Install runtime and build dependencies
RUN apk add --no-cache \
    # Runtime libraries
    nginx \
    libpng \
    libjpeg-turbo \
    freetype \
    libzip \
    icu-libs \
    # Build dependencies (needed for extensions)
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    icu-dev \
    git \
    unzip

# Install PHP extensions (same across all environments)
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        calendar \
        intl \
        gd \
        zip \
        exif \
        pcntl \
        bcmath

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Node.js and npm
RUN apk add --no-cache nodejs npm

WORKDIR /var/www/html

# ==========================================
# Dependencies Stage: Install dependencies (cached separately)
# ==========================================
FROM base AS dependencies

# Copy dependency files first (for layer caching)
COPY workspace/bagisto/composer.json workspace/bagisto/composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --optimize-autoloader --no-interaction

COPY workspace/bagisto/package.json workspace/bagisto/package-lock.json ./
RUN npm ci --prefer-offline

# ==========================================
# Development Stage: For local development with hot reload
# ==========================================
FROM base AS development

# Install development tools
RUN apk add --no-cache $PHPIZE_DEPS && \
    pecl install xdebug && \
    docker-php-ext-enable xdebug

# Configure Xdebug
RUN echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini && \
    echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini && \
    echo "xdebug.client_port=9003" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini && \
    echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Copy nginx config for development
COPY .configs/nginx/nginx.conf /etc/nginx/conf.d/default.conf

# Development runs with mounted volumes, no need to copy code
WORKDIR /var/www/html

EXPOSE 9000 80

CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]

# ==========================================
# Builder Stage: Build assets
# ==========================================
FROM dependencies AS builder

# Copy all source code
COPY workspace/bagisto/ .

# Install dependencies with scripts
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Build frontend assets
RUN npm run build && rm -rf node_modules

# Remove wrong symlink created by Bagisto installer
RUN rm -f public/storage

# ==========================================
# Production Stage: Optimized for production
# ==========================================
FROM base AS production

# Copy PHP extensions and configs from base
COPY --from=base /usr/local/lib/php/extensions/ /usr/local/lib/php/extensions/
COPY --from=base /usr/local/etc/php/conf.d/ /usr/local/etc/php/conf.d/

# Copy built application from builder
COPY --from=builder /var/www/html /var/www/html

# Create correct storage symlink with relative path
RUN ln -s ../storage/app/public public/storage && \
    chown -R www-data:www-data /var/www/html && \
    chmod -R 775 storage bootstrap/cache

# Copy nginx configuration
RUN mkdir -p /var/cache/nginx/client_temp /var/log/nginx /var/run && \
    rm -f /etc/nginx/conf.d/default.conf

COPY deploy/nginx.production.conf /etc/nginx/nginx.conf

EXPOSE 80

CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]
