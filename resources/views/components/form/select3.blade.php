@props([
    'name',
    'label',
    'options',
    'optionValue' => 'id',
    'optionLabel' => 'name',
    'selected' => null,
    'defaultLabel' => '[Select]',
])

@php
    $selectedValue = old($name, $selected);
@endphp

@once
    <style>
        .select2-container--default .select2-selection--single {
            height: 3rem !important;
            border-radius: 0.375rem;
            border-color: #d1d5db;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 3rem;
            color: #374151;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            line-height: 3rem;
            height: 3rem;
        }

        .select2-container--default .select2-selection--single .select2-selection__clear {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1rem;
            color: #6b7280;
            cursor: pointer;
        }

        .select2-dropdown {
            border-radius: 0.375rem;
            padding: 0.25rem;
            border-color: #d1d5db;
        }
    </style>
@endonce

<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{!! $label !!}</label>
    <select name="{{ $name }}" id="{{ $name }}"
        {{ $attributes->merge(['class' => 'w-full h-16 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500']) }}>
        <option value="" {{ $selectedValue ? '' : 'selected' }}>
            {{ $defaultLabel }}
        </option>

        @foreach ($options as $option)
            @php
                $value = is_array($option) ? $option[$optionValue] : data_get($option, $optionValue);
                $text = is_array($option) ? $option[$optionLabel] : data_get($option, $optionLabel);
                $level = is_array($option) ? $option['level'] ?? '' : data_get($option, 'level') ?? '';
            @endphp
            <option value="{{ $value }}" data-level="{{ $level }}"
                {{ (string) $selectedValue === (string) $value ? 'selected' : '' }}>
                {{ $text }}
            </option>
        @endforeach
    </select>

    @error($name)
        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
    @enderror
</div>
