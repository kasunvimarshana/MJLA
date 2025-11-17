<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use App\Models\BlogPost;
use App\Models\Contact;
use App\Models\Course;
use App\Models\News;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        $stats = [
            'courses' => Course::count(),
            'news' => News::count(),
            'staff' => Staff::count(),
            'blog_posts' => BlogPost::count(),
            'contacts' => Contact::where('status', 'new')->count(),
            'admissions' => Admission::where('status', 'pending')->count(),
            'users' => User::count(),
        ];

        $recentContacts = Contact::latest()->limit(5)->get();
        $recentAdmissions = Admission::latest()->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'recentContacts', 'recentAdmissions'));
    }
}

