<script setup>
	import { ref, reactive, onMounted, nextTick } from 'vue';
	import { PlusIcon, SquarePenIcon, Trash2Icon, ArrowRight, XIcon, CheckIcon } from 'lucide-vue-next';
	import { useForm, router } from '@inertiajs/vue3';
	import Draggable from 'vuedraggable'

	import { Alert, FormInput } from '@/components';
	import { use_scroll_position_store } from '@/stores/scroll_position';


	const props = defineProps({
		flash 			: Object,
		course 			: Object,
		course_id 		: [Number, String],
		is_course_exist : Boolean
	})

	const scroll_position = use_scroll_position_store()

	const is_creating 		= ref(false)
	const is_editing 		= ref(false)
	const is_deleting_id 	= ref(0)
	const is_saving_sort	= ref(false)

	const chapters_drag 	= reactive(props.is_course_exist
										? JSON.parse(JSON.stringify(props.course.chapters))
										: [])

	const chapter_form 	= useForm({
		id 			: '',
		title 		: '',
		course_id 	: '',
	})

	function create_chapter () {
		chapter_form.reset()
		chapter_form.course_id 	= props.course.id
		is_creating.value 		= true
		is_editing.value 		= false
	}

	function edit_chapter (chapter) {
		chapter_form.id 		= chapter.id
		chapter_form.title 		= chapter.title
		chapter_form.course_id 	= chapter.course_id
		is_creating.value 		= false
		is_editing.value 		= true
	}

	function reset_form () {
		chapter_form.reset()
		chapter_form.clearErrors()
		is_editing.value 	= false
		is_creating.value 	= false
	}

	function store_chapter () {
		chapter_form.post(route('admin.chapters.store'), {
			preserveScroll 	: true,
			preserveState 	: "errors",
			onSuccess 		: reset_form,
			onError			: errors => chapter_form.setError(errors)
		})
	}

	function update_chapter () {
		chapter_form.put(route('admin.chapters.update', chapter_form.id), {
			preserveScroll 	: true,
			preserveState 	: "errors",
			onSuccess 		: reset_form,
			onError			: errors => chapter_form.setError(errors)
		})
	}

	function submit_chapter () {
		if 		(is_creating.value) store_chapter()
		else if (is_editing.value)  update_chapter()
	}

	function delete_chapter (chapter) {
		const is_confirm_delete = confirm('Are you sure?')
		if (!is_confirm_delete) return

		is_deleting_id.value 	= chapter.id

		router.delete(route('admin.chapters.destroy', chapter.id), {
			preserveScroll 	: true,
			preserveState 	: false,
			onSuccess 		: () => {
				is_deleting_id.value = 0
				reset_form()
			},
			onError 		: (error) => {
				alert(error.chapter_delete)
			}
		})
	}

	function create_topic (chapter_id) {
		scroll_position.set_last_value(window.scrollY)

		router.visit(route('admin.topics.create', {
			course: props.course_id,
			chapter: chapter_id
		}))
	}

	function edit_topic (chapter_id, topic_id) {
		scroll_position.set_last_value(window.scrollY)

		router.visit(route('admin.topics.edit', {
			course: props.course_id,
			chapter: chapter_id,
			topic: topic_id
		}))
	}

	function handle_drag_change (topics) {
		is_saving_sort.value = true
		const sort_payload = []

		for (const index in topics) {
			sort_payload.push({
				id			: topics[index].id,
				sort_order	: Number(index) + 1,
			})
		}

		router.patch(route('admin.topic_sorts.update'), sort_payload, {
			preserveScroll	: true,
			preserveState	: true,
			onFinish		: () => is_saving_sort.value = false
		})
	}

	onMounted(async () => {
		if (scroll_position.last_value) {
			await nextTick()
			window.scrollTo(0, scroll_position.last_value)
			scroll_position.set_last_value(0)
		}
	})
</script>

