<script setup>
	import HeaderSection from './_components/HeaderSection.vue'
	import TopicSection from './_components/TopicSection.vue'
	import DetailLessonVideo from './_components/DetailLessonVideo.vue'
	import DetailLessonPdf from './_components/DetailLessonPdf.vue'
	import DetailLessonArticle from './_components/DetailLessonArticle.vue'


	const props = defineProps({
		course_id		: [String, Number],
		chapter_id		: [String, Number],
		topic_id		: [String, Number, null],
		topic			: [Object, null],
		errors			: [Object, null],
		children_type	: [String, null]
	})

	const is_topic_exists = !!props.topic_id

	const header_section_props = {
		course_id : props.course_id
	}

	const topic_section_props = {
		course_id		: props.course_id,
		chapter_id		: props.chapter_id,
		topic_id		: props.topic_id,
		topic			: props.topic,
		errors			: props.errors,
		children_type	: props.children_type,
	}

	const detail_lesson_video_props = {
		course_id		: props.course_id,
		chapter_id		: props.chapter_id,
		topic_id		: props.topic_id,
		errors			: props.errors,
		lesson_id		: props.topic?.lesson?.id,
		lesson_video	: props.topic?.lesson?.video
	}

	const detail_lesson_pdf_props = {
		course_id	: props.course_id,
		chapter_id	: props.chapter_id,
		topic_id	: props.topic_id,
		errors		: props.errors,
		lesson_id	: props.topic?.lesson?.id,
		lesson_pdf	: props.topic?.lesson?.pdf
	}

	const detail_lesson_article_props = {
		course_id		: props.course_id,
		chapter_id		: props.chapter_id,
		topic_id		: props.topic_id,
		errors			: props.errors,
		lesson_id		: props.topic?.lesson?.id,
		lesson_article	: props.topic?.lesson?.article
	}
</script>


<template>
	<HeaderSection v-bind="header_section_props" />

	<TopicSection v-bind="topic_section_props" />

	<div v-if="is_topic_exists" class="divider"></div>

	<section
		v-if="is_topic_exists"
		class="mt-8"
	>
		<h2 class="mb-4 text-3xl font-semibold">Topic's Type Detail</h2>

		<detail-lesson-video
			v-if="children_type === 'video'"
			v-bind="detail_lesson_video_props"
		/>
		<detail-lesson-pdf
			v-if="children_type === 'pdf'"
			v-bind="detail_lesson_pdf_props"
		/>
		<detail-lesson-article
			v-if="children_type === 'article'"
			v-bind="detail_lesson_article_props"
		/>
	</section>
</template>

<style>
.ql-editor{
    min-height:200px;
}
</style>