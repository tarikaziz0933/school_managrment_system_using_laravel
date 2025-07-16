<x-app-layout>

    <div class="mx-auto px-4 py-6">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">

            <div class="bg-gray-100 p-4 space-y-4">
                <div class="flex flex-wrap justify-between items-center gap-4">
                    <h3 class="text-2xl font-semibold text-gray-700">Students</h3>


                    <div>
                        {{-- Create Button --}}
                        <a href="{{ route('students.create') }}"
                            class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            Create
                        </a>

                        &nbsp;

                        <a href="{{ route('quickaddmissions.create') }}"
                            class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            Quick Create
                        </a>
                    </div>

                </div>

                {{-- Search Form --}}
                <form method="GET" action="{{ route('students.index') }}">
                    <div class="w-full bg-white p-4 rounded-lg shadow-md flex flex-col gap-4">

                        <!-- Search Inputs Group -->
                        <div class="flex flex-col sm:flex-row gap-4 items-end">
                            <!-- Student Name or ID (3/4) -->
                            <div class="w-full sm:w-3/4">
                                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Student Name
                                    or ID</label>
                                <input type="text" name="search" id="search" value="{{ request('search') }}"
                                    placeholder="Enter student name or ID"
                                    class="w-full h-11 px-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm">
                            </div>

                            <!-- Area (1/4) -->
                            <div class="w-full sm:w-1/4">
                                <label for="area" class="block text-sm font-medium text-gray-700 mb-1">Area</label>
                                <input type="text" name="area" id="area" value="{{ request('area') }}"
                                    placeholder="Enter area name"
                                    class="w-full h-11 px-3 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm">
                            </div>
                        </div>



                        <!-- Dropdowns -->
                        <div class="w-full flex flex-wrap gap-4">

                            <!-- Academic Year -->
                            <div class="flex-1 min-w-[150px]">
                                <label class="block text-sm font-medium text-gray-700">Academic Year</label>
                                <select name="year"
                                    class="w-full h-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                    <option value="">[Select]</option>
                                    @for ($year = date('Y') - 1; $year <= date('Y') + 1; $year++)
                                        <option value="{{ $year }}"
                                            {{ (request('year') ?? date('Y')) == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                                @error('year')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Campus -->
                            <div class="flex-1 min-w-[150px]">
                                <x-form.select name="campus_id" label="Campus" :options="$campuses->map(fn($name, $id) => ['id' => $id, 'name' => $name])->values()" optionValue="id"
                                    optionLabel="name" :selected="old('campus_id')" />
                            </div>

                            {{-- Class --}}
                            <div class="flex-1 min-w-[150px]">
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

                            {{-- Group --}}
                            <div class="flex-1 min-w-[150px]">
                                <x-form.select name="group_id" label="Group" :options="$groups->map(fn($name, $id) => ['id' => $id, 'name' => $name])->values()" optionValue="id"
                                    optionLabel="name" id="group_id" />
                            </div>

                            <!-- Section -->
                            {{-- <div class="flex-1 min-w-[150px]">
                                <x-form.select name="section_id" label="Section" :options="$sections->map(fn($name, $id) => ['id' => $id, 'name' => $name])->values()" optionValue="id"
                                    optionLabel="name" :selected="old('section_id')" />
                            </div> --}}
                            <!-- Section -->
                            <div class="flex-1 min-w-[150px]">
                                <x-form.select name="section_id" label="Section" :options="[]" optionValue="id"
                                    optionLabel="name" />
                            </div>

                            <!-- Status -->
                            @php
                                $status = ['0' => 'Inactive', '1' => 'Active'];
                            @endphp

                            <div class="flex-1 min-w-[150px]">
                                <label class="block text-sm font-medium text-gray-700 ">Status:</label>
                                <select id="status" name="status"
                                    class="w-full h-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                    <option value=""
                                        {{ old('status', request('status')) === null || old('status', request('status')) === '' ? 'selected' : '' }}>
                                        [Select]</option>
                                    @foreach ($status as $id => $value)
                                        <option value="{{ $id }}"
                                            {{ (string) old('status', request('status')) === (string) $id ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>



                            <!-- Search Button -->
                            <div class="flex items-center justify-end w-full sm:w-auto">
                                <label class="block text-sm font-medium text-gray-700 mb-1">&nbsp;</label>

                                <button type="submit"
                                    class=" mt-5 w-full h-12 sm:w-40 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition flex items-center justify-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
                                    </svg>
                                    <span>Search</span>
                                </button>
                            </div>

                        </div>

                    </div>
                </form>

            </div>

            <div class="bg-gray-100 p-4 space-y-6">
                {{ $studentClasses->links() }}

                @foreach ($studentClasses as $studentClass)
                    <div class="flex flex-col sm:flex-row items-start gap-4 bg-white border rounded-lg shadow p-4">
                        {{-- Photo --}}
                        <div class="w-full sm:w-32 h-32 flex-shrink-0">
                            <img src="{{ $studentClass->student->image?->url ?? asset('images/blank-profile-pic.png') }}"
                                alt="{{ $studentClass->student->name }}"
                                class="w-full h-full object-cover rounded-lg border">
                        </div>

                        {{-- Info --}}
                        <div class="flex-1 space-y-4 text-sm">
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-2">
                                <div><strong>ID:</strong> {{ $studentClass->student->id_number }}</div>
                                <div><strong>Name:</strong> {{ $studentClass->student->name }}</div>

                                <div><strong>Academic Year:</strong> {{ $studentClass->year }}</div>
                                <div><strong>Version:</strong> {{ ucfirst($studentClass->student->version) }}</div>
                                <div><strong>Campus:</strong> {{ $studentClass->campus?->name }}</div>
                                <div><strong>Class:</strong> {{ $studentClass->SchoolClass?->name }}</div>
                                @if ($studentClass->group)
                                    <div><strong>Group:</strong> {{ $studentClass->group->name }}</div>
                                @endif
                                <div><strong>Section:</strong> {{ $studentClass->section?->name }}</div>
                                <div><strong>Roll:</strong> {{ $studentClass->roll }}
                                    {{ $studentClass->roll_postfix }}</div>
                                {{-- <div><strong>Gender:</strong> {{ ucfirst($studentClass->student->gender) }}</div> --}}
                                <div><strong>SMS/Whats App Number:</strong> {{ $studentClass?->student?->sms_number }}
                                </div>
                                <div><strong>Email:</strong> {{ $studentClass->student->email }}</div>
                                <div><strong>DOB:</strong> {{ $studentClass->student->dob?->format('d/m/Y') }}
                                </div>
                                <div><strong>Father's Occupation:</strong>
                                    {{ $studentClass->student?->father?->occupation?->name }}</div>
                                <div><strong>Mother's Occupation:</strong>
                                    {{ $studentClass->student?->mother?->occupation?->name }}</div>
                                <div><strong>Address:</strong> {{ $studentClass->student->presentAddress?->show() }}
                                </div>
                                {{-- <div><strong>Status:</strong>
                                    @if ($studentClass->student->status === 1)
                                        <span class="text-green-600 font-semibold">Active</span>
                                    @else
                                        <span class="text-red-600 font-semibold">Inactive</span>
                                    @endif
                                </div> --}}
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="flex flex-row sm:flex-col space-x-2 sm:space-x-0 sm:space-y-2">
                            <a href="{{ route('students.show', $studentClass->student->id) }}"
                                class="bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700 transition text-center">
                                Show
                            </a>
                            <a href="{{ route('students.edit', $studentClass->student->id) }}"
                                class="bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700 transition text-center">
                                Edit
                            </a>
                            <a href="{{ route('students.report', $studentClass->student->id) }}" target="_blank"
                                class="bg-red-600 text-white px-4 py-1 rounded hover:bg-red-700 transition text-center">
                                PDF
                            </a>
                        </div>
                    </div>
                @endforeach

                {{ $studentClasses->links() }}
            </div>
        </div>
    </div>

    <!-- Optional: Select2 JS -->
    <script>
        $(document).ready(function() {
            $('#class_id, #campus_id, #group_id, #section_id')
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

    <script src="{{ asset('js/section_select_by_campus_and_class.js') }}"></script>

    <script>
        // Initialize
        setupSectionSelect('#campus_id', '#class_id', '#section_id');
    </script>
</x-app-layout>
