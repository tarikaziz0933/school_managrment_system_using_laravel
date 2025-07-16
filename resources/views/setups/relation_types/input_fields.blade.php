<div>
    <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Relation</label>
        <input type="text" id="name" name="name" value="{{ old('name', $relation->name ?? '') }}"
            class="w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-400 text-sm"
            required>
    </div>

</div>
