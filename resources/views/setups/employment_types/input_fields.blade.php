<div>
    {{-- <div class="mb-4">
        <label for="id" class="block text-sm font-medium text-gray-700 mb-1">SL No</label>
        <input type="text" name="id" class="border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-400 text-sm w-full" placeholder="{{ count($designations) + 1 }}" readonly>
    </div> --}}
    <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Employment Type</label>
        <input type="text" name="name"
        value="{{ $employment_type ? $employment_type->name : old('name') }}"
        class="border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-400 text-sm w-full" required>
    </div>
    <div class="mb-4">
        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
        <select name="status" class="w-full border border-gray-300 p-3 rounded-md shadow-sm focus:ring-2 focus:ring-blue-400">
            <option value="0">Inactive</option>
            <option value="1" selected>Active</option>
        </select>
    </div>
</div>
