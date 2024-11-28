@extends('main')

@section('layout')
    <div class="min-h-screen">
        @include('public._layouts.navigation')

        @yield('content')
    </div>
@endsection