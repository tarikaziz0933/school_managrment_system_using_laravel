{{-- Section Name --}}
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-1">Section Name</label>
    <input type="text" name="name" value="{{ old('name', $section?->name) }}"
        class="w-full border border-gray-300 p-3 rounded-md shadow-sm focus:ring-2 focus:ring-blue-400 text-sm"
        required>
</div>

{{-- Class --}}
<div class="mb-4">
    <label for="class_id" class="block text-sm font-medium text-gray-700 mb-1">Class</label>
    <select name="class_id" id="class_id"
        class="w-full border border-gray-300 p-3 rounded-md shadow-sm focus:ring-2 focus:ring-blue-400 text-sm"
        required>
        @foreach ($classes as $class)
            <option value="{{ $class->id }}"
                {{ old('class_id', $section?->class_id) == $class->id ? 'selected' : '' }}>
                {{ $class->name }}
            </option>
        @endforeach
    </select>
</div>

{{-- Gender --}}
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
    @php
        $genders = ['boys' => 'Boys', 'girls' => 'Girls', '' => 'Combined'];
    @endphp
    <select name="gender"
        class="w-full border border-gray-300 p-3 rounded-md shadow-sm focus:ring-2 focus:ring-blue-400 text-sm"
        required>
        @foreach ($genders as $key => $label)
            <option value="{{ $key }}" {{ old('gender', $section?->gender) == $key ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
    @error('gender')
        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
    @enderror
</div>

<!-- Campus -->
<div class="mb-4">
    <label for="campus_id" class="block text-sm font-medium text-gray-700 mb-1">Campus</label>
    <select name="campus_id" id="campus_id"
        class="w-full border border-gray-300 p-3 rounded-md shadow-sm focus:ring-2 focus:ring-blue-400 text-sm">

        @foreach ($campuses as $id => $name)
            <option value="{{ $id }}" {{ old('campus_id', $section?->campus_id) == $id ? 'selected' : '' }}>
                {{ $name }}
            </option>
        @endforeach
    </select>

    @error('campus_id')
        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
    @enderror
</div>

{{-- Available Seat --}}
<div class="mb-4">
    <div class="flex flex-col md:flex-row gap-4">
        <div class="w-full md:w-1/2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Total Boys</label>
            <input type="number" name="total_boys" value="{{ old('total_boys', $section?->total_boys) }}"
                class="w-full border border-gray-300 p-3 rounded-md shadow-sm focus:ring-2 focus:ring-blue-400 text-sm">
        </div>

        <div class="w-full md:w-1/2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Total Girls</label>
            <input type="number" name="total_girls" value="{{ old('total_girls', $section?->total_girls) }}"
                class="w-full border border-gray-300 p-3 rounded-md shadow-sm focus:ring-2 focus:ring-blue-400 text-sm">
        </div>
    </div>
</div>


<!-- Status -->
@php
    $status = [
        '0' => 'Inactive',
        '1' => 'Active',
    ];
@endphp
<div class="flex-1">
    <label class="block text-sm font-medium text-gray-700">Status:</label>
    <select id="status" name="status" id="status"
        class="w-full h-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
        @foreach ($status as $key => $value)
            <option value="{{ $key }}"
                {{ old('status', $section?->status ?? '1') == $key ? 'selected' : '' }}>
                {{ $value }}
            </option>
        @endforeach
    </select>

    @error('status')
        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
    @enderror
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const genderSelect = document.querySelector('select[name="gender"]');
        const boysInput = document.querySelector('input[name="total_boys"]');
        const girlsInput = document.querySelector('input[name="total_girls"]');

        function toggleInputs() {
            const gender = genderSelect.value;

            if (gender === 'boys') {
                boysInput.disabled = false;
                girlsInput.disabled = true;
                girlsInput.value = '';
            } else if (gender === 'girls') {
                boysInput.disabled = true;
                girlsInput.disabled = false;
                boysInput.value = '';
            } else {
                boysInput.disabled = false;
                girlsInput.disabled = false;
            }
        }

        // Initial call on page load
        toggleInputs();

        // Call on change
        genderSelect.addEventListener('change', toggleInputs);
    });
</script>
