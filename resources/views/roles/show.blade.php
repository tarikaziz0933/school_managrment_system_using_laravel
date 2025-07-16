<x-app-layout>
    {{-- Role --}}
    <div class="mb-6">
        <h2 class="text-lg font-semibold border-b pb-1 mb-3 text-gray-700">Role</h2>


        @php
            // dd($role->roleClasses)
        @endphp

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                <thead>
                    <tr class="bg-gray-100 text-left text-sm text-gray-700">
                        <th class="px-4 py-2 border-b">Name</th>
                        <th class="px-4 py-2 border-b">Display Name</th>
                        <th class="px-4 py-2 border-b">Description</th>
                        <th class="px-4 py-2 border-b">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($role->roleClasses as $roleClass) --}}
                    <tr class="text-sm text-gray-800">
                        <td class="px-4 py-2 border-b">{{ $role->name ?? '-' }}</td>
                        <td class="px-4 py-2 border-b">{{ $role->display_name ?? '-' }}</td>
                        <td class="px-4 py-2 border-b">{{ $role->description ?? '-' }}</td>
                        <td class="px-4 py-2 border-b">
                            <a href="{{ route('roles.edit', $role?->id) }}"
                                class="bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700 transition">
                                Edit
                            </a>
                    </tr>
                    {{-- @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>

    {{-- Permissions --}}
    @if ($role->permissions && $role->permissions->count())
        <div class="mb-6">
            <h2 class="text-lg font-semibold border-b pb-1 mb-3 text-gray-700">Permissions</h2>
            <div class="flex flex-wrap gap-2">
                @foreach ($role->permissions as $permission)
                    <span class="inline-flex items-center bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-xs">
                        <svg class="w-3 h-3 mr-1 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414L9 14.414 5.293 10.707a1 1 0 011.414-1.414L9 11.586l6.293-6.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ $permission->name }}
                    </span>
                @endforeach
            </div>
        </div>
    @endif
</x-app-layout>
