@extends('main')

@section('layout')
	<div class="min-h-screen bg-gray-100">
		@include('admin._layouts.navigation')

		<div class="md:ml-56 pt-16">

			<!-- Page Heading -->
			@hasSection('header')
				<header class="max-w-7xl mx-auto py-8 sm:px-6 lg:px-8">
					<h2 class="font-semibold text-3xl text-gray-800 leading-tight">
						@yield('header')
					</h2>
				</header>
			@endif

			<!-- Page Content -->
			<main class="max-w-full pb-8 sm:px-6 lg:px-8">
				@yield('content')
			</main>
		</div>
	</div>
@endsection