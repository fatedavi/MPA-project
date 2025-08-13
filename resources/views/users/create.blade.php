<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New User') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-2xl p-8 border border-gray-100">

                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-md">
                        <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('users.store') }}" class="space-y-5">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block font-semibold text-gray-700 mb-1">Name</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}"
                            class="w-full px-4 py-2 border-gray-300 rounded-lg shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] transition"
                            required>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block font-semibold text-gray-700 mb-1">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}"
                            class="w-full px-4 py-2 border-gray-300 rounded-lg shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] transition"
                            required>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Role -->
                    <div>
                        <label for="role" class="block font-semibold text-gray-700 mb-1">Role</label>
                        <select id="role" name="role"
                            class="w-full px-4 py-2 border-gray-300 rounded-lg shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] transition"
                            required>
                            <option value="">-- Select Role --</option>
                            <option value="super_admin" {{ old('role') == 'super_admin' ? 'selected' : '' }}>Super Admin
                            </option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="karyawan" {{ old('role') == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
                        </select>
                        @error('role')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block font-semibold text-gray-700 mb-1">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                            class="w-full px-4 py-2 border-gray-300 rounded-lg shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] transition" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block font-semibold text-gray-700 mb-1">Konfirmasi
                            Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            autocomplete="new-password"
                            class="w-full px-4 py-2 border-gray-300 rounded-lg shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] transition" />
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end gap-3 pt-4">
                        <a href="{{ route('users.index') }}"
                            class="inline-flex items-center px-5 py-2.5 border border-gray-300 rounded-lg font-semibold text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#8D0907] transition">
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-5 py-2.5 bg-[#8D0907] border border-transparent rounded-lg font-semibold text-white shadow-sm hover:bg-[#B91C1C] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#8D0907] transition">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
