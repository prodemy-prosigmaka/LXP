@extends('main')

@section('layout')
    <div class="min-h-screen bg-primary">
        @include('public._layouts.navigation')

        @yield('content')
    </div>
@endsection