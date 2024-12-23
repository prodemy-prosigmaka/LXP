@props([
	'label' => '',
	'parent_class' => '',
	'error' => ''
])

<label class="form-control {{ $parent_class }}">
	@isset($label)
		<div class="label">
			<span class="label-text">
				{{ $label }}
			</span>
		</div>
	@endisset

	<input
		{{ $attributes->class('input input-bordered input-md') }}
	>

	@isset($error)
		<div class="label">
			<span class="label-text-alt text-sm text-red-500">
				{{ $error }}
			</span>
		</div>
	@endisset
</label>
