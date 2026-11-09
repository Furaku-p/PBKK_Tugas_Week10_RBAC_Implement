@props(['type' => 'info', 'message' => ''])

@php
    $classes = [
        'success' => 'status-success',
        'error' => 'status-error',
        'info' => 'status-info',
    ];
@endphp

<div class="status-banner {{ $classes[$type] ?? $classes['info'] }}">
    {{ $message ?: $slot }}
</div>
