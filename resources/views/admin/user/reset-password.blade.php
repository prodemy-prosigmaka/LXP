<x-admin.page-card class="mt-8 flex flex-row items-center justify-between">
	<p>
		<span class="text-sm">Default Password :</span>
		<span class="text-sm font-bold">{{ \App\Models\User::$default_password }}</span>
	</p>

	@isset ($user)
		<form action="{{ route('admin.user-password.update', $user->id) }}" method="POST">
			@csrf
			@method('PATCH')

			<button type="submit" class="btn btn-secondary">
				<x-lucide-rotate-ccw class="h-4 w-4" />
				Reset Password
			</button>
		</form>
	@endif
</x-admin.page-card>