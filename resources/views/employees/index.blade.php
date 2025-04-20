<x-app-layout>
    <div class="mx-auto px-4 py-6">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">

            <div class="bg-gray-100 p-4 space-y-4">
                <div class="flex justify-between items-center">
                    <h3 class="text-2xl font-semibold text-gray-700">Employees</h3>

                    {{-- Create Button --}}
                    <a href="{{ route('employees.create') }}"
                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                        Create
                    </a>
                </div>

                {{-- Search Form --}}
                <form method="GET" action="{{ route('users.index') }}"
                    class="flex flex-col sm:flex-row sm:items-center gap-2 w-full">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by name or email"
                        class="flex-1 border border-gray-300 rounded-md px-4 py-2 focus:ring focus:ring-blue-200 focus:outline-none">


                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
                        </svg>
                    </button>

                </form>
            </div>

            <div class="p-4 space-y-6">
                {{ $employees->links() }}

                @foreach ($employees as $employee)
                    <div class="flex items-start gap-4 bg-white border rounded-lg shadow p-4">
                        {{-- Photo (Left Side) --}}
                        <div class="w-32 h-32 flex-shrink-0">
                            <img src="{{ $employee->image?->url ?? asset('images/blank-profile-pic.png') }}"
                                alt="{{ $employee->name }}" class="w-full h-full object-cover rounded-lg border">
                        </div>

                        {{-- Info (Right Side) --}}
                        <div class="flex-1 space-y-4 text-sm">
                            {{-- Primary Info --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-x-6 gap-y-2">
                                <div><strong>ID:</strong> {{ $employee->id_number }}</div>
                                <div><strong>Name:</strong> {{ $employee->name }}</div>
                                {{-- <div><strong>Form No:</strong> {{ $employee->registration_number }}</div> --}}
                                <div><strong>Admitted:</strong> {{ $employee->admitted_at->format('d/m/Y') }}</div>
                                {{-- <div><strong>Academic Year:</strong> {{ $employee->academic_year }}</div> --}}
                                <div><strong>Campus:</strong> {{ $employee->campus?->name }}</div>
                                {{-- <div><strong>Class:</strong> {{ $employee->studentClass?->name }}</div> --}}
                                {{-- <div><strong>Group:</strong> {{ $employee->group?->name }}</div> --}}
                                {{-- <div><strong>Section:</strong> {{ $employee->section?->name }}</div> --}}
                                <div><strong>ID Number:</strong> {{ $employee->id_number }}</div>
                                <div><strong>Gender:</strong> {{ ucfirst($employee->gender) }}</div>
                                <div><strong>Mobile:</strong> {{ $employee->mobile }}</div>
                                <div><strong>Email:</strong> {{ $employee->email }}</div>
                                <div><strong>DOB:</strong> {{ $employee->dob?->format('d/m/Y') }}</div>
                                <div><strong>Status:</strong>
                                    @if ($employee->status === 1)
                                        <span class="text-green-600 font-semibold">Active</span>
                                    @else
                                        <span class="text-red-600 font-semibold">Inactive</span>
                                    @endif
                                </div>
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

                            {{-- Action Buttons --}}
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

                            <a href="{{ route('employees.show', $employee->id) }}"
                                class="bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700 transition">
                                Show
                            </a>

                            <a href="{{ route('employees.edit', $employee->id) }}"
                                class="bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700 transition">
                                Edit
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
</x-app-layout>
