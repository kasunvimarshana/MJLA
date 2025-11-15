# MJLA Deployment Guide

## Prerequisites

### Server Requirements
- Ubuntu 20.04+ or CentOS 8+
- PHP 8.2 or higher
- Composer 2.x
- MySQL 8.0+ or PostgreSQL 13+ or SQLite
- Nginx or Apache
- Node.js 18+ & NPM (required for asset compilation)
- Redis (optional, for caching and queues)
- Supervisor (for queue workers)

### PHP Extensions
```bash
sudo apt-get install -y \
    php8.3-cli \
    php8.3-fpm \
    php8.3-mysql \
    php8.3-pgsql \
    php8.3-sqlite3 \
    php8.3-xml \
    php8.3-mbstring \
    php8.3-curl \
    php8.3-zip \
    php8.3-bcmath \
    php8.3-intl \
    php8.3-redis
```

## Deployment Steps

### 1. Server Setup

#### Install Dependencies
```bash
# Update system
sudo apt-get update && sudo apt-get upgrade -y

# Install PHP and extensions
sudo apt-get install -y software-properties-common
sudo add-apt-repository ppa:ondrej/php
sudo apt-get update
sudo apt-get install -y php8.3-cli php8.3-fpm php8.3-mysql

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Install Nginx
sudo apt-get install -y nginx

# Install MySQL
sudo apt-get install -y mysql-server
sudo mysql_secure_installation

# Install Redis (optional)
sudo apt-get install -y redis-server
```

### 2. Application Deployment

#### Clone Repository
```bash
cd /var/www
sudo git clone https://github.com/kasunvimarshana/MJLA.git
cd MJLA
sudo chown -R www-data:www-data .
```

#### Install Dependencies
```bash
# Install PHP dependencies
composer install --no-dev --optimize-autoloader

# Install Node.js dependencies
npm install

# Build frontend assets
npm run build
```

#### Environment Configuration
```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` file:
```env
APP_NAME="Majime Japanese Language Academy"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
APP_TIMEZONE=Asia/Tokyo

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mjla_production
DB_USERNAME=mjla_user
DB_PASSWORD=secure_password

CACHE_STORE=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

#### Database Setup
```bash
# Create database
mysql -u root -p
CREATE DATABASE mjla_production CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'mjla_user'@'localhost' IDENTIFIED BY 'secure_password';
GRANT ALL PRIVILEGES ON mjla_production.* TO 'mjla_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;

# Run migrations
php artisan migrate --force
```

#### Permissions
```bash
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

#### Optimization
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 3. Web Server Configuration

#### Nginx Configuration
```bash
sudo nano /etc/nginx/sites-available/mjla
```

Add configuration:
```nginx
server {
    listen 80;
    listen [::]:80;
    server_name yourdomain.com www.yourdomain.com;
    root /var/www/MJLA/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Enable site:
```bash
sudo ln -s /etc/nginx/sites-available/mjla /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

### 4. SSL Certificate (Let's Encrypt)

```bash
sudo apt-get install -y certbot python3-certbot-nginx
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com
```

### 5. Queue Workers (Optional)

#### Supervisor Configuration
```bash
sudo apt-get install -y supervisor
sudo nano /etc/supervisor/conf.d/mjla-worker.conf
```

Add configuration:
```ini
[program:mjla-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/MJLA/artisan queue:work --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/var/www/MJLA/storage/logs/worker.log
stopwaitsecs=3600
```

Start supervisor:
```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start mjla-worker:*
```

### 6. Scheduled Tasks

Add to crontab:
```bash
sudo crontab -e -u www-data
```

Add line:
```
* * * * * cd /var/www/MJLA && php artisan schedule:run >> /dev/null 2>&1
```

### 7. Monitoring and Logging

#### Log Rotation
```bash
sudo nano /etc/logrotate.d/mjla
```

Add configuration:
```
/var/www/MJLA/storage/logs/*.log {
    daily
    missingok
    rotate 14
    compress
    delaycompress
    notifempty
    create 0640 www-data www-data
    sharedscripts
}
```

#### Monitoring
Consider installing:
- Laravel Telescope (development)
- Laravel Horizon (queue monitoring)
- Laravel Pulse (performance monitoring)
- New Relic or Datadog (APM)

