<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class LearningController extends Controller
{
    public function show($id)
    {
        $course = Course::with(
            'chapters.topics.lesson'
        )->findOrFail($id);

        // Find the first lesson by accessing its topic, then its chapter, and filter by course ID.
        $firstLesson = Lesson::whereHas('topic.chapter', function ($query) use ($id) {
            $query->where('course_id', $id);
        })->first();

        // Redirect to first content
        if ($firstLesson->type == 'video') {
            return Redirect::route('learning.show.video', ['courseId' => $id, 'topicId' => $firstLesson->topic_id]);
        }

        // return view('public.learningpage.index', compact('course'));
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
