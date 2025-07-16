<x-app-layout>
    <x-page-layout title="Student Scholarship">

        <x-slot name="actions">
            <a href="{{ route('scholarships.create') }}"
                class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                Create
            </a>
        </x-slot>
        <div class="  py-8">
            <div class="w-full">

                <!-- Main Content -->
                <div class="bg-white shadow-md rounded-lg p-6">

                    <!-- Success Alert -->
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 border border-green-300 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto border-collapse border border-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Col. No</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">ID No</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Name</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Total Amount</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Scholarship</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">PAyable</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Action</th>
                                </tr>
                            </thead>
                            {{-- <tbody class="divide-y divide-gray-200">
                                @foreach ($studentsTransportAssigns as $key => $studentsTransport)
                                    <tr>

                                        <td class="px-4 py-3 text-sm">{{ $studentsTransport->serial_no }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $studentsTransport->student->id_number }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $studentsTransport->student->name }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $studentsTransport->rootDivide->vehicle_name }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">{{ $studentsTransport->rootDivide->fees_amount }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ \Carbon\Carbon::create()->month(intval($studentsTransport->applicable_month))->format('F') }}
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <a href="{{ route('students-transport-assigns.edit', $studentsTransport->id) }}"
                                                class="inline-block bg-blue-600 text-white hover:bg-blue-700 font-medium px-4 py-1 rounded transition">
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody> --}}
                        </table>
                    </div>

                    <!-- Pagination -->
                    {{-- <div class="mt-4">
                        {{ $studentsTransportAssigns->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
    </x-page-layout>
</x-app-layout>
