<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="w-full">
            <div class="lg:col-span-2">
                <div class="bg-white shadow-md rounded-lg p-4">
                    <div class="border-b pb-2 mb-4">
                        <h3 class="text-xl font-semibold"><span>Designations</span> List</h3>
                        <a href="{{route('designations.create')}}">Create</a>
                    </div>

                    {{ $designations->links() }}

                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-200">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border p-2">SL</th>
                                    <th class="border p-2"><span>Designation</span> Name</th>
                                    <th class="border p-2">Status</th>
                                    <th class="border p-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($designations as $key => $designation)
                                {{--  <@php
                                print_r($class);
                                die();

                                @endphp  --}}
                                    <tr class="border">
                                        <td class="border p-2 text-center">{{ $key+1 }}</td>
                                        <td class="border p-2">{{ $designation->name }}</td>
                                        <td class="border p-2 text-center">
                                                {{ $designation->status == 0 ? 'Inactive' : 'Active' }}
                                        </td>
                                        <td class="border p-2 text-center">
                                            <a href="#" class="px-3 py-1 bg-red-600 text-white rounded">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $designations->links() }}

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
