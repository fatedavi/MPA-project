<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Karyawan') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Nama User (Read-only) --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nama User</label>
                        <input type="text" value="{{ $employee->user->name }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100" readonly>
                    </div>

                    {{-- Nama --}}
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-bold mb-2">Nama</label>
                        <input type="text" name="name" id="name"
                            class="w-full border-gray-300 rounded-lg shadow-sm"
                            value="{{ old('name', $employee->name) }}">
                    </div>

                    {{-- No Tlp --}}
                    <div class="mb-4">
                        <label for="phone" class="block text-gray-700 font-bold mb-2">No Tlp</label>
                        <input type="text" name="phone" id="phone"
                            class="w-full border-gray-300 rounded-lg shadow-sm"
                            value="{{ old('phone', $employee->phone) }}">
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- No Emergency --}}
                    <div class="mb-4">
                        <label for="emergency_phone" class="block text-gray-700 font-bold mb-2">No Emergency</label>
                        <input type="text" name="emergency_phone" id="emergency_phone"
                            class="w-full border-gray-300 rounded-lg shadow-sm"
                            value="{{ old('emergency_phone', $employee->emergency_phone) }}">
                        @error('emergency_phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Alamat --}}
                    <div class="mb-4">
                        <label for="address" class="block text-gray-700 font-bold mb-2">Alamat</label>
                        <textarea name="address" id="address" rows="3" class="w-full border-gray-300 rounded-lg shadow-sm">{{ old('address', $employee->address) }}</textarea>
                        @error('address')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- NIK --}}
                    <div class="mb-4">
                        <label for="nik" class="block text-gray-700 font-bold mb-2">NIK</label>
                        <input type="text" name="nik" id="nik"
                            class="w-full border-gray-300 rounded-lg shadow-sm"
                            value="{{ old('nik', $employee->nik) }}">
                        @error('nik')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- KTP --}}
                    <div class="mb-4">
                        <label for="ktp" class="block text-gray-700 font-bold mb-2">KTP</label>
                        @if ($employee->ktp)
                            <p class="mb-2">
                                <a href="{{ asset('storage/' . $employee->ktp) }}" target="_blank"
                                    class="text-blue-600 underline">
                                    Lihat KTP Lama
                                </a>
                            </p>
                        @endif
                        <input type="file" name="ktp" id="ktp"
                            class="w-full border-gray-300 rounded-lg shadow-sm" accept="image/*,.pdf">
                        @error('ktp')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- KK --}}
                    <div class="mb-4">
                        <label for="kk" class="block text-gray-700 font-bold mb-2">KK</label>
                        @if ($employee->kk)
                            <p class="mb-2">
                                <a href="{{ asset('storage/' . $employee->kk) }}" target="_blank"
                                    class="text-blue-600 underline">
                                    Lihat KK Lama
                                </a>
                            </p>
                        @endif
                        <input type="file" name="kk" id="kk"
                            class="w-full border-gray-300 rounded-lg shadow-sm" accept="image/*,.pdf">
                        @error('kk')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Ijazah --}}
                    <div class="mb-4">
                        <label for="ijazah" class="block text-gray-700 font-bold mb-2">Ijazah</label>
                        @if ($employee->ijazah)
                            <p class="mb-2">
                                <a href="{{ asset('storage/' . $employee->ijazah) }}" target="_blank"
                                    class="text-blue-600 underline">
                                    Lihat Ijazah Lama
                                </a>
                            </p>
                        @endif
                        <input type="file" name="ijazah" id="ijazah"
                            class="w-full border-gray-300 rounded-lg shadow-sm" accept="image/*,.pdf">
                        @error('ijazah')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- CV --}}
                    <div class="mb-4">
                        <label for="cv" class="block text-gray-700 font-bold mb-2">CV</label>
                        @if ($employee->cv)
                            <p class="mb-2">
                                <a href="{{ asset('storage/' . $employee->cv) }}" target="_blank"
                                    class="text-blue-600 underline">
                                    Lihat CV Lama
                                </a>
                            </p>
                        @endif
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
                            class="w-full border-gray-300 rounded-lg shadow-sm"
                            value="{{ old('base_salary', $employee->base_salary) }}">
                        @error('base_salary')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Jabatan --}}
                    <div class="mb-4">
                        <label for="position" class="block text-gray-700 font-bold mb-2">Jabatan</label>
                        <select name="position" id="position" class="w-full border-gray-300 rounded-lg shadow-sm">
                            <option value="">-- Pilih Jabatan --</option>
                            <option value="Manager"
                                {{ old('position', $employee->position) == 'Manager' ? 'selected' : '' }}>Manager
                            </option>
                            <option value="Staff"
                                {{ old('position', $employee->position) == 'Staff' ? 'selected' : '' }}>Staff</option>
                            <option value="Admin"
                                {{ old('position', $employee->position) == 'Admin' ? 'selected' : '' }}>Admin</option>
                            <option value="Karyawan"
                                {{ old('position', $employee->position) == 'Karyawan' ? 'selected' : '' }}>Karyawan
                            </option>
                        </select>
                        @error('position')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                        <input type="email" name="email" id="email"
                            class="w-full border-gray-300 rounded-lg shadow-sm"
                            value="{{ old('email', $employee->email) }}">
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
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
