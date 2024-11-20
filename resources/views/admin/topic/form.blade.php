<div class="space-y-6">
    
    <div>
        <x-input-label for="chapter_id" :value="__('Chapter Id')"/>
        <x-text-input id="chapter_id" name="chapter_id" type="text" class="mt-1 block w-full" :value="old('chapter_id', $topic?->chapter_id)" autocomplete="chapter_id" placeholder="Chapter Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('chapter_id')"/>
    </div>
    <div>
        <x-input-label for="title" :value="__('Title')"/>
        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $topic?->title)" autocomplete="title" placeholder="Title"/>
        <x-input-error class="mt-2" :messages="$errors->get('title')"/>
    </div>
    <div>
        <x-input-label for="sort_order" :value="__('Sort Order')"/>
        <x-text-input id="sort_order" name="sort_order" type="text" class="mt-1 block w-full" :value="old('sort_order', $topic?->sort_order)" autocomplete="sort_order" placeholder="Sort Order"/>
        <x-input-error class="mt-2" :messages="$errors->get('sort_order')"/>
    </div>
    <div>
        <x-input-label for="type" :value="__('Type')"/>
        <x-text-input id="type" name="type" type="text" class="mt-1 block w-full" :value="old('type', $topic?->type)" autocomplete="type" placeholder="Type"/>
        <x-input-error class="mt-2" :messages="$errors->get('type')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>