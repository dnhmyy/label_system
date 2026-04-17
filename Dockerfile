# Stage 1: Dependencies
FROM composer:2 AS composer

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-progress --ignore-platform-reqs

# Stage 2: Production
FROM php:8.2-apache

# install runtime packages and enable required apache modules
RUN apt-get update && apt-get install -y --no-install-recommends \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && a2enmod rewrite headers \
    && apt-get purge -y --auto-remove -o APT::AutoRemove::RecommendsImportant=false \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

COPY docker/apache-security.conf /etc/apache2/conf-available/security-hardening.conf
COPY docker/php-security.ini $PHP_INI_DIR/conf.d/99-security.ini
RUN a2enconf security-hardening

COPY index.php print.php security.php .htaccess composer.json composer.lock ./
COPY images ./images

COPY --from=composer /app/vendor ./vendor

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
