@extends('main')

@section('layout')
	<div class="min-h-screen bg-gray-100">
		@include('admin._layouts.navigation')

		<!-- Page Heading -->
		@hasSection('header')
			<header class="p-4 md:ml-56">
				<div class="max-w-7xl mx-auto pt-20 sm:px-6 lg:px-8">
					<h2 class="font-semibold text-3xl text-gray-800 leading-tight">
						@yield('header')
					</h2>
				</div>
			</header>
		@endif

		<!-- Page Content -->
		<main class="p-4 md:ml-56">
		    <div class="max-w-full sm:px-6 lg:px-8">
				@yield('content')
			</div>
		</main>
	</div>
@endsection