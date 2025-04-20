<x-app-layout>
    <div class="container-fluid">
        <div class="card p-6">
            <div class="mb-6">
                <h3 class="text-2xl font-bold">Student Admission</h3>
            </div>

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
                <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    @method('PUT')

                    @include('employees.input_fields', ['employee' => $employee])

                    <!-- Submit Button -->
                    <div class="mt-6">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded-md transition">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
