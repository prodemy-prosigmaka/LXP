<script setup>
	import { CircleCheckIcon, CircleXIcon, InfoIcon, XIcon } from 'lucide-vue-next';
	import { ref, watch } from 'vue';

	const props = defineProps({
		type 	: String,
		message : String
	})

	const color_mapping = {
		'warning'	: 'alert-warning',
		'success'	: 'bg-primary text-white',
		'error'		: 'alert-error',
	}

	const icon_mapping = {
		'warning'	: InfoIcon,
		'success'	: CircleCheckIcon,
		'error'		: CircleXIcon,
	}

	const is_show = ref(true)

	watch(
		props.message,
		(val) => {
			if (!!val) is_show.value = true
		},
		{ immediate: true }
	)
</script>

<template>
	<div
		v-show="is_show"
		role="alert"
		class="alert border-0 rounded-3xl shadow mb-4"
		:class="color_mapping[type]"
	>
		<component
			:is="icon_mapping[type]"
			class="w-6 h-6" />
		<span>
			{{ message }}
		</span>
		<button
			@click="is_show = false"
			type="button"
			class="btn btn-ghost">
			<XIcon class="w-6 h-6" />
		</button>
	</div>
</template>