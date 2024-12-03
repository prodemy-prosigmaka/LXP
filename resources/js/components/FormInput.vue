<script setup>
	defineProps({
		label: String,
		parent_class: String,
		error: String
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
			v-model="value"
			class="input input-bordered input-md"
			v-bind="$attrs" />

		<div v-if="error" class="label">
			<span class="label-text-alt text-red-500 text-sm">
				{{ error }}
			</span>
		</div>
	</label>
</template>