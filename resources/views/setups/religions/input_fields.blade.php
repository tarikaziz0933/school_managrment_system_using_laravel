<div>
    <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Religion</label>
        <input type="text" id="name" name="name" value="{{ old('name', $religion?->name) }}"
            class="w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-400 text-sm"
            required>
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
                    {{ old('status', $religion?->status ?? '1') == $key ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </select>

        @error('status')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

</div>
