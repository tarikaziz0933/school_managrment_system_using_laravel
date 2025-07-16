<x-app-layout>
    <x-page-layout :title="'🎉 All Student Birthdays Today'">

        <x-slot name="actions">
            <a href="{{ url()->previous() }}" class="">
                ← Back
            </a>
        </x-slot>

        <div class=" mx-auto p-6 bg-white shadow rounded">
            {{-- <h2 class="text-xl font-bold mb-4">🎉 All Student Birthdays Today</h2> --}}

            @if ($today_student_birthdays->isEmpty())
                <p class="text-gray-500 italic">No student birthdays today.</p>
            @else
                <ul class="space-y-3 text-sm text-gray-700">
                    @foreach ($today_student_birthdays as $student)
                        <li class="border-b border-gray-200 pb-2">
                            <div class="flex justify-between">
                                <p><strong>🎓 {{ $student->name }}:</strong> Student (Class
                                    {{ $student->currentClass->schoolClass->name ?? 'N/A' }})</p>
                                <a href="{{ route('students.show', $student->id) }}"
                                    class="text-blue-600 hover:underline">Show</a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

    </x-page-layout>
</x-app-layout>
