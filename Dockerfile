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

# Set the working directory
WORKDIR /var/www/html

# Copy the entire Laravel project into the working directory
COPY . /var/www/html/

# Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PHP dependencies
RUN composer install

# Expose port 80
EXPOSE 80

# Command to run the application
CMD ["apache2-foreground"]
