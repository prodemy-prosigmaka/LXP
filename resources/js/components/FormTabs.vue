<script setup>
	defineProps({
		label: String,
		error: String,
		readonly: Boolean,

		// example { value: '', label: '' }
		options: Array,
	})

	const value = defineModel()
</script>

<template>
	<section class="form-control" v-bind="$attrs">
		<div class="flex flex-row items-center">
			<span v-if="label" class="label-text w-24">
				{{ label }}
			</span>
			<div class="tabs-boxed tabs">
				<button
					v-for="option in options"
					:class="{'tab-active': option.value == value}"
					@click="readonly ? false : value = option.value"
					type="button"
					class="tab"
				>
					{{ option.label }}
				</button>
			</div>
		</div>

		<span v-if="error" class="mt-2 text-sm text-red-500">
			{{ error }}
		</span>
	</section>

</template>