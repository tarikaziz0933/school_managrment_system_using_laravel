<x-app-layout>
    <x-page-layout :title="'New Dues Collection (Fees)'">

        <x-slot name="actions">
            <a href="{{ route('dues-collections.index') }}" class="">
                ← Back to list
            </a>
        </x-slot>
        <div class="mx-auto py-10 px-6">
            <div class="bg-white rounded-xl shadow-lg p-8">
                {{-- <h2 class="text-2xl font-semibold text-center text-blue-700 mb-6">Dues Collection (Fees)</h2> --}}

                <form action="{{ route('dues-collections.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

                        <x-form.input name="invoice_no" label="Invoice No" value="{{ old('invoice_no', 1) }}" />
                        <x-form.input name="invoice_date" label="Invoice Date" type="date"
                            value="{{ old('invoice_date', date('Y-m-d')) }}" />

                        <!-- Date -->
                        <x-form.input name="date" label="Date" type="date" value="{{ old('date') }}" />

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
                        <x-form.input name="class_id" label="Class" value="{{ old('class') }}" readonly />

                        <!-- Group -->
                        <x-form.input name="group_id" label="Group" value="{{ old('group') }}" readonly />

                        <!-- Section -->
                        <x-form.input name="section_id" label="Section" value="{{ old('section') }}" readonly />

                        <!-- Student's Name -->
                        <x-form.input name="name" label="Student's Name" value="{{ old('full_name') }}" readonly />

                        <!-- Collect No -->
                        <x-form.input name="collect_no" label="Collect No" value="{{ old('collect_no') }}" />


                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-gray-50 rounded-lg p-6 mb-6">
                        <x-form.input name="total_due_amount" label="Total Dues Amount"
                            value="{{ old('total_due_amount') }}" />
                        <x-form.input name="less_amount" label="Less/Disc. Amount" value="{{ old('less_amount') }}" />

                        <x-form.input name="fine_amount" label="Fine Amount" value="{{ old('fine_amount') }}" />
                        <x-form.input name="payable_amount" label="Payable Amount"
                            value="{{ old('payable_amount') }}" />

                        <x-form.input name="paid_amount" label="Paid Amount" value="{{ old('paid_amount') }}" />
                        <x-form.input name="due_amount" label="Dues Amount" value="{{ old('due_amount') }}" />

                        <x-form.input name="return_amount" label="Return Amount" value="{{ old('return_amount') }}" />
                        <x-form.input name="taka_in_words" label="Taka In Words" value="{{ old('taka_in_words') }}" />
                    </div>

                    <div class="flex justify-end space-x-4">
                        {{-- <button type="reset"
                            class="bg-pink-500 hover:bg-pink-600 text-white font-semibold px-6 py-2 rounded-md">
                            New
                        </button> --}}
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md">
                            Save
                        </button>
                    </div>
                </form>
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




                $('#id_number').on('blur', function() {
                    const id_number = $(this).val().trim();

                    showStudenById(id_number);
                    // loadFees(class_id, year);
                });
            });
        </script>

    </x-page-layout>
</x-app-layout>
