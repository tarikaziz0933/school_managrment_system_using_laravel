<x-app-layout>
    <x-page-layout :title="'Student Fee Collection'">

        <x-slot name="actions">
            <a href="{{ route('fee-collections.create') }}"
                class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                + Create
            </a>
        </x-slot>

        <div class="mx-auto px-4">

            {{-- Summary Totals --}}
            <div class="mb-6 grid grid-cols-2 md:grid-cols-4 gap-4 text-white">
                <div class="bg-blue-600 rounded-xl p-4 shadow">
                    <div class="text-sm font-medium">Total Amount</div>
                    <div class="text-xl font-bold">
                        {{ number_format($feeCollections->sum('total_amount'), 2) }}
                    </div>
                </div>
                <div class="bg-yellow-500 rounded-xl p-4 shadow">
                    <div class="text-sm font-medium">Fine</div>
                    <div class="text-xl font-bold">
                        {{ number_format($feeCollections->sum('fine_amount'), 2) }}
                    </div>
                </div>
                <div class="bg-green-600 rounded-xl p-4 shadow">
                    <div class="text-sm font-medium">Paid</div>
                    <div class="text-xl font-bold">
                        {{ number_format($feeCollections->sum('paid_amount'), 2) }}
                    </div>
                </div>
                <div class="bg-red-600 rounded-xl p-4 shadow">
                    <div class="text-sm font-medium">Due</div>
                    <div class="text-xl font-bold">
                        {{ number_format($feeCollections->sum('due_amount'), 2) }}
                    </div>
                </div>
            </div>

            {{-- Fee Collection Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($feeCollections as $collection)
                    <div class="bg-white rounded-xl shadow p-4 border border-gray-200">
                        <div class="text-sm text-gray-500 mb-2">
                            Collected at: {{ \Carbon\Carbon::parse($collection->collected_at)->format('d M, Y') }}
                        </div>
                        <div class="text-lg font-bold text-gray-800 mb-1">
                            Collection #{{ $collection->collection_no }}
                        </div>
                        <div class="text-sm text-gray-600 mb-1">
                            Year: {{ $collection->applicable_year }}
                        </div>
                        <div class="text-sm text-gray-600 mb-1">
                            Student: {{ $collection->student->name ?? 'N/A' }}
                        </div>

                        <div class="mt-4 space-y-1 text-sm text-gray-700">
                            <div>Total: <span class="font-semibold">{{ number_format($collection->total_amount, 2) }}</span></div>
                            <div>Fine: <span class="font-semibold text-yellow-600">{{ number_format($collection->fine_amount, 2) }}</span></div>
                            <div>Paid: <span class="font-semibold text-green-600">{{ number_format($collection->paid_amount, 2) }}</span></div>
                            <div>Due: <span class="font-semibold text-red-600">{{ number_format($collection->due_amount, 2) }}</span></div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-600">
                        No fee collections found.
                    </div>
                @endforelse
            </div>
        </div>

    </x-page-layout>
</x-app-layout>
