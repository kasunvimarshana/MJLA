<?php

namespace App\Http\Controllers;

use App\Services\TestimonialService;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function __construct(
        protected TestimonialService $testimonialService
    ) {}

    /**
     * Display a listing of testimonials.
     */
    public function index(): View
    {
        $testimonials = $this->testimonialService->getPaginated(12);
        $featured = $this->testimonialService->getRepository()->getFeatured();

        return view('testimonials.index', compact('testimonials', 'featured'));
    }
}
