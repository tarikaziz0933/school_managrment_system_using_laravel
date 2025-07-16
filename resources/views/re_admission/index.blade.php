<x-app-layout>
    <x-page-layout :title="'Readmission'">

        <x-slot name="actions">
            {{-- <a href="{{ route('fee-types.create') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                + Create
            </a> --}}
        </x-slot>
        <div class=" mx-auto px-4">
            <div class="space-y-6 mb-6">
                {{-- Previous Data: div --}}
                <div class="bg-white shadow rounded-xl p-6">
                    <h3 class="text-xl font-semibold mb-4 text-gray-700">Previous Data</h3>

                    <form action="{{ route('re-admissions.index') }}" method="GET">
                        @csrf

                        <div class="flex flex-wrap gap-4">

                            {{-- Academic Year --}}
                            <div class="flex-1">
                                <x-form.select name="year" label="Academic Year" :options="collect(range(date('Y') - 1, date('Y') + 1))->map(
                                    fn($y) => ['id' => $y, 'name' => $y],
                                )" :selected="old('year', date('Y'))"
                                    defaultLabel="[Select]" />
                            </div>


                            {{-- Campus --}}
                            <div class="flex-1">
                                <x-form.select name="campus_id" label="Campus" :options="$campuses->map(fn($name, $id) => ['id' => $id, 'name' => $name])" :selected="request('campus_id')" />
                            </div>

                            {{-- Class --}}
                            <div class="flex-1">
                                <x-form.select3 name="class_id" label="Class" :options="$classes
                                    ->map(
                                        fn($class) => [
                                            'id' => $class->id,
                                            'name' => $class->name,
                                            'level' => $class->level,
                                        ],
                                    )
                                    ->values()" optionValue="id"
                                    optionLabel="name" :selected="old('class_id', request('class_id'))" id="class_id" />
                            </div>



                            {{-- Section --}}
                            <div class="flex-1">
                                <x-form.select name="section_id" label="Section" :options="[]" :selected="request('section_id')" />
                            </div>

                            {{-- Group --}}
                            <div class="flex-1">
                                <x-form.select name="group_id" label="Group" :options="$groups->map(fn($name, $id) => ['id' => $id, 'name' => $name])->values()" optionValue="id"
                                    optionLabel="name" id="group_id" />
                            </div>

                            {{-- Student Name --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Search</label>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Search by Student ID or Name"
                                    class="w-64 h-12 border-gray-300 rounded shadow-sm">
                                @error('search')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Submit Button --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700">&nbsp;</label>
                                <button type="submit"
                                    class="w-24 bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg mt-1">
                                    Search
                                </button>
                            </div>

                        </div>
                    </form>
                </div>


                <form id="newDataForm" action="{{ route('re-admissions.store') }}" method="POST">
                    @csrf
                    <div class="bg-white shadow rounded-xl p-6">
                        <h3 class="text-xl font-semibold mb-4 text-gray-700">New Data</h3>

                        <div class="flex flex-wrap gap-4">

                            {{-- Academic Year --}}
                            <div class="flex-1">
                                <x-form.select name="student_new_year" label="Academic Year" :options="collect(range(date('Y') - 1, date('Y') + 1))->map(
                                    fn($y) => ['id' => $y, 'name' => $y],
                                )"
                                    :selected="old('student_new_year', date('Y') + 1)" defaultLabel="[Select]" />
                            </div>

                            {{-- Academic Year --}}
                            {{-- <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700">Academic Year</label>
                            <select name="student_new_year"
                                class="w-full h-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                @for ($year = date('Y') - 1; $year <= date('Y') + 1; $year++)
                                    <option value="{{ $year }}"
                                        {{ old('year', date('Y')) == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endfor
                            </select>
                            @error('student_new_year')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div> --}}

                            {{-- Campus --}}
                            {{-- <div class="flex-1">
                                <x-form.select name="student_new_campus_id" label="Campus" :options="$campuses->map(fn($name, $id) => ['id' => $id, 'name' => $name])"
                                    :selected="old('student_new_campus_id')" defaultLabel="[Select]" disabled />
                            </div> --}}

                            {{-- Campus --}}
                            <div class="flex-1">
                                {{-- This one is clickable but won't be submitted --}}
                                <label class="block text-sm font-medium text-gray-700">Campus</label>
                                <select class="w-full h-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                                    id="student_new_campus_id">
                                    <option value="">[Select]</option>
                                    @foreach ($campuses as $id => $name)
                                        <option value="{{ $id }}"
                                            {{ old('student_new_campus_id') == $id ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>

                                {{-- Hidden field with empty name, won't be submitted --}}
                                <input type="hidden" name="student_new_campus_id" value="">
                            </div>

                            {{-- Class --}}
                            <div class="flex-1">
                                <x-form.select3 name="student_new_class_id" label="Class" :options="$classes
                                    ->map(
                                        fn($class) => [
                                            'id' => $class->id,
                                            'name' => $class->name,
                                            'level' => $class->level,
                                        ],
                                    )
                                    ->values()"
                                    optionValue="id" optionLabel="name" id="student_new_class_id" />
                            </div>

                            {{-- Section --}}
                            <div class="flex-1">
                                <x-form.select name="student_new_section_id" label="Section" :options="[]"
                                    :selected="old('student_new_section_id')" defaultLabel="[Select]" />
                            </div>

                            {{-- Group --}}
                            <div class="flex-1">
                                <x-form.select name="student_new_group_id" label="Group" :options="$groups->map(fn($name, $id) => ['id' => $id, 'name' => $name])->values()"
                                    optionValue="id" optionLabel="name" id="student_new_group_id" />
                            </div>

                            {{-- Admission Date --}}
                            {{-- <div class="">
                            <label class="block text-sm font-medium text-gray-700">Admission Date</label>
                            <input type="date" name="student_new_admitted_at"
                                class="w-64 mt-1 border-gray-300 rounded shadow-sm"
                                value="{{ old('student_new_admitted_at', \Carbon\Carbon::now()->toDateString()) }}">
                        </div> --}}

                            {{-- Submit Button --}}
                            <div class="">
                                <label class="block text-sm font-medium text-gray-700">&nbsp;</label>
                                <button type="submit"
                                    class="w-24 bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded-md transition duration-200 mt-1">
                                    Save
                                </button>
                            </div>

                        </div>



                    </div>

                    <div>

                        {{-- Student Readmission Table --}}

                        <div class="bg-white shadow rounded-xl p-6 mt-6">
                            <h3 class="text-xl font-semibold mb-4 text-gray-700">Student Re-admission</h3>

                            {{-- {{ $studentClases->links() }} --}}

                            <div class="overflow-x-auto">
                                <table class="min-w-full text-sm text-left table-auto border">
                                    <thead class="bg-gray-100 text-gray-700">
                                        <tr>

                                            <th><input type="checkbox" id="select-all" class="mx-auto block mx-1"></th>
                                            <th class="px-3 py-2 border">Roll</th>

                                            <th class="px-3 py-2 border">Name</th>

                                            <th class="px-3 py-2 border">Class</th>
                                            <th class="px-3 py-2 border">Section</th>
                                            <th class="px-3 py-2 border">Campus</th>
                                            <th class="px-3 py-2 border">Group</th>
                                            <th class="px-3 py-2 border">Father</th>

                                            <th class="px-3 py-2 border">Mother</th>
                                            <th class="px-3 py-2 border">Year</th>

                                            <th class="px-3 py-2 border">Status</th>
                                            <th class="px-3 py-2 border">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($studentClases as $key => $studentClass)
                                            <tr class="hover:bg-gray-50">

                                                <td><input type="checkbox" name="student_ids[]"
                                                        class="mx-auto block mx-1"
                                                        value="{{ $studentClass->student->id }}"
                                                        data-student-id="{{ $studentClass->student->id }}"></td>

                                                <td class="px-3 py-2 border">
                                                    <input type="text"
                                                        name="rolls[{{ $studentClass->student->id }}]"
                                                        value="{{ $studentClass->student->currentClass?->roll }}"
                                                        class="w-20 border-gray-300 rounded shadow-sm" disabled>
                                                </td>

                                                <td class="px-3 py-2 border">{{ $studentClass->student->name }}
                                                    &nbsp;|

                                                    <br> {{ $studentClass->student->id_number }}
                                                </td>

                                                <td class="px-3 py-2 border student_class"
                                                    data-class-name="{{ $studentClass?->schoolClass?->name }}">
                                                    {{ $studentClass?->student->currentClass?->schoolClass?->name }}
                                                </td>
                                                <td class="px-3 py-2 border student_section"
                                                    data-section-name="{{ $studentClass?->section?->name }}">
                                                    {{ $studentClass?->student->currentClass?->section?->name }}</td>
                                                <td class="px-3 py-2 border campus_section">
                                                    {{-- <input type="hidden" class="campus-input"
                                                        name="campus_names[{{ $studentClass->student->id }}]"
                                                        value="{{ $studentClass?->student->currentClass?->campus?->name }}"
                                                        disabled> --}}
                                                    {{ $studentClass?->student->currentClass?->campus?->name }}
                                                </td>
                                                <td class="px-3 py-2 border student_group"
                                                    data-group-name="{{ $studentClass?->student->currentClass?->group?->name }}">
                                                    {{ $studentClass?->group?->name }}
                                                </td>
                                                <td class="px-3 py-2 border">
                                                    {{ $studentClass->student->father?->name }}

                                                    <br>
                                                    {{ $studentClass->student->father?->mobile }}
                                                </td>

                                                <td class="px-3 py-2 border">
                                                    {{ $studentClass->student->mother?->name }}

                                                    <br>
                                                    {{ $studentClass->student->mother?->mobile }}
                                                </td>

                                                <td class="px-3 py-2 border">
                                                    {{ $studentClass->student->currentClass?->year }}
                                                </td>

                                                <td class="px-3 py-2 border">
                                                    <span
                                                        class="inline-block w-full text-center px-2 py-1 rounded {{ $studentClass->student->status == 0 ? 'text-red-500' : 'text-green-500' }}">
                                                        {{ $studentClass->student->status == 0 ? 'Deactive' : 'Active' }}
                                                    </span>
                                                </td>
                                                <td class="px-3 py-2 border">
                                                    <a href="{{ route('students.show', $studentClass->student->id) }}"
                                                        target="_blank"
                                                        class="inline-block bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium px-3 py-1 rounded">
                                                        Show
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{-- {{ $studentClases->links() }} --}}
                            </div>

                            {{-- Buttons --}}
                            <div class="mt-6 flex flex justify-end space-x-4 gap-4 mr-6">
                                <button type="submit"
                                    class="w-24 bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded-md transition duration-200">
                                    Save
                                </button>

                            </div>

                        </div>
                    </div>



                    {{-- Initialize Select2 --}}
                    <script>
                        $(document).ready(function() {
                            $('#year, #class_id, #group_id, #section_id, #campus_id, #student_new_year, #student_new_class_id, #student_new_group_id, #student_new_section_id, #student_new_campus_id, #student_new_admitted_at')
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
                            $('#class_id, #group_id').select2();

                            toggleGroupSelect(); // Run on page load

                            $('#class_id').on('change', toggleGroupSelect);
                        });
                    </script>

                    <script>
                        $(document).ready(function() {
                            function toggleGroupSelect() {
                                const selectedClass = $('#student_new_class_id').find(':selected');
                                const level = parseInt(selectedClass.data('level'));

                                console.log('Selected Level:', level);

                                if (!isNaN(level) && level >= 9) {
                                    $('#student_new_group_id').prop('disabled', false);
                                } else {
                                    $('#student_new_group_id')
                                        .val('')
                                        .trigger('change')
                                        .prop('disabled', true);
                                }
                            }

                            // Initialize Select2 if not already initialized
                            $('#student_new_class_id, #student_new_group_id').select2();

                            toggleGroupSelect(); // Run on page load

                            $('#student_new_class_id').on('change', toggleGroupSelect);
                        });
                    </script>



                    {{-- Script for class --}}
                    <script>
                        $(document).ready(function() {
                            // When class dropdown changes
                            $('#student_new_class_id').on('change', function() {
                                const selectedValue = $(this).find('option:selected').val();
                                const selectedText = $(this).find('option:selected').text();

                                $('input[name="student_ids[]"]').each(function() {
                                    const row = $(this).closest('tr');
                                    const classCell = row.find('.student_class');

                                    if ($(this).is(':checked')) {
                                        if (selectedValue !== '') {
                                            classCell.text(selectedText);
                                        } else {
                                            classCell.text('');
                                        }
                                    } else {
                                        // Restore updated class name
                                        classCell.text(classCell.data('class-name'));
                                    }
                                });
                            });

                            // When any checkbox is toggled
                            $('input[name="student_ids[]"]').on('change', function() {
                                const row = $(this).closest('tr');
                                const classCell = row.find('.student_class');
                                const selectedText = $('#student_new_class_id').find('option:selected').text();

                                if ($(this).is(':checked')) {
                                    if ($('#student_new_class_id').val() !== '') {
                                        classCell.text(selectedText);
                                    }
                                } else {
                                    // Restore original class
                                    classCell.text(classCell.data('class-name'));
                                }
                            });
                        });
                    </script>

                    {{-- Script for Section --}}
                    <script>
                        $(document).ready(function() {
                            $('#student_new_section_id').on('change', function() {
                                const selectedValue = $(this).find('option:selected').val();
                                const selectedText = $(this).find('option:selected').text();

                                $('input[name="student_ids[]"]').each(function() {
                                    const row = $(this).closest('tr');
                                    const sectionCell = row.find('.student_section');

                                    if ($(this).is(':checked')) {
                                        if (selectedValue !== '') {
                                            sectionCell.text(selectedText);
                                        } else {
                                            sectionCell.text(sectionCell.data(
                                                'section-name')); // Clear section when no value is selected
                                        }
                                    } else {
                                        sectionCell.text(sectionCell.data(
                                            'section-name')); // Restore update section
                                    }
                                });
                            });

                            // When any checkbox is toggled
                            $('input[name="student_ids[]"]').on('change', function() {
                                const row = $(this).closest('tr');
                                const sectionCell = row.find('.student_section');
                                const selectedValue = $('#student_new_section_id').val();
                                const selectedText = $('#student_new_section_id').find('option:selected').text();

                                if ($(this).is(':checked')) {
                                    if (selectedValue && selectedValue !== '') {
                                        sectionCell.text(selectedText);
                                    } else {
                                        // Do nothing, keep the original value
                                        sectionCell.text(sectionCell.data('section-name'));
                                    }
                                } else {
                                    // If unchecked, always show original
                                    sectionCell.text(sectionCell.data('section-name'));
                                }
                            });
                        });
                    </script>

                    {{-- Script for Campus --}}
                    {{-- <script>
                        document.querySelectorAll('.student-checkbox').forEach(function(checkbox) {
                            checkbox.addEventListener('change', function() {
                                const studentId = this.dataset.studentId;
                                const campusInput = document.querySelector(`input[name="campus_names[${studentId}]"]`);

                                if (this.checked) {
                                    campusInput.removeAttribute('disabled');
                                } else {
                                    campusInput.setAttribute('disabled', true);
                                }
                            });
                        });
                    </script> --}}


                    {{-- Script for Group --}}
                    <script>
                        $(document).ready(function() {
                            // When Group dropdown changes
                            $('#student_new_group_id').on('change', function() {
                                const selectedValue = $(this).find('option:selected').val();
                                const selectedText = $(this).find('option:selected').text();

                                $('input[name="student_ids[]"]').each(function() {
                                    const row = $(this).closest('tr');
                                    const groupCell = row.find('.student_group');

                                    if ($(this).is(':checked')) {
                                        if (selectedValue && selectedValue !== '') {
                                            groupCell.text(selectedText);
                                        } else {
                                            groupCell.text(groupCell.data(
                                                'group-name')); // Keep original if nothing selected
                                        }
                                    } else {
                                        groupCell.text(groupCell.data('group-name'));
                                    }
                                });
                            });

                            // When any checkbox is toggled
                            $('input[name="student_ids[]"]').on('change', function() {
                                const row = $(this).closest('tr');
                                const groupCell = row.find('.student_group');
                                const selectedValue = $('#student_new_group_id').val();
                                const selectedText = $('#student_new_group_id option:selected').text();

                                if ($(this).is(':checked')) {
                                    if (selectedValue && selectedValue !== '') {
                                        groupCell.text(selectedText);
                                    } else {
                                        groupCell.text(groupCell.data('group-name'));
                                    }
                                } else {
                                    groupCell.text(groupCell.data('group-name'));
                                }
                            });
                        });
                    </script>

                    {{-- Checkbox enable and disable for roll --}}
                    <script>
                        $(document).ready(function() {
                            $('input[name="student_ids[]"]').on('change', function() {
                                const row = $(this).closest('tr');
                                const rollInput = row.find('input[name^="rolls"]');

                                if (!rollInput.data('original-value')) {
                                    rollInput.data('original-value', rollInput.val());
                                }

                                if ($(this).is(':checked')) {
                                    rollInput.prop('disabled', false); // Enable Roll input
                                } else {
                                    rollInput.prop('disabled', true); // Disable Roll input
                                    rollInput.val(rollInput.data('original-value')); // Restore original value
                                }
                            });

                            $('#select-all').on('change', function() {
                                const checked = $(this).is(':checked');
                                $('input[name="student_ids[]"]').each(function() {
                                    $(this).prop('checked', checked).trigger('change');
                                });
                            });
                        });
                    </script>



                </form>

            </div>
        </div>





        <script>
            document.getElementById('select-all').addEventListener('change', function(e) {
                let checkboxes = document.querySelectorAll('input[name="student_ids[]"]');
                checkboxes.forEach(cb => cb.checked = e.target.checked);
            });
        </script>


        <script src="{{ asset('js/section_select_by_campus_and_class.js') }}"></script>

        <script>
            // Initialize
            setupSectionSelect('#campus_id', '#class_id', '#section_id', '#group_id');

            // Initialize
            setupSectionSelect('#student_new_campus_id', '#student_new_class_id', '#student_new_section_id');
        </script>

        {{-- //old group select --}}
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
                $('#class_id, #group_id').select2();

                toggleGroupSelect(); // Run on page load

                $('#class_id').on('change', toggleGroupSelect);
            });
        </script>


        {{-- //new group select --}}
        <script>
            $(document).ready(function() {
                function toggleNewGroupSelect() {
                    const selectedClass = $('#student_new_class_id').find(':selected');
                    const level = parseInt(selectedClass.data('level'));

                    console.log('New Selected Level:', level);

                    if (!isNaN(level) && level >= 9) {
                        $('#student_new_group_id').prop('disabled', false);
                    } else {
                        $('#student_new_group_id')
                            .val('') // Clear value
                            .trigger('change') // Update UI (Select2 or native)
                            .prop('disabled', true);
                    }
                }

                // Initialize Select2 for new fields if needed
                $('#student_new_class_id, #student_new_group_id').select2();

                toggleNewGroupSelect(); // Run on page load

                $('#student_new_class_id').on('change', toggleNewGroupSelect);
            });
        </script>

    </x-page-layout>

</x-app-layout>
