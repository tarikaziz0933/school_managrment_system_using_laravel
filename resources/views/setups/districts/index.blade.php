<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-10">
        <div class="bg-white shadow-xl rounded-2xl p-6">
            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                @if (session('success'))
                    <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4 text-lg">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">
                        <strong class="block">Whoops! Something went wrong.</strong>
                        <ul class="mt-2 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h2 class="text-2xl font-semibold text-gray-800">District List</h2>
                <a href="{{ route('districts.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg shadow-sm transition">
                    + Create
                </a>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="min-w-full bg-white text-sm text-left">
                    <thead class="bg-gray-100 text-gray-700 font-semibold">
                        <tr>
                            <th class="px-4 py-3">SL</th>
                            <th class="px-4 py-3">District</th>
                            {{-- <th class="px-4 py-3 text-right">Action</th> --}}
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-gray-800">
                        @forelse ($districts as $key => $district)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $key + $districts->firstItem() }}</td>
                                <td class="px-4 py-3">{{ $district->name }}</td>
                                {{-- <td class="px-4 py-3 text-right">
                                    <a href="{{ route('districts.edit', $district->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                </td> --}}
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-6 text-center text-gray-500">No districts found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $districts->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</x-app-layout>
