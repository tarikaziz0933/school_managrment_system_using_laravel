<x-app-layout>
  <div class="container mx-auto p-6 dark:text-white">
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 space-y-6">
      <h2 class="text-xl font-semibold mb-4">Roles & Permissions</h2>

      <!-- Success Alert -->
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

      <!-- Create Role & Permission -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Create Role -->
        <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow-md">
          <h4 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">Create Role</h4>
          <form action="{{ route('roles.store') }}" method="POST">
            @csrf
            <input type="text" name="name" class="w-full p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-gray-200" placeholder="Role Name" required>
            <button type="submit" class="mt-4 w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Add Role</button>
          </form>
        </div>

        <!-- Create Permission -->
        <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow-md">
          <h4 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">Create Permission</h4>
          <form action="{{ route('permissions.store') }}" method="POST">
            @csrf
            <input type="text" name="name" class="w-full p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-gray-200" placeholder="Permission Name" required>
            <button type="submit" class="mt-4 w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Add Permission</button>
          </form>
        </div>
      </div>

      <!-- Assign Permission to Role -->
      <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow-md">
        <h4 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">Assign Permissions to Role</h4>
        <form action="{{ route('permissions.assign') }}" method="POST">
          @csrf
          <select name="role_id" class="w-full p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-gray-200 mb-4" required>
            <option value="">Select Role</option>
            @foreach($roles as $role)
            <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
          </select>

          <div class="max-h-64 overflow-y-auto border p-4 rounded-md mb-4 dark:bg-gray-800 dark:text-gray-200">
            @foreach($permissions as $permission)
            <div class="flex items-center mb-3">
              <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="mr-3 leading-tight">
              <span>{{ $permission->name }}</span>
            </div>
            @endforeach
          </div>

          <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Assign Permissions</button>
        </form>
      </div>

      <!-- Existing Roles & Permissions -->
      <h4 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">Existing Roles & Permissions</h4>
      <table class="w-full table-auto border-collapse border border-gray-300 dark:border-gray-600 mt-4">
        <thead>
          <tr class="bg-gray-200 dark:bg-gray-700">
            <th class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-left text-sm text-gray-700 dark:text-gray-300">Role</th>
            <th class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-left text-sm text-gray-700 dark:text-gray-300">Permissions</th>
            <th class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-left text-sm text-gray-700 dark:text-gray-300">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($roles as $role)
          <tr class="bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-300">
            <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 dark:hover:text-black hover:text-gray-900">{{ $role->name }}</td>
            <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm">
              <div class="flex flex-wrap gap-2">
              @foreach($role->permissions as $perm)
              <div class="relative group flex items-center">
                <span class="px-3 py-1 bg-blue-200 dark:bg-blue-900 text-blue-800 dark:text-blue-300 rounded-md text-sm">
                  {{ $perm->name }}
                </span>
                <form action="{{ route('roles.permissions.detach', ['role' => $role->id, 'permission' => $perm->id]) }}" method="POST" class="ml-2 hidden group-hover:inline" onsubmit="return confirm('Are you sure you want to detach this permission from the role?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="flex items-center justify-center text-red-500 hover:text-red-700">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                  </svg>
                </button>
                </form>
              </div>
              @endforeach
              </div>
            </td>
            {{-- <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm">
              <form action="{{ route('roles.destroy', ['id' => $role->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this role?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:text-red-700">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </form>
            </td> --}}
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</x-app-layout>
