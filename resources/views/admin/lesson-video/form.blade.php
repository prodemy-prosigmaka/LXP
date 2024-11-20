<div class="space-y-6">
    
    <div>
        <x-input-label for="lesson_id" :value="__('Lesson Id')"/>
        <x-text-input id="lesson_id" name="lesson_id" type="text" class="mt-1 block w-full" :value="old('lesson_id', $lessonVideo?->lesson_id)" autocomplete="lesson_id" placeholder="Lesson Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('lesson_id')"/>
    </div>
    <div>
        <x-input-label for="video_url" :value="__('Video Url')"/>
        <x-text-input id="video_url" name="video_url" type="text" class="mt-1 block w-full" :value="old('video_url', $lessonVideo?->video_url)" autocomplete="video_url" placeholder="Video Url"/>
        <x-input-error class="mt-2" :messages="$errors->get('video_url')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>