# MJLA Help & Troubleshooting Guide

This guide provides help for common issues and questions about the Majime Japanese Language Academy (MJLA) application.

## Table of Contents
- [Getting Started](#getting-started)
- [Common Issues](#common-issues)
- [Error Messages](#error-messages)
- [Development](#development)
- [Deployment](#deployment)
- [FAQ](#faq)
- [Getting Help](#getting-help)

## Getting Started

### Prerequisites
Before you begin, ensure you have:
- PHP 8.2 or higher
- Composer (latest version)
- Node.js 18+ and NPM
- A database (SQLite, MySQL, or PostgreSQL)

### Quick Setup
```bash
# Clone the repository
git clone https://github.com/kasunvimarshana/MJLA.git
cd MJLA

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Setup database
touch database/database.sqlite  # For SQLite
php artisan migrate

# Build assets
npm run build

# Start server
php artisan serve
```

Visit `http://localhost:8000` in your browser.

## Common Issues

### 1. "Composer install" fails

**Problem**: Composer dependency installation fails with errors.

**Solutions**:
- Update Composer: `composer self-update`
- Clear Composer cache: `composer clear-cache`
- Delete `vendor/` and `composer.lock`, then run `composer install` again
- Check PHP version: `php -v` (must be 8.2+)
- Install missing PHP extensions

### 2. "npm install" fails

**Problem**: NPM dependency installation fails.

**Solutions**:
- Update Node.js and NPM to latest versions
- Clear NPM cache: `npm cache clean --force`
- Delete `node_modules/` and `package-lock.json`, then run `npm install` again
- Try using `npm ci` instead of `npm install`

### 3. Database connection errors

**Problem**: Cannot connect to database.

**Solutions**:
- **For SQLite**: Ensure `database/database.sqlite` file exists and is writable
- **For MySQL/PostgreSQL**: Check database credentials in `.env`
- Verify database service is running
- Check database permissions
- Run `php artisan migrate:fresh` to rebuild database

### 4. "Application key not found"

**Problem**: Error about missing application key.

**Solution**:
```bash
php artisan key:generate
```

### 5. Permission denied errors

**Problem**: File permission errors on storage or cache.

**Solutions**:
```bash
# Fix storage permissions
sudo chmod -R 775 storage bootstrap/cache
sudo chown -R www-data:www-data storage bootstrap/cache

# On development (not recommended for production)
chmod -R 777 storage bootstrap/cache
```

### 6. Assets not loading (404 for CSS/JS)

**Problem**: CSS and JavaScript files return 404 errors.

**Solutions**:
- Build assets: `npm run build` or `npm run dev`
- Clear Laravel cache: `php artisan cache:clear`
- Clear view cache: `php artisan view:clear`
- Check if `public/build/` directory exists

### 7. Vite errors during development

**Problem**: Vite development server won't start or shows errors.

**Solutions**:
- Stop any running Vite instances
- Delete `node_modules/.vite` cache
- Run `npm run dev` in a separate terminal
- Check if port 5173 is already in use

### 8. "Class not found" errors

**Problem**: Laravel cannot find a class.

**Solutions**:
```bash
# Regenerate autoload files
composer dump-autoload

# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### 9. CSRF token mismatch

**Problem**: Forms return "CSRF token mismatch" error.

**Solutions**:
- Clear browser cookies for the site
- Clear session cache: `php artisan session:clear`
- Verify `@csrf` directive is in forms
- Check session driver in `.env` (should be `file` or `database`)

### 10. Queue jobs not running

**Problem**: Background jobs are not executing.

**Solutions**:
```bash
# Start queue worker
php artisan queue:work

# For development (restarts on code changes)
php artisan queue:listen

# Check failed jobs
php artisan queue:failed

# Retry failed jobs
php artisan queue:retry all
```

## Error Messages

### 404 - Page Not Found
- **Cause**: The URL doesn't exist
- **Fix**: Check the URL for typos, or navigate from the home page

### 403 - Forbidden
- **Cause**: You don't have permission to access the resource
- **Fix**: Ensure you're logged in with the correct role/permissions

### 500 - Server Error
- **Cause**: Something went wrong on the server
- **Fixes**:
  - Check Laravel logs: `storage/logs/laravel.log`
  - Enable debug mode in `.env`: `APP_DEBUG=true` (only in development!)
  - Check server error logs
  - Verify database connection

### 503 - Service Unavailable
- **Cause**: The application is in maintenance mode
- **Fix**: Wait for maintenance to complete, or exit maintenance mode: `php artisan up`

### 419 - Page Expired
- **Cause**: CSRF token expired (usually from leaving a form open too long)
- **Fix**: Refresh the page and try again

## Development

### Running Tests
```bash
# Run all tests
./vendor/bin/phpunit

# Run specific test file
./vendor/bin/phpunit tests/Feature/CourseTest.php

# Run with coverage
./vendor/bin/phpunit --coverage-html coverage/
```

### Code Formatting
```bash
# Format all code
./vendor/bin/pint

# Check without modifying
./vendor/bin/pint --test
```

### Clearing Caches
```bash
# Clear all caches
php artisan optimize:clear

# Or individually
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Debugging Tips
1. Enable debug mode: Set `APP_DEBUG=true` in `.env` (development only!)
2. Check logs: `storage/logs/laravel.log`
3. Use `dd()` or `dump()` for debugging
4. Install Laravel Debugbar: `composer require barryvdh/laravel-debugbar --dev`
5. Use Tinker for interactive PHP: `php artisan tinker`

## Deployment

### Production Checklist
Before deploying to production:

- [ ] Set `APP_ENV=production` in `.env`
- [ ] Set `APP_DEBUG=false` in `.env`
- [ ] Generate application key: `php artisan key:generate`
- [ ] Configure production database
- [ ] Run migrations: `php artisan migrate --force`
- [ ] Optimize application:
  ```bash
  php artisan config:cache
  php artisan route:cache
  php artisan view:cache
  composer install --optimize-autoloader --no-dev
  npm run build
  ```
- [ ] Set up SSL certificate
- [ ] Configure proper file permissions
- [ ] Set up queue workers (if using queues)
- [ ] Set up scheduled tasks (cron)
- [ ] Configure backups
- [ ] Set up monitoring

### Common Deployment Issues

**Issue**: White screen after deployment
- Check file permissions
- Check `.env` configuration
- Check server error logs
- Run `php artisan optimize:clear`

**Issue**: Assets not loading in production
- Run `npm run build` before deployment
- Ensure `public/build/` directory is uploaded
- Check web server configuration

**Issue**: Database migrations fail
- Check database credentials
- Ensure database user has proper permissions
- Check if migrations were already run

## FAQ

### Q: How do I add a new module?
**A**: Follow the Service-Repository pattern documented in [CONTRIBUTING.md](CONTRIBUTING.md). See the Courses module as a reference implementation.

### Q: How do I change the database from SQLite to MySQL?
**A**: Update `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```
Then run `php artisan migrate`.

### Q: How do I add a new language?
**A**: 
1. Create a new language folder in `lang/` (e.g., `lang/ta/`)
2. Copy translation files from `lang/en/`
3. Translate the messages
4. Add language switcher option in views

### Q: How do I enable maintenance mode?
**A**: 
```bash
# Enable maintenance mode
php artisan down

# With custom message
php artisan down --message="We're upgrading. Back soon!"

# Disable maintenance mode
php artisan up
```

### Q: How do I reset the database?
**A**:
```bash
# Reset and re-run all migrations
php artisan migrate:fresh

# With seeders
php artisan migrate:fresh --seed
```

### Q: How do I schedule tasks?
**A**: Add scheduled tasks in `app/Console/Kernel.php`, then add this to your crontab:
```
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

### Q: How do I optimize performance?
**A**:
```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Optimize composer
composer install --optimize-autoloader --no-dev

# Enable OPcache in php.ini
opcache.enable=1
opcache.memory_consumption=128
```

### Q: Where are the log files?
**A**: Log files are in `storage/logs/laravel.log`. You can also check using:
```bash
tail -f storage/logs/laravel.log
```

## Getting Help

If you can't find a solution to your problem:

### Documentation
- [README.md](README.md) - Project overview and installation
- [ARCHITECTURE.md](ARCHITECTURE.md) - Technical architecture
- [DEPLOYMENT.md](DEPLOYMENT.md) - Deployment guide
- [CONTRIBUTING.md](CONTRIBUTING.md) - Contribution guide

### Community Support
- **GitHub Issues**: [Report a bug](https://github.com/kasunvimarshana/MJLA/issues/new)
- **GitHub Discussions**: [Ask a question](https://github.com/kasunvimarshana/MJLA/discussions)

### Contact
- **Email**: support@mjla.lk
- **Phone**: +94 XX XXX XXXX

### Useful External Resources
- [Laravel Documentation](https://laravel.com/docs)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [Alpine.js Documentation](https://alpinejs.dev)
- [PHP Documentation](https://www.php.net/docs.php)

---

**Last Updated**: November 2025  
**Version**: 1.0.0
