<?php

use App\Http\Controllers\ChapterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseStudentController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\LessonPdfController;
use App\Http\Controllers\LessonVideoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TopicController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/courses', CourseController::class);
Route::resource('/chapters', ChapterController::class);
Route::resource('/topics', TopicController::class);
Route::resource('/lessons', LessonController::class);
Route::resource('/lesson-videos', LessonVideoController::class);
Route::resource('/lesson-pdfs', LessonPdfController::class);

Route::resource('/students', StudentController::class);
Route::resource('/course-students', CourseStudentController::class);
Route::resource('/instructors', InstructorController::class);

require __DIR__.'/auth.php';
