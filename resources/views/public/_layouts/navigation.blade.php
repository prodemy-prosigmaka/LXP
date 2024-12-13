<header class="sticky top-0 z-20 navbar flex justify-between bg-base-100 shadow-md px-4 md:px-20">
    <a href="{{ route('landing.index') }}">
        <img src="{{ asset('assets/logo-prodemy.png') }}" alt="logo" class="w-28">
    </a>
    <nav class="flex-none gap-4">
        @if (Auth::check())
            <a href="{{ route('mylearning') }}" class="self-center link link-secondary no-underline">My Learning</a>

            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar p-0">
                    <div class="w-10 rounded-full">
                        <img alt="icon" src="{{ asset('assets/avatar.svg') }}">
                    </div>
                </div>

                <ul tabindex="0"
                    class="menu menu-md dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow text-secondary">
                    <li>
                        <a class="justify-between">
                            Profile
                        </a>
                    </li>

                    <li><a>Settings</a></li>

                    <x-form-button :action="route('logout')"
                        class="btn btn-sm w-full justify-start px-4 bg-transparent text-secondary font-normal">
                        Logout
                    </x-form-button>
                </ul>
            </div>
        @else
            <div class="menu menu-horizontal px-1 gap-4">
                <a href="{{ route('login') }}" class="link link-secondary no-underline self-center">Sign In</a>
                <a href="{{ route('register') }}" class="btn btn-sm btn-primary font-bold">Sign Up</a>
            </div>
        @endif

    </nav>
</header>
