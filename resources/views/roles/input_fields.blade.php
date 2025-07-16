<div class="mb-4">
    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
    <input type="text" name="name"
        value="{{ old('name', $role->name ?? '') }}"
        class="border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-400 text-sm w-full"
        required>
</div>

<div class="mb-4">
    <label for="display_name" class="block text-sm font-medium text-gray-700 mb-1">Display Name</label>
    <input type="text" name="display_name"
        value="{{ old('display_name', $role->display_name ?? '') }}"
        class="border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-400 text-sm w-full"
        required>
</div>

<div class="mb-4">
    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
    <input type="text" name="description"
        value="{{ old('description', $role->description ?? '') }}"
        class="border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-400 text-sm w-full"
        required>
</div>

{{-- Permissions --}}
<div>
    <label for="permission_ids" class="block text-sm font-medium text-gray-700">Permissions</label>
    <select id="permission_ids" name="permission_ids[]" multiple
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
        @foreach ($permissions as $id => $name)
            <option value="{{ $id }}"
                {{ collect(old('permission_ids', $rolePermissions ?? []))->contains($id) ? 'selected' : '' }}>
                {{ $name }}
            </option>
        @endforeach
    </select>
    @error('permission_ids')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>

<script>
    $(document).ready(function() {
        $('#permission_ids').select2({
            placeholder: "Select roles",
            allowClear: true
        });
    });
</script>
