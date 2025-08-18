<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Karyawan') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf

                    {{-- Pilih User --}}
                    <div>
                        <label for="user_id" class="block text-sm font-medium text-gray-700">User</label>
                        <select name="user_id" id="user_id"
                            class="select2 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Pilih User --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Grid Input --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                            <input type="text" name="name" id="name"
                                class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Masukkan nama" value="{{ old('name') }}">
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">No Tlp</label>
                            <input type="number" name="phone" id="phone"
                                class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Masukkan nomor telepon" value="{{ old('phone') }}">
                            @error('phone')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="emergency_phone" class="block text-sm font-medium text-gray-700">No
                                Emergency</label>
                            <input type="number" name="emergency_phone" id="emergency_phone"
                                class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Masukkan nomor darurat" value="{{ old('emergency_phone') }}">
                            @error('emergency_phone')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                            <input type="number" name="nik" id="nik"
                                class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Masukkan NIK" value="{{ old('nik') }}">
                            @error('nik')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="base_salary" class="block text-sm font-medium text-gray-700">Gaji Pokok</label>
                            <input type="number" name="base_salary" id="base_salary"
                                class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Masukkan gaji pokok" value="{{ old('base_salary') }}">
                            @error('base_salary')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="position" class="block text-sm font-medium text-gray-700">Jabatan</label>
                            <select name="position" id="position"
                                class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">-- Pilih Jabatan --</option>
                                @foreach (['Manager', 'Staff', 'Admin', 'Karyawan'] as $pos)
                                    <option value="{{ $pos }}"
                                        {{ old('position') == $pos ? 'selected' : '' }}>{{ $pos }}</option>
                                @endforeach
                            </select>
                            @error('position')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                            <textarea name="address" id="address" rows="3"
                                class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Masukkan alamat">{{ old('address') }}</textarea>
                            @error('address')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email"
                                class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Masukkan email" value="{{ old('email') }}">
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Dokumen Upload --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach (['ktp' => 'KTP', 'kk' => 'KK', 'ijazah' => 'Ijazah', 'cv' => 'CV'] as $field => $label)
                            <div>
                                <label for="{{ $field }}"
                                    class="block text-sm font-medium text-gray-700">{{ $label }}</label>
                                <input type="file" name="{{ $field }}" id="{{ $field }}"
                                    class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    accept="image/*,.pdf">
                                @error($field)
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        @endforeach
                    </div>

                    {{-- Tombol Submit --}}
                    <div class="flex justify-end gap-3 pt-4">
                        <a href="{{ route('employees.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Batal
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-[#8D0907] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#B91C1C] focus:bg-[#B91C1C] active:bg-[#8D0907] focus:outline-none focus:ring-2 focus:ring-[#8D0907] focus:ring-offset-2 transition ease-in-out duration-150">
                            <i class="fas fa-save mr-2"></i>
                            Simpan
                        </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#user_id').select2({
            placeholder: "-- Pilih User --",
            allowClear: true
        });
    });
</script> --}}
