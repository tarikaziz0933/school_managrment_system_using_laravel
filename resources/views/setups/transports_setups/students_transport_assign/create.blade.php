<x-app-layout>
    <x-page-layout :title="'Transport Assign ID wise'">

        <x-slot name="actions">
            <a href="{{ route('students-transport-assigns.index') }}" class="">
                ← Back to list
            </a>
        </x-slot>

        <div class="mx-auto px-4 ">
            <!-- Add Branch Form -->
            <div class=" w-full mx-auto">
                <div class=" rounded-xl p-6">
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

                    {{-- <h3 class="text-2xl font-semibold mb-6 text-center text-gray-800">Transport Assign ID wise</span></h3> --}}

                    <form action="{{ route('students-transport-assigns.store') }}" method="POST">
                        @csrf

                        @include('setups.transports_setups.students_transport_assign.input_fields', [
                            'studentsTransport' => null,
                        ])

                        <div class="mt-4 flex justify-end">
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition duration-200">
                                Save
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </x-page-layout>
</x-app-layout>
