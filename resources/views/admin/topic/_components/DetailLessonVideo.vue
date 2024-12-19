<script setup>
	import { ref } from 'vue';
	import { router, useForm } from '@inertiajs/vue3';
	import { FormInput } from '@/components';
	import { CheckIcon, SquarePenIcon, Trash2Icon, XIcon } from 'lucide-vue-next'

	const props = defineProps({
		course_id		: [String, Number],
		chapter_id		: [String, Number],
		topic_id		: [String, Number],
		lesson_id		: [String, Number],
		lesson_video	: [Object, null]
	})

	const is_video_exists	= !!props.lesson_video
	const is_editing 		= ref(is_video_exists ? false : true)

	const form = useForm({
		lesson_id			: props.lesson_id,
		video_url			: is_video_exists ? props.lesson_video.video_url : '',
		leave_after_submit	: true
	})


	function submit_no_leave() {
		form.leave_after_submit = false
		submit()
	}

	function submit () {
		if (is_video_exists)	update_video()
		else					store_video()
	}

	function store_video () {
		form.post(route('admin.lesson_videos.store', {
			course	: props.course_id,
		}), {
			preserveState	: "errors",
			preserveScroll	: form.leave_after_submit === false ? true : "errors",
			onSuccess		: reset_form,
			onError			: errors => form.setError(errors)
		})
	}

	function update_video () {
		form.put(route('admin.lesson_videos.update', {
			course			: props.course_id,
			lesson_video	: props.lesson_video.id,
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
		<FormInput
			v-model="form.video_url"
			label="Video URL"
			:autofocus="is_editing"
			:error="form.errors.video_url"
			:readonly="!is_editing"
		/>
		<iframe
			v-if="form.video_url"
			:src="form.video_url"
			class="aspect-video w-full rounded-box"
			title="YouTube video player" frameborder="0"
			allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
			referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
		</iframe>

		<section class="flex justify-end gap-2">
			<button
				v-if="!is_editing && is_video_exists"
				@click="is_editing = true"
				:disabled="form.processing"
				type="button"
				class="btn btn-secondary btn-md shadow">
				<SquarePenIcon class="h-4 w-4" />
				Edit
			</button>

			<button
				v-if="is_editing && is_video_exists"
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