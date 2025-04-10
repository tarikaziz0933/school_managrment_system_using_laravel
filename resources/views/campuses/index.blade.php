<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-6">

            <!-- Branch List -->
            <div class="w-full">
                <div class="bg-white shadow rounded-xl p-6">
                    <h3 class="text-xl font-semibold mb-4">Campus List</h3>
                    <a href="{{route('campuses.create')}}">Create</a>
                    {{ $campuses->links() }}
                    <table class="w-full min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="text-left text-sm font-medium text-gray-700 px-4 py-2">SL</th>
                                <th class="text-left text-sm font-medium text-gray-700 px-4 py-2">Campus Name</th>
                                <th class="text-left text-sm font-medium text-gray-700 px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($campuses as $key => $campus)
                                <tr>
                                    <td class="px-4 py-2 text-sm text-gray-800">{{ $key + 1 }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-800">{{ $campus->name }}</td>
                                    <td class="px-4 py-2">
                                        <a href="#" class="bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                                            Delete
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
</x-app-layout>
