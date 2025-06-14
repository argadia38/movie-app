# 1. Base Image
FROM php:8.3-fpm-alpine

# 2. Install System Dependencies
RUN apk update && apk add --no-cache \
    build-base \
    icu-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    postgresql-dev \
    oniguruma-dev \
    libzip-dev

# 3. Install PHP Extensions
RUN docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd zip intl

# 4. Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Set working directory
WORKDIR /var/www/html

# 6. Copy composer files and install dependencies (Optimized for Caching)
# Hanya salin file dependensi terlebih dahulu
COPY composer.json composer.lock ./

# Install vendor, --no-dev untuk produksi
RUN composer install --no-dev --no-interaction --no-plugins --no-scripts --prefer-dist --optimize-autoloader

# 7. Copy the rest of the application code
COPY . .

# 8. Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 9. Expose port and run server
EXPOSE 9000
CMD ["php-fpm"]
