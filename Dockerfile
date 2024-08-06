FROM php:8.1-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/symfony

# Copy composer files and install dependencies
COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader

# Copy existing application directory contents
COPY . /var/www/symfony

# Generate autoloader
RUN composer dump-autoload --optimize

# Change ownership of our applications
RUN chown -R www-data:www-data /var/www/symfony

# Expose port 8000 and start PHP's built-in server
EXPOSE 8000
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public/"]