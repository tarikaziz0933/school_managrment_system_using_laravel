<div class=" rounded-lg shadow-md p-6">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 p-4">
        <!-- Separate single column beside the group -->
        <div class="p-4 rounded">
            <!-- Image (Make it span full width) -->
            <img id="pic1" class="mt-4 max-w-full h-auto rounded"
                src="{{ $employee?->image?->url ?? asset('images/blank-profile-pic.png') }}"
                style="width: 200px; height: 200px; object-fit: cover;" />
            <label for="employee_image" class="block text-lg font-medium text-gray-700">Employee Image</label>
            <input type="file" name="employee_image" id="employee_image" oninput="updateImage(this, 'pic1')"
                class="mt-1 w-full text-lg focus:ring focus:ring-blue-200 px-3 py-2" />
        </div>
        <!-- Grid layout with 3 columns -->
        <div class="lg:col-span-3 grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">

            {{-- ID No --}}
            <x-form.input type="number" name="id_number" label="ID No"
                value="{{ old('id_number', $next_id_number ?? $employee?->id_number) }}" readonly />

            <!-- First Joining Date as a Teacher  -->
            <x-form.input type="date" name="entry_date" label="First Joining Date as a Teacher"
                value="{{ \Carbon\Carbon::now()->toDateString() }}" />

            {{-- Salary --}}
            <x-form.input type="number" name="salary" label="Joining Salary <span class='text-red-500'>*</span>"
                placeholder="Type Joining Salary" value="{{ old('salary', $employee?->salary) }}" />

            <!-- employee Name -->
            <x-form.input type="text" name="name" label="Employee's Name <span class='text-red-500'>*</span>"
                placeholder="Type Employee's Name" value="{{ old('name', $employee?->name) }}" />

            <!-- employee Name (Bangla) -->
            <x-form.input type="text" name="name_bn" label="Employee's Name(Bangla)" placeholder="নাম লিখুন"
                value="{{ old('name_bn', $employee?->name_bn) }}" lang="bn" />

            <!-- Designation -->
            <x-form.select name="designation_id" label="Designation <span class='text-red-500'>*</span>"
                :options="$designations->map(fn($name, $id) => ['id' => $id, 'name' => $name])->values()" optionValue="id" optionLabel="name" :selected="old('designation_id', $employee?->designation_id)" />

            <!-- Employment Type -->
            <x-form.select name="employment_type_id" label="Employment Type <span class='text-red-500'>*</span>"
                :options="$employment_types->map(fn($name, $id) => ['id' => $id, 'name' => $name])->values()" optionValue="id" optionLabel="name" :selected="old('employment_type_id', $employee?->employment_type_id)" />

            <!-- Date of Birth -->
            <div class="relative mb-4">
                <label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth <span
                        class='text-red-500'>*</span></label>
                <input type="date" id="dob" name="dob"
                    value="{{ old('dob', $employee?->dob?->format('Y-m-d')) }}"
                    class="w-full h-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">

                @error('dob')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror

                <!-- 👶 Current Age -->
                <div id="currentAge" class="mt-2 text-sm text-gray-800 font-semibold"></div>
            </div>

            <!-- Joining Date -->
            <div class="relative mb-4">
                <x-form.input type="date" name="joined_at" id="joined_at" label="Joining Date"
                    value="{{ \Carbon\Carbon::now()->toDateString() }}" />

                <!-- 🧓 Age at Joining -->
                <div id="ageAtJoining" class="mt-2 text-sm text-gray-800 font-semibold"></div>
            </div>

            <!-- Campus -->
            <x-form.select name="campus_id" label="Campus <span class='text-red-500'>*</span>" :options="$campuses->map(fn($name, $id) => ['id' => $id, 'name' => $name])->values()"
                optionValue="id" optionLabel="name" :selected="old('campus_id', $employee?->campus_id)" />

            <!-- Phone No -->
            <div>
                <label for="phone_no" class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input type="tel" name="mobile" value="{{ old('mobile', $employee?->mobile) }}"
                    placeholder="Type Phone Number"
                    class="w-full h-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm" />

                @error('mobile')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email', $employee?->email) }}"
                    placeholder="Type Email"
                    class="w-full h-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm" />

                @error('email')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Reference -->
            <div>
                <label for="reference" class="block text-sm font-medium text-gray-700">Reference</label>
                <input type="text" name="reference" value="{{ old('reference', $employee?->reference) }}"
                    placeholder="Type Reference Name"
                    class="w-full h-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm" />

                @error('reference')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

        </div>
    </div>

    {{-- Personal Information --}}
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 pb-2 border-b border-gray-200">Personal Information</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            {{-- Father's Nmae --}}
            <x-form.input type="text" name="father_name" label="Father's Name <span class='text-red-500'>*</span>"
                placeholder="Type Father's Name" value="{{ old('father_name', $employee?->father_name) }}" />

            {{-- Mother's Nmae --}}
            <x-form.input type="text" name="mother_name" label="Mother's Name <span class='text-red-500'>*</span>"
                placeholder="Type Mother's Name" value="{{ old('mother_name', $employee?->mother_name) }}" />

            <!-- Marital status -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Marital Status</label>
                <select name="marital_status"
                    class="w-full h-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">

                    <option value="married">Married</option>
                    <option value="un_married">Un Married</option>
                    <option value="divorced">Divorsed</option>
                </select>

                @error('marital_status')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Spouse Name -->
            <div>
                <label for="spouse_name" class="block text-sm font-medium text-gray-700">Spouse Name <span
                        class='text-red-500'>*</span></label>
                <input type="text" name="spouse_name" value="{{ old('spouse_name', $employee?->spouse_name) }}"
                    placeholder="Type Spouse Name"
                    class="w-full h-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm" />

                @error('spouse_name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Spouse Phone No -->
            <x-form.input type="tel" name="spouse_mobile" label="Spouse Phone Number"
                placeholder="Type Phone Number" value="{{ old('spouse_mobile', $employee?->spouse_mobile) }}" />

            <!-- Emergency Phone No -->
            <x-form.input type="tel" name="emergency_mobile" label="Emergency Phone Number"
                placeholder="Type Emergency Phone Number"
                value="{{ old('emergency_mobile', $employee?->spouse_mobile) }}" />

            <!-- No of child -->
            <div>
                <label class="block text-sm font-medium text-gray-700">No of Children</label>
                <select name="no_of_child"
                    class="w-full h-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    @for ($no_of_child = 1; $no_of_child <= 10; $no_of_child++)
                        <option value="{{ $no_of_child }}"
                            {{ old('no_of_child') == $no_of_child ? 'selected' : '' }}>
                            {{ $no_of_child }}</option>
                    @endfor
                </select>

                @error('no_of_child')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Gender -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Gender <span class='text-red-500'>*</span>
                </label>
                @php
                    $genders = [
                        'male' => 'Male',
                        'female' => 'Female',
                        'other' => 'Other',
                    ];
                    $selectedGender = old('gender', $employee->gender ?? '');
                @endphp
                <select name="gender" id="gender"
                    class="w-full h-12 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">[Select]</option>
                    @foreach ($genders as $key => $value)
                        <option value="{{ $key }}" {{ $selectedGender == $key ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
                @error('gender')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Religion --}}
            <x-form.select name="religion_id" label="Religion" :options="$religions->map(fn($name, $id) => ['id' => $id, 'name' => $name])->values()" optionValue="id" optionLabel="name"
                :selected="old('religion_id', $employee?->religion_id ?? ($religions->flip()['Islam'] ?? null))" />

            {{-- Nationality --}}
            <x-form.select name="nationality_id" label="Nationality" :options="$nationalities->map(fn($name, $id) => ['id' => $id, 'name' => $name])->values()" optionValue="id"
                optionLabel="name" :selected="old(
                    'nationality_id',
                    $employee?->nationality_id ?? ($nationalities->flip()['Bangladeshi'] ?? null),
                )" />

            <!-- National ID No -->
            <div>
                <label for="NID_BRN_no" class="block text-sm font-medium text-gray-700">NID/BRN Number</label>
                <input type="number" name="NID_BRN_no" value="{{ old('NID_BRN_no', $employee?->NID_BRN_no) }}"
                    placeholder="Type NID/BRN_no"
                    class="w-full h-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm" />

                @error('NID_BRN_no')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Blood Group######## -->
            <div class="relative">
                <label class="block text-sm font-medium text-gray-700">Blood Group</label>
                <select name="blood_group_name" id="blood_group_name"
                    class="w-full h-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    <option value="">[Select]</option>
                    @foreach ($bloodGroups as $key => $name)
                        <option value="{{ $name }}"
                            {{ old('blood_group_name', $employee?->blood_group_name) === $name ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>

                @error('blood_group_name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- NTRCA Registration Number -->
            <div>
                <label for="NTRCA_reg_number" class="block text-sm font-medium text-gray-700">NTRCA Reg.
                    Number</label>
                <input type="number" name="NTRCA_reg_number"
                    value="{{ old('NTRCA_reg_number', $employee?->NTRCA_reg_number) }}"
                    placeholder="Type NTRCA_reg_number"
                    class="w-full h-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm" />

                @error('NTRCA_reg_number')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- NTRCA Subject -->
            <div>
                <label for="NTRCA_subject" class="block text-sm font-medium text-gray-700">NTRCA Subject</label>
                <input type="text" name="NTRCA_subject"
                    value="{{ old('NTRCA_subject', $employee?->NTRCA_subject) }}" placeholder="Type NTRCA Subject"
                    class="w-full h-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm" />

                @error('NTRCA_subject')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Experience -->
            <div>
                <label for="experience" class="block text-sm font-medium text-gray-700">Experience</label>
                <input type="text" name="experience" value="{{ old('experience', $employee?->experience) }}"
                    placeholder="Type Experience"
                    class="w-full h-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm" />

                @error('experience')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Computer Knowledge -->
            <div>
                <label for="computer_knowledge" class="block text-sm font-medium text-gray-700">Computer
                    Knowledge</label>
                <input type="text" name="computer_knowledge" placeholder="Type Computer Knowledge"
                    value="{{ old('computer_knowledge', $employee?->computer_knowledge) }}"
                    class="w-full h-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm" />

                @error('computer_knowledge')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

        </div>
    </div>

    {{-- Account Information --}}
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 pb-2 border-b border-gray-200">Account Information</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- TIN Number -->
            <x-form.input type="number" name="tin_number" label="TIN Number" placeholder="Type TIN Number"
                value="{{ old('tin_number', $employee?->tin_number) }}" />

            <!-- Bank Name -->
            <x-form.input type="text" name="bank_name" label="Bank Name" placeholder="Type Bank Name"
                value="{{ old('bank_name', $employee?->bank_name) }}" />

            <!-- Bank Branch Name -->
            <x-form.input type="text" name="bank_branch_name" label="Branch Name" placeholder="Type Branch Name"
                value="{{ old('bank_branch_name', $employee?->bank_branch_name) }}" />

            <!-- Bank Account Number -->
            <x-form.input type="number" name="bank_account_number" label="Bank Account Number"
                placeholder="Type Bank Account Number"
                value="{{ old('bank_account_number', $employee?->bank_account_number) }}" />

            <!-- Bank Routing Number -->
            <x-form.input type="number" name="bank_routing_number" label="Bank Routing Number"
                placeholder="Type Bank Routing Number"
                value="{{ old('bank_routing_number', $employee?->bank_routing_number) }}" />

            {{-- Mobile Banking Number --}}
            <x-form.input type="number" name="mobile_banking_number" label="Mobile Banking Number"
                placeholder="Type Mobile Banking Number"
                value="{{ old('mobile_banking_number', $employee?->mobile_banking_number) }}" />

        </div>
    </div>

    <!-- Address -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 pb-2 border-b border-gray-200">Address</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Present Address -->
            <div class="border border-gray-200 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Present Address</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- House / Flat No. -->
                    <x-form.input type="text" name="present_address_line_1" label="House/Street"
                        placeholder="Type House/Flat No."
                        value="{{ old('present_address_line_1', $employee?->presentAddress?->address_line_1) }}" />

                    <!-- Street / Village -->
                    <x-form.input type="text" name="present_area_name" label="Area/Village"
                        placeholder="Type Street/Village Address"
                        value="{{ old('present_area_name', $employee?->presentAddress?->area_name) }}" />

                    {{-- District --}}
                    <x-form.select name="present_district_id" label="District" :options="$districts->map(fn($name, $id) => ['id' => $id, 'name' => $name])->values()" optionValue="id"
                        optionLabel="name" :selected="old('present_district_id', $employee?->presentAddress?->district_id)" />

                    <!-- Police Station -->
                    <x-form.select name="present_police_station_id" label="Police Station" :options="[]"
                        optionValue="id" optionLabel="name" :selected="old('present_police_station_id', $employee?->presentAddress?->police_station_id)"
                        data-selected="{{ old('present_police_station_id', $employee?->presentAddress?->police_station_id) }}" />

                </div>
            </div>

            <!-- Permanent Address -->
            <div class="border border-gray-200 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Permanent Address</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- House / Flat No. -->
                    <x-form.input type="text" name="permanent_address_line_1" label="House/Street"
                        placeholder="Type House/Flat No."
                        value="{{ old('permanent_address_line_1', $employee?->presentAddress?->address_line_1) }}" />

                    <!-- Street / Village -->

                    <x-form.input type="text" name="permanent_area_name" label="Area/Village"
                        placeholder="Type Street/Village Address"
                        value="{{ old('permanent_area_name', $employee?->presentAddress?->area_name) }}" />


                    {{-- District --}}
                    <x-form.select name="permanent_district_id" label="District" :options="$districts->map(fn($name, $id) => ['id' => $id, 'name' => $name])->values()" optionValue="id"
                        optionLabel="name" :selected="old('permanent_district_id', $employee?->permanentAddress?->district_id)" />

                    {{-- Police Station --}}
                    {{-- <x-form.select name="permanent_police_station_id" label="Police Station" :options="[]"
                        optionValue="id" optionLabel="name" :selected="old('permanent_police_station_id', $student?->presentAddress?->district)" /> --}}

                    <x-form.select name="permanent_police_station_id" label="Police Station" :options="[]"
                        optionValue="id" optionLabel="name" :selected="old('permanent_police_station_id', $employee?->permanentAddress?->police_station_id)"
                        data-selected="{{ old('permanent_police_station_id', $employee?->permanentAddress?->police_station_id) }}" />

                </div>
            </div>
        </div>

        <!-- Same as Present Address Checkbox -->
        <div class="mt-6">
            <label class="inline-flex items-center">
                <input type="checkbox" id="same_as_present"
                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                <span class="ml-2 text-sm text-gray-700">Permanent Address is the same as Present Address</span>
            </label>
        </div>
    </div>

    <!-- Remarks -->
    <div class="col-span-full">
        <div class="  bg-white p-6 rounded-lg shadow-md">

            <!-- Remarks and File Upload -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-2">

                <!-- Present Job Status -->
                <x-form.input type="text" name="present_job_status" label="Present Job Status"
                    placeholder="Type Job Status"
                    value="{{ old('present_job_status', $employee?->present_job_status) }}" />

                <!-- Last Working Day -->
                <x-form.input type="date" name="last_working_day" label="Last Working Day"
                    value="{{ \Carbon\Carbon::now()->toDateString() }}" />

                <!-- Remarks -->
                <div class="flex flex-col">
                    <label for="remarks" class="block text-sm font-medium text-gray-700">Remarks</label>
                    <textarea name="remarks" id="remarks" placeholder="Type Remarks" rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">{{ old('remarks', $employee?->remarks) }}</textarea>
                    @error('remarks')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>


                <!-- File Upload -->
                <div class="flex flex-col">
                    <label for="employee_file" class="block text-sm font-medium text-gray-700">Upload Employee
                        File (PDF or Image)</label>
                    <input type="file" name="employee_file" id="employee_file" accept=".pdf, image/*"
                        class="mt-1 h-12 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
            </div>
            <!-- Status -->
            @php
                $status = [
                    '0' => 'Inactive',
                    '1' => 'Active',
                ];
            @endphp
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700">Status:</label>
                <select id="status" name="status" id="status"
                    class="w-64 h-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    @foreach ($status as $key => $value)
                        <option value="{{ $key }}"
                            {{ old('status', $employee?->status ?? '1') == $key ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>

                @error('status')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    {{-- Educational Information --}}
    <div class="md:col-span-3">
        <label class="block text-lg font-medium text-gray-700">Educational Information</label>
        <table class="table table-bordered w-full mt-4">
            <thead>
                <tr>
                    <th>Exam</th>
                    <th>Group/Subject</th>
                    <th>Board/University</th>
                    <th>Passing Year</th>
                    <th>Result</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < 8; $i++)
                    @php
                        $education = old("educations.$i")
                            ? (object) old("educations.$i")
                            : $employee->educations[$i] ?? null;
                    @endphp
                    <tr>
                        <!-- Hidden ID -->
                        <td>
                            <input type="hidden" name="educations[{{ $i }}][education_id]"
                                value="{{ $education->education_id ?? ($education->id ?? '') }}">

                            <select name="educations[{{ $i }}][exam_id]"
                                class="mt-1 w-full text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 py-2">
                                <option value="">Select Exam</option>
                                @foreach ($exams as $id => $name)
                                    <option value="{{ $id }}"
                                        {{ ($education->exam_id ?? '') == $id ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                            @error("educations.$i.exam_id")
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </td>

                        <!-- Group Dropdown -->
                        <td>
                            <select name="educations[{{ $i }}][group_id]"
                                class="mt-1 w-full text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 py-2">
                                <option value="">Select Group</option>
                                @foreach ($groups as $id => $name)
                                    <option value="{{ $id }}"
                                        {{ ($education->group_id ?? '') == $id ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                            @error("educations.$i.group_id")
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </td>

                        <!-- Board Dropdown -->
                        <td>
                            <select name="educations[{{ $i }}][education_board_id]"
                                class="mt-1 w-full text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 py-2">
                                <option value="">Select Board</option>
                                @foreach ($educationBoards as $id => $name)
                                    <option value="{{ $id }}"
                                        {{ ($education->education_board_id ?? '') == $id ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                            @error("educations.$i.education_board_id")
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </td>

                        <!-- Passing Year -->
                        <td>
                            <input type="text" name="educations[{{ $i }}][passing_year]"
                                value="{{ $education->passing_year ?? '' }}"
                                class="mt-1 w-full text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2">
                            @error("educations.$i.passing_year")
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </td>

                        <!-- Result -->
                        <td>
                            <input type="text" name="educations[{{ $i }}][result]"
                                value="{{ $education->result ?? '' }}"
                                class="mt-1 w-full text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2">
                            @error("educations.$i.result")
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>



    <script>
        document.getElementById('same_as_present').addEventListener('change', function() {
            const isChecked = this.checked;

            const fields = [
                'address_line_1',
                'area_name',
                'district_id',
                'police_station_id',
            ];

            fields.forEach(field => {
                const presentField = document.querySelector(`[name="present_${field}"]`);
                const permanentField = document.querySelector(`[name="permanent_${field}"]`);

                if (!presentField || !permanentField) return;

                if (isChecked) {
                    // For select boxes, copy selected value
                    if (presentField.tagName === 'SELECT') {
                        permanentField.innerHTML = presentField.innerHTML; // copy all options
                        permanentField.value = presentField.value; // set selected value
                        permanentField.disabled = true;
                    } else {
                        permanentField.value = presentField.value;
                        permanentField.readOnly = true;
                    }
                } else {
                    // Enable and optionally clear
                    if (permanentField.tagName === 'SELECT') {
                        permanentField.disabled = false;
                        // permanentField.innerHTML = ''; // optional reset
                    } else {
                        permanentField.readOnly = false;
                        // permanentField.value = ''; // optional reset
                    }
                }
            });
        });

        // Live sync present → permanent
        const sameAsCheckbox = document.getElementById('same_as_present');
        ['address_line_1', 'area_name'].forEach(field => {
            const presentField = document.querySelector(`[name="present_${field}"]`);
            const permanentField = document.querySelector(`[name="permanent_${field}"]`);

            if (presentField && permanentField) {
                presentField.addEventListener('input', () => {
                    if (sameAsCheckbox.checked) {
                        permanentField.value = presentField.value;
                    }
                });
            }
        });

        // Sync for select fields
        ['district_id', 'police_station_id'].forEach(field => {
            const presentField = document.querySelector(`[name="present_${field}"]`);
            const permanentField = document.querySelector(`[name="permanent_${field}"]`);

            if (presentField && permanentField) {
                presentField.addEventListener('change', () => {
                    if (sameAsCheckbox.checked) {
                        permanentField.innerHTML = presentField.innerHTML;
                        permanentField.value = presentField.value;
                    }
                });
            }
        });
    </script>


    <script>
        function updateImage(input, picId) {
            const pic = document.getElementById(picId);
            pic.src = window.URL.createObjectURL(input.files[0]);
        }
    </script>

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dobInput = document.getElementById('dob');
            const ageResult = document.getElementById('ageResult');

            function calculateAge(dobStr) {
                if (!dobStr) {
                    ageResult.textContent = '';
                    return;
                }

                const dob = new Date(dobStr);
                const today = new Date();

                let years = today.getFullYear() - dob.getFullYear();
                let months = today.getMonth() - dob.getMonth();
                let days = today.getDate() - dob.getDate();

                if (days < 0) {
                    months -= 1;
                    const previousMonth = new Date(today.getFullYear(), today.getMonth(), 0);
                    days += previousMonth.getDate();
                }

                if (months < 0) {
                    years -= 1;
                    months += 12;
                }

                ageResult.textContent = `Age: ${years} year's, ${months} month's, ${days} day's`;
            }

            dobInput.addEventListener('change', function() {
                calculateAge(this.value);
            });

            // Trigger on page load if value is already set
            if (dobInput.value) {
                calculateAge(dobInput.value);
            }
        });
    </script> --}}

    <script>
        $(document).ready(function() {
            $('#designation_id, #present_district_id, #permanent_district_id, #campus_id, #religion_id, #nationality_id, #blood_group_name')
                .select2({
                    placeholder: "[Select]",
                    allowClear: true,
                    width: '100%'
                });
        });
    </script>

    <script src="{{ asset('js/police_station_select_by_district.js') }}"></script>

    <script>
        // Initialize
        setupPoliceStationSelect('#present_district_id', "#present_police_station_id");

        setupPoliceStationSelect('#permanent_district_id', "#permanent_police_station_id");
    </script>

    <!-- JavaScript for Age Calculation with join date -->
    {{-- <script>
        function calculateAge(dob, joinDate) {
            if (!dob || !joinDate) return '';
            const dobDate = new Date(dob);
            const joinDateObj = new Date(joinDate);

            let age = joinDateObj.getFullYear() - dobDate.getFullYear();
            const m = joinDateObj.getMonth() - dobDate.getMonth();

            if (m < 0 || (m === 0 && joinDateObj.getDate() < dobDate.getDate())) {
                age--;
            }
            return age;
        }

        document.addEventListener('DOMContentLoaded', () => {
            const dobInput = document.getElementById('dob');
            const joiningInput = document.getElementById('joining_date');
            const resultDiv = document.getElementById('ageResult1');

            function updateAge() {
                const age = calculateAge(dobInput.value, joiningInput.value);
                resultDiv.textContent = age ? `Age at Joining: ${age} years` : '';
            }

            dobInput.addEventListener('change', updateAge);
            joiningInput.addEventListener('change', updateAge);

            // Trigger once on load if values are prefilled
            updateAge();
        });
    </script> --}}

    <script>
        $(document).ready(function() {
            function generateEmployeeId() {
                let joinDate = $('input[name="joined_at"]').val();

                if (joinDate) {
                    console.log(joinDate);

                    $.ajax({
                        url: '/api/employees/generate-id-number',
                        method: 'GET',
                        data: {
                            joined_at: joinDate
                        },
                        success: function(response) {

                            $('input[name="id_number"]').val(response.data.id_number);
                        },
                        error: function() {
                            console.error('Error generating Employee ID');
                            alert('Failed to generate Employee ID.');
                        }
                    });
                }
            }




            // On load
            @if ($employee == null) // laravel blade
                generateEmployeeId(); // js
            @endif // laravel blade

            // On change
            $('input[name="joined_at"]').on('change', generateEmployeeId);
        });
    </script>

    {{-- for age --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dobInput = document.getElementById('dob');
            const joinedAtInput = document.getElementById('joined_at');
            const currentAgeDiv = document.getElementById('currentAge');
            const ageAtJoiningDiv = document.getElementById('ageAtJoining');

            function calculateAge(fromDateStr, toDateStr) {
                if (!fromDateStr || !toDateStr) return null;

                const fromDate = new Date(fromDateStr);
                const toDate = new Date(toDateStr);

                let years = toDate.getFullYear() - fromDate.getFullYear();
                let months = toDate.getMonth() - fromDate.getMonth();
                let days = toDate.getDate() - fromDate.getDate();

                if (days < 0) {
                    months -= 1;
                    const prevMonth = new Date(toDate.getFullYear(), toDate.getMonth(), 0);
                    days += prevMonth.getDate();
                }

                if (months < 0) {
                    years -= 1;
                    months += 12;
                }

                return {
                    years,
                    months,
                    days
                };
            }

            function showCurrentAge() {
                const dob = dobInput.value;
                if (!dob) {
                    currentAgeDiv.textContent = '';
                    return;
                }

                const today = new Date().toISOString().split('T')[0]; // Format: yyyy-mm-dd
                const age = calculateAge(dob, today);

                if (age) {
                    currentAgeDiv.innerHTML =
                        `Current Age: <span class="text-blue-600">${age.years} year's, ${age.months} month's, ${age.days} day's</span>`;
                }
            }

            function showAgeAtJoining() {
                const dob = dobInput.value;
                const joining = joinedAtInput.value;

                if (!dob || !joining) {
                    ageAtJoiningDiv.textContent = '';
                    return;
                }

                const age = calculateAge(dob, joining);

                if (age && age.years >= 0) {
                    ageAtJoiningDiv.innerHTML =
                        `Age at Joining: <span class="text-green-600">${age.years} year's, ${age.months} month's, ${age.days} day's</span>`;
                } else {
                    ageAtJoiningDiv.innerHTML =
                        `<span class="text-red-600">Joining date cannot be before birth date!</span>`;
                }
            }

            // Event listeners
            dobInput.addEventListener('change', function() {
                showCurrentAge();
                showAgeAtJoining();
            });

            joinedAtInput.addEventListener('change', function() {
                showAgeAtJoining();
            });

            // Trigger on page load
            if (dobInput.value) {
                showCurrentAge();
                showAgeAtJoining();
            }
        });
    </script>
