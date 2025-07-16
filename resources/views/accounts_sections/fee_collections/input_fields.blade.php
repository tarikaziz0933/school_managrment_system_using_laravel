<div>
    <div class="rounded-xl p-4">

        <!-- Collection No -->
        <div class="flex justify-end">
            <div>
                <label for="collection_no" class="block text-sm font-medium text-gray-700 text-right">Collection
                    No</label>
                <input type="number" name="collection_no" id="collection_no"
                    value="{{ old('collection_no', $next_collection_no) }}"
                    class="h-12 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-right"
                    readonly>
            </div>
        </div>


        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">


            {{-- Student ID --}}
            <div>
                <label for="id_number" class="block text-sm font-medium text-gray-700">Student
                    ID</label>
                <input type="number" id="id_number" placeholder="Search by Student ID" value="{{ old('id_number') }}"
                    class="w-full h-12 border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-400 text-sm">

                <!-- Student ID -->
                <x-form.input type="hidden" name="student_id" label="" value="{{ old('student_id') }}" />

                @error('id_number')
                    <div id="id_number" class="text-red-500 text-sm mt-1"></div>
                @enderror
            </div>


            {{-- Applicable Year --}}
            <div>
                <x-form.select name="year" label="Applicable Year" :options="collect(range(date('Y') - 1, date('Y') + 1))->map(fn($y) => ['id' => $y, 'name' => $y])" :selected="old('year')"
                    defaultLabel="[Select]" />
            </div>

            {{-- Applicable Month --}}
            <div>
                <x-form.select name="applicable_month" label="Applicable Month" :options="collect(range(1, 12))->map(
                    fn($m) => [
                        'id' => $m,
                        'name' => \Carbon\Carbon::create()->month($m)->format('F'),
                    ],
                )" :selected="old('applicable_month', date('n'))"
                    defaultLabel="[Select]" />
            </div>



            <!-- Student Name -->
            <div>
                <x-form.input type="text" name="name" label="Student's Name"
                    value="{{ old(
                        'name',
                        // , $studentClass?->student?->name
                    ) }}"
                    readonly disabled />
            </div>

            <!-- Campus -->
            <div>
                <x-form.input type="text" name="campus_id" label="Campus"
                    value="{{ old(
                        'name',
                        // , $studentClass?->studentClass->name
                    ) }}"
                    readonly disabled />
            </div>

            <!-- Class -->
            <div>
                <x-form.input type="text" name="class_id" label="Class"
                    value="{{ old(
                        'class_id',
                        // , $studentClass?->studentClass?->name
                    ) }}"
                    readonly disabled />
            </div>

            <!-- Group -->
            <div>
                <x-form.input type="text" name="group_id" label="Group"
                    value="{{ old(
                        'group_id',
                        // , $studentClass?->studentClass?->name
                    ) }}"
                    readonly disabled />
            </div>

            <!-- Section -->
            <div>
                <x-form.input type="text" name="section_id" label="Section"
                    value="{{ old(
                        'class_id',
                        // , $studentClass?->section?->name
                    ) }}"
                    readonly disabled />
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

            <!-- Date -->
            <x-form.input type="date" name="admitted_at" label="Date"
                value="{{ \Carbon\Carbon::now()->toDateString() }}" />
        </div>

        <div>
            <div class=" bg-white shadow rounded-xl p-6 mt-6">

                {{-- {{ $studentClases->links() }} --}}

                <div class="flex-1 overflow-x-auto mr-6">
                    <table class="min-w-full text-sm text-left table-auto border">
                        <thead class="bg-gray-100 text-gray-700" id="fees_table_head">

                        </thead>
                        <tbody id="fees_table_body">

                        </tbody>
                    </table>
                    {{-- {{ $studentClases->links() }} --}}
                </div>


            </div>

            <div class="flex-1 overflow-x-auto mt-6">

                <h2 class="text-lg font-semibold mb-4 bg-blue-100 p-2 rounded">Transport Fee Section</h2>


                <table class="min-w-full text-sm text-left table-auto border">
                    <thead class="bg-gray-100 text-gray-700" id="transport_table_head">

                    </thead>
                    <tbody id="transport_table_body">

                    </tbody>
                </table>
                {{-- {{ $studentClases->links() }} --}}
            </div>


        </div>

        <div class=" mx-auto mt-6">
            <div class="grid grid-cols-3 gap-4">
                <!-- Left Column -->
                <div class="space-y-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Paid By</label>
                        <select name="paid_by" class="w-full border rounded px-2 py-1">
                            <option>Cash</option>
                            <option>Cheque</option>
                            <option>Bank Transfer</option>
                        </select>
                    </div>

                    <x-form.input name="cheque_no" label="Cheque No" />
                    <x-form.input name="bank_name" label="Bank Name" />
                    <x-form.input name="address" label="Address" />
                    <x-form.input name="remarks" label="Remarks" />

                    {{-- <div class="mt-4  p-2 rounded">
                                                <label class="block text-sm font-semibold">Enter Password</label>
                                                <div class="flex">
                                                    <input type="password" name="password"
                                                        class="flex-1 border px-2 py-1 rounded-l"
                                                        placeholder="Enter Password...">
                                                    <button type="button" class="px-4 py-1 rounded-r">Ok</button>
                                                </div>
                                            </div> --}}

                    {{-- <button type="submit"
                                                class="mt-4 bg-blue-500 text-white py-1 rounded">Search</button> --}}
                </div>

                <!-- Center Column -->
                <div class="space-y-2 text-center">
                    <h2 class="text-xl font-bold">Previous Dues</h2>
                    <div class="text-3xl font-extrabold">450 Tk.</div>

                    <div class="flex justify-center items-center mt-4">
                        <input type="checkbox" name="dues_collection" id="dues_collection" class="mr-2">
                        <label for="dues_collection" class="font-medium">Dues
                            Collection</label>
                    </div>

                    <div class="mt-6 bg-white border p-2 rounded text-sm">
                        <label class="block text-gray-700">Taka In Words:</label>
                        <div class="font-semibold mt-1">Two Thousand Five Hundred Taka Only
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-2">
                    <x-form.input name="total_amount" id="total_amount" label="Total" value=""
                        class="text-right" readonly />
                    <x-form.input name="fine_amount" class="flex-1 fine_amount text-right" label="Fine Amount" />
                    <x-form.input name="grand_total" label="Grand Total" id="grand_total" value=""
                        class="text-right" readonly />
                    <x-form.input name="less_amount" class="less_amount text-right" label="Less Amount" />
                    <x-form.input name="total_payable_amount" id="total_payable_amount" label="Total Payable Amount"
                        value="" class="text-right" readonly />
                    <x-form.input name="paid_amount" class="paid_amount text-right bg-yellow-200 font-semibold"
                        label="Paid Amount" value="" />
                    <x-form.input name="due_amount" id="due_amount" label="Dues Amount" value=""
                        class="text-right" readonly />
                    <x-form.input name="return_amount" id="return_amount" label="Return Amount" value=""
                        class="text-right" readonly />
                </div>
            </div>

        </div>
    </div>
