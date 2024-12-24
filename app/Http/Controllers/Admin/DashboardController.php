<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $count_courses = Course::count();
        $count_instructors = User::whereHas('roles', function (Builder $query) {
            $query->where('name', RoleEnum::INSTRUCTOR);
        })->count();
        $count_students = User::whereHas('roles', function (Builder $query) {
            $query->where('name', RoleEnum::STUDENT);
        })->count();
        $count_enrollments = CourseEnrollment::count();

        return view('admin.dashboard.index', compact(
            'count_courses',
            'count_instructors',
            'count_students',
            'count_enrollments',
        ));
    }
}
