<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-10">
        <div class="bg-white shadow-xl rounded-2xl p-6">
            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">Religion List</h2>
                <a href="{{ route('religions.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg shadow transition">
                    + Create
                </a>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto border border-gray-200 rounded-lg">
                <table class="min-w-full bg-white text-sm text-left">
                    <thead class="bg-gray-50 text-gray-700 font-semibold">
                        <tr>
                            <th class="px-4 py-3 text-center">SL</th>
                            <th class="px-4 py-3">Religion Name</th>
                            <th class="px-4 py-3 text-center">Status</th>
                            <th class="px-4 py-3 text-center">Action</th>
                            {{-- <th class="px-4 py-3 text-right">Action</th> --}}
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-gray-800">
                        @foreach ($religions as $key => $religion)
                            <tr class="hover:bg-gray-50">

                                <td class="text-center px-4 py-3">{{ $key + 1 }}</td>
                                <td class="px-4 py-3">{{ $religion->name }}</td>
                                <td class="px-4 py-3 text-center">
                                    <span class="font-semibold {{ $religion->status ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $religion->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <a href="{{ route('religions.edit', $religion->id) }}"
                                        class="inline-block bg-blue-600 text-white hover:bg-blue-700 font-medium px-4 py-1 rounded transition">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        @if ($religions->isEmpty())
                            <tr>
                                <td colspan="3" class="px-4 py-6 text-center text-gray-500">No religions found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{-- {{ $religions->links('pagination::tailwind') }} --}}
            </div>
        </div>
    </div>
</x-app-layout>
