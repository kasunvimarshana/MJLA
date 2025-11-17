<?php

namespace App\Http\Controllers;

use App\Services\FaqService;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function __construct(
        protected FaqService $faqService
    ) {}

    /**
     * Display a listing of FAQs.
     */
    public function index(): View
    {
        $faqs = $this->faqService->getRepository()->getPublished();
        $categories = $faqs->pluck('category')->unique()->sort();

        return view('faqs.index', compact('faqs', 'categories'));
    }
}
