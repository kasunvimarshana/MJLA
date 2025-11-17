# CMS User Guide - Majime Japanese Language Academy

## Table of Contents
1. [Introduction](#introduction)
2. [Getting Started](#getting-started)
3. [User Roles and Permissions](#user-roles-and-permissions)
4. [Admin Dashboard](#admin-dashboard)
5. [Managing Courses](#managing-courses)
6. [User Management](#user-management)
7. [Troubleshooting](#troubleshooting)

## Introduction

The Majime Japanese Language Academy CMS is a comprehensive content management system built with Laravel 11, featuring role-based access control, a modern admin interface, and complete content management capabilities.

## Getting Started

### Accessing the Admin Panel

1. Navigate to `/login` or `/admin` (will redirect to login)
2. Enter your credentials
3. Click "Log in"

### Default Credentials

**Super Administrator:**
- Email: `admin@mjla.edu`
- Password: `password`

⚠️ **Important:** Change the default password immediately after first login!

### Changing Your Password

1. Click on your name in the top right corner
2. Select "Profile"
3. Navigate to "Update Password"
4. Enter current password and new password
5. Click "Save"

## User Roles and Permissions

### Available Roles

#### 1. Super Administrator
- **Full system access** with all permissions
- Can manage roles and permissions
- Can create/edit/delete all content
- Can manage users

#### 2. Administrator
- Can manage most content
- Cannot manage roles and permissions
- Can create/edit/delete content across all modules
- Can view users

#### 3. Editor
- Can create and edit content
- Can view all content
- Cannot delete content
- Cannot manage users

#### 4. Viewer
- Can only view content in dashboard
- Read-only access
- Cannot create, edit, or delete

### Permission Structure

Permissions follow the pattern: `module.action`

Examples:
- `courses.view` - View courses
- `courses.create` - Create new courses
- `courses.edit` - Edit existing courses
- `courses.delete` - Delete courses
- `dashboard.access` - Access admin dashboard

## Admin Dashboard

### Overview

The admin dashboard provides:

1. **Statistics Cards**
   - Total Courses
   - News Articles
   - New Contacts
   - Total Users

2. **Recent Activity**
   - Recent Contact Submissions
   - Recent Admission Requests

### Navigation

**Main Menu:**
- Dashboard - Overview and statistics
- Courses - Manage course content
- View Site - Opens public website in new tab

**User Menu (Top Right):**
- Profile - Update your profile and password
- Log Out - End your session

## Managing Courses

### Listing Courses

1. Click "Courses" in the main navigation
2. View all courses with:
   - Title and slug
   - Level (Beginner, Intermediate, Advanced, JLPT N1-N5)
   - Duration in weeks
   - Price in LKR
   - Status (Active/Inactive, Featured)

### Creating a New Course

1. Click "Add New Course" button
2. Fill in required fields:
   - **Title*** (required) - Course name
   - **Level*** (required) - Select from dropdown
   - **Duration*** (required) - Number of weeks
   - **Price*** (required) - Price in Sri Lankan Rupees
   - **Max Students** (optional) - Maximum enrollment
   - **Description*** (required) - Full course description
   - **Active** - Check to make course visible on website
   - **Featured** - Check to feature on homepage

3. Click "Create Course"

### Editing a Course

1. Find the course in the list
2. Click "Edit" in the Actions column
3. Modify desired fields
4. Click "Update Course"

### Deleting a Course

1. Find the course in the list
2. Click "Delete" in the Actions column
3. Confirm deletion in the popup
4. Course will be soft-deleted (can be restored if needed)

### Course Slugs

- Automatically generated from title
- Used in URLs (e.g., `/courses/beginner-japanese-n5`)
- Unique per course
- Updated when title changes

## User Management

### Managing Users (Super Admin/Admin only)

User management will be added in future updates. Currently:

1. Users can be created via registration
2. Roles must be assigned via database seeder or console
3. Super Admin can manage all users

### Assigning Roles

Via Tinker (for administrators):
```bash
php artisan tinker

# Get user
$user = App\Models\User::where('email', 'user@example.com')->first();

# Get role
$role = App\Models\Role::where('name', 'editor')->first();

# Assign role
$user->roles()->attach($role->id);

# Or sync (replace all roles)
$user->roles()->sync([$role->id]);
```

## Troubleshooting

### "Unauthorized access" Error

**Cause:** You don't have permission to access that feature.

**Solution:** Contact your administrator to request appropriate permissions.

### Can't Log In

**Cause:** Incorrect credentials or account locked.

**Solutions:**
1. Check caps lock is off
2. Use "Forgot Password" link
3. Contact administrator

### Changes Not Showing on Public Site

**Cause:** Cache might be enabled.

**Solutions:**
1. Check if course is marked as "Active"
2. Clear cache: `php artisan cache:clear`
3. Check if changes were saved successfully

### Dashboard Statistics Not Updating

**Cause:** Page might be cached.

**Solution:** Refresh the page (Ctrl+F5 or Cmd+Shift+R)

## Advanced Features

### Permissions System

The CMS uses a flexible permission system:

- Permissions are attached to roles
- Users inherit permissions from their roles
- Multiple roles can be assigned to one user
- Permissions are checked at middleware level

### Soft Deletes

All content uses soft deletes:

- Deleted items are not permanently removed
- Can be restored if needed
- Keeps data integrity
- Useful for audit trails

### Caching

Content is cached for performance:

- Cache duration: 1 hour
- Automatically cleared on updates
- Can be manually cleared if needed

## Security Best Practices

1. **Change Default Password**
   - Use strong, unique password
   - Minimum 8 characters
   - Mix of letters, numbers, symbols

2. **Regular Updates**
   - Keep your password updated
   - Review your permissions regularly
   - Log out when not in use

3. **Be Careful with Permissions**
   - Only request permissions you need
   - Don't share login credentials
   - Report suspicious activity

## Getting Help

### Support Channels

1. **Technical Issues:** support@mjla.edu
2. **Permission Requests:** Contact your administrator
3. **Feature Requests:** Submit via GitHub issues

### Useful Commands (For Developers)

```bash
# Create new admin user
php artisan tinker
User::create([
    'name' => 'Admin Name',
    'email' => 'admin@example.com',
    'password' => Hash::make('password'),
    'email_verified_at' => now(),
]);

# Assign super-admin role
$user = User::where('email', 'admin@example.com')->first();
$role = Role::where('name', 'super-admin')->first();
$user->roles()->attach($role->id);

# Seed roles and permissions
php artisan db:seed --class=RolesAndPermissionsSeeder

# Clear caches
php artisan cache:clear
php artisan view:clear
php artisan route:clear
php artisan config:clear
```

## Keyboard Shortcuts

- **Alt + D** - Go to Dashboard
- **Alt + C** - Go to Courses
- **Esc** - Close modals/dropdowns
- **Tab** - Navigate form fields
- **Enter** - Submit forms

## Browser Support

The admin panel supports:

- Chrome 90+
- Firefox 88+
- Safari 14+
- Edge 90+
- Opera 76+

## Mobile Access

The admin panel is responsive and works on:

- Tablets (iPad, Android tablets)
- Large phones (in landscape mode)
- For best experience, use desktop or tablet

## Accessibility

The CMS follows accessibility standards:

- Keyboard navigation supported
- Screen reader compatible
- High contrast mode available
- ARIA labels on interactive elements

## Data Export/Import

Currently not available. Future versions will include:

- Export courses to CSV/JSON
- Import courses from spreadsheet
- Bulk operations
- Data backup tools

---

**Version:** 1.0.0  
**Last Updated:** November 2025  
**Maintained by:** MJLA Development Team
