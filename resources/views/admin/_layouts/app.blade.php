@extends('main')

@section('layout')
	<div class="min-h-screen bg-gray-100">
		@include('admin._layouts.navigation')

		<!-- Page Heading -->
		@hasSection('header')
			<header class="bg-white shadow p-4 md:ml-56">
				<div class="max-w-7xl mx-auto py-7 pt-24 px-4 sm:px-6 lg:px-8">
					@yield('header')
				</div>
			</header>
		@endif

		<!-- Page Content -->
		<main class="p-4 md:ml-56">
			@yield('content')
		</main>
	</div>
@endsection