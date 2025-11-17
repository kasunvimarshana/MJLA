<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create courses
        \App\Models\Course::factory(15)->create();

        // Create language programs
        \App\Models\LanguageProgram::factory(8)->create();

        // Create visa services
        \App\Models\VisaService::factory(10)->create();

        // Create news and events
        \App\Models\News::factory(20)->create();

        // Create staff members
        \App\Models\Staff::factory(12)->create();

        // Create blog posts
        \App\Models\BlogPost::factory(25)->create();

        // Create gallery items
        \App\Models\GalleryItem::factory(30)->create();

        // Create testimonials
        \App\Models\Testimonial::factory(20)->create();

        // Create FAQs
        \App\Models\Faq::factory(30)->create();

        // Create admissions
        \App\Models\Admission::factory(50)->create();
    }
}
