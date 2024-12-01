<ul class="menu gap-4 w-2/6">
    <li class="bg-accent rounded-box">
        <details open>
            <summary class="p-6 hover:bg-inherit no-bg-on-click">Parent</summary>
            <ul class="flex flex-col gap-2 mb-6">
                <li class="mr-6 ms-0 bg-white rounded-full hover:bg-primary">
                    <a>Submenu 1 <x-lucide-circle-play class="w-4 h-4 ml-auto" /></a>
                </li>
                <li class="mr-6 ms-0 bg-white rounded-full hover:bg-primary">
                    <a>Submenu 2 <x-lucide-circle-play class="w-4 h-4 ml-auto" /></a>
                </li>
                
            </ul>
        </details>
    </li>
    <li class="bg-accent rounded-box">
        <details>
            <summary class="p-6 hover:bg-inherit no-bg-on-click">Parent</summary>
            <ul class="flex flex-col gap-2 mb-6">
                <li class="mr-6 ms-0"><a>Submenu 1</a></li>
                <li class="mr-6 ms-0"><a>Submenu 2</a></li>

            </ul>
        </details>
    </li>
</ul>

@push('style')
    <style>
        .no-bg-on-click:focus,
        .no-bg-on-click:active {
            background-color: inherit !important;
        }

        .menu :where(li ul)::before {
            display: none !important;
        }
    </style>
@endpush
