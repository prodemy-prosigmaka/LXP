<section>
    <iframe class="aspect-video w-full rounded-box" src="{{ $lesson->video->video_url }}"
        title="YouTube video player" frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
    </iframe>

    <h1 class="mt-4 font-bold text-2xl">{{ $topic->title }}</h1>
</section>
