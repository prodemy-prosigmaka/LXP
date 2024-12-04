<?php

// public

use App\Http\Controllers\Admin\ChapterController;
use App\Http\Controllers\Public\MyLearningController;
use App\Http\Controllers\Public\PublicCourseController;

// admin
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Public\InertiaExampleController;
use App\Http\Controllers\Public\LearningController;

// lib
use Illuminate\Support\Facades\Route;


/**
 * Public Routes
 */
route::get("/", [PublicCourseController::class, 'index'])->name('courselist.index');
route::get("/course/detail/{id}", [PublicCourseController::class, 'show'])->name('courselist.detail');

route::get("/my-learning", [MyLearningController::class, 'index'])->name('mylearning');
route::post("/my-learning/join", [MyLearningController::class, 'joinClass'])->name('mylearning.join')->middleware('auth');

route::get("/learning/{courseId}", [LearningController::class, 'index'])->name('learning.index');
route::get("/learning/{courseId}/article/{topicId}", [LearningController::class, 'showArticle'])->name('learning.show.article');
route::get("/learning/{courseId}/pdf/{topicId}", [LearningController::class, 'showPdf'])->name('learning.show.pdf');
route::get("/learning/{courseId}/video/{topicId}", [LearningController::class, 'showVideo'])->name('learning.show.video');

Route::get('/inertia-example', [InertiaExampleController::class, 'index'])->name('inertia-example');

/**
 * Admin Routes
 */
Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function ()
    {
        Route::get('/dasboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('courses', CourseController::class)->except('edit');
        Route::resource('chapters', ChapterController::class)->only('store', 'update', 'destroy');
    }
);

/**
 * Auth Lib Routes
 */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
