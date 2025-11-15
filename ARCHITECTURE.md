# MJLA Architecture Documentation

## Project Overview
Majime Japanese Language Academy (MJLA) is a production-ready Laravel 11 LTS web application designed to support Sri Lankans aspiring to study, work, and build their future in Japan. The application follows industry best practices, SOLID principles, and modern Laravel conventions.

## Technology Stack

### Backend
- **Framework**: Laravel 11.46.1 (LTS)
- **PHP Version**: 8.3.6+
- **Database**: SQLite (development), MySQL/PostgreSQL (production ready)
- **Queue**: Database driver (Redis ready)
- **Cache**: File driver (Redis ready)
- **Session**: Database driver

### Frontend
- **Build Tool**: Vite 5.0
- **CSS Framework**: Tailwind CSS 3.4
- **JavaScript Framework**: Alpine.js 3.13
- **Animations**: AOS (Animate On Scroll) 2.3
- **Package Manager**: NPM

### Testing
- **Framework**: PHPUnit 11.5.44
- **Strategy**: Feature tests, Unit tests, Database tests

## Architecture Patterns

### Service-Repository Pattern

The application uses a clean separation of concerns through the Service-Repository pattern:

```
┌─────────────────┐
│  View Layer     │ ← Blade Templates
└────────┬────────┘
         ↓
┌─────────────────┐
│ Controller Layer│ ← HTTP Request Handlers
└────────┬────────┘
         ↓
┌─────────────────┐
│ Service Layer   │ ← Business Logic + Caching
└────────┬────────┘
         ↓
┌─────────────────┐
│Repository Layer │ ← Data Access
└────────┬────────┘
         ↓
┌─────────────────┐
│  Model Layer    │ ← Eloquent ORM
└────────┬────────┘
         ↓
┌─────────────────┐
│ Database Layer  │ ← SQLite/MySQL/PostgreSQL
└─────────────────┘
```

### SOLID Principles

1. **Single Responsibility Principle**: Each class has one responsibility
   - Controllers handle HTTP requests
   - Services contain business logic
   - Repositories manage data access
   - Models represent entities

2. **Open/Closed Principle**: Classes are open for extension but closed for modification
   - Base classes for common functionality
   - Interfaces for contracts
   - Extensible through inheritance

3. **Liskov Substitution Principle**: Derived classes can substitute base classes
   - All repositories extend BaseRepository
   - All services extend BaseService

4. **Interface Segregation Principle**: Interfaces are specific to client needs
   - RepositoryInterface
   - ServiceInterface

5. **Dependency Inversion Principle**: Depend on abstractions, not concretions
   - Dependency injection in controllers
   - Interface-based contracts

## Directory Structure

```
MJLA/
├── app/
│   ├── Http/
│   │   ├── Controllers/          # HTTP request handlers
│   │   │   ├── Api/              # RESTful API controllers
│   │   │   ├── ContactController.php
│   │   │   ├── CourseController.php
│   │   │   └── LocaleController.php
│   │   ├── Middleware/           # Custom middleware
│   │   │   └── SetLocale.php    # Localization middleware
│   │   └── Requests/             # Form validation
│   │       ├── ContactFormRequest.php
│   │       └── Course/
│   │           ├── StoreCourseRequest.php
│   │           └── UpdateCourseRequest.php
│   ├── Mail/                     # Mailable classes
│   │   └── ContactFormSubmitted.php
│   ├── Models/                   # Eloquent models
│   │   ├── Contact.php
│   │   ├── Course.php
│   │   └── User.php
│   ├── Repositories/             # Data access layer
│   │   ├── Contracts/            # Repository interfaces
│   │   ├── BaseRepository.php
│   │   └── CourseRepository.php
│   └── Services/                 # Business logic layer
│       ├── Contracts/            # Service interfaces
│       ├── BaseService.php
│       └── CourseService.php
├── bootstrap/
│   └── app.php                   # Application bootstrap
├── config/                       # Configuration files
├── database/
│   ├── migrations/               # Database migrations
│   ├── seeders/                  # Database seeders
│   └── factories/                # Model factories
├── lang/                         # Localization files
│   ├── en/                       # English
│   ├── si/                       # Sinhala
│   └── ja/                       # Japanese
├── public/
│   └── build/                    # Compiled assets (gitignored)
├── resources/
│   ├── css/
│   │   └── app.css              # Tailwind CSS entry
│   ├── js/
│   │   ├── app.js               # JavaScript entry
│   │   └── bootstrap.js         # Axios setup
│   └── views/
│       ├── components/          # Reusable Blade components
│       │   ├── alert.blade.php
│       │   ├── button.blade.php
│       │   ├── card.blade.php
│       │   ├── page-header.blade.php
│       │   └── form/
│       │       └── input.blade.php
│       ├── contact/             # Contact module views
│       ├── courses/             # Courses module views
│       ├── emails/              # Email templates
│       ├── layouts/             # Page layouts
│       │   └── app.blade.php    # Main layout
│       └── welcome.blade.php    # Landing page
├── routes/
│   ├── api.php                  # API routes
│   ├── console.php              # Artisan commands
│   └── web.php                  # Web routes
├── tests/
│   ├── Feature/                 # Feature tests
│   │   └── CourseTest.php
│   └── Unit/                    # Unit tests
├── package.json                 # NPM dependencies
├── composer.json                # Composer dependencies
├── vite.config.js               # Vite configuration
├── tailwind.config.js           # Tailwind configuration
└── phpunit.xml                  # PHPUnit configuration
```

