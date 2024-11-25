@extends('public._layouts.app')

@section('title', 'My Learning')

@section('content')
    <main class="m-8 md:my-20 md:mx-80">
        <h1 class="md:mb-8 font-bold text-xl md:text-3xl">My Learning</h1>

        <div class="flex flex-col gap-4">
            <div class="card card-side p-8 gap-8 bg-base-100 shadow-xl">
                <img src='https://images.unsplash.com/photo-1499673610122-01c7122c5dcb?q=80&w=1927&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                    alt="course" class="rounded-xl w-32 h-32 object-cover">

                <div class="w-full flex justify-between items-center">
                    <div>
                        <h2 class="card-title font-bold text-lg">New movie is released!</h2>
                        <p>Click the button to watch on Jetflix app.</p>
                    </div>

                    <button class="btn btn-primary btn-sm">View Course</button>
                </div>
            </div>

            <div class="card card-side p-8 gap-8 bg-base-100 shadow-xl">
                <img src='https://images.unsplash.com/photo-1499673610122-01c7122c5dcb?q=80&w=1927&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                    alt="course" class="rounded-xl w-32 h-32 object-cover">

                <div class="w-full flex justify-between items-center">
                    <div>
                        <h2 class="card-title font-bold text-lg">New movie is released!</h2>
                        <p>Click the button to watch on Jetflix app.</p>
                    </div>

                    <button class="btn btn-primary btn-sm">View Course</button>
                </div>
            </div>
        </div>
    </main>
@endsection
