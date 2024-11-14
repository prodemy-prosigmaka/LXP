<?php

namespace App\Http\Controllers;

use App\Models\LessonVideo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\LessonVideoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class LessonVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $lessonVideos = LessonVideo::paginate();

        return view('lesson-video.index', compact('lessonVideos'))
            ->with('i', ($request->input('page', 1) - 1) * $lessonVideos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $lessonVideo = new LessonVideo();

        return view('lesson-video.create', compact('lessonVideo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LessonVideoRequest $request): RedirectResponse
    {
        LessonVideo::create($request->validated());

        return Redirect::route('lesson-videos.index')
            ->with('success', 'LessonVideo created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $lessonVideo = LessonVideo::find($id);

        return view('lesson-video.show', compact('lessonVideo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $lessonVideo = LessonVideo::find($id);

        return view('lesson-video.edit', compact('lessonVideo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LessonVideoRequest $request, LessonVideo $lessonVideo): RedirectResponse
    {
        $lessonVideo->update($request->validated());

        return Redirect::route('lesson-videos.index')
            ->with('success', 'LessonVideo updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        LessonVideo::find($id)->delete();

        return Redirect::route('lesson-videos.index')
            ->with('success', 'LessonVideo deleted successfully');
    }
}
