<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employees') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div
                    class="flex flex-col sm:flex-row sm:items-center sm:justify-between px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-700 flex items-center gap-2">
                        📋 Daftar Karyawan
                    </h3>
                    <a href="{{ route('employees.create') }}"
                        class="mt-3 sm:mt-0 inline-flex items-center gap-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white px-4 py-2 rounded-full shadow-md hover:shadow-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-200 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        <span class="font-medium">Tambah Karyawan</span>
                    </a>
                </div>

                {{-- Form Pencarian --}}
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <form method="GET" action="{{ route('employees.index') }}" class="flex gap-2">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari karyawan..."
                            class="w-full sm:w-64 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 text-sm">Cari</button>
                    </form>
                </div>

                @if (session('success'))
                    <div class="px-6 py-3 bg-green-100 border-b border-green-300 text-green-700 text-sm">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="bg-gray-50 text-gray-700 uppercase text-xs border-b border-gray-200">
                            <tr>
                                <th class="px-4 py-3">#</th>
                                <th class="px-4 py-3">Nama</th>
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3">No Telp</th>
                                <th class="px-4 py-3">Alamat</th>
                                <th class="px-4 py-3">Jabatan</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($employees as $employee)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3">
                                        {{ ($employees->currentPage() - 1) * $employees->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="px-4 py-3 font-medium text-gray-800">{{ $employee->name }}</td>
                                    <td class="px-4 py-3">{{ $employee->email }}</td>
                                    <td class="px-4 py-3">{{ $employee->phone ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $employee->address ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $employee->position }}</td>
                                    <td class="px-4 py-3 text-center space-x-1">
                                        {{-- Tombol Aksi --}}
                                        <a href="{{ route('employees.show', $employee) }}"
                                            class="inline-flex items-center justify-center w-8 h-8 bg-green-500 hover:bg-green-600 text-white rounded-full shadow-sm"
                                            title="Detail">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('employees.edit', $employee) }}"
                                            class="inline-flex items-center justify-center w-8 h-8 bg-yellow-500 hover:bg-yellow-600 text-white rounded-full shadow-sm"
                                            title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536M9 13l6-6 3.536 3.536L12 16.536H9v-3.536z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('employees.destroy', $employee) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Yakin ingin menghapus karyawan ini?')"
                                                class="inline-flex items-center justify-center w-8 h-8 bg-red-500 hover:bg-red-600 text-white rounded-full shadow-sm"
                                                title="Hapus">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22M9 3h6a1 1 0 011 1v2H8V4a1 1 0 011-1z" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-6 text-gray-500">Belum ada data karyawan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="px-6 py-4">
                    {{ $employees->links() }}
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
