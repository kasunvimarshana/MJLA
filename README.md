# Majime Japanese Language Academy (MJLA)

Production-ready, LTS Laravel application for Majime Japanese Language Academy with dynamic mobile-first front-end, secure modular admin CMS, multilingual support, SEO-friendly content, role-based access, modular MVC architecture, Blade/Tailwind UI, queues, caching, tests, and CI/CD pipelines.

## Quick Links
📚 **[Installation Guide](#installation)** | 🏗️ **[Architecture](ARCHITECTURE.md)** | 🚀 **[Deployment](DEPLOYMENT.md)** | 🆘 **[Help & Troubleshooting](HELP.md)** | 🤝 **[Contributing](CONTRIBUTING.md)**

## Features

### Core Architecture
- **Laravel 11.x LTS** - Latest long-term support version
- **PHP 8.3+** - Modern PHP with type declarations and enums
- **Service-Repository Pattern** - Clean separation of concerns
- **SOLID Principles** - Maintainable and testable code
- **DRY & KISS** - Simple, reusable components

### Modules Implemented

#### 1. Courses Module ✅
Complete course management system with:
- CRUD operations with Service→Repository→Controller layers
- FormRequest validation
- Typed models with scopes
- Database migrations with indexes
- Responsive Blade views with Tailwind CSS
- Caching for performance
- Feature tests

**Routes:**
- `GET /courses` - List all courses
- `GET /courses/{slug}` - View course details
- `POST /courses` - Create course (admin)
- `PUT /courses/{slug}` - Update course (admin)
- `DELETE /courses/{slug}` - Delete course (admin)

#### 2. Visa Services Module (Planned)
- Service types and categories
- Application submission
- Processing status tracking

#### 3. Admissions Module (Planned)
- Online application forms
- Document uploads
- Status tracking
- Email notifications

#### 4. News & Events Module (Planned)
- News posts with categories
- Event calendar
- Featured content
- RSS feed

#### 5. Staff Module (Planned)
- Staff profiles
- Department organization
- Contact information
- Bio and expertise

#### 6. Gallery Module (Planned)
- Photo albums
- Video gallery
- Category organization
- Lightbox view

#### 7. Blog Module (Planned)
- Blog posts with categories
- Tagging system
- Comments
- Author profiles

#### 8. Contacts Module (Planned)
- Contact form
- Inquiry management
- Email notifications
- Response tracking

#### 9. Users & Roles Module (Planned)
- User authentication
- Role-based access control (RBAC)
- Permission management
- Admin dashboard

### Technical Features

#### Architecture Patterns
```
Service Layer → Repository Layer → Controller Layer → Views
```

- **BaseRepository**: Common CRUD operations
- **BaseService**: Business logic with caching
- **FormRequests**: Validation rules
- **Policies**: Authorization
- **Scopes**: Query filtering

#### Security
- CSRF protection (built-in Laravel)
- SQL injection prevention (Eloquent ORM)
- XSS protection (Blade templating)
- Rate limiting
- Input validation
- Secure password hashing

#### Performance
- Query caching (1-hour TTL)
- Database indexes
- Lazy loading
- Pagination
- Asset optimization

#### SEO
- Meta tags (title, description, keywords)
- Semantic HTML
- Structured data ready
- XML sitemap ready
- Robots.txt configuration

#### Responsive Design
- Mobile-first approach
- Tailwind CSS utility classes
- Accessible navigation
- Touch-friendly interfaces

#### Testing
- Feature tests for HTTP requests
- Unit tests for business logic
- Database transactions for isolation
- PHPUnit configuration
- Code coverage ready

## Installation

### Requirements
- PHP 8.2 or higher
- Composer
- SQLite/MySQL/PostgreSQL
- Node.js & NPM (required for asset compilation)

### Setup

1. **Clone the repository**
```bash
git clone https://github.com/kasunvimarshana/MJLA.git
cd MJLA
```

2. **Install dependencies**
```bash
composer install
npm install
```

3. **Environment configuration**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Database setup**
```bash
# For SQLite (default)
touch database/database.sqlite

# Run migrations
php artisan migrate
```

5. **Build frontend assets**
```bash
npm run build
```

6. **Start development server**
```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser.

## Project Structure

```
MJLA/
├── app/
│   ├── Http/
│   │   ├── Controllers/      # Controllers
│   │   ├── Middleware/       # Custom middleware
│   │   └── Requests/         # Form validation
│   ├── Models/               # Eloquent models
│   ├── Repositories/         # Data access layer
│   │   └── Contracts/        # Repository interfaces
│   ├── Services/             # Business logic layer
│   │   └── Contracts/        # Service interfaces
│   └── Providers/            # Service providers
├── database/
│   ├── migrations/           # Database migrations
│   ├── seeders/              # Database seeders
│   └── factories/            # Model factories
├── resources/
│   └── views/
│       ├── layouts/          # Page layouts
│       ├── components/       # Reusable components
│       └── courses/          # Module views
├── routes/
│   ├── web.php              # Web routes
│   └── api.php              # API routes
├── tests/
│   ├── Feature/             # Feature tests
│   └── Unit/                # Unit tests
└── config/                  # Configuration files
```

## Configuration

### Database
Edit `.env` file:
```env
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=mjla
# DB_USERNAME=root
# DB_PASSWORD=
```

### Cache
```env
CACHE_STORE=file
# CACHE_STORE=redis
```

### Application
```env
APP_NAME="Majime Japanese Language Academy"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
APP_TIMEZONE=Asia/Tokyo
APP_LOCALE=en
```

## Testing

Run all tests:
```bash
./vendor/bin/phpunit
```

Run specific test suite:
```bash
./vendor/bin/phpunit tests/Feature/CourseTest.php
```

With coverage:
```bash
./vendor/bin/phpunit --coverage-html coverage/
```

## Development

### Code Style
```bash
./vendor/bin/pint
```

### Create New Module
Follow the Service-Repository pattern:

1. Create migration
```bash
php artisan make:migration create_modulename_table
```

2. Create model with fillable fields and casts
3. Create repository extending BaseRepository
4. Create service extending BaseService
5. Create FormRequest for validation
6. Create controller
7. Add routes
8. Create views
9. Write tests

## Deployment

### Production Checklist
- [ ] Set `APP_ENV=production`
- [ ] Set `APP_DEBUG=false`
- [ ] Generate app key
- [ ] Configure production database
- [ ] Run migrations
- [ ] Set up queue workers
- [ ] Configure cache driver (Redis recommended)
- [ ] Set up SSL certificate
- [ ] Configure backup strategy
- [ ] Set up monitoring
- [ ] Configure email service
- [ ] Test all functionality

### Optimization
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
composer install --optimize-autoloader --no-dev
```

## API Documentation

RESTful API endpoints available for each module:

### Courses API
```
GET    /api/courses          - List courses
GET    /api/courses/{id}     - Get course details
POST   /api/courses          - Create course
PUT    /api/courses/{id}     - Update course
DELETE /api/courses/{id}     - Delete course
```

Authentication required for write operations.

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

### Coding Standards
- Follow PSR-12 coding standard
- Use type declarations
- Write tests for new features
- Document complex logic
- Keep methods small and focused

## Security

If you discover any security issues, please email security@example.com instead of using the issue tracker.

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Documentation

### Core Documentation
- **[README.md](README.md)** - Project overview and quick start
- **[ARCHITECTURE.md](ARCHITECTURE.md)** - Technical architecture and design patterns
- **[DEPLOYMENT.md](DEPLOYMENT.md)** - Deployment guide and production setup
- **[HELP.md](HELP.md)** - Troubleshooting and FAQ

### Contributing
- **[CONTRIBUTING.md](CONTRIBUTING.md)** - How to contribute to this project
- **[CODE_OF_CONDUCT.md](CODE_OF_CONDUCT.md)** - Community guidelines and standards

## Support

Need help? We're here to assist you!

### Common Issues
Check our **[HELP.md](HELP.md)** guide for solutions to common problems:
- Installation issues
- Database connection problems
- Asset compilation errors
- Permission issues
- And more...

### Getting Help
- **Documentation**: Start with our comprehensive [HELP.md](HELP.md) guide
- **GitHub Issues**: [Report bugs or request features](https://github.com/kasunvimarshana/MJLA/issues)
- **GitHub Discussions**: [Ask questions or share ideas](https://github.com/kasunvimarshana/MJLA/discussions)
- **Email**: support@mjla.edu
- **Phone**: +94 XX XXX XXXX

### For Contributors
Want to contribute? Please read our [CONTRIBUTING.md](CONTRIBUTING.md) guide and follow our [CODE_OF_CONDUCT.md](CODE_OF_CONDUCT.md).

## Acknowledgments

- Laravel Framework
- Tailwind CSS
- Alpine.js
- PHP Community
- All our Contributors

## License

This project is licensed under the MIT License - see the LICENSE file for details.

---

**Version:** 1.0.0  
**Last Updated:** November 2025  
**Maintained by:** MJLA Development Team
