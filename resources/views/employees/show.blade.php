<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Karyawan
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                {{-- Foto Profil --}}
                <div class="flex items-center gap-6 mb-6">
                    <div>
                        <h3 class="text-xl font-bold">{{ $employee->user->name }}</h3>
                        <p class="text-gray-600">{{ $employee->position }}</p>
                        <p class="text-gray-500 text-sm">Bergabung: {{ $employee->created_at->format('d M Y') }}</p>
                    </div>
                </div>

                {{-- Data Pribadi --}}
                <h4 class="text-lg font-semibold mb-2">Data Pribadi</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                    <p><strong>NIK:</strong> {{ $employee->nik ?? '-' }}</p>
                    <p><strong>Email:</strong> {{ $employee->user->email }}</p>
                    <p><strong>No. Telp:</strong> {{ $employee->phone ?? '-' }}</p>
                    <p><strong>No. Emergency:</strong> {{ $employee->emergency_phone ?? '-' }}</p>
                    <p><strong>Alamat:</strong> {{ $employee->address ?? '-' }}</p>
                    <p><strong>Gaji Pokok:</strong> Rp {{ number_format($employee->base_salary, 0, ',', '.') }}</p>
                </div>

                {{-- Dokumen --}}
                <h4 class="text-lg font-semibold mb-2">Dokumen</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <p><strong>KTP:</strong>
                        @if ($employee->ktp)
                            <a href="{{ asset('storage/' . $employee->ktp) }}" target="_blank"
                                class="text-blue-500">Lihat</a>
                        @else
                            -
                        @endif
                    </p>
                    <p><strong>KK:</strong>
                        @if ($employee->kk)
                            <a href="{{ asset('storage/' . $employee->kk) }}" target="_blank"
                                class="text-blue-500">Lihat</a>
                        @else
                            -
                        @endif
                    </p>
                    <p><strong>Ijazah:</strong>
                        @if ($employee->ijazah)
                            <a href="{{ asset('storage/' . $employee->ijazah) }}" target="_blank"
                                class="text-blue-500">Lihat</a>
                        @else
                            -
                        @endif
                    </p>
                    <p><strong>CV:</strong>
                        @if ($employee->cv)
                            <a href="{{ asset('storage/' . $employee->cv) }}" target="_blank"
                                class="text-blue-500">Lihat</a>
                        @else
                            -
                        @endif
                    </p>
                </div>

                {{-- Tombol Kembali --}}
                <div class="mt-6">
                    <a href="{{ route('employees.index') }}"
                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Kembali
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
