@extends('main')

@section('layout')
	<div class="min-h-screen bg-gray-100">
		@include('admin._layouts.navigation')

		<div class="pt-16 md:ml-56">

			<!-- Page Heading -->
			@hasSection('header')
				<header class="mx-auto flex max-w-7xl items-center justify-between py-8 sm:px-6 lg:px-8">
					<h2 class="text-3xl font-semibold leading-tight text-gray-800">
						@yield('header')
					</h2>

					@yield('header-action')
				</header>
			@endif

			<!-- Page Content -->
			<main class="max-w-full pb-8 sm:px-6 lg:px-8">
				@yield('content')
			</main>
		</div>
	</div>
@endsection