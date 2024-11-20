<div class="space-y-6">
    
    <div>
        <x-input-label for="lesson_id" :value="__('Lesson Id')"/>
        <x-text-input id="lesson_id" name="lesson_id" type="text" class="mt-1 block w-full" :value="old('lesson_id', $lessonArticle?->lesson_id)" autocomplete="lesson_id" placeholder="Lesson Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('lesson_id')"/>
    </div>
    <div>
        <x-input-label for="content" :value="__('Content')"/>
        <x-text-input id="content" name="content" type="text" class="mt-1 block w-full" :value="old('content', $lessonArticle?->content)" autocomplete="content" placeholder="Content"/>
        <x-input-error class="mt-2" :messages="$errors->get('content')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>