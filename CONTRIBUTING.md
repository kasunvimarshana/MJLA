# Contributing to MJLA

Thank you for your interest in contributing to Majime Japanese Language Academy (MJLA)! We welcome contributions from the community.

## How Can I Contribute?

### Reporting Bugs

Before creating bug reports, please check the existing issues to avoid duplicates. When creating a bug report, please include:

- **A clear and descriptive title**
- **Steps to reproduce the issue**
- **Expected behavior**
- **Actual behavior**
- **Screenshots** (if applicable)
- **Your environment** (OS, PHP version, Laravel version, etc.)

### Suggesting Enhancements

Enhancement suggestions are tracked as GitHub issues. When creating an enhancement suggestion, please include:

- **A clear and descriptive title**
- **A detailed description of the proposed enhancement**
- **Why this enhancement would be useful**
- **Examples of how it would work**

### Pull Requests

1. **Fork the repository** and create your branch from `main`
2. **Follow the coding standards** (PSR-12, Laravel best practices)
3. **Write tests** for new features or bug fixes
4. **Update documentation** if you're changing functionality
5. **Ensure tests pass** by running `./vendor/bin/phpunit`
6. **Run code formatter** with `./vendor/bin/pint`
7. **Write clear commit messages**

## Development Setup

### Prerequisites
- PHP 8.2+
- Composer
- Node.js & NPM
- SQLite/MySQL/PostgreSQL

### Setup Steps

1. Clone your fork:
```bash
git clone https://github.com/YOUR-USERNAME/MJLA.git
cd MJLA
```

2. Install dependencies:
```bash
composer install
npm install
```

3. Configure environment:
```bash
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
```

4. Run migrations:
```bash
php artisan migrate
```

5. Build assets:
```bash
npm run build
```

6. Start development server:
```bash
php artisan serve
```

## Coding Standards

### PHP
- Follow **PSR-12** coding standard
- Use **type declarations** for parameters and return types
- Write **DocBlocks** for classes and complex methods
- Keep methods **small and focused** (Single Responsibility Principle)
- Use **meaningful variable names**

### Laravel Conventions
- Follow the **Service-Repository pattern** used in the codebase
- Use **FormRequests** for validation
- Use **Eloquent** relationships and scopes
- Use **resource routes** where appropriate
- Keep controllers **thin** (business logic in services)

### Frontend
- Follow **Tailwind CSS** utility-first approach
- Use **Alpine.js** for interactive components
- Keep JavaScript **minimal** and progressive enhancement focused
- Ensure **mobile-first** responsive design

## Testing

### Running Tests
```bash
# Run all tests
./vendor/bin/phpunit

# Run specific test file
./vendor/bin/phpunit tests/Feature/CourseTest.php

# Run with coverage
./vendor/bin/phpunit --coverage-html coverage/
```

### Writing Tests
- Write **feature tests** for HTTP endpoints
- Write **unit tests** for business logic
- Use **database transactions** for test isolation
- Mock external services
- Aim for **high code coverage**

## Code Formatting

We use Laravel Pint for code formatting:

```bash
# Format all files
./vendor/bin/pint

# Check without modifying
./vendor/bin/pint --test
```

## Git Commit Messages

- Use the **present tense** ("Add feature" not "Added feature")
- Use the **imperative mood** ("Move cursor to..." not "Moves cursor to...")
- Limit the first line to **72 characters** or less
- Reference **issues and pull requests** liberally after the first line

Example:
```
Add course search functionality

- Implement search by title and description
- Add search form to courses index page
- Add tests for search functionality

Closes #123
```

## Module Development

When adding a new module, follow this structure:

1. **Migration**: Create database table
2. **Model**: With fillable, casts, relationships, scopes
3. **Repository**: Implement RepositoryInterface
4. **Service**: Implement ServiceInterface with caching
5. **FormRequests**: For validation
6. **Controller**: Thin, delegates to service
7. **Routes**: RESTful routes
8. **Views**: Mobile-first, Tailwind CSS
9. **Tests**: Feature and unit tests

Example structure:
```
app/
├── Models/ModuleName.php
├── Repositories/
│   ├── Contracts/ModuleNameRepositoryInterface.php
│   └── ModuleNameRepository.php
├── Services/
│   ├── Contracts/ModuleNameServiceInterface.php
│   └── ModuleNameService.php
├── Http/
│   ├── Controllers/ModuleNameController.php
│   └── Requests/ModuleName/
│       ├── StoreModuleNameRequest.php
│       └── UpdateModuleNameRequest.php
resources/views/module-name/
tests/Feature/ModuleNameTest.php
```

## Documentation

- Update **README.md** for new features
- Update **ARCHITECTURE.md** for architectural changes
- Update **DEPLOYMENT.md** for deployment-related changes
- Add **inline comments** for complex logic
- Update **API documentation** for new endpoints

## Questions?

If you have questions about contributing, please:
- Check the [README.md](README.md)
- Review [ARCHITECTURE.md](ARCHITECTURE.md)
- Open a [GitHub Discussion](https://github.com/kasunvimarshana/MJLA/discussions)
- Contact the maintainers

## Code of Conduct

This project adheres to a Code of Conduct. By participating, you are expected to uphold this code. Please report unacceptable behavior to the project maintainers.

## License

By contributing to MJLA, you agree that your contributions will be licensed under the MIT License.

---

Thank you for contributing to MJLA! 🎌
