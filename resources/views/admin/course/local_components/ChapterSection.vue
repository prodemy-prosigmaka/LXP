<script setup>
	import { Alert } from '@/components';

	const props = defineProps({
		flash 			: Object,
		is_course_exist : Boolean
	})
</script>

<template>
	<section v-if="is_course_exist" class="min-h-screen mt-8">
		<h2 class="text-3xl font-semibold mb-8">Chapters & Topics</h2>

		<Alert
			v-if="flash.success && flash.success?.includes('created')"
			:message="flash.success"
			type="success"/>
	</section>
</template>