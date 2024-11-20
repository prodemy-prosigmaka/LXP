<div class="space-y-6">
    
    <div>
        <x-input-label for="lesson_id" :value="__('Lesson Id')"/>
        <x-text-input id="lesson_id" name="lesson_id" type="text" class="mt-1 block w-full" :value="old('lesson_id', $lessonPdf?->lesson_id)" autocomplete="lesson_id" placeholder="Lesson Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('lesson_id')"/>
    </div>
    <div>
        <x-input-label for="pdf_url" :value="__('Pdf Url')"/>
        <x-text-input id="pdf_url" name="pdf_url" type="text" class="mt-1 block w-full" :value="old('pdf_url', $lessonPdf?->pdf_url)" autocomplete="pdf_url" placeholder="Pdf Url"/>
        <x-input-error class="mt-2" :messages="$errors->get('pdf_url')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>