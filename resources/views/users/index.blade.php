<x-app-layout>
    <div class="mx-auto px-4 py-6">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-gray-100 p-4 space-y-4">
                <div class="flex justify-between items-center">
                    <h3 class="text-2xl font-semibold text-gray-700">Users</h3>

                    {{-- Create Button --}}
                    <a href="{{ route('users.create') }}"
                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                        Create
                    </a>
                </div>

                {{-- Search Form --}}
                <form method="GET" action="{{ route('users.index') }}"
                    class="flex flex-col sm:flex-row sm:items-center gap-2 w-full">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by name or email"
                        class="flex-1 border border-gray-300 rounded-md px-4 py-2 focus:ring focus:ring-blue-200 focus:outline-none">

                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
                        </svg>
                    </button>

                </form>
            </div>

            <div class="p-4 space-y-6">
                {{ $users->withQueryString()->links() }}

                <div class="grid grid-cols-1 gap-6">
                    @forelse ($users as $user)
                        <div class="bg-white border rounded-lg shadow hover:shadow-md transition">
                            <div class="p-4">
                                <div class="flex items-center space-x-4">
                                    <img src="{{ $user->image?->url ?? asset('images/blank-profile-pic.png') }}"
                                        alt="{{ $user->name }}" class="w-24 h-24 object-cover rounded-lg border">
                                    <div>
                                        <h4 class="text-lg font-semibold text-gray-800">{{ $user->name }}</h4>
                                        <p class="text-sm text-gray-600">{{ $user->email }}</p>
                                        <p class="text-xs text-gray-400">
                                            Verified at:
                                            {{ optional($user->email_verified_at)->format('Y-m-d H:i') ?? 'Not verified' }}
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-4 flex flex-wrap gap-2">
                                    @foreach ($user->roles as $role)
                                        <span
                                            class="inline-block bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded">{{ $role->name }}</span>
                                    @endforeach
                                </div>

                                {{-- <div class="mt-4 flex justify-between items-center">
                                    <a href="{{ route('users.edit', $user) }}"
                                       class="text-blue-600 hover:underline text-sm">Edit</a>

                                    <form action="{{ route('users.destroy', $user) }}" method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-600 hover:underline text-sm">Delete</button>
                                    </form>
                                </div> --}}

                                {{-- Action Buttons --}}
                                <div class="pt-3 flex gap-2">
                                    <a href="{{ route('users.show', $user->id) }}"
                                        class="bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700 transition">Show</a>
                                    <a href="{{ route('users.edit', $user->id) }}"
                                        class="bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700 transition">Edit</a>




                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">No users found.</p>
                    @endforelse
                </div>

                {{ $users->withQueryString()->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
