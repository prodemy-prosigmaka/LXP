@extends('public._layouts.app')

@section('title', 'Learning ' . $course->title)

@section('content')
    <div class="m-4 lg:m-8 flex flex-col lg:flex-row gap-8">
        <div class="w-full lg:w-2/6">
            @include('public.learningpage.sidebar')
        </div>

        <main class="flex-1">
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
