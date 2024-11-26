<div class="space-y-6">
    
    <div>
        <x-input-label for="topic_id" :value="__('Topic Id')"/>
        <x-text-input id="topic_id" name="topic_id" type="text" class="mt-1 block w-full" :value="old('topic_id', $lesson?->topic_id)" autocomplete="topic_id" placeholder="Topic Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('topic_id')"/>
    </div>
    <div>
        <x-input-label for="title" :value="__('Title')"/>
        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $lesson?->title)" autocomplete="title" placeholder="Title"/>
        <x-input-error class="mt-2" :messages="$errors->get('title')"/>
    </div>
    <div>
        <x-input-label for="type" :value="__('Type')"/>
        <x-text-input id="type" name="type" type="text" class="mt-1 block w-full" :value="old('type', $lesson?->type)" autocomplete="type" placeholder="Type"/>
        <x-input-error class="mt-2" :messages="$errors->get('type')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>