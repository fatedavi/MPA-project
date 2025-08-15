<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Vendor Management
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Tombol Tambah Vendor -->
            <div class="mb-4 flex justify-end">
                <a href="{{ route('vendors.create') }}" 
                   class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow">
                    + Tambah Vendor
                </a>
            </div>

            <!-- Tabel Vendor -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full border border-gray-200">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2 border">Kode</th>
                            <th class="px-4 py-2 border">Nama</th>
                            <th class="px-4 py-2 border">Alamat</th>
                            <th class="px-4 py-2 border">Kota</th>
                            <th class="px-4 py-2 border">UP</th>
                            <th class="px-4 py-2 border">No Telp</th>
                            <th class="px-4 py-2 border">Email</th>
                            <th class="px-4 py-2 border text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vendors as $vendor)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border">{{ $vendor->id_vendor }}</td>
                                <td class="px-4 py-2 border">{{ $vendor->nama_vendor }}</td>
                                <td class="px-4 py-2 border">{{ $vendor->alamat_vendor }}</td>
                                <td class="px-4 py-2 border">{{ $vendor->kota }}</td>
                                <td class="px-4 py-2 border">{{ $vendor->up_vendor }}</td>
                                <td class="px-4 py-2 border">{{ $vendor->no_telp }}</td>
                                <td class="px-4 py-2 border">{{ $vendor->email_vendor }}</td>
                                <td class="px-4 py-2 border text-center space-x-2">
                                    <a href="{{ route('vendors.edit', $vendor->id_vendor) }}" 
                                       class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white text-xs rounded">
                                        Edit
                                    </a>
                                    <form action="{{ route('vendors.destroy', $vendor->id_vendor) }}" 
                                          method="POST" 
                                          class="inline-block"
                                          onsubmit="return confirm('Yakin ingin menghapus vendor ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-xs rounded">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-4 text-center text-gray-500">
                                    Tidak ada data vendor.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
