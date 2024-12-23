@props([
    'title',
    'caption'
])

<div {{ $attributes->class(['p-4 sm:p-8 bg-white shadow rounded-3xl']) }}>
    @if(isset($title))

        <header class="sm:flex sm:items-center sm:justify-between">
            @if(isset($title))
                <section>
                    <h2 class="text-base font-semibold leading-6 text-gray-900">
                        {{ $title }}
                    </h2>
                    <p class="mt-2 text-sm text-gray-700">
                        {{ $caption }}
                    </p>
                </section>
            @endif

            @if (isset($header_action) && $header_action->hasActualContent())
                {{ $header_action }}
            @endif
        </header>

    @endif

    {{ $slot }}
</div>