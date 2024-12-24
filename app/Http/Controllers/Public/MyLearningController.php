<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\CourseEnrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class MyLearningController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $mycourses = $user->courses;
        return view('public.mylearningpage.index', compact('mycourses'));
    }

    public function joinClass(Request $request)
    {
        $validatedData = $request->validate([
            'course_id' => 'required|integer|exists:courses,id'
        ]);

        $courseId = (int) $validatedData['course_id'];

        if (!Auth::check()) {
            return Redirect::back()->withErrors(['errorUserNotFound' => 'You are not logged in!']);
        }

        $userId = Auth::id();

        // Check if the user is already enrolled in the course
        $existingEnrollment = CourseEnrollment::where('user_id', $userId)
            ->where('course_id', $validatedData['course_id'])
            ->first();

        if ($existingEnrollment) {
            return Redirect::back()->withErrors(['errorEnrollment' => 'You have already enrolled in this class']);
        }

        CourseEnrollment::create([
            'user_id' => $userId,
            'course_id'  => $courseId,
        ]);

        return Redirect::route('mylearning')
            ->with('success', 'You have been successfully enrolled in the course!');
    }
}
