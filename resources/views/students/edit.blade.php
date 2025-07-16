<x-app-layout>
    <x-page-layout :title="'Student: Edit'">

        <x-slot name="actions">
            <a href="{{ route('students.index') }}" class="">
                ← Back to Students
            </a> | <a href="{{ route('students.show', $student->id) }}" class="">
                Show
            </a>
        </x-slot>
        <div class="container-fluid">
            <div class="card p-6">
                {{-- <div class="mb-6">
                <h3 class="text-2xl font-bold">Student Information Edit</h3>
            </div> --}}

                @if (session('success'))
                    <div class="alert alert-success text-lg">{{ session('success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                        <strong>Whoops! Something went wrong.</strong>
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <div class="card-body">
                    <form action="{{ route('students.update', $student->id) }}" method="POST"
                        enctype="multipart/form-data">

                        @csrf

                        @method('PUT')

                        @include('students.input_fields', ['student' => $student])

                        {{-- Buttons --}}
                        <div class="mt-6 flex justify-end space-x-4 gap-4 mr-6">
                            <button type="submit"
                                class="w-24 bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded-md transition duration-200">
                                Save
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-page-layout>
</x-app-layout>
