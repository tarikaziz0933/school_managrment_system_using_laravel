<x-app-layout>
    <div class="container-fluid">
        <div class="card p-6">
            <div class="mb-6">
                <h3 class="text-2xl font-bold">Student Admission</h3>
            </div>

            @if (session('success'))
                <div class="alert alert-success text-lg">{{ session('success') }}</div>
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
                                <input type="date" name="admitted_at" class="w-64 border p-2 rounded" value="{{ \Carbon\Carbon::now()->toDateString() }}">
                            </div>
                            <!-- Form Number -->
                            <div>
                                <label class="block text-sm font-medium">Form No</label>
                                <input type="text" name="form_number" class="w-64 border p-2 rounded  " placeholder="{{ count($students) + 1 }}" value="{{ count($students) + 1 }}" readonly>
                            </div>

                            <!-- Campus -->
                            <div>
                                <label for="campus_id" class="block text-lg font-medium text-gray-700">Campus</label>
                                <select name="campus_id" id="campus_id"
                                    class="mt-1 w-64 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2">
                                    <option value="">-- Select Campus --</option>
                                    @foreach ($campuses as $campus)
                                        <option value="{{ $campus->id }}">{{ $campus->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Class -->
                            <div>
                                <label for="branch" class="block text-lg font-medium text-gray-700">Class</label>
                                <select name="class_id" id="class_id"
                                    class="mt-1 w-64 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2">
                                    <option value="">-- Select Class --</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Group -->
                            <div>
                                <label for="group" class="block text-lg font-medium text-gray-700">Group</label>
                                <select name="group_id" id="group_id"
                                    class="mt-1 w-64 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2">
                                    <option value="">-- Select Group --</option>
                                    @foreach ($groups as $group)
                                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Section -->
                            <div>
                                <label for="section" class="block text-lg font-medium text-gray-700">Section</label>
                                <select name="section_id" id="section_id"
                                    class="mt-1 w-64 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2">
                                    <option value="">-- Select Section --</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Year -->
                            <div>
                                <label class="block text-sm font-medium">Academic Year</label>
                                <select name="academic_year" class="w-64 border p-2 rounded">
                                    @for ($year = 2025; $year <= 2035; $year++)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Serial No -->
                            <div>
                                <label for="serial_no" class="block text-lg font-medium text-gray-700">ID No</label>
                                <input type="number" name="serial_no" id="serial_no" placeholder="Serial No"
                                    class="mt-1 w-64 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2" />
                            </div>

                            <!-- Student Name -->
                            <div class="">
                                <label for="student_name" class="block text-lg font-medium text-gray-700">Student Name</label>
                                <input type="text" name="name" id="name" placeholder="Student Name"
                                    class="mt-1 w-64 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2" />
                            </div>

                            <!-- Roll -->
                            <div>
                                <label class="block text-sm font-medium">Roll</label>
                                <select name="roll" class="w-64 border p-2 rounded">
                                    @for ($roll = 0; $roll <= 50; $roll++)
                                        <option value="{{ $roll }}">{{ $roll }}</option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Sex -->
                            <div>
                                <label class="block text-sm font-medium">Sex</label>
                                <select name="gender" class="w-64 border p-2 rounded">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <!-- Status and Admission Test Marks -->

                            <div class="flex-1">
                                <label class="block font-semibold mb-2">Status:</label>
                                <select id="status" name="status" class="w-64 px-4 py-2 border p-2 rounded">
                                    <option value="0">Inactive</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>

                            <!-- Phone No -->
                            <div>
                                <label for="phone_no" class="block text-lg font-medium text-gray-700">Phone Number</label>
                                <input type="text" name="mobile" id="mobile" placeholder="Phone No"
                                    class="mt-1 w-64 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2" />
                            </div>
                        </div>

                    <!-- Submit Button -->
                    <div class="mt-6">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded-md transition">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</x-app-layout>
