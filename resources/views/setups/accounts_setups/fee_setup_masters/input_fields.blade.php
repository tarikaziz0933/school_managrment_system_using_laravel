<div class="flex flex-wrap gap-4">

    {{-- Academic Year --}}
    <div class="flex-1">
        <label class="block text-sm font-medium text-gray-700">Academic Year</label>
        <select name="year"
            class="w-full h-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
            @for ($year = date('Y') - 1; $year <= date('Y') + 1; $year++)
                <option value="{{ $year }}" {{ old('year', date('Y')) == $year ? 'selected' : '' }}>
                    {{ $year }}
                </option>
            @endfor
        </select>
        @error('year')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Class --}}
    <div class="flex-1">
        <x-form.select3 name="class_id" label="Class" :options="$classes
            ->map(fn($class) => ['id' => $class->id, 'name' => $class->name, 'level' => $class->level])
            ->values()" optionValue="id" optionLabel="name"
            :selected="old('class_id', $fee->class_id ?? '')" id="class_id" />
    </div>
    {{-- Class --}}
    {{-- <div class="flex-1">
        <x-form.select3 name="class_id_to" label="Class (To)" :options="$classes
            ->map(fn($class) => ['id' => $class->id, 'name' => $class->name, 'level' => $class->level])
            ->values()" optionValue="id" optionLabel="name"
            :selected="old('class_id_to')" />
    </div> --}}
    {{-- Group --}}
    <div class="flex-1">
        <x-form.select name="group_id" label="Group" :options="$groups->map(fn($name, $id) => ['id' => $id, 'name' => $name])->values()" optionValue="id" optionLabel="name"
            :selected="old('group_id', 'group_id', $fee->group_id ?? '')" id="group_id" />
    </div>
</div>

<div class="bg-white shadow rounded-xl p-6 mt-6">

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left table-auto border">
            <thead class="bg-gray-100 text-gray-700">
                <tr>

                    <th class="px-3 py-2 border text-center">SL</th>

                    <th class="px-3 py-2 border text-center">Fees Code</th>

                    <th class="px-3 py-2 border text-center">Fees Name</th>



                    <th class="px-3 py-2 border text-center">Fees Amount</th>
                    {{-- <th class="px-3 py-2 border">Payment Frequency</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($feeTypes as $key => $feeType)
                    <tr class="hover:bg-gray-50">
                        <td class="px-3 py-2 border text-center">
                            {{ $key + 1 }}

                        </td>

                        <td class="px-3 py-2 border text-center">
                            {{ $feeType->code }}

                        </td>
                        <td class="px-3 py-2 border">
                            {{ $feeType->name }}, {{  $feeType->paymentFrequencyType->display_name }}
                            <input type="hidden" name="fees[{{ $key }}][fee_type_id]"
                                value="{{ $feeType->id }}">
                        </td>

                        <td class="px-3 py-2 border  text-right">
                            <input type="number" name="fees[{{ $key }}][amount]"
                                class="border p-1 w-28 text-right" required>
                        </td>

                           {{-- <td class="px-3 py-2 border">
                            {{  $feeType->paymentFrequencyType->display_name }}

                        </td> --}}

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>




    <!-- Select2 Scripts -->
    <script>
        $(document).ready(function() {
            $('#campus_id, #section_id')
                .select2({
                    placeholder: "[Select]",
                    allowClear: true,
                    width: '100%'
                });
        });
    </script>

    <script>
        $(document).ready(function() {
            function toggleGroupSelect() {
                const selectedClass = $('#class_id').find(':selected');
                const level = parseInt(selectedClass.data('level'));

                console.log('Selected Level:', level);

                if (!isNaN(level) && level >= 9) {
                    $('#group_id').prop('disabled', false);
                } else {
                    $('#group_id')
                        .val('') // Clear value
                        .trigger('change') // Update UI (Select2 or native)
                        .prop('disabled', true);
                }
            }

            // Initialize Select2 if not already done
            $('#class_id, #group_id, #class_id_to').select2();

            toggleGroupSelect(); // Run on page load

            $('#class_id').on('change', toggleGroupSelect);
        });
    </script>

    <script src="{{ asset('js/section_select_by_campus_and_class.js') }}"></script>

    <script>
        // Initialize
        setupSectionSelect('#campus_id', '#class_id', '#section_id');

        // Initialize
        setupSectionSelect('#student_new_campus_id', '#student_new_class_id', '#student_new_section_id');
    </script>
