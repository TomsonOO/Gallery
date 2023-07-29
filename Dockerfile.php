# Set base image
FROM php:8.0-fpm

# Set working directory in the container
WORKDIR /var/www/backend

# Install system dependencies
RUN apt-get update && apt-get install -y \
git \
curl \
libpng-dev \
libonig-dev \
libxml2-dev \
zip \
unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd
RUN apt-get install -y libxml2-dev && docker-php-ext-install xml

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Expose port 8000 and start PHP built-in server
CMD php -S 0.0.0.0:8000 -t public
