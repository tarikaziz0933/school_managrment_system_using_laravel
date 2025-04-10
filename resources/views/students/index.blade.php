<x-app-layout>
    <div class="mx-auto px-4 py-6">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-gray-100 p-4">
                <h3 class="text-2xl font-semibold text-gray-700">Student List</h3>
            </div>
            <div class="p-4">

                {{ $students->links() }}
                
                <table class="min-w-full table-auto mt-3 mb-6">
                    <thead>
                        <tr class="bg-gray-200 text-sm text-gray-600">
                            <th class="px-4 py-2">Action</th>
                                <th class="px-4 py-2">SL</th>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Admitted At</th>
                                <th class="px-4 py-2">Form No</th>
                                <th class="px-4 py-2">Academic Year</th>
                                <th class="px-4 py-2">Campus</th>
                                <th class="px-4 py-2">Class</th>
                                <th class="px-4 py-2">Group</th>
                                <th class="px-4 py-2">Section</th>
                                <th class="px-4 py-2">Roll</th>
                                <th class="px-4 py-2">Gender</th>
                                <th class="px-4 py-2">Serial No</th>
                                <th class="px-4 py-2">Mobile</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">DOB</th>
                                <th class="px-4 py-2">Religion</th>
                                <th class="px-4 py-2">Blood Group</th>
                                <th class="px-4 py-2">Nationality</th>
                                <th class="px-4 py-2">Birth Place</th>
                                <th class="px-4 py-2">Prev School</th>
                                <th class="px-4 py-2">Present Address</th>
                                <th class="px-4 py-2">Permanent Address</th>
                                <th class="px-4 py-2">Remarks</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2">Marks</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $key => $student)
                            <tr class="border-b text-sm">
                                <td class="px-4 py-2">
                                    <div class="flex flex-col space-y-1">
                                        <a href="{{ route('students.show', $student->id) }}" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 transition" target="_blank">
                                            Show
                                        </a>
                                        {{-- <a href="{{ route('students.show', $student->id) }}" 
                                           class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 transition">
                                            Show
                                        </a> --}}
                                        <a href="{{ route('students.edit', $student->id) }}" 
                                           class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition">
                                            Edit
                                        </a>
                                    </div>
                                </td>
                                <td class="px-4 py-2">{{ $students->firstItem() + $key }}</td>
                                <td class="px-4 py-2">{{ $student->name }}</td>
                                <td class="px-4 py-2">{{ $student->admitted_at }}</td>
                                <td class="px-4 py-2">{{ $student->form_number }}</td>
                                <td class="px-4 py-2">{{ $student->academic_year }}</td>
                                <td class="px-4 py-2">{{ $student->rel_to_campus?->name }}</td>
                                <td class="px-4 py-2">{{ $student->rel_to_class?->name }}</td>
                                <td class="px-4 py-2">{{ $student->rel_to_group?->name }}</td>
                                <td class="px-4 py-2">{{ $student->rel_to_section?->name }}</td>
                                <td class="px-4 py-2">{{ $student->roll }}</td>
                                <td class="px-4 py-2">{{ ucfirst($student->gender) }}</td>
                                <td class="px-4 py-2">{{ $student->serial_no }}</td>
                                <td class="px-4 py-2">{{ $student->mobile }}</td>
                                <td class="px-4 py-2">{{ $student->email }}</td>
                                <td class="px-4 py-2">{{ $student->dob }}</td>
                                <td class="px-4 py-2">{{ $student->rel_to_religion?->religion }}</td>
                                <td class="px-4 py-2">{{ $student->rel_to_bloodGroup?->name }}</td>
                                <td class="px-4 py-2">{{ $student->rel_to_nationality?->name }}</td>
                                <td class="px-4 py-2">{{ $student->rel_to_birthPlace?->name }}</td>
                                <td class="px-4 py-2">{{ $student->prev_school }}</td>
                                <td class="px-4 py-2">{{ $student->present_address }}</td>
                                <td class="px-4 py-2">{{ $student->permanent_address }}</td>
                                <td class="px-4 py-2">{{ $student->remarks }}</td>
                                <td class="px-4 py-2">
                                    @if ($student->status === 1)
                                        <span class="text-green-600 font-semibold">Active</span>
                                    @else
                                        <span class="text-red-600 font-semibold">Inactive</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2">{{ $student->marks }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $students->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
