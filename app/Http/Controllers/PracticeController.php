<?php

namespace App\Http\Controllers;

use App\Models\Practice;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PracticeRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PracticeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $practices = Practice::paginate();

        return view('practice.index', compact('practices'))
            ->with('i', ($request->input('page', 1) - 1) * $practices->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $practice = new Practice();

        return view('practice.create', compact('practice'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PracticeRequest $request): RedirectResponse
    {
        Practice::create($request->validated());

        return Redirect::route('practices.index')
            ->with('success', 'Practice created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $practice = Practice::find($id);

        return view('practice.show', compact('practice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $practice = Practice::find($id);

        return view('practice.edit', compact('practice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PracticeRequest $request, Practice $practice): RedirectResponse
    {
        $practice->update($request->validated());

        return Redirect::route('practices.index')
            ->with('success', 'Practice updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Practice::find($id)->delete();

        return Redirect::route('practices.index')
            ->with('success', 'Practice deleted successfully');
    }
}
