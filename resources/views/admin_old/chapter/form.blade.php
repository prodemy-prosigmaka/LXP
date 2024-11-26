<div class="space-y-6">
    
    <div>
        <x-input-label for="course_id" :value="__('Course Id')"/>
        <x-text-input id="course_id" name="course_id" type="text" class="mt-1 block w-full" :value="old('course_id', $chapter?->course_id)" autocomplete="course_id" placeholder="Course Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('course_id')"/>
    </div>
    <div>
        <x-input-label for="title" :value="__('Title')"/>
        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $chapter?->title)" autocomplete="title" placeholder="Title"/>
        <x-input-error class="mt-2" :messages="$errors->get('title')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>