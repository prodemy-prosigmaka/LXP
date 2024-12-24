@props([
	'label' 		=> '',
	'parent_class' 	=> '',
	'error' 		=> '',
	'readonly' 		=> false,
	'value'			=> '',

	// value using stdClass, example: [ ['value' => 1, 'name' => 'bambang'] ]
	'options'		=> []
])

<label class="form-control {{ $parent_class }}">
	@isset($label)
		<div class="label">
			<span class="label-text">
				{{ $label }} {{ $value }}
			</span>
		</div>
	@endisset

	@if($readonly)
		<input
			readonly
			{{ $attributes->class('input input-bordered input-md') }}
		>
	@else
		<select {{ $attributes->class('select select-bordered select-md') }}>
			<option></option>
			@foreach ($options as $option)
				<option
					value="{{ $option->value }}"
					{{ $option->value == $value ? 'selected' : '' }}
				>
					{{ ucfirst(strtolower($option->name)) }}
				</option>
			@endforeach
		</select>
	@endif

	@isset($error)
		<div class="label">
			<span class="label-text-alt text-sm text-red-500">
				{{ $error }}
			</span>
		</div>
	@endisset
</label>
