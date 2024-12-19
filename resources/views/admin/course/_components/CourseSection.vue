<script setup>
	import { ref } from 'vue'
	import { useForm, router } from '@inertiajs/vue3'
	import { XIcon, CheckIcon, SquarePenIcon, Trash2Icon } from 'lucide-vue-next'
	import { FormInput, FormSelect, FormTextarea } from '@/components';


	const props = defineProps({
		instructor_options 	: Array,
		course_id 			: [Number, null],
		course 				: [Object, null],
		is_course_exist 	: Boolean
	})

	const is_editing 		= ref(props.is_course_exist ? false : true)

	const preview_image 	= ref(props.is_course_exist
		? props.course.image
		: 'https://www.svgrepo.com/show/508699/landscape-placeholder.svg')

	const form = useForm({
		title			: props.is_course_exist ? props.course.title 			: '',
		instructor_id	: props.is_course_exist ? props.course.instructor_id 	: '',
		image			: props.is_course_exist ? props.course.image 			: '',
		caption			: props.is_course_exist ? props.course.caption 		: '',
		description		: props.is_course_exist ? props.course.description 	: '',
	})


	function submit () {
		if (props.is_course_exist) 	update_course()
		else 						store_course()
	}

	function store_course () {
		form.post(route('admin.courses.store'), {
			preserveState: "errors",
			onSuccess: () => window.scrollTo({
				top: 500,
				behavior: 'smooth'
			}),
			onError: errors => form.setError(errors)
		})
	}

	function update_course () {
		form.put(route('admin.courses.update', props.course_id), {
			preserveState: "errors",
		})
	}

	function delete_course () {
		const is_confirmed = confirm('Are you sure?')
		if (!is_confirmed) return false;

		form.processing = true
		router.delete(route('admin.courses.destroy', props.course_id), {
			onFinish 	: () => form.processing = false,
			onError 	: (error) => alert(error.course_delete)
		})
	}

	function reset_form () {
		form.reset()
		form.clearErrors()
		is_editing.value = false
	}
</script>

<template>
	<form
		@submit.prevent="submit"
		class="grid grid-cols-12 gap-8 rounded-3xl bg-white p-8 shadow"
	>
		<section class="col-span-7 flex flex-col gap-4">

			<FormInput
				label="Course Title"
				v-model="form.title"
				:error="form.errors.title"
				:autofocus="is_editing"
				:readonly="!is_editing"
				type="text"
			/>

			<FormSelect
				label="Instructor"
				v-model="form.instructor_id"
				:error="form.errors.instructor_id"
				:options="instructor_options"
				:readonly="!is_editing"
			/>

			<FormInput
				label="Caption"
				v-model="form.caption"
				:error="form.errors.caption"
				:readonly="!is_editing"
				type="text"
			/>

			<FormTextarea
				label="Description"
				v-model="form.description"
				:error="form.errors.description"
				:readonly="!is_editing"
				rows="4"
			/>

		</section>

		<section class="col-span-5 flex flex-col gap-2">
			<img
				:src="preview_image"
				class="aspect-[4/3] w-full rounded-2xl object-cover">

			<FormInput
				label="Image URL"
				v-model="form.image"
				:error="form.errors.image"
				:readonly="!is_editing"
				@change="(evt) => preview_image = evt.target.value"
				type="text"
			/>

			<span id="post-create-anchor" class="flex-grow"></span>

			<div class="mt-4 flex justify-end gap-2">
				<button
					v-if="!is_editing && props.is_course_exist"
					@click="delete_course"
					:disabled="form.processing"
					type="button"
					class="btn btn-neutral btn-md shadow">
					<span  v-if="form.processing" class="loading loading-spinner"/>
					<Trash2Icon v-else class="h-4 w-4" />
					Delete
				</button>

				<button
					v-if="!is_editing && props.is_course_exist"
					@click="is_editing = true"
					:disabled="form.processing"
					type="button"
					class="btn btn-secondary btn-md shadow">
					<SquarePenIcon class="h-4 w-4" />
					Edit
				</button>

				<button
					v-if="is_editing && props.is_course_exist"
					@click="reset_form"
					:disabled="form.processing"
					type="button"
					class="btn btn-neutral btn-md shadow">
					<XIcon class="h-4 w-4" />
					Cancel
				</button>

				<button
					v-if="is_editing"
					:disabled="form.processing"
					type="submit"
					class="btn btn-primary btn-md shadow">
					<span  v-if="form.processing" class="loading loading-spinner"/>
					<CheckIcon v-else class="h-4 w-4" />
					Submit
				</button>
			</div>
		</section>
	</form>
</template>