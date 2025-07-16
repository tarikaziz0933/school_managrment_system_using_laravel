<div>
    <div class="mb-4">
        <label for="code" class="block text-sm font-medium text-gray-700 mb-1">Fees Code</label>
        <input type="number" name="code" value="{{ old('code', $feeType?->code ?? '') }}"
            class="border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-400 text-sm w-full"
            required>

        @error('code')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Fees Name</label>
        <input type="text" name="name" value="{{ old('name', $feeType?->name ?? '') }}"
            class="border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-400 text-sm w-full"
            required>

        @error('name')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>


    <div class="mb-4">
        <label for="payment_frequency_type_id" class="block text-sm font-medium text-gray-700 mb-1">Payment
            Frequency</label>



        <select name="payment_frequency_type_id" id="payment_frequency_type_id"
            class="border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-400 text-sm w-full">


            @foreach ($paymentFrequencyTypes as $key => $value)
                <option value="" disabled selected>Select Payment Frequency</option>
                <option value="{{ $key }}"
                    {{ old('payment_frequency_type_id', $feeType?->payment_frequency_type_id ?? '') == $key ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach

        </select>

          @error('payment_frequency_type_id')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
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
                    {{ old('status', $feeType?->status ?? '1') == $key ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </select>

        @error('status')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

</div>
