<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions
        $permissions = [
            // Course permissions
            ['name' => 'courses.view', 'display_name' => 'View Courses', 'description' => 'Can view courses'],
            ['name' => 'courses.create', 'display_name' => 'Create Courses', 'description' => 'Can create new courses'],
            ['name' => 'courses.edit', 'display_name' => 'Edit Courses', 'description' => 'Can edit existing courses'],
            ['name' => 'courses.delete', 'display_name' => 'Delete Courses', 'description' => 'Can delete courses'],
            
            // News permissions
            ['name' => 'news.view', 'display_name' => 'View News', 'description' => 'Can view news'],
            ['name' => 'news.create', 'display_name' => 'Create News', 'description' => 'Can create news'],
            ['name' => 'news.edit', 'display_name' => 'Edit News', 'description' => 'Can edit news'],
            ['name' => 'news.delete', 'display_name' => 'Delete News', 'description' => 'Can delete news'],
            
            // Staff permissions
            ['name' => 'staff.view', 'display_name' => 'View Staff', 'description' => 'Can view staff'],
            ['name' => 'staff.create', 'display_name' => 'Create Staff', 'description' => 'Can create staff'],
            ['name' => 'staff.edit', 'display_name' => 'Edit Staff', 'description' => 'Can edit staff'],
            ['name' => 'staff.delete', 'display_name' => 'Delete Staff', 'description' => 'Can delete staff'],
            
            // Blog permissions
            ['name' => 'blog.view', 'display_name' => 'View Blog Posts', 'description' => 'Can view blog posts'],
            ['name' => 'blog.create', 'display_name' => 'Create Blog Posts', 'description' => 'Can create blog posts'],
            ['name' => 'blog.edit', 'display_name' => 'Edit Blog Posts', 'description' => 'Can edit blog posts'],
            ['name' => 'blog.delete', 'display_name' => 'Delete Blog Posts', 'description' => 'Can delete blog posts'],
            
            // Visa Service permissions
            ['name' => 'visa-services.view', 'display_name' => 'View Visa Services', 'description' => 'Can view visa services'],
            ['name' => 'visa-services.create', 'display_name' => 'Create Visa Services', 'description' => 'Can create visa services'],
            ['name' => 'visa-services.edit', 'display_name' => 'Edit Visa Services', 'description' => 'Can edit visa services'],
            ['name' => 'visa-services.delete', 'display_name' => 'Delete Visa Services', 'description' => 'Can delete visa services'],
            
            // Gallery permissions
            ['name' => 'gallery.view', 'display_name' => 'View Gallery', 'description' => 'Can view gallery'],
            ['name' => 'gallery.create', 'display_name' => 'Create Gallery Items', 'description' => 'Can create gallery items'],
            ['name' => 'gallery.edit', 'display_name' => 'Edit Gallery Items', 'description' => 'Can edit gallery items'],
            ['name' => 'gallery.delete', 'display_name' => 'Delete Gallery Items', 'description' => 'Can delete gallery items'],
            
            // Testimonial permissions
            ['name' => 'testimonials.view', 'display_name' => 'View Testimonials', 'description' => 'Can view testimonials'],
            ['name' => 'testimonials.create', 'display_name' => 'Create Testimonials', 'description' => 'Can create testimonials'],
            ['name' => 'testimonials.edit', 'display_name' => 'Edit Testimonials', 'description' => 'Can edit testimonials'],
            ['name' => 'testimonials.delete', 'display_name' => 'Delete Testimonials', 'description' => 'Can delete testimonials'],
            
            // FAQ permissions
            ['name' => 'faqs.view', 'display_name' => 'View FAQs', 'description' => 'Can view FAQs'],
            ['name' => 'faqs.create', 'display_name' => 'Create FAQs', 'description' => 'Can create FAQs'],
            ['name' => 'faqs.edit', 'display_name' => 'Edit FAQs', 'description' => 'Can edit FAQs'],
            ['name' => 'faqs.delete', 'display_name' => 'Delete FAQs', 'description' => 'Can delete FAQs'],
            
            // Admission permissions
            ['name' => 'admissions.view', 'display_name' => 'View Admissions', 'description' => 'Can view admissions'],
            ['name' => 'admissions.edit', 'display_name' => 'Edit Admissions', 'description' => 'Can edit admissions'],
            ['name' => 'admissions.delete', 'display_name' => 'Delete Admissions', 'description' => 'Can delete admissions'],
            
            // Contact permissions
            ['name' => 'contacts.view', 'display_name' => 'View Contacts', 'description' => 'Can view contact submissions'],
            ['name' => 'contacts.delete', 'display_name' => 'Delete Contacts', 'description' => 'Can delete contact submissions'],
            
            // User management permissions
            ['name' => 'users.view', 'display_name' => 'View Users', 'description' => 'Can view users'],
            ['name' => 'users.create', 'display_name' => 'Create Users', 'description' => 'Can create users'],
            ['name' => 'users.edit', 'display_name' => 'Edit Users', 'description' => 'Can edit users'],
            ['name' => 'users.delete', 'display_name' => 'Delete Users', 'description' => 'Can delete users'],
            
            // Role and Permission management
            ['name' => 'roles.manage', 'display_name' => 'Manage Roles', 'description' => 'Can manage roles and permissions'],
            
            // Dashboard
            ['name' => 'dashboard.access', 'display_name' => 'Access Dashboard', 'description' => 'Can access admin dashboard'],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission['name']],
                $permission
            );
        }

        // Create roles
        $superAdmin = Role::firstOrCreate(
            ['name' => 'super-admin'],
            [
                'display_name' => 'Super Administrator',
                'description' => 'Full system access with all permissions',
            ]
        );

        $admin = Role::firstOrCreate(
            ['name' => 'admin'],
            [
                'display_name' => 'Administrator',
                'description' => 'Can manage most content',
            ]
        );

        $editor = Role::firstOrCreate(
            ['name' => 'editor'],
            [
                'display_name' => 'Content Editor',
                'description' => 'Can create and edit content',
            ]
        );

        $viewer = Role::firstOrCreate(
            ['name' => 'viewer'],
            [
                'display_name' => 'Content Viewer',
                'description' => 'Can only view content in dashboard',
            ]
        );

        // Assign all permissions to super-admin
        $superAdmin->permissions()->sync(Permission::all());

        // Assign permissions to admin (all except role management)
        $admin->permissions()->sync(
            Permission::whereNotIn('name', ['roles.manage'])->get()
        );

        // Assign permissions to editor (create, edit, view)
        $editor->permissions()->sync(
            Permission::where(function ($query) {
                $query->where('name', 'like', '%.create')
                    ->orWhere('name', 'like', '%.edit')
                    ->orWhere('name', 'like', '%.view')
                    ->orWhere('name', 'dashboard.access');
            })->get()
        );

        // Assign permissions to viewer (only view)
        $viewer->permissions()->sync(
            Permission::where(function ($query) {
                $query->where('name', 'like', '%.view')
                    ->orWhere('name', 'dashboard.access');
            })->get()
        );

        // Create default super admin user
        $superAdminUser = User::firstOrCreate(
            ['email' => 'admin@mjla.edu'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // Assign super-admin role
        $superAdminUser->roles()->sync([$superAdmin->id]);

        $this->command->info('Roles and permissions seeded successfully!');
        $this->command->info('Super Admin User Created:');
        $this->command->info('Email: admin@mjla.edu');
        $this->command->info('Password: password');
        $this->command->warn('Please change the password after first login!');
    }
}

