<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\LocaleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Locale switching
Route::get('/locale/{locale}', [LocaleController::class, 'switch'])->name('locale.switch');

// Course routes
Route::resource('courses', CourseController::class)
    ->parameters(['courses' => 'slug']);
