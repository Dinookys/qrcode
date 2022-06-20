@props([
    'type' => 'text'
])
@php
$class = 'border rounded p-1 w-full';
@endphp
<input {{ $attributes->merge(['class' => $class]) }} type="{{ $type }}" />