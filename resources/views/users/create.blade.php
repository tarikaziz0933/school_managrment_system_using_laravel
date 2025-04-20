<x-app-layout>
    <div class="max-w-2xl mx-auto px-4 py-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Create New User</h2>

            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

               @include("users.input_fields", ["user" =>null])

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <a href="{{ route('users.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded mr-2 hover:bg-gray-300">Cancel</a>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Create</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
