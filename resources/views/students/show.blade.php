<x-app-layout>

    <!-- Example usage with actions -->
    <x-page-layout :title="'Student Details'">
        {{-- Page Title --}}
        <x-slot name="actions">
            <a href="{{ route('students.index') }}" class="text-sm text-blue-600 hover:underline">← Back to the Students</a>
            | <a href="{{ route('students.edit', $student->id) }}" class="text-sm text-blue-600 hover:underline">Edit</a>
            | <a href="{{ route('students.report', $student->id) }}" target="_blank"
                class="text-sm text-blue-600 hover:underline">PDF</a>
        </x-slot>


        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row items-center md:items-start gap-6 border-b pb-6 mb-6">
            <div class="w-36 h-36 rounded-xl overflow-hidden border">
                <img src="{{ $student->image?->url ?? asset('images/blank-profile-pic.png') }}"
                    alt="{{ $student->name }}" class="w-full h-full object-cover">
            </div>

            <div class="flex-1">
                <h1 class="text-2xl font-bold text-gray-900">{{ $student->name }}</h1>
                <p class="text-gray-600">ID: {{ $student->id_number }} | Roll: {{ $student->currentClass?->roll }}</p>
                <p class="text-gray-600">UID: {{ $student->govt_uid_number }} | Version: {{ $student->version }}</p>
                <p class="text-gray-600">Class: {{ $student->currentClass?->schoolClass?->name }} | Section:
                    {{ $student->currentClass?->section->name }}</p>
                <p class="text-gray-600">Campus: {{ $student->currentClass?->campus?->name }}</p>
                <p class="text-gray-600">Gender: {{ ucwords(str_replace('-', ' ', $student->gender)) }}  | Date of Birth: {{ $student->dob?->format('d M, Y') }}</p>
                {{-- <p class="text-gray-600"></p> --}}
            </div>
        </div>

        {{-- Contact Information --}}
        <div class="mb-6">
            <h2 class="text-lg font-semibold border-b pb-1 mb-3 text-gray-700">Contact Information</h2>
            <div class="grid sm:grid-cols-2 gap-3">
                <p><strong>Mobile:</strong> {{ $student->mobile }}</p>
                <p><strong>SMS/Whats App Number:</strong> {{ $student->sms_number }}</p>
                <p><strong>Email:</strong> {{ $student->email }}</p>
                <p><strong>Present Address:</strong> {{ $student?->presentAddress?->show() }}</p>
                <p><strong>Permanent Address:</strong> {{ $student?->permanentAddress?->show() }} </p>
            </div>
        </div>

        {{-- Academic Information --}}
        <div class="mb-6">
            <h2 class="text-lg font-semibold border-b pb-1 mb-3 text-gray-700">Academic Information</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-3">
                <p><strong>Admitted:</strong> {{ $student->admitted_at->format('d M, Y') }}</p>
                <p><strong>Academic Year:</strong> {{ $student->currentClass?->year }}</p>
                <p><strong>Group:</strong> {{ $student->currentClass?->group?->name }}</p>
                <p><strong>Status:</strong>
                    <span class="{{ $student->status === 1 ? 'text-green-600' : 'text-red-600' }} font-medium">
                        {{ $student->status === 1 ? 'Active' : 'Inactive' }}
                    </span>
                </p>
                <p><strong>Marks:</strong> {{ $student->marks }}</p>
            </div>
        </div>

        {{-- Guardians Information --}}
        <div class="mb-6">
            <h2 class="text-lg font-semibold border-b pb-1 mb-3 text-gray-700">Guardians</h2>
            <div class="grid sm:grid-cols-3 gap-6">

                {{-- Father --}}
                <div class="flex gap-4">
                    <div class="w-20 h-20 rounded-xl overflow-hidden border">
                        <img src="{{ $student->father?->image?->url ?? asset('images/blank_male.png') }}"
                            alt="Father" class="w-full h-full object-cover">
                    </div>
                    <div>

                        <p><strong>{{ $student->father?->relation->name }}:</strong>
                          @if ($student->father?->is_primary_guardian)
                                <span class="text-green-600 font-medium">(Primary Guardian)</span>
                            @endif
                        </p>

                        <p><strong>Name:</strong> {{ $student->father?->name }}</p>

                        <p><strong>Occupation:</strong> {{ $student->father?->occupation?->name }}</p>
                        <p><strong>Mobile:</strong> {{ $student->father?->mobile }}</p>
                    </div>
                </div>

                {{-- Mother --}}
                <div class="flex gap-4">
                    <div class="w-20 h-20 rounded-xl overflow-hidden border">
                        <img src="{{ $student->mother?->image?->url ?? asset('images/blank_female.png') }}"
                            alt="Mother" class="w-full h-full object-cover">
                    </div>
                    <div>

                          <p><strong>{{ $student->mother?->relation->name }}:</strong>
                          @if ($student->mother?->is_primary_guardian)
                                <span class="text-green-600 font-medium">(Primary Guardian)</span>
                            @endif
                        </p>

                        <p><strong>Name:</strong> {{ $student->mother?->name }}</p>
                                                 <p><strong>Occupation:</strong> {{ $student->mother?->occupation?->name }}</p>
                        <p><strong>Mobile:</strong> {{ $student->mother?->mobile }}</p>
                    </div>
                </div>

                  {{-- Guardian --}}
                <div class="flex gap-4">
                    <div class="w-20 h-20 rounded-xl overflow-hidden border">
                        <img src="{{ $student->guardian?->image?->url ?? asset('images/blank_female.png') }}"
                            alt="Mother" class="w-full h-full object-cover">
                    </div>
                    <div>

                          <p><strong>{{ $student->guardian?->relation->name }}:</strong>
                          @if ($student->guardian?->is_primary_guardian)
                                <span class="text-green-600 font-medium">(Primary Guardian)</span>
                            @endif
                        </p>

                        <p><strong>Name:</strong> {{ $student->guardian?->name }}</p>

                        <p><strong>Occupation:</strong> {{ $student->guardian?->occupation?->name }}</p>
                        <p><strong>Mobile:</strong> {{ $student->guardian?->mobile }}</p>
                    </div>
                </div>

            </div>
        </div>


        {{-- Classes --}}
        <div class="mb-6">
            <h2 class="text-lg font-semibold border-b pb-1 mb-3 text-gray-700">Classes</h2>


            @php
                // dd($student->studentClasses)
            @endphp

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                    <thead>
                        <tr class="bg-gray-100 text-left text-sm text-gray-700">
                            <th class="px-4 py-2 border-b">Class</th>
                            <th class="px-4 py-2 border-b">Group</th>
                            <th class="px-4 py-2 border-b">Section</th>
                            <th class="px-4 py-2 border-b">Campus</th>
                            <th class="px-4 py-2 border-b">Admitted At</th>
                            <th class="px-4 py-2 border-b">Year</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($student->studentClasses as $studentClass)
                            <tr class="text-sm text-gray-800">
                                <td class="px-4 py-2 border-b">{{ $studentClass->schoolClass->name ?? '-' }}</td>
                                <td class="px-4 py-2 border-b">{{ $studentClass->group?->name ?? '-' }}</td>
                                <td class="px-4 py-2 border-b">{{ $studentClass->section?->name ?? '-' }}</td>
                                <td class="px-4 py-2 border-b">{{ $studentClass->campus?->name ?? '-' }}</td>
                                <td class="px-4 py-2 border-b">{{ $studentClass->created_at ?? '-' }}</td>
                                <td class="px-4 py-2 border-b">{{ $studentClass->year ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Characteristics --}}
        @if ($student->characteristics && $student->characteristics->count())
            <div class="mb-6">
                <h2 class="text-lg font-semibold border-b pb-1 mb-3 text-gray-700">Characteristics</h2>
                <div class="flex flex-wrap gap-2">
                    @foreach ($student->characteristics as $characteristic)
                        <span class="inline-flex items-center bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-xs">
                            <svg class="w-3 h-3 mr-1 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414L9 14.414 5.293 10.707a1 1 0 011.414-1.414L9 11.586l6.293-6.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $characteristic->name }}
                        </span>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Additional Information --}}
        <div class="mb-6">
            <h2 class="text-lg font-semibold border-b pb-1 mb-3 text-gray-700">Additional Details</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-3">
                <p><strong>Religion:</strong> {{ $student->religion?->name }}</p>
                <p><strong>Blood Group:</strong> {{ $student->bloodGroup?->name }}</p>
                <p><strong>Nationality:</strong> {{ $student->nationality?->name }}</p>
                <p><strong>Birth Place:</strong> {{ $student->district?->name }}</p>
                <p><strong>Previous School:</strong> {{ $student->prev_school }}</p>
                <p class="col-span-full"><strong>Remarks:</strong> {{ $student->remarks }}</p>
            </div>
        </div>

        {{-- Action Buttons --}}
        {{-- <div class="mt-6 flex gap-3">
        <a href="{{ route('students.edit', $student->id) }}"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Edit</a>
        <a href="{{ route('students.report', $student->id) }}" target="_blank"
            class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">PDF</a>
    </div> --}}

        </x-page-show-layout>
</x-app-layout>
