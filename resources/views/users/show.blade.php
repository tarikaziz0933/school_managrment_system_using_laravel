<x-app-layout>
    <div class="max-w-3xl mx-auto px-4 py-6">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-gray-100 px-6 py-4 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">User Details</h2>

                <div>
                    <a href="{{ route('users.index') }}"
                    class="text-sm text-blue-600 hover:underline">← Back to Users</a> | <a href="{{ route('users.edit', $user->id) }}"
                    class="text-sm text-blue-600 hover:underline">Edit</a>
                </div>

            </div>

            <div class="p-6 space-y-6">
                {{-- Profile Image --}}

                 <img id="pic1" class="w-40 h-40 object-cover rounded-lg border"
                src="{{ $user?->image?->url ?? asset('images/blank-profile-pic.png') }}"/>


                {{-- Name --}}
                <div>
                    <h3 class="text-lg font-medium text-gray-700">Name:</h3>
                    <p class="text-gray-900">{{ $user->name }}</p>
                </div>

                {{-- Email --}}
                <div>
                    <h3 class="text-lg font-medium text-gray-700">Email:</h3>
                    <p class="text-gray-900">{{ $user->email }}</p>
                </div>

                {{-- Email Verified --}}
                <div>
                    <h3 class="text-lg font-medium text-gray-700">Email Verified:</h3>
                    <p class="text-gray-900">
                        {{ $user->email_verified_at ? $user->email_verified_at->format('d M Y, h:i A') : 'Not Verified' }}
                    </p>
                </div>

                {{-- Roles --}}
                <div>
                    <h3 class="text-lg font-medium text-gray-700">Roles:</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($user->roles as $role)
                            <span class="bg-blue-100 text-blue-800 text-sm px-2 py-1 rounded">{{ $role->name }}</span>
                        @endforeach
                        @if ($user->roles->isEmpty())
                            <span class="text-gray-500 text-sm">No roles assigned.</span>
                        @endif
                    </div>
                </div>

                {{-- Permissions --}}
                <div>
                    <h3 class="text-lg font-medium text-gray-700">Permissions:</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($user->permissions as $permission)
                            <span class="bg-green-100 text-green-800 text-sm px-2 py-1 rounded">{{ $permission->name }}</span>
                        @endforeach
                        @if ($user->permissions->isEmpty())
                            <span class="text-gray-500 text-sm">No permissions assigned.</span>
                        @endif
                    </div>
                </div>

                {{-- Created At --}}
                <div>
                    <h3 class="text-lg font-medium text-gray-700">Created At:</h3>
                    <p class="text-gray-900">{{ $user->created_at->format('d M Y, h:i A') }}</p>
                </div>

                {{-- Updated At --}}
                <div>
                    <h3 class="text-lg font-medium text-gray-700">Last Updated:</h3>
                    <p class="text-gray-900">{{ $user->updated_at->format('d M Y, h:i A') }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
