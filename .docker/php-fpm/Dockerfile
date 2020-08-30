FROM php:7.4-fpm

# Install PHP extensions
RUN pecl install xdebug && docker-php-ext-enable xdebug && docker-php-ext-install bcmath pdo_mysql

# Install Composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Start php-fpm server
CMD ["php-fpm"]