<x-app-layout>
    <div class="mx-auto px-4 py-6">
        <div class="bg-gray-100 shadow-md rounded-lg overflow-hidden">

            <div class=" p-4 space-y-4">
                <div class="flex justify-between items-center">
                    <h3 class="text-2xl font-semibold text-gray-700">Employees</h3>

                    {{-- Create Button --}}
                    <a href="{{ route('employees.create') }}"
                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                        Create
                    </a>
                </div>

                {{-- Search Form --}}
                <form method="GET" action="{{ route('employees.index') }}">

                    <div class="w-full bg-white p-4 rounded-lg shadow-md flex flex-wrap sm:flex-nowrap items-end gap-4">
                        <!-- Search container div (1/3 width) -->
                        <div class="basis-full sm:basis-1/3 min-w-[200px]">
                            <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                            <input type="text" name="search" id="search" value="{{ request('search') }}"
                                placeholder="Search by name or email"
                                class ="w-full h-16 sm:h-12 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>



                        <!-- Dropdowns and submit button container div (2/3 width) -->
                        <div class="basis-full sm:basis-2/3 flex flex-wrap sm:flex-nowrap gap-4">
                            <!-- Area (1/4) -->
                            <div class="flex-1 min-w-[100px]">
                                <label for="area" class="block text-sm font-medium text-gray-700">Area</label>
                                <input type="text" name="area" id="area" value="{{ request('area') }}"
                                    placeholder="Enter area name"
                                    class="w-full h-16 sm:h-12 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Campus -->
                            <div class="flex-1 min-w-[100px]">
                                <x-form.select name="campus_id" label="Campus" :options="$campuses->map(fn($name, $id) => ['id' => $id, 'name' => $name])->values()" optionValue="id"
                                    optionLabel="name" :selected="old('campus_id')" />
                            </div>


                            <!-- Designation -->
                            <div class="flex-1 min-w-[100px]">
                                <x-form.select name="designation_id" label="Designation" :options="$designations
                                    ->map(fn($name, $id) => ['id' => $id, 'name' => $name])
                                    ->values()"
                                    optionValue="id" optionLabel="name" :selected="old('designation_id')" />
                            </div>

                            <!-- Employment Type -->
                            <div class="flex-1 min-w-[100px]">
                                <x-form.select name="employment_type_id" label="Employment Type" :options="$employment_types
                                    ->map(fn($name, $id) => ['id' => $id, 'name' => $name])
                                    ->values()"
                                    optionValue="id" optionLabel="name" :selected="old('employment_type_id', request('employment_type_id'))" />
                            </div>


                            <!-- Type -->
                            {{-- <div class="flex-1 min-w-[100px]">
                                <x-form.select name="type" label="Type" :options="collect([
                                    ['id' => 'permanent', 'name' => 'Permanent'],
                                    ['id' => 'part_time', 'name' => 'Part Time'],
                                    ['id' => 'other', 'name' => 'Other'],
                                ])" optionValue="id"
                                    optionLabel="name" :selected="old('type', request('type'))" />
                            </div> --}}

                            <!-- Status -->
                            @php
                                $status = ['0' => 'Inactive', '1' => 'Active'];
                            @endphp

                            <div class="flex-1 min-w-[150px]">
                                <label class="block text-sm font-medium text-gray-700">Status:</label>
                                <select id="status" name="status"
                                    class ="w-full h-16 sm:h-12 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
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



                            <!-- Submit -->
                            <div class="w-auto">
                                <label class="block text-sm font-medium text-transparent">Search</label>
                                <button type="submit"
                                    class="w-full h-12 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition flex items-center justify-center gap-1">
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

            <div class="p-4 space-y-6">
                {{ $employees->links() }}

                @foreach ($employees as $employee)
                    <div class="flex items-start gap-4 bg-white border rounded-lg shadow p-4">
                        {{-- Photo (Left Side) --}}
                        <div class="w-32 h-32 flex-shrink-0">
                            <img src="{{ $employee?->image?->url ?? asset('images/blank-profile-pic.png') }}"
                                alt="{{ $employee?->name }}" class="w-full h-full object-cover rounded-lg border">
                        </div>

                        {{-- Info (Right Side) --}}
                        <div class="flex-1 space-y-4 text-sm">
                            {{-- Primary Info --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-x-6 gap-y-2">
                                <div><strong>ID:</strong> {{ $employee?->id_number }}</div>
                                <div><strong>Name:</strong> {{ $employee?->name }}</div>

                                <div><strong>Joined:</strong> {{ $employee?->joined_at->format('d/m/Y') }}</div>

                                <div><strong>Campus:</strong> {{ $employee?->campus?->name }}</div>
                                <div><strong>ID Number:</strong> {{ $employee?->id_number }}</div>
                                <div><strong>Designation:</strong> {{ $employee?->designation->name }}</div>
                                <div><strong>Gender:</strong> {{ ucfirst($employee?->gender) }}</div>
                                <div><strong>Mobile:</strong> {{ $employee?->mobile }}</div>
                                <div><strong>Email:</strong> {{ $employee?->email }}</div>
                                <div><strong>DOB:</strong> {{ $employee?->dob?->format('d/m/Y') }}</div>
                                <div><strong>Employment Type:</strong> {{ $employee?->employmentType?->name }}</div>
                                <div><strong>Status:</strong>
                                    @if ($employee->status === 1)
                                        <span class="text-green-600 font-semibold">Active</span>
                                    @else
                                        <span class="text-red-600 font-semibold">Inactive</span>
                                    @endif
                                </div>
                                <div><strong>Address:</strong> {{ $employee->presentAddress?->show() }} </div>
                                {{-- <div><strong>Marks:</strong> {{ $employee->marks }}</div> --}}
                            </div>

                            {{-- Additional Info --}}
                            {{-- <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-x-6 gap-y-2 border-t pt-4">
                                <div><strong>Religion:</strong> {{ $employee->religion?->name }}</div>
                                <div><strong>Blood Group:</strong> {{ $employee->bloodGroup?->name }}</div>
                                <div><strong>Nationality:</strong> {{ $employee->nationality?->name }}</div>
                                <div><strong>Birth Place:</strong> {{ $employee->district?->name }}</div>
                                <div><strong>Previous School:</strong> {{ $employee->prev_school }}</div>
                                <div><strong>Present Address:</strong> {{ $employee->present_address }}</div>
                                <div><strong>Permanent Address:</strong> {{ $employee->permanent_address }}</div>
                                <div class="md:col-span-3">
                                    <strong>Characteristics:</strong>
                                    @foreach ($employee->characteristics as $char)
                                        <span
                                            class="inline-block bg-gray-200 text-gray-700 text-sm px-2 py-1 rounded mr-1 mb-1">
                                            {{ $char->name }}
                                        </span>
                                    @endforeach
                                </div>
                                <div class="col-span-full"><strong>Remarks:</strong> {{ $employee->remarks }}</div>
                            </div> --}}

                            {{-- <div class="pt-3 flex gap-2">
                                <a href="{{ route('students.show', $employee->id) }}"
                                    class="bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700 transition">Show</a>
                                <a href="{{ route('students.edit', $employee->id) }}"
                                    class="bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700 transition">Edit</a>


                                <a href="{{ route('students.report', $employee->id) }}" target="_blank"
                                    class="bg-red-600 text-white px-4 py-1 rounded hover:bg-red-700 transition">
                                    PDF
                                </a>

                            </div> --}}
                        </div>

                        {{-- Action (right Side) --}}
                        <div class="flex-shrink-0 flex flex-col space-y-2">

                            <a href="{{ route('employees.show', $employee?->id) }}"
                                class="bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700 transition">
                                Show
                            </a>

                            <a href="{{ route('employees.edit', $employee?->id) }}"
                                class="bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700 transition">
                                Edit
                            </a>
                            <a href="{{ route('employees.report', $employee->id) }}" target="_blank"
                                class="bg-red-600 text-white px-5 py-2 rounded-lg hover:bg-red-700 transition">
                                PDF
                            </a>

                            {{-- <a href="{{ route('employees.edit', $employee->id) }}" target="_blank"
                                class="bg-red-600 text-white px-4 py-1 rounded hover:bg-red-700 transition">
                                PDF
                            </a> --}}

                        </div>

                    </div>
                @endforeach

                {{ $employees->links() }}
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#designation_id, #campus_id, #type, #nationality_id, #blood_group_name')
                .select2({
                    placeholder: "[Select]",
                    allowClear: true,
                    width: '100%'
                });
        });
    </script>
</x-app-layout>
