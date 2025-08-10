<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Karyawan') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Pilih User --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="user_id">
                            Pilih User
                        </label>
                        <select name="user_id" id="user_id" class="w-full border-gray-300 rounded-lg shadow-sm">
                            <option value="">-- Pilih User --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- NIK --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="nik">
                            NIK
                        </label>
                        <input type="text" name="nik" id="nik"
                               class="w-full border-gray-300 rounded-lg shadow-sm"
                               placeholder="Masukkan NIK" value="{{ old('nik') }}">
                        @error('nik')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Pilih Jabatan --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="position">
                            Jabatan
                        </label>
                        <select name="position" id="position" class="w-full border-gray-300 rounded-lg shadow-sm">
                            <option value="">-- Pilih Jabatan --</option>
                            <option value="Manager">Manager</option>
                            <option value="Staff">Staff</option>
                            <option value="Admin">Admin</option>
                        </select>
                        @error('position')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Base Salary --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="base_salary">
                            Base Salary
                        </label>
                        <input type="number" name="base_salary" id="base_salary" 
                               class="w-full border-gray-300 rounded-lg shadow-sm" 
                               placeholder="Masukkan gaji pokok" value="{{ old('base_salary') }}">
                        @error('base_salary')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Foto Profil --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="photo">
                            Foto Profil
                        </label>
                        <input type="file" name="photo" id="photo"
                               class="w-full border-gray-300 rounded-lg shadow-sm"
                               accept="image/*">
                        @error('photo')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tombol Submit --}}
                    <div class="flex justify-end">
                        <a href="{{ route('employees.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2">
                            Batal
                        </a>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                            Simpan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
