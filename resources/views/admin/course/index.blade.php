@extends('admin._layouts.app')

@section('title', 'Course CMS')

@section('header', 'Course CMS')

@section('content')
    <x-admin.page-card
        title="Courses"
        caption="A list of all the Courses"
    >
        <x-slot:header_action>
            <a
                href="{{ route('admin.courses.create') }}"
                class="btn btn-primary mt-4 w-full shadow md:mt-0 md:w-auto">
                <x-lucide-file-plus-2 class="h-4 w-4"/>
                Add new
            </a>
        </x-slot>


        <x-table.parent class="mt-8">
            <x-slot:thead>
                <x-table.th class="w-12 min-w-12"> # </x-table.th>
                <x-table.th> Title </x-table.th>
                <x-table.th> Instructor </x-table.th>
                <x-table.th> Students </x-table.th>
                <x-table.th class="sticky right-0 w-36 min-w-36"> Action </x-table.th>
            </x-slot>

            <x-slot:tbody>
                @foreach ($courses as $course)
                    @php $order = ++$i; @endphp
                    <x-table.tr>
                        <x-table.td>{{ $order }}</x-table.td>
                        <x-table.td>{{ $course->title }}</x-table.td>
                        <x-table.td>{{ $course->instructor->user->name }}</x-table.td>
                        <x-table.td>{{ $course->students_count }}</x-table.td>
                        <x-table.td :sort_order="$order">
                            <a
                                href="{{ route('admin.courses.edit', $course->id) }}"
                                class="btn btn-secondary btn-sm shadow">
                                <x-lucide-square-pen class="h-4 w-4"/>
                                Detail
                            </a>
                        </x-table.td>
                    </x-table.tr>
                @endforeach
            </x-slot>

            <x-slot:pagination>
                {!! $courses->withQueryString()->links() !!}
            </x-slot>
        </x-table.parent>

    </x-admin.page-card>
@endsection