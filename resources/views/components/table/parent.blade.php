<section {{ $attributes->class(['overflow-x-auto']) }}>
    <table class="w-full divide-y divide-gray-300">
        @if ($thead->hasActualContent())
            <thead>
                <tr>
                    {{ $thead }}
                </tr>
            </thead>
        @endif

        @if ($tbody->hasActualContent())
            <tbody {{ $tbody->attributes->class(['divide-y divide-gray-200 bg-white']) }}>
                {{ $tbody }}
            </tbody>
        @endif
    </table>

    @if ($pagination->hasActualContent())
        <div {{ $tbody->attributes->class(['mt-4 px-4']) }}>
            {{ $pagination }}
        </div>
    @endif
</section>