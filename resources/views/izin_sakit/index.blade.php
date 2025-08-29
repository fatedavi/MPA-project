<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Izin Sakit Management') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-[#8D0907]">
                            <i class="fas fa-home mr-2"></i>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right w-6 h-6 text-gray-400"></i>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Izin Sakit</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-400 rounded-full">
                            <i class="fas fa-notes-medical text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-blue-100 text-sm font-medium">Total Pengajuan</p>
                            <p class="text-2xl font-bold">{{ $izin->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-400 rounded-full">
                            <i class="fas fa-check-circle text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-green-100 text-sm font-medium">Disetujui</p>
                            <p class="text-2xl font-bold">{{ $izin->where('status', 'approved')->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="p-3 bg-yellow-400 rounded-full">
                            <i class="fas fa-hourglass-half text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-yellow-100 text-sm font-medium">Menunggu</p>
                            <p class="text-2xl font-bold">{{ $izin->where('status', 'pending')->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="p-3 bg-red-400 rounded-full">
                            <i class="fas fa-times-circle text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-red-100 text-sm font-medium">Ditolak</p>
                            <p class="text-2xl font-bold">{{ $izin->where('status', 'rejected')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <h3 class="text-lg font-semibold text-gray-700 flex items-center gap-2">
                            <i class="fas fa-notes-medical text-[#8D0907]"></i>
                            Daftar Pengajuan Izin Sakit
                        </h3>
               @if(auth()->check() && auth()->user()->role === 'karyawan')
                    <div class="mt-2 sm:mt-0">
                        <a href="{{ route('izin-sakit.create') }}" 
                            class="inline-flex items-center px-4 py-2 bg-[#8D0907] text-white rounded-lg hover:bg-[#6B0705] transition-colors shadow-md hover:shadow-lg">
                            <i class="fas fa-plus mr-2"></i>
                            Ajukan Izin
                        </a>
                    </div>
                @endif

                    </div>
                </div>

                <div class="p-6">
                    @if(session('success'))
                        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center">
                            <i class="fas fa-check-circle mr-2 text-green-500"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Table -->
                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Karyawan</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Alasan</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Surat Dokter</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($izin as $index => $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4">{{ $item->employee->name ?? '-' }}</td>
                                    <td class="px-6 py-4">{{ $item->alasan ?? 'Tidak ada alasan' }}</td>
                                    <td class="px-6 py-4">
                                        <a href="{{ Storage::url($item->dokter_surat) }}" target="_blank" class="text-blue-600 hover:underline">
                                            Lihat Surat
                                        </a>
                                    </td>
                                    </td>
                                            <td class="px-6 py-4">
                                                @if ($item->status == 'approved')
                                                    <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs">Disetujui</span>
                                                    @if($item->approvedBy)
                                                        <div class="text-xs text-gray-500">
                                                            Oleh: {{ $item->approvedBy->name }}
                                                        </div>
                                                    @endif
                                                @elseif ($item->status == 'rejected')
                                                    <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs">Ditolak</span>
                                                    <div class="text-xs text-gray-500">Alasan: {{ $item->keterangan_admin }}</div>
                                                    @if($item->rejectedBy)
                                                        <div class="text-xs text-gray-500">
                                                            Oleh: {{ $item->rejectedBy->name }}
                                                        </div>
                                                    @endif
                                                @else
                                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs">Menunggu</span>
                                                @endif
                                            </td>

                                    <td class="px-6 py-4 flex gap-2">
                                        @if(in_array(auth()->user()->role, ['admin','super_admin']) && $item->status == 'pending')
                                            <form action="{{ route('izin-sakit.approve', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">
                                                    Approve
                                                </button>
                                            </form>

                                            <!-- Reject with reason -->
                                            <form action="{{ route('izin-sakit.reject', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="text" name="keterangan_penolakan" placeholder="Alasan" required
                                                    class="border rounded px-2 py-1 text-sm">
                                                <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                                    Tolak
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-gray-400 text-sm">-</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center text-gray-500">
                                            <i class="fas fa-notes-medical text-4xl mb-3 text-gray-300"></i>
                                            <p class="text-lg font-medium">Belum ada pengajuan izin sakit</p>
                                            <p class="text-sm">Pengajuan izin sakit akan muncul di sini</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
