<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="w-full">
            <div>
                <div class="bg-white shadow-md rounded-lg p-4">
                    <div class="border-b pb-2 mb-4">
                        <h3 class="text-xl font-semibold"><span>Group</span> List</h3>
                        <a href="{{route('groups.create')}}">Create</a>
                    </div>
                    <div class="overflow-x-auto">
                        {{ $groups->links() }}
                        <table class="w-full border-collapse border border-gray-200">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border p-2">SL</th>
                                    <th class="border p-2"><span>Class</span> Name</th>
                                    <th class="border p-2">Status</th>
                                    <th class="border p-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($groups as $key => $group)
                                    <tr class="border">
                                        <td class="border p-2 text-center">{{ $key+1 }}</td>
                                        <td class="border p-2">{{ $group->name }}</td>
                                        <td class="border p-2 text-center">
                                            {{ $group->status == 0 ? 'Inactive' : 'Active' }}
                                        </td>
                                        <td class="border p-2 text-center">
                                            <a href="#" class="px-3 py-1 bg-red-600 text-white rounded">Delete</a>
                                        </td>
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
