<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Course;
use App\Models\News;
use App\Models\Staff;
use App\Models\VisaService;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate XML sitemap for the website.
     */
    public function index(): Response
    {
        $courses = Course::active()->get();
        $news = News::active()->get();
        $staff = Staff::active()->get();
        $visaServices = VisaService::active()->get();
        $blogPosts = BlogPost::active()->get();

        $sitemap = view('sitemap.index', compact(
            'courses',
            'news',
            'staff',
            'visaServices',
            'blogPosts'
        ))->render();

        return response($sitemap, 200)
            ->header('Content-Type', 'application/xml');
    }
}
