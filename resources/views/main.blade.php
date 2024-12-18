<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @hasSection('title')
            <title>
                @yield('title') | {{ config('app.name') }}
            </title>
        @endif

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=mulish:400,600,700" rel="stylesheet" />

        <!-- Aos -->
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('style')

        <!-- Lottie -->
        <script src="https://unpkg.com/@lottiefiles/lottie-player@2.0.8/dist/lottie-player.js"></script>
    </head>
    <body class="font-sans antialiased">
        @yield('layout')
        @stack('script')

        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script>
          AOS.init();
        </script>
    </body>
</html>
