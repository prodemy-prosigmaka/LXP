<?php

// public

use App\Http\Controllers\Admin\ChapterController;
use App\Http\Controllers\Public\MyLearningController;
use App\Http\Controllers\Public\PublicCourseController;

// admin
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LessonArticleController;
use App\Http\Controllers\Admin\LessonPdfController;
use App\Http\Controllers\Admin\LessonVideoController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\TopicController;
use App\Http\Controllers\Admin\TopicSortController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserPasswordController;
use App\Http\Controllers\Public\InertiaExampleController;
use App\Http\Controllers\Public\LandingController;
use App\Http\Controllers\Public\LearningController;

// lib
use Illuminate\Support\Facades\Route;


/**
 * Public Routes
 */
Route::get("/",                     [LandingController::class, 'index'])->name('landing.index');
Route::get("/courses",              [PublicCourseController::class, 'index'])->name('courselist.index');
Route::get("/course/detail/{id}",   [PublicCourseController::class, 'show'])->name('courselist.detail');

Route::get("/my-learning",          [MyLearningController::class, 'index'])->name('mylearning');

Route::middleware('auth')->group(function ()
{
    Route::post("/my-learning/join",                        [MyLearningController::class, 'joinClass'])->name('mylearning.join');
    Route::get("/learning/{courseId}",                      [LearningController::class, 'index'])->name('learning.index');
    Route::get("/learning/{courseId}/article/{topicId}",    [LearningController::class, 'showArticle'])->name('learning.show.article');
    Route::get("/learning/{courseId}/pdf/{topicId}",        [LearningController::class, 'showPdf'])->name('learning.show.pdf');
    Route::get("/learning/{courseId}/video/{topicId}",      [LearningController::class, 'showVideo'])->name('learning.show.video');
});


/**
 * Admin Routes
 */
Route::middleware(['auth', 'role:admin|instructor'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function ()
    {
        Route::get('/dasboard',             [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('courses',          CourseController::class)->except('show');
        Route::resource('chapters',         ChapterController::class)->only('store', 'update', 'destroy');

        Route::patch('user-password/{user}',[UserPasswordController::class, 'update'])->name('user-password.update')->middleware('role:admin');
        Route::resource('users',            UserController::class)->middleware('role:admin');

        Route::patch('topic_sorts',         [TopicSortController::class, 'update'])->name('topic_sorts.update');

        Route::prefix('courses/{course}/chapters/{chapter}')->group(function () {
            Route::resource('topics',           TopicController::class)->except('index', 'show');
        });

        Route::prefix('courses/{course}')->group(function () {
            Route::resource('lesson_videos',    LessonVideoController::class)->only('store', 'update');
            Route::resource('lesson_pdfs',      LessonPdfController::class)->only('store', 'update');
            Route::resource('lesson_articles',  LessonArticleController::class)->only('store', 'update');
        });
    }
);

/**
 * Auth Lib Routes
 */
Route::middleware('auth')->group(function () {
    Route::get('/profile',      [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',    [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',   [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
