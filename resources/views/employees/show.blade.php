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
                @if($employee->photo)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $employee->photo) }}" alt="Foto Profil"
                             class="w-32 h-32 object-cover rounded-full border">
                    </div>
                @endif

                <p><strong>NIK:</strong> {{ $employee->nik }}</p>
                <p><strong>Nama:</strong> {{ $employee->user->name }}</p>
                <p><strong>Email:</strong> {{ $employee->user->email }}</p>
                <p><strong>Jabatan:</strong> {{ $employee->position }}</p>
                <p><strong>Gaji Pokok:</strong> Rp {{ number_format($employee->base_salary, 0, ',', '.') }}</p>
                <p><strong>Dibuat pada:</strong> {{ $employee->created_at->format('d M Y') }}</p>

                <a href="{{ route('employees.index') }}"
                   class="mt-4 inline-block bg-gray-500 text-white px-4 py-2 rounded">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
