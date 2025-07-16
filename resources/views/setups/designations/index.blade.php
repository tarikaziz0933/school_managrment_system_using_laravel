<x-app-layout>
    <x-page-layout title="Designation List">

        <x-slot name="actions">
            <a href="{{ route('designations.create') }}"
                class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                Create
            </a>
        </x-slot>
        <div class="max-w-7xl mx-auto px-4 ">
            <div class="w-full">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <!-- Header Section -->
                    {{-- <div class="flex justify-between items-center border-b pb-4 mb-4">
                    <h3 class="text-2xl font-semibold text-gray-800">Designation List</h3>
                    <a href="{{ route('designations.create') }}"
                       class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        + Create
                    </a>
                </div> --}}

                    <!-- Pagination -->
                    {{ $designations->links() }}

                    <!-- Table -->
                    <div class="overflow-x-auto mt-4">
                        <table class="min-w-full table-auto border-collapse border border-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-3 text-center text-sm font-medium text-gray-700">SL</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Designation Name
                                    </th>
                                    <th class="px-4 py-3 text-center text-sm font-medium text-gray-700">Status</th>
                                    <th class="px-4 py-3 text-center text-sm font-medium text-gray-700">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($designations as $key => $designation)
                                    <tr>

                                        <td class="px-4 py-3 text-center text-sm">{{ $key + 1 }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $designation->name }}</td>
                                        <td class="px-4 py-3 text-center">
                                            <span
                                                class="font-semibold {{ $designation->status ? 'text-green-600' : 'text-red-600' }}">
                                                {{ $designation->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <a href="{{ route('designations.edit', $designation->id) }}"
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
                        {{ $designations->links() }}
                    </div>

                </div>
            </div>
        </div>
    </x-page-layout>
</x-app-layout>
