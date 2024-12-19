<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LessonArticleRequest;
use App\Models\LessonArticle;

class LessonArticleController extends Controller
{
    public function store($course_id, LessonArticleRequest $request)
    {
        LessonArticle::create($request->validated());

        return $this->handle_back_to_course_edit(
            course_id: $course_id,
            is_leave: $request->leave_after_submit
        );
    }

    public function update($course_id, LessonArticle $lesson_article, LessonArticleRequest $request)
    {
        $lesson_article->update($request->validated());

        return $this->handle_back_to_course_edit(
            course_id: $course_id,
            is_leave: $request->leave_after_submit
        );
    }
}
