<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-6">

            <!-- Blood Group List -->
            <div class="w-full">
                <div class="bg-white shadow-xl rounded-2xl p-6">
                    @if (session('success'))
                        <div class="mb-4 text-green-700 bg-green-100 border border-green-300 rounded p-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-4 text-red-700 bg-red-100 border border-red-300 rounded p-4">
                            <strong class="block mb-2">Whoops! Something went wrong.</strong>
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-2xl font-semibold text-gray-800">Blood Group List</h3>
                        <a href="{{ route('blood_groups.create') }}"
                           class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded shadow">
                            + Create
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="text-left text-sm font-semibold text-gray-700 px-4 py-3">SL</th>
                                    <th class="text-left text-sm font-semibold text-gray-700 px-4 py-3">Blood Group</th>
                                    <th class="text-left text-sm font-semibold text-gray-700 px-4 py-3">Description</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($bloodGroups as $key => $bloodGroup)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 text-sm text-gray-800">{{ $key + 1 }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-800">{{ $bloodGroup->name }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-800">{{ $bloodGroup->description }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
