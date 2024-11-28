@extends('admin._layouts.app')

@section('title', __('Course CMS'))

@section('header')
    <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
        {{ __('Course CMS') }}
    </h2>
@endsection

@section('content')
    <div class="p-4 sm:p-8 bg-white shadow rounded-lg">
        <header class="sm:flex sm:items-center">
            <section class="sm:flex-auto">
                <h2 class="text-base font-semibold leading-6 text-gray-900">{{ __('Courses') }}</h1>
                <p class="mt-2 text-sm text-gray-700">A list of all the {{ __('Courses') }}.</p>
            </section>
            <section class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <a
                    type="button"
                    href="{{ route('courses.create') }}"
                    class="btn btn-sm shadow btn-primary">
                    Add new
                </a>
            </section>
        </header>

        <article class="mt-8 overflow-x-auto">
            <table class="w-full divide-y divide-gray-300">
                <thead>
                <tr>
                    <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">No</th>

                    <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Title</th>
                    <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Caption</th>
                    <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Description</th>

                    <th scope="col" class="px-3 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500"></th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                @foreach ($courses as $course)
                    <tr class="even:bg-gray-50">
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-semibold text-gray-900">{{ ++$i }}</td>

                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $course->title }}</td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $course->caption }}</td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $course->description }}</td>

                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900">
                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST">
                                <a href="{{ route('courses.show', $course->id) }}" class="text-gray-600 font-bold hover:text-gray-900 mr-2">{{ __('Show') }}</a>
                                <a href="{{ route('courses.edit', $course->id) }}" class="text-indigo-600 font-bold hover:text-indigo-900  mr-2">{{ __('Edit') }}</a>
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('courses.destroy', $course->id) }}" class="text-red-600 font-bold hover:text-red-900" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;">{{ __('Delete') }}</a>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="mt-4 px-4">
                {!! $courses->withQueryString()->links() !!}
            </div>
        </article>
    </div>
@endsection