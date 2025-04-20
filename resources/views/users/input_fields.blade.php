{{-- Profile Image --}}
<div>
    <label class="block text-sm font-medium text-gray-700">Profile Image</label>

    <div class="mb-3">
        <img id="pic1" class="w-48 h-48 object-cover rounded-lg border"
                src="{{ $user?->image?->url ?? asset('images/blank-profile-pic.png') }}"
                 />
    </div>

    <input type="file" name="image" oninput="updateImage(this, 'pic1')"
        class="mt-1 block w-full text-sm border border-gray-300 rounded-md shadow-sm file:bg-blue-600 file:text-white file:rounded file:px-4 file:py-2 file:border-0">
    @error('image')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>


{{-- Name --}}
<div>
    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
    <input type="text" id="name" name="name" value="{{ old('name', $user?->name) }}"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" required>
    @error('name')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>

{{-- Email --}}
<div>
    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
    <input type="email" id="email" name="email" value="{{ old('email', $user?->email) }}"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" required>
    @error('email')
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
        function updateImage(input, picId) {
            const pic = document.getElementById(picId);
            pic.src = window.URL.createObjectURL(input.files[0]);
        }
    </script>

</div>
