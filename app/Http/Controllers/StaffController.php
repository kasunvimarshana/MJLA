<?php

namespace App\Http\Controllers;

use App\Services\StaffService;
use Illuminate\View\View;

class StaffController extends Controller
{
    public function __construct(
        protected StaffService $staffService
    ) {}

    /**
     * Display a listing of staff members.
     */
    public function index(): View
    {
        $staff = $this->staffService->getRepository()->getActive();
        $featured = $this->staffService->getRepository()->getFeatured();

        return view('staff.index', compact('staff', 'featured'));
    }

    /**
     * Display the specified staff member.
     */
    public function show(string $slug): View
    {
        $staffMember = $this->staffService->getRepository()->findBySlug($slug);
        
        if (!$staffMember) {
            abort(404);
        }

        return view('staff.show', compact('staffMember'));
    }
}
