<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TopicSortController extends Controller
{
    public function update(Request $request) {
        foreach ($request->all() as $topic_req) {
            Topic::find($topic_req['id'])->update(['sort_order' => $topic_req['sort_order']]);
        }

        return Redirect::back();
    }
}
