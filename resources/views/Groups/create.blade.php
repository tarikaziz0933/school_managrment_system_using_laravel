<x-app-layout>
    <div class="container mx-auto p-4">
        <div class="grid grid-cols-1 gap-4">
            <div>
                <div class="bg-white shadow-md rounded-lg p-4">
                    <div class="border-b pb-2 mb-4">
                        <h3 class="text-xl font-semibold">Add <span>Group</span></h3>
                    </div>
                    <form action="{{ route('groups.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium">SL No</label>
                            <input type="text" name="id" class="w-full border p-2 rounded " placeholder="{{ count($groups) + 1 }}" readonly>
                        </div>
                        <div>
                            <label class="block text-sm font-medium"><span>Class</span> Group Name</label>
                            <input type="text" name="name" class="w-full border p-2 rounded">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Status</label>
                            <select name="status" class="w-full border p-2 rounded">
                                <option value="0">Inactive</option>
                                <option value="1">Active</option>
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded">Add Group</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
