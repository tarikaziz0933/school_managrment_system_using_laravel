<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Add Birth Place Form -->
        <div class="lg:w-1/3 w-full mx-auto">
            <div class="bg-white shadow-lg rounded-xl p-6">
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
                <h3 class="text-2xl font-semibold mb-6 text-center text-gray-800">Create <span
                        class="text-blue-600">District</span></h3>
                <form action="{{ route('districts.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">District Name</label>
                        <input type="text" id="name" name="name"
                            class="border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-400 text-sm w-full"
                            required>
                    </div>

                    {{-- Buttons --}}
                    <div class="mt-4 flex justify-end">
                        <button type="submit"
                            class="w-24 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-md transition duration-200">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
