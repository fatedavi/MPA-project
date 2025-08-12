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


                    {{-- <div class="mb-4">
                        <label for="user_id" class="block text-sm font-medium text-gray-700">Pilih User</label>
                        <select name="user_id" id="user_id"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                            <option value="">-- Pilih User --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <select name="user_id" id="user_id" class="select2 w-full">
                        <option value="">-- Pilih User --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>



                    {{-- Nama --}}
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-bold mb-2">Nama</label>
                        <input type="text" name="name" id="name"
                            class="w-full border-gray-300 rounded-lg shadow-sm" placeholder="Masukkan nama"
                            value="{{ old('name') }}">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- No Tlp --}}
                    <div class="mb-4">
                        <label for="phone" class="block text-gray-700 font-bold mb-2">No Tlp</label>
                        <input type="number" name="phone" id="phone"
                            class="w-full border-gray-300 rounded-lg shadow-sm" placeholder="Masukkan nomor telepon"
                            value="{{ old('phone') }}">
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- No Emergency --}}
                    <div class="mb-4">
                        <label for="emergency_phone" class="block text-gray-700 font-bold mb-2">No Emergency</label>
                        <input type="number" name="emergency_phone" id="emergency_phone"
                            class="w-full border-gray-300 rounded-lg shadow-sm" placeholder="Masukkan nomor darurat"
                            value="{{ old('emergency_phone') }}">
                        @error('emergency_phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Alamat --}}
                    <div class="mb-4">
                        <label for="address" class="block text-gray-700 font-bold mb-2">Alamat</label>
                        <textarea name="address" id="address" rows="3" class="w-full border-gray-300 rounded-lg shadow-sm"
                            placeholder="Masukkan alamat">{{ old('address') }}</textarea>
                        @error('address')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- NIK --}}
                    <div class="mb-4">
                        <label for="nik" class="block text-gray-700 font-bold mb-2">NIK</label>
                        <input type="number" name="nik" id="nik"
                            class="w-full border-gray-300 rounded-lg shadow-sm" placeholder="Masukkan NIK"
                            value="{{ old('nik') }}">
                        @error('nik')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- KTP --}}
                    <div class="mb-4">
                        <label for="ktp" class="block text-gray-700 font-bold mb-2">KTP</label>
                        <input type="file" name="ktp" id="ktp"
                            class="w-full border-gray-300 rounded-lg shadow-sm" accept="image/*,.pdf">
                        @error('ktp')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- KK --}}
                    <div class="mb-4">
                        <label for="kk" class="block text-gray-700 font-bold mb-2">KK</label>
                        <input type="file" name="kk" id="kk"
                            class="w-full border-gray-300 rounded-lg shadow-sm" accept="image/*,.pdf">
                        @error('kk')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Ijazah --}}
                    <div class="mb-4">
                        <label for="ijazah" class="block text-gray-700 font-bold mb-2">Ijazah</label>
                        <input type="file" name="ijazah" id="ijazah"
                            class="w-full border-gray-300 rounded-lg shadow-sm" accept="image/*,.pdf">
                        @error('ijazah')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- CV --}}
                    <div class="mb-4">
                        <label for="cv" class="block text-gray-700 font-bold mb-2">CV</label>
                        <input type="file" name="cv" id="cv"
                            class="w-full border-gray-300 rounded-lg shadow-sm" accept="image/*,.pdf">
                        @error('cv')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Base Salary --}}
                    <div class="mb-4">
                        <label for="base_salary" class="block text-gray-700 font-bold mb-2">Base Salary</label>
                        <input type="number" name="base_salary" id="base_salary"
                            class="w-full border-gray-300 rounded-lg shadow-sm" placeholder="Masukkan gaji pokok"
                            value="{{ old('base_salary') }}">
                        @error('base_salary')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Jabatan --}}
                    <div class="mb-4">
                        <label for="position" class="block text-gray-700 font-bold mb-2">Jabatan</label>
                        <select name="position" id="position" class="w-full border-gray-300 rounded-lg shadow-sm">
                            <option value="">-- Pilih Jabatan --</option>
                            <option value="Manager">Manager</option>
                            <option value="Staff">Staff</option>
                            <option value="Admin">Admin</option>
                            <option value="Karyawan">Karyawan</option>
                        </select>
                        @error('position')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                        <input type="email" name="email" id="email"
                            class="w-full border-gray-300 rounded-lg shadow-sm" placeholder="Masukkan email"
                            value="{{ old('email') }}">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tombol Submit --}}
                    <div class="flex justify-end">
                        <a href="{{ route('employees.index') }}"
                            class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2">
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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#user_id').select2({
            placeholder: "-- Pilih User --",
            allowClear: true
        });
    });
</script>
