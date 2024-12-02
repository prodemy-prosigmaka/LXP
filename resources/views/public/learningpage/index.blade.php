@extends('public._layouts.app')

@section('title', 'Learning')

@section('content')
    <div class="m-8 flex">
        @include('public.learningpage.sidebar')

        @include('public.learningpage.video')
    </div>
@endsection