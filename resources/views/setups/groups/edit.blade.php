<x-app-layout>
    <div class="container mx-auto p-4">
        <div class="grid grid-cols-1 gap-4">
            <div class="max-w-xl w-full mx-auto"> <!-- Ensure max width applies -->
                <div class="bg-white shadow-md rounded-lg p-6">
                    <div class="border-b pb-2 mb-4">
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
                        <h3 class="text-2xl font-semibold text-center text-gray-800">Edit <span
                                class="text-blue-600">Group/Subject</span></h3>
                    </div>
                    <form action="{{ route('groups.update', $group->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        @include('setups.groups.input_fields', ['group' => $group])

                        {{-- Buttons --}}
                        <div class="mt-4 flex justify-end">
                            <button type="submit"
                                class="w-24 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-md transition duration-200">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
