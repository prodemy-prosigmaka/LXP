<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\View\View;

class PublicCourseController extends Controller
{
    public function index(): View
    {
        $courses = Course::all();
        return view('public.courselistpage.index', compact('courses'));
    }

    public function show($id): View
    {
        $course = Course::with([
            'instructor.user',
            'chapters.topics',
        ])->findOrFail($id);

        return view('public.courselistpage.detail', compact('course'));
    }
}
