@php
    use App\Enums\RoleEnum;
@endphp

<header class="navbar sticky top-0 z-20 flex justify-between bg-base-100 px-4 shadow-md md:px-20">
    <div class="flex gap-4">
        <a href="{{ route('landing.index') }}">
            <img src="{{ asset('assets/logo-prodemy.png') }}" alt="logo" class="w-28">
        </a>

        <a href="{{ route('courselist.index') }}"
            class="btn btn-outline btn-sm border-secondary text-secondary hover:border-secondary hover:bg-secondary hover:text-white">Courses</a>
    </div>

    <nav class="flex-none gap-6">
        @if (Auth::check())
            @hasanyrole([RoleEnum::ADMIN, RoleEnum::INSTRUCTOR])
                <a href="{{ route('admin.dashboard') }}" class="link link-secondary self-center no-underline">Admin Dashboard</a>
            @endhasanyrole

            <a href="{{ route('mylearning') }}" class="link link-secondary self-center no-underline">My Learning</a>

            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="avatar btn btn-circle btn-ghost p-0">
                    <div class="w-10 rounded-full">
                        <img alt="icon" src="{{ asset('assets/avatar.svg') }}">
                    </div>
                </div>

                <ul tabindex="0"
                    class="menu dropdown-content menu-md z-[1] mt-3 w-52 rounded-box bg-base-100 p-2 text-secondary shadow">
                    <li>
                        <a class="justify-between">
                            Profile
                        </a>
                    </li>

                    <li><a>Settings</a></li>

                    <x-form-button :action="route('logout')"
                        class="btn btn-sm w-full justify-start bg-transparent px-4 font-normal text-secondary">
                        Logout
                    </x-form-button>
                </ul>
            </div>
        @else
            <div class="menu menu-horizontal gap-4 px-1">
                <a href="{{ route('login') }}" class="link link-secondary self-center no-underline">Sign In</a>
                <a href="{{ route('register') }}" class="btn btn-primary btn-sm font-bold">Sign Up</a>
            </div>
        @endif

    </nav>
</header>
