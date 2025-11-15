@props([
    'name',
    'label' => null,
    'type' => 'text',
    'required' => false,
    'value' => null,
    'placeholder' => null,
    'rows' => null
])

<div>
    @if ($label)
        <label for="{{ $name }}" class="form-label">
            {{ $label }}
            @if ($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif
    
    @if ($type === 'textarea')
        <textarea 
            name="{{ $name }}" 
            id="{{ $name }}" 
            rows="{{ $rows ?? 4 }}"
            {{ $attributes->merge(['class' => 'form-input']) }}
            {{ $required ? 'required' : '' }}
            placeholder="{{ $placeholder }}"
        >{{ old($name, $value) }}</textarea>
    @else
        <input 
            type="{{ $type }}" 
            name="{{ $name }}" 
            id="{{ $name }}" 
            value="{{ old($name, $value) }}"
            {{ $attributes->merge(['class' => 'form-input']) }}
            {{ $required ? 'required' : '' }}
            placeholder="{{ $placeholder }}"
        >
    @endif
    
    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
