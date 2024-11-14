<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\LessonRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $lessons = Lesson::paginate();

        return view('lesson.index', compact('lessons'))
            ->with('i', ($request->input('page', 1) - 1) * $lessons->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $lesson = new Lesson();

        return view('lesson.create', compact('lesson'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LessonRequest $request): RedirectResponse
    {
        Lesson::create($request->validated());

        return Redirect::route('lessons.index')
            ->with('success', 'Lesson created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $lesson = Lesson::find($id);

        return view('lesson.show', compact('lesson'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $lesson = Lesson::find($id);

        return view('lesson.edit', compact('lesson'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LessonRequest $request, Lesson $lesson): RedirectResponse
    {
        $lesson->update($request->validated());

        return Redirect::route('lessons.index')
            ->with('success', 'Lesson updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Lesson::find($id)->delete();

        return Redirect::route('lessons.index')
            ->with('success', 'Lesson deleted successfully');
    }
}