## Core Components

### Base Classes

#### BaseRepository
Provides common CRUD operations for all repositories:
- `all()` - Get all records
- `paginate()` - Paginated results
- `find()` - Find by ID
- `create()` - Create new record
- `update()` - Update existing record
- `delete()` - Delete record
- `findByCriteria()` - Custom queries

#### BaseService
Wraps repository with business logic and caching:
- Cache management
- Transaction handling
- Business logic layer
- Cache invalidation

### Middleware

#### SetLocale
Automatically detects and sets the application locale:
- Session-based locale storage
- Browser language detection
- Supports: English (en), Sinhala (si), Japanese (ja)

### Form Requests

All form submissions use FormRequest classes for validation:
- Centralized validation rules
- Custom error messages
- Localized attribute names
- Authorization logic

### Mailable Classes

Email notifications use Laravel's Mailable:
- Queue support for async sending
- Markdown templates
- Clean separation of concerns

## Security Features

### Implemented
1. **CSRF Protection**: Laravel's built-in middleware
2. **SQL Injection Prevention**: Eloquent ORM with prepared statements
3. **XSS Protection**: Blade templating engine
4. **Rate Limiting**: Contact form (3 submissions per hour per IP)
5. **Input Validation**: FormRequest classes
6. **Password Hashing**: Bcrypt algorithm
7. **Type Declarations**: PHP 8.3 strict types
8. **Soft Deletes**: Data retention strategy
9. **Environment Variables**: Sensitive data in .env

### Best Practices
- No sensitive data in code
- Proper .gitignore configuration
- Secure session management
- HTTP-only cookies
- HTTPS-ready configuration

## Performance Optimizations

### Implemented
1. **Query Result Caching**: Service layer (1-hour TTL)
2. **Database Indexes**: Key columns indexed
3. **Lazy Loading**: Relationships loaded on demand
4. **Pagination**: Large datasets paginated
5. **Asset Optimization**: Vite bundling and minification
6. **Database Transactions**: Atomic operations

### Production Ready
- Config caching (`php artisan config:cache`)
- Route caching (`php artisan route:cache`)
- View caching (`php artisan view:cache`)
- Autoloader optimization (`composer dump-autoload -o`)

## Multilingual Support

### Languages Supported
1. **English (en)**: Default language
2. **Sinhala (si)**: Sri Lankan users
3. **Japanese (ja)**: Japanese language learners

### Implementation
- Language files in `lang/` directory
- Middleware for automatic detection
- Session-based storage
- Translation helpers: `__()`, `trans()`
- Language switcher in navigation

### Translation Coverage
- Navigation menu
- Common UI elements
- Forms and validation
- Footer content
- Flash messages
- Course information

## Frontend Architecture

### Asset Pipeline
```
Source Files (resources/)
    ↓
Vite Processing
    ↓
- Tailwind CSS compilation
- JavaScript bundling
- Asset minification
- Source maps generation
    ↓
Output (public/build/)
    ↓
Browser
```

### Component System

#### Blade Components
Reusable UI components for consistent design:

1. **Page Header**: Section titles with subtitles
2. **Button**: Primary, secondary, outline variants
3. **Card**: Content cards with hover effects
4. **Form Input**: Text, email, textarea with validation
5. **Alert**: Success, error, warning, info messages

#### Alpine.js Components
JavaScript interactivity:
- Mobile menu toggle
- Language switcher
- Form validation
- Dynamic content

### CSS Architecture

Using Tailwind CSS utility-first approach with custom layers:

```css
@layer base {
    /* Base element styling */
}

@layer components {
    /* Reusable component classes */
    .btn { ... }
    .card { ... }
    .form-input { ... }
}

@layer utilities {
    /* Custom utility classes */
}
```

## Database Design

### Migrations
All database changes through migrations:
- Version controlled
- Rollback support
- Team synchronization

