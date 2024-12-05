<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Topic;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TopicController extends Controller
{
    public function show($topic_id)
    {
        $topic = Topic::with([
            'lesson' => [
                'video',
                'pdf',
                'article'
            ],
            'practice'
        ])->findOrFail($topic_id);

        $course = Course::with('chapters.topics')->findOrFail($topic->chapter->course->id);

        $instructor_options = Instructor::with('user')->get()->map(fn ($opt) => [
            'value' => $opt->id,
            'label' => $opt->user->name,
        ]);

        return Inertia::render('admin/course/CourseForm', [
            'instructor_options' => $instructor_options,
            'course_id'         => $course->id,
            'course'            => $course,
            'topic'             => $topic
        ]);
    }
}
