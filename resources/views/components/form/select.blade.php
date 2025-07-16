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
    // Determine the selected value: first use $selected, then old input, then request input
    $selectedValue = $selected ?? (old($name) ?? request($name));
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

        @media (max-width: 640px) {
            .select2-container--default .select2-selection--single {
                height: 2.5rem !important;
            }

            .select2-container--default .select2-selection--single .select2-selection__rendered {
                line-height: 2.5rem;
            }

            .select2-container--default .select2-selection--single .select2-selection__arrow {
                line-height: 2.5rem;
                height: 2.5rem;
            }

            .select2-container--default .select2-selection--single .select2-selection__clear {
                right: 0.5rem;
                font-size: 0.875rem;
            }
        }
    </style>
@endonce

<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{!! $label !!}</label>
    <select name="{{ $name }}" id="{{ $name }}"
        {{ $attributes->merge(['class' => 'w-full h-16 sm:h-12 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500']) }}>
        <option value="" {{ $selectedValue ? '' : 'selected' }}>
            {{ $defaultLabel }}
        </option>
        {{-- @foreach ($options as $option)
            @php
                $value = is_array($option) ? $option[$optionValue] : $option->$optionValue;
                $text = is_array($option) ? $option[$optionLabel] : $option->$optionLabel;
            @endphp
            <option value="{{ $value }}" {{ (string) $selectedValue === (string) $value ? 'selected' : '' }}>
                {{ $text }}
            </option>
        @endforeach --}}

        @foreach ($options as $key => $option)
            @php
                if (is_object($option)) {
                    $value = $option->$optionValue;
                    $text = $option->$optionLabel;
                } elseif (is_array($option)) {
                    $value = $option[$optionValue];
                    $text = $option[$optionLabel];
                } else {
                    $value = $key;
                    $text = $option;
                }
            @endphp
            <option value="{{ $value }}" {{ (string) $selectedValue === (string) $value ? 'selected' : '' }}>
                {{ $text }}
            </option>
        @endforeach
    </select>
    @error($name)
        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
    @enderror
</div>
