<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LessonPdfRequest;
use App\Models\LessonPdf;

class LessonPdfController extends Controller
{
    public function store($course_id, LessonPdfRequest $request)
    {
        LessonPdf::create($request->validated());

        return $this->handle_back_to_course_edit(
            course_id: $course_id,
            is_leave: $request->leave_after_submit
        );
    }

    public function update($course_id, LessonPdf $lesson_pdf, LessonPdfRequest $request)
    {
        $lesson_pdf->update($request->validated());

        return $this->handle_back_to_course_edit(
            course_id: $course_id,
            is_leave: $request->leave_after_submit
        );
    }
}
