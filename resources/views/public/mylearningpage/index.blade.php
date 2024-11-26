@extends('public._layouts.app')

@section('title', 'My Learning')

@section('content')
    <main class="m-8 md:my-20 md:mx-80">
        <h1 class="md:mb-8 font-bold text-xl md:text-3xl">My Learning</h1>

        <section class="flex flex-col gap-4">
            @foreach ($mycourses as $course)
                <div class="card card-side p-8 gap-8 bg-base-100 shadow-xl">
                    <img src="{{ $course->image }}", alt="course" class="rounded-xl w-32 h-32 object-cover">

                    <div class="w-full flex justify-between items-center">
                        <div>
                            <h2 class="card-title font-bold text-lg">{{ $course->title }}</h2>
                            <p>{{ $course->caption }}</p>
                        </div>

                        <button class="btn btn-primary btn-sm">View Course</button>
                    </div>
                </div>
            @endforeach
        </section>
    </main>
@endsection
