# Multi-stage Dockerfile for Laravel Car Dealership Application
FROM php:8.2-fpm-alpine AS base

# Install system dependencies
RUN apk add --no-cache \
    git \
    curl \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip \
    sqlite \
    sqlite-dev \
    oniguruma-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    libzip-dev \
    nodejs \
    npm

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
    pdo \
    pdo_sqlite \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip \
    xml

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Copy package files for frontend assets
COPY package.json package-lock.json ./

# Install Node.js dependencies
RUN npm ci --only=production

# Copy application code
COPY . .

# Build frontend assets
RUN npm run build

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Create .env file if it doesn't exist
RUN if [ ! -f .env ]; then cp .env.example .env; fi

# Generate application key
RUN php artisan key:generate --no-interaction

# Create database file
RUN touch database/database.sqlite \
    && chmod 664 database/database.sqlite \
    && chown www-data:www-data database/database.sqlite

# Run migrations
RUN php artisan migrate --force

# Seed database
RUN php artisan db:seed --force

# Optimize for production
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# Production stage
FROM php:8.2-fpm-alpine AS production

# Install production dependencies only
RUN apk add --no-cache \
    libpng \
    libxml2 \
    sqlite \
    oniguruma \
    freetype \
    libjpeg-turbo \
    libzip \
    nginx \
    supervisor

# Install PHP extensions for production
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
    pdo \
    pdo_sqlite \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip \
    xml

# Copy application from build stage
COPY --from=base /var/www/html /var/www/html

# Copy nginx configuration
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/default.conf /etc/nginx/conf.d/default.conf

# Copy supervisor configuration
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Set working directory
WORKDIR /var/www/html

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Create necessary directories
RUN mkdir -p /var/log/nginx \
    && mkdir -p /var/log/php-fpm \
    && mkdir -p /var/log/supervisor

# Expose ports
EXPOSE 80 8000 8001

# Start supervisor
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

# Development stage
FROM base AS development

# Install development dependencies
RUN composer install --optimize-autoloader --no-interaction

# Install all Node.js dependencies (including dev dependencies)
RUN npm install

# Set development environment
ENV APP_ENV=local
ENV APP_DEBUG=true

# Expose ports for development
EXPOSE 8000 8001 5173

# Start development server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
