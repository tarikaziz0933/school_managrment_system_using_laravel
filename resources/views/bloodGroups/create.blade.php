<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Add Branch -->
        <div class="lg:w-1/3">
                <div class="bg-white shadow rounded-xl p-6">
                    <h3 class="text-xl font-semibold mb-4">Add Blood Group</h3>
                    <form action="{{ route('blood_groups.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="bloodGroup" class="block text-sm font-medium text-gray-700 mb-1">Blood Group</label>
                            <input type="text" id="name" name="name" class="border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-400 text-sm">
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Blood Description</label>
                            <input type="text" id="description" name="description" class="border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-400 text-sm">
                        </div>
                        <div>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md">Add Blood Group</button>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</x-app-layout>
