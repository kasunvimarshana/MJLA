@props(['title', 'featured' => false])

<div class="card" data-aos="fade-up">
    @if ($featured)
        <div class="absolute top-4 right-4 z-10">
            <span class="badge badge-primary">{{ __('messages.courses.featured') }}</span>
        </div>
    @endif
    
    {{ $slot }}
</div>
