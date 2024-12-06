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
    public function index($id)
    {
        // Find the first lesson by accessing its topic, then its chapter, and filter by course ID.
        $firstLesson = Lesson::whereHas('topic.chapter', function ($query) use ($id) {
            $query->where('course_id', $id);
        })->first();

        // Redirect to first content
        return $this->redirectToFirstLesson($firstLesson, $id);
    }

    public function showVideo($courseId, $topicId): View
    {
        return $this->showLesson($courseId, $topicId, 'video');
    }

    public function showPdf($courseId, $topicId): View
    {
        return $this->showLesson($courseId, $topicId, 'pdf');
    }

    public function showArticle($courseId, $topicId): View
    {
        return $this->showLesson($courseId, $topicId, 'article');
    }

    private function showLesson($courseId, $topicId, $type)
    {
        $course = Course::with(
            'chapters.topics'
        )->findOrFail($courseId);

        $lesson = Lesson::with($type)
            ->where('topic_id', $topicId)
            ->where('type', $type)
            ->firstOrFail();

        $topic = Topic::with('chapter.topics')->findOrFail($topicId);

        [$prevTopic, $nextTopic] = $this->getNavigationTopic($courseId, $topicId);

        return view('public.learningpage.index', compact('course', 'lesson', 'topic', 'prevTopic', 'nextTopic'));
    }

    private function getNavigationTopic($courseId, $topicId)
    {
        $topics = Topic::whereHas('chapter', function ($query) use ($courseId) {
            $query->where('course_id', $courseId);
        })->get();

        $currentIndex = $topics->search(function ($topic) use ($topicId) {
            return $topic->id == $topicId;
        });

        $prevTopic = $currentIndex > 0 ? $topics[$currentIndex - 1] : null;
        $nextTopic = $currentIndex < $topics->count() - 1 ? $topics[$currentIndex + 1] : null;

        return [$prevTopic, $nextTopic];
    }

    private function redirectToFirstLesson($firstLesson, $courseId)
    {
        switch ($firstLesson->type) {
            case 'video':
                return Redirect::route('learning.show.video', ['courseId' => $courseId, 'topicId' => $firstLesson->topic_id]);
            case 'pdf':
                return Redirect::route('learning.show.pdf', ['courseId' => $courseId, 'topicId' => $firstLesson->topic_id]);
            case 'article':
                return Redirect::route('learning.show.article', ['courseId' => $courseId, 'topicId' => $firstLesson->topic_id]);
        }
    }
}
