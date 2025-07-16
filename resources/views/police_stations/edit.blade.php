<x-app-layout>

    

    <h3 class="text-xl font-semibold mt-4 mb-6">Edit Police Station</h3>

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="mb-4">
            <ul class="list-disc list-inside text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    

	<form action="{{ route('police-stations.update', $policestation->id) }}" method="POST">


    </form>

</x-app-layout>
