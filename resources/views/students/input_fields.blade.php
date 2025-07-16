<div class="bg-white rounded-lg shadow-md p-6">
    <!-- Student Information -->
    <div class="mb-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Student Image Column -->
            <div class="p-4 rounded">

                <img id="pic1" class="mt-4 max-w-full h-auto rounded"
                    src="{{ $student?->image?->url ?? asset('images/blank-profile-pic.png') }}"
                    style="width: 200px; height: 200px; object-fit: cover;" />
                <label class="block text-lg font-medium text-gray-700">Student Image</label>
                <input type="file" name="student_image" id="student_image" oninput="updateImage(this, 'pic1')"
                    class="mt-1 w-full text-lg focus:ring focus:ring-blue-200 px-3 py-2" />

            </div>

            <!-- Student Details Columns -->
            <div class="lg:col-span-3 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Admission Date -->
                <x-form.input type="date" name="admitted_at" label="Admission Date"
                    value="{{ \Carbon\Carbon::now()->toDateString() }}" />



                {{-- Academic Year --}}
                <div class="">
                    <label class="block text-sm font-medium text-gray-700">Academic Year</label>
                    <select name="year"
                        class="w-full h-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        @for ($year = date('Y') - 1; $year <= date('Y') + 1; $year++)
                            <option value="{{ $year }}"
                                {{ (old('year') ?? ($student?->currentClass?->year ?? date('Y'))) == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endfor
                    </select>
                    @error('year')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- ID No --}}
                <x-form.input type="number" name="id_number" label="ID No" placeholder="Type ID No." readonly
                    value="{{ old('id_number', $nextStudentId ?? $student?->id_number) }}" />

                <!-- Student Name -->
                <x-form.input type="text" name="name"
                    label="Student's Name(English) <span class='text-red-500'>*</span>"
                    placeholder="Type Student's Name" value="{{ old('name', $student?->name) }}" />

                <!-- Student Name (Bangla) -->
                <x-form.input type="text" name="name_bn" label="Student's Name(Bangla)"
                    placeholder="শিক্ষার্থীর নাম লিখুন" value="{{ old('name_bn', $student?->name_bn) }}"
                    lang="bn" />

                <!-- UID Number -->
                <x-form.input type="text" name="govt_uid_number"
                    label="UID No.(Govt. ID) <span class='text-red-500'>*</span>" placeholder="Type UID No."
                    value="{{ old('govt_uid_number', $student?->govt_uid_number) }}" />

                <!-- Version -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Version</label>
                    <div class="flex items-center space-x-6">
                        <!-- Bangla Option -->
                        <label class="inline-flex items-center">
                            <input type="radio" name="version" value="bangla"
                                {{ old('version', $student->version ?? 'bangla') == 'bangla' ? 'checked' : '' }}
                                class="text-blue-500 focus:ring-blue-500 border-gray-300">
                            <span class="ml-2 text-sm text-gray-700">Bangla</span>
                        </label>

                        <!-- English Option -->
                        <label class="inline-flex items-center">
                            <input type="radio" name="version" value="english"
                                {{ old('version', $student->version ?? 'bangla') == 'english' ? 'checked' : '' }}
                                class="text-blue-500 focus:ring-blue-500 border-gray-300">
                            <span class="ml-2 text-sm text-gray-700">English</span>
                        </label>
                    </div>

                    <!-- Validation Error -->
                    @error('version')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>



                <!-- Roll -->
                <div class="flex  space-x-6">
                    <div class="flex-1">
                        <x-form.input type="number" name="roll" label="Roll" placeholder="Type Roll No."
                            value="{{ old('roll', $student?->currentClass?->roll) }}" />
                    </div>


                    <div class="flex-1">
                        <label for="roll_postfix" class="block text-sm font-medium text-gray-700">Postfix</label>
                        <select name="roll_postfix" id="roll_postfix"
                            class="w-full h-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">

                            <option value="" selected>Select</option>


                            @foreach (range('A', 'Z') as $letter)
                                <option value="{{ $letter }}"
                                    {{ old('roll_postfix') == $letter ? 'selected' : '' }}>
                                    {{ $letter }}
                                </option>
                            @endforeach
                        </select>
                        @error('roll_postfix')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Campus -->
                <x-form.select name="campus_id" label="Campus <span class='text-red-500'>*</span>" :options="$campuses->map(fn($name, $id) => ['id' => $id, 'name' => $name])->values()"
                    optionValue="id" optionLabel="name" :selected="old('campus_id', $student?->currentClass?->campus_id)" />

                {{-- Class --}}
                <x-form.select3 name="class_id" label="Class <span class='text-red-500'>*</span>" :options="$classes
                    ->map(fn($class) => ['id' => $class->id, 'name' => $class->name, 'level' => $class->level])
                    ->values()"
                    optionValue="id" optionLabel="name" :selected="old('class_id', $student?->currentClass?->class_id)" id="class_id" />


                <!-- Section -->
                {{-- <x-form.select name="section_id" label="Section <span class='text-red-500'>*</span>" :options="[]"
                    optionValue="id" optionLabel="name" :selected="old('section_id', $student?->currentClass?->section_id)" /> --}}

                <x-form.select name="section_id" label="Section <span class='text-red-500'>*</span>" :options="[$student?->currentClass?->section_id => $student?->currentClass?->section?->name]"
                    optionValue="id" optionLabel="name" :selected="old('section_id', $student?->currentClass?->section_id)" />


                {{-- Group --}}
                <x-form.select name="group_id" label="Group" :options="$groups->map(fn($name, $id) => ['id' => $id, 'name' => $name])->values()" optionValue="id" optionLabel="name"
                    :selected="old('group_id', $student?->currentClass?->group_id)" id="group_id" />


            </div>
        </div>
    </div>

    <!-- Personal Information Section -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 pb-2 border-b border-gray-200">Personal Information</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

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
                    $selectedGender = old('gender', $student->gender ?? '');
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


            {{-- Phone Number --}}
            <x-form.input type="tel" name="mobile" label="Phone Number" placeholder="Type Phone No"
                value="{{ old('mobile', $student?->mobile) }}" />

            <!-- SMS Number -->
            <x-form.input type="tel" name="sms_number"
                label="SMS/WhatsApp Number <span class='text-red-500'>*</span>" placeholder="Type SMS No"
                value="{{ old('sms_number', $student?->sms_number) }}" />

            <!-- Email -->
            <x-form.input type="email" name="email" label="Email" placeholder="Type Email Addess"
                value="{{ old('email', $student?->email) }}" />

            {{-- Date of Birth --}}
            <div class="">
                <label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth <span
                        class='text-red-500'>*</span></label>
                <input type="date" name="dob" id="dob"
                    value="{{ old('dob', $student?->dob?->format('Y-m-d')) }}"
                    class="w-full h-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                <div id="ageResult" class="text-sm text-blue-600 font-medium"></div>
                @error('dob')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
                <div id="ageResult" class="mt-4  text-lg text-gray-800 font-semibold"></div>
            </div>

            {{-- Religion --}}
            {{-- <x-form.select name="religion_id" label="Religion" :options="$religions->map(fn($name, $id) => ['id' => $id, 'name' => $name])->values()" optionValue="id" optionLabel="name"
                :selected="old('religion_id', $student?->religion_id)" /> --}}

            {{-- Religion --}}
            <x-form.select name="religion_id" label="Religion" :options="$religions->map(fn($name, $id) => ['id' => $id, 'name' => $name])->values()" optionValue="id" optionLabel="name"
                :selected="old('religion_id', $student?->religion_id ?? ($religions->flip()['Islam'] ?? null))" />

            <!-- Blood Group -->
            <div class="">
                <label class="block text-sm font-medium text-gray-700">Blood Group</label>
                <select name="blood_group_name"
                    class="w-full h-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    <option value="">[Select]</option>
                    @foreach ($bloodGroups as $key => $name)
                        <option value="{{ $name }}"
                            {{ old('blood_group_name', $student?->blood_group_name) === $name ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
                @error('blood_group_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Birth Registration Number --}}
            <x-form.input type="number" name="brn" label="Birth Registration No"
                placeholder="Birth Registration No" value="{{ old('brn', $student?->brn) }}" />

            {{-- Nationality --}}
            <x-form.select name="nationality_id" label="Nationality" :options="$nationalities->map(fn($name, $id) => ['id' => $id, 'name' => $name])->values()" optionValue="id"
                optionLabel="name" :selected="old(
                    'nationality_id',
                    $student?->nationality_id ?? ($nationalities->flip()['Bangladeshi'] ?? null),
                )" />

        </div>
    </div>

    <!-- Parent Information Section -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 pb-2 border-b border-gray-200">Parent Information</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {{-- Father's Information --}}
            <div class="border border-gray-200 rounded-lg p-6 shadow-sm bg-white">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Father's Information</h3>
                    <label class="inline-flex items-center text-sm font-medium text-gray-700">
                        <input type="radio" name="is_primary_guardian" value="father"
                            class="text-blue-600 focus:ring-blue-500 border-gray-300"
                            @if (is_null($student?->father))
                                checked
                            @elseif (old('is_primary_guardian', $student?->father?->is_primary_guardian) === true)
                                checked
                            @endif
                        >
                        <span class="ml-2">Primary Guardian</span>
                    </label>
                </div>

                {{-- Image & Upload --}}
                <div class="flex items-center gap-4 mb-4">
                    <img id="pic2" class="w-32 h-32 object-cover rounded border"
                        src="{{ $student?->father?->image?->url ?? asset('images/blank_male.png') }}" />
                    <input type="file" name="father_image" oninput="updateImage(this, 'pic2')"
                        class="w-full text-sm border border-gray-300 rounded-md shadow-sm file:py-2 file:px-4 file:border-none file:bg-blue-50 file:text-blue-700" />
                </div>

                {{-- Details --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-form.input name="father_name"
                        label="Father's Name (English) <span class='text-red-500'>*</span>"
                        value="{{ old('father_name', $student?->father?->name) }}" />
                    <x-form.input name="father_name_bn" label="Father's Name (Bangla)"
                        value="{{ old('father_name_bn', $student?->father?->name_bn) }}" lang="bn" />
                    <x-form.select name="father_occupation_id" label="Occupation" :options="$occupations->map(fn($name, $id) => ['id' => $id, 'name' => $name])->values()"
                        :selected="old('father_occupation_id', $student?->father?->occupation_id)" />
                    <x-form.input name="father_mobile" label="Contact"
                        value="{{ old('father_mobile', $student?->father?->mobile) }}" />

                    {{-- Date of Birth --}}
                    <div>
                        <label for="father_dob" class="block text-sm font-medium text-gray-700">Date of
                            Birth</label>
                        <input type="date" name="father_dob" id="father_dob"
                            value="{{ old('father_dob', $student?->father?->dob?->format('Y-m-d')) }}"
                            class="w-full h-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        <div id="father_ageResult" class="text-sm text-blue-600 font-medium mt-1"></div>
                        @error('father_dob')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <x-form.input name="father_nid" label="BRN/NID No"
                        value="{{ old('father_nid', $student?->father?->nid) }}" />
                </div>
            </div>

            {{-- Mother's Information --}}
            <div class="border border-gray-200 rounded-lg p-6 shadow-sm bg-white">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Mother's Information</h3>
                    <label class="inline-flex items-center text-sm font-medium text-gray-700">
                        <input type="radio" name="is_primary_guardian" value="mother"
                            class="text-blue-600 focus:ring-blue-500 border-gray-300"

                             @if (is_null($student?->mother))
                                checked
                            @elseif (old('is_primary_guardian', $student?->mother?->is_primary_guardian) === true)
                                checked
                            @endif

                            >
                        <span class="ml-2">Primary Guardian</span>
                    </label>
                </div>

                <div class="flex items-center gap-4 mb-4">
                    <img id="pic3" class="w-32 h-32 object-cover rounded border"
                        src="{{ $student?->mother?->image?->url ?? asset('images/blank_female.png') }}" />
                    <input type="file" name="mother_image" oninput="updateImage(this, 'pic3')"
                        class="w-full text-sm border border-gray-300 rounded-md shadow-sm file:py-2 file:px-4 file:border-none file:bg-blue-50 file:text-blue-700" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-form.input name="mother_name"
                        label="Mother's Name (English) <span class='text-red-500'>*</span>"
                        value="{{ old('mother_name', $student?->mother?->name) }}" />
                    <x-form.input name="mother_name_bn" label="Mother's Name (Bangla)"
                        value="{{ old('mother_name_bn', $student?->mother?->name_bn) }}" lang="bn" />
                    <x-form.select name="mother_occupation_id" label="Occupation" :options="$occupations->map(fn($name, $id) => ['id' => $id, 'name' => $name])->values()"
                        :selected="old('mother_occupation_id', $student?->mother?->occupation_id)" />
                    <x-form.input name="mother_mobile" label="Contact"
                        value="{{ old('mother_mobile', $student?->mother?->mobile) }}" />
                    {{-- Date of Birth --}}
                    <div>
                        <label for="mother_dob" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                        <input type="date" name="mother_dob" id="mother_dob"
                            value="{{ old('father_dob', $student?->mother?->dob?->format('Y-m-d')) }}"
                            class="w-full h-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        <div id="mother_ageResult" class="text-sm text-blue-600 font-medium mt-1"></div>
                        @error('mother_dob')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <x-form.input name="mother_nid" label="BRN/NID No"
                        value="{{ old('mother_nid', $student?->mother?->nid) }}" />
                </div>
            </div>

            {{-- Guardian's Information --}}
            <div class="border border-gray-200 rounded-lg p-6 shadow-sm bg-white">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Guardian's Information</h3>
                    <label class="inline-flex items-center text-sm font-medium text-gray-700">
                        <input type="radio" name="is_primary_guardian" value="guardian"
                            class="text-blue-600 focus:ring-blue-500 border-gray-300"

                             @if (is_null($student?->father))
                                checked
                            @elseif (old('is_primary_guardian', $student?->guardian?->is_primary_guardian) === true)
                                checked
                            @endif

                            >
                        <span class="ml-2">Primary Guardian</span>
                    </label>
                </div>

                {{-- Guardian Image & Upload --}}

                <div class="flex items-center gap-4 mb-4">
                    <img id="pic4" class="w-32 h-32 object-cover rounded border"
                        src="{{ $student?->guardian?->image?->url ?? asset('images/blank_male.png') }}" />

                    <div class="flex-1">
                        <input type="file" name="guardian_image" oninput="updateImage(this, 'pic4')"
                        class="w-full text-sm border border-gray-300 rounded-md shadow-sm file:py-2 file:px-4 file:border-none file:bg-blue-50 file:text-blue-700" />


                            <label for="guardian_relation" class="block text-sm font-medium text-gray-700">Relation</label>
                            <select name="guardian_relation_type_slug" id="guardian_relation_type_slug"
                                class="w-full h-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                <option value="">[Select]</option>
                                @foreach ($guardianRelations as $key => $value)
                                    <option value="{{ $key }}" {{ old('guardian_relation_type_slug', $student?->guardian?->relation->slug) == $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                            @error('guardian_relation_type_slug')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-form.input name="guardian_name"
                        label="Guardian's Name (English)"
                        value="{{ old('guardian_name', $student?->guardian?->name) }}" />
                    <x-form.input name="guardian_name_bn" label="Guardian's Name (Bangla)"
                        value="{{ old('guardian_name_bn', $student?->guardian?->name_bn) }}" lang="bn" />
                    <x-form.select name="guardian_occupation_id" label="Occupation" :options="$occupations->map(fn($name, $id) => ['id' => $id, 'name' => $name])->values()"
                        :selected="old('guardian_occupation_id', $student?->guardian?->occupation_id)" />
                    <x-form.input name="guardian_mobile" label="Contact"
                        value="{{ old('guardian_mobile', $student?->guardian?->mobile) }}" />
                    {{-- Date of Birth --}}
                    <div>
                        <label for="dob" class="block text-sm font-medium text-gray-700">Date of
                            Birth</label>
                        <input type="date" name="dob" id="dob"
                            value="{{ old('dob', $student?->guardian?->dob?->format('Y-m-d')) }}"
                            class="w-full h-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        <div id="guardian_ageResult" class="text-sm text-blue-600 font-medium mt-1"></div>
                        @error('dob')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <x-form.input name="nid" label="BRN/NID No"
                        value="{{ old('nid', $student?->guardian?->nid) }}" />
                </div>
            </div>
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
                        value="{{ old('present_address_line_1', $student?->presentAddress?->address_line_1) }}" />

                    <!-- Street / Village -->
                    <x-form.input type="text" name="present_area_name" label="Area/Village"
                        placeholder="Type Street/Village Address"
                        value="{{ old('present_area_name', $student?->presentAddress?->area_name) }}" />

                    {{-- District --}}
                    <x-form.select name="present_district_id" label="District" :options="$districts->map(fn($name, $id) => ['id' => $id, 'name' => $name])->values()" optionValue="id"
                        optionLabel="name" :selected="old('present_district_id', $student?->presentAddress?->district_id)" />

                    {{-- Police Station --}}
                    {{-- <x-form.select name="present_police_station_id" label="Police Station" :options="[]"
                        optionValue="id" optionLabel="name" :selected="old('present_police_station_id', $student?->presentAddress?->police_station_id)" /> --}}

                    <x-form.select name="present_police_station_id" label="Police Station" :options="[]"
                        optionValue="id" optionLabel="name" :selected="old('present_police_station_id', $student?->presentAddress?->police_station_id)"
                        data-selected="{{ old('present_police_station_id', $student?->presentAddress?->police_station_id) }}" />



                </div>
            </div>

            <!-- Permanent Address -->
            <div class="border border-gray-200 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Permanent Address</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- House / Flat No. -->
                    <x-form.input type="text" name="permanent_address_line_1" label="House/Street"
                        placeholder="Type House/Flat No."
                        value="{{ old('permanent_address_line_1', $student?->presentAddress?->address_line_1) }}" />

                    <!-- Street / Village -->

                    <x-form.input type="text" name="permanent_area_name" label="Area/Village"
                        placeholder="Type Street/Village Address"
                        value="{{ old('permanent_area_name', $student?->presentAddress?->area_name) }}" />


                    {{-- District --}}
                    <x-form.select name="permanent_district_id" label="District" :options="$districts->map(fn($name, $id) => ['id' => $id, 'name' => $name])->values()" optionValue="id"
                        optionLabel="name" :selected="old('permanent_district_id', $student?->permanentAddress?->district_id)" />

                    {{-- Police Station --}}
                    {{-- <x-form.select name="permanent_police_station_id" label="Police Station" :options="[]"
                        optionValue="id" optionLabel="name" :selected="old('permanent_police_station_id', $student?->presentAddress?->district)" /> --}}

                    <x-form.select name="permanent_police_station_id" label="Police Station" :options="[]"
                        optionValue="id" optionLabel="name" :selected="old('permanent_police_station_id', $student?->permanentAddress?->police_station_id)"
                        data-selected="{{ old('permanent_police_station_id', $student?->permanentAddress?->police_station_id) }}" />

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




    <!-- Additional Information -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 pb-2 border-b border-gray-200">Additional Information</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">


            <!-- Last Attended School's Name and Address -->
            <div class="col-span-full">
                <label class="block text-sm font-medium text-gray-700">Last Attended School's Name and Address</label>
                <textarea name="prev_school" rows="3" placeholder="Type Last Attended School's Name and Address"
                    class="w-full h-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">{{ old('prev_school', $student?->prev_school) }}</textarea>
                @error('prev_school')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>



            <!-- Characteristics -->
            <div class="col-span-full ">
                <label class="block text-sm font-medium text-gray-700">Characteristics</label>
                <div class="flex flex-wrap gap-4 mt-2">
                    @foreach ($characteristics as $id => $name)
                        <div class="flex items-center">
                            <input type="checkbox" name="characteristics[]" value="{{ $id }}"
                                {{ $student?->characteristics->contains($id) ? 'checked' : '' }}
                                class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <label class="ml-2 block text-sm text-gray-700">{{ $name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Remarks -->
            <div class="col-span-full">
                <div class="  bg-white p-6 rounded-lg shadow-md">

                    <!-- Remarks and File Upload -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Remarks -->
                        <div class="flex flex-col">
                            <label for="remarks" class="block text-sm font-medium text-gray-700">Remarks</label>
                            <textarea name="remarks" id="remarks" rows="3" placeholder="Type Remarks"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">{{ old('remarks', $student?->remarks) }}</textarea>
                            @error('remarks')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- File Upload -->
                        <div class="flex flex-col">
                            <label for="student_file" class="block text-sm font-medium text-gray-700">Upload Student
                                File (PDF or Image)</label>
                            <input type="file" name="student_file" id="student_file" accept=".pdf, image/*"
                                class="mt-1 h-12 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>
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
                    class="w-full h-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    @foreach ($status as $key => $value)
                        <option value="{{ $key }}"
                            {{ old('status', $student?->status ?? '1') == $key ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>

                @error('status')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Admission Test Marks --}}
            <div class="">
                <label class="block text-sm font-medium text-gray-700">Admission Test Marks</label>
                <div class="flex items-center">
                    <input type="number" name="marks" value="{{ old('marks', $student?->marks) }}"
                        class=" h-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    <span class="ml-2 text-sm text-gray-700">%</span>
                </div>
                @error('marks')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>


</div>

<!-- JavaScript (keep your existing scripts) -->


{{-- For Image --}}
<script>
    function updateImage(input, picId) {
        const pic = document.getElementById(picId);
        pic.src = window.URL.createObjectURL(input.files[0]);
    }
</script>

{{-- For DOB --}}
<script>
    function setupDobAgeCalculator(dobInputId, ageResultId) {
        const dobInput = document.getElementById(dobInputId);
        const ageResult = document.getElementById(ageResultId);

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

        if (dobInput.value) {
            calculateAge(dobInput.value);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        setupDobAgeCalculator('dob', 'ageResult'); // Student DOB
        setupDobAgeCalculator('mother_dob', 'mother_ageResult'); // Mother DOB
        setupDobAgeCalculator('father_dob', 'father_ageResult'); // Father DOB
        setupDobAgeCalculator('dob', 'guardian_ageResult'); // Father DOB
    });
</script>


{{-- <script>
    document.getElementById('same_as_present').addEventListener('change', function() {
        const presentAddress = document.getElementById('present_address');
        const permanentAddress = document.getElementById('permanent_address');

        if (this.checked) {
            permanentAddress.value = presentAddress.value;
            permanentAddress.readOnly = true;
        } else {
            permanentAddress.readOnly = false;
        }
    });
</script> --}}
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



{{-- // Optional: if Present Address changes while checkbox checked, update Permanent automatically
['present_address_line_1', 'present_area_name', 'present_district_id', 'present_police_station_id'].forEach(
name => {
const presentField = document.querySelector(`[name="${name}"]`);
presentField.addEventListener('input', () => {
const checkbox = document.getElementById('same_as_present');
if (checkbox.checked) {
const correspondingPermanentName = name.replace('present', 'permanent');
const permanentField = document.querySelector(`[name="${correspondingPermanentName}"]`);
if (permanentField) {
permanentField.value = presentField.value;
}
}
});
}); --}}
{{-- </script> --}}


<!-- Select2 Scripts -->
<script>
    $(document).ready(function() {
        $('#campus_id, #section_id, #religion_id, #present_district_id, #permanent_district_id, #nationality_id, #father_occupation_id, #mother_occupation_id')
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
        $('#class_id, #group_id').select2();

        toggleGroupSelect(); // Run on page load

        $('#class_id').on('change', toggleGroupSelect);
    });
</script>

<script src="{{ asset('js/section_select_by_campus_and_class.js') }}"></script>

<script>
    // Initialize
    setupSectionSelect('#campus_id', '#class_id', '#section_id');
</script>


<script src="{{ asset('js/police_station_select_by_district.js') }}"></script>

<script>
    // Initialize
    setupPoliceStationSelect('#present_district_id', "#present_police_station_id");

    setupPoliceStationSelect('#permanent_district_id', "#permanent_police_station_id");
</script>


