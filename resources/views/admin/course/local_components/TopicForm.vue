<script setup>
	import { Transition, ref, onMounted } from 'vue';
	import { router, useForm } from '@inertiajs/vue3'
	import { ChevronLeftIcon, CheckIcon } from 'lucide-vue-next';
	import { QuillEditor } from '@vueup/vue-quill'
	import '@vueup/vue-quill/dist/vue-quill.snow.css';

	import { FormInput, FormTextarea } from '@/components';


	const props = defineProps({
		course_id 			: [Number, null],
		topic 				: [Object, null],
		errors 				: Object
	})

	const is_topic_exist 	= !!props.topic
	const is_show			= ref(is_topic_exist ? true : false)

	const topic_form = useForm({
		id: '',
		chapter_id: '',
		title: '',
		type: '',
		lesson: {
			topic_id: '',
			type: '',
			video: {
				lesson_id: '',
				video_url: ''
			},
			pdf: {
				lesson_id: '',
				pdf_url: ''
			},
			article: {
				lesson_id: '',
				content: ''
			},
		},
		practice: {
			topic_id: '',
			type: ''
		}
	})

	onMounted(() => {
		if (is_topic_exist) {
			const topic = props.topic

			topic_form.id 			= topic.id
			topic_form.chapter_id 	= topic.chapter_id
			topic_form.title 		= topic.title
			topic_form.type 		= topic.type

			if (topic.type == 'lesson') {
				topic_form.lesson.topic_id 	= topic.lesson.topic_id
				topic_form.lesson.type 		= topic.lesson.type

				if (topic.lesson.type == 'video') {
					topic_form.lesson.video.lesson_id 	= topic.lesson.video.lesson_id
					topic_form.lesson.video.video_url 	= topic.lesson.video.video_url
				}
				if (topic.lesson.type == 'pdf') {
					topic_form.lesson.pdf.lesson_id 	= topic.lesson.pdf.lesson_id
					topic_form.lesson.pdf.pdf_url 		= topic.lesson.pdf.pdf_url
				}
				if (topic.lesson.type == 'article') {
					topic_form.lesson.article.lesson_id 	= topic.lesson.article.lesson_id
					topic_form.lesson.article.content 		= topic.lesson.article.content
				}
			}
			if (topic.type == 'practice') {
				topic_form.practice.topic_id 	= topic.practice.topic_id
				topic_form.practice.type 		= topic.practice.type
			}
		}
	})

	function submit () {
		alert('coming soon')
	}

	function initiate_go_back () {
		is_show.value = false
	}

	function execute_go_back () {
		router.visit(route('admin.courses.show', props.course_id), {
			preserveScroll: true,
		})
	}
</script>

