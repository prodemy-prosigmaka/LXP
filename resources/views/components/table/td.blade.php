@props(['sort_order'])

@php
    $hasSortOrder = isset($sort_order);
    $isOdd = $hasSortOrder && $sort_order % 2;
@endphp

<td {{ $attributes->class([
    'whitespace-nowrap px-3 py-4 text-sm text-gray-500',
    'bg-white' => $hasSortOrder && $isOdd,
    'bg-gray-50' => $hasSortOrder && !$isOdd,
]) }}>
    {{ $slot }}
</td>