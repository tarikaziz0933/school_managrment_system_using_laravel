<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-6">
            <div class="w-full">
                <div class="bg-white shadow-md rounded-lg p-4">
                    <div class="border-b pb-2 mb-4">
                        <h3 class="text-xl font-semibold"><span>Section</span> List</h3>

                        <a href="{{route('sections.create')}}">Create</a>
                    </div>
                    <div class="overflow-x-auto">
                        {{ $sections->links() }}
                        <table class="w-full border-collapse border border-gray-200">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border p-2">Action</th>
                                    <th class="border p-2">SL</th>
                                    <th class="border p-2">Name</th>
                                    <th class="border p-2">Class</th>
                                    <th class="border p-2">Boys/Girls</th>
                                    <th class="border p-2">Campus</th>
                                    <th class="border p-2">Status</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sections as $key => $section)
                                    <tr class="border">
                                        <td class="border p-2 text-center">
                                            <a href="#" class="px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 text-white rounded">Edit</a>
                                            {{-- | <a href="#" class="px-3 py-1 bg-red-600 text-white rounded">Delete</a> --}}
                                        </td>
                                        <td class="border p-2 text-center">{{ $key+1 }}</td>
                                        <td class="border p-2">{{ $section->name }}</td>
                                        <td class="border p-2">{{ $section->studentClass?->name }}</td>
                                        <td class="border p-2">{{ $section->gender }}</td>
                                        <td class="border p-2">{{ $section->Campus?->name }}</td>
                                        <td class="border p-2 text-center">
                                            {{ $section->status == 0 ? 'Inactive' : 'Active' }}
                                        </td>
                                      
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $sections->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
