# 1. Runtime Stage
FROM php:8.3-fpm-alpine AS runtime_base
RUN apk add --no-cache \
    nginx \
    libpng \
    libjpeg-turbo \
    freetype \
    libzip \
    icu-libs

# 2. Build Stage: Chứa mọi thứ để BUILD
FROM runtime_base AS build_base
# Cài các gói -dev, build tools
RUN apk add --no-cache \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    icu-dev \
    git \
    unzip \
    nodejs \
    npm

# Install PHP extensions
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

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# 3. Dependencies Stage
FROM build_base AS dependencies

WORKDIR /var/www/html
COPY workspace/bagisto/composer.json workspace/bagisto/composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --optimize-autoloader --no-interaction
COPY workspace/bagisto/package.json workspace/bagisto/package-lock.json ./
RUN npm ci --prefer-offline

# 4. Build Stage (for CI testing)
FROM build_base AS build

COPY --from=dependencies /var/www/html/vendor /var/www/html/vendor
COPY --from=dependencies /var/www/html/node_modules /var/www/html/node_modules

# Copy code
COPY workspace/bagisto/ .

# Install ALL dependencies including dev (for testing)
RUN composer install --optimize-autoloader --no-interaction
RUN npm run build && rm -rf node_modules
RUN rm -f public/storage

# 5. Production Stage
FROM runtime_base AS production
WORKDIR /var/www/html

#  Chỉ copy các extension đã được biên dịch từ 'build_base'
COPY --from=build_base /usr/local/lib/php/extensions/ /usr/local/lib/php/extensions/
COPY --from=build_base /usr/local/etc/php/conf.d/ /usr/local/etc/php/conf.d/

# Copy code đã build từ 'build'
COPY --from=build /var/www/html /var/www/html

RUN ln -s ../storage/app/public public/storage && \
    chown -R www-data:www-data /var/www/html && \
    chmod -R 775 storage bootstrap/cache

RUN mkdir -p /var/cache/nginx/client_temp /var/log/nginx /var/run && \
    rm -f /etc/nginx/conf.d/default.conf

COPY deploy/nginx.production.conf /etc/nginx/nginx.conf

EXPOSE 80

CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]