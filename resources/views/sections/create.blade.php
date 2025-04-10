<x-app-layout>
    <div class="container mx-auto p-4">
        <div>
            <div class="bg-white shadow-md rounded-lg p-4">
                <div class="border-b pb-2 mb-4">
                    <h3 class="text-xl font-semibold">Add <span>Section</span></h3>
                </div>
                <form action="{{ route('sections.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium"><span>Section</span> <span>Name</span> </label>
                        <input type="text" name="name" class="w-full border p-2 rounded">
                    </div>
                    <!-- Class -->
                    <div>
                        <label for="class" class="block text-lg font-medium text-gray-700">Class</label>
                        <select name="class_id" id="class_id"
                            class="mt-1 w-full text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2">
                            <option value="">-- Select Class --</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Boys/Girls</label>
                        <select name="gender" class="w-full border p-2 rounded">
                            <option value="boys">Boys</option>
                            <option value="girls">Girls</option>
                            <option value="both">Both</option>
                        </select>
                    </div>
                    <!-- Campus -->
                        <div>
                            <label for="campus_id" class="block text-lg font-medium text-gray-700">Campus</label>
                            <select name="campus_id" id="campus_id"
                                class="w-full mt-1 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2">
                                <option value="">-- Select Campus --</option>
                                @foreach ($campuses as $campus)
                                    <option value="{{ $campus->id }}">{{ $campus->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    <div>
                        <label class="block text-sm font-medium">Status</label>
                        <select name="status" class="w-full border p-2 rounded">
                            <option value="0">Inactive</option>
                            <option value="1">Active</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded">Add Section</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
