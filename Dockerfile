# Use the official PHP image with Apache
FROM php:7.4-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install zip

# Install PostgreSQL extension
RUN apt-get install -y libpq-dev \
    && docker-php-ext-install pdo_pgsql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set the working directory
WORKDIR /var/www/html

# Copy the public directory contents into the web root
COPY public/ /var/www/html/

# Copy the existing application directory contents
COPY . /var/www/html

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PHP dependencies
RUN composer install

# Expose port 80
EXPOSE 80

# Command to run the application
CMD ["apache2-foreground"]
