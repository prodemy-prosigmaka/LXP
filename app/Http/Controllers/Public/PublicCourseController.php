<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class PublicCourseController extends Controller
{
    public function index()
    {
        return view('public.courselistpage.index');
    }
}
