<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-6">

            <!-- Permissions -->
            <div class="w-full">
                <div class="bg-white shadow-xl rounded-2xl p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-2xl font-semibold text-gray-800">Permissions</h3>
                        {{-- <a href="{{ route('permissions.create') }}"
                           class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded shadow">
                            + Create
                        </a> --}}
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="text-left text-sm font-semibold text-gray-700 px-4 py-3">Name</th>
                                    <th class="text-left text-sm font-semibold text-gray-700 px-4 py-3">Display Name</th>
                                    <th class="text-left text-sm font-semibold text-gray-700 px-4 py-3">Description</th>
                                    {{-- <th class="text-left text-sm font-semibold text-gray-700 px-4 py-3">Action</th> --}}
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($permissions as $key => $permission)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 text-sm text-gray-800">{{ $permission->name }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-800">{{ $permission->display_name }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-800">{{ $permission->description }}</td>
                                        {{-- <td class="px-4 py-3 text-center">
                                            <a href="#"
                                               class="inline-block w-24 px-3 py-1 text-white rounded {{ $permission->status ? 'bg-green-600' : 'bg-gray-500' }}">
                                                {{ $campus->status ? 'Active' : 'Inactive' }}
                                            </a>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $permissions->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
