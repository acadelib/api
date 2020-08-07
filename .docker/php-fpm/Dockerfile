FROM php:7.4-fpm-alpine

# Install PHP extensions
RUN docker-php-ext-install bcmath pdo_mysql

# Install Composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Start php-fpm server
CMD ["php-fpm"]