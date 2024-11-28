@extends('public._layouts.app')

@section('title')
    {{ $course->title }}
@endsection

@section('content')
    <main class="m-8 md:m-20">
        <section class="p-8 flex flex-col gap-4 bg-primary rounded-xl">
            <div class="flex gap-4 items-center">
                <h1 class="font-bold text-xl text-white md:text-4xl">{{ $course->title }}</h1>
                @if ($isEnrolled)
                    <div class="badge badge-neutral">Enrolled</div>
                @endif
            </div>
            <p class="text-white">{{ $course->caption }}</p>
            <p class="text-white"><b>Instructor: </b>{{ $course->instructor->user->name }}</p>

            @if ($isEnrolled)
                <button type="submit" class="btn btn-secondary btn-sm w-40 font-bold">Go to class</button>
            @else
                <form method="POST" action="{{ route('mylearning.join') }}">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <button type="submit" class="btn btn-secondary btn-sm w-40 font-bold">Join the class</button>
                </form>
            @endif

        </section>

        <section class="mt-4 md:m-8">
            <h2 class="mb-4 text-2xl font-bold">About this course</h2>
            <p>{{ $course->description }}</p>
        </section>

        <section class="mt-4 md:m-8">
            <h2 class="mb-4 text-2xl font-bold">Syllabus</h2>

            <div class="flex flex-col gap-4">
                @foreach ($course->chapters as $chapter)
                    <details class="collapse bg-white shadow-lg">
                        <summary class="collapse-title text-lg font-bold">
                            {{ $chapter->title }}

                            <span class="arrow-circle">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6z" />
                                </svg>
                            </span>
                        </summary>

                        @foreach ($chapter->topics as $topic)
                            <div class="collapse-content">
                                <p>✓ {{ $topic->title }}</p>
                            </div>
                        @endforeach
                    </details>
                @endforeach
            </div>
        </section>
    </main>
@endsection

@push('style')
    <style>
        /* Styling the arrow with a circular background */
        .collapse-title .arrow-circle {
            width: 24px;
            height: 24px;
            background-color: #FC4F00;
            border-radius: 50%;
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%) rotate(90deg);
            transition: transform 0.3s ease;
        }

        /* Rotate the arrow inside the circle when the details are open */
        details[open] .arrow-circle {
            transform: translateY(-50%) rotate(270deg);
        }

        /* Styling the SVG arrow */
        .collapse-title .arrow-circle svg {
            width: 12px;
            height: 12px;
            fill: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
@endpush
