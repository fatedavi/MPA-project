<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Karyawan') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- Nama User (Read-only) --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama User</label>
                        <input type="text" value="{{ $employee->user->name }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 cursor-not-allowed"
                            readonly>
                    </div>

                    {{-- Grid Input --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Nama --}}
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                            <input type="text" name="name" id="name"
                                class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('name', $employee->name) }}">
                        </div>

                        {{-- No Tlp --}}
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">No Tlp</label>
                            <input type="text" name="phone" id="phone"
                                class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('phone', $employee->phone) }}">
                            @error('phone')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- No Emergency --}}
                        <div>
                            <label for="emergency_phone" class="block text-sm font-medium text-gray-700">No
                                Emergency</label>
                            <input type="text" name="emergency_phone" id="emergency_phone"
                                class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('emergency_phone', $employee->emergency_phone) }}">
                            @error('emergency_phone')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Alamat --}}
                        <div class="md:col-span-2">
                            <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                            <textarea name="address" id="address" rows="3"
                                class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('address', $employee->address) }}</textarea>
                            @error('address')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- NIK --}}
                        <div>
                            <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                            <input type="text" name="nik" id="nik"
                                class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('nik', $employee->nik) }}">
                            @error('nik')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Base Salary --}}
                        <div>
                            <label for="base_salary" class="block text-sm font-medium text-gray-700">Gaji Pokok</label>
                            <input type="number" name="base_salary" id="base_salary"
                                class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('base_salary', $employee->base_salary) }}">
                            @error('base_salary')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Jabatan --}}
                        <div>
                            <label for="position" class="block text-sm font-medium text-gray-700">Jabatan</label>
                            <select name="position" id="position"
                                class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">-- Pilih Jabatan --</option>
                                @foreach (['Manager', 'Staff', 'Admin', 'Karyawan'] as $pos)
                                    <option value="{{ $pos }}"
                                        {{ old('position', $employee->position) == $pos ? 'selected' : '' }}>
                                        {{ $pos }}</option>
                                @endforeach
                            </select>
                            @error('position')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email"
                                class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('email', $employee->email) }}">
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Dokumen Upload --}}
                    <div class="space-y-4">
                        @foreach (['ktp' => 'KTP', 'kk' => 'KK', 'ijazah' => 'Ijazah', 'cv' => 'CV'] as $field => $label)
                            <div>
                                <label for="{{ $field }}"
                                    class="block text-sm font-medium text-gray-700">{{ $label }}</label>
                                @if ($employee->$field)
                                    <p class="mb-2">
                                        <a href="{{ asset('storage/' . $employee->$field) }}" target="_blank"
                                            class="text-blue-600 underline">
                                            📄 Lihat {{ $label }} Lama
                                        </a>
                                    </p>
                                @endif
                                <input type="file" name="{{ $field }}" id="{{ $field }}"
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
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
                            class="flex items-center gap-2 bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                            <i class="fas fa-arrow-left"></i> Batal
                        </a>
                        <button type="submit"
                            class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                            <i class="fas fa-save"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
