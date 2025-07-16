<x-app-layout>
    <div class="mx-auto px-4 py-6">
        <div class="bg-gray-100 shadow-md rounded-lg overflow-hidden">



            <div class="p-4 space-y-6">


                @foreach ($types as $item)
                    <div class="flex items-start gap-4 bg-white border rounded-lg shadow p-4">


                        <div class="flex-1">
                            <h3 class="text-lg font-semibold">{{ $item->name }}</h3>
                            <p class="text-gray-600">{{ $item->display_name }}</p>
                        </div>

                        <div class="flex items-center gap-2">
                            {{-- <a href="{{ route('fee-payment-frequencies.edit', $item->id) }}"
                                class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('fee-payment-frequencies.destroy', $item->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this item?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-red-600 hover:underline">Delete</button>
                            </form> --}}
                        </div>





                    </div>
                @endforeach


            </div>
        </div>
    </div>



</x-app-layout>