### 8. Backup Strategy

#### Database Backup Script
```bash
#!/bin/bash
TIMESTAMP=$(date +"%Y%m%d_%H%M%S")
BACKUP_DIR="/var/backups/mjla"
mkdir -p $BACKUP_DIR

# Database backup
mysqldump -u mjla_user -p'secure_password' mjla_production > $BACKUP_DIR/db_$TIMESTAMP.sql
gzip $BACKUP_DIR/db_$TIMESTAMP.sql

# Keep only last 30 days
find $BACKUP_DIR -type f -mtime +30 -delete
```

Add to crontab:
```bash
0 2 * * * /path/to/backup-script.sh
```

### 9. Security Hardening

#### Firewall
```bash
sudo ufw allow 22/tcp
sudo ufw allow 80/tcp
sudo ufw allow 443/tcp
sudo ufw enable
```

#### Fail2Ban
```bash
sudo apt-get install -y fail2ban
sudo systemctl enable fail2ban
```

#### Application Security
- Keep Laravel and dependencies updated
- Use HTTPS only
- Enable rate limiting
- Implement CSRF protection
- Validate all inputs
- Use prepared statements
- Set secure headers

### 10. Performance Optimization

#### OPcache Configuration
```bash
sudo nano /etc/php/8.3/fpm/conf.d/10-opcache.ini
```

```ini
opcache.enable=1
opcache.memory_consumption=256
opcache.interned_strings_buffer=16
opcache.max_accelerated_files=10000
opcache.validate_timestamps=0
opcache.save_comments=1
opcache.fast_shutdown=1
```

#### Redis Configuration
```bash
sudo nano /etc/redis/redis.conf
```

```
maxmemory 256mb
maxmemory-policy allkeys-lru
```

### 11. Zero-Downtime Deployment

Use Laravel Envoy or Deployer:

```bash
composer require deployer/deployer --dev
```

Create `deploy.php`:
```php
<?php
namespace Deployer;

require 'recipe/laravel.php';

set('repository', 'git@github.com:kasunvimarshana/MJLA.git');
set('keep_releases', 5);

host('production')
    ->hostname('yourdomain.com')
    ->user('deploy')
    ->set('deploy_path', '/var/www/mjla');

task('deploy', [
    'deploy:prepare',
    'deploy:vendors',
    'artisan:storage:link',
    'artisan:migrate',
    'artisan:config:cache',
    'artisan:route:cache',
    'artisan:view:cache',
    'deploy:publish',
]);
```

Deploy:
```bash
vendor/bin/dep deploy production
```

### 12. Health Checks

#### Application Health
```bash
curl https://yourdomain.com/up
```

#### Database Health
```bash
php artisan tinker
>>> DB::connection()->getPdo();
```

## Post-Deployment

### Verification Checklist
- [ ] Application loads correctly
- [ ] Database connection works
- [ ] Assets are accessible
- [ ] SSL certificate is valid
- [ ] Queue workers are running
- [ ] Scheduled tasks are executing
- [ ] Logs are being written
- [ ] Backups are working
- [ ] Performance is acceptable
- [ ] Security headers are set

### Monitoring
Set up monitoring for:
- Application uptime
- Response times
- Error rates
- Queue lengths
- Database performance
- Server resources
- SSL certificate expiry

## Troubleshooting

### Common Issues

#### Permission Errors
```bash
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

#### 500 Internal Server Error
```bash
# Check Laravel logs
tail -f storage/logs/laravel.log

# Check Nginx logs
sudo tail -f /var/log/nginx/error.log
```

#### Database Connection Failed
```bash
# Test connection
php artisan tinker
>>> DB::connection()->getPdo();
```

#### Clear All Caches
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## Rollback

If deployment fails:
```bash
# Using Deployer
vendor/bin/dep rollback production

# Manual rollback
cd /var/www/mjla/releases
ln -sfn previous current
sudo systemctl reload php8.3-fpm
```

## Support

For deployment issues:
- Email: devops@mjla.edu
- Documentation: https://docs.mjla.edu
- Repository: https://github.com/kasunvimarshana/MJLA

---

**Last Updated:** November 2025
