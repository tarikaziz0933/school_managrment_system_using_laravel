<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Add Education Board Name -->
        <div class="lg:w-1/2 w-full mx-auto">
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

                <h3 class="text-2xl font-semibold mb-6 text-center text-gray-800">Edit <span
                        class="text-blue-600">Education Board Name</span></h3>
                <form action="{{ route('education_boards.update', $educationBoard->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('setups.education_boards.input_fields', ['educationBoard' => $educationBoard])

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
