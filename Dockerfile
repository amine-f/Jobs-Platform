# Use the official PHP image with Apache
FROM php:7.4-apache

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    libpq-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install zip \
    && docker-php-ext-install pdo_pgsql \
    && a2enmod rewrite

# Set the working directory to the Laravel project
WORKDIR /var/www/html/

# Copy the entire Laravel project into the working directory
COPY . /var/www/html/

# Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PHP dependencies
RUN composer install

# Set Apache DocumentRoot to Laravel's public directory
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Ensure correct permissions for Laravel directories
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Add this in your Dockerfile or Apache config
RUN sed -i 's/Listen 80/Listen 10000/' /etc/apache2/ports.conf
# Expose port 80
EXPOSE 10000

# Command to run the application
CMD ["apache2-foreground"]
