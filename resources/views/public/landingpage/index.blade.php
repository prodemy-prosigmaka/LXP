@extends('public._layouts.app')

@section('title', 'Online Course Prodemy')

@section('content')
    <main class="mx-8 md:mx-20 flex justify-between items-center h-[calc(100vh-66.4px)]">
        <section>
            <h1 class="mb-6 text-5xl font-bold">Be a <span class="text-primary">code whiz-ard!<span></h1>
            <p class="mb-6 text-2xl">Learn to code faster like it’s magic!</p>
            <a class="btn btn-primary">
                Get Started
                <x-lucide-circle-arrow-right class="w-4 h-4" />
            </a>
        </section>
        <section>
            <div class="relative mr-16 w-52 h-52 bg-primary rounded-full">
                <p class="absolute py-4 px-10 right-32 top-8 bg-white rounded-full shadow-md font-bold">&lt;p&gt;Abracadabra&lt;/p&gt;</p>
                <img alt="hero" class="absolute max-w-80 left-2 bottom-1" src="{{ asset('assets/hat.svg') }}">
                <p class="absolute py-4 px-10 left-8 bottom-1 bg-white rounded-full shadow-md font-bold">Hello world, </p>
            </div>
        </section>
    </main>
@endsection
