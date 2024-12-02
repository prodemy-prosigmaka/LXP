<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Models\Course;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Inertia\Inertia;

class CourseController extends Controller
{
    /**
     * Display a listing of the courses.
     */
    public function index(Request $request): View
    {
        $courses = Course::with('instructor.user')->withCount('students')->paginate();

        return view('admin.course.index', compact('courses'))
            ->with('i', ($request->input('page', 1) - 1) * $courses->perPage());
    }

    /**
     * Show the interactive cms for creating or editing a course.
     */
    public function create()
    {
        $instructor_options = Instructor::with('user')->get()->map(fn ($opt) => [
            'value' => $opt->id,
            'label' => $opt->user->name,
        ]);

        return Inertia::render('admin/course/InteractiveCMS', [
            'instructor_options' => $instructor_options
        ]);
    }

    /**
     * Show the interactive cms for creating or editing a course.
     */
    public function show(Course $course)
    {
        $instructor_options = Instructor::with('user')->get()->map(fn ($opt) => [
            'value' => $opt->id,
            'label' => $opt->user->name,
        ]);

        return Inertia::render('admin/course/InteractiveCMS', [
            'instructor_options' => $instructor_options,
            'course_id'         => $course->id,
            'course'            => $course
        ]);
    }

    /**
     * create new course
     */
    public function store(CourseRequest $request)
    {
        $course = Course::create($request->validated());

        return to_route('admin.courses.show', $course->id)
            ->with("success", "Course created successfully!");
    }

    /**
     * create new course
     */
    public function update(Course $course, CourseRequest $request)
    {
        $course->update($request->validated());

        return to_route('admin.courses.show', $course->id)
            ->with("success", "Course updated successfully!");
    }

    /**
     * Delete Course
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return Inertia::location(route('admin.courses.index'));
    }
}
