<x-app-layout>
    <div class="container-fluid">
        <div class="card p-6">
            <div class="mb-6">
                <h3 class="text-2xl font-bold">Student Admission</h3>
            </div>

            @if (session('success'))
                <div class="alert alert-success text-lg">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                    <strong>Whoops! Something went wrong.</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card-body">
                <form action="{{ route('quickaddmission.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="">
                        <!-- Separate single column beside the group -->

                        <!-- Grid layout with 3 columns -->
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 p-4">
                            <!-- Admission Date -->
                            <div>
                                <label class="block text-sm font-medium">Admission Date</label>
                                <input type="date" name="admitted_at" id="admitted_at" class="w-64 border p-2 rounded"
                                    value="{{ \Carbon\Carbon::now()->toDateString() }}">
                                
                                @error('admitted_at')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Form Number -->
                            <div>
                                <label for="registration_number" class="block text-lg font-medium text-gray-700">Form No</label>
                                <input
                                    type="text"
                                    name="registration_number"
                                    id="registration_number"
                                    class="mt-1 w-64 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2"
                                    placeholder="{{ count($students) + 1 }}"
                                    value="{{ count($students) + 1 }}"
                                    readonly
                                >
                                @error('registration_number')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Campus -->
                            <div>
                                <label for="campus_id" class="block text-lg font-medium text-gray-700">Campus</label>
                                <select
                                    name="campus_id"
                                    id="campus_id"
                                    class="mt-1 w-64 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2">
                                    @foreach ($campuses as $campus)
                                        <option value="{{ $campus->id }}" {{ old('campus_id') == $campus->id ? 'selected' : '' }}>{{ $campus->name }}</option>
                                    @endforeach
                                </select>
                                @error('campus_id')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- Class -->
                            <div>
                                <label for="branch" class="block text-lg font-medium text-gray-700">Class</label>
                                <select name="class_id" id="class_id"
                                    class="mt-1 w-64 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2">
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }} {{ old('class_id') == $class->id ? 'selected' : '' }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                                @error('class_id')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Group -->
                            <div>
                                <label for="group" class="block text-lg font-medium text-gray-700">Group</label>
                                <select name="group_id" id="group_id"
                                    class="mt-1 w-64 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2">
                                    @foreach ($groups as $group)
                                        <option value="{{ $group->id }}" {{ old('group_id') == $group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                                    @endforeach
                                </select>

                                @error('group_id')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Section -->
                            <div>
                                <label for="section" class="block text-lg font-medium text-gray-700">Section</label>
                                <select name="section_id" id="section_id"
                                    class="mt-1 w-64 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2">
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}" {{ old('section_id') == $section->id ? 'selected' : '' }}>{{ $section->name }}</option>
                                    @endforeach
                                </select>

                                @error('section_id')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Year -->
                            <div>
                                <label class="block text-sm font-medium">Academic Year</label>
                                <select name="academic_year" id="academic_year" class="w-64 border p-2 rounded">
                                    @for ($year = 2025; $year <= 2035; $year++)
                                        <option value="{{ $year }}" {{ old('academic_year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                    @endfor
                                </select>

                                @error('academic_year')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Serial No -->
                            <div>
                                <label for="id_number" class="block text-lg font-medium text-gray-700">ID No</label>
                                <input type="number" name="id_number" placeholder="Serial No"  value="{{ old('id_number') }}"
                                    class="mt-1 w-64 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2" />

                                @error('id_number')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Student Name -->
                            <div class="">
                                <label for="student_name" class="block text-lg font-medium text-gray-700">Student
                                    Name</label>
                                <input type="text" name="name" placeholder="Student Name" value="{{ old('name') }}"
                                    class="mt-1 w-64 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2" />

                                @error('name')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Roll -->
                            <div>
                                <label class="block text-sm font-medium">Roll</label>
                                <select name="roll" id="roll" class="w-64 border p-2 rounded">
                                    @for ($roll = 1; $roll <= 50; $roll++)
                                        <option value="{{ $roll }}" {{ old('roll') == $roll ? 'selected' : '' }}>{{ $roll }}</option>
                                    @endfor
                                </select>

                                @error('roll')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Sex -->
                            <div>
                                <label class="block text-sm font-medium">Sex</label>
                                <select name="gender" id="gender" class="w-64 border p-2 rounded">
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                            
                                @error('gender')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status and Admission Test Marks -->

                            <div class="flex-1">
                                <label class="block font-semibold mb-2">Status:</label>
                                <select name="status" id="status" class="w-64 px-4 py-2 border p-2 rounded">
                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                </select>
                            
                                @error('status')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Phone No -->
                            <div>
                                <label for="phone_no" class="block text-lg font-medium text-gray-700">Phone
                                    Number</label>
                                <input type="text" name="mobile" id="mobile" placeholder="Phone No" value="{{ old('mobile') }}"
                                    class="mt-1 w-64 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2" />

                                @error('mobile')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-6">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded-md transition">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#campus_id').select2({
                placeholder: "Select a campus",
                allowClear: true
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#class_id').select2({
                placeholder: "Select a class",
                allowClear: true
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#group_id').select2({
                placeholder: "Select a group",
                allowClear: true
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#section_id').select2({
                placeholder: "Select a section",
                allowClear: true
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#class_id').select2({
                placeholder: "Select a class",
                allowClear: true
            });
        });
    </script>


</x-app-layout>
