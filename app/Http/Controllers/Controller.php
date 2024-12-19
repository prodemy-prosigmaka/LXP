<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;

abstract class Controller
{
    protected function handle_back_to_course_edit($course_id, $is_leave)
    {
        if ($is_leave) {
            return Redirect::route('admin.courses.edit', $course_id);
        } else {
            return Redirect::back();
        }
    }
}
