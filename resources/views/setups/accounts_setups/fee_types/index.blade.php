<x-app-layout>
    <x-page-layout :title="'Fees Name List'">

        <x-slot name="actions">
            <a href="{{ route('fee-types.create') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                + Create
            </a>
        </x-slot>
        <div class="mx-auto px-4">
            <div class="w-full">

                <!-- Main Content -->
                <div class="bg-white shadow-md rounded-lg p-6">

                    <!-- Success Alert -->
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 border border-green-300 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Header Section -->
                    {{-- <div class="flex justify-between items-center border-b pb-4 mb-4">
                        <h3 class="text-2xl font-semibold text-gray-800">Fees Name List</h3>
                        <a href="{{ route('fee-types.create') }}"
                            class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            + Create
                        </a>
                    </div> --}}

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto border-collapse border border-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-3 text-center text-sm font-medium text-gray-700">SL</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Fees Code</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Fees Name</th>

                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Payment Frequency</th>
                                    <th class="px-4 py-3 text-center text-sm font-medium text-gray-700">Status</th>
                                    <th class="px-4 py-3 text-center text-sm font-medium text-gray-700">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($feeTypes as $key => $feeType)
                                    <tr>

                                        <td class="px-4 py-3 text-center text-sm">{{ $key + 1 }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $feeType->code }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $feeType->name }}</td>

                                        <td class="px-4 py-3 text-sm">{{  $feeType->paymentFrequencyType->display_name}}</td>
                                        <td class="px-4 py-3 text-center">
                                            <span
                                                class="font-semibold {{ $feeType->status ? 'text-green-600' : 'text-red-600' }}">
                                                {{ $feeType->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <a href="{{ route('fee-types.edit', $feeType->id) }}"
                                                class="inline-block bg-blue-600 text-white hover:bg-blue-700 font-medium px-4 py-1 rounded transition">
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>

            </div>
        </div>
    </x-page-layout>
</x-app-layout>
