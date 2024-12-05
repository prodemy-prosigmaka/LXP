<script setup>
	import { ref, reactive } from 'vue';
	import { PlusIcon, SquarePenIcon, Trash2Icon, ArrowRight, XIcon, CheckIcon } from 'lucide-vue-next';
	import { Alert, FormInput } from '@/components';
	import { useForm, router, Link } from '@inertiajs/vue3';
	import Draggable from 'vuedraggable'

	const props = defineProps({
		flash 			: Object,
		course 			: Object,
		is_course_exist : Boolean
	})

	const is_creating 		= ref(false)
	const is_editing 		= ref(false)
	const is_deleting_id 	= ref(0)

	const chapters_drag 	= reactive(props.is_course_exist ? [...props.course.chapters] : [])
	const drag 				= ref(false)

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
		is_editing.value 	= false
		is_creating.value 	= false
	}

	function store_chapter () {
		chapter_form.post(route('admin.chapters.store'), {
			preserveScroll 	: true,
			preserveState 	: false,
			onSuccess 		: reset_form
		})
	}

	function update_chapter () {
		chapter_form.put(route('admin.chapters.update', chapter_form.id), {
			preserveScroll 	: true,
			preserveState 	: false,
			onSuccess 		: reset_form
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
</script>

<template>
	<section
		v-if="is_course_exist"
		class="min-h-screen mt-8 flex flex-col items-start gap-6"
	>
		<h2 class="text-3xl font-semibold mb-4">Chapters & Topics</h2>

		<Alert
			v-if="flash.success && flash.success?.includes('created')"
			:message="flash.success"
			type="success"/>

		<template v-for="(chapter, chapter_index) in course.chapters">
			<div class="bg-white p-8 rounded-3xl shadow w-full grid gap-4">
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
								class="btn btn-md join-item shadow btn-neutral">
								<span v-if="is_deleting_id == chapter.id" class="loading loading-spinner"></span>
								<Trash2Icon class="w-4 h-4" />
							</button>
							<button
								@click="edit_chapter(chapter)"
								title="Edit Chapter"
								class="btn btn-md join-item shadow btn-secondary">
								<SquarePenIcon class="w-4 h-4" />
							</button>
						</template>

						<template v-if="is_editing && chapter_form.id == chapter.id">
							<button
								@click="reset_form"
								:disabled="chapter_form.processing"
								title="Cancel Edit"
								type="button"
								class="btn btn-md join-item shadow btn-neutral">
								<XIcon class="w-4 h-4" />
							</button>
							<button
								:disabled="chapter_form.processing"
								title="Submit"
								type="submit"
								class="btn btn-md join-item shadow btn-secondary">
								<span v-if="chapter_form.processing" class="loading loading-spinner"></span>
								<CheckIcon v-else class="w-4 h-4" />
							</button>
						</template>
					</div>
				</form>

				<Draggable
					v-model="chapters_drag[chapter_index].topics"
					item-key="id"
					@start="drag=true"
					@end="drag=false"
					class="flex flex-col gap-4"
					:component-data="{
						type: 'transition-group',
						name: 'flip-list'
					}"
					:animation="200"
			        ghost-class="opacity-50"
				>
					<template #item="{element}">
						<Link
							:href="$route('admin.topics.show', element.id)"
							preserve-scroll
							class="bg-gray-100 p-4 rounded-2xl text-sm cursor-grab flex items-center">
							<span class="cursor-pointer">{{ element.title }}</span>
							<div class="flex-grow"></div>
							<ArrowRight class="w-4 h-4 cursor-pointer" />
						</Link>
					</template>
				</Draggable>

				<!-- <template v-for="topic in chapters_drag[chapter_index].topics">
					<Link
						:href="$route('admin.topics.show', chapter.id)"
						preserve-scroll
						class="bg-gray-100 p-4 rounded-2xl text-sm cursor-grab transition hover:scale-[102%] flex items-center">
						{{ topic.title }}
						<div class="flex-grow"></div>
						<ArrowRight class="w-4 h-4" />
					</Link>
				</template> -->
			</div>
		</template>

		<template v-if="is_creating">
			<div class="bg-white p-8 rounded-3xl shadow w-full grid gap-4">
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
							class="btn btn-md join-item shadow btn-neutral">
							<XIcon class="w-4 h-4" />
						</button>
						<button
							:disabled="chapter_form.processing"
							title="Submit"
							type="submit"
							class="btn btn-md join-item shadow btn-secondary">
							<span
								v-if="chapter_form.processing"
								class="loading loading-spinner"></span>
							<CheckIcon
								v-else
								class="w-4 h-4" />
						</button>
					</div>
				</form>
			</div>
		</template>

		<button
			v-if="!is_creating && !is_editing"
			@click="create_chapter"
			class="btn btn-lg bg-white shadow text-sm">
			<PlusIcon class="w-4 h-4" />
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