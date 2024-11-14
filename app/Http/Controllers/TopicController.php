<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\TopicRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $topics = Topic::paginate();

        return view('topic.index', compact('topics'))
            ->with('i', ($request->input('page', 1) - 1) * $topics->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $topic = new Topic();

        return view('topic.create', compact('topic'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TopicRequest $request): RedirectResponse
    {
        Topic::create($request->validated());

        return Redirect::route('topics.index')
            ->with('success', 'Topic created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $topic = Topic::find($id);

        return view('topic.show', compact('topic'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $topic = Topic::find($id);

        return view('topic.edit', compact('topic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TopicRequest $request, Topic $topic): RedirectResponse
    {
        $topic->update($request->validated());

        return Redirect::route('topics.index')
            ->with('success', 'Topic updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Topic::find($id)->delete();

        return Redirect::route('topics.index')
            ->with('success', 'Topic deleted successfully');
    }
}
