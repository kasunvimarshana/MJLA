<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEnrollmentRequest;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EnrollmentController extends Controller
{
    /**
     * Show the enrollment form for a specific course.
     */
    public function create(string $slug): View
    {
        $course = Course::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('enrollments.create', compact('course'));
    }

    /**
     * Store a newly created enrollment.
     */
    public function store(StoreEnrollmentRequest $request): RedirectResponse
    {
        $enrollment = Enrollment::create([
            ...$request->validated(),
            'status' => 'pending',
            'enrollment_date' => now(),
        ]);

        // TODO: Send notification email to admin and student

        return redirect()
            ->route('courses.show', $enrollment->course->slug)
            ->with('success', __('Your enrollment request has been submitted successfully. We will contact you soon.'));
    }
}
