<x-app-layout>

    <x-page-layout :title="'Student: Quick Create'">

        <x-slot name="actions">
            <a href="{{ route('students.index') }}" class="">
                ← Back to list
            </a>
        </x-slot>

        <div class=" mx-auto p-6">
            <div class=" rounded-xl p-8">
                <h2 class="text-3xl font-semibold text-gray-800 mb-6 border-b pb-4">Quick Admission</h2>

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

                <form action="{{ route('quickaddmissions.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                        <!-- Admission Date -->
                        <x-form.input type="date" name="admitted_at" label="Admission Date"
                            value="{{ \Carbon\Carbon::now()->toDateString() }}" />



                        <!-- Academic Year -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Academic Year</label>
                            <select name="year" id="year"
                                class="w-full h-12 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                @for ($year = date('Y') - 1; $year <= date('Y') + 1; $year++)
                                    <option value="{{ $year }}"
                                        {{ (old('year') ?? date('Y')) == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endfor
                            </select>
                            @error('year')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- ID Number -->
                        <x-form.input type="number" name="id_number" label="ID No" placeholder="Type Serial No"
                            readonly value="{{ old('id_number', $nextStudentId) }}" />

                        <!-- Student Name -->
                        <x-form.input type="text" name="name" label="Student's Name <span class='text-red-500'>*</span>"
                            placeholder="Type Student's Name" />


                        <!-- Version -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Version</label>
                            <div class="flex items-center space-x-6">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="version" value="bangla"
                                        {{ old('version', 'bangla') == 'bangla' ? 'checked' : '' }}
                                        class="text-blue-500 focus:ring-blue-500 border-gray-300">
                                    <span class="ml-2 text-sm text-gray-700">Bangla</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="version" value="english"
                                        {{ old('version') == 'english' ? 'checked' : '' }}
                                        class="text-blue-500 focus:ring-blue-500 border-gray-300">
                                    <span class="ml-2 text-sm text-gray-700">English</span>
                                </label>
                            </div>
                            @error('version')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>


                        {{-- Father's Name --}}
                        <x-form.input type="text" name="father_name" label="Father's Name <span class='text-red-500'>*</span>"
                            placeholder="Type Father's Name" />


                        <!-- Roll -->
                        <div class="flex items-center space-x-6">
                            <div class="flex-1">
                                <x-form.input type="number" name="roll" label="Roll"
                                    placeholder="Type Roll No." />
                            </div>

                            <div class="flex-1">
                                <label for="roll_postfix"
                                    class="block text-sm font-medium text-gray-700">Postfix</label>
                                <select name="roll_postfix" id="roll_postfix"
                                    class="w-full h-12 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="" selected>Select</option>
                                    @foreach (range('A', 'Z') as $letter)
                                        <option value="{{ $letter }}"
                                            {{ old('roll_postfix') == $letter ? 'selected' : '' }}>
                                            {{ $letter }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('roll_postfix')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>




                        <!-- Campus -->
                        <x-form.select name="campus_id" label="Campus <span class='text-red-500'>*</span>" :options="$campuses" optionValue="id"
                            optionLabel="name" />



                        {{-- Class --}}
                        <x-form.select3 name="class_id" label="Class <span class='text-red-500'>*</span>" :options="$classes
                            ->map(fn($class) => ['id' => $class->id, 'name' => $class->name, 'level' => $class->level])
                            ->values()" optionValue="id"
                            optionLabel="name" id="class_id" />


                        <!-- Section -->
                        <x-form.select name="section_id" label="Section <span class='text-red-500'>*</span>" :options="[]" optionValue="id"
                            optionLabel="name" />


                        {{-- Group --}}
                        <x-form.select name="group_id" label="Group" :options="$groups->map(fn($name, $id) => ['id' => $id, 'name' => $name])->values()" optionValue="id"
                            optionLabel="name" id="group_id" />

                        {{-- Date of Birth --}}
                        <div class="">
                            <label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth <span class='text-red-500'>*</span></label>
                            <input type="date" name="dob" id="dob" value="{{ old('dob') }}"
                                class="w-full h-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                            <div id="ageResult" class="text-sm text-blue-600 font-medium"></div>
                            @error('dob')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                            {{-- <div id="ageResult" class="mt-4  text-lg text-gray-800 font-semibold"></div> --}}
                        </div>

                        <!-- Gender -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Gender <span class='text-red-500'>*</span></label>
                            @php
                                $genders = [
                                    'male' => 'Male',
                                    'female' => 'Female',
                                    'other' => 'Other',
                                ];
                            @endphp
                            <select name="gender" id="gender"
                                class="w-full h-12 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">[Select]</option>
                                @foreach ($genders as $key => $value)
                                    <option value="{{ $key }}"
                                        {{ old('gender') == $key ? 'selected' : '' }}>
                                        {{ $value }}</option>
                                @endforeach
                            </select>
                            @error('gender')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Mobile -->
                        <x-form.input type="tel" name="mobile" label="Phone Number <span class='text-red-500'>*</span>"
                            placeholder="Type Phone No." />

                        <!-- SMS Number -->
                        <x-form.input type="tel" name="sms_number" label="SMS/WhatsApp Number <span class='text-red-500'>*</span>"
                            placeholder="Type SMS No." />

                        <!-- Status -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status"
                                class="w-full h-12 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }} selected>Active
                                </option>
                            </select>
                            @error('status')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>



                    </div>


                    {{-- Buttons --}}
                    <div class="mt-6 flex flex justify-end space-x-4 gap-4 mr-6">
                        <button type="submit"
                            class="w-24 bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded-md transition duration-200">
                            Save
                        </button>

                    </div>
                </form>
            </div>
        </div>

        <!-- Select2 Scripts -->
        <script>
            $(document).ready(function() {
                $('#campus_id, #group_id, #section_id').select2({
                    placeholder: "[Select]",
                    allowClear: true,
                    width: '100%'
                });
            });
        </script>

        {{-- Group activation script --}}
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

        {{-- For DOB --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const dobInput = document.getElementById('dob');
                const ageResult = document.getElementById('ageResult');

                function calculateAge(dobStr) {
                    if (!dobStr) {
                        ageResult.textContent = '';
                        return;
                    }

                    const dob = new Date(dobStr);
                    const today = new Date();

                    let years = today.getFullYear() - dob.getFullYear();
                    let months = today.getMonth() - dob.getMonth();
                    let days = today.getDate() - dob.getDate();

                    if (days < 0) {
                        months -= 1;
                        const previousMonth = new Date(today.getFullYear(), today.getMonth(), 0);
                        days += previousMonth.getDate();
                    }

                    if (months < 0) {
                        years -= 1;
                        months += 12;
                    }

                    ageResult.textContent = `Age: ${years} year's, ${months} month's, ${days} day's`;
                }

                dobInput.addEventListener('change', function() {
                    calculateAge(this.value);
                });

                // Trigger on page load if value is already set
                if (dobInput.value) {
                    calculateAge(dobInput.value);
                }
            });
        </script>


        <script src="{{ asset('js/section_select_by_campus_and_class.js') }}"></script>

        <script>
            // Initialize
            setupSectionSelect('#campus_id', '#class_id', '#section_id');
        </script>

        </x-page-show-layout>

</x-app-layout>
