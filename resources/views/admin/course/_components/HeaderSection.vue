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
		<h1 class="py-8 text-3xl font-semibold">
			{{ is_course_exist ? 'Course Detail' : 'Create New Course' }}
		</h1>

		<a
			:href="$route('admin.courses.index')"
			class="btn btn-md bg-white shadow">
			<ChevronLeftIcon class="h-4 w-4" />
			Back
		</a>
	</header>

	<Alert
		v-if="flash.success && !flash.success?.includes('created')"
		:message="flash.success"
		type="success"
		class="mb-4"
	/>
</template>