<x-app-layout>

    <!-- Example usage with actions -->
    <x-page-layout :title="'Employee Details'">
        <x-slot name="actions">
            <a href="{{ route('employees.index') }}" class="text-sm text-blue-600 hover:underline">← Back</a>
            | <a href="{{ route('employees.edit', $employee->id) }}"
                class="text-sm text-blue-600 hover:underline">Edit</a>
            | <a href="{{ route('employees.report', $employee->id) }}" target="_blank"
                class="text-sm text-blue-600 hover:underline">PDF</a>
        </x-slot>

        {{-- Header --}}
        <div class="flex flex-col md:flex-row items-start gap-6 border-b pb-6">
            <div class="w-36 h-36 rounded-xl overflow-hidden border bg-gray-100">
                <img src="{{ $employee->image?->url ?? asset('images/blank-profile-pic.png') }}"
                    alt="{{ $employee->name }}" class="w-full h-full object-cover">
            </div>
            <div class="grid md:grid-cols-2 gap-4 flex-1">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $employee->name }}</h1>
                    <p><strong>ID:</strong> {{ $employee->id_number }}</p>
                    <p><strong>Designation:</strong> {{ $employee->designation?->name }}</p>
                    <p><strong>Campus:</strong> {{ $employee->campus?->name }}</p>
                    <p><strong>Type:</strong> {{ ucfirst($employee->type) }}</p>
                </div>
                <div>
                    <p><strong>Status:</strong> {{ $employee->status ? 'Active' : 'Inactive' }}</p>
                    <p><strong>Salary:</strong> {{ number_format($employee->salary, 2) }}</p>
                    <p><strong>Date of Birth:</strong> {{ $employee->dob?->format('d M, Y') }}</p>
                    <p><strong>Joined:</strong> {{ $employee->joined_at?->format('d M, Y') }}</p>
                    <p><strong>Entry Date:</strong> {{ $employee->entry_date?->format('d M, Y') }}</p>
                </div>
            </div>
        </div>

        {{-- Section Component --}}
        @php
            $section = fn($title, $content) => "
            <div>
                <h2 class='text-lg font-semibold border-b pb-2 mb-4 text-gray-700'>$title</h2>
                $content
            </div>
        ";
        @endphp

        {{-- Personal Info --}}
        {!! $section(
            'Personal Information',
            "<div class='grid sm:grid-cols-2 lg:grid-cols-3 gap-4'><p><strong>Gender:</strong> " .
                ucfirst($employee->gender) .
                '</p><p><strong>Marital Status:</strong> ' .
                ucfirst(str_replace('_', ' ', $employee->marital_status)) .
                '</p><p><strong>Religion:</strong> ' .
                $employee->religion?->name .
                "</p>
                        <p><strong>Blood Group:</strong> " .
                $employee->bloodGroup?->name .
                "</p>
                        <p><strong>Nationality:</strong> " .
                $employee->nationality?->name .
                "</p>
                        <p><strong>NID No:</strong> " .
                $employee->NID_BRN_no .
                "</p>
                        <p><strong>NTRCA_reg_number:</strong> " .
                $employee->NTRCA_reg_number .
                "</p>
                        <p><strong>Computer Knowledge:</strong> " .
                $employee->computer_knowledge .
                "</p>
                    </div>",
        ) !!}

        {{-- Family Info --}}
        {!! $section(
            'Family Information',
            "
                     <div class='grid sm:grid-cols-2 lg:grid-cols-3 gap-4'>
                        <p><strong>Father's Name:</strong> " .
                $employee->father_name .
                "</p>
                        <p><strong>Mother's Name:</strong> " .
                $employee->mother_name .
                "</p>
                        " .
                ($employee->marital_status != 'un_married'
                    ? "
                                <p><strong>Spouse Name:</strong> " .
                        $employee->spouse_name .
                        "</p>
                                <p><strong>Spouse Phone:</strong> " .
                        $employee->spouse_mobile .
                        "</p>
                                <p><strong>No of Children:</strong> " .
                        $employee->no_of_child .
                        "</p>
                        "
                    : '') .
                "
                    </div>
                    ",
        ) !!}

        {{-- Contact Info --}}
        {!! $section(
            'Contact Information',
            "
                        <div class='grid sm:grid-cols-2 gap-4'>
                            <p><strong>Mobile:</strong> " .
                $employee->mobile .
                "</p>
                            <p><strong>Email:</strong> " .
                $employee->email .
                "</p>
                            <p><strong>Present Address:</strong> " .
                $employee->presentAddress?->show() .
                "</p>
                            <p><strong>Permanent Address:</strong> " .
                $employee->permanentAddress?->show() .
                "</p>
                        </div>
                        ",
        ) !!}

        {{-- Professional Info --}}
        {!! $section(
            'Professional Information',
            "
                        <div class='grid sm:grid-cols-2 lg:grid-cols-3 gap-4'>
                            <p><strong>Experience:</strong> " .
                $employee->experience .
                "</p>
                            <p><strong>Reference:</strong> " .
                $employee->reference .
                "</p>
                        </div>
                         ",
        ) !!}

        {{-- Education Table --}}
        <div>
            <h2 class="text-lg font-semibold border-b pb-2 mb-4 text-gray-700">Education</h2>
            <div class="overflow-x-auto rounded-xl border shadow-sm">
                <table class="min-w-full divide-y divide-gray-200 bg-white text-sm">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="text-left px-4 py-2">Exam</th>
                            <th class="text-left px-4 py-2">Subject/Group</th>
                            <th class="text-left px-4 py-2">Board/University</th>
                            <th class="text-left px-4 py-2">Passing Year</th>
                            <th class="text-left px-4 py-2">Result</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($employee->educations as $edu)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $edu?->exam?->name }}</td>
                                <td class="px-4 py-2">{{ $edu?->group?->name }}</td>
                                <td class="px-4 py-2">{{ $edu?->educationBoard?->name }}</td>
                                <td class="px-4 py-2">{{ $edu?->passing_year }}</td>
                                <td class="px-4 py-2">{{ $edu?->result }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Characteristics --}}
        @if ($employee->characteristics && $employee->characteristics->count())
            {!! $section(
                'Characteristics',
                '
                            <div class="flex flex-wrap gap-2">
                                ' .
                    collect($employee->characteristics)->map(
                            fn($c) => "
                                <span class='inline-flex items-center bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-medium'>
                                    <svg class='w-3 h-3 mr-1 text-green-600' fill='currentColor' viewBox='0 0 20 20'>
                                        <path fill-rule='evenodd' d='M16.707 5.293a1 1 0 010 1.414L9 14.414 5.293 10.707a1 1 0 011.414-1.414L9 11.586l6.293-6.293a1 1 0 011.414 0z' clip-rule='evenodd' />
                                        </svg>
                                            {$c->name}
                                </span>
                                ",
                        )->implode('') .
                    '
                            </div>
                            ',
            ) !!}
        @endif

        {{-- Action Buttons --}}
        {{-- <div class="flex gap-4 pt-6 border-t">
            <a href="{{ route('employees.edit', $employee->id) }}"
                class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">Edit</a>
            <a href="{{ route('employees.report', $employee->id) }}" target="_blank"
                class="bg-red-600 text-white px-5 py-2 rounded-lg hover:bg-red-700 transition">PDF</a>
        </div> --}}


        </x-page-show-layout>


</x-app-layout>
