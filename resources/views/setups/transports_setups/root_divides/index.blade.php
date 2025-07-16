<x-app-layout>
    <x-page-layout :title="'Root and Transport Name'">

        <x-slot name="actions">
            <a href="{{ route('root-divides.create') }}"
                class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                + Create
            </a>
        </x-slot>
        <div class=" mx-auto px-4">
            <div class="w-full">

                <!-- Main Content -->
                <div class="bg-white shadow-md rounded-lg">

                    <!-- Success Alert -->
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 border border-green-300 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Header Section -->
                    {{-- <div class="flex justify-between items-center border-b pb-4 mb-4">
                        <h3 class="text-2xl font-semibold text-gray-800">Root and Transport Name</h3>
                        <a href="{{ route('root-divides.create') }}"
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
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Root Code</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Vehicle Name</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Vehicle No</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">From</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">To</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Fees Amount</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Driver Name</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Contact</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Status</th>
                                    <th class="px-4 py-3 text-center text-sm font-medium text-gray-700">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($root_divides as $key => $root)
                                    <tr>

                                        {{-- <td class="px-4 py-3 text-center text-sm">{{ $key + 1 }}</td> --}}
                                        <td class="px-4 py-3 text-sm">{{ $key+1 }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $root->root_code }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $root->vehicle_name }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $root->vehicle_no }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $root->from }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $root->to }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $root->fees_amount }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $root->driver_name }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $root->contact_no }}</td>
                                        <td class="px-4 py-3 text-left">
                                            <span
                                                class="font-semibold {{ $root->status ? 'text-green-600' : 'text-red-600' }}">
                                                {{ $root->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <a href="{{ route('root-divides.edit', $root->id) }}"
                                                class="inline-block bg-blue-600 text-white hover:bg-blue-700 font-medium px-4 py-1 rounded transition">
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $root_divides->links() }}
                    </div>
                </div>
            </div>
        </div>
    </x-page-layout>
</x-app-layout>
