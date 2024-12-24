@extends('admin._layouts.app')

@section('title', 'Dashboard')

@section('header', 'Dashboard')

@section('header-action')
	<a
		href="{{ route('admin.courses.index') }}"
		class="btn btn-primary shadow"
	>
		<x-lucide-arrow-right class="h-4 w-4" />
		To Course CMS
	</a>
@endsection

@section('content')
	<div class="grid gap-6 lg:grid-cols-4">
		<x-admin.page-card class="sm:p-4">
			<h3 class="text-gray-600">
				Courses
			</h3>
			<section class="flex items-center justify-between">
				<p class="text-3xl font-bold">
					{{ $count_courses }}
				</p>
				<div class="rounded-xl bg-primary bg-opacity-10 p-3">
					<x-lucide-book-marked class="h-8 w-8 text-primary" />
				</div>
			</section>
		</x-admin.page-card>

		<x-admin.page-card class="sm:p-4">
			<h3 class="text-gray-600">
				Instructors
			</h3>
			<section class="flex items-center justify-between">
				<p class="text-3xl font-bold">
					{{ $count_instructors }}
				</p>
				<div class="rounded-xl bg-success bg-opacity-10 p-3">
					<x-lucide-user-pen class="h-8 w-8 text-success" />
				</div>
			</section>
		</x-admin.page-card>

		<x-admin.page-card class="sm:p-4">
			<h3 class="text-gray-600">
				Students
			</h3>
			<section class="flex items-center justify-between">
				<p class="text-3xl font-bold">
					{{ $count_students }}
				</p>
				<div class="rounded-xl bg-warning bg-opacity-10 p-3">
					<x-lucide-graduation-cap class="h-8 w-8 text-warning" />
				</div>
			</section>
		</x-admin.page-card>

		<x-admin.page-card class="sm:p-4">
			<h3 class="text-gray-600">
				Enrollments
			</h3>
			<section class="flex items-center justify-between">
				<p class="text-3xl font-bold">
					{{ $count_enrollments }}
				</p>
				<div class="rounded-xl bg-secondary bg-opacity-10 p-3">
					<x-lucide-school class="h-8 w-8 text-secondary" />
				</div>
			</section>
		</x-admin.page-card>
	</div>
@endsection
