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
                href="#"
                class="btn shadow btn-primary mt-4 md:mt-0 w-full md:w-auto">
                <x-lucide-file-plus-2 class="w-4 h-4 "/>
                Add new
            </a>
        </x-slot>


        <x-table.parent class="mt-8">
            <x-slot:thead>
                <x-table.th class="min-w-12 w-12"> # </x-table.th>
                <x-table.th> Title </x-table.th>
                <x-table.th class="min-w-36 w-36 sticky right-0"> Action </x-table.th>
            </x-slot>

            <x-slot:tbody>
                @foreach ($courses as $course)
                    @php $order = ++$i; @endphp
                    <x-table.tr>
                        <x-table.td>{{ $order }}</x-table.td>
                        <x-table.td>{{ $course->title }}</x-table.td>
                        <x-table.td :sort_order="$order">
                            <button class="btn btn-sm btn-secondary shadow">
                                <x-lucide-square-pen class="w-4 h-4 "/>
                                Detail
                            </button>
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