<template>
	<section
		v-if="is_course_exist"
		class="mt-8 flex min-h-screen flex-col items-start gap-6"
	>
		<h2 class="mb-4 text-3xl font-semibold">Chapters & Topics</h2>

		<Alert
			v-if="flash.success && flash.success?.includes('created')"
			:message="flash.success"
			type="success"/>

		<template v-for="(chapter, chapter_index) in course.chapters">
			<div class="grid w-full gap-4 rounded-3xl bg-white p-8 shadow">

				<!-- Chapter Title & Edit Form -->
				<form
					@submit.prevent="submit_chapter"
					class="flex items-center gap-4">
					<p>Chapter :</p>

					<FormInput
						v-if="chapter_form.id == chapter.id"
						parent_class="flex-grow"
						v-model="chapter_form.title"
					/>

					<h3 v-else class="flex-grow">
						{{ chapter.title }}
					</h3>

					<div class="join">
						<template v-if="chapter_form.id != chapter.id">
							<button
								@click="delete_chapter(chapter)"
								:disabled="is_deleting_id != 0"
								title="Delete Chapter"
								class="btn join-item btn-neutral btn-md shadow">
								<span v-if="is_deleting_id == chapter.id" class="loading loading-spinner"></span>
								<Trash2Icon class="h-4 w-4" />
							</button>
							<button
								@click="edit_chapter(chapter)"
								title="Edit Chapter"
								class="btn btn-secondary join-item btn-md shadow">
								<SquarePenIcon class="h-4 w-4" />
							</button>
						</template>

						<template v-if="is_editing && chapter_form.id == chapter.id">
							<button
								@click="reset_form"
								:disabled="chapter_form.processing"
								title="Cancel Edit"
								type="button"
								class="btn join-item btn-neutral btn-md shadow">
								<XIcon class="h-4 w-4" />
							</button>
							<button
								:disabled="chapter_form.processing"
								title="Submit"
								type="submit"
								class="btn btn-secondary join-item btn-md shadow">
								<span v-if="chapter_form.processing" class="loading loading-spinner"></span>
								<CheckIcon v-else class="h-4 w-4" />
							</button>
						</template>
					</div>
				</form>
				<span
					v-if="chapter_form.errors.title && chapter_form.id == chapter.id"
					class="label-text-alt text-sm text-red-500">
					{{ chapter_form.errors.title }}
				</span>

				<!-- === Draggable Topic List === -->
				<Draggable
					v-model="chapters_drag[chapter_index].topics"
					class="flex flex-col gap-4"
					ghost-class="opacity-50"
					item-key="id"
					:animation="200"
					:disabled="is_saving_sort"
					:component-data="{
						type: 'transition-group',
						name: 'flip-list'
					}"
					@change="handle_drag_change(chapters_drag[chapter_index].topics)"
				>
					<template #item="{element: topic}">
						<section class="flex cursor-grab items-center overflow-hidden rounded-2xl bg-gray-100 text-sm">
							<span class="p-4">{{ topic.title }}</span>
							<div class="flex-grow"></div>

							<button
								class="flex items-center border-l border-gray-200 p-4 hover:bg-gray-200 focus:opacity-50"
								@click="edit_topic(chapter.id, topic.id)"
							>
								<span class="mr-2 text-sm font-semibold">Detail</span>
								<ArrowRight class="h-4 w-4 cursor-pointer" />
							</button>
						</section>
					</template>
				</Draggable>

				<!-- === Add New Topic Button === -->
				<section>
					<button
						@click="create_topic(chapter.id)"
						preserve-scroll
						class="btn rounded-2xl bg-gray-100"
					>
						<PlusIcon class="h-4 w-4" />
						Add New Topic
					</button>
				</section>
			</div>
		</template>


		<!-- === Create New Chapter Form === -->
		<template v-if="is_creating">
			<div class="grid w-full gap-4 rounded-3xl bg-white p-8 shadow">
				<form
					@submit.prevent="submit_chapter"
					class="flex items-center gap-4">
					<p>Chapter :</p>

					<FormInput
						parent_class="flex-grow"
						v-model="chapter_form.title"
					/>

					<div class="join">
						<button
							@click="reset_form"
							:disabled="chapter_form.processing"
							title="Cancel Edit"
							type="button"
							class="btn join-item btn-neutral btn-md shadow">
							<XIcon class="h-4 w-4" />
						</button>
						<button
							:disabled="chapter_form.processing"
							title="Submit"
							type="submit"
							class="btn btn-secondary join-item btn-md shadow">
							<span v-if="chapter_form.processing" class="loading loading-spinner"></span>
							<CheckIcon v-else class="h-4 w-4" />
						</button>
					</div>
				</form>
				<span
					v-if="chapter_form.errors.title"
					class="label-text-alt text-sm text-red-500">
					{{ chapter_form.errors.title }}
				</span>
			</div>
		</template>

		<!-- === Create New Chapter Button === -->
		<button
			v-if="!is_creating && !is_editing"
			@click="create_chapter"
			class="btn btn-lg bg-white text-sm shadow">
			<PlusIcon class="h-4 w-4" />
			Add New Chapter
		</button>
	</section>
</template>

<style>
	.flip-list-move {
	  transition: transform 0.5s;
	}

	.no-move {
	  transition: transform 0s;
	}
</style>