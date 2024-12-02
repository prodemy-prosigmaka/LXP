<script setup>
	import { ref } from 'vue'
	import { Head, useForm, router } from '@inertiajs/vue3'
	import { ChevronLeftIcon, XIcon, CheckIcon, SquarePenIcon, Trash2Icon } from 'lucide-vue-next'
	import { Alert, FormInput, FormSelect, FormTextarea } from '@/components';

	const props = defineProps({
		instructor_options 	: Array,
		course_id 			: [Number, null],
		course 				: [Object, null],
		flash 				: Object,
		errors 				: Object
	})

	const is_course_exist 	= !!props.course_id
	const is_editing 		= ref(is_course_exist ? false : true)

	const preview_image 	= ref(is_course_exist
		? props.course.image
		: 'https://www.svgrepo.com/show/508699/landscape-placeholder.svg')

	const form = useForm({
		title			: is_course_exist ? props.course.title 			: '',
		instructor_id	: is_course_exist ? props.course.instructor_id 	: '',
		image			: is_course_exist ? props.course.image 			: '',
		caption			: is_course_exist ? props.course.caption 		: '',
		description		: is_course_exist ? props.course.description 	: '',
	})


	function submit () {
		if (is_course_exist) 	update_course()
		else 					store_course()
	}

	function store_course () {
		form.post(route('admin.courses.store'), {
			preserveState: false,
			onSuccess: () => window.location.hash = 'post-create-anchor'
		})
	}

	function update_course () {
		form.put(route('admin.courses.update', props.course_id), {
			preserveState: false,
			onSuccess: () => window.location.hash = ''
		})
	}

	function delete_course () {
		const is_confirmed = confirm('Are you sure?')
		if (!is_confirmed) return false;

		form.processing = true
		router.delete(route('admin.courses.destroy', props.course_id), {
			onFinish: () => form.processing = false
		})
	}
</script>

<template>
	<Head title="Intercative CMS | LXP" />

	<header class="flex items-center justify-between">
		<h1 class="text-3xl font-semibold py-8">
			{{ is_course_exist ? 'Course Detail' : 'Course Creation Form' }}
		</h1>

		<a
			:href="$route('admin.courses.index')"
			:disabled="form.processing ? true : null"
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

	<form
		@submit.prevent="submit"
		class="bg-white p-8 rounded-3xl shadow grid grid-cols-12 gap-8"
	>
		<section class="col-span-7 flex flex-col gap-4">

			<FormInput
				label="Course Title"
				v-model="form.title"
				:error="errors.title"
				:autofocus="is_editing"
				:readonly="!is_editing"
				type="text"
			/>

			<FormSelect
				label="Course Title"
				v-model="form.instructor_id"
				:error="errors.instructor_id"
				:options="instructor_options"
				:readonly="!is_editing"
			/>

			<FormInput
				label="Caption"
				v-model="form.caption"
				:error="errors.caption"
				:readonly="!is_editing"
				type="text"
			/>

			<FormTextarea
				label="Description"
				v-model="form.description"
				:error="errors.description"
				:readonly="!is_editing"
				rows="4"
			/>

		</section>

		<section class="col-span-5 flex flex-col gap-2">
			<img
				:src="preview_image"
				class="w-full aspect-[4/3] object-cover rounded-2xl">

			<FormInput
				label="Image URL"
				v-model="form.image"
				:error="errors.image"
				:readonly="!is_editing"
				@change="(evt) => preview_image = evt.target.value"
				type="text"
			/>

			<span id="post-create-anchor" class="flex-grow"></span>

			<div class="flex justify-end gap-2 mt-4">
				<button
					v-if="!is_editing && is_course_exist"
					@click="delete_course"
					:disabled="form.processing"
					type="button"
					class="btn btn-md btn-neutral shadow">
					<span  v-if="form.processing" class="loading loading-spinner"/>
					<Trash2Icon v-else class="w-4 h-4" />
					Delete
				</button>

				<button
					v-if="!is_editing && is_course_exist"
					@click="is_editing = true"
					:disabled="form.processing"
					type="button"
					class="btn btn-md btn-secondary shadow">
					<SquarePenIcon class="w-4 h-4" />
					Edit
				</button>

				<button
					v-if="is_editing && is_course_exist"
					@click="is_editing = false"
					:disabled="form.processing"
					type="button"
					class="btn btn-md btn-neutral shadow">
					<XIcon class="w-4 h-4" />
					Cancel
				</button>

				<button
					v-if="is_editing"
					:disabled="form.processing"
					type="submit"
					class="btn btn-md btn-primary shadow">
					<span  v-if="form.processing" class="loading loading-spinner"/>
					<CheckIcon v-else class="w-4 h-4" />
					Submit
				</button>
			</div>
		</section>
	</form>

	<div class="divider"></div>

	<section v-if="is_course_exist" class="min-h-screen mt-8">
		<h2 class="text-3xl font-semibold mb-8">Course Topics</h2>

		<Alert
			v-if="flash.success && flash.success?.includes('created')"
			:message="flash.success"
			type="success"/>
	</section>

</template>