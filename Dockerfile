FROM php:8.3-fpm

# 必要な拡張インストール
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

WORKDIR /var/www/html
