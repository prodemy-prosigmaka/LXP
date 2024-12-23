@extends('admin._layouts.app')

@section('title', 'User Management')

@section('header', 'User Management')

@section('content')

    @if (session('message'))
        <div role="alert" class="alert mb-8 rounded-3xl border-0 bg-primary text-white shadow">
            <x-lucide-circle-check class="h-6 w-6" />
            <span>
                {{ session('message') }}
            </span>
        </div>
    @endif

    <x-admin.page-card
        title="Users"
        caption="A list of all the users"
    >
        <x-slot:header_action>
            <a
				href="{{ route('admin.users.create') }}"
                class="btn btn-primary mt-4 w-full shadow md:mt-0 md:w-auto"
			>
                <x-lucide-file-plus-2 class="h-4 w-4"/>
                Add new
            </a>
        </x-slot>


        <x-table.parent class="mt-8">
            <x-slot:thead>
                <x-table.th class="w-12 min-w-12"> # </x-table.th>
                <x-table.th> Name </x-table.th>
                <x-table.th> Email </x-table.th>
                <x-table.th> Role </x-table.th>
                <x-table.th class="sticky right-0 w-36 min-w-36"> Action </x-table.th>
            </x-slot>

            <x-slot:tbody>
                @foreach ($users as $user)
                    @php $order = ++$i; @endphp
                    <x-table.tr>
                        <x-table.td>{{ $order }}</x-table.td>
                        <x-table.td>{{ $user->name }}</x-table.td>
                        <x-table.td>{{ $user->email }}</x-table.td>
                        <x-table.td>{{ !empty($user->roles) ? $user->roles[0]->name : '' }}</x-table.td>
                        <x-table.td :sort_order="$order">
                            <form
                                method="POST"
                                action="{{ route('admin.users.destroy', $user->id) }}"
                                onsubmit="return confirm('Are you sure?')"
                                class="join"
                            >
                                <button
                                    title="Delete"
                                    type="submit"
                                    class="btn join-item btn-neutral btn-sm shadow">
                                    <x-lucide-trash-2 class="h-4 w-4"/>
                                </button>
                                @csrf
                                @method('DELETE')

                                <a
                                    title="Edit"
                                    class="btn btn-secondary join-item btn-sm shadow"
                                    href="{{ route('admin.users.edit', $user->id) }}">
                                    <x-lucide-square-pen class="h-4 w-4"/>
                                </a>
                            </form>
                        </x-table.td>
                    </x-table.tr>
                @endforeach
            </x-slot>

            <x-slot:pagination>
                {!! $users->withQueryString()->links() !!}
            </x-slot>
        </x-table.parent>

    </x-admin.page-card>
@endsection