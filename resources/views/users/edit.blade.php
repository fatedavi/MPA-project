<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg p-6">

            @if ($errors->any())
                <div class="mb-4">
                    <ul class="list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block font-medium text-gray-700 mb-1">Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required
                        class="border-gray-300 rounded-md shadow-sm w-full focus:ring-[#8D0907] focus:border-[#8D0907]" />
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block font-medium text-gray-700 mb-1">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
                        class="border-gray-300 rounded-md shadow-sm w-full focus:ring-[#8D0907] focus:border-[#8D0907]" />
                </div>

                <!-- Role -->
                <div class="mb-4">
                    <label for="role" class="block font-medium text-gray-700 mb-1">Role</label>
                    <select id="role" name="role" required
                        class="border-gray-300 rounded-md shadow-sm w-full focus:ring-[#8D0907] focus:border-[#8D0907]">
                        <option value="super_admin" {{ old('role', $user->role) == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="karyawan" {{ old('role', $user->role) == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
                    </select>
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block font-medium text-gray-700 mb-1">New Password (optional)</label>
                    <input id="password" name="password" type="password" autocomplete="new-password"
                        class="border-gray-300 rounded-md shadow-sm w-full focus:ring-[#8D0907] focus:border-[#8D0907]" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block font-medium text-gray-700 mb-1">Confirm New Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                        class="border-gray-300 rounded-md shadow-sm w-full focus:ring-[#8D0907] focus:border-[#8D0907]" />
                </div>

                <div class="flex items-center space-x-4">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-[#8D0907] border border-transparent rounded-md font-semibold text-white hover:bg-[#B91C1C] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#8D0907] transition-colors">
                        Update User
                    </button>

                    <a href="{{ route('users.index') }}"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#8D0907] transition-colors">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
