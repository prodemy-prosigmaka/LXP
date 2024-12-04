@extends('public._layouts.app')

@section('title', 'Learning '.$course->title)

@section('content')
    <div class="m-4 lg:m-8 flex flex-col lg:flex-row gap-8">
        @include('public.learningpage.sidebar')

        @if ($lesson->type == 'video')
            @include('public.learningpage.video')
        @else
            @include('public.learningpage.pdf')
        @endif
    </div>
@endsection
