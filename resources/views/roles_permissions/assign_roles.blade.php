<x-app-layout>
    <div class="container mx-auto p-6 bg-white text-black dark:bg-gray-800 dark:text-white">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-300">Manage Users Roles & Permissions</h2>

            <div>
                <!-- Search and Select User -->
                <form action="{{ route('users.authorizations') }}" method="GET" class="flex items-center space-x-2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search user by name..." class="border p-3 rounded-md w-80 bg-gray-100 text-black dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Search</button>
                </form>
            </div>
        </div>

        @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 border-l-4 border-green-500 rounded-md relative">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-green-500 absolute left-2 top-1/2 transform -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span class="ml-8">{{ session('success') }}</span>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300 border-l-4 border-red-500 rounded-md relative"></div>
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-red-500 absolute left-2 top-1/2 transform -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            <span class="ml-8">{{ session('error') }}</span>
        </div>
    </div>
    @endif

    <!-- Assign Roles and Permissions Form -->
    @if ($user)
    <form action="{{ route('users.assignRoles', $user->id) }}" method="POST">
        @csrf
        <div class="space-y-6">

            <!-- User Selection -->
            <label for="user" class="block text-lg text-gray-700 dark:text-gray-300">Select User:</label>
            <select name="user_id" class="w-full p-3 border rounded-md bg-gray-100 text-black dark:bg-gray-700 dark:text-white mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @foreach ($users as $userOption)
                <option value="{{ $userOption->id }}" {{ $userOption->id == $user->id ? 'selected' : '' }}>
                    {{ $userOption->name }}
                </option>
                @endforeach
            </select>

            <!-- Assign Roles and Permissions in Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Roles Card -->
                <div class="bg-gray-100 text-black p-6 rounded-lg shadow-lg dark:bg-gray-700 dark:text-white">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">Assign Roles</h3>
                    <div class="space-y-4 max-h-36 overflow-y-auto p-2">
                        @foreach ($roles as $role)
                        <div class="flex items-center">
                            <input type="checkbox" name="roles[]" value="{{ $role->id }}" id="role_{{ $role->id }}"
                                @if(in_array($role->id, old('roles', $user->roles->pluck('id')->toArray()))) checked @endif>
                            <label for="role_{{ $role->id }}" class="ml-2 text-gray-700 dark:text-gray-300">{{ $role->name }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Permissions Card -->
                <div class="bg-gray-100 text-black p-6 rounded-lg shadow-lg dark:bg-gray-700 dark:text-white">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">Assign Permissions</h3>
                    <div class="space-y-4 max-h-36 overflow-y-auto p-2">
                        @foreach ($permissions as $permission)
                        <div class="flex items-center">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="permission_{{ $permission->id }}"
                                @if(in_array($permission->id, old('permissions', $user->permissions->pluck('id')->toArray()))) checked @endif>
                            <label for="permission_{{ $permission->id }}" class="ml-2 text-gray-700 dark:text-gray-300">{{ $permission->name }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <button type="submit" class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">Update</button>
        </div>
    </form>
    @else
    <p class="text-red-500">Please select a user to assign roles and permissions.</p>
    @endif

    <!-- Users List -->
    <table class="table-auto w-full mt-6 border bg-gray-100 text-black dark:bg-gray-800 dark:text-white dark:border-gray-600 rounded-md">
        <thead>
            <tr class="bg-gray-200 dark:bg-gray-700">
                <th class="px-6 py-4 text-left text-lg text-gray-700 dark:text-gray-300">User</th>
                <th class="px-6 py-4 text-left text-lg text-gray-700 dark:text-gray-300">Roles</th>
                <th class="px-6 py-4 text-left text-lg text-gray-700 dark:text-gray-300">Permissions</th>
                <th class="px-6 py-4 text-left text-lg text-gray-700 dark:text-gray-300">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr class="bg-white hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 transition duration-300">
                <td class="px-6 py-4 text-gray-700 dark:text-gray-300 hover:text-black dark:hover:text-black transition duration-300">{{ $user->name }}</td>
                <td class="px-6 py-4">
                    @foreach ($user->roles as $role)
                    <form action="{{ route('users.authorizations.removeRole', ['user' => $user->id, 'role' => $role->id]) }}" method="POST" onsubmit="return confirmDelete();">
                        @csrf
                        @method('DELETE')
                        <span class="bg-green-500 text-white p-1 rounded-md text-sm inline-block">{{ $role->name }}
                            <button type="submit" class="text-red-500 ml-2">✖</button>
                        </span>
                    </form>
                    @endforeach
                </td>
                <td class="px-6 py-4">
                    @foreach ($user->permissions as $permission)
                    <form action="{{ route('users.authorizations.removePermission', ['user' => $user->id, 'permission' => $permission->id]) }}" method="POST" onsubmit="return confirmDelete();">
                        @csrf
                        @method('DELETE')
                        <span class="bg-blue-500 text-white p-1 rounded-md text-sm inline-block">{{ $permission->name }}
                            <button type="submit" class="text-red-500 ml-2">✖</button>
                        </span>
                    </form>
                    @endforeach
                </td>
                <td class="px-6 py-4">
                    <a href="{{ route('users.authorizations.edit', $user->id) }}" class="bg-yellow-500 text-white py-2 px-4 rounded-md hover:bg-yellow-600">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>

    <!-- Confirmation Modal (optional if you want a popup modal instead) -->
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this item?");
        }
    </script>
</x-app-layout>