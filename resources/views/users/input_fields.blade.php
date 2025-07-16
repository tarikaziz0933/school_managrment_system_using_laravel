
{{-- Nick Name --}}


{{-- Employee --}}
<div class="">
    <label for="employee_id" class="block text-sm font-medium text-gray-700 mb-2">Select Employee</label>
    <select id="employee_id" name="employee_id"
        class="w-full h-16 sm:h-12 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
        {{ $user?->userable ? 'disabled' : '' }}>
        <option value="{{ $user?->userable?->id }}">
            {{ $user?->userable?->name }}
        </option>
    </select>
</div>

{{-- Username --}}
<div>
    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
    <input type="text" id="username" name="username" value="{{ old('username', $user?->username) }}"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" required
        {{ $user?->userable ? 'disabled' : '' }}>
    @error('username')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>


<div>
    <label for="name" class="block text-sm font-medium text-gray-700">Nick Name</label>
    <input type="text" id="name" name="name" value="{{ old('name', $user?->name) }}"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" required>
    @error('name')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>





{{-- Password (optional) --}}
<div>
    <label for="password" class="block text-sm font-medium text-gray-700">New Password <span
            class="text-gray-500">(optional)</span></label>
    <input type="password" id="password" name="password"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
    @error('password')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>

{{-- Confirm Password (optional) --}}

<div>
    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password <span
            class="text-gray-500">(optional)</span></label>
    <input type="password" id="password_confirmation" name="password_confirmation"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
    @error('password_confirmation')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>

{{-- Roles --}}
<div>
    <label for="roles" class="block text-sm font-medium text-gray-700">Roles</label>
    <select id="roles" name="roles[]" multiple
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
        @foreach ($roles as $id => $name)
            <option value="{{ $id }}" {{ $user?->roles?->pluck('id')->contains($id) ? 'selected' : '' }}>
                {{ $name }}
            </option>
        @endforeach
    </select>
    @error('roles')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror

    <script>
        $(document).ready(function() {
            $('#roles').select2({
                placeholder: "Select roles",
                allowClear: true
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#employee_id').select2({
                placeholder: 'Search for an employee...',
                ajax: {
                    url: '/api/employees/select2',
                    dataType: 'json',
                    delay: 250, // wait 250ms after typing before request
                    processResults: function(data) {
                        return {
                            results: data.data.map(function(item) {
                                return {
                                    id: item.id,
                                    text: item.name,
                                    photo_url: item.photo_url
                                };
                            })
                        };
                    },
                    cache: true
                },
                templateResult: formatEmployeeResult,
                templateSelection: formatEmployeeSelection,
                minimumInputLength: 1, // Start searching after 1 character
                escapeMarkup: function(markup) {
                    return markup;
                } // Allow HTML
            });

            function formatEmployeeResult(employee) {
                if (!employee.id) {
                    return employee.text;
                }
                var photoUrl = employee.photo_url || '/default-photo.png';
                var markup = `
                <div class="flex items-center">
                    <img src="${photoUrl}" class="w-6 h-6 rounded-full mr-2" />
                    <span>${employee.text}</span>
                </div>
            `;
                return markup;
            }

            function formatEmployeeSelection(employee) {
                return employee.text || employee.id;
            }
        });
    </script>


    <script>
        $(document).ready(function() {
            $('#employee_id').on('change', function() {
                // Get the selected option text
                let employeeName = $(this).find('option:selected').text();

                // Convert to lowercase
                let username = employeeName.toLowerCase()
                    // Replace . and space and other special chars with underscore
                    .replace(/[^a-z0-9]/g, '_')
                    // Replace multiple underscores with single underscore
                    .replace(/_+/g, '_')
                    // Remove leading or trailing underscores
                    .replace(/^_+|_+$/g, '');

                // Set it to the username input
                $('#username').val(username);
            });
        });
    </script>


</div>
