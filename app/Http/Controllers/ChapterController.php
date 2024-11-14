<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ChapterRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $chapters = Chapter::paginate();

        return view('chapter.index', compact('chapters'))
            ->with('i', ($request->input('page', 1) - 1) * $chapters->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $chapter = new Chapter();

        return view('chapter.create', compact('chapter'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChapterRequest $request): RedirectResponse
    {
        Chapter::create($request->validated());

        return Redirect::route('chapters.index')
            ->with('success', 'Chapter created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $chapter = Chapter::find($id);

        return view('chapter.show', compact('chapter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $chapter = Chapter::find($id);

        return view('chapter.edit', compact('chapter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChapterRequest $request, Chapter $chapter): RedirectResponse
    {
        $chapter->update($request->validated());

        return Redirect::route('chapters.index')
            ->with('success', 'Chapter updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Chapter::find($id)->delete();

        return Redirect::route('chapters.index')
            ->with('success', 'Chapter deleted successfully');
    }
}
