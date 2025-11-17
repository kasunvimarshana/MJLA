# CMS Technical Documentation

## Architecture Overview

### System Design

The CMS follows a layered architecture pattern:

```
┌─────────────────────────────────────────────┐
│          Presentation Layer (Views)         │
│     - Blade Templates                       │
│     - Tailwind CSS                          │
│     - Alpine.js                             │
└─────────────────────────────────────────────┘
                    ↓
┌─────────────────────────────────────────────┐
│       Application Layer (Controllers)       │
│     - AdminMiddleware                       │
│     - PermissionMiddleware                  │
│     - Controllers                           │
└─────────────────────────────────────────────┘
                    ↓
┌─────────────────────────────────────────────┐
│         Business Logic (Services)           │
│     - CourseService                         │
│     - Caching                               │
│     - Business Rules                        │
└─────────────────────────────────────────────┘
                    ↓
┌─────────────────────────────────────────────┐
│       Data Access (Repositories)            │
│     - CourseRepository                      │
│     - Query Building                        │
│     - Data Filtering                        │
└─────────────────────────────────────────────┘
                    ↓
┌─────────────────────────────────────────────┐
│          Persistence (Models/DB)            │
│     - Eloquent Models                       │
│     - SQLite/MySQL/PostgreSQL               │
└─────────────────────────────────────────────┘
```

## Authentication & Authorization

### Authentication Flow

1. User visits `/admin`
2. `AdminMiddleware` checks authentication
3. If not authenticated, redirect to `/login`
4. User submits credentials
5. Laravel Breeze validates credentials
6. Session created
7. User redirected to dashboard

### Authorization Flow

1. User attempts action (e.g., create course)
2. `PermissionMiddleware` checks user permissions
3. User model queries relationships: User → Roles → Permissions
4. If permission exists, allow action
5. If not, return 403 Forbidden

### Middleware Stack

```php
// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/admin', [DashboardController::class, 'index']);
    
    // Courses with permission checking
    Route::middleware(['permission:courses.create'])
        ->post('/admin/courses', [CourseController::class, 'store']);
});
```

## Database Schema

### Users Table
```sql
CREATE TABLE users (
    id BIGINT PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255),
    remember_token VARCHAR(100),
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    deleted_at TIMESTAMP NULL
);
```

