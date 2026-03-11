# Stage 1: Dependencies
FROM composer:latest AS composer

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-progress --ignore-platform-reqs

# Stage 2: Production
FROM php:8.2-apache

# Install dependencies and clean up in one layer to save space
RUN apt-get update && apt-get install -y --no-install-recommends \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && a2enmod rewrite \
    && apt-get purge -y --auto-remove -o APT::AutoRemove::RecommendsImportant=false \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

# Copy app files (respecting .dockerignore)
COPY . .

# Copy dependencies from stage 1
COPY --from=composer /app/vendor ./vendor

# Set permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

