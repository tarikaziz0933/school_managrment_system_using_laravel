<x-app-layout>


    <x-page-layout title="Police Stations">



        <x-slot name="actions">
            <a href="{{ route('police-stations.index') }}"
               class="inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition mb-6">
                Back
            </a>
        </x-slot>



    <h3 class="text-xl font-semibold mt-4 mb-6">Create Police Station</h3>

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

    <from action="{{ route('police-stations.store') }}" method="POST">


    </from>

    </x-page-layout>

</x-app-layout>
