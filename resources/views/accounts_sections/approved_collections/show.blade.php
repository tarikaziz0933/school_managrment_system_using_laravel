<x-app-layout>
    <x-page-layout title="Approved Collection (Fees)">

        <x-slot name="actions">
            <a href="{{ route('approved-collections.index') }}"
                class="inline-block text-blue-600 px-4 py-2 rounded-md hover:bg-blue-700">
                ← Back to List
            </a>
        </x-slot>
        {{-- <a href="{{  }}" class="text-blue-600 hover:underline">
            ← Back to List
        </a> --}}
        <div class="">
            <div class="w-full">


                <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow">
                    <h2 class="text-xl font-bold mb-4">Fee Collection Details</h2>

                    <div class="mb-4">
                        <strong>Collection No:</strong> {{ $FeeCollection->collection_no }}
                    </div>

                    <div class="mb-4">
                        <strong>Collection Date:</strong> {{ $FeeCollection->collection_date }}
                    </div>

                    <div class="mb-4">
                        <strong>Student ID:</strong> {{ $FeeCollection->student->id_number ?? '-' }}
                    </div>

                    <div class="mb-4">
                        <strong>Student Name:</strong> {{ $FeeCollection->student->name ?? '-' }}
                    </div>

                    <div class="mb-4">
                        <strong>Class:</strong>
                        {{ $FeeCollection->student?->currentClass?->schoolClass?->name ?? '-' }}
                    </div>

                    <div class="mb-4">
                        <strong>Section:</strong>
                        {{ $FeeCollection->student?->currentClass?->section?->name ?? '-' }}
                    </div>

                    <div class="mb-4">
                        <strong>Payable:</strong>
                        {{ $FeeCollection->feePaymentDetail?->total_payable_amount ?? '-' }}
                    </div>

                    <div class="mb-4">
                        <strong>Paid:</strong> {{ $FeeCollection->feePaymentDetail?->paid_amount ?? '-' }}
                    </div>

                    <div class="mb-4">
                        <strong>Fine:</strong> {{ $FeeCollection->feePaymentDetail?->fine_amount ?? '-' }}
                    </div>

                    <div class="mb-4">
                        <strong>Dues:</strong> {{ $FeeCollection->feePaymentDetail?->due_amount ?? '-' }}
                    </div>


                </div>

                <!-- Pagination -->
                {{-- <div class="mt-4">
                        {{ $studentsTransportAssigns->links() }}
                    </div> --}}
            </div>
    </x-page-layout>




</x-app-layout>
