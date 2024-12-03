<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LearningController extends Controller
{
    public function show($id): View
    {
        $course = Course::with(
            'chapters.topics'
        )->findOrFail($id);

        return view('public.learningpage.index', compact('course'));
    }

    public function showVideo($courseId, $topicId): View
    {
        $course = Course::with(
            'chapters.topics'
        )->findOrFail($courseId);

        $lesson = Lesson::with('video')
            ->where('topic_id', $topicId)
            ->where('type', 'video')
            ->firstOrFail();
            
        return view('public.learningpage.index', compact('course', 'lesson'));
    }
}
