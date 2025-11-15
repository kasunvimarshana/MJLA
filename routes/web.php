<?php

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Course routes
Route::resource('courses', CourseController::class)
    ->parameters(['courses' => 'slug']);
