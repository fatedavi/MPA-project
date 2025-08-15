<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Pengajuan Cuti
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
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Daftar Cuti</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-400 rounded-full">
                            <i class="fas fa-calendar-check text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-blue-100 text-sm font-medium">Total Pengajuan</p>
                            <p class="text-2xl font-bold">{{ $cuti->total() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="p-3 bg-yellow-400 rounded-full">
                            <i class="fas fa-clock text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-yellow-100 text-sm font-medium">Menunggu Approval</p>
                            <p class="text-2xl font-bold">{{ $cuti->where('status', 'requested')->count() }}</p>
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
                            <p class="text-2xl font-bold">{{ $cuti->where('status', 'approved')->count() }}</p>
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
                            <p class="text-2xl font-bold">{{ $cuti->where('status', 'rejected')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <h3 class="text-lg font-semibold text-gray-700 flex items-center gap-2">
                            <i class="fas fa-list-alt text-[#8D0907]"></i>
                            Daftar Cuti Karyawan
                        </h3>
                        <div class="mt-2 sm:mt-0">
                            <span class="text-sm text-gray-500">
                                <i class="fas fa-info-circle mr-1"></i>
                                Kelola pengajuan cuti karyawan
                            </span>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <!-- Search Form -->
                    <div class="mb-6">
                        <form method="GET" action="{{ route('cuti.admin.index') }}" class="flex gap-3">
                            <div class="flex-1 max-w-md">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-search text-gray-400"></i>
                                    </div>
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        placeholder="Cari nama, tanggal, atau keterangan..."
                                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8D0907] focus:border-[#8D0907] transition-colors">
                                </div>
                            </div>
                            <button type="submit"
                                class="bg-[#8D0907] text-white px-6 py-2 rounded-lg hover:bg-[#6B0705] transition-colors flex items-center gap-2">
                                <i class="fas fa-search"></i>
                                Cari
                            </button>
                        </form>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-user mr-2"></i>Nama Karyawan
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-calendar mr-2"></i>Tanggal
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-clock mr-2"></i>Durasi
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-comment mr-2"></i>Keterangan
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-info-circle mr-2"></i>Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($cuti as $item)
                                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-gradient-to-r from-[#8D0907] to-[#B91C1C] rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                                    {{ substr($item->employee->name, 0, 1) }}
                                                </div>
                                                <div class="ml-3">
                                                    <div class="text-sm font-medium text-gray-900">{{ $item->employee->name }}</div>
                                                    <div class="text-sm text-gray-500">{{ $item->employee->email ?? 'N/A' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">
                                                <i class="fas fa-calendar-day mr-1 text-[#8D0907]"></i>
                                                {{ $item->tanggal }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                <i class="fas fa-clock mr-1"></i>
                                                {{ $item->day }} hari
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900 max-w-xs truncate" title="{{ $item->description }}">
                                                {{ $item->description }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($item->status === 'requested')
                                                <div class="flex gap-2">
                                                    <form action="{{ route('cuti.approve', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                            class="inline-flex items-center px-3 py-1.5 bg-green-500 text-white text-sm rounded-lg hover:bg-green-600 transition-colors"
                                                            title="Setujui">
                                                            <i class="fas fa-check mr-1"></i>
                                                            Setujui
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('cuti.reject', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                            class="inline-flex items-center px-3 py-1.5 bg-red-500 text-white text-sm rounded-lg hover:bg-red-600 transition-colors"
                                                            title="Tolak">
                                                            <i class="fas fa-times mr-1"></i>
                                                            Tolak
                                                        </button>
                                                    </form>
                                                </div>
                                            @else
                                                @php
                                                    $badgeColor = match ($item->status) {
                                                        'approved' => 'bg-green-100 text-green-800 border-green-200',
                                                        'rejected' => 'bg-red-100 text-red-800 border-red-200',
                                                        default => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                                    };
                                                    $icon = match ($item->status) {
                                                        'approved' => 'fas fa-check-circle',
                                                        'rejected' => 'fas fa-times-circle',
                                                        default => 'fas fa-clock',
                                                    };
                                                @endphp
                                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium border {{ $badgeColor }}">
                                                    <i class="{{ $icon }} mr-1.5"></i>
                                                    {{ ucfirst($item->status) }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center text-gray-500">
                                                <i class="fas fa-inbox text-4xl mb-3 text-gray-300"></i>
                                                <p class="text-lg font-medium">Belum ada pengajuan cuti</p>
                                                <p class="text-sm">Semua pengajuan cuti akan muncul di sini</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($cuti->hasPages())
                        <div class="mt-6">
                            {{ $cuti->appends(request()->query())->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
