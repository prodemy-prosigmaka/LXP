<script setup>
	import { ChevronLeftIcon } from 'lucide-vue-next'
	import { Alert } from '@/components';

	const props = defineProps({
		flash 			: Object,
		is_course_exist : Boolean
	})
</script>

<template>
	<header class="flex items-center justify-between">
		<h1 class="text-3xl font-semibold py-8">
			{{ is_course_exist ? 'Course Detail' : 'Course Creation Form' }}
		</h1>

		<a
			:href="$route('admin.courses.index')"
			class="btn btn-md bg-white shadow">
			<ChevronLeftIcon class="w-4 h-4" />
			Back
		</a>
	</header>

	<Alert
		v-if="flash.success && !flash.success?.includes('created')"
		:message="flash.success"
		type="success"
	/>
</template>