</div>

{{-- showStudenById --}}
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

                    const student_id = student.id;
                    const year = student.currentClass
                        ?.year //get year for drop down//student.currentClass?.year;
                    const month = $('#applicable_month')
                        .val() //get month from drop down// $('#applicable_month').val();

                    const class_id = student.currentClass?.class?.id;

                    if (class_id && year) {
                        loadFees(class_id, year, student_id);
                    }
                    if (student_id && year) {
                        loadYearlyTransport(student_id, year);
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

    });
</script>

{{-- calculateTotalPayable --}}
<script>
    function calculateTotalPayable() {
        let feeTotal = 0;
        let totalLess = 0;
        let totalPayable = 0;
        let grandTotal = 0;
        let totalPayableAmount = 0;
        let returnAmount = 0;

        $('.payable-input').each(function() {
            const index = $(this).data('index');
            const amount = parseFloat($(`.fee_amount[data-index="${index}"]`).val()) || 0;
            const lessField = $(`.less-input[data-index="${index}"]`);
            const less = parseFloat(lessField.val()) || 0;
            const payableField = $(`.payable-input[data-index="${index}"]`);
            const payable = parseFloat(payableField.val()) || 0;
            // const fineField = $(`.fine_amount[data-index="${index}"]`);
            // const fine = parseFloat(fineField.val()) || 0;

            // console.log(fine);

            // If 'less' is given, use amount - less
            if (!isNaN(payable) && payableField.val() !== '') {
                // const payable = Math.max(amount - less, 0);
                feeTotal += payable;
                totalLess += less;
                totalPayable += payable;
                grandTotal = totalPayable;
            }
        });

        $('.transport-payable-input').each(function() {
            const value = parseFloat($(this).val());
            if (!isNaN(value)) {
                totalPayable += value;
                grandTotal = totalPayable;
            }
        });

        const fine = parseFloat($('.fine_amount').val()) || 0;
        grandTotal += fine;
        totalPayableAmount = grandTotal;

        const lessAmount = parseFloat($('.less_amount').val()) || 0;
        totalPayableAmount -= lessAmount;

        const paidAmount = parseFloat($('.paid_amount').val()) || 0;
        returnAmount = paidAmount - totalPayableAmount;
        console.log(paidAmount);



        $('#fee_total').val(Number(feeTotal).toFixed(2));
        $('#total_less').val(Number(totalLess).toFixed(2));
        $('#total_amount').val(Number(totalPayable).toFixed(2));
        $('#grand_total').val(Number(grandTotal).toFixed(2));
        $('#total_payable_amount').val(Number(totalPayableAmount).toFixed(2));
        if (returnAmount < 0) {
            $('#due_amount').val(Math.abs(returnAmount).toFixed(2));

            $('#return_amount').val('');
        } else {
            $('#return_amount').val(Number(returnAmount).toFixed(2));
            $('#due_amount').val('');
        }
    }
