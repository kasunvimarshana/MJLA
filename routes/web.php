<?php

use App\Http\Controllers\ConsultationRequestController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\VisaServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Locale switching
Route::get('/locale/{locale}', [LocaleController::class, 'switch'])->name('locale.switch');

// Contact routes
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

// Course routes
Route::resource('courses', CourseController::class)
    ->parameters(['courses' => 'slug']);

// Enrollment routes
Route::get('/courses/{slug}/enroll', [EnrollmentController::class, 'create'])->name('enrollments.create');
Route::post('/enrollments', [EnrollmentController::class, 'store'])->name('enrollments.store')->middleware('throttle:3,60');

// Consultation request routes
Route::get('/consultation-request/{slug?}', [ConsultationRequestController::class, 'create'])->name('consultation-requests.create');
Route::post('/consultation-requests', [ConsultationRequestController::class, 'store'])->name('consultation-requests.store')->middleware('throttle:3,60');

// Testimonials routes
Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');

// FAQs routes
Route::get('/faqs', [FaqController::class, 'index'])->name('faqs.index');

// Visa Services routes
Route::get('/visa-services', [VisaServiceController::class, 'index'])->name('visa-services.index');
Route::get('/visa-services/{slug}', [VisaServiceController::class, 'show'])->name('visa-services.show');

// News & Events routes
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

// Staff routes
Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
Route::get('/staff/{slug}', [StaffController::class, 'show'])->name('staff.show');
