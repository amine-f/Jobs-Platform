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

# Copy the Apache configuration file
COPY custom-apache.conf /etc/apache2/sites-available/

# Set the working directory to the Laravel project
WORKDIR /var/www/html/

# Copy the entire Laravel project into the working directory
COPY . /var/www/html/

# Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PHP dependencies
RUN composer install --optimize-autoloader --no-dev

# Enable the custom Apache configuration and disable the default one
RUN a2ensite custom-apache.conf && a2dissite 000-default.conf

# Update the port configuration to listen on port 10000
RUN sed -i 's/Listen 80/Listen 10000/' /etc/apache2/ports.conf

# Ensure correct permissions for Laravel directories
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 10000
EXPOSE 10000

# Command to run the application
CMD ["apache2-foreground"]
