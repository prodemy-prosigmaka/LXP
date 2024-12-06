@extends('public._layouts.app')

@section('title', 'Learning ' . $course->title)

@section('content')
    <div class="m-4 lg:m-8 flex flex-col md:flex-row gap-8">
        <div class="w-full md:w-2/6 md:sticky md:top-28 md:max-h-[calc(100vh-98px)] md:overflow-y-auto">
            @include('public.learningpage.sidebar')
        </div>

        <main class="flex-1">
            <div class="mb-4 flex gap-2 justify-end">
                @if ($prevTopic)
                    <a href="{{ route('learning.show.' . $prevTopic->lesson->type, ['courseId' => $course->id, 'topicId' => $prevTopic->id]) }}"
                        class="btn btn-sm btn-primary">Prev</a>
                @endif

                @if ($nextTopic)
                    <a href="{{ route('learning.show.' . $nextTopic->lesson->type, ['courseId' => $course->id, 'topicId' => $nextTopic->id]) }}"
                        class="btn btn-sm btn-primary">Next</a>
                @endif
            </div>

            @if ($lesson->type == 'video')
                @include('public.learningpage.video')
            @elseif ($lesson->type == 'pdf')
                @include('public.learningpage.pdf')
            @else
                @include('public.learningpage.article')
            @endif
        </main>
    </div>
@endsection
