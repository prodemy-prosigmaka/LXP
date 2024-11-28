<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseController extends Controller
{
    /**
     * Display a listing of the courses.
     */
    public function index(Request $request): View
    {
        $courses = Course::paginate();

        return view('admin.course.index', compact('courses'))
            ->with('i', ($request->input('page', 1) - 1) * $courses->perPage());
    }
}
