<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Add Branch Form -->
        <div class="lg:w-1/2 w-full mx-auto">
            <div class="bg-white shadow-lg rounded-xl p-6">
                <h3 class="text-2xl font-semibold mb-6 text-center text-gray-800">Add <span class="text-blue-600">Permissions</span></h3>
                <form action="{{ route('permissions.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <input type="text" name="name" class="border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-400 text-sm w-full" required>
                    </div>
                    <div class="mb-4">
                        <label for="display_name" class="block text-sm font-medium text-gray-700 mb-1">Display Name</label>
                        <input type="text" name="display_name" class="border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-400 text-sm w-full" required>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <input type="text" name="description" class="border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-400 text-sm w-full" required>
                    </div>
                    {{-- <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" class="w-full border border-gray-300 p-3 rounded-md shadow-sm focus:ring-2 focus:ring-blue-400">
                            <option value="0">Inactive</option>
                            <option value="1">Active</option>
                        </select>
                    </div> --}}
                    <div class="mt-4 flex justify-center">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition duration-200">Add Permissions</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
