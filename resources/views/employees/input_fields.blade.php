<div class="grid grid-cols-1 lg:grid-cols-4 gap-4 p-4">
    <!-- Separate single column beside the group -->
    <div class="p-4 rounded">
        <!-- Image (Make it span full width) -->
        <img id="pic1" class="mt-4 max-w-full h-auto rounded"
            src="{{ $employee?->image?->url ?? asset('images/blank-profile-pic.png') }}"
            style="width: 300px; height: 300px; object-fit: cover;" />
        <label for="employee_image" class="block text-lg font-medium text-gray-700">Employee Image</label>
        <input type="file" name="employee_image" id="employee_image" oninput="updateImage(this, 'pic1')"
            class="mt-1 w-full text-lg focus:ring focus:ring-blue-200 px-3 py-2" />
    </div>
    <!-- Grid layout with 3 columns -->
    <div class="lg:col-span-3 grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">

        <div>
            <label for="id_number" class="block text-lg font-medium text-gray-700">ID No</label>
            <input type="number" name="id_number" placeholder="ID No"
                value="{{ old('id_number', $employee?->id_number) }}"
                class="mt-1  w-full  text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2" />

            @error('id_number')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Admission Date -->
        <div>
            <label class="block text-sm font-medium">Admission Date</label>
            <input type="date" name="admitted_at" class=" w-full border p-2 rounded"
                value="{{ \Carbon\Carbon::now()->toDateString() }}">
            @error('admitted_at')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Salary --}}
        <div>
            <label for="salary" class="block text-sm font-medium">Joining Salary</label>
            <input type="number" name="salary" placeholder="Enter Salary"
            value="{{ old('salary', $employee?->salary) }}"
            class="mt-1  w-full  text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2">
        </div>

            @error('salary')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror

        <!-- employee Name -->
        <div>
            <label for="employee_name" class="block text-lg font-medium text-gray-700">Employee Name</label>
            <input type="text" name="name" value="{{ old('name', $employee?->name) }}"
                class="mt-1  w-full  text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2" />

            @error('name')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Designation --}}
        <div>
            <label  for="designation_id" class="block text-lg font-medium text-gray-700">Designation</label>
            <select name="designation_id" id="designation_id"
                class="mt-1  w-full  text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2">

 

                @foreach ($designations as $id => $name)
                    <option value="{{ $id }}"  {{ old('designation_id', $employee?->designation_id) == $id ? 'selected' : '' }} >
                        {{ $name }}
                    </option>
                @endforeach
            </select>

            @error('designation_id')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

         <!-- Type -->
         <div>
            <label class="block text-sm font-medium">Type</label>
            <select name="type" class=" w-full  border p-2 rounded">

                <option value="permanent">Permanent</option>
                <option value="part_time">Part Time</option>
                <option value="other">Other</option>
            </select>

            @error('type')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Status -->
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

        <!-- Entry Date -->
        <div>
            <label class="block text-sm font-medium">Entry Date</label>
            <input type="date" name="entry_date" class=" w-full border p-2 rounded"
                value="{{ \Carbon\Carbon::now()->toDateString() }}">

            @error('entry_date')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campus -->
        <div>
            <label for="campus_id" class="block text-lg font-medium text-gray-700">Campus</label>
            <select name="campus_id" id="campus_id"
                class="mt-1  w-full  text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2">

                @foreach ($campuses as $id => $name)
                    <option value="{{ $id }}" {{ old('campus_id', $employee?->campus_id) == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>

            @error('campus_id')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Father's Nmae --}}
        <div class="w-full">
            <label for="father_name" class="block text-lg font-medium text-gray-700 relative">Father's
                Name</label>
                <input type="text" name="father_name"  placeholder="Father's Name"
                value="{{ old('father_name',$employee?->father_name) }}"
                class="mt-1 w-full text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-
                200 px-3 py-2 relative" />
                
                @error('father_name')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            
        {{-- Mother's Nmae --}}
        <div class="w-full">
            <label for="mother_name" class="block text-lg font-medium text-gray-700 relative">Mother's
                Name</label>
            <input type="text" name="mother_name" placeholder="Mother's Name"
                value="{{ old('mother_name', $employee?->mother_name) }}"
                class="mt-1 w-full text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2 relative" />

            @error('mother_name')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

         <!-- Marital status -->
         <div>
            <label class="block text-sm font-medium">Marital Status</label>
            <select name="marital_status" class=" w-full  border p-2 rounded">

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
            <label for="spouse_name" class="block text-lg font-medium text-gray-700">Spouse Name</label>
            <input type="text" name="spouse_name" value="{{ old('spouse_name', $employee?->spouse_name) }}"
                class="mt-1  w-full  text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2" />

            @error('spouse_name')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Spouse Phone No -->
        <div>
            <label for="spouse_mobile" class="block text-lg font-medium text-gray-700">Spouse Phone Number</label>
            <input type="text" name="spouse_mobile" value="{{ old('spouse_mobile', $employee?->spouse_mobile) }}"
                class="mt-1  w-full  text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2" />

            @error('spouse_mobile')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

         <!-- No of child -->
         <div>
            <label class="block text-sm font-medium">No of Children</label>
            <select name="no_of_child" class=" w-full  border p-2 rounded">
                @for ($no_of_child = 1; $no_of_child <= 50; $no_of_child++)
                    <option value="{{ $no_of_child }}" {{ old('no_of_child') == $no_of_child ? 'selected' : '' }}>{{ $no_of_child }}</option>
                @endfor
            </select>

            @error('no_of_child')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Date of Birth -->
        <div class="relative">
            <label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth</label>
            {{-- <div class="w-full mt-4"> --}}
            <input type="date" id="dob" name="dob" value="{{ old('dob', $employee?->dob?->format('Y-m-d')) }}"
                class="mt-1  w-full  text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2">

                @error('dob')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror

            <div id="ageResult" class="mt-4  text-lg text-gray-800 font-semibold"></div>
            {{-- </div> --}}
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

        <!-- Religion -->
        <div class="relative">
            <label for="religion_id" class="block text-sm font-medium text-gray-700">Religion</label>
            <select name="religion_id" id="religion_id"
                class="mt-1  w-full  text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2">

                @foreach ($religions as $id => $name)
                    <option value="{{ $id }}" {{ old('religion_id', $employee?->religion_id) == $id ? 'selected' : '' }}>
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
                    <option value="{{ $name }}" {{ old('blood_group_name', $employee?->blood_group) === $name ? 'selected' : '' }}>
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
                    <option value="{{ $id }}" {{ old('nationality_id', $employee?->nationality_id) == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>

                @error('nationality_id')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
        </div>

        <!-- National ID No -->
        <div>
            <label for="NID_no" class="block text-lg font-medium text-gray-700">National ID Number</label>
            <input type="text" name="NID_no" value="{{ old('NID_no', $employee?->NID_no) }}"
                class="mt-1  w-full  text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2" />

            @error('NID_no')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Phone No -->
        <div>
            <label for="phone_no" class="block text-lg font-medium text-gray-700">Phone Number</label>
            <input type="text" name="mobile" value="{{ old('mobile', $employee?->mobile) }}"
                class="mt-1  w-full  text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2" />

            @error('mobile')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-lg font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email',$employee?->email) }}"
                class="mt-1  w-full  text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2" />

            @error('email')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Hobbies -->
        <div>
            <label for="NID_no" class="block text-lg font-medium text-gray-700">Hobbies</label>
            <input type="text" name="hobbies" value="{{ old('hobbies', $employee?->hobbies) }}"
                class="mt-1  w-full  text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2" />

            @error('hobbies')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Experience -->
        <div>
            <label for="experience" class="block text-lg font-medium text-gray-700">Experience</label>
            <input type="text" name="experience" value="{{ old('experience', $employee?->experience) }}"
                class="mt-1  w-full  text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2" />

            @error('experience')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Reference -->
        <div>
            <label for="reference" class="block text-lg font-medium text-gray-700">Reference</label>
            <input type="text" name="reference" value="{{ old('reference', $employee?->reference) }}"
                class="mt-1  w-full  text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2" />

            @error('reference')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Computer Knowledge -->
        <div>
            <label for="computer_knowledge" class="block text-lg font-medium text-gray-700">Computer Knowledge</label>
            <input type="text" name="computer_knowledge" value="{{ old('computer_knowledge', $employee?->computer_knowledge) }}"
                class="mt-1  w-full  text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2" />

            @error('computer_knowledge')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        
    </div>
</div>


{{-- Educational Information --}}
<div class="flex justify-end">
    <div>
        <h5 class="mt-4 mb-2 text-danger">Educational Information</h5>
        <table class="table table-bordered">
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
                @for($i = 0; $i < 3; $i++)
                <tr>
                    <td><input type="text" name="education[{{$i}}][exam]" class="form-control"></td>
                    <td><input type="text" name="education[{{$i}}][subject]" class="form-control"></td>
                    <td><input type="text" name="education[{{$i}}][board]" class="form-control"></td>
                    <td><input type="text" name="education[{{$i}}][year]" class="form-control"></td>
                    <td><input type="text" name="education[{{$i}}][result]" class="form-control"></td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>





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