### Current Tables
1. **courses**: Japanese language courses
2. **contacts**: Contact form submissions
3. **users**: User accounts
4. **roles**: User roles
5. **permissions**: Role permissions
6. **visa_services**: Visa application services
7. **admissions**: Student admissions
8. **news**: News and events
9. **staff**: Staff profiles
10. **gallery_items**: Photo/video gallery
11. **blog_posts**: Blog content

### Indexes
Strategic indexes on:
- Primary keys
- Foreign keys
- Frequently queried columns
- Slug columns

## API Design

### RESTful Endpoints
Following REST conventions:
```
GET    /api/courses          - List courses
GET    /api/courses/{id}     - Show course
POST   /api/courses          - Create course
PUT    /api/courses/{id}     - Update course
DELETE /api/courses/{id}     - Delete course
```

### Response Format
Consistent JSON responses:
```json
{
    "data": { ... },
    "meta": {
        "current_page": 1,
        "total": 100
    },
    "links": { ... }
}
```

## Testing Strategy

### Test Types
1. **Feature Tests**: Full HTTP request/response cycle
2. **Unit Tests**: Individual methods and classes
3. **Database Tests**: Database interactions

### Test Coverage
- HTTP requests
- Database operations
- Model scopes
- Business logic
- Validation rules

### Running Tests
```bash
./vendor/bin/phpunit                    # All tests
./vendor/bin/phpunit --filter CourseTest # Specific test
./vendor/bin/phpunit --coverage-html coverage/ # With coverage
```

## Deployment Guide

### Requirements
- PHP 8.2+
- Composer 2.x
- Node.js 18+ & NPM
- MySQL 8.0+ or PostgreSQL 13+
- Redis (recommended for cache/queue)
- Nginx or Apache

### Deployment Steps
1. Clone repository
2. Install dependencies: `composer install --optimize-autoloader --no-dev`
3. Copy environment: `cp .env.example .env`
4. Generate key: `php artisan key:generate`
5. Configure database in `.env`
6. Run migrations: `php artisan migrate --force`
7. Build assets: `npm install && npm run build`
8. Cache config: `php artisan config:cache`
9. Cache routes: `php artisan route:cache`
10. Cache views: `php artisan view:cache`
11. Start queue worker: `php artisan queue:work --daemon`
12. Configure web server

### Environment Variables
Key variables to configure:
```env
APP_NAME="Majime Japanese Language Academy"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mjla
DB_USERNAME=dbuser
DB_PASSWORD=dbpass

CACHE_STORE=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

MAIL_MAILER=smtp
MAIL_HOST=smtp.example.com
MAIL_PORT=587
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_FROM_ADDRESS=noreply@mjla.lk
MAIL_FROM_NAME="${APP_NAME}"
```

## Maintenance

### Regular Tasks
1. **Backup Database**: Daily automated backups
2. **Monitor Logs**: Check `storage/logs/laravel.log`
3. **Update Dependencies**: Monthly security updates
4. **Cache Clearing**: After deployments
5. **Queue Monitoring**: Ensure workers are running

### Performance Monitoring
- Database query optimization
- Cache hit rates
- Response times
- Error rates
- Resource usage

## Future Enhancements

### Recommended Next Steps
1. **Admin Panel**: Laravel Filament integration
2. **Search**: Laravel Scout with Algolia/Meilisearch
3. **File Uploads**: Image optimization and storage
4. **Real-time**: WebSockets for notifications
5. **Analytics**: Google Analytics & Facebook Pixel
6. **SEO**: Automated sitemap generation
7. **API Auth**: Laravel Sanctum for mobile apps
8. **CI/CD**: GitHub Actions or GitLab CI
9. **Monitoring**: Sentry or Bugsnag integration
10. **CDN**: CloudFlare or AWS CloudFront

## Code Quality Standards

### PSR Standards
- PSR-1: Basic Coding Standard
- PSR-12: Extended Coding Style Guide
- PSR-4: Autoloading Standard

### Laravel Conventions
- Naming conventions
- Directory structure
- Routing patterns
- Database conventions

### Tools
- **Laravel Pint**: Code style fixer
- **PHPStan**: Static analysis
- **PHP CS Fixer**: Code formatting

## Support and Documentation

### Resources
- Laravel Documentation: https://laravel.com/docs
- Tailwind CSS: https://tailwindcss.com
- Alpine.js: https://alpinejs.dev
- Project README: README.md
- Implementation Summary: IMPLEMENTATION_SUMMARY.md
- Deployment Guide: DEPLOYMENT.md

### Contact
For questions or support:
- GitHub Issues: Repository issues tracker
- Email: developer@mjla.lk

---

**Version**: 1.0.0  
**Last Updated**: November 15, 2025  
**Status**: Production Ready ✅
