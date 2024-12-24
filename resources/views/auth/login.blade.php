@extends('auth._layouts.app')

@section('title', 'Login')

@section('content')
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="mt-1 block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="mt-1 block w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="mt-4 block">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- Login Credentials -->
         <div class="mt-4">
            <h3 class="text-sm font-semibold">Available Users :</h3>

            <section class="prose">
                <ul>
                    <li
                        onclick="use_admin()"
                        class="cursor-pointer">
                        dummy.admin@prosigmaka.com
                    </li>
                    <li
                        onclick="use_teacher()"
                        class="cursor-pointer">
                        dummy.teacher@prosigmaka.com
                    </li>
                    <li
                        onclick="use_student()"
                        class="cursor-pointer">
                        dummy.student@prosigmaka.com
                    </li>
                </ul>
            </section>

            <h3 class="text-sm font-semibold">Password :</h3>

            <section class="prose">
                <ul>
                    <li>dummypsm</li>
                </ul>
            </section>
         </div>

        <div class="mt-4 flex items-center justify-end">
            @if (Route::has('password.request'))
                <a class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
@endsection

@push('script')
    <script type="text/javascript">
        function use_admin () {
            document.querySelector('#email').value = 'dummy.admin@prosigmaka.com'
            document.querySelector('#password').value = 'dummypsm'
        }
        function use_teacher () {
            document.querySelector('#email').value = 'dummy.teacher@prosigmaka.com'
            document.querySelector('#password').value = 'dummypsm'
        }
        function use_student () {
            document.querySelector('#email').value = 'dummy.student@prosigmaka.com'
            document.querySelector('#password').value = 'dummypsm'
        }
    </script>
@endpush