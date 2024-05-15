FROM php:8.2-fpm-alpine

# Update package list and install required system packages and PHP extensions
RUN apk update && apk add --no-cache \
    gmp-dev \
    zlib-dev \
    libpng-dev \
    libzip-dev \
    autoconf \
    gcc \
    g++ \
    make

# Install required PHP extensions
RUN docker-php-ext-install pdo pdo_mysql gmp pcntl gd zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Clean up
RUN rm -rf /var/cache/apk/*
