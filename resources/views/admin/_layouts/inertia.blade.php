@extends('admin._layouts.app')

@push('style')
    @inertiaHead
@endpush

@section('content')
	@routes
	@inertia
@endsection