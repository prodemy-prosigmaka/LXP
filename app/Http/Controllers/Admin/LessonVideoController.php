<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LessonVideoRequest;
use App\Models\LessonVideo;

class LessonVideoController extends Controller
{
    public function store($course_id, LessonVideoRequest $request)
    {
        LessonVideo::create($request->validated());

        return $this->handle_back_to_course_edit(
            course_id: $course_id,
            is_leave: $request->leave_after_submit
        );
    }

    public function update($course_id, LessonVideo $lesson_video, LessonVideoRequest $request)
    {
        $lesson_video->update($request->validated());

        return $this->handle_back_to_course_edit(
            course_id: $course_id,
            is_leave: $request->leave_after_submit
        );
    }
}
