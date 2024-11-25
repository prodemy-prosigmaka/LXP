<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MyLearningController extends Controller
{
    public function index(): View
    {
        return view('public.mylearningpage.index');
    }

}
