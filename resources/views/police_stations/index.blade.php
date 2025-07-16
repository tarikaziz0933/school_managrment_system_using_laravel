<x-app-layout>

    <x-page-layout title="Police Stations">



        <x-slot name="actions">
            <a href="{{ route('police-stations.create') }}"
                class="inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition mb-6">
                Create
            </a>
        </x-slot>




        <form action="" method="get" class="flex flex-wrap items-center gap-4 mb-6">
            @csrf

            <div>
                <input name="term" type="text" value="{{ $term }}" placeholder="Search here"
                    class="border rounded px-3 py-2 w-48 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <div>
                <input name="district_name" ty∏pe="text" value="{{ $district_name }}" placeholder="Search by district"
                    class="border rounded px-3 py-2 w-48 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Search
                </button>
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 text-sm">
                <thead class="bg-gray-100">
                    <tr>

                        <th class="border px-4 py-2 text-left">Police Station</th>
                        <th class="border px-4 py-2 text-left">District</th>
                        <th class="border px-4 py-2 text-left">Action</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse($policestations as $station)
                        <tr class="hover:bg-gray-50">


                            <td class="border px-4 py-2">

                                {{ $station->name }}
                            </td>

                            <td class="border px-4 py-2">
                                @if ($station->district)
                                    {{ $station->district->name }}
                                @endif
                            </td>

                            <td class="border px-4 py-2">
                                <a href="{{ route('police-stations.edit', $station) }}"
                                    class="inline-block bg-blue-500 text-white px-2 py-1 rounded text-xs hover:bg-blue-600 transition">
                                    Edit
                                </a>
                                {{-- Uncomment if you want delete button
                            <form action="{{ route('police-stations.destroy', $station->id) }}" method="POST" class="inline-block ml-2">
                                @csrf
                                {{ method_field('DELETE') }}
                                <input type="submit" name="submit" value="Delete"
                                       class="bg-red-600 text-white px-2 py-1 rounded text-xs hover:bg-red-700 transition cursor-pointer">
                            </form>
                            --}}
                            </td>


                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="border px-4 py-4 text-center text-gray-500">No police stations
                                found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </x-page-layout>

</x-app-layout>
