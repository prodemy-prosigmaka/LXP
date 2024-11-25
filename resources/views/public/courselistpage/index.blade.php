@extends('public._layouts.app')

@section('title', 'Courses')

@section('content')
    <main class="m-8 md:m-20">
        <h1 class="md:mb-8 font-bold text-xl md:text-3xl">Choose your learning path</h1>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            @foreach ($courses as $course)
                <a href="{{ route('courselist.detail', $course->id) }}"
                    class="card bg-base-100 shadow-xl hover:bg-primary transition duration-300">
                    <figure class="px-8 pt-8">
                        <img src="{{ $course->image }}" alt="course-image" class="rounded-xl w-full h-44" />
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title font-bold">{{ $course->title }}</h2>
                        <p>{{ $course->caption }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </main>
@endsection