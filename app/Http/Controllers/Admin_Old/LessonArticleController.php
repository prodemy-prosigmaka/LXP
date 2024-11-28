<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LessonArticle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\LessonArticleRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class LessonArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $lessonArticles = LessonArticle::paginate();

        return view('admin.lesson-article.index', compact('lessonArticles'))
            ->with('i', ($request->input('page', 1) - 1) * $lessonArticles->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $lessonArticle = new LessonArticle();

        return view('admin.lesson-article.create', compact('lessonArticle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LessonArticleRequest $request): RedirectResponse
    {
        LessonArticle::create($request->validated());

        return Redirect::route('lesson-articles.index')
            ->with('success', 'LessonArticle created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $lessonArticle = LessonArticle::find($id);

        return view('admin.lesson-article.show', compact('lessonArticle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $lessonArticle = LessonArticle::find($id);

        return view('admin.lesson-article.edit', compact('lessonArticle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LessonArticleRequest $request, LessonArticle $lessonArticle): RedirectResponse
    {
        $lessonArticle->update($request->validated());

        return Redirect::route('lesson-articles.index')
            ->with('success', 'LessonArticle updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        LessonArticle::find($id)->delete();

        return Redirect::route('lesson-articles.index')
            ->with('success', 'LessonArticle deleted successfully');
    }
}
