<x-app-layout>

    {{-- <x-page-layout> --}}

    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-semibold text-gray-800">Section List</h3>
                <a href="{{ route('sections.create') }}"
                    class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded shadow-md">
                    + Create
                </a>
            </div>


            {{-- Previous Data: div --}}
            <div class="bg-white shadow rounded-xl p-6">
                {{-- <h3 class="text-xl font-semibold mb-4 text-gray-700">&nbsp;</h3> --}}

                <form action="{{ route('sections.index') }}" method="GET">
                    @csrf

                    <div class="flex flex-wrap gap-4">

                        {{-- Campus --}}
                        <div class="flex-1">
                            <x-form.select name="campus_id" label="Campus" :options="$campuses->map(fn($name, $id) => ['id' => $id, 'name' => $name])" :selected="request('campus_id')" />
                        </div>


                        {{-- Class --}}
                        <div class="flex-1">
                            <x-form.select name="class_id" label="Class" :options="$classes->map(fn($name, $id) => ['id' => $id, 'name' => $name])" :selected="request('class_id')" />
                        </div>


                        {{-- Submit Button --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">&nbsp;</label>
                            <button type="submit"
                                class="w-24 bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg mt-1">
                                Search
                            </button>
                        </div>

                    </div>
                </form>
            </div>


            <!-- Table -->
            <div class="overflow-x-auto border border-gray-200 rounded-lg">
                <table class="min-w-full bg-white text-sm text-left">
                    <thead class="bg-gray-50">
                        <tr class="text-gray-700 font-medium">
                            <th class="px-4 py-3 text-center">SL</th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Class</th>
                            <th class="px-4 py-3">Boys/Girls</th>
                            <th class="px-4 py-3">Total Boys</th>
                            <th class="px-4 py-3">Total Girls</th>
                            <th class="px-4 py-3">Total Students</th>
                            <th class="px-4 py-3">Campus</th>
                            <th class="px-4 py-3 text-center">Status</th>
                            <th class="px-4 py-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($sections as $key => $section)
                            <tr class="hover:bg-gray-50">

                                <td class="text-center px-4 py-3">{{ $key + $sections->firstItem() }}</td>
                                <td class="px-4 py-3">{{ $section->name }}</td>
                                <td class="px-4 py-3">{{ $section->SchoolClass?->name }}</td>
                                <td class="px-4 py-3">{{ $section->showGenderName() }}</td>
                                <td class="px-4 py-3">{{ $section->total_boys }}</td>
                                <td class="px-4 py-3">{{ $section->total_girls }}</td>
                                <td class="px-4 py-3">{{ $section->totalStudents() }}</td>

                                <td class="px-4 py-3">{{ $section->Campus?->name }}</td>
                                <td class="px-4 py-3 text-center">
                                    <span
                                        class="font-semibold {{ $section->status ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $section->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <a href="{{ route('sections.edit', $section->id) }}"
                                        class="inline-block bg-blue-600 text-white hover:bg-blue-700 font-medium px-4 py-1 rounded transition">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        @if ($sections->isEmpty())
                            <tr>
                                <td colspan="7" class="px-4 py-3 text-center text-gray-500">No sections available.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $sections->links('pagination::tailwind') }}
            </div>
        </div>
    </div>

    {{-- </x-page-layout> --}}

</x-app-layout>
