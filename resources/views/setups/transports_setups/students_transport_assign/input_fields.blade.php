<div>
    <div class="">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Serial No -->
            <div>
                <label for="serial_no" class="block text-sm font-medium text-gray-700">Serial No</label>
                <input type="number" name="serial_no" id="serial_no"
                    value="{{ old('serial_no', $studentTransport?->serial_no ?? ($studentsTransportAssigns->serial_no ?? (isset($studentsTransportAssigns) && is_countable($studentsTransportAssigns) ? count($studentsTransportAssigns) + 1 : 1))) }}"
                    class = "w-full h-12 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    readonly>

            </div>

            <!-- Campus -->
            <div>
                <x-form.input type="text" name="campus_id" label="Campus" value="{{ old('name') }}" disabled />
            </div>

            {{-- Year --}}
            <div>
                <x-form.select name="year" label="Year" :options="collect(range(date('Y') - 1, date('Y') + 1))->map(fn($y) => ['id' => $y, 'name' => $y])" :selected="old('year', $studentTransport->year ?? date('Y'))"
                    defaultLabel="[Select]" />
            </div>


            {{-- Student ID --}}
            <div>
                <label for="id_number" class="block text-sm font-medium text-gray-700">Student ID</label>
                <input type="number" id="id_number" placeholder="Search by Student ID"
                    value="{{ old('id_number', $studentTransport?->student?->id_number ?? '') }}"
                    class="w-full h-12 border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-400 text-sm">

                <!-- Student ID -->
                <x-form.input type="hidden" name="student_id" label="" value="{{ old('student_id') }}" />

                @error('id_number')
                    <div id="id_number" class="text-red-500 text-sm mt-1"></div>
                @enderror
            </div>

            <!-- Student Name -->
            <div>
                <x-form.input type="text" name="name" label="Student's Name"
                    value="{{ old('name', $studentTransport?->student?->name ?? '') }}" disabled />
            </div>


            {{-- Applicable Month --}}
            <div>
                <x-form.select name="applicable_month" label="Applicable Month" :options="collect(range(1, 12))->map(
                    fn($m) => ['id' => $m, 'name' => \Carbon\Carbon::create()->month($m)->format('F')],
                )" :selected="old('applicable_month', $studentTransport?->applicable_month ?? now()->month)"
                    defaultLabel="[Select]" />
            </div>


            <!-- Class -->
            <div>
                <x-form.input type="text" name="class_id" label="Class" value="{{ old('class_id') }}" disabled />
            </div>

            @php
                // dd($studentTransport->student->studentClass);
            @endphp

            <!-- Section -->
            <div>
                <x-form.input type="text" name="section_id" label="Section"
                    value="{{ old('section_id', $studentTransport?->section?->name ?? '') }}" disabled />
            </div>

            <!-- Roll -->
            <div class="flex items-center space-x-6">
                <div class="flex-1">
                    <x-form.input type="number" name="roll" label="Roll" value="{{ old('roll') }}" disabled />
                </div>

                <div class="flex-1">
                    <x-form.input type="text" name="roll_postfix" label="Postfix" value="{{ old('roll_postfix') }}"
                        disabled />
                </div>
            </div>



        </div>

        <div>
            <div class="bg-white shadow rounded-xl p-6 mt-6">
                {{-- {{ $studentClases->links() }} --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left table-auto border">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>

                                {{-- <th><input type="checkbox" id="select-all"></th> --}}
                                {{-- <th class="px-3 py-2 border">SL No</th> --}}

                                <th class="px-3 py-2 border">Select</th>

                                <th class="px-3 py-2 border">Vehicle Number</th>
                                <th class="px-3 py-2 border">Vehicle Name</th>
                                <th class="px-3 py-2 border">(Stoppies) From</th>
                                <th class="px-3 py-2 border">(Stoppies) To</th>
                                <th class="px-3 py-2 border">Fees Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rootDivides as $key => $rootDivide)
                                <tr class="hover:bg-gray-50">

                                    {{-- <td class="text-center">
                                        <input type="checkbox" name="root_divide_ids[]" value="{{ $rootDivide->id }}"
                                            {{ isset($studentTransport) && $studentTransport->root_divide_id == $rootDivide->id ? 'checked' : '' }}
                                            class="route-checkbox">
                                    </td> --}}

                                    <td class="text-center px-3 py-2 border">
                                        <input type="radio" name="root_divide_id" value="{{ $rootDivide->id }}"
                                            {{ isset($studentTransport) && $studentTransport->root_divide_id == $rootDivide->id ? 'checked' : '' }}
                                            class="route-radio">
                                    </td>

                                    {{-- <td class="px-3 py-2 border">
                                        <input type="text" name="vehicle_no[{{ $rootDivide->vehicle_no }}]"
                                            value="{{ $rootDivide->vehicle_no }}"
                                            class="w-20 border-gray-300 rounded shadow-sm" disabled>
                                    </td> --}}


                                    <td class="px-3 py-2 border">{{ $rootDivide->vehicle_no }}</td>
                                    <td class="px-3 py-2 border">{{ $rootDivide->vehicle_name }}</td>
                                    <td class="px-3 py-2 border">{{ $rootDivide->from }}</td>
                                    <td class="px-3 py-2 border">{{ $rootDivide->to }}</td>
                                    <td class="px-3 py-2 border">{{ $rootDivide->fees_amount }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- {{ $studentClases->links() }} --}}
                </div>

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
                    $('#roll').val(student.currentClass?.roll || '');
                    $('#roll_postfix').val(student.currentClass?.roll_postfix || '');
                    $('#id_number_error').text('');
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



        $('#id_number').on('blur', function() {
            const id_number = $(this).val().trim();

            showStudenById(id_number);
        });
    });
</script>

{{-- disable checkbox --}}
<script>
    document.querySelectorAll('input[name="root_divide_ids[]"]').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                document.querySelectorAll('input[name="root_divide_ids[]"]').forEach(function(
                    otherCheckbox) {
                    if (otherCheckbox !== checkbox) {
                        otherCheckbox.checked = false;
                    }
                });
            }
        });
    });
</script>
