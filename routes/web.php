<?php

use App\Http\Controllers\Admin\ChapterController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\CourseStudentController;
use App\Http\Controllers\Admin\InstructorController;
use App\Http\Controllers\Admin\LessonArticleController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\LessonPdfController;
use App\Http\Controllers\Admin\LessonVideoController;
use App\Http\Controllers\Admin\PracticeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TopicController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('public.homepage.index');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard.index');
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
Route::resource('/lesson-articles', LessonArticleController::class);
Route::resource('/practices', PracticeController::class);
Route::resource('/students', StudentController::class);
Route::resource('/course-students', CourseStudentController::class);
Route::resource('/instructors', InstructorController::class);

require __DIR__.'/auth.php';
