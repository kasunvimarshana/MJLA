<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\StoreCourseRequest;
use App\Http\Requests\Course\UpdateCourseRequest;
use App\Services\CourseService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CourseController extends Controller
{
    /**
     * CourseController constructor.
     */
    public function __construct(
        protected CourseService $courseService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $courses = $this->courseService->getPaginated(12);

        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request): RedirectResponse
    {
        $course = $this->courseService->create($request->validated());

        return redirect()
            ->route('courses.show', $course->slug)
            ->with('success', 'Course created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug): View
    {
        $course = $this->courseService->getBySlug($slug);

        if (! $course) {
            abort(404);
        }

        return view('courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug): View
    {
        $course = $this->courseService->getBySlug($slug);

        if (! $course) {
            abort(404);
        }

        return view('courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, string $slug): RedirectResponse
    {
        $course = $this->courseService->getBySlug($slug);

        if (! $course) {
            abort(404);
        }

        $this->courseService->update($course->id, $request->validated());

        return redirect()
            ->route('courses.show', $course->slug)
            ->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug): RedirectResponse
    {
        $course = $this->courseService->getBySlug($slug);

        if (! $course) {
            abort(404);
        }

        $this->courseService->delete($course->id);

        return redirect()
            ->route('courses.index')
            ->with('success', 'Course deleted successfully.');
    }
}