</script>

{{-- fees --}}
<script>
    function getShortMonthName(monthNumber) {
        const months = [
            "", "Jan", "Feb", "Mar", "Apr", "May", "Jun",
            "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
        ];

        if (monthNumber < 1 || monthNumber > 12) {
            return "";
        }

        return months[monthNumber];
    }

    function loadFees(class_id, year, student_id) {
        let total_amount = 0;
        if (!class_id || !year) {
            console.warn('Missing class_id or year to fetch yearly fees');
            return;
        }


        var url = `/api/fee-items/${class_id}/${year}/${student_id}`;

        console.log(url);

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                const thead = $('#fees_table_head');
                const tbody = $('#fees_table_body');
                thead.empty();
                tbody.empty();

                if (response.status === 'OK' && response.data.length > 0) {
                    const headRow = `
            <tr>
                <th><input type="checkbox" id="select-all-fees" class="mx-auto block"></th>
                <th class="px-3 py-2 border">Fees Name</th>
                <th class="px-3 py-2 border">Amount</th>
                <th class="px-3 py-2 border">Less</th>
                <th class="px-3 py-2 border">Payable</th>
            </tr>`;
                    thead.append(headRow);

                    response.data.forEach((feeItem, index) => {
                        const monthName = getShortMonthName(feeItem.month);
                        const monthText = monthName ? `${monthName}` : '';
                        const amount = parseFloat(feeItem.amount).toFixed(2);

                        const row = `
                <tr class="hover:bg-gray-50">
                    <td class="px-3 py-2 border">
                        <input type="checkbox" name="fee_type_ids[]" class="fee-checkbox mx-auto block border" value="${feeItem.id}">
                    </td>
                    <td class="px-3 py-2 border">
                        ${feeItem.fee_type.name}, ${feeItem.fee_type.payment_frequency_type.display_name}, ${monthText} ${feeItem.year}
                        <input type="hidden" name="fees[${feeItem.id}][fee_type_id]" value="${feeItem.fee_type.id}" readonly>
                    </td>
                    <td class="px-3 py-2 border text-right">
                        ${amount}
                        <input type="hidden" name="fees[${feeItem.id}][fee_amount]" data-index="${index}" class="fee_amount" value="${amount}" readonly>
                    </td>
                    <td class="px-3 py-2 border">
                        <input type="number" step="0.01" name="fees[${feeItem.id}][less]" data-index="${index}" class="less-input text-right border-gray-300 w-full rounded shadow-sm" readonly>
                    </td>
                    <td class="px-3 py-2 border">
                        <input type="number" step="0.01" name="fees[${feeItem.id}][payable]" data-index="${index}" class="payable-input text-right border-gray-300 w-full rounded shadow-sm" readonly>
                    </td>
                </tr>`;
                        tbody.append(row);
                    });

                    // Total row
                    tbody.append(`
            <tr class="hover:bg-gray-50">
                <td class="px-3 py-2 border"></td>
                <td class="px-3 py-2 border">Total Amount</td>
                <td class="px-3 py-2 border text-right">${total_amount}</td>
                <td class="px-3 py-2 border"><input type="number" id="total_less" class="total-less text-right border-gray-300 w-full rounded shadow-sm" readonly></td>
                <td class="px-3 py-2 border"><input type="number" id="fee_total" class="less-input text-right border-gray-300 w-full rounded shadow-sm" readonly></td>
            </tr>
        `);

                    // Less input listener
                    $(document).on('input', '.less-input', function() {
                        const index = $(this).data('index');
                        const amount = parseFloat($(`.fee_amount[data-index="${index}"]`).val()) ||
                            0;
                        const less = parseFloat($(this).val()) || 0;
                        const payable = Math.max(amount - less, 0);
                        $(`.payable-input[data-index="${index}"]`).val(payable.toFixed(2));
                        calculateTotalPayable();
                    });

                    // Checkbox change handler
                    $(document).on('change', '.fee-checkbox', function() {
                        const row = $(this).closest('tr');

                        const lessInput = row.find('.less-input');
                        const payableInput = row.find('.payable-input');
                        const feeAmountInput = row.find('.fee_amount');

                        const feeAmount = parseFloat(feeAmountInput.val()) || 0;

                        if ($(this).is(':checked')) {
                            const previousLess = lessInput.data('previous') || 0;
                            lessInput.prop('readonly', false).val(previousLess);
                            payableInput.prop('readonly', false);

                            const payable = feeAmount - previousLess;
                            payableInput.val(payable.toFixed(2));
                        } else {
                            const currentLess = parseFloat(lessInput.val()) || 0;
                            lessInput.data('previous', currentLess);

                            lessInput.prop('readonly', true).val('');
                            payableInput.prop('readonly', true).val('');
                        }

                        calculateTotalPayable();
                    });

                    // Select All handler
                    $(document).on('change', '#select-all-fees', function() {
                        const isChecked = $(this).is(':checked');
                        $('.fee-checkbox').each(function() {
                            $(this).prop('checked', isChecked).trigger('change');
                        });
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


{{-- Transport --}}
<script>
    function loadYearlyTransport(student_id, year) {
        if (!student_id || !year) {
            console.warn('Missing student_id or year to fetch yearly fees');
            return;
        }

        $.ajax({
            url: `/api/yearly-transport/${student_id}/${year}`,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                const thead = $('#transport_table_head');
                const tbody = $('#transport_table_body');
                thead.empty(); // clear old data
                tbody.empty(); // clear old data

                const row = `
                        <tr>
                            <th class="px-3 py-2 border">Select</th>

                            <th class="px-3 py-2 border">Root code</th>
                            <th class="px-3 py-2 border">Transport Name</th>
                            <th class="px-3 py-2 border">Amount</th>
                            <th class="px-3 py-2 border">Less</th>
                            <th class="px-3 py-2 border">Payable</th>
                        </tr>
                        `;
                thead.append(row);

                if (response.status === 'OK' && response.data.length > 0) {
                    response.data.forEach((transport, index) => {

                        const row = `
                            <tr class="hover:bg-gray-50">
                                <td class="px-3 py-2 border"><input type="checkbox" name="root_ids[]" class="transport-checkbox mx-auto block" value="${transport.id}"></td>

                                <td class="px-3 py-2 border">
                                    ${transport.root_divide.root_code}
                                    <input type="hidden" name="transport_fees[${transport.id}][root_code_id]" value="${transport.root_divide.root_code}" disabled>
                                </td>
                                <td class="px-3 py-2 border">
                                    ${transport.root_divide.vehicle_name}
                                    <input type="hidden" name="transport_fees[${transport.id}][vehicle_name]" value="${transport.root_divide.vehicle_name}" disabled>
                                </td>
                                <td class="px-3 py-2 border text-right">
                                    ${transport.root_divide.fees_amount}
                                    <input type="hidden" name="transport_fees[${transport.id}][amount]" data-index="${index}" class="transport-amount" value="${transport.root_divide.fees_amount}" disabled>
                                </td>
                                <td class="px-3 py-2 border">
                                    <input type="text" name="transport_fees[${transport.id}][less]" data-index="${index}" class="transport-less-input text-right border-gray-300 w-full rounded shadow-sm" disabled>
                                </td>
                                <td class="px-3 py-2 border">
                                    <input type="text" name="transport_fees[${transport.id}][payable]" data-index="${index}" class="transport-payable-input text-right border-gray-300 w-full rounded shadow-sm" disabled readonly>
                                </td>
                            </tr>`;
                        tbody.append(row);
                    });
                    //  Attach the select-all functionality
                    // $('#select-all-transport').on('change', function() {
                    //     const isChecked = $(this).is(':checked');
                    //     $('.transport-checkbox').prop('checked', isChecked);
                    // });

                    // Less input change listener
                    $('.transport-less-input').on('input', function() {
                        const index = $(this).data('index');
                        const amount = parseFloat($(`.transport-amount[data-index="${index}"]`)
                                .val()) ||
                            0;
                        const less = parseFloat($(this).val()) || 0;
                        const payable = Math.max(amount - less, 0); // prevent negative

                        $(`.transport-payable-input[data-index="${index}"]`).val(parseFloat(payable)
                            .toFixed(2));

                        calculateTotalPayable();
                    });

                    // Enable/disable 'less' input based on checkbox
                    $(document).on('change', '.transport-checkbox', function() {
                        const row = $(this).closest('tr');

                        const allInputs = row.find('input').not(this); // Checkbox বাদে সব input
                        const lessInput = row.find('.transport-less-input');
                        const payableInput = row.find('.transport-payable-input');
                        const transportAmount = parseFloat(row.find('.transport-amount').val()) ||
                            0;

                        if ($(this).is(':checked')) {
                            // Enable all inputs except checkbox
                            allInputs.prop('disabled', false);

                            // Restore previous less value if available
                            const previousLess = lessInput.data('previous') || 0;
                            lessInput.val(previousLess);

                            // Calculate payable
                            const payable = transportAmount - previousLess;
                            payableInput.val(payable.toFixed(2));
                        } else {
                            // Save current less for later
                            const currentLess = parseFloat(lessInput.val()) || 0;
                            lessInput.data('previous', currentLess);

                            // Disable all inputs except checkbox and clear inputs
                            allInputs.prop('disabled', true);
                            lessInput.val('');
                            payableInput.val('');
                        }

                        // Optional: Update total
                        calculateTotalPayable();
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


    $('form').on('submit', function() {
        // Fees table
        $('.fee-checkbox').each(function() {
            const row = $(this).closest('tr');
            const isChecked = $(this).is(':checked');
            row.find('input').not(this).prop('disabled', !isChecked);
        });

        // Transport table
        $('.transport-checkbox').each(function() {
            const row = $(this).closest('tr');
            const isChecked = $(this).is(':checked');
            row.find('input').not(this).prop('disabled', !isChecked);
        });
    });


    $('form').on('submit', function() {
        $(this).find('button[type="submit"]').prop('disabled', true);
    });
</script>

{{-- for grand total --}}
<script>
    $(document).on('input', '.fine_amount', function() {
        calculateTotalPayable();
    });

    $(document).on('input', '.less_amount', function() {
        calculateTotalPayable();
    });

    $(document).on('input', '.paid_amount', function() {
        calculateTotalPayable();
    });
</script>
