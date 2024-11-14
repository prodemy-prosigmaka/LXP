<?php

namespace App\Http\Controllers;

use App\Models\LessonPdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\LessonPdfRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class LessonPdfController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $lessonPdfs = LessonPdf::paginate();

        return view('lesson-pdf.index', compact('lessonPdfs'))
            ->with('i', ($request->input('page', 1) - 1) * $lessonPdfs->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $lessonPdf = new LessonPdf();

        return view('lesson-pdf.create', compact('lessonPdf'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LessonPdfRequest $request): RedirectResponse
    {
        LessonPdf::create($request->validated());

        return Redirect::route('lesson-pdfs.index')
            ->with('success', 'LessonPdf created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $lessonPdf = LessonPdf::find($id);

        return view('lesson-pdf.show', compact('lessonPdf'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $lessonPdf = LessonPdf::find($id);

        return view('lesson-pdf.edit', compact('lessonPdf'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LessonPdfRequest $request, LessonPdf $lessonPdf): RedirectResponse
    {
        $lessonPdf->update($request->validated());

        return Redirect::route('lesson-pdfs.index')
            ->with('success', 'LessonPdf updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        LessonPdf::find($id)->delete();

        return Redirect::route('lesson-pdfs.index')
            ->with('success', 'LessonPdf deleted successfully');
    }
}
