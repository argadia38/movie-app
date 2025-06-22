FROM php:8.3-fpm-alpine

RUN apk update && apk add --no-cache \
    build-base \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    zip \
    unzip \
    git \
    curl \
    postgresql-dev \
    oniguruma-dev \
    libzip-dev \
    icu-dev

RUN docker-php-ext-configure gd \
    --with-freetype=/usr/include/ \
    --with-jpeg=/usr/include/ && \
    docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd zip intl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# ✅ Salin SEMUA project dulu
COPY . .

# ✅ Lalu install dependensi composer
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Set permission
RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
