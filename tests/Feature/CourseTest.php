<?php

namespace Tests\Feature;

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseTest extends TestCase
{
    use RefreshDatabase;

    public function test_courses_index_page_loads(): void
    {
        $response = $this->get(route('courses.index'));

        $response->assertStatus(200);
        $response->assertViewIs('courses.index');
    }

    public function test_course_can_be_created(): void
    {
        $courseData = [
            'title' => 'Beginner Japanese Course',
            'description' => 'Learn Japanese from scratch',
            'level' => 'beginner',
            'price' => 50000,
            'duration_weeks' => 12,
            'is_active' => true,
        ];

        $course = Course::create($courseData);

        $this->assertDatabaseHas('courses', [
            'title' => 'Beginner Japanese Course',
            'level' => 'beginner',
        ]);
        
        $this->assertNotNull($course->slug);
    }

    public function test_course_show_page_displays_course(): void
    {
        $course = Course::create([
            'title' => 'Advanced Japanese',
            'slug' => 'advanced-japanese',
            'level' => 'advanced',
            'price' => 80000,
            'is_active' => true,
        ]);

        $response = $this->get(route('courses.show', $course->slug));

        $response->assertStatus(200);
        $response->assertSee('Advanced Japanese');
        $response->assertViewIs('courses.show');
    }

    public function test_only_active_courses_shown_in_scope(): void
    {
        Course::create([
            'title' => 'Active Course',
            'level' => 'beginner',
            'price' => 50000,
            'is_active' => true,
        ]);

        Course::create([
            'title' => 'Inactive Course',
            'level' => 'beginner',
            'price' => 50000,
            'is_active' => false,
        ]);

        $activeCourses = Course::active()->get();

        $this->assertCount(1, $activeCourses);
        $this->assertEquals('Active Course', $activeCourses->first()->title);
    }

    public function test_featured_courses_scope_works(): void
    {
        Course::create([
            'title' => 'Featured Course',
            'level' => 'intermediate',
            'price' => 60000,
            'is_active' => true,
            'is_featured' => true,
        ]);

        Course::create([
            'title' => 'Regular Course',
            'level' => 'intermediate',
            'price' => 60000,
            'is_active' => true,
            'is_featured' => false,
        ]);

        $featuredCourses = Course::featured()->get();

        $this->assertCount(1, $featuredCourses);
        $this->assertEquals('Featured Course', $featuredCourses->first()->title);
    }
}
