<ul class="menu gap-4 w-2/6">
    @foreach ($courses->chapters as $chapter)
        <li class="bg-accent rounded-box">
            <details>
                <summary class="p-6 hover:bg-inherit no-bg-on-click">
                    <span class="truncate">{{ $chapter->title }}</span>
                </summary>
                <ul class="flex flex-col gap-2 mb-6">
                    @foreach ($chapter->topics as $topic)
                    <li class="mr-6 ms-0 bg-white rounded-full hover:bg-primary">
                        <a>
                            <span class="truncate"><b>Video:</b> {{ $topic->title }}</span>
                            <x-lucide-circle-play class="w-4 h-4 ml-auto" />
                        </a>
                    </li>
                    @endforeach
                </ul>
            </details>
        </li>
    @endforeach
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
