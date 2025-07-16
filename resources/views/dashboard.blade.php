<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8">
        {{-- Top Cards Section --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">
            <!-- Students Card -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-md hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <h3 class="text-gray-500 dark:text-gray-300 text-sm font-medium flex items-center">
                        <svg class="h-6 w-6 mr-2 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 14l9-5-9-5-9 5 9 5z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 14l6.16-3.422A12.083 12.083 0 0112 21.5a12.083 12.083 0 01-6.16-10.922L12 14z"/>
                        </svg>
                        Total Students
                    </h3>
                    <a href="{{ route('students.index') }}" class="text-sm text-blue-600 hover:text-blue-800 hover:underline">View</a>
                </div>
                <p class="mt-4 text-3xl font-extrabold text-gray-900 dark:text-white">{{ $total_students }}</p>
            </div>

            <!-- Employees Card -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-md hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <h3 class="text-gray-500 dark:text-gray-300 text-sm font-medium flex items-center">
                        <svg class="h-6 w-6 mr-2 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-7 8h8a2 2 0 002-2V9a2 2 0 00-2-2h-1V5a1 1 0 00-1-1h-4a1 1 0 00-1 1v2H9a2 2 0 00-2 2v9a2 2 0 002 2z"/>
                        </svg>
                        Total Employees
                    </h3>
                    <a href="{{ route('employees.index') }}" class="text-sm text-blue-600 hover:text-blue-800 hover:underline">View</a>
                </div>
                <p class="mt-4 text-3xl font-extrabold text-gray-900 dark:text-white">{{ $total_employees }}</p>
            </div>

           <!-- Total Paid Amount Card -->
<div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-md hover:shadow-lg transition-shadow">
    <div class="flex items-center justify-between">
        <h3 class="text-gray-500 dark:text-gray-300 text-sm font-medium flex items-center">
            <svg class="h-6 w-6 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 8c1.104 0 2 .896 2 2s-.896 2-2 2m0 4h.01M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z"/>
            </svg>
            Total Paid Amount
        </h3>
    </div>
    <p class="mt-4 text-3xl font-extrabold text-gray-900 dark:text-white">
        ৳{{ number_format($total_paid_amount, 2) }}
    </p>
</div>

<!-- Total Due Amount Card -->
<div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-md hover:shadow-lg transition-shadow">
    <div class="flex items-center justify-between">
        <h3 class="text-gray-500 dark:text-gray-300 text-sm font-medium flex items-center">
            <svg class="h-6 w-6 mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Total Due Amount
        </h3>
    </div>
    <p class="mt-4 text-3xl font-extrabold text-gray-900 dark:text-white">
        ৳{{ number_format($total_due_amount, 2) }}
    </p>
</div>

        </div>

        {{-- Lower Section --}}
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
            <!-- Quick Access -->
            <div class="col-span-1">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md p-5">
                    <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">🚀 Quick Access</h4>
                    <ul class="space-y-2 text-sm text-gray-700 dark:text-gray-300">
                        <li>
                            <a href="{{ route('students.index') }}" class="block px-3 py-2 rounded-md hover:bg-blue-100 dark:hover:bg-gray-700 transition">📘 Manage Students</a>
                        </li>
                        <li>
                            <a href="{{ route('employees.index') }}" class="block px-3 py-2 rounded-md hover:bg-blue-100 dark:hover:bg-gray-700 transition">👨‍💼 Manage Employees</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Notices and Birthdays -->
            <div class="col-span-1 xl:col-span-2 flex flex-col gap-6">
                <!-- Notices -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md p-5">
                    <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">📢 Latest Notices</h4>
                    <ul class="space-y-3 text-sm text-gray-700 dark:text-gray-300">
                        @forelse ($notices as $notice)
                            <li class="border-b border-gray-200 dark:border-gray-700 pb-2">
                                <div class="flex justify-between items-center">
                                    <p class="font-medium text-gray-800 dark:text-white">{{ $notice->title }}</p>
                                    <a href="{{ route('notices.show', $notice->id) }}" class="text-blue-600 hover:underline text-sm">See details</a>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                    Posted {{ $notice->created_at->diffForHumans() }}
                                </p>
                            </li>
                        @empty
                            <li class="text-gray-400 italic">No notices available.</li>
                        @endforelse
                        <li>
                            <a href="{{ route('notices.index') }}" class="text-blue-600 hover:underline text-sm font-medium">→ See all notices</a>
                        </li>
                    </ul>
                </div>

                <!-- Birthdays -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md p-5">
                    <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">🎉 Today's Birthdays ({{ date('d M Y') }})</h4>

                    <!-- Employee Birthdays -->
                    @php $limited_employee_birthdays = $today_employee_birthdays->take(5); @endphp
                    <h5 class="text-md font-semibold text-gray-700 dark:text-white mb-2">👨‍🏫 Employees</h5>
                    <ul class="space-y-3 text-sm text-gray-700 dark:text-gray-300">
                        @forelse ($limited_employee_birthdays as $employee)
                            <li class="border-b border-gray-200 dark:border-gray-700 pb-2">
                                <div class="flex justify-between">
                                    <p><strong>{{ $employee->name }}:</strong> {{ $employee->designation->name }}</p>
                                    <a href="{{ route('employees.show', $employee->id) }}" class="text-blue-600 hover:underline">Show</a>
                                </div>
                            </li>
                        @empty
                            <li class="pb-2 text-gray-400 italic">No employee birthdays today.</li>
                        @endforelse
                    </ul>
                    @if ($today_employee_birthdays->count() > 5)
                        <div class="text-right mt-2">
                            <a href="{{ route('employees.birthdays') }}" class="text-blue-600 hover:underline font-semibold">See More</a>
                        </div>
                    @endif

                    <!-- Student Birthdays -->
                    <h5 class="text-md font-semibold text-gray-700 dark:text-white mt-6 mb-2">🎓 Students</h5>
                    @php $limited_birthdays = $today_student_birthdays->take(5); @endphp
                    <ul class="space-y-3 text-sm text-gray-700 dark:text-gray-300">
                        @forelse ($limited_birthdays as $student)
                            <li class="border-b border-gray-200 dark:border-gray-700 pb-2">
                                <div class="flex justify-between">
                                    <p><strong>{{ $student->name }}:</strong> Class {{ $student->currentClass->schoolClass->name ?? 'N/A' }}</p>
                                    <a href="{{ route('students.show', $student->id) }}" class="text-blue-600 hover:underline">Show</a>
                                </div>
                            </li>
                        @empty
                            <li class="pb-2 text-gray-400 italic">No student birthdays today.</li>
                        @endforelse
                    </ul>
                    @if ($today_student_birthdays->count() > 5)
                        <div class="text-right mt-2">
                            <a href="{{ route('students.birthdays') }}" class="text-blue-600 hover:underline font-semibold">See More</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
