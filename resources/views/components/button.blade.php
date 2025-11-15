@props(['type' => 'primary', 'href' => null, 'loading' => false])

@php
    $classes = match($type) {
        'primary' => 'btn btn-primary',
        'secondary' => 'btn btn-secondary',
        'outline' => 'btn btn-outline',
        default => 'btn btn-primary'
    };
    
    $attributes = $attributes->merge([
        'class' => $classes . ($loading ? ' data-loading-button' : '')
    ]);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes }}>
        {{ $slot }}
    </button>
@endif
