<?php

namespace App\Http\Controllers;

use App\Services\VisaServiceService;
use Illuminate\View\View;

class VisaServiceController extends Controller
{
    public function __construct(
        protected VisaServiceService $visaServiceService
    ) {}

    /**
     * Display a listing of visa services.
     */
    public function index(): View
    {
        $services = $this->visaServiceService->getRepository()->getActive();
        $featured = $this->visaServiceService->getRepository()->getFeatured();

        return view('visa-services.index', compact('services', 'featured'));
    }

    /**
     * Display the specified visa service.
     */
    public function show(string $slug): View
    {
        $service = $this->visaServiceService->getRepository()->findBySlug($slug);
        
        if (!$service) {
            abort(404);
        }

        return view('visa-services.show', compact('service'));
    }
}
