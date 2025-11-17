<?php

namespace App\Http\Controllers;

use App\Services\NewsService;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function __construct(
        protected NewsService $newsService
    ) {}

    /**
     * Display a listing of news and events.
     */
    public function index(): View
    {
        $news = $this->newsService->getPaginated(12);
        $featured = $this->newsService->getRepository()->getFeatured();

        return view('news.index', compact('news', 'featured'));
    }

    /**
     * Display the specified news item.
     */
    public function show(string $slug): View
    {
        $newsItem = $this->newsService->getRepository()->findBySlug($slug);

        if (! $newsItem) {
            abort(404);
        }

        return view('news.show', compact('newsItem'));
    }
}
