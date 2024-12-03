<script setup>
	import { reactive, watch } from 'vue';
	import { usePage } from '@inertiajs/vue3';
	import { CircleCheckIcon, CircleXIcon, InfoIcon, XIcon } from 'lucide-vue-next'


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


	const page = usePage()

	const message = reactive({ key: null, value: null })

	watch(
		() => page.props.flash,
		function (flash) {
			const filled_key = Object
								.keys(flash)
								.find(key => flash[key] != null)

			message.key 	= filled_key,
			message.value 	= filled_key && flash[filled_key]
		},
		{ deep: true, immediate: true }
	)

	function close_alert () {
		message.key 	= null
		message.value 	= null
	}
</script>

<template>
	<div
		v-if="message.key"
		role="alert"
		class="alert border-0 text-white shadow mb-4"
		:class="color_mapping[message.key]"
	>
		<component
			:is="icon_mapping[message.key]"
			class="w-6 h-6" />
		<span>
			{{ message.value }}
		</span>
		<button
			@click="close_alert"
			type="button"
			class="btn btn-ghost">
			<XIcon class="w-6 h-6" />
		</button>
	</div>
</template>