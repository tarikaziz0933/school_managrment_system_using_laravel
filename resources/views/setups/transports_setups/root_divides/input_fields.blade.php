<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <!-- Serial No -->
    <div class="mb-4">
        <label for="serial_no" class="block text-sm font-medium text-gray-700">Serial No</label>
        <input type="number" name="serial_no" id="serial_no"
            value="{{ old('serial_no', $root_divide->serial_no ?? (isset($root_divides) && is_countable($root_divides) ? count($root_divides) + 1 : 1)) }}"
            class="w-full h-12 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            required>
    </div>

    <!-- Year -->
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Year</label>
        <select name="year" id="year"
            class="w-full h-12 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @for ($year = date('Y') - 1; $year <= date('Y') + 1; $year++)
                <option value="{{ $year }}" {{ (old('year') ?? date('Y')) == $year ? 'selected' : '' }}>
                    {{ $year }}
                </option>
            @endfor
        </select>
        @error('year')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Assign Date -->
    <div class="mb-4">
        <x-form.input type="date" name="assign_date" label="Assign Date"
            value="{{ old('assign_date', $root_divide->assign_date ?? \Carbon\Carbon::now()->toDateString()) }}" />
    </div>

    <!-- Root Code -->
    <div class="mb-4">
        <x-form.input type="text" name="root_code" label="Root Code" :value="old('root_code', $root_divide->root_code ?? '')" />
    </div>

    <!-- Vehicle No -->
    <div class="mb-4">
        <x-form.input type="number" name="vehicle_no" label="Vehicle No" :value="old('vehicle_no', $root_divide->vehicle_no ?? '')" />
    </div>

    <!-- Vehicle Name -->
    <div class="mb-4">
        <x-form.input type="text" name="vehicle_name" label="Vehicle Name" :value="old('vehicle_name', $root_divide->vehicle_name ?? '')" />
    </div>

    <!-- From -->
    <div class="mb-4">
        <x-form.input type="text" name="from" label="From" :value="old('from', $root_divide->from ?? '')" />
    </div>

    <!-- To -->
    <div class="mb-4">
        <x-form.input type="text" name="to" label="To" :value="old('to', $root_divide->to ?? '')" />
    </div>

    <!-- Fees Amount -->
    <div class="mb-4">
        <label for="fees_amount" class="block text-sm font-medium text-gray-700">Fees Amount</label>
        <div class="flex items-center">
            <input type="number" name="fees_amount" step="0.01" id="fees_amount"
                value="{{ old('fees_amount', $root_divide->fees_amount ?? '') }}"
                class="w-full h-12 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <span class="ml-2 text-sm">Tk.</span>
        </div>
    </div>

    <!-- Driver Name -->
    <div class="mb-4">
        <x-form.input type="text" name="driver_name" label="Driver Name" :value="old('driver_name', $root_divide->driver_name ?? '')" />
    </div>

    <!-- Contact No -->
    <div class="mb-4">
        <x-form.input type="tel" name="contact_no" label="Contact No" :value="old('contact_no', $root_divide->contact_no ?? '')" />
    </div>
</div>

<!-- Remarks -->
<div class="mb-4">
    <label for="remarks" class="block text-sm font-medium text-gray-700">Remarks</label>
    <textarea name="remarks" id="remarks" rows="3"
        class="border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-400 text-sm w-full">{{ old('remarks', $root_divide->remarks ?? '') }}</textarea>
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
        class="w-64 h-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
        @foreach ($status as $key => $value)
            <option value="{{ $key }}"
                {{ old('status', $root_divide?->status ?? '1') == $key ? 'selected' : '' }}>
                {{ $value }}
            </option>
        @endforeach
    </select>

    @error('status')
        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
    @enderror
</div>
