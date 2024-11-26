@extends('admin._layouts.app')

@section('title', 'Course CMS')

@section('header')
    <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
        Course CMS
    </h2>
@endsection

@section('content')
    <div class="p-4 sm:p-8 bg-white shadow rounded-lg">
        <header class="sm:flex sm:items-center sm:justify-between">
            <section>
                <h2 class="text-base font-semibold leading-6 text-gray-900">
                    Courses
                </h1>
                <p class="mt-2 text-sm text-gray-700">
                    A list of all the Courses
                </p>
            </section>

            <a
                type="button"
                href="{{ route('courses.create') }}"
                class="btn shadow btn-primary mt-4 md:mt-0 w-full md:w-auto">
                <x-lucide-file-plus-2 class="w-4 h-4 "/>
                Add new
            </a>
        </header>

        <x-table.parent class="mt-8">
            <x-slot:thead>
                <x-table.th class="min-w-12 w-12"> ID </x-table.th>
                <x-table.th> Title </x-table.th>
                <x-table.th class="min-w-36 w-36 sticky right-0"> Action </x-table.th>
            </x-slot>

            <x-slot:tbody>
                @foreach ($courses as $course)
                    @php $order = ++$i; @endphp
                    <x-table.tr>
                        <x-table.td>{{ $course->id }}</x-table.td>
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
    </div>
@endsection