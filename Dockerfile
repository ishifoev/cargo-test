FROM php:8.0-fpm

# Установка системных зависимостей
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Установка расширений PHP
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Установка расширений Postgres
RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo_pgsql

# Создание рабочего каталога
WORKDIR /var/www

# Копирование файлов
COPY . /var/www

# Копирование настроек Nginx
COPY docker/nginx/conf.d/app.conf /etc/nginx/conf.d/app.conf

# Установка прав доступа
RUN chown -R www-data:www-data /var/www

# Установка прав доступа
RUN chmod -R 755 /var/www

# Установка прав доступа к директориям
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Запуск контейнера
CMD ["php-fpm"]
