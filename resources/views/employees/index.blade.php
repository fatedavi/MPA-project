<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employees') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-x-auto">
                <div class="flex justify-between mb-4">
                    <h3 class="text-lg font-semibold">Daftar Karyawan</h3>
                    <a href="{{ route('employees.create') }}"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        + Tambah Karyawan
                    </a>
                </div>

                @if (session('success'))
                    <div class="mb-4 text-green-600">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="w-full border-collapse border border-gray-300 text-sm">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-2 py-2">#</th>
                            <th class="border px-2 py-2">Nama</th>
                            <th class="border px-2 py-2">Email</th>
                            <th class="border px-2 py-2">No Telp</th>
                            <th class="border px-2 py-2">Alamat</th>
                            <th class="border px-2 py-2">Jabatan</th>
                            <th class="border px-2 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($employees as $employee)
                            <tr>
                                <td class="border px-2 py-2">{{ $loop->iteration }}</td>
                                <td class="border px-2 py-2">{{ $employee->name }}</td>
                                <td class="border px-2 py-2">{{ $employee->email }}</td>
                                <td class="border px-2 py-2">{{ $employee->phone ?? '-' }}</td>
                                <td class="border px-2 py-2">{{ $employee->address ?? '-' }}</td>
                                <td class="border px-2 py-2">{{ $employee->position }}</td>
                                <td class="border px-2 py-2 whitespace-nowrap">
                                    <a href="{{ route('employees.show', $employee) }}"
                                        class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                                        Detail
                                    </a>
                                    <a href="{{ route('employees.edit', $employee) }}"
                                        class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                        Edit
                                    </a>
                                    <form action="{{ route('employees.destroy', $employee) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"
                                            onclick="return confirm('Yakin ingin menghapus karyawan ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">Belum ada data karyawan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
