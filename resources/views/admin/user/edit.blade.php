@extends('admin._layouts.app')

@section('title', 'Edit User')

@section('header', 'Edit User')

@section('header-action')
	<button onclick="history.back()" class="btn bg-white shadow">
		<x-lucide-arrow-left class="h-4 w-4" />
		Back
	</button>
@endsection

@section('content')
    <x-admin.page-card>
		<form action="{{ route('admin.users.update', $user->id) }}" method="POST">
			@csrf
			@method('PUT')

			@include('admin.user.form')
		</form>
	</x-admin.page-card>

	@include('admin.user.reset-password')
@endsection