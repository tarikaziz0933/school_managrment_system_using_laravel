<x-app-layout>
    <div class="mt-10 bg-white p-10 rounded-lg shadow-lg max-w-5xl mx-auto text-sm leading-relaxed text-gray-800 font-sans">

        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row items-center md:items-start gap-6 border-b pb-6 mb-6">
            <div class="w-36 h-36 rounded-xl overflow-hidden border">
                <img src="{{ $employee->image?->url ?? asset('images/blank-profile-pic.png') }}"
                     alt="{{ $employee->name }}"
                     class="w-full h-full object-cover">
            </div>

            <div class="flex-1">
                <h1 class="text-2xl font-bold text-gray-900">{{ $employee->name }}</h1>
                <p class="text-gray-600">ID: {{ $employee->id_number }}</p>
                <p class="text-gray-600">Campus: {{ $employee->campus?->name }}</p>
                <p class="text-gray-600">Date of Birth: {{ $employee->dob?->format('d M, Y') }}</p>
            </div>
        </div>

        {{-- Contact Information --}}
        <div class="mb-6">
            <h2 class="text-lg font-semibold border-b pb-1 mb-3 text-gray-700">Contact Information</h2>
            <div class="grid sm:grid-cols-2 gap-3">
                <p><strong>Mobile:</strong> {{ $employee->mobile }}</p>
                <p><strong>Email:</strong> {{ $employee->email }}</p>
                <p><strong>Present Address:</strong> {{ $employee->present_address }}</p>
                <p><strong>Permanent Address:</strong> {{ $employee->permanent_address }}</p>
            </div>
        </div>

        {{-- Academic Information --}}
        <div class="mb-6">
            <h2 class="text-lg font-semibold border-b pb-1 mb-3 text-gray-700">Academic Information</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-3">
                <p><strong>Admitted:</strong> {{ $employee->admitted_at->format('d M, Y') }}</p>
                <p><strong>Academic Year:</strong> {{ $employee->academic_year }}</p>
                <p><strong>Group:</strong> {{ $employee->group?->name }}</p>
                <p><strong>Status:</strong>
                    <span class="{{ $employee->status === 1 ? 'text-green-600' : 'text-red-600' }} font-medium">
                        {{ $employee->status === 1 ? 'Active' : 'Inactive' }}
                    </span>
                </p>
                <p><strong>Marks:</strong> {{ $employee->marks }}</p>
            </div>
        </div>

        {{-- Parent Information --}}
        <div class="mb-6">
            <h2 class="text-lg font-semibold border-b pb-1 mb-3 text-gray-700">Parents</h2>
            <div class="grid sm:grid-cols-2 gap-6">

                {{-- Father --}}
                <div class="flex gap-4">
                    <div class="w-20 h-20 rounded-xl overflow-hidden border">
                        <img src="{{ $employee->father?->image?->url ?? asset('images/blank_male.png') }}"
                             alt="Father" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <p><strong>Name:</strong> {{ $employee->father?->name }}</p>
                        <p><strong>Occupation:</strong> {{ $employee->father?->occupation->name }}</p>
                        <p><strong>Mobile:</strong> {{ $employee->father?->mobile }}</p>
                    </div>
                </div>

                {{-- Mother --}}
                <div class="flex gap-4">
                    <div class="w-20 h-20 rounded-xl overflow-hidden border">
                        <img src="{{ $employee->mother?->image?->url ?? asset('images/blank_female.png') }}"
                             alt="Mother" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <p><strong>Name:</strong> {{ $employee->mother?->name }}</p>
                        <p><strong>Occupation:</strong> {{ $employee->mother?->occupation->name }}</p>
                        <p><strong>Mobile:</strong> {{ $employee->mother?->mobile }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Characteristics --}}
        @if ($employee->characteristics && $employee->characteristics->count())
            <div class="mb-6">
                <h2 class="text-lg font-semibold border-b pb-1 mb-3 text-gray-700">Characteristics</h2>
                <div class="flex flex-wrap gap-2">
                    @foreach ($employee->characteristics as $characteristic)
                        <span class="inline-flex items-center bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-xs">
                            <svg class="w-3 h-3 mr-1 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414L9 14.414 5.293 10.707a1 1 0 011.414-1.414L9 11.586l6.293-6.293a1 1 0 011.414 0z" clip-rule="evenodd" />
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
                <p><strong>Religion:</strong> {{ $employee->religion?->name }}</p>
                <p><strong>Blood Group:</strong> {{ $employee->bloodGroup?->name }}</p>
                <p><strong>Nationality:</strong> {{ $employee->nationality?->name }}</p>
                <p><strong>Birth Place:</strong> {{ $employee->district?->name }}</p>
                <p><strong>Previous School:</strong> {{ $employee->prev_school }}</p>
                <p class="col-span-full"><strong>Remarks:</strong> {{ $employee->remarks }}</p>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="mt-6 flex gap-3">
            <a href="{{ route('employees.edit', $employee->id) }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Edit</a>
            <a href="{{ route('students.report', $employee->id) }}" target="_blank"
               class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-800 transition">Download PDF</a>
        </div>
    </div>
</x-app-layout>
