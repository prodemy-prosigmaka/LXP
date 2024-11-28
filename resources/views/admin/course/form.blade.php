<div class="space-y-6">
    
    <div>
        <x-input-label for="instructor_id" :value="__('Instructor Id')"/>
        <x-text-input id="instructor_id" name="instructor_id" type="text" class="mt-1 block w-full" :value="old('instructor_id', $course?->instructor_id)" autocomplete="instructor_id" placeholder="Instructor Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('instructor_id')"/>
    </div>
    <div>
        <x-input-label for="title" :value="__('Title')"/>
        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $course?->title)" autocomplete="title" placeholder="Title"/>
        <x-input-error class="mt-2" :messages="$errors->get('title')"/>
    </div>
    <div>
        <x-input-label for="caption" :value="__('Caption')"/>
        <x-text-input id="caption" name="caption" type="text" class="mt-1 block w-full" :value="old('caption', $course?->caption)" autocomplete="caption" placeholder="Caption"/>
        <x-input-error class="mt-2" :messages="$errors->get('caption')"/>
    </div>
    <div>
        <x-input-label for="description" :value="__('Description')"/>
        <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description', $course?->description)" autocomplete="description" placeholder="Description"/>
        <x-input-error class="mt-2" :messages="$errors->get('description')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>