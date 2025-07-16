<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-6">

            <!-- Occupations List -->
            <div class="w-full">
                <div class="bg-white shadow-xl rounded-2xl p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-2xl font-semibold text-gray-800">Occupations List</h3>
                        <a href="{{ route('occupations.create') }}"
                           class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded shadow">
                            + Create
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="text-center text-sm font-semibold text-gray-700 px-4 py-3">SL</th>
                                    <th class="text-left text-sm font-semibold text-gray-700 px-4 py-3">Occupation</th>
                                    <th class="text-left text-sm font-semibold text-gray-700 px-4 py-3">Status</th>
                                    <th class="text-center text-sm font-semibold text-gray-700 px-4 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($occupations as $key => $occupation)
                                    <tr class="hover:bg-gray-50">

                                        <td class="text-center px-4 py-3 text-sm text-gray-800">
                                            {{ $key + $occupations->firstItem() }}
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-800">{{ $occupation->name }}</td>
                                        <td class="px-4 py-3 text-left">
                                            <span class="font-semibold {{ $occupation->status ? 'text-green-600' : 'text-red-600' }}">
                                                {{ $occupation->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <a href="{{ route('occupations.edit', $occupation->id) }}"
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
                    <div class="mt-6">
                        {{ $occupations->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
