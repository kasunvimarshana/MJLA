@props(['title', 'subtitle' => null, 'center' => true])

<div class="{{ $center ? 'text-center' : '' }} mb-12" data-aos="fade-up">
    <h1 class="section-title">{{ $title }}</h1>
    @if ($subtitle)
        <p class="section-subtitle {{ $center ? 'max-w-3xl mx-auto' : '' }}">
            {{ $subtitle }}
        </p>
    @endif
</div>
