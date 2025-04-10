<x-app-layout>
    <div class="container-fluid">
        <div class="card p-6">
            <div class="mb-6">
                <h3 class="text-2xl font-bold">Student Admission</h3>
            </div>

            @if (session('success'))
                <div class="alert alert-success text-lg">{{ session('success') }}</div>
            @endif

            <div class="card-body">
                <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 p-4">
                        <!-- Separate single column beside the group -->
                        <div class="p-4 rounded">
                            <!-- Image (Make it span full width) -->
                            <img id="pic1" class="mt-4 max-w-full h-auto rounded" src="{{ asset('images/blank-profile-pic.png') }}" style="width: 300px; height: 300px; object-fit: cover;" />
                            <label for="image1" class="block text-lg font-medium text-gray-700">Student Image</label>
                            <input type="file" name="student_image" id="student_image" oninput="updateImage(this, 'pic1')"
                                class="mt-1 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2" />
                        </div>
                        <!-- Grid layout with 3 columns -->
                        <div class="lg:col-span-3 grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                            <!-- Admission Date -->
                            <div>
                                <label class="block text-sm font-medium">Admission Date</label>
                                <input type="date" name="admitted_at" class="w-64 border p-2 rounded" value="{{ \Carbon\Carbon::now()->toDateString() }}">
                            </div>
                            <!-- Form Number -->
                            <div>
                                <label class="block text-sm font-medium">Form No</label>
                                <input type="text" name="form_number" class="w-64 border p-2 rounded  " placeholder="{{ $student->form_number }}" value="{{ $student->form_number }}" readonly>
                            </div>
                            <!-- Year -->
                            <div>
                                <label class="block text-sm font-medium">Academic Year</label>
                                <select name="academic_year" class="w-64 border p-2 rounded">
                                    @for ($year = 2025; $year <= 2035; $year++)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Campus -->
                            <div>
                                <label for="campus_id" class="block text-lg font-medium text-gray-700">Campus</label>
                                <select name="campus_id" id="campus_id"
                                    class="mt-1 w-64 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2">
                                    <option value="">{{ $student->rel_to_campus?->name }}</option>
                                    @foreach ($campuses as $campus)
                                        <option value="{{ $campus->id }}">{{ $campus->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Class -->
                            <div>
                                <label for="branch" class="block text-lg font-medium text-gray-700">Class</label>
                                <select name="class_id" id="class_id"
                                    class="mt-1 w-64 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2">
                                    <option value="">{{ $student->rel_to_class?->name }}</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Group -->
                            <div>
                                <label for="group" class="block text-lg font-medium text-gray-700">Group</label>
                                <select name="group_id" id="group_id"
                                    class="mt-1 w-64 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2">
                                    <option value="">{{ $student->rel_to_group?->name }}</option>
                                    @foreach ($groups as $group)
                                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Section -->
                            <div>
                                <label for="section" class="block text-lg font-medium text-gray-700">Section</label>
                                <select name="section_id" id="section_id"
                                    class="mt-1 w-64 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2">
                                    <option value="">{{ $student->rel_to_section?->name }}</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Roll -->
                            <div>
                                <label class="block text-sm font-medium">Roll</label>
                                <select name="roll" class="w-64 border p-2 rounded">
                                    @for ($roll = 0; $roll <= 50; $roll++)
                                        <option value="{{ $roll }}">{{ $roll }}</option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Sex -->
                            <div>
                                <label class="block text-sm font-medium">Sex</label>
                                <select name="gender" class="w-64 border p-2 rounded">
                                    <option value="">{{ ucfirst($student->gender) }}</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <!-- Student Name -->
                            <div class="">
                                <label for="student_name" class="block text-lg font-medium text-gray-700">Student Name</label>
                                <input type="text" name="name" id="name" placeholder="{{ $student->name }}"
                                    class="mt-1 w-64 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2" />
                            </div>

                            
                            <!-- Serial No -->
                            <div>
                                <label for="serial_no" class="block text-lg font-medium text-gray-700">ID No</label>
                                <input type="number" name="serial_no" id="serial_no" placeholder="{{ $student->serial_no }}"
                                    class="mt-1 w-64 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2" />
                            </div>

                            <!-- Phone No -->
                            <div>
                                <label for="phone_no" class="block text-lg font-medium text-gray-700">Phone Number</label>
                                <input type="text" name="mobile" id="mobile" placeholder="{{ $student->mobile }}"
                                    class="mt-1 w-64 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2" />
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-lg font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" placeholder="{{ $student->email }}"
                                    class="mt-1 w-64 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2" />
                            </div>

                        </div>
                    </div>

                    {{-- Parent Information --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4">
                        <!-- Father's Information -->
                        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 p-4">
                            <!-- Father's Image -->
                            <div class="p-4 rounded lg:col-span-2 relative">
                                <img id="pic2" class="w-full mt-4 max-w-full h-auto rounded" src="{{ asset('images/blank_male.png') }}" style="width: 200px; height: 200px; object-fit: cover;" />
                                <label for="image2" class="block text-lg font-medium text-gray-700">Father's Image</label>
                                <input type="file" name="fathers_image" id="fathers_image" oninput="updateImage(this, 'pic2')"
                                    class="mt-1 w-full text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2" />
                    
                            </div>

                            <div class="lg:col-span-2">
                                <div class="w-full">
                                    <label for="fathers_name" class="block text-lg font-medium text-gray-700 relative">Father's Name</label>
                                    <input type="text" name="fathers_name" id="fathers_name" placeholder="Father's Name"
                                        class="mt-1 w-full text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-
                                        200 px-3 py-2 relative" />
                                </div>
                                <div class="md:flex">
                                    <div class="flex-1">
                                        <label for="occupation" class="block text-lg font-medium text-gray-700 relative">Occupation</label>
                                        <select id="fathers_occupation" name="fathers_occupation" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value="">-- Select Occupation --</option>
                                             @foreach ($occupations as $occupation)
                                                <option value="{{ $occupation->id }}">{{ $occupation->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="flex-1">
                                        <label for="fathers_contact" class="block text-lg font-medium text-gray-700 relative">Contact Number</label>
                                        <input type="text" name="fathers_contact" id="father_contact" placeholder="Mobile No"
                                            class="mt-1 w-40 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2 relative" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Mother's Information -->
                        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 p-4">
                            <!-- Mother's Image -->
                            <div class="p-4 rounded lg:col-span-2 relative">
                                <img id="pic3" class="w-full mt-4 max-w-full h-auto rounded" src="{{ asset('images/blank_female.png') }}" style="width: 200px; height: 200px; object-fit: cover;" />
                                <label for="image3" class="block text-lg font-medium text-gray-700">Mother's Image</label>
                                <input type="file" name="mothers_image" id="mothers_image" oninput="updateImage(this, 'pic3')"
                                    class="mt-1 w-full text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2" />

                            </div>
                            
                            <div class="lg:col-span-2">
                                <div class="w-full">
                                    <label for="mothers_name" class="block text-lg font-medium text-gray-700 relative">Mother's Name</label>
                                    <input type="text" name="mothers_name" id="mothers_name" placeholder="Mother's Name"
                                        class="mt-1 w-full text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2 relative" />
                                </div>
                                <div class="md:flex">
                                    <div class="flex-1">
                                        <label for="occupation" class="block text-lg font-medium text-gray-700 relative">Occupation</label>
                                        <select id="mothers_occupation" name="mothers_occupation" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value="">-- Select Occupation --</option>
                                            @foreach ($occupations as $occupation)
                                                <option value="{{ $occupation->id }}">{{ $occupation->name }}</option>
                                             @endforeach
                                        </select>
                                    </div>
                                    <div class="flex-1">
                                        <label for="mothers_contact" class="block text-lg font-medium text-gray-700 relative">Contact Number</label>
                                        <input type="text" name="mothers_contact" id="mothers_contact" placeholder="Mobile No"
                                            class="mt-1 w-40 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2 relative" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Date of Birth -->
                    <label for="dob" class="block text-lg font-medium text-gray-700">Date of Birth</label>
                    <div class="w-full mt-4 flex">
                        <div class="flex-1">
                            <input type="date" id="dob" name="dob" placeholder="{{ $student->dob }}" class="mt-2 p-2 w-full border border-gray-300 rounded-md">
                        </div>
                        
                        <div class="w-24 mt-4 flex-1">
                            <button type="button" id="calculateAgeBtn" class="w-32 bg-blue-500 text-white p-1 rounded-md text-sm">Calculate Age</button>
                        </div>

                        {{-- <div id="ageResult" class="mt-4 hidden text-center text-xl text-gray-700"></div> --}}
                        <div class="mt-4 flex flex-wrap space-x-4">
                            <div class="flex-1">
                                <label for="ageYears" class="block text-gray-700 font-semibold">Age in Years</label>
                                <input type="number" id="ageYears" name="ageYears" class="mt-2 p-2 w-full border border-gray-300 rounded-md" readonly />
                            </div>
                            
                            <div class="flex-1">
                                <label for="ageMonths" class="block text-gray-700 font-semibold mt-4 sm:mt-0">Age in Months</label>
                                <input type="number" id="ageMonths" name="ageMonths" class="mt-2 p-2 w-full border border-gray-300 rounded-md" readonly />
                            </div>
                            
                            <div class="flex-1">
                                <label for="ageDays" class="block text-gray-700 font-semibold mt-4 sm:mt-0">Age in Days</label>
                                <input type="number" id="ageDays" name="ageDays" class="mt-2 p-2 w-full border border-gray-300 rounded-md" readonly />
                            </div>
                        </div>
                    </div>



                    <div class="lg:col-span-3 grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                        <!-- Religion -->
                        <div class="relative">
                            <label for="religion" class="block text-sm font-medium text-gray-700">Religion</label>
                            <select name="religion_id" id="religion_id"
                                class="mt-1 w-64 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2">
                                <option value="">{{ $student->rel_to_religion?->religion }}</option>
                                @foreach ($religions as $religion)
                                    <option value="{{ $religion->id }}">{{ $religion->religion }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Blood Group######## -->
                          <div class="relative">
                            <label for="blood-group" class="block text-sm font-medium text-gray-700">Blood Group</label>
                            <select id="blood_group_name" name="blood_group_name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="">{{ $student->rel_to_bloodGroup?->name }}</option>
                                @foreach ($bloodGroups as $bloodGroup)
                                    <option value="{{ $bloodGroup->name }}">{{ $bloodGroup->name }}</option>
                                @endforeach
                            </select>
                          </div>
                          
                        <!-- Nationality -->
                        <div class="relative">
                            <label for="nationality" class="block text-sm font-medium text-gray-700">Nationality</label>
                            <select id="nationality_id" name="nationality_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                              <option value="">{{ $student->rel_to_nationality?->name }}</option>
                              @foreach ($nationalities as $nationality)
                                <option value="{{ $nationality->id }}">{{ $nationality->name }}</option>
                              @endforeach
                            </select>
                        </div>


                        <!-- Birthplace -->
                        <div class="relative">
                            <label for="birthplace" class="block text-sm font-medium text-gray-700">Birthplace</label>
                            <select id="birthplace_id" name="birthplace_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="">{{ $student->rel_to_birthPlace?->name }}</option>
                                    @foreach ($birthPlaces as $birthPlace)
                                        <option value="{{ $birthPlace->id }}">{{ $birthPlace->name }}</option>
                                    @endforeach
                            </select>
                          </div>

                        <!-- Previous school -->
                        <div class="lg:col-span-3 w-full">
                            <label for="prev_school" class="block text-lg font-medium text-gray-700">Last Attended School's Name & Address</label>
                            <textarea id="prev_school" name="prev_school" placeholder="{{ $student->prev_school }}"
                                class="mt-1 w-full text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2 h-32"></textarea>
                        </div>

                        <!-- Present Address -->
                        <div class="lg:col-span-3 w-full">
                            <label for="present_address" class="block text-lg font-medium text-gray-700">Present Address</label>
                            <textarea id="present_address" name="present_address" placeholder="{{ $student->present_address }}"
                                class="mt-1 w-full text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2 h-32"></textarea>
                        </div>

                        <!-- Checkbox to make Permanent Address same as Present Address -->
                        <div class="lg:col-span-3 w-full">
                            <label for="same_as_present" class="inline-flex items-center">
                                <input type="checkbox" id="same_as_present" name="same_as_present" class="mr-2">
                                <span class="text-lg">Permanent Address is the same as Present Address</span>
                            </label>
                        </div>

                        <!-- Permanent Address -->
                        <div class="lg:col-span-3 w-full">
                            <label for="permanent_address" class="block text-lg font-medium text-gray-700">Permanent Address</label>
                            <textarea id="permanent_address" name="permanent_address" placeholder="{{ $student->permanent_address }}"
                                class="mt-1 w-full text-lg border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-3 py-2 h-32"></textarea>
                        </div>

                        <!-- Characteristics -->
                        {{-- <div class="lg:col-span-3 w-full">
                            <label class="block font-semibold text-gray-700 mb-2">Characteristics:</label>
                            <div class="flex flex-wrap gap-4">
                                @foreach (['Unsteady', 'Steady', 'Clever', 'Simple', 'Stubborn', 'Polite'] as $char)
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox" name="characteristics[]" value="{{ $char }}" class="text-blue-500 rounded">
                                        <span class="text-gray-800">{{ $char }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div> --}}

                        <!-- Remarks -->
                        <div class="lg:col-span-3 w-full">
                            <label for="remarks" class="block font-semibold text-gray-700 mb-2">Remarks:</label>
                            <textarea id="remarks" name="remarks" rows="3" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:border-blue-400"></textarea>
                        </div>

                        <!-- Status and Admission Test Marks -->
                        <div class="md:flex items-center gap-6">

                            <div class="flex-1">
                                <label class="block font-semibold mb-2">Status:</label>
                                <select id="status" name="status" class="w-full px-4 py-2 border p-2 rounded">
                                    <option value="0">Inactive</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>

                            <div class="flex-1">
                                <label for="marks" class="block font-semibold text-gray-700 mb-2">Admission Test Marks:</label>
                                <div class="flex items-center space-x-2">
                                    <input type="number" id="marks" name="marks" class="w-24 border border-gray-300 rounded-md p-2 focus:outline-none focus:ring focus:border-blue-400">
                                    <span class="text-gray-800 font-medium">%</span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Submit Button -->
                    <div class="mt-6">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded-md transition">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function updateImage(input, picId) {
            const pic = document.getElementById(picId);
            pic.src = window.URL.createObjectURL(input.files[0]);
        }
    </script>

<script>
    document.getElementById('calculateAgeBtn').addEventListener('click', function (event) {
    const dob = document.getElementById('dob').value;
    if (!dob) return;

    const birthDate = new Date(dob);
    const today = new Date();

    // Calculate the age in years
    let ageYears = today.getFullYear() - birthDate.getFullYear();
    const monthDifference = today.getMonth() - birthDate.getMonth();
    const dayDifference = today.getDate() - birthDate.getDate();

    // Adjust the age if the birthday hasn't occurred yet this year
    if (monthDifference < 0 || (monthDifference === 0 && dayDifference < 0)) {
        ageYears--;
    }

    // Calculate months
    let ageMonths = monthDifference < 0 ? 12 + monthDifference : monthDifference;

    // Adjust the day difference
    let ageDays = dayDifference < 0 ? new Date(today.getFullYear(), today.getMonth(), 0).getDate() + dayDifference : dayDifference;

    // Display the result in separate input fields
    document.getElementById('ageYears').value = ageYears;
    document.getElementById('ageMonths').value = ageMonths;
    document.getElementById('ageDays').value = ageDays;
});
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- <script>
  $(document).ready(function() {
    // Fetch the nationality data via AJAX
    $.ajax({
      url: '/get-nationalities',  // Your server endpoint that returns nationality data
      type: 'GET',
      success: function(data) {
        // Clear the initial "Loading..." option
        $('#nationality').empty();

        // Loop through the data and append each nationality to the dropdown
        data.nationalities.forEach(function(nationality) {
          $('#nationality').append(
            `<option value="${nationality.value}">${nationality.label}</option>`
          );
        });
      },
      error: function() {
        alert('Error loading nationalities');
      }
    });
  });
</script> --}}

{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Initialize the AJAX request
      var xhr = new XMLHttpRequest();
      xhr.open('GET', '/get-birthplaces', true);  // URL to fetch birthplaces
  
      // Set up a callback to handle the response
      xhr.onload = function () {
        if (xhr.status >= 200 && xhr.status < 300) {
          // Parse the JSON data from the response
          var data = JSON.parse(xhr.responseText);
          
          // Get the select element
          var selectElement = document.getElementById('birthplace');
          
          // Clear the loading message
          selectElement.innerHTML = '';
          
          // Populate the dropdown with received data
          data.birthplaces.forEach(function (birthplace) {
            var option = document.createElement('option');
            option.value = birthplace.value;
            option.textContent = birthplace.label;
            selectElement.appendChild(option);
          });
        } else {
          // Handle errors (if any)
          alert('Error loading birthplaces.');
        }
      };
  
      // Send the request to the server
      xhr.send();
    });
  </script> --}}


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

</x-app-layout>
