<ul class="menu gap-4 p-0">
    @foreach ($course->chapters as $chapter)
        <li class="bg-accent rounded-box">
            @php
                $isChapterOpen = $chapter->topics->contains('id', request()->route('topicId'));
            @endphp

            <details {{ $isChapterOpen ? 'open' : '' }}>
                <summary class="p-6 hover:bg-inherit no-bg-on-click">
                    <span class="truncate font-bold hover:overflow-visible hover:text-wrap">{{ $chapter->title }}</span>
                </summary>
                <ul class="flex flex-col gap-2 mb-6">
                    @foreach ($chapter->topics as $topic)
                        @php
                            $isSelected = request()->route('topicId') == $topic->id;
                        @endphp

                        <li
                            class="mr-6 ms-0 rounded-full hover:bg-primary hover:text-white {{ $isSelected ? 'bg-primary text-white' : 'bg-white' }}">
                            <a
                                href="{{ route('learning.show.' . $topic->lesson->type, ['courseId' => $course->id, 'topicId' => $topic->id]) }}">
                                <span class="truncate hover:overflow-visible hover:text-wrap">
                                    <b class="capitalize">{{ $topic->lesson->type }}:</b>
                                    {{ $topic->title }}
                                </span>
                                @if ($topic->lesson->type == 'video')
                                    <x-lucide-circle-play class="w-4 h-4 ml-auto" />
                                @elseif ($topic->lesson->type == 'pdf')
                                    <x-lucide-file-text class="w-4 h-4 ml-auto" />
                                @else
                                    <x-lucide-book-open class="w-4 h-4 ml-auto" />
                                @endif
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
