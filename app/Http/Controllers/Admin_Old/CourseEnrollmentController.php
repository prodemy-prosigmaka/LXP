<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseEnrollment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CourseEnrollmentRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CourseEnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $courseEnrollments = CourseEnrollment::paginate();

        return view('admin.course-enrollment.index', compact('courseEnrollment'))
            ->with('i', ($request->input('page', 1) - 1) * $courseEnrollments->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $courseEnrollment = new CourseEnrollment();

        return view('admin.course-enrollment.create', compact('courseEnrollment'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseEnrollmentRequest $request): RedirectResponse
    {
        CourseEnrollment::create($request->validated());

        return Redirect::route('course-enrollment.index')
            ->with('success', 'Course Enrollment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $courseEnrollment = CourseEnrollment::find($id);

        return view('admin.course-enrollment.show', compact('courseEnrollment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $courseEnrollment = CourseEnrollment::find($id);

        return view('admin.course-enrollment.edit', compact('courseEnrollment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseEnrollmentRequest $request, CourseEnrollment $courseEnrollment): RedirectResponse
    {
        $courseEnrollment->update($request->validated());

        return Redirect::route('course-enrollment.index')
            ->with('success', 'Course Enrollment updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        CourseEnrollment::find($id)->delete();

        return Redirect::route('course-enrollment.index')
            ->with('success', 'Course Enrollment deleted successfully');
    }
}
