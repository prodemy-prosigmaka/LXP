<script setup>
	import { Link } from '@inertiajs/vue3'
	import { ChevronLeftIcon } from 'lucide-vue-next'

	defineProps({
		course_id: [Number, String]
	})
</script>

<template>
	<header class="flex items-center justify-between">
		<h1 class="py-8 text-3xl font-semibold">
			Topic Form
		</h1>

		<Link
			:href="$route('admin.courses.edit', course_id)"
			class="btn btn-md bg-white shadow"
		>
			<ChevronLeftIcon class="h-4 w-4" />
			Back
		</Link>
	</header>
</template>