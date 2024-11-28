<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseStudent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CourseStudentRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CourseStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $courseStudents = CourseStudent::paginate();

        return view('admin.course-student.index', compact('courseStudents'))
            ->with('i', ($request->input('page', 1) - 1) * $courseStudents->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $courseStudent = new CourseStudent();

        return view('admin.course-student.create', compact('courseStudent'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseStudentRequest $request): RedirectResponse
    {
        CourseStudent::create($request->validated());

        return Redirect::route('course-students.index')
            ->with('success', 'CourseStudent created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $courseStudent = CourseStudent::find($id);

        return view('admin.course-student.show', compact('courseStudent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $courseStudent = CourseStudent::find($id);

        return view('admin.course-student.edit', compact('courseStudent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseStudentRequest $request, CourseStudent $courseStudent): RedirectResponse
    {
        $courseStudent->update($request->validated());

        return Redirect::route('course-students.index')
            ->with('success', 'CourseStudent updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        CourseStudent::find($id)->delete();

        return Redirect::route('course-students.index')
            ->with('success', 'CourseStudent deleted successfully');
    }
}