### Roles Table
```sql
CREATE TABLE roles (
    id BIGINT PRIMARY KEY,
    name VARCHAR(255) UNIQUE,
    display_name VARCHAR(255),
    description TEXT,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### Permissions Table
```sql
CREATE TABLE permissions (
    id BIGINT PRIMARY KEY,
    name VARCHAR(255) UNIQUE,
    display_name VARCHAR(255),
    description TEXT,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### Pivot Tables

**role_user:**
```sql
CREATE TABLE role_user (
    id BIGINT PRIMARY KEY,
    user_id BIGINT,
    role_id BIGINT,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    UNIQUE(user_id, role_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
);
```

**permission_role:**
```sql
CREATE TABLE permission_role (
    id BIGINT PRIMARY KEY,
    permission_id BIGINT,
    role_id BIGINT,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    UNIQUE(permission_id, role_id),
    FOREIGN KEY (permission_id) REFERENCES permissions(id) ON DELETE CASCADE,
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
);
```

### Courses Table
```sql
CREATE TABLE courses (
    id BIGINT PRIMARY KEY,
    title VARCHAR(255),
    slug VARCHAR(255) UNIQUE,
    description TEXT,
    level VARCHAR(255),
    duration_weeks INTEGER,
    price DECIMAL(10,2),
    max_students INTEGER NULL,
    is_active BOOLEAN DEFAULT TRUE,
    is_featured BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    deleted_at TIMESTAMP NULL
);
```

## Models & Relationships

### User Model

```php
class User extends Authenticatable
{
    // Relationships
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    
    // Helper Methods
    public function hasRole(string $role): bool
    public function hasAnyRole(array $roles): bool
    public function hasPermission(string $permission): bool
    public function hasAnyPermission(array $permissions): bool
}
```

### Role Model

```php
class Role extends Model
{
    // Relationships
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
    
    // Helper Methods
    public function hasPermission(string $permission): bool
}
```

### Permission Model

```php
class Permission extends Model
{
    // Relationships
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
```

## Services & Repositories

### Service Pattern

Services encapsulate business logic and interact with repositories:

```php
class CourseService extends BaseService
{
    public function __construct(CourseRepository $repository)
    {
        parent::__construct($repository);
    }
    
    // Business logic methods
    public function getActiveCourses(): Collection
    public function getFeaturedCourses(): Collection
    public function getCoursesByLevel(string $level): Collection
    public function getBySlug(string $slug): ?Course
}
```

### Repository Pattern

Repositories handle data access:

```php
class CourseRepository extends BaseRepository
{
    protected function model(): string
    {
        return Course::class;
    }
    
    // Data access methods
    public function getActive(): Collection
    public function getFeatured(): Collection
    public function getByLevel(string $level): Collection
    public function findBySlug(string $slug): ?Course
}
```

### Base Classes

**BaseService:**
- Implements common CRUD operations
- Handles caching
- Transaction management
- Cache invalidation

**BaseRepository:**
- Implements common queries
- Pagination support
- Query filtering
- Criteria pattern

## Caching Strategy

### Cache Keys

Pattern: `{model}.{identifier}`

Examples:
- `courses.all`
- `courses.active`
- `courses.featured`
- `courses.slug.beginner-japanese-n5`

### Cache Duration

- **Default TTL:** 3600 seconds (1 hour)
- **Configurable** via `BaseService::$cacheTime`

### Cache Invalidation

Automatic invalidation on:
- Create
- Update
- Delete

```php
// In BaseService
protected function clearCache(): void
{
    Cache::tags([$this->getCacheTag()])->flush();
}
```

## Admin Controllers

### Dashboard Controller

Displays overview statistics:

```php
public function index()
{
    $stats = [
        'courses' => Course::count(),
        'news' => News::count(),
        'contacts' => Contact::where('status', 'new')->count(),
        // ...
    ];
    
    return view('admin.dashboard', compact('stats'));
}
```

### Course Controller

CRUD operations for courses:

```php
class CourseController extends Controller
{
    public function __construct(CourseService $courseService)
    public function index()
    public function create()
    public function store(StoreCourseRequest $request)
    public function edit(Course $course)
    public function update(UpdateCourseRequest $request, Course $course)
    public function destroy(Course $course)
}
```

## Form Requests

### Validation

All input validated via Form Request classes:

```php
class StoreCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->hasPermission('courses.create');
    }
    
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'level' => 'required|string',
            'duration_weeks' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            // ...
        ];
    }
}
```

## Middleware

### AdminMiddleware

Protects admin routes:

```php
public function handle(Request $request, Closure $next): Response
{
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    if (!auth()->user()->hasPermission('dashboard.access')) {
        abort(403, 'Unauthorized access to admin area.');
    }

    return $next($request);
}
```

### PermissionMiddleware

Checks specific permissions:

```php
public function handle(Request $request, Closure $next, string $permission): Response
{
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    if (!auth()->user()->hasPermission($permission)) {
        abort(403, 'You do not have permission to perform this action.');
    }

    return $next($request);
}
```

## Views & Components

### Admin Layout

Base layout for all admin pages:

```blade
@extends('admin.layouts.app')

@section('title', 'Page Title')
@section('header', 'Page Header')

@section('header-actions')
    <!-- Action buttons -->
@endsection

@section('content')
    <!-- Page content -->
@endsection
```

### Components

Reusable Blade components:

- `<x-application-logo />`
- `<x-dropdown />`
- `<x-nav-link />`
- `<x-primary-button />`
- `<x-text-input />`
- `<x-input-error />`

## Security Features

### 1. CSRF Protection

All forms protected by CSRF tokens:

```blade
<form method="POST" action="{{ route('admin.courses.store') }}">
    @csrf
    <!-- Form fields -->
</form>
```

### 2. XSS Protection

Blade automatically escapes output:

```blade
{{ $course->title }} <!-- Safe -->
{!! $html !!} <!-- Unsafe, use with caution -->
```

### 3. SQL Injection Protection

Eloquent ORM prevents SQL injection:

```php
// Safe - uses parameter binding
Course::where('title', $request->input('title'))->get();

// Unsafe - never use
DB::raw("SELECT * FROM courses WHERE title = '$title'");
```

### 4. Mass Assignment Protection

Models define fillable fields:

```php
protected $fillable = [
    'title',
    'slug',
    'description',
    // ...
];
```

### 5. Authorization

All actions protected by permissions:

```php
Route::middleware(['permission:courses.edit'])
    ->put('/admin/courses/{course}', [CourseController::class, 'update']);
```

## Performance Optimization

### 1. Query Caching

Frequently accessed data cached:

```php
Cache::remember(
    'courses.active',
    3600,
    fn() => Course::where('is_active', true)->get()
);
```

### 2. Eager Loading

Prevent N+1 queries:

```php
$courses = Course::with(['instructor', 'category'])->get();
```

### 3. Database Indexes

Indexes on frequently queried columns:

```php
$table->string('slug')->unique();
$table->index('is_active');
$table->index('level');
```

### 4. Pagination

Large datasets paginated:

```php
$courses = Course::latest()->paginate(15);
```

## Testing

### Feature Tests

Test HTTP requests:

```php
public function test_admin_can_create_course()
{
    $admin = User::factory()->create();
    $admin->roles()->attach(Role::where('name', 'super-admin')->first());
    
    $response = $this->actingAs($admin)
        ->post(route('admin.courses.store'), [
            'title' => 'Test Course',
            // ...
        ]);
    
    $response->assertRedirect();
    $this->assertDatabaseHas('courses', ['title' => 'Test Course']);
}
```

### Unit Tests

Test business logic:

```php
public function test_user_has_permission()
{
    $user = User::factory()->create();
    $role = Role::factory()->create();
    $permission = Permission::factory()->create(['name' => 'courses.view']);
    
    $role->permissions()->attach($permission);
    $user->roles()->attach($role);
    
    $this->assertTrue($user->hasPermission('courses.view'));
}
```

## Deployment

### Production Checklist

```bash
# 1. Install dependencies
composer install --optimize-autoloader --no-dev

# 2. Configure environment
cp .env.example .env
php artisan key:generate

# 3. Run migrations
php artisan migrate --force

# 4. Seed roles and permissions
php artisan db:seed --class=RolesAndPermissionsSeeder

# 5. Optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 6. Build assets
npm run build

# 7. Set permissions
chmod -R 755 storage bootstrap/cache
```

### Environment Variables

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=mjla
DB_USERNAME=root
DB_PASSWORD=secret

CACHE_STORE=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis
```

## Extending the CMS

### Adding New Module

1. Create migration
2. Create model with relationships
3. Create repository
4. Create service
5. Create form requests
6. Create admin controller
7. Add routes
8. Create views
9. Add permissions to seeder
10. Write tests

### Example: Adding News Module

```bash
# 1. Migration
php artisan make:migration create_news_table

# 2. Model
php artisan make:model News

# 3. Repository
php artisan make:class Repositories/NewsRepository

# 4. Service
php artisan make:class Services/NewsService

# 5. Form Requests
php artisan make:request News/StoreNewsRequest
php artisan make:request News/UpdateNewsRequest

# 6. Controller
php artisan make:controller Admin/NewsController --resource

# 7. Routes (in routes/admin.php)
Route::resource('news', NewsController::class);

# 8. Views
# Create resources/views/admin/news/{index,create,edit}.blade.php

# 9. Permissions
# Add to RolesAndPermissionsSeeder

# 10. Tests
php artisan make:test NewsTest
```

## Troubleshooting

### Common Issues

**1. Permission Denied**
- Check user has correct role
- Verify role has required permission
- Clear cache: `php artisan cache:clear`

**2. Views Not Updating**
- Clear view cache: `php artisan view:clear`
- Check file permissions

**3. Database Connection Failed**
- Verify .env configuration
- Check database server is running
- Test connection: `php artisan tinker` → `DB::connection()->getPdo()`

**4. Cache Issues**
- Clear all caches: `php artisan optimize:clear`
- Check cache driver configuration
- Verify cache directory permissions

## Best Practices

1. **Always use Form Requests** for validation
2. **Never bypass middleware** in routes
3. **Use soft deletes** for important data
4. **Implement logging** for critical actions
5. **Write tests** for new features
6. **Document** complex logic
7. **Follow PSR-12** coding standards
8. **Use type declarations** everywhere
9. **Handle exceptions** gracefully
10. **Keep controllers thin** - logic in services

---

**Version:** 1.0.0  
**Last Updated:** November 2025  
**Maintained by:** MJLA Development Team
