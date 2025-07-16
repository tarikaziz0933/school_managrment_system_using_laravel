<x-app-layout>
    <x-page-layout :title="'Edit User: ' . $user->name">

        <x-slot name="actions">
            <a href="{{ route('users.index') }}" class="">
                ← Back to list
            </a>
        </x-slot>
        <div class="max-w-3xl mx-auto px-4 py-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                {{-- <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit User: {{ $user->name }}</h2> --}}

                <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf
                    @method('PUT')

                    @include('users.input_fields', ['user' => $user])


                    {{-- Form Actions --}}
                    <div class="flex justify-end space-x-2">
                        <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </x-page-layout>
</x-app-layout>
