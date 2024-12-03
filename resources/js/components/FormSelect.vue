<script setup>
	defineProps({
		label: String,
		parent_class: String,
		error: String,
		readonly: Boolean,

		// example { value: '', label: '' }
		options: Array,
	})

	defineOptions({
		inheritAttrs: false
	})

	const value = defineModel()
</script>

<template>
	<label class="form-control" :class="parent_class">
		<div v-if="label" class="label">
			<span class="label-text">
				{{ label }}
			</span>
		</div>

		<input
			v-if="readonly"
			:value="options.find(opt => opt.value == value)?.label"
			readonly
			class="input input-bordered input-md"
			v-bind="$attrs"
		/>
		<select
			v-model="value"
			v-else
			class="select select-bordered select-md"
			v-bind="$attrs"
		>
			<option disabled></option>
			<option
				v-for="opt in options"
				:value="opt.value">
				{{ opt.label }}
			</option>
		</select>

		<div v-if="error" class="label">
			<span class="label-text-alt text-red-500 text-sm">
				{{ error }}
			</span>
		</div>
	</label>
</template>