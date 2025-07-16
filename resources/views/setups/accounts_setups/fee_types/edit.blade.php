<x-app-layout>
    <x-page-layout :title="'Edit Fees Type'">

        <x-slot name="actions">
            <a href="{{ route('fee-types.index') }}" class="">
                ← Back to list
            </a>
        </x-slot>
        <div class=" mx-auto px-4 py-8">
            <!-- Add Branch Form -->
            <div class="lg:w-1/2 w-full mx-auto">
                <div class="bg-white rounded-xl p-6">
                    {{-- <h3 class="text-2xl font-semibold mb-6 text-center text-gray-800">Edit <span
                        class="text-blue-600">Fees Name</span></h3> --}}
                    <form action="{{ route('fee-types.update', $feeType->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        @include('setups.accounts_setups.fee_types.input_fields', ['feeType' => $feeType, 'paymentFrequencyTypes' => $paymentFrequencyTypes])

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
