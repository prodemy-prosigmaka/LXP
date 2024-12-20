@extends('public._layouts.app')

@section('title', 'My Learning')

@section('content')
    <main class="m-8 md:my-20 lg:mx-56">
        <h1 class="mb-4 md:mb-0 font-bold text-3xl">My Learning</h1>

        <section class="flex flex-col gap-4">
            @if ($mycourses->isEmpty())
                <div class="flex flex-col items-center justify-center gap-4">
                    <lottie-player src="https://lottie.host/0cd2a184-a5eb-4784-97d5-38e3295590d2/FBhDcNOllm.json"
                        background="##FFFFFF" speed="1" class="w-full xl:w-2/3 md:aspect-[2/1]" loop autoplay direction="1"
                        mode="normal">
                    </lottie-player>
                    <p class="text-center text-lg">You haven't enrolled in any course yet</p>
                    <a class="btn btn-primary" href="{{ route('courselist.index') }}">Browse Course</a>
                </div>
            @else
                @foreach ($mycourses as $course)
                    <div class="card md:mt-8  md:card-side p-8 gap-4 md:gap-8 bg-base-100 shadow-xl">
                        <img src="{{ $course->image }}", alt="course" class="rounded-xl md:w-32 md:h-32 object-cover">

                        <div class="w-full flex flex-col gap-4 md:flex-row md:justify-between md:items-center">
                            <div>
                                <h2 class="card-title font-bold text-lg">{{ $course->title }}</h2>
                                <p>{{ $course->caption }}</p>
                            </div>

                            <a href="{{ route('learning.index', $course->id) }}" class="btn btn-primary btn-sm">View
                                Course</a>
                        </div>
                    </div>
                @endforeach
            @endif
        </section>
    </main>
@endsection
