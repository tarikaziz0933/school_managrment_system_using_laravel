<x-app-layout>
    <x-page-layout title="Approved Collection (Fees)">

        {{-- <x-slot name="actions">
            <a href="{{ route('approved-collections.create') }}"
                class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                New Collection
            </a>
        </x-slot> --}}
        <div class="">
            <div class="w-full">

                <!-- Main Content -->
                <div class="bg-white shadow-md rounded-lg p-6">

                    <!-- Success Alert -->
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 border border-green-300 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Header Section -->
                    {{-- <div class="flex justify-between items-center border-b pb-4 mb-4">
                    <h3 class="text-2xl font-semibold text-gray-800">Student Transpor Assign</h3>
                    <a href="{{ route('students-transport-assigns.create') }}"
                        class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        + Create
                    </a>
                </div> --}}


                    {{-- Search Form --}}
                    <form method="GET" action="{{ route('approved-collections.index') }}" id="approvalForm"
                        class="mb-4">
                        <div class="w-full bg-white rounded-lg flex flex-col gap-4">

                            <!-- Search + Submit -->
                            <div class="w-full flex flex-col sm:flex-row sm:items-center gap-2">
                                <!-- Search Input -->
                                <div class="w-full sm:flex-1">
                                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                                        placeholder="Search by Student Name or Student ID"
                                        class="w-full h-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                </div>

                                <label class="mr-4">
                                    <input type="radio" name="approved_status" value="1"
                                        {{ request()->has('approved_status') ? (request('approved_status') == '1' ? 'checked' : '') : 'checked' }}>
                                    Approved
                                </label>
                                <label>
                                    <input type="radio" name="approved_status" value="0"
                                        {{ request()->has('approved_status') && request('approved_status') == '0' ? 'checked' : '' }}>Unapproved
                                </label>
                            </div>

                        </div>

                    </form>


                    <form method="POST" action="{{ route('approved-collections.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            {{-- <x-form.input name="checked_no" label="Checked No"
                               value="{{ old('checked_no', $FeeCollection->checked_no ?? '') }}"  /> --}}

                            @php
                                $isDisabled = request('approved_status', '1') == '1';
                            @endphp

                            <x-form.input name="checked_no" label="Checked No" :value="$isDisabled ? '' : old('checked_no', $approvedCount + 1 ?? '')" :disabled="$isDisabled"
                                class="{{ $isDisabled ? 'bg-gray-100 text-gray-500 cursor-not-allowed' : '' }}" />

                            {{-- <x-form.input name="checked_no" label="Checked No"
                                value="{{ old('checked_no', $approvedCount + 1) }}" /> --}}


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
                            {{-- <form id="filter-form" class="flex gap-4"> --}}
                                <x-form.input name="from_date" label="Select the Invoice Date From" type="date"
                                    :value="request('from_date')" />
                                <x-form.input name="to_date" label="To" type="date" :value="request('to_date')" />
                            {{-- </form> --}}
                        </div>



                        <div id="approvalControls">
                            <div class="overflow-x-auto border rounded-lg mb-6">
                                <table class="min-w-full table-auto text-sm border-collapse">
                                    <thead class="bg-blue-200 text-gray-800">
                                        <tr>
                                            <th class="border px-3 py-2 checkbox-col">
                                                <input type="checkbox" id="select-all" class="accent-blue-500 ">
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
                                            <th class="border px-3 py-2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white text-center">
                                        @foreach ($FeeCollections as $FeeCollection)
                                            <tr>
                                                <td class="border px-3 py-2 checkbox-col">
                                                    <input type="checkbox" name="selected[]"
                                                        value="{{ $FeeCollection->id }}"
                                                        class="row-checkbox  accent-blue-500">
                                                </td>
                                                <td class="border px-3 py-2">{{ $FeeCollection->collection_date }}</td>
                                                <td class="border px-3 py-2">{{ $FeeCollection->collection_no }}</td>
                                                <td class="border px-3 py-2">{{ $FeeCollection->student->id_number }}
                                                </td>
                                                <td class="border px-3 py-2">{{ $FeeCollection->student->name }}</td>
                                                <td class="border px-3 py-2">
                                                    {{ $FeeCollection->student?->currentClass?->schoolClass?->name ?? '-' }}
                                                </td>
                                                <td class="border px-3 py-2">
                                                    {{ $FeeCollection->student?->currentClass?->section?->name ?? '-' }}
                                                </td>
                                                <td class="border px-3 py-2">
                                                    {{ $FeeCollection->feePaymentDetail?->total_payable ?? '-' }}</td>
                                                <td class="border px-3 py-2">
                                                    {{ $FeeCollection->feePaymentDetail?->grand_total ?? '-' }}</td>
                                                <td class="border px-3 py-2">
                                                    {{ $FeeCollection->feePaymentDetail?->fine_amount ?? '-' }}</td>
                                                <td class="border px-3 py-2">
                                                    {{ $FeeCollection->feePaymentDetail?->less_amount ?? '-' }}</td>
                                                <td class="border px-3 py-2">
                                                    {{ $FeeCollection->feePaymentDetail?->total_payable_amount ?? '-' }}
                                                </td>
                                                <td class="border px-3 py-2">
                                                    {{ $FeeCollection->feePaymentDetail?->paid_amount ?? '-' }}</td>
                                                <td class="border px-3 py-2">
                                                    {{ $FeeCollection->feePaymentDetail?->due_amount ?? '-' }}</td>
                                                <td class="border px-3 py-2">
                                                    <a href="{{ route('approved-collections.show', $FeeCollection->id) }}"
                                                        class="text-blue-600 hover:text-blue-800">
                                                        Show
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        {{-- You can loop real data here --}}
                                    </tbody>
                                </table>
                            </div>

                            <div class="flex justify-end space-x-3 mb-4">
                                <button type="submit"
                                    class="approve-button bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md font-semibold">
                                    Approve
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Pagination -->
                    {{-- <div class="mt-4">
                        {{ $studentsTransportAssigns->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
    </x-page-layout>

    <script>
        document.querySelectorAll('input[name="approved_status"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.getElementById('approvalForm').submit();
            });
        });
    </script>

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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('approvalForm');

            function toggleElements() {
                const selectedValue = form.querySelector('input[name="approved_status"]:checked')?.value;
                const checkboxes = document.querySelectorAll('.checkbox-col');
                const approveButton = document.querySelector('.approve-button');

                if (selectedValue === "0") {
                    checkboxes.forEach(cb => cb.style.display = "");
                    if (approveButton) approveButton.style.display = "";
                } else {
                    checkboxes.forEach(cb => cb.style.display = "none");
                    if (approveButton) approveButton.style.display = "none";
                }
            }

            // Submit form on radio change
            form.querySelectorAll('input[name="approved_status"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    form.submit();
                });
            });

            // Run toggle on page load
            toggleElements();
        });
    </script>

    <script>
        document.getElementById('search').addEventListener('input', function() {
            if (this.value.length === 8) {
                document.getElementById('approvalForm').submit();
            }
        });
    </script>

    {{-- for from and to date --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fromDateInput = document.querySelector('input[name="from_date"]');
            const toDateInput = document.querySelector('input[name="to_date"]');

            const fetchFilteredData = () => {
                const fromDate = fromDateInput.value;
                const toDate = toDateInput.value;

                const url = new URL(window.location.href);
                if (fromDate) url.searchParams.set('from_date', fromDate);
                if (toDate) url.searchParams.set('to_date', toDate);

                fetch(url)
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const newContent = doc.querySelector('#collection-data').innerHTML;
                        document.querySelector('#collection-data').innerHTML = newContent;
                    });
            };

            fromDateInput.addEventListener('change', fetchFilteredData);
            toDateInput.addEventListener('change', fetchFilteredData);
        });
    </script>

</x-app-layout>
