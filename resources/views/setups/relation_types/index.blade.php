<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="w-full">
            <div class="bg-white shadow-xl rounded-2xl p-6">

                <!-- Header -->
                <div class="flex items-center justify-between border-b pb-4 mb-6">
                    <h3 class="text-2xl font-semibold text-gray-800">Relation Types List</h3>
                    <a href="{{ route('relation-types.create') }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded shadow">
                        + Create
                    </a>
                </div>

                <!-- Pagination (top) -->
                <div class="mb-4">
                    {{ $relations->links('pagination::tailwind') }}
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">SL</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Relation Name</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($relations as $key => $relation)
                                <tr class="hover:bg-gray-50">

                                    <td class="px-4 py-3 text-sm text-gray-800">{{ $key + $relations->firstItem() }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-800">{{ $relation->name }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <a href="{{ route('relation-types.edit', $relation->slug) }}"
                                            class="inline-block bg-blue-600 text-white hover:bg-blue-700 font-medium px-4 py-1 rounded transition">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination (bottom) -->
                <div class="mt-6">
                    {{ $relations->links('pagination::tailwind') }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
