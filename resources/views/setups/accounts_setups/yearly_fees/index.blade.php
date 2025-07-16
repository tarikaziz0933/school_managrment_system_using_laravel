<x-app-layout>
    <x-page-layout :title="'Fees Setup List'">

        <x-slot name="actions">

        </x-slot>
        <div class="mx-auto px-4">
            <div class="space-y-6 mb-6">
                {{-- Previous Data: div --}}
                <div class="rounded-xl p-6">
                    @if (session('success'))
                        <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4 text-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">
                            <strong class="block">Whoops! Something went wrong.</strong>
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif



                    <div class="bg-white shadow rounded-xl p-6">
                        <form action="{{ route('fee-setup-items.index') }}" method="GET">
                            @csrf

                            <div class="flex flex-wrap gap-4">
                                {{-- Academic Year --}}
                                <div class="flex-1">
                                    <x-form.select name="year" label="Academic Year" :options="collect(range(date('Y') - 1, date('Y') + 1))->map(
                                        fn($y) => ['id' => $y, 'name' => $y],
                                    )"
                                        :selected="old('year', $year)" defaultLabel="[Select]" />
                                </div>

                                {{-- Class --}}
                                <div class="flex-1">
                                    <x-form.select3 name="class_id" label="Class" :options="$classes
                                        ->map(
                                            fn($class) => [
                                                'id' => $class->id,
                                                'name' => $class->name,
                                                'level' => $class->level,
                                            ],
                                        )
                                        ->values()" optionValue="id"
                                        optionLabel="name" :selected="old('class_id', request('class_id'))" id="class_id" />
                                </div>

                                <div class="flex-1">
                                    <x-form.select name="group_id" label="Group" :options="$groups->map(fn($name, $id) => ['id' => $id, 'name' => $name])->values()" optionValue="id"
                                        optionLabel="name" :selected="old('group_id', request('group_id'))" id="group_id" />
                                </div>

                                {{-- Submit Button --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">&nbsp;</label>
                                    <button type="submit"
                                        class="w-24 h-12 bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg">
                                        Search
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>

                    <div class="bg-white shadow rounded-xl p-6 mt-6">
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm text-left table-auto border">
                                <thead class="bg-gray-100 text-gray-700">
                                    <tr>
                                        <th class="px-3 py-2 border text-center">SL</th>
                                        <th class="px-3 py-2 border  text-center">Fee Code</th>

                                        <th class="px-3 py-2 border  text-center">Fees Name</th>

                                        <th class="px-3 py-2 border  text-center">Class Name</th>
                                        <th class="px-3 py-2 border  text-center">Group Name</th>

                                        <th class="px-3 py-2 border  text-center">Amount</th>
                                        <th class="px-3 py-2 border  text-center">Payment Frequency</th>
                                        <th class="px-3 py-2 border  text-center">Year</th>
                                        {{-- <th class="px-3 py-2 border text-center">Action</th> --}}
                                        {{-- <th class="px-3 py-2 border">Remarks</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @php
                                    dd($fees);
                                @endphp --}}
                                    @foreach ($fee_items as $key => $fee)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-3 py-2 border">
                                                {{ $key + 1 }}

                                            </td>

                                            <td class="px-3 py-2 border text-center">
                                                {{ $fee?->feeType?->code }}

                                            </td>


                                            <td class="px-3 py-2 border">
                                                {{ $fee?->feeType?->name }}

                                            </td>


                                            <td class="px-3 py-2 border text-center">
                                                {{ $fee?->schoolClass?->name }}

                                            </td>

                                            <td class="px-3 py-2 border text-center">
                                                {{ $fee?->group?->name }}

                                            </td>

                                            <td class="px-3 py-2 border text-right">

                                                {{ $fee?->amount }}

                                            </td>

                                            <td class="px-3 py-2 border text-center">
                                                {{ ucwords(str_replace('-', ' ', $fee?->feeType?->payment_frequency_type_name)) }}

                                            </td>

                                            <td class="px-3 py-2 border text-center">
                                                {{ $fee?->year }}

                                            </td>

                                        </tr>
                                    @endforeach

                                    @if ($fee_items->isEmpty())
                                        <tr>
                                            <td colspan="3" class="px-4 py-3 text-center text-gray-500">No Fees
                                                has been added.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination -->
                        {{-- <div class="mt-6">
                        {{ $fees->links('pagination::tailwind') }}
                    </div> --}}
                    </div>
                </div>
            </div>
        </div>

        {{-- Initialize Select2 --}}
        <script>
            $(document).ready(function() {
                $('#year, #class_id')
                    .select2({
                        placeholder: "[Select]",
                        allowClear: true,
                        width: '100%'
                    });
            });
        </script>


        <script>
            $(document).ready(function() {
                function toggleGroupSelect() {
                    const selectedClass = $('#class_id').find(':selected');
                    const level = parseInt(selectedClass.data('level'));

                    console.log('Selected Level:', level);

                    if (!isNaN(level) && level >= 9) {
                        $('#group_id').prop('disabled', false);
                    } else {
                        $('#group_id')
                            .val('') // Clear value
                            .trigger('change') // Update UI (Select2 or native)
                            .prop('disabled', true);
                    }
                }

                // Initialize Select2 if not already done
                $('#class_id, #group_id, #class_id_to').select2();

                toggleGroupSelect(); // Run on page load

                $('#class_id').on('change', toggleGroupSelect);
            });
        </script>

    </x-page-layout>
</x-app-layout>
