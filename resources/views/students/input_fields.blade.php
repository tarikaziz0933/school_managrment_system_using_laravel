<div class="grid grid-cols-1 lg:grid-cols-4 gap-4 p-4">
    <!-- Separate single column beside the group -->
    <div class="p-4 rounded">
        <!-- Image (Make it span full width) -->
        <img id="pic1" class="mt-4 max-w-full h-auto rounded"
            src="{{ $student?->image?->url ?? asset('images/blank-profile-pic.png') }}"
            style="width: 300px; height: 300px; object-fit: cover;" />
        <label for="image1" class="block text-lg font-medium text-gray-700">Student Image</label>
        <input type="file" name="student_image" id="student_image" oninput="updateImage(this, 'pic1')"
            class="mt-1 w-full text-lg focus:ring focus:ring-blue-200 px-3 py-2" />
    </div>
    <!-- Grid layout with 3 columns -->
    <div class="lg:col-span-3 grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
        <!-- Admission Date -->
        <div>
            <label class="block text-sm font-medium">Admission Date</label>
            <input type="date" name="admitted_at" class=" w-full border p-2 rounded"
                value="{{ \Carbon\Carbon::now()->toDateString() }}">
            @error('admitted_at')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <!-- Form Number -->
        <div>
            <label class="block text-sm font-medium">Form No</label>
            <input type="text" name="registration_number" class=" w-full  border p-2 rounded  "
                placeholder="Registration No" value="{{ $student?->registration_number ?? $nextRegistrationNumber }}"
                readonly>
        </div>
        <!-- Year -->
        <div>
            <label class="block text-sm font-medium">Academic Year</label>
            <select name="academic_year" class=" w-full  border p-2 rounded">
                @for ($year = 2025; $year <= 2035; $year++)
                    <option value="{{ $year }}" {{ old('academic_year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                @endfor
            </select>

            @error('academic_year')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campus -->
        <div>
            <label for="campus_id" class="block text-lg font-medium text-gray-700">Campus</label>
            <select name="campus_id" id="campus_id"
                class="mt-1  w-full  text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2">

                @foreach ($campuses as $id => $name)
                    <option value="{{ $id }}" {{ old('campus_id', $student?->campus_id) == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>

            @error('campus_id')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Class -->
        <div>
            <label for="branch" class="block text-lg font-medium text-gray-700">Class</label>
            <select name="class_id" id="class_id"
                class="mt-1  w-full  text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2">

                @foreach ($classes as $id => $name)
                    <option value="{{ $id }}" {{ old('class_id',$student?->class_id) == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>

            @error('class_id')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror

        </div>

        <!-- Group -->
        <div>
            <label for="group" class="block text-lg font-medium text-gray-700">Group</label>
            <select name="group_id" id="group_id"
                class="mt-1  w-full  text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2">


                @foreach ($groups as $id => $name)
                    <option value="{{ $id }}" {{ old('group_id',$student?->group_id ) == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>

            @error('group_id')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror

        </div>

        <!-- Section -->
        <div>
            <label for="section" class="block text-lg font-medium text-gray-700">Section</label>
            <select name="section_id" id="section_id"
                class="mt-1  w-full  text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2">

                @foreach ($sections as $id => $name)
                    <option value="{{ $id }}" {{ old('section_id',$student?->section_id) == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>

            @error('section_id')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Roll -->
        <div>
            <label class="block text-sm font-medium">Roll</label>
            <select name="roll" class=" w-full  border p-2 rounded">
                @for ($roll = 1; $roll <= 50; $roll++)
                    <option value="{{ $roll }}" {{ old('roll') == $roll ? 'selected' : '' }}>{{ $roll }}</option>
                @endfor
            </select>

            @error('roll')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Sex -->
        <div>
            <label class="block text-sm font-medium">Sex</label>
            <select name="gender" class=" w-full  border p-2 rounded">

                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>

            @error('gender')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Student Name -->
        <div class="">
            <label for="student_name" class="block text-lg font-medium text-gray-700">Student Name</label>
            <input type="text" name="name" value="{{ old('name', $student?->name) }}"
                class="mt-1  w-full  text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2" />

            @error('name')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>


        <!-- Serial No -->
        <div>
            <label for="id_number" class="block text-lg font-medium text-gray-700">ID No</label>
            <input type="number" name="id_number" placeholder="ID No"
                value="{{ old('id_number', $student?->id_number) }}"
                class="mt-1  w-full  text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2" />

            @error('id_number')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Phone No -->
        <div>
            <label for="phone_no" class="block text-lg font-medium text-gray-700">Phone Number</label>
            <input type="text" name="mobile" value="{{ old('mobile', $student?->mobile) }}"
                class="mt-1  w-full  text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2" />

            @error('mobile')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-lg font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email',$student?->email) }}"
                class="mt-1  w-full  text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2" />

            @error('email')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

    </div>
</div>



<div class="lg:col-span-3 grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
    <!-- Date of Birth -->
    <div class="relative">
        <label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth</label>
        {{-- <div class="w-full mt-4"> --}}
        <input type="date" id="dob" name="dob" value="{{ old('dob', $student?->dob?->format('Y-m-d')) }}"
            class="mt-1  w-full  text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2">

            @error('dob')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror

        <div id="ageResult" class="mt-4  text-lg text-gray-800 font-semibold"></div>
        {{-- </div> --}}
    </div>

    <!-- Religion -->
    <div class="relative">
        <label for="religion_id" class="block text-sm font-medium text-gray-700">Religion</label>
        <select name="religion_id" id="religion_id"
            class="mt-1  w-full  text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2">

            @foreach ($religions as $id => $name)
                <option value="{{ $id }}" {{ old('religion_id', $student?->religion_id) == $id ? 'selected' : '' }}>
                    {{ $name }}
                </option>
            @endforeach
        </select>

            @error('religion_id')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
    </div>

    <!-- Blood Group######## -->
    <div class="relative">
        <label class="block text-sm font-medium">Blood Group</label>
        <select name="blood_group_name" id="blood_group_name" class=" w-full  border p-2 rounded">
            @foreach ($bloodGroups as $key => $name)
                <option value="{{ $name }}" {{ old('blood_group_name', $student?->blood_group) === $name ? 'selected' : '' }}>
                    {{ $name }}
                </option>
            @endforeach
        </select>

            @error('blood_group_name')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
    </div>

    <!-- Nationality -->
    <div class="relative">
        <label for="nationality" class="block text-sm font-medium text-gray-700">Nationality</label>
        <select name="nationality_id" id="nationality_id"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @foreach ($nationalities as $id => $name)
                <option value="{{ $id }}" {{ old('nationality_id', $student?->nationality_id) == $id ? 'selected' : '' }}>
                    {{ $name }}
                </option>
            @endforeach
        </select>

            @error('nationality_id')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
    </div>


    <!-- Birth place -->
    <div class="relative">
        <label for="district" class="block text-sm font-medium text-gray-700">Birth Place</label>
        <select id="birth_place_id" name="birth_place_id"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

            @foreach ($districts as $id => $name)
                <option value="{{ $id }}" {{ old('birth_place_id',$student?->birth_place_id) == $id ? 'selected' : '' }}>
                    {{ $name }}
                </option>
            @endforeach
        </select>

            @error('birth_place_id')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
    </div>

    <!-- Previous school -->
    <div class="lg:col-span-3 w-full">
        <label for="prev_school" class="block text-lg font-medium text-gray-700">Last Attended School's Name &
            Address</label>
        <textarea id="prev_school" name="prev_school"
            class="mt-1 w-full text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2 h-32">
            {{ old('prev_school', $student?->prev_school) }}
        </textarea>

            @error('prev_school')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
    </div>

    <!-- Address Fields Side by Side -->
    <div class="flex flex-col lg:flex-row gap-4 lg:col-span-3 w-full">
        <!-- Present Address -->
        <div class="w-full lg:w-1/2">
            <label for="present_address" class="block text-lg font-medium text-gray-700">Present Address</label>
            <input
                type="text"
                id="present_address"
                name="present_address"
                value="{{ old('present_address', $student?->present_address) }}"
                class="mt-1 w-full text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2" />

            @error('present_address')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Permanent Address -->
        <div class="w-full lg:w-1/2">
            <label for="permanent_address" class="block text-lg font-medium text-gray-700">Permanent Address</label>
            <input
                type="text"
                id="permanent_address"
                name="permanent_address"
                value="{{ old('permanent_address', $student?->permanent_address) }}"
                class="mt-1 w-full text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2" />

            @error('permanent_address')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Checkbox to make Permanent Address same as Present Address -->
    <div class="lg:col-span-3 w-full mt-4">
        <label for="same_as_present" class="inline-flex items-center">
            <input type="checkbox" id="same_as_present" name="same_as_present" class="mr-2">
            <span class="text-lg">Permanent Address is the same as Present Address</span>
        </label>
    </div>



    <!-- Characteristics -->
    <div class="lg:col-span-3 w-full">
        <label class="block font-semibold text-gray-700 mb-2">Characteristics:</label>
        <div class="flex flex-wrap gap-4">

            @foreach ($characteristics as $id => $name)
                <input type="checkbox" name="characteristics[]" value="{{ $id }}"
                    {{ $student?->characteristics->contains($id) ? 'checked' : '' }} class="text-blue-500 rounded">

                <span class="text-gray-800">{{ $name }}</span>
            @endforeach

        </div>
    </div>

    <!-- Remarks -->
    <div class="lg:col-span-3 w-full">
        <label for="remarks" class="block font-semibold text-gray-700 mb-2">Remarks:</label>
        <textarea id="remarks" name="remarks" rows="3"
            class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:border-blue-400"></textarea>

            @error('remarks')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
    </div>

    <!-- Status and Admission Test Marks -->
    <div class="md:flex items-center gap-6">

        <div class="flex-1">
            <label class="block font-semibold mb-2">Status:</label>
            <select id="status" name="status" id="status" class="w-full px-4 py-2 border p-2 rounded">
                <option value="0">Inactive</option>
                <option value="1">Active</option>
            </select>

            @error('status')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex-1">
            <label for="marks" class="block font-semibold text-gray-700 mb-2">Admission Test Marks:</label>
            <div class="flex items-center space-x-2">
                <input type="number" id="marks" name="marks" value="{{ old('marks', $student?->marks) }}"
                    class="w-24 border border-gray-300 rounded-md p-2 focus:outline-none focus:ring focus:border-blue-400">
                <span class="text-gray-800 font-medium">%</span>
                @error('marks')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

</div>

{{-- Parent Information --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4">

    <!-- Father's Information -->
    <div class="border border-gray-500 rounded-lg shadow-sm">
        <h2 class="text-lg font-semibold text-gray-700 p-3">Father's Information</h2>
        <hr class="my-2">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 p-4">
            <!-- Father's Image -->
            <div class="p-4 rounded lg:col-span-2 relative">
                <img id="pic2" class="w-full mt-4 max-w-full h-auto rounded"
                    src="{{ $student?->father?->image?->url ?? asset('images/blank_male.png') }} "
                    style="width: 200px; height: 200px; object-fit: cover;" />
                <label for="father_image" class="block text-lg font-medium text-gray-700">Father's Image</label>
                <input type="file" name="father_image" oninput="updateImage(this, 'pic2')"
                    class="mt-1 w-full text-lg focus:ring focus:ring-blue-200 px-3 py-2" />
                </div>
                @error('father_image')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror

                <div class="lg:col-span-2">
                {{-- Father's Name --}}
                <div class="w-full">
                    <label for="father_name" class="block text-lg font-medium text-gray-700 relative">Father's
                        Name</label>
                    <input type="text" name="father_name"  placeholder="Father's Name"
                        value="{{ old('father_name',$student?->father?->name) }}"
                        class="mt-1 w-full text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-
                        200 px-3 py-2 relative" />

                    @error('father_name')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="md:flex">
                    <div class="flex-1">
                        <label for="father_occupation_id"
                            class="block text-lg font-medium text-gray-700 relative">Occupation</label>
                        <select name="father_occupation_id" id="father_occupation_id"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                            @foreach ($occupations as $id => $name)
                                <option value="{{ $id }}" {{ old('father_occupation_id', $student?->father?->occupation_id) == $id ? 'selected' : '' }}
                                    {{ $student?->father?->occupation_id == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>

                        @error('father_occupation_id')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                </div>


                <div class="w-full">
                    <label for="father_mobile"
                        class="block text-lg font-medium text-gray-700 relative">Contact</label>
                    <input type="text" name="father_mobile" placeholder="Father's Contact"
                        value="{{ old('father_mobile', $student?->father?->mobile) }}"
                        class="mt-1 w-full text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-
                        200 px-3 py-2 relative" />

                    @error('father_mobile')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

            </div>
        </div>
    </div>

    <!-- Mother's Information -->
    <div class="border border-gray-500 rounded-lg shadow-sm">

        <h2 class="text-lg font-semibold text-gray-700 p-3">Mother's Information</h2>
        <hr class="my-2">

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 p-4 ">
            <!-- Mother's Image -->
            <div class="p-4 rounded lg:col-span-2 relative">
                <img id="pic3" class="w-full mt-4 max-w-full h-auto rounded"
                    src="{{ $student?->mother?->image?->url ?? asset('images/blank_female.png') }}"
                    style="width: 200px; height: 200px; object-fit: cover;" />
                <label for="mother_image" class="block text-lg font-medium text-gray-700">Mother's Image</label>
                <input type="file" name="mother_image" oninput="updateImage(this, 'pic3')"
                    class="mt-1 w-full text-lg focus:ring focus:ring-blue-200 px-3 py-2" />

                </div>
                @error('mother_image')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror

            <div class="lg:col-span-2">
                <div class="w-full">
                    <label for="mother_name" class="block text-lg font-medium text-gray-700 relative">Mother's
                        Name</label>
                    <input type="text" name="mother_name" placeholder="Mother's Name"
                        value="{{ old('mother_name', $student?->mother?->name) }}"
                        class="mt-1 w-full text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2 relative" />

                    @error('mother_name')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="md:flex">
                    <div class="flex-1">
                        <label for="mother_occupation_id"
                            class="block text-lg font-medium text-gray-700 relative">Occupation</label>
                        <select name="mother_occupation_id" id="mother_occupation_id"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                            @foreach ($occupations as $id => $name)
                                <option value="{{ $id }}"
                                {{ old('mother_occupation_id', $student?->mother?->occupation_id) == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>

                        @error('mother_occupation_id')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="w-full">
                    <label for="mother_mobile"
                        class="block text-lg font-medium text-gray-700 relative">Contact</label>
                    <input type="text" name="mother_mobile" placeholder="Mother's Contact"
                        value="{{ old('mother_mobile', $student?->mother?->mobile) }}"
                        class="mt-1 w-full text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-
                    200 px-3 py-2 relative" />

                    @error('mother_mobile')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

    </div>

</div>


<script>
    // JavaScript to copy present address to permanent address when checkbox is checked
    document.getElementById('same_as_present').addEventListener('change', function() {
        const presentAddress = document.getElementById('present_address');
        const permanentAddress = document.getElementById('permanent_address');

        if (this.checked) {
            permanentAddress.value = presentAddress.value;
            permanentAddress.disabled = true; // Disable the permanent address input
        } else {
            permanentAddress.disabled = false; // Enable the permanent address input
        }
    });
</script>

<script>
    function updateImage(input, picId) {
        const pic = document.getElementById(picId);
        pic.src = window.URL.createObjectURL(input.files[0]);
    }
</script>

<script>
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
</script>




<script>
    // JavaScript to copy present address to permanent address when checkbox is checked
    document.getElementById('same_as_present').addEventListener('change', function() {
        const presentAddress = document.getElementById('present_address');
        const permanentAddress = document.getElementById('permanent_address');

        if (this.checked) {
            permanentAddress.value = presentAddress.value;
            permanentAddress.disabled = true; // Disable the permanent address input
        } else {
            permanentAddress.disabled = false; // Enable the permanent address input
        }
    });
</script>


<script>
    $(document).ready(function() {
        $('#nationality_id').select2({
            placeholder: "Select a nationality",
            allowClear: true
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#religion_id').select2({
            placeholder: "Select a religion",
            allowClear: true
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#birth_place_id').select2({
            placeholder: "Select a birth place",
            allowClear: true
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#campus_id').select2({
            placeholder: "Select a campus",
            allowClear: true
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('#class_id').select2({
            placeholder: "Select a class",
            allowClear: true
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#group_id').select2({
            placeholder: "Select a group",
            allowClear: true
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#section_id').select2({
            placeholder: "Select a section",
            allowClear: true
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#father_occupation_id').select2({
            placeholder: "Select an occupation",
            allowClear: true
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#mother_occupation_id').select2({
            placeholder: "Select an occupation",
            allowClear: true
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#blood_group_name').select2({
            placeholder: "Select a blood group",
            allowClear: true
        });
    });
</script>
