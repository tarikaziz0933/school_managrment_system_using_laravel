<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="bg-white shadow-lg rounded-lg p-6">

            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-semibold text-gray-800">Campus List</h3>
                <a href="{{ route('campuses.create') }}"
                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded shadow-md">
                    + Create
                </a>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto border border-gray-200 rounded-lg">
                <table class="min-w-full bg-white text-sm text-left">
                    <thead class="bg-gray-50">
                        <tr class="text-gray-700 font-medium">
                            <th class="px-4 py-3 text-center">SL</th>
                            <th class="px-4 py-3">Campus Name</th>
                            <th class="px-4 py-3 text-center">Status</th>
                            <th class="px-4 py-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($campuses as $key => $campus)
                            <tr class="hover:bg-gray-50">

                                <td class="px-4 py-3 text-center">{{ $key + 1 }}</td>
                                <td class="px-4 py-3">{{ $campus->name }}</td>
                                <td class="px-4 py-3 text-center">
                                    <span class="font-semibold {{ $campus->status ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $campus->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <a href="{{ route('campuses.edit', $campus->id) }}"
                                        class="inline-block bg-blue-600 text-white hover:bg-blue-700 font-medium px-4 py-1 rounded transition">
                                        Edit
                                    </a>
                                </td>

                            </tr>
                        @endforeach
                        @if ($campuses->isEmpty())
                            <tr>
                                <td colspan="3" class="px-4 py-3 text-center text-gray-500">No campuses available.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $campuses->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</x-app-layout>
