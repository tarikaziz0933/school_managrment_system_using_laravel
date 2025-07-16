<x-app-layout>
    <x-page-layout :title="'Notice Details'">
        {{-- Action Buttons --}}
        <x-slot name="actions">
            <a href="{{ route('notices.index') }}" class="text-sm text-blue-600 hover:underline">← Back</a>
            | <a href="{{ route('notices.edit', $notice->id) }}" class="text-sm text-blue-600 hover:underline">Edit</a>
        </x-slot>

        {{-- Notice Details --}}
        <div class="bg-white rounded-lg p-6 border border-gray-200 space-y-6">

            <div>
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Notice Title</h2>
                <p class="text-gray-800">{{ $notice->title }}</p>
            </div>

            <div>
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Description</h2>
                <p class="text-gray-800 whitespace-pre-line">{{ $notice->description }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <h2 class="text-sm font-medium text-gray-700 mb-1">Start Date</h2>
                    <p class="text-gray-800">{{ \Carbon\Carbon::parse($notice->start_date)->format('d M, Y') }}</p>
                </div>

                <div>
                    <h2 class="text-sm font-medium text-gray-700 mb-1">End Date</h2>
                    <p class="text-gray-800">{{ \Carbon\Carbon::parse($notice->end_date)->format('d M, Y') }}</p>
                </div>

                <div>
                    <h2 class="text-sm font-medium text-gray-700 mb-1">Status</h2>
                    <span class="{{ $notice->status ? 'text-green-600' : 'text-red-600' }} font-semibold">
                        {{ $notice->status ? 'Active' : 'Inactive' }}
                    </span>
                </div>
            </div>

            <div>
                <h2 class="text-sm font-medium text-gray-700 mb-1">Target URL</h2>
                <a href="{{ $notice->target_url }}" target="_blank" class="text-blue-600 hover:underline">
                    {{ $notice->target_url }}
                </a>
            </div>
        </div>
    </x-page-layout>
</x-app-layout>
