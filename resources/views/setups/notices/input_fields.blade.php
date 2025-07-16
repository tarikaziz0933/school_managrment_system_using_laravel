<div>
    {{-- <div class="mb-4">
        <label for="id" class="block text-sm font-medium text-gray-700 mb-1">SL No</label>
        <input type="text" name="id" class="border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-400 text-sm w-full" placeholder="{{ count($designations) + 1 }}" readonly>
    </div> --}}

    <div class="mb-4">
        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Notice Title <span
                class="text-red-500">*</span></label>
        <input type="text" name="title" value="{{ old('title', $notice->title ?? '') }}"
            class="border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-400 text-sm w-full"
            required>
        @error('title')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description <span
                class="text-red-500">*</span></label>
        <textarea name="description" rows="4"
            class="border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-400 text-sm w-full"
            required>{{ old('description', $notice->description ?? '') }}</textarea>
        @error('description')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
     
        <div>
            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
            <input type="date" name="start_date" value="{{ old('start_date', $notice->start_date ?? '') }}"
                class="border border-gray-300 rounded-md shadow-sm px-4 py-2 text-sm w-full">
            @error('start_date')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
            <input type="date" name="end_date" value="{{ old('end_date', $notice->end_date ?? '') }}"
                class="border border-gray-300 rounded-md shadow-sm px-4 py-2 text-sm w-full">
            @error('end_date')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-4">
        <label for="target_url" class="block text-sm font-medium text-gray-700 mb-1">Target URL</label>
        <input type="url" name="target_url" value="{{ old('target_url', $notice->target_url ?? '') }}"
            class="border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-400 text-sm w-full">
        @error('target_url')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>


    <div class="mb-4">
        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
        <select name="status"
            class="w-full border border-gray-300 p-3 rounded-md shadow-sm focus:ring-2 focus:ring-blue-400">
            <option value="0">Inactive</option>
            <option value="1" selected>Active</option>
        </select>
    </div>
</div>
