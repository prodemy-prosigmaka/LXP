<div class="space-y-6">
    
    <div>
        <x-input-label for="student_id" :value="__('Student Id')"/>
        <x-text-input id="student_id" name="student_id" type="text" class="mt-1 block w-full" :value="old('student_id', $courseStudent?->student_id)" autocomplete="student_id" placeholder="Student Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('student_id')"/>
    </div>
    <div>
        <x-input-label for="course_id" :value="__('Course Id')"/>
        <x-text-input id="course_id" name="course_id" type="text" class="mt-1 block w-full" :value="old('course_id', $courseStudent?->course_id)" autocomplete="course_id" placeholder="Course Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('course_id')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>