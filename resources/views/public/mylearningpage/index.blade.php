@extends('public._layouts.app')

@section('title', 'My Learning')

@section('content')
    <main class="m-8 md:my-20 lg:mx-56">
        <h1 class="md:mb-8 font-bold text-xl md:text-3xl">My Learning</h1>

        <section class="flex flex-col gap-4">
            @foreach ($mycourses as $course)
                <div class="card md:card-side p-8 gap-4 md:gap-8 bg-base-100 shadow-xl">
                    <img src="{{ $course->image }}", alt="course" class="rounded-xl md:w-32 md:h-32 object-cover">

                    <div class="w-full flex flex-col gap-4 md:flex-row md:justify-between md:items-center">
                        <div>
                            <h2 class="card-title font-bold text-lg">{{ $course->title }}</h2>
                            <p>{{ $course->caption }}</p>
                        </div>

                        <a href="{{ route('learning', $course->id) }}" class="btn btn-primary btn-sm">View Course</a>
                    </div>
                </div>
            @endforeach
        </section>
    </main>
@endsection
