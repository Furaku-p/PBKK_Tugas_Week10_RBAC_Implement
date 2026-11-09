@props(['label' => 'INFO', 'title' => '', 'value' => ''])

<div class="info-card">
    <span class="tiny-label">{{ $label }}</span>
    <h3>{{ $title }}</h3>
    <strong>{{ $value }}</strong>
    {{ $slot }}
</div>
