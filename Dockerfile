# Используем официальный образ PHP
FROM php:8.0-fpm

# Устанавливаем необходимые расширения PHP
RUN docker-php-ext-install pdo pdo_mysql

# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Устанавливаем необходимые зависимости
WORKDIR /var/www/html
COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader

# Копируем все файлы в контейнер
COPY . .

# Генерируем автозагрузчик
RUN composer dump-autoload

# Открываем порт 9000
EXPOSE 9000

# Команда для запуска php-fpm
CMD ["php-fpm"]