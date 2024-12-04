<script setup>
	import { Head } from '@inertiajs/vue3'

	import HeaderSection from './local_components/HeaderSection.vue';
	import CourseSection from './local_components/CourseSection.vue';
	import ChapterSection from './local_components/ChapterSection.vue';


	const props = defineProps({
		instructor_options 	: Array,
		course_id 			: [Number, null],
		course 				: [Object, null],
		flash 				: Object,
		errors 				: Object
	})

	const is_course_exist 	= !!props.course_id

	const header_section_props = {
		flash 				: props.flash,
		is_course_exist 	: is_course_exist,
	}

	const course_section_props = {
		instructor_options 	: props.instructor_options,
		course_id 			: props.course_id,
		course 				: props.course,
		errors 				: props.errors,
		is_course_exist 	: is_course_exist,
	}

	const chapter_section_props = {
		flash 				: props.flash,
		is_course_exist 	: is_course_exist,
		course_id 			: props.course_id,
		course 				: props.course,
	}

</script>

<template>
	<Head title="Intercative CMS | LXP" />

	<HeaderSection v-bind="header_section_props" />

	<CourseSection v-bind="course_section_props" />

	<div class="divider"></div>

	<ChapterSection v-bind="chapter_section_props" />
</template>