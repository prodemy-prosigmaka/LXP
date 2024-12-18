<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChapterRequest;
use App\Models\Chapter;
use Illuminate\Support\Facades\Redirect;

class ChapterController extends Controller
{
    public function store (ChapterRequest $request)
    {
        $chapter = Chapter::create($request->validated());

        return Redirect::route('admin.courses.edit', $chapter->course_id);
    }

    public function update (Chapter $chapter, ChapterRequest $request)
    {
        $chapter->update($request->validated());

        return Redirect::route('admin.courses.edit', $chapter->course_id);
    }

    public function destroy(Chapter $chapter)
    {
        $chapter_children_count = $chapter->topics()->count();

        if ($chapter_children_count > 0) {
            return Redirect::back()
                ->withErrors([ 'chapter_delete' => "Can't delete chapter that still has topics!" ]);
        }

        $chapter->delete();

        return Redirect::route('admin.courses.edit', $chapter->course_id);
    }
}
