@extends('main')

@section('layout')
	<div class="flex min-h-screen flex-col items-center bg-gray-100 pt-6 sm:justify-center sm:pt-0">
        <div>
            <a href="/">
                <img src="{{ asset('assets/prodemy-pro-only.png') }}" alt="logo" class="h-20" />
            </a>
        </div>

        <div class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg">
            @yield('content')
        </div>
    </div>
@endsection