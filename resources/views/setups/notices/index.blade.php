<x-app-layout>
    <x-page-layout title="Notice List">
        <x-slot name="actions">
            <a href="{{ route('notices.create') }}"
               class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                + Create Notice
            </a>
        </x-slot>

        <div class="mx-auto px-4">
            <!-- Pagination Top -->
            <div class="mb-4">
                {{ $notices->links() }}
            </div>

            <!-- Card List -->
            <div class="space-y-6"> {{-- Adds vertical spacing between each card --}}
                @foreach ($notices as $notice)
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800">{{ $notice->title }}</h2>
                                <p class="text-gray-600 mt-2">{{ $notice->description }}</p>
                                <p class="text-blue-600 mt-2 text-sm">{{ $notice->target_url }}</p>
                                <p class="text-sm text-gray-500 mt-2">
                                    Published on: {{ $notice->created_at->format('d M Y') }}
                                </p>
                                <p class="mt-1">
                                    Status:
                                    <span class="font-semibold {{ $notice->status ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $notice->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </p>
                            </div>

                            <div class="flex flex-col gap-2 items-end">
                                <a href="{{ route('notices.show', $notice->id) }}"
                                   class="bg-gray-200 text-gray-800 hover:bg-gray-300 text-xs px-3 py-1 rounded">
                                    View
                                </a>
                                <a href="{{ route('notices.edit', $notice->id) }}"
                                   class="bg-blue-600 text-white hover:bg-blue-700 text-xs px-3 py-1 rounded">
                                    Edit
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination Bottom -->
            <div class="mt-6">
                {{ $notices->links() }}
            </div>
        </div>
    </x-page-layout>
</x-app-layout>
