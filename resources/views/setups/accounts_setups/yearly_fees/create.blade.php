<x-app-layout>
    <x-page-layout :title="'Class Fee Setup: Create'">

        {{-- Actions --}}

        <x-slot name="actions">
            <a href="{{ route('fee-setup-items.index') }}" class="">
                ← Back to list
            </a>
        </x-slot>
        <div class="container mx-auto px-4 py-6">
            <div class="space-y-6 mb-6">
                {{-- Previous Data: div --}}
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


                    <form action="{{ route('fee-setup-items.store') }}" method="POST">
                        @csrf

                        @include('setups.accounts_setups.yearly_fees.input_fields', ['fee_item' => null])


                        {{-- Buttons --}}
                        <div class=" flex justify-end space-x-4 gap-4 mr-6">
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
