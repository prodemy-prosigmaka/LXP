@php
    use App\Enums\RoleEnum;
@endphp

<div class="drawer sticky top-0 z-20">
    <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content flex flex-col">
        <!-- Navbar -->
        <header class="navbar bg-base-100 w-full px-4 md:px-20">
            {{-- burger menu --}}
            <div class="flex-none md:hidden">
                <label for="my-drawer-3" aria-label="open sidebar">
                    <x-lucide-menu class="w-8 h-8 mx-4 md:ml-0" />
                </label>
            </div>
            {{-- end of burger menu --}}

            <div class="flex flex-1 gap-4">
                <a href="{{ route('landing.index') }}">
                    <img src="{{ asset('assets/logo-prodemy.png') }}" alt="logo" class="w-28">
                </a>

                <a href="{{ route('courselist.index') }}"
                    class="hidden lg:inline-flex btn btn-outline btn-sm border-secondary text-secondary hover:bg-secondary hover:text-white hover:border-secondary">Courses</a>
            </div>

            <div>
                <ul class="menu menu-horizontal gap-4 p-0">
                    @if (Auth::check())
                        @hasanyrole([RoleEnum::ADMIN, RoleEnum::INSTRUCTOR])
                            <a href="{{ route('admin.dashboard') }}"
                                class="link link-secondary self-center no-underline">Admin Dashboard</a>
                        @endhasanyrole
                        
                        <a href="{{ route('mylearning') }}"
                            class="hidden lg:flex self-center link link-secondary no-underline">My
                            Learning</a>

                        <div class="dropdown dropdown-end">
                            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar p-0">
                                <div class="w-10 rounded-full">
                                    <img alt="icon" src="{{ asset('assets/avatar.svg') }}">
                                </div>
                            </div>

                            <ul tabindex="0"
                                class="menu menu-md dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow text-secondary">
                                {{-- <li><a class="justify-between">Profile</a></li>
                                <li><a>Settings</a></li> --}}

                                <x-form-button :action="route('logout')"
                                    class="btn btn-sm w-full justify-start px-4 bg-transparent text-secondary font-normal shadow-none border-none">
                                    Logout
                                </x-form-button>
                            </ul>
                        </div>
                    @else
                        <div class="hidden menu md:menu-horizontal px-1 gap-4">
                            <a href="{{ route('login') }}" class="link link-secondary no-underline self-center">Sign
                                In</a>
                            <a href="{{ route('register') }}" class="btn btn-sm btn-primary font-bold">Sign Up</a>
                        </div>
                    @endif
                </ul>
            </div>
        </header>
    </div>

    <div class="drawer-side">
        <label for="my-drawer-3" aria-label="close sidebar" class="drawer-overlay"></label>
        <ul class="menu bg-base-200 min-h-full w-80 p-4 gap-4">
            <a href="{{ route('landing.index') }}">
                <img src="{{ asset('assets/logo-prodemy.png') }}" alt="logo" class="w-28 mx-auto">
            </a>

            <li><a href="{{ route('courselist.index') }}">Courses</a></li>
            @if (!Auth::check())
                <li><a href="{{ route('login') }}">Sign In</a></li>
                <li><a href="{{ route('register') }}">Sign Up</a></li>
            @else
                <li><a href="{{ route('mylearning') }}">My Learning</a></li>
            @endif
        </ul>
    </div>
</div>
