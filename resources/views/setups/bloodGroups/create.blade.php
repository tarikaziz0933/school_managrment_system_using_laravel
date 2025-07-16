<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Add Blood Group Form -->
        <div class="lg:w-1/2 w-full mx-auto">
            <div class="bg-white shadow-lg rounded-xl p-6">
                <h3 class="text-2xl font-semibold mb-4 text-center text-gray-800">Add <span class="text-blue-600">Blood Group</span></h3>
                <form action="{{ route('blood_groups.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Blood Group</label>
                        <input type="text" id="name" name="name" class="border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-400 text-sm w-full" required>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Blood Group Description</label>
                        <input type="text" id="description" name="description" class="border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-400 text-sm w-full" required>
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
