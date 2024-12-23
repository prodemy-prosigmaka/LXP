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
        $courses    = Course::with('instructor.user')->withCount('users')->paginate();
        $i          = ($request->input('page', 1) - 1) * $courses->perPage();

        return view('admin.course.index', compact('courses', 'i'));
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

        return Inertia::render('admin/course/CourseForm', [
            'instructor_options' => $instructor_options
        ]);
    }

    /**
     * Show the interactive cms for creating or editing a course.
     */
    public function edit($id)
    {
        $course = Course::with('chapters.topics')->findOrFail($id);

        $instructor_options = Instructor::with('user')->get()->map(fn ($opt) => [
            'value' => $opt->id,
            'label' => $opt->user->name,
        ]);

        return Inertia::render('admin/course/CourseForm', [
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
        $validated = $request->validate([
            'instructor_id' => 'required',
            'title' => 'required|string',
            'image' => 'required|string|url',
            'caption' => 'required|string',
            'description' => 'required|string',
        ]);

        $course = Course::create($validated);

        return Redirect::route('admin.courses.edit', $course->id)
            ->with("success", "Course created successfully! Try to add new chapter for your course! 👇");
    }

    /**
     * create new course
     */
    public function update(Course $course, CourseRequest $request)
    {
        $course->update($request->validated());

        return Redirect::route('admin.courses.edit', $course->id)
            ->with("success", "Course updated successfully!");
    }

    /**
     * Delete Course
     */
    public function destroy(Course $course)
    {
        $course_children_count = $course->chapters()->count();

        if ($course_children_count > 0) {
            return Redirect::back()
                ->withErrors([ 'course_delete' => "Can't delete course that still has chapters!" ]);
        }

        $course->delete();

        return Inertia::location(route('admin.courses.index'));
    }
}
