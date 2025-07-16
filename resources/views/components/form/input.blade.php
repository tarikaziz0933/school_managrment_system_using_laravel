@props(['type' => 'text', 'name', 'label', 'value' => '', 'placeholder' => '', 'readonly' => false])

<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{!! $label !!}</label>
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        {{ $readonly ? 'readonly' : '' }}
        {{ $attributes->merge(['class' => 'w-full h-12 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500']) }}
    >
    @error($name)
        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
    @enderror
</div>