<template>
	<section v-if="is_topic_exist" class="fixed inset-0 z-50 overflow-hidden">
		<Transition
			appear
			appear-active-class="transition-opacity ease-out duration-300"
			leave-active-class="transition-opacity ease-out duration-300"
			appear-from-class="opacity-0"
			leave-to-class="opacity-0"
			@after-leave="execute_go_back"
		>
			<div v-show="is_show" class="absolute inset-0 bg-black/25"></div>
		</Transition>

		<Transition
			appear
			appear-active-class="transition-all ease-out duration-250"
			leave-active-class="transition-all ease-out duration-250"
			appear-from-class="translate-x-24 opacity-0"
			leave-to-class="translate-x-24 opacity-0"
		>
			<div v-show="is_show" class="absolute bg-white rounded-l-3xl top-0 bottom-0 right-0 w-2/3 h-screen shadow-xl p-8 overflow-scroll">
				<header class="flex items-center justify-between">
					<h2 class="text-2xl font-semibold">
						Topic Form
					</h2>

					<button
						@click="initiate_go_back"
						class="btn btn-md shadow">
						<ChevronLeftIcon class="w-4 h-4" />
						Back
					</button>
				</header>

				<div class="divider"></div>

				<form
					@submit.prevent="submit"
					class="flex flex-col gap-6"
				>
					<FormInput
						label="Topic Title:"
						v-model="topic_form.title"
					/>

					<section class="form-control flex-row items-center">
						<span class="label-text w-24">Topic Type:</span>
						<div class="tabs tabs-boxed">
							<button
								:class="{'tab-active': topic_form.type == 'lesson'}"
								@click="topic_form.type = 'lesson'"
								type="button"
								class="tab">
								Lesson
							</button>
							<button
								:class="{'tab-active': topic_form.type == 'practice'}"
								@click="topic_form.type = 'practice'"
								type="button"
								class="tab">
								Practice
							</button>
						</div>
					</section>

					<section
						v-if="topic_form.type == 'lesson'"
						class="form-control flex-row items-center">
						<span class="label-text w-24">Lesson Type:</span>
						<div class="tabs tabs-boxed">
							<button
								:class="{'tab-active': topic_form.lesson?.type == 'video'}"
								@click="topic_form.lesson.type = 'video'"
								type="button"
								class="tab">
								Video
							</button>
							<button
								:class="{'tab-active': topic_form.lesson?.type == 'pdf'}"
								@click="topic_form.lesson.type = 'pdf'"
								type="button"
								class="tab">
								PDF
							</button>
							<button
								:class="{'tab-active': topic_form.lesson?.type == 'article'}"
								@click="topic_form.lesson.type = 'article'"
								type="button"
								class="tab">
								Article
							</button>
						</div>
					</section>

					<section
						v-if="topic_form.type == 'practice'"
						class="form-control flex-row items-center">
						<span class="label-text w-24">Practice Type:</span>
						<div class="tabs tabs-boxed">
							<button
								:class="{'tab-active': topic_form.practice?.type == 'single_choice'}"
								@click="topic_form.practice.type = 'single_choice'"
								type="button"
								class="tab">
								Single Choice
							</button>
							<button
								:class="{'tab-active': topic_form.practice?.type == 'code_challenge'}"
								@click="topic_form.practice.type = 'code_challenge'"
								type="button"
								class="tab">
								Code Challenge
							</button>
							<button
								:class="{'tab-active': topic_form.practice?.type == 'open_question'}"
								@click="topic_form.practice.type = 'open_question'"
								type="button"
								class="tab">
								Open Question
							</button>
						</div>
					</section>

					<section v-if="topic_form.lesson?.type == 'video'">
						<FormInput
							v-model="topic_form.lesson.video.video_url"
							label="Video URL"
						/>
						<iframe
							v-if="topic_form.lesson.video.video_url"
							:src="topic_form.lesson.video.video_url"
							class="aspect-video w-full rounded-box mt-6"
						    title="YouTube video player" frameborder="0"
						    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
						    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
						</iframe>
					</section>

					<section v-if="topic_form.lesson?.type == 'pdf'">
						<FormInput
							v-model="topic_form.lesson.pdf.pdf_url"
							label="Pdf URL"
						/>

						<object
							v-if="topic_form.lesson.pdf.pdf_url"
							:data="topic_form.lesson.pdf.pdf_url"
							class="pdf rounded-box w-full h-[300px] mt-6">
						</object>
					</section>


					<label
						v-if="topic_form.lesson?.type == 'article'"
						class="form-control">
						<div class="label">
							<span class="label-text">Article Content:</span>
						</div>

						<QuillEditor
							theme="snow"
							content-type="html"
							v-model:content="topic_form.lesson.article.content" />
					</label>

					<div class="divider mb-0 mt-2 h-0"></div>

					<section class="flex justify-end">
						<button
							type="submit"
							class="btn btn-md btn-primary shadow">
							<CheckIcon class="w-4 h-4" />
							Submit
						</button>
					</section>
				</form>
			</div>
		</Transition>
	</section>
</template>

<style>
	.ql-toolbar.ql-snow {
		@apply rounded-t-2xl;
	}
	.ql-container.ql-snow {
		@apply rounded-b-2xl;
	}
</style>