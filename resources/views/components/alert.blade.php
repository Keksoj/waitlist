@props([
    'type' => 'info', // success, error, info, warning, etc. Defaults to "info"
    'message' => '',
])

@php
    $colors = match ($type) {
        'success' => ['bg' => 'bg-green-100', 'border' => 'border-green-400', 'text' => 'text-green-700'],
        'error' => ['bg' => 'bg-red-100', 'border' => 'border-red-400', 'text' => 'text-red-700'],
        'warning' => ['bg' => 'bg-yellow-100', 'border' => 'border-yellow-400', 'text' => 'text-yellow-700'],
        default => ['bg' => 'bg-blue-100', 'border' => 'border-blue-400', 'text' => 'text-blue-700'],
    };
@endphp

<div
    {{ $attributes->merge(['class' => "{$colors['bg']} {$colors['border']} {$colors['text']} px-4 py-3  m-4 border"]) }}>

    {!! $message ?: $slot !!}
</div>
