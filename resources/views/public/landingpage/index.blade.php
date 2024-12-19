@extends('public._layouts.app')

@section('title', 'Online Course Prodemy')

@section('content')
    <main>
        <section
            class="p-4 md:px-8 lg:px-20 md:py-0 flex flex-col items-center gap-24 bg-base-200 md:justify-between md:flex-row h-[calc(100vh-65px)]">
            <div class="w-full text-center md:text-left">
                <h1 class="mb-6 text-3xl lg:text-5xl font-bold">Be a <span class="text-primary">code whiz-ard!<span></h1>
                <p class="mb-6 lg:text-2xl">Learn to code faster like it’s magic!</p>
                <a href="#section2" class="btn btn-primary">
                    Get Started
                    <x-lucide-circle-arrow-right class="w-4 h-4" />
                </a>
            </div>

            <div>
                <div class="relative md:mr-20 xl:mr-40 w-32 h-32 md:w-52 md:h-52 xl:w-72 xl:h-72 bg-primary rounded-full">
                    <div
                        class="absolute p-4 top-1 right-16 z-10 md:right-32 xl:right-40 xl:top-12 bg-white rounded-full shadow-md">
                        <p class="font-bold text-xs xl:text-2xl">&lt;p&gt;Abracadabra&lt;/p&gt;</p>
                    </div>
                    <img alt="hero" class="absolute max-w-52 md:max-w-80 xl:max-w-md left-0 bottom-1"
                        src="{{ asset('assets/hat.svg') }}">
                    <div class="absolute p-4 left-24 bottom-1 xl:bottom-0 bg-white rounded-full shadow-md">
                        <p
                            class="font-bold text-xs xl:text-2xl animate-typing overflow-hidden whitespace-nowrap border-r-2 border-r-black pr-2">
                            Hello world,</p>
                    </div>
                </div>
            </div>
        </section>

        <section
            class="p-4 md:px-8 lg:px-20 md:py-0 grid grid-cols-1 md:grid-cols-2 items-center gap-24 h-[calc(100vh-65px)]"
            data-aos="fade-right" id="section2">
            <p class="lg:text-2xl xl:text-4xl font-bold !leading-normal">
                There might be <span class="text-primary">many resources</span> to learn code <span class="text-primary">on
                    the internet</span>, but finding the right
                ones can be <span class="text-primary">overwhelming.</span>
            </p>
            <lottie-player src="https://lottie.host/d9f41603-c70d-4dee-84e3-0befcdf4893e/gOe2IwajpX.json"
                background="##ffffff" speed="1" class="mx-auto lg:ml-auto lg:mr-0" loop autoplay direction="1"
                mode="normal"></lottie-player>

        </section>

        <section
            class="p-4 md:px-8 lg:px-20 md:py-0 grid grid-cols-1 md:grid-cols-2 items-center gap-24 h-[calc(100vh-64px)] bg-primary"
            data-aos="fade-right">
            <p class="lg:text-2xl xl:text-4xl font-bold text-white !leading-normal">
                But no worries! Prodemy is here to provide you the right materials <br> that are <span
                    class="bg-secondary px-2">industry-alligned</span>
                <br> and <span class="bg-secondary px-2">beginner
                    friendly.</span>
            </p>
            <lottie-player src="https://lottie.host/2df70e73-556e-424a-87e0-2521fbd96602/9y2bzkzJlf.json"
                background="##FFFFFF" speed="1" class="mx-auto w-52 h-52 xl:w-80 xl:h-80" loop autoplay direction="1"
                mode="normal"></lottie-player>
        </section>

        <section
            class="p-4 md:px-8 lg:px-20 md:py-0 flex flex-col justify-center items-center gap-8 h-[calc(100vh-64px)] bg-base-200"
            data-aos="fade-right">
            <p class="lg:text-2xl xl:text-5xl !leading-normal">
                Start your journey now! <br>
                And be a <b>code whiz-ard</b>
            </p>

            <a href="{{ route('courselist.index') }}" class="btn btn-lg xl:scale-150 btn-primary">
                Explore Now
                <x-lucide-circle-arrow-right class="w-4 h-4 xl:w-6 xl:h-6" />
            </a>
        </section>
    </main>
@endsection
