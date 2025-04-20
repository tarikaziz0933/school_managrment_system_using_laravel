<x-app-layout>
    <div class="mx-auto px-4 py-6">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">

            <div class="bg-gray-100 p-4 space-y-4">
                <div class="flex justify-between items-center">
                    <h3 class="text-2xl font-semibold text-gray-700">Students</h3>

                    {{-- Create Button --}}
                    <a href="{{ route('students.create') }}"
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

                    <!-- Class -->
                    <div>

                        <select name="class_id" id="class_id"
                            class="mt-1  w-full  text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2">

                            @foreach ($classes as $id => $name)
                                <option value="{{ $id }}"
                                    {{ old('class_id') == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>

                        @error('class_id')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror

                    </div>

                    <div>

                        <select name="section_id" id="section_id"
                            class="mt-1  w-full  text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2">

                            @foreach ($sections as $id => $name)
                                <option value="{{ $id }}" {{ old('section_id') == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>

                        @error('section_id')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

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
                {{ $students->links() }}

                @foreach ($students as $student)
                    <div class="flex items-start gap-4 bg-white border rounded-lg shadow p-4">
                        {{-- Photo (Left Side) --}}
                        <div class="w-32 h-32 flex-shrink-0">
                            <img src="{{ $student->image?->url ?? asset('images/blank-profile-pic.png') }}"
                                alt="{{ $student->name }}" class="w-full h-full object-cover rounded-lg border">
                        </div>

                        {{-- Info (Right Side) --}}
                        <div class="flex-1 space-y-4 text-sm">
                            {{-- Primary Info --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-x-6 gap-y-2">
                                <div><strong>ID:</strong> {{ $student->id_number }}</div>
                                <div><strong>Name:</strong> {{ $student->name }}</div>
                                <div><strong>Form No:</strong> {{ $student->registration_number }}</div>
                                <div><strong>Admitted:</strong> {{ $student->admitted_at->format('d/m/Y') }}</div>
                                <div><strong>Academic Year:</strong> {{ $student->academic_year }}</div>
                                <div><strong>Campus:</strong> {{ $student->campus?->name }}</div>
                                <div><strong>Class:</strong> {{ $student->studentClass?->name }}</div>
                                <div><strong>Group:</strong> {{ $student->group?->name }}</div>
                                <div><strong>Section:</strong> {{ $student->section?->name }}</div>
                                <div><strong>Roll:</strong> {{ $student->roll }}</div>
                                <div><strong>Gender:</strong> {{ ucfirst($student->gender) }}</div>
                                <div><strong>Mobile:</strong> {{ $student->mobile }}</div>
                                <div><strong>Email:</strong> {{ $student->email }}</div>
                                <div><strong>DOB:</strong> {{ $student->dob?->format('d/m/Y') }}</div>
                                <div><strong>Status:</strong>
                                    @if ($student->status === 1)
                                        <span class="text-green-600 font-semibold">Active</span>
                                    @else
                                        <span class="text-red-600 font-semibold">Inactive</span>
                                    @endif
                                </div>
                                {{-- <div><strong>Marks:</strong> {{ $student->marks }}</div> --}}
                            </div>

                            {{-- Additional Info --}}
                            {{-- <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-x-6 gap-y-2 border-t pt-4">
                                <div><strong>Religion:</strong> {{ $student->religion?->name }}</div>
                                <div><strong>Blood Group:</strong> {{ $student->bloodGroup?->name }}</div>
                                <div><strong>Nationality:</strong> {{ $student->nationality?->name }}</div>
                                <div><strong>Birth Place:</strong> {{ $student->district?->name }}</div>
                                <div><strong>Previous School:</strong> {{ $student->prev_school }}</div>
                                <div><strong>Present Address:</strong> {{ $student->present_address }}</div>
                                <div><strong>Permanent Address:</strong> {{ $student->permanent_address }}</div>
                                <div class="md:col-span-3">
                                    <strong>Characteristics:</strong>
                                    @foreach ($student->characteristics as $char)
                                        <span
                                            class="inline-block bg-gray-200 text-gray-700 text-sm px-2 py-1 rounded mr-1 mb-1">
                                            {{ $char->name }}
                                        </span>
                                    @endforeach
                                </div>
                                <div class="col-span-full"><strong>Remarks:</strong> {{ $student->remarks }}</div>
                            </div> --}}

                            {{-- Action Buttons --}}
                            {{-- <div class="pt-3 flex gap-2">
                                <a href="{{ route('students.show', $student->id) }}"
                                    class="bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700 transition">Show</a>
                                <a href="{{ route('students.edit', $student->id) }}"
                                    class="bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700 transition">Edit</a>


                                <a href="{{ route('students.report', $student->id) }}" target="_blank"
                                    class="bg-red-600 text-white px-4 py-1 rounded hover:bg-red-700 transition">
                                    PDF
                                </a>

                            </div> --}}
                        </div>

                          {{-- Action (right Side) --}}
                          <div class="flex-shrink-0 flex flex-col space-y-2">

                            <a href="{{ route('students.show', $student->id) }}"
                                class="bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700 transition">
                                Show
                            </a>

                            <a href="{{ route('students.edit', $student->id) }}"
                                class="bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700 transition">
                                Edit
                            </a>

                            <a href="{{ route('students.report', $student->id) }}" target="_blank"
                                class="bg-red-600 text-white px-4 py-1 rounded hover:bg-red-700 transition">
                                PDF
                            </a>

                        </div>

                    </div>
                @endforeach

                {{ $students->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
