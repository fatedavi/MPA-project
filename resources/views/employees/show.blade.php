<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Karyawan
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                {{-- Foto Profil & Info Utama --}}
                <div class="flex items-center gap-6 mb-8">
                    <div class="w-20 h-20 rounded-full bg-gray-200 overflow-hidden flex items-center justify-center">
                        @if ($employee->photo ?? false)
                            <img src="{{ asset('storage/' . $employee->photo) }}" alt="Foto {{ $employee->user->name }}"
                                class="object-cover w-full h-full">
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5.121 17.804A9 9 0 1112 21a9 9 0 01-6.879-3.196z" />
                            </svg>
                        @endif
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $employee->user->name }}</h3>
                        <p class="text-blue-600 font-medium">{{ $employee->position }}</p>
                        <p class="text-gray-500 text-sm">Bergabung sejak {{ $employee->created_at->format('d M Y') }}
                        </p>
                    </div>
                </div>

                {{-- Data Pribadi --}}
                <div class="mb-8">
                    <h4 class="text-lg font-semibold mb-3 border-b pb-1">🧍 Data Pribadi</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-gray-700">
                        <p><span class="font-medium">NIK:</span> {{ $employee->nik ?? '-' }}</p>
                        <p><span class="font-medium">Email:</span> {{ $employee->user->email }}</p>
                        <p><span class="font-medium">No. Telp:</span> {{ $employee->phone ?? '-' }}</p>
                        <p><span class="font-medium">No. Emergency:</span> {{ $employee->emergency_phone ?? '-' }}</p>
                        <p><span class="font-medium">Alamat:</span> {{ $employee->address ?? '-' }}</p>
                        <p><span class="font-medium">Gaji Pokok:</span> Rp
                            {{ number_format($employee->base_salary, 0, ',', '.') }}</p>
                    </div>
                </div>

                {{-- Dokumen --}}
                <div class="mb-8">
                    <h4 class="text-lg font-semibold mb-3 border-b pb-1">📄 Dokumen</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-gray-700">
                        <p><span class="font-medium">KTP:</span>
                            @if ($employee->ktp)
                                <a href="{{ asset('storage/' . $employee->ktp) }}" target="_blank"
                                    class="text-blue-500 hover:underline">Lihat</a>
                            @else
                                -
                            @endif
                        </p>
                        <p><span class="font-medium">KK:</span>
                            @if ($employee->kk)
                                <a href="{{ asset('storage/' . $employee->kk) }}" target="_blank"
                                    class="text-blue-500 hover:underline">Lihat</a>
                            @else
                                -
                            @endif
                        </p>
                        <p><span class="font-medium">Ijazah:</span>
                            @if ($employee->ijazah)
                                <a href="{{ asset('storage/' . $employee->ijazah) }}" target="_blank"
                                    class="text-blue-500 hover:underline">Lihat</a>
                            @else
                                -
                            @endif
                        </p>
                        <p><span class="font-medium">CV:</span>
                            @if ($employee->cv)
                                <a href="{{ asset('storage/' . $employee->cv) }}" target="_blank"
                                    class="text-blue-500 hover:underline">Lihat</a>
                            @else
                                -
                            @endif
                        </p>
                    </div>
                </div>

                {{-- Tombol Kembali --}}
                <div class="mt-6">
                    <a href="{{ route('employees.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
