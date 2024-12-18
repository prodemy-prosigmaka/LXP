<script setup>
	import { ref } from 'vue'
	import { useForm, router } from '@inertiajs/vue3';
	import { FormInput, FormTabs } from '@/components';
	import { CheckIcon, SquarePenIcon, Trash2Icon, XIcon } from 'lucide-vue-next';

	const props = defineProps({
		course_id		: [String, Number],
		chapter_id		: [String, Number],
		topic_id		: [String, Number, null],
		topic			: [Object, null],
		children_type	: [String, null]
	})

	const is_topic_exists 	= !!props.topic_id
	const is_editing 		= ref(is_topic_exists ? false : true)

	const form = useForm({
		chapter_id			: props.chapter_id,
		id					: is_topic_exists ? props.topic.id : '',
		title				: is_topic_exists ? props.topic.title : '',
		type				: is_topic_exists ? props.topic.type : '',
		children_type		: is_topic_exists ? props.children_type : '',
		leave_after_submit	: is_topic_exists ? true : false
	})

	function submit_no_leave () {
		form.leave_after_submit = false
		submit()
	}

	function submit () {
		if (is_topic_exists)	update_topic()
		else					store_topic()
	}

	function store_topic () {
		form.post(route('admin.topics.store', {
			course	: props.course_id,
			chapter	: props.chapter_id,
		}), {
			preserveState	: "errors",
			onError			: errors => form.setError(errors),
			onSuccess		: () => {
				reset_form()
				window.scrollTo({
					top: 400,
					behavior: 'smooth'
				})
			},
		})
	}

	function update_topic () {
		const is_confirmed = confirm(`If you change the topic's type, you will lose all related data of the previous type. Are you sure?`)

		if (!is_confirmed) return false

		form.put(route('admin.topics.update', {
			course	: props.course_id,
			chapter	: props.chapter_id,
			topic	: props.topic_id,
		}), {
			preserveState	: "errors",
			onSuccess		: reset_form,
			onError			: errors => form.setError(errors)
		})
	}

	function delete_topic() {
		const is_confirmed = confirm('Are you sure?')
		if (!is_confirmed) return false;

		form.processing = true
		router.delete(route('admin.topics.destroy', {
			course	: props.course_id,
			chapter	: props.chapter_id,
			topic	: props.topic_id,
		}), {
			onFinish: () => form.processing = false,
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
		class="grid gap-6 rounded-3xl bg-white p-8 shadow">

		<FormInput
			label="Topic Title:"
			v-model="form.title"
			:error="form.errors.title"
			:readonly="!is_editing"
			:autofocus="is_editing" />

		<FormTabs
			label="Topic Types:"
			v-model="form.type"
			:error="form.errors.type"
			:readonly="!is_editing"
			:options="[
				{ value: 'lesson', label: 'Lesson' },
				{ value: 'practice', label: 'Practice' },
			]" />

		<FormTabs
			v-if="form.type == 'lesson'"
			label="Lesson Type:"
			v-model="form.children_type"
			:error="form.errors.children_type"
			:readonly="!is_editing"
			:options="[
				{ value: 'video', label: 'Video' },
				{ value: 'pdf', label: 'PDF' },
				{ value: 'article', label: 'Article' },
			]" />

		<FormTabs
			v-if="form.type == 'practice'"
			label="Practice Type:"
			v-model="form.children_type"
			:error="form.errors.children_type"
			:readonly="!is_editing"
			:options="[
				{ value: 'single_choice', label: 'Single Choice' },
				{ value: 'code_challenge', label: 'Code Challenge' },
				{ value: 'open_question', label: 'Open Question' },
			]" />

		<section class="flex justify-end gap-2">
			<button
				v-if="!is_editing && is_topic_exists"
				@click="delete_topic"
				:disabled="form.processing"
				type="button"
				class="btn btn-neutral btn-md shadow">
				<span v-if="form.processing" class="loading loading-spinner" />
				<Trash2Icon v-else class="h-4 w-4" />
				Delete
			</button>

			<button
				v-if="!is_editing && is_topic_exists"
				@click="is_editing = true"
				:disabled="form.processing"
				type="button"
				class="btn btn-secondary btn-md shadow">
				<SquarePenIcon class="h-4 w-4" />
				Edit
			</button>

			<button
				v-if="is_editing && is_topic_exists"
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
				@click="submit_no_leave"
				:type="is_topic_exists ? 'button' : 'submit'"
				class="btn btn-primary btn-md shadow">
				<span
					v-if="form.processing && !form.leave_after_submit"
					class="loading loading-spinner" />
				<CheckIcon v-else class="h-4 w-4" />
				{{ is_topic_exists ? 'Submit And Stay Here' : 'Submit' }}
			</button>

			<button
				v-if="is_editing && is_topic_exists"
				:disabled="form.processing"
				type="submit"
				class="btn btn-primary btn-md shadow">
				<span
					v-if="form.processing && form.leave_after_submit"
					class="loading loading-spinner" />
				<CheckIcon v-else class="h-4 w-4" />
				Submit Then Go Back
			</button>
		</section>
	</form>
</template>