<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\CourseStudent;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class MyLearningController extends Controller
{
    public function index(): View
    {   
        $userId = Auth::id();
        $student = Student::where('user_id', $userId)->first();
        $mycourses = $student->courses;
        return view('public.mylearningpage.index', compact('mycourses'));
    }

    public function joinClass(Request $request)
    {
        $validatedData = $request->validate([
            'course_id' => 'required|integer|exists:courses,id' 
        ]);
        
        $courseId = (int) $validatedData['course_id'];
        $userId = Auth::id();
        $student = Student::where('user_id', $userId)->first();

        if (!$student) {
            return redirect()->back()->with('error', 'Student not found');
        }

        $studentId = $student->id;

        CourseStudent::create([
            'student_id' => $studentId,
            'course_id'  => $courseId,
        ]);

        return Redirect::route('mylearning')
            ->with('success', 'You have been successfully enrolled in the course!');
    }
}
