<div class="space-y-6">
    
    <div>
        <x-input-label for="user_id" :value="__('User Id')"/>
        <x-text-input id="user_id" name="user_id" type="text" class="mt-1 block w-full" :value="old('user_id', $student?->user_id)" autocomplete="user_id" placeholder="User Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('user_id')"/>
    </div>
    <div>
        <x-input-label for="phonenumber" :value="__('Phonenumber')"/>
        <x-text-input id="phonenumber" name="phonenumber" type="text" class="mt-1 block w-full" :value="old('phonenumber', $student?->phonenumber)" autocomplete="phonenumber" placeholder="Phonenumber"/>
        <x-input-error class="mt-2" :messages="$errors->get('phonenumber')"/>
    </div>
    <div>
        <x-input-label for="occupation" :value="__('Occupation')"/>
        <x-text-input id="occupation" name="occupation" type="text" class="mt-1 block w-full" :value="old('occupation', $student?->occupation)" autocomplete="occupation" placeholder="Occupation"/>
        <x-input-error class="mt-2" :messages="$errors->get('occupation')"/>
    </div>
    <div>
        <x-input-label for="gender" :value="__('Gender')"/>
        <x-text-input id="gender" name="gender" type="text" class="mt-1 block w-full" :value="old('gender', $student?->gender)" autocomplete="gender" placeholder="Gender"/>
        <x-input-error class="mt-2" :messages="$errors->get('gender')"/>
    </div>
    <div>
        <x-input-label for="address" :value="__('Address')"/>
        <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $student?->address)" autocomplete="address" placeholder="Address"/>
        <x-input-error class="mt-2" :messages="$errors->get('address')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>