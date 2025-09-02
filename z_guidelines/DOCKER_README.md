# Docker Setup for Car Dealership Application

This document provides instructions for running the Laravel Car Dealership application using Docker.

## Prerequisites

- Docker
- Docker Compose
- Git

## Quick Start

### Production Deployment

1. **Build and run the production container:**
   ```bash
   docker-compose up -d app
   ```

2. **Access the application:**
   - Main website: http://localhost:8000
   - Admin interface: http://localhost:8001

### Development Environment

1. **Start the development environment:**
   ```bash
   docker-compose --profile development up -d
   ```

2. **Access the development services:**
   - Main website: http://localhost:3000
   - Admin interface: http://localhost:3001
   - Vite dev server: http://localhost:5173
   - Mailhog (email testing): http://localhost:8025
   - Redis: localhost:6379

## Docker Commands

### Building Images

```bash
# Build production image
docker build --target production -t car-dealership:production .

# Build development image
docker build --target development -t car-dealership:development .
```

### Running Containers

```bash
# Run production container
docker run -d -p 8000:80 -p 8001:8001 car-dealership:production

# Run development container
docker run -d -p 3000:8000 -p 3001:8001 -p 5173:5173 car-dealership:development
```

### Managing Services

```bash
# Start all services
docker-compose up -d

# Start only production
docker-compose up -d app

# Start development environment
docker-compose --profile development up -d

# Stop all services
docker-compose down

# View logs
docker-compose logs -f app

# Rebuild and restart
docker-compose up -d --build
```

## Environment Configuration

### Production Environment Variables

Create a `.env` file in the project root:

```env
APP_NAME="Car Dealership"
APP_ENV=production
APP_KEY=base64:your-app-key-here
APP_DEBUG=false
APP_URL=http://localhost:8000

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=sqlite
DB_DATABASE=/var/www/html/database/database.sqlite

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_APP_NAME="${APP_NAME}"
VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```

### Development Environment Variables

For development, you can use the same `.env` file with these modifications:

```env
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:3000
```

## Database Setup

The application uses SQLite by default. The database file is automatically created in the `database/` directory.

### Running Migrations

```bash
# Inside the container
docker-compose exec app php artisan migrate

# Or run migrations during build (already included in Dockerfile)
```

### Seeding the Database

```bash
# Inside the container
docker-compose exec app php artisan db:seed

# Or run seeds during build (already included in Dockerfile)
```

## File Permissions

The Dockerfile automatically sets the correct permissions for Laravel:

- Storage directory: 755
- Bootstrap cache: 755
- Database file: 664

## Troubleshooting

### Common Issues

1. **Permission Denied Errors:**
   ```bash
   # Fix storage permissions
   docker-compose exec app chown -R www-data:www-data /var/www/html/storage
   docker-compose exec app chmod -R 755 /var/www/html/storage
   ```

2. **Database Connection Issues:**
   ```bash
   # Check if database file exists
   docker-compose exec app ls -la /var/www/html/database/
   
   # Recreate database
   docker-compose exec app php artisan migrate:fresh --seed
   ```

3. **Cache Issues:**
   ```bash
   # Clear all caches
   docker-compose exec app php artisan cache:clear
   docker-compose exec app php artisan config:clear
   docker-compose exec app php artisan route:clear
   docker-compose exec app php artisan view:clear
   ```

4. **Port Already in Use:**
   ```bash
   # Check what's using the port
   netstat -tulpn | grep :8000
   
   # Stop conflicting services
   docker-compose down
   ```

### Logs

View application logs:

```bash
# Laravel logs
docker-compose exec app tail -f /var/www/html/storage/logs/laravel.log

# Nginx logs
docker-compose logs -f app

# PHP-FPM logs
docker-compose exec app tail -f /var/log/php-fpm/php-fpm.log
```

## Performance Optimization

### Production Optimizations

The production Dockerfile includes:

- Multi-stage build for smaller image size
- Composer optimization (`--no-dev --optimize-autoloader`)
- Laravel caching (`config:cache`, `route:cache`, `view:cache`)
- Nginx with gzip compression
- Security headers
- Rate limiting

### Development Optimizations

The development setup includes:

- Volume mounts for live code changes
- Hot reloading with Vite
- Development tools (Mailhog, Redis)

## Security Considerations

- The production image runs as `www-data` user
- Sensitive files are excluded via `.dockerignore`
- Security headers are configured in Nginx
- Rate limiting is enabled for API endpoints
- Server tokens are hidden

## Customization

### Adding Custom PHP Extensions

Edit the Dockerfile and add to the PHP extensions section:

```dockerfile
RUN docker-php-ext-install your-extension
```

### Changing Database

To use MySQL or PostgreSQL instead of SQLite:

1. Update the `docker-compose.yml` file
2. Add the database service
3. Update environment variables
4. Install the appropriate PHP extension in the Dockerfile

### Custom Nginx Configuration

Modify the files in the `docker/` directory:
- `docker/nginx.conf` - Main Nginx configuration
- `docker/default.conf` - Server blocks

## Support

For issues related to:
- Docker setup: Check this README and Docker logs
- Laravel application: Check Laravel logs and documentation
- Nginx configuration: Check Nginx logs and configuration files
