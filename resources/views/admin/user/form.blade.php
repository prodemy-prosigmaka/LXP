<x-form.input
	label="User Name"
	type="text"
	name="name"
	value="{{ old('name', isset($user) ? $user->name : '') }}"
	:error="$errors->first('name')"
/>
<x-form.input
	label="Email"
	type="email"
	name="email"
	value="{{ old('email', isset($user) ? $user->email : '') }}"
	:error="$errors->first('email')"
/>
<x-form.select
	label="Role"
	name="role"
	value="{{ old('role', isset($user) ? $user->roles[0]->name : '') }}"
	:error="$errors->first('role')"
	:options="\App\Enums\RoleEnum::cases()"
/>
<section class="flex flex-row-reverse">
	<button type="submit" class="btn btn-primary mt-4">
		<x-lucide-check class="h-4 w-4" />
		Submit
	</button>
</section>