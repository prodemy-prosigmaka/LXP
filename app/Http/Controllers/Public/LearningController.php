<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LearningController extends Controller
{
    public function show($id): View
    {
        $courses = Course::with(
            'chapters.topics'
        )->findOrFail($id);

        return view('public.learningpage.index', compact('courses'));
    }

    public function showVideo(): View
    {
        return view('public.learningpage.video');
    }
}
