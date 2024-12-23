@extends('admin._layouts.app')

@section('title', 'Profile')

@section('header', 'Profile')

@section('content')
<div class="flex flex-col gap-8">
    <x-admin.page-card>
        @include('admin.profile.partials.update-profile-information-form')
    </x-admin.page-card>
    <x-admin.page-card>
        @include('admin.profile.partials.update-password-form')
    </x-admin.page-card>
    <x-admin.page-card>
        @include('admin.profile.partials.delete-user-form')
    </x-admin.page-card>
</div>
@endsection