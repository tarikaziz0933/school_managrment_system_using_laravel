<x-app-layout>
    <x-page-layout :title="'New Collections for Approved (Fees)'">

        <x-slot name="actions">
            <a href="{{ route('approved-collections.index') }}" class="">
                ← Back to list
            </a>
        </x-slot>
        <div class="mx-auto py-10 px-6">
            <div class="p-6">


                <form method="POST" action="{{ route('approved-collections.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <x-form.input name="checked_no" label="Checked No" value="{{ old('checked_no', '25001') }}" />
                        <x-form.input name="checked_date" label="Checked Date" type="date"
                            value="{{ old('checked_date', now()->format('Y-m-d')) }}" />

                        <div class="flex items-center space-x-3 mt-6">
                            <label class="inline-flex items-center">
                                <input type="radio" name="date_mode" value="single" class="text-blue-600" checked>
                                <span class="ml-1 text-sm text-gray-700">Single Date</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="date_mode" value="multiple" class="text-blue-600">
                                <span class="ml-1 text-sm text-gray-700">Multiple Date</span>
                            </label>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <x-form.input name="from_date" label="Select the Invoice Date From" type="date" />
                        <x-form.input name="to_date" class="to_date" label="To" type="date"
                            class="disabled:bg-gray-100 disabled:cursor-not-allowed" />
                    </div>



                    <div class="overflow-x-auto border rounded-lg mb-6">
                        <table class="min-w-full table-auto text-sm border-collapse">
                            <thead class="bg-blue-200 text-gray-800">
                                <tr>
                                    <th class="border px-3 py-2">
                                        <input type="checkbox" id="select-all" class="accent-blue-500">
                                    </th>
                                    <th class="border px-3 py-2">Date</th>
                                    <th class="border px-3 py-2">Col No</th>
                                    <th class="border px-3 py-2">ID No</th>
                                    <th class="border px-3 py-2">Full Name</th>
                                    <th class="border px-3 py-2">Class</th>
                                    <th class="border px-3 py-2">Section</th>
                                    <th class="border px-3 py-2">Total</th>
                                    <th class="border px-3 py-2">Grand Total</th>
                                    <th class="border px-3 py-2">Fine</th>
                                    <th class="border px-3 py-2">Less</th>
                                    <th class="border px-3 py-2">Payable</th>
                                    <th class="border px-3 py-2">Paid</th>
                                    <th class="border px-3 py-2">Prev. Dues</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white text-center">
                                @foreach ($FeeCollections as $FeeCollection)
                                    <tr>
                                        <td class="border px-3 py-2">
                                            <input type="checkbox" name="selected[]" value="{{ $FeeCollection->id }}"
                                                class="row-checkbox accent-blue-500">
                                        </td>
                                        <td class="border px-3 py-2">{{ $FeeCollection->collection_date }}</td>
                                        <td class="border px-3 py-2">{{ $FeeCollection->collection_no }}</td>
                                        <td class="border px-3 py-2">{{ $FeeCollection->student->id_number }}</td>
                                        <td class="border px-3 py-2">{{ $FeeCollection->student->name }}</td>
                                        <td class="border px-3 py-2">
                                            {{ $FeeCollection->student?->currentClass?->schoolClass?->name ?? '-' }}
                                        </td>
                                        <td class="border px-3 py-2">
                                            {{ $FeeCollection->student?->currentClass?->section?->name ?? '-' }}</td>
                                        <td class="border px-3 py-2">
                                            {{ $FeeCollection->feePaymentDetail?->total_payable ?? '-' }}</td>
                                        <td class="border px-3 py-2">
                                            {{ $FeeCollection->feePaymentDetail?->grand_total ?? '-' }}</td>
                                        <td class="border px-3 py-2">
                                            {{ $FeeCollection->feePaymentDetail?->fine_amount ?? '-' }}</td>
                                        <td class="border px-3 py-2">
                                            {{ $FeeCollection->feePaymentDetail?->less_amount ?? '-' }}</td>
                                        <td class="border px-3 py-2">
                                            {{ $FeeCollection->feePaymentDetail?->total_payable_amount ?? '-' }}</td>
                                        <td class="border px-3 py-2">
                                            {{ $FeeCollection->feePaymentDetail?->paid_amount ?? '-' }}</td>
                                        <td class="border px-3 py-2">
                                            {{ $FeeCollection->feePaymentDetail?->due_amount ?? '-' }}</td>
                                    </tr>
                                @endforeach
                                {{-- You can loop real data here --}}
                            </tbody>
                        </table>
                    </div>

                    <div class="flex justify-end space-x-3 mb-4">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md font-semibold">
                            Approve
                        </button>
                    </div>
                </form>

            </div>
        </div>

        {{-- for select all --}}
        <script>
            const selectAll = document.getElementById('select-all');
            const checkboxes = document.querySelectorAll('.row-checkbox');

            // When "Select All" is clicked
            selectAll.addEventListener('change', function() {
                checkboxes.forEach(cb => cb.checked = this.checked);
            });

            // When any individual checkbox is clicked
            checkboxes.forEach(cb => {
                cb.addEventListener('change', function() {
                    if (!this.checked) {
                        selectAll.checked = false;
                    } else {
                        const allChecked = Array.from(checkboxes).every(cb => cb.checked);
                        selectAll.checked = allChecked;
                    }
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                toggleToDate(); // Initial check based on default selection

                $('input[name="date_mode"]').on('change', function() {
                    toggleToDate();
                });

                function toggleToDate() {
                    const mode = $('input[name="date_mode"]:checked').val();

                    if (mode === 'single') {
                        $('input[name="to_date"]').prop('disabled', true).val('');
                    } else {
                        $('input[name="to_date"]').prop('disabled', false);
                    }
                }
            });
        </script>

    </x-page-layout>
</x-app-layout>
