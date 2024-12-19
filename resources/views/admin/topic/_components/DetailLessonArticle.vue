<script setup>
	import { ref } from 'vue';
	import { useForm } from '@inertiajs/vue3';
	import { FormInput } from '@/components';
	import { CheckIcon, SquarePenIcon, XIcon } from 'lucide-vue-next'
	import { QuillEditor } from '@vueup/vue-quill'
	import '@vueup/vue-quill/dist/vue-quill.snow.css';

	const props = defineProps({
		course_id		: [String, Number],
		chapter_id		: [String, Number],
		topic_id		: [String, Number],
		lesson_id		: [String, Number],
		lesson_article	: [Object, null]
	})

	const is_article_exists	= !!props.lesson_article
	const is_editing 		= ref(is_article_exists ? false : true)

	const form = useForm({
		lesson_id			: props.lesson_id,
		content				: is_article_exists ? props.lesson_article.content : '',
		leave_after_submit	: true
	})


	function submit_no_leave() {
		form.leave_after_submit = false
		submit()
	}

	function submit () {
		if (is_article_exists)	update_article()
		else					store_article()
	}

	function store_article () {
		form.post(route('admin.lesson_articles.store', {
			course	: props.course_id,
		}), {
			preserveState	: "errors",
			preserveScroll	: form.leave_after_submit === false ? true : "errors",
			onSuccess		: reset_form,
			onError			: errors => form.setError(errors)
		})
	}

	function update_article () {
		form.put(route('admin.lesson_articles.update', {
			course			: props.course_id,
			lesson_article	: props.lesson_article.id,
		}), {
			preserveState	: "errors",
			preserveScroll	: form.leave_after_submit === false ? true : "errors",
			onSuccess		: reset_form,
			onError			: errors => form.setError(errors)
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
		class="grid gap-6 rounded-3xl bg-white p-8 shadow"
	>
		<label class="form-control">
			<div class="label">
				<span class="label-text">Article Content:</span>
			</div>

			<span v-if="form.errors.content" class="label-text-alt text-sm text-red-500">
				{{ form.errors.content }}
			</span>

			<QuillEditor
				theme="snow"
				content-type="html"
				v-model:content="form.content"
				:readOnly="!is_editing" />
		</label>

		<section class="flex justify-end gap-2">
			<button
				v-if="!is_editing && is_article_exists"
				@click="is_editing = true"
				:disabled="form.processing"
				type="button"
				class="btn btn-secondary btn-md shadow">
				<SquarePenIcon class="h-4 w-4" />
				Edit
			</button>

			<button
				v-if="is_editing && is_article_exists"
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
				type="button"
				class="btn btn-primary btn-md shadow">
				<span
					v-if="form.processing && !form.leave_after_submit"
					class="loading loading-spinner" />
				<CheckIcon v-else class="h-4 w-4" />
				Submit And Stay Here
			</button>

			<button
				v-if="is_editing"
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