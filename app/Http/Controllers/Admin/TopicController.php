<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Models\Chapter;
use App\Models\Topic;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class TopicController extends Controller
{
    public function create($course_id, $chapter_id)
    {
        return Inertia::render('admin/topic/TopicForm', [
            'course_id'     => $course_id,
            'chapter_id'    => $chapter_id,
        ]);
    }

    public function edit($course_id, $chapter_id, $topic_id)
    {
        $topic = Topic::with([
            'lesson' => [
                'video',
                'pdf',
                'article'
            ],
            'practice'
        ])->findOrFail($topic_id);

        $children_type = $topic->children_model()->first()->type;

        return Inertia::render('admin/topic/TopicForm', [
            'course_id'     => $course_id,
            'chapter_id'    => $chapter_id,
            'topic_id'      => $topic_id,
            'topic'         => $topic,
            'children_type' => $children_type
        ]);
    }

    public function store($course_id, Chapter $chapter, TopicRequest $request)
    {
        $topic_id = DB::transaction(function () use ($chapter, $request) {
            // topic itu bapak
            // anaknya namanya lesson dan practice
            // setiap topic hanya bisa punya 1 anak
            // di dalam topic ada namanya sort order
            // bapaknya si topic namanya chapter
            // ～( ⸝⸝⸝⌄⸝⸝⸝)◦♡

            // gw mau dapetin sort order terakhir
            $last_sort_order = $chapter
                                ->topics()
                                ->orderBy('sort_order', 'desc')
                                ->first()
                                ?->sort_order ?? 0;

            $sort_order = $last_sort_order + 1;

            // buat topic baru berdasarkan data $request dan sort order yg didapatkan
            $topic = Topic::create([
                'chapter_id'    => $request->chapter_id,
                'title'         => $request->title,
                'type'          => $request->type,
                'sort_order'    => $sort_order
            ]);

            // buat anaknya si topic berdasarkan tipe pada $request (lesson / practice),
            // karena kita butuh id nya untuk ngebuat anaknya dia lagi
            $topic->children_model()->create(['type' => $request->children_type]);

            return $topic->id;
        });

        if ($request->leave_after_submit) {
            return Redirect::route('admin.courses.edit', $course_id);
        } else {
            return Redirect::route('admin.topics.edit', [
                'course'    => $course_id,
                'chapter'   => $chapter->id,
                'topic'     => $topic_id,
            ]);
        }
    }

    public function update($course_id, $chapter_id, Topic $topic, TopicRequest $request)
    {
        $is_type_change = $topic->children_model()->first()?->type !== $request->children_type;

        $topic->update([
            'title' => $request->title,
            'type'  => $request->type,
        ]);

        if ($is_type_change) {
            $topic->delete_children();
            $topic->children_model()->create(['type' => $request->children_type]);
        }

        return $this->handle_back_to_course_edit(
            course_id: $course_id,
            is_leave: $request->leave_after_submit
        );
    }

    public function destroy($course_id, $chapter_id, Topic $topic)
    {
        $topic->delete_children();
        $topic->delete();

        return Redirect::route('admin.courses.edit', $course_id);
    }
}
