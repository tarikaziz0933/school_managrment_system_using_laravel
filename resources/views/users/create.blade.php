<x-app-layout>
    <x-page-layout :title="'Create New User'">

        <x-slot name="actions">
            <a href="{{ route('users.index') }}" class="">
                ← Back to list
            </a>
        </x-slot>
        <div class="max-w-2xl mx-auto px-4 py-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                {{-- <h2 class="text-2xl font-semibold text-gray-800 mb-4">Create New User</h2> --}}

                <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    @include('users.input_fields', ['user' => null])

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </x-page-layout>
</x-app-layout>
