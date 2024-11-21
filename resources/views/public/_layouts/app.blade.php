@extends('main')

@section('layout')
    <div class="min-h-screen bg-gray-100">
        @include('public._layouts.navigation')

        @yield('content')
    </div>
@endsection