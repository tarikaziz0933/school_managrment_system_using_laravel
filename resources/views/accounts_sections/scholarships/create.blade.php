<x-app-layout>
    <x-page-layout :title="'Create Student Scholarship'">

        <x-slot name="actions">
            <a href="{{ route('scholarships.index') }}" class="">
                ← Back to list
            </a>
        </x-slot>
        <div class=" mx-auto px-4 py-8">
            <!-- Add Branch Form -->
            <div class=" w-full mx-auto">
                <div class="bg-white shadow-lg rounded-xl p-6">
                    @if (session('success'))
                        <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4 text-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">
                            <strong class="block">Whoops! Something went wrong.</strong>
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- <h3 class="text-2xl font-semibold mb-6 text-center text-gray-800">Create Student Scholarship</span>
                    </h3> --}}
                    <form action="{{ route('scholarships.store') }}" method="POST">
                        @csrf

                        <div>
                            <div class=" rounded-xl p-6">

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                                    <!-- Collection No -->
                                    <div>
                                        <label for="collection_no"
                                            class="block text-sm font-medium text-gray-700">Collection No</label>
                                        <input type="number" name="collection_no" id="collection_no"
                                            value="{{ old('collection_no', isset($FeeCollections) && is_countable($FeeCollections) ? count($FeeCollections) + 1 : 1) }}"
                                            class = "w-full h-12 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            readonly>
                                    </div>

                                    {{-- Applicable Year --}}
                                    <div>
                                        <x-form.select name="year" label="Applicable Year" :options="collect(range(date('Y') - 1, date('Y') + 1))->map(
                                            fn($y) => ['id' => $y, 'name' => $y],
                                        )"
                                            :selected="old('year')" defaultLabel="[Select]" />
                                    </div>

                                    {{-- Applicable Month --}}
                                    <div>
                                        <x-form.select name="applicable_month" label="Applicable Month"
                                            :options="collect(range(1, 12))->map(
                                                fn($m) => [
                                                    'id' => $m,
                                                    'name' => \Carbon\Carbon::create()->month($m)->format('F'),
                                                ],
                                            )" :selected="old('applicable_month', date('n'))" defaultLabel="[Select]" />
                                    </div>

                                    {{-- Student ID --}}
                                    <div>
                                        <label for="id_number" class="block text-sm font-medium text-gray-700">Student
                                            ID</label>
                                        <input type="number" id="id_number" placeholder="Search by Student ID"
                                            value="{{ old('id_number') }}"
                                            class="w-full h-12 border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-400 text-sm">

                                        <!-- Student ID -->
                                        <x-form.input type="hidden" name="student_id" label=""
                                            value="{{ old('student_id') }}" />

                                        @error('id_number')
                                            <div id="id_number" class="text-red-500 text-sm mt-1"></div>
                                        @enderror
                                    </div>


                                    <!-- Student Name -->
                                    <div>
                                        <x-form.input type="text" name="name" label="Student's Name"
                                            value="{{ old(
                                                'name',
                                                // , $studentClass?->student?->name
                                            ) }}"
                                            readonly />
                                    </div>

                                    <!-- Campus -->
                                    <div>
                                        <x-form.input type="text" name="campus_id" label="Campus"
                                            value="{{ old(
                                                'name',
                                                // , $studentClass?->studentClass->name
                                            ) }}"
                                            readonly />
                                    </div>

                                    <!-- Class -->
                                    <div>
                                        <x-form.input type="text" name="class_id" label="Class"
                                            value="{{ old(
                                                'class_id',
                                                // , $studentClass?->studentClass?->name
                                            ) }}"
                                            readonly />
                                    </div>

                                    <!-- Group -->
                                    <div>
                                        <x-form.input type="text" name="group_id" label="Group"
                                            value="{{ old(
                                                'group_id',
                                                // , $studentClass?->studentClass?->name
                                            ) }}"
                                            readonly />
                                    </div>

                                    <!-- Section -->
                                    <div>
                                        <x-form.input type="text" name="section_id" label="Section"
                                            value="{{ old(
                                                'class_id',
                                                // , $studentClass?->section?->name
                                            ) }}"
                                            readonly />
                                    </div>

                                    <!-- Roll -->
                                    <div class="flex items-center space-x-6">
                                        <div class="flex-1">
                                            <x-form.input type="number" name="roll" label="Roll"
                                                value="{{ old('roll') }}" disabled />
                                        </div>

                                        <div class="flex-1">
                                            <x-form.input type="text" name="roll_postfix" label="Postfix"
                                                value="{{ old('roll_postfix') }}" disabled />
                                        </div>
                                    </div>

                                    <!-- Date -->
                                    <x-form.input type="date" name="admitted_at" label="Date"
                                        value="{{ \Carbon\Carbon::now()->toDateString() }}" />
                                </div>

                                <div>
                                    <div class="bg-white shadow rounded-xl p-6 mt-6">

                                        <div class="flex-1 overflow-x-auto mr-6">
                                            <table class="min-w-full text-sm text-left table-auto border">
                                                <thead class="bg-gray-100 text-gray-700">
                                                    <tr>

                                                        <th><input type="checkbox" id="select-all"></th>
                                                        <th class="px-3 py-2 border">SL No</th>

                                                        <th class="px-3 py-2 border">Fees Name</th>
                                                        <th class="px-3 py-2 border">Amount</th>
                                                        <th class="px-3 py-2 border">Full Free</th>
                                                        <th class="px-3 py-2 border">Half Free</th>
                                                        <th class="px-3 py-2 border">Less/Disc</th>
                                                        <th class="px-3 py-2 border">Final Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="fees_table">
                                                    {{-- @foreach ($fees as $key => $fee)
                                                    <tr class="hover:bg-gray-50">

                                                        <td>
                                                            <input type="checkbox" name="root_ids[]"
                                                                value="{{ $fee->id }}">
                                                        </td>

                                                        <td class="px-3 py-2 border">
                                                            {{ $key + 1 }}
                                                            <input type="hidden"
                                                                name="fees[{{ $key }}][serial_no]"
                                                                value="{{ $key + 1 }}">
                                                        </td>

                                                        <td class="px-3 py-2 border">
                                                            {{ $fee?->feeType?->name }}
                                                            <input type="hidden"
                                                                name="fees[{{ $key }}][fee_type_id]"
                                                                value="{{ $fee?->feeType?->id }}">
                                                        </td>

                                                        <td class="px-3 py-2 border">
                                                            {{ $fee?->amount }}
                                                            <input type="hidden"
                                                                name="fees[{{ $key }}][amount]"
                                                                value="{{ $fee?->amount }}">
                                                        </td>

                                                        <td class="px-3 py-2 border">
                                                            <input type="text" name="less[{{ $fee->id }}]"
                                                                class="w-20 border-gray-300 rounded shadow-sm" disabled>
                                                        </td>

                                                        <td class="px-3 py-2 border">
                                                            <input type="text"
                                                                name="payable[
                                                                  ]"
                                                                class="w-20 border-gray-300 rounded shadow-sm" disabled>
                                                        </td>

                                                    </tr>
                                                @endforeach --}}

                                                </tbody>
                                            </table>
                                            {{-- {{ $studentClases->links() }} --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 flex justify-end">
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition duration-200">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>


        <script>
            function showStudenById(id_number) {
                //    const id_number = $(this).val().trim();

                if (!id_number) {
                    $('#id_number_error').text('Please enter a Student ID.');
                    return;
                }

                $.ajax({
                    url: `/api/students/${id_number}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'OK' && response.data) {
                            const student = response.data;
                            $('#name').val(student.name || '');
                            $('#student_id').val(student.id || '');
                            $('#campus_id').val(student.currentClass?.campus?.name || '');
                            $('#class_id').val(student.currentClass?.class?.name || '');
                            $('#section_id').val(student.currentClass?.section?.name || '');
                            $('#group_id').val(student.currentClass?.group?.name || '');
                            $('#year').val(student.currentClass?.year || '');
                            $('#roll').val(student.currentClass?.roll || '');
                            $('#roll_postfix').val(student.currentClass?.roll_postfix || '');
                            $('#id_number_error').text('');

                            const year = student.currentClass?.year;
                            const class_id = student.currentClass?.class?.id;

                            if (class_id && year) {
                                loadFees(class_id, year);
                            }

                        } else {
                            $('#id_number_error').text('Student not found.');
                            $('#name, #campus_id, #class_id, #section_id, #group_id').val('');
                        }
                    },
                    error: function(xhr) {
                        $('#id_number_error').text(
                            'An error occurred while fetching student data.');
                        $('#name, #campus_id, #class_id, #section_id, #group_id').val('');
                    }
                });
            }

            $(document).ready(function() {


                showStudenById("{{ isset($studentTransport) ? $studentTransport->student->id_number : '' }}");

                $('#id_number').on('input', function() {
                    const id_number = $(this).val().trim();

                    if (id_number.length === 8) {
                        showStudenById(id_number);
                    }
                });



                // $('#id_number').on('blur', function() {
                //     const id_number = $(this).val().trim();

                //     showStudenById(id_number);
                //     // loadFees(class_id, year);
                // });
            });
        </script>

        {{-- fees --}}
        <script>
            function loadFees(class_id, year) {
                if (!class_id || !year) {
                    console.warn('Missing class_id or year to fetch yearly fees');
                    return;
                }

                $.ajax({
                    url: `/api/fees/${class_id}/${year}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        const tbody = $('#fees_table');
                        tbody.empty(); // clear old data


                        if (response.status === 'OK' && response.data.length > 0) {
                            response.data.forEach((fee, index) => {
                                const row = `

                                <tr class="hover:bg-gray-50">
                                    <td>
                                        <input type="checkbox" name="fee_type_ids[]" class="mx-auto block" value="${fee.id}">
                                    </td>

                                    <td class="px-3 py-2 border">
                                        ${index + 1}
                                        <input type="hidden" name="fees[${index}][serial_no]" value="${index + 1}">
                                    </td>

                                    <td class="px-3 py-2 border">
                                        ${fee.fee_type.name}
                                        <input type="hidden" name="fees[${index}][fee_type_id]" value="${fee.fee_type.id}">
                                    </td>

                                    <td class="px-3 py-2 border">
                                        ${fee.amount}
                                        <input type="hidden" name="fees[${index}][amount]" value="${fee.amount}">
                                    </td>

                                    <td class="px-3 py-2 border">
                                        <input type="checkbox" name="fees[${index}][full_free]" value="1"
                                            class="w-5 h-5 mx-auto">
                                    </td>

                                    <td class="px-3 py-2 border">
                                        <input type="checkbox" name="fees[${index}][half_free]" value="1"
                                            class="w-5 h-5 mx-auto">
                                    </td>

                                    <td class="px-3 py-2 border">
                                        <input type="number" step="0.01" min="0"
                                            name="fees[${index}][less]" class="w-20 border-gray-300 rounded shadow-sm text-right">
                                    </td>

                                    <td class="px-3 py-2 border">
                                        <input type="number" step="0.01" min="0"
                                            name="fees[${index}][payable]" class="w-24 border-gray-300 rounded shadow-sm text-right">
                                    </td>
                                </tr>
                                `;
                                tbody.append(row);
                            });
                        } else {
                            tbody.append(
                                '<tr><td colspan="6" class="text-center text-red-500 py-4">No fees found for this class and year.</td></tr>'
                            );
                        }
                    },
                    error: function() {
                        console.error('Failed to fetch yearly fees');
                    }
                });
            }
        </script>

        <script>
            $(document).on('change', 'input[name^="fees"][name$="[full_free]"]', function() {
                const isChecked = $(this).is(':checked');
                const index = getIndexFromName($(this).attr('name'));

                if (isChecked) {
                    $(`input[name="fees[${index}][half_free]"]`).prop('checked', false);
                    $(`input[name="fees[${index}][less]"]`).val('');
                    $(`input[name="fees[${index}][payable]"]`).val(0);
                }
            });

            $(document).on('change', 'input[name^="fees"][name$="[half_free]"]', function() {
                const isChecked = $(this).is(':checked');
                const index = getIndexFromName($(this).attr('name'));

                if (isChecked) {
                    $(`input[name="fees[${index}][full_free]"]`).prop('checked', false);

                    const amount = parseFloat($(`input[name="fees[${index}][amount]"]`).val()) || 0;
                    const halfAmount = (amount / 2).toFixed(2);
                    $(`input[name="fees[${index}][less]"]`).val('');
                    $(`input[name="fees[${index}][payable]"]`).val(halfAmount);
                }
            });

            function getIndexFromName(name) {
                const match = name.match(/fees\[(\d+)\]/);
                return match ? match[1] : null;
            }
        </script>

        {{-- for less count --}}
        <script>
            $(document).on('input', 'input[name^="fees"][name$="[less]"]', function() {
                const $lessInput = $(this);
                const index = getIndexFromName($lessInput.attr('name'));

                // Uncheck full_free and half_free checkboxes
                $(`input[name="fees[${index}][full_free]"]`).prop('checked', false);
                $(`input[name="fees[${index}][half_free]"]`).prop('checked', false);

                // Get amount and less values
                const amount = parseFloat($(`input[name="fees[${index}][amount]"]`).val()) || 0;
                const less = parseFloat($lessInput.val()) || 0;

                // Calculate payable and set value
                const payable = Math.max(amount - less, 0).toFixed(2);
                $(`input[name="fees[${index}][payable]"]`).val(payable);
            });

            function getIndexFromName(name) {
                const match = name.match(/fees\[(\d+)\]/);
                return match ? match[1] : null;
            }
        </script>


    </x-page-layout>
</x-app-layout>
