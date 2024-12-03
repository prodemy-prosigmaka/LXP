@extends('public._layouts.app')

@section('title', 'Learning')

@section('content')
    <div class="m-4 lg:m-8 flex flex-col lg:flex-row gap-8">
        @include('public.learningpage.sidebar')

        @include('public.learningpage.video')
    </div>
@endsection