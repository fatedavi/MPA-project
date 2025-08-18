<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Event</h2>
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
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Event Approve</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-400 rounded-full">
                            <i class="fas fa-calendar text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-blue-100 text-sm font-medium">Total Event</p>
                            <p class="text-2xl font-bold">{{ $events->total() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="p-3 bg-yellow-400 rounded-full">
                            <i class="fas fa-clock text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-yellow-100 text-sm font-medium">Coming Soon</p>
                            <p class="text-2xl font-bold">{{ $events->where('status', 'comingsoon')->count() }}</p>
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
                            <p class="text-2xl font-bold">{{ $events->where('status', 'approve')->count() }}</p>
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
                            <p class="text-2xl font-bold">{{ $events->where('status', 'reject')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <h3 class="text-lg font-semibold text-gray-700 flex items-center gap-2">
                            <i class="fas fa-check-double text-[#8D0907]"></i>
                            Daftar Persetujuan Event
                        </h3>
                        <div class="mt-2 sm:mt-0">
                            <span class="text-sm text-gray-500">
                                <i class="fas fa-info-circle mr-1"></i>
                                Kelola persetujuan event karyawan
                            </span>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <!-- Notifikasi sukses -->
                    @if (session('success'))
                        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center">
                            <i class="fas fa-check-circle mr-2 text-green-500"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Search Form -->
                    <div class="mb-6">
                        <form method="GET" action="{{ route('events.admin') }}" class="flex gap-3">
                            <div class="flex-1 max-w-md">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-search text-gray-400"></i>
                                    </div>
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        placeholder="Cari nama atau deskripsi event..."
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
                                        <i class="fas fa-calendar mr-2"></i>Nama Event
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-comment mr-2"></i>Deskripsi
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-calendar-day mr-2"></i>Tanggal
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-gift mr-2"></i>Reward
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-info-circle mr-2"></i>Status
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-cogs mr-2"></i>Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($events as $event)
                                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-gradient-to-r from-[#8D0907] to-[#B91C1C] rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                                    {{ substr($event->name, 0, 1) }}
                                                </div>
                                                <div class="ml-3">
                                                    <div class="text-sm font-medium text-gray-900">{{ $event->name }}</div>
                                                    <div class="text-sm text-gray-500">ID: {{ $event->id }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900 max-w-xs truncate" title="{{ $event->description ?? 'Tidak ada deskripsi' }}">
                                                {{ $event->description ?? '-' }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">
                                                <i class="fas fa-calendar-day mr-1 text-[#8D0907]"></i>
                                                {{ $event->date->format('d M Y') }}
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                {{ $event->date->format('H:i') }} WIB
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-gift mr-1"></i>
                                                Rp {{ number_format($event->reward, 0, ',', '.') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($event->status === 'approve')
                                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-green-100 text-green-800 border border-green-200">
                                                    <i class="fas fa-check-circle mr-1.5"></i>
                                                    Disetujui
                                                </span>
                                            @elseif($event->status === 'reject')
                                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-red-100 text-red-800 border border-red-200">
                                                    <i class="fas fa-times-circle mr-1.5"></i>
                                                    Ditolak
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">
                                                    <i class="fas fa-clock mr-1.5"></i>
                                                    Coming Soon
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($event->status === 'comingsoon')
                                                <form action="{{ route('events.updateStatus', $event->id) }}" method="POST"
                                                    class="flex gap-2">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" name="status" value="approve"
                                                        class="inline-flex items-center px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white text-sm rounded-lg transition-colors">
                                                        <i class="fas fa-check mr-1"></i>
                                                        Approve
                                                    </button>
                                                    <button type="submit" name="status" value="reject"
                                                        class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-sm rounded-lg transition-colors">
                                                        <i class="fas fa-times mr-1"></i>
                                                        Reject
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-sm text-gray-500 italic">Tidak ada aksi</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center text-gray-500">
                                                <i class="fas fa-calendar-times text-4xl mb-3 text-gray-300"></i>
                                                <p class="text-lg font-medium">Belum ada data event</p>
                                                <p class="text-sm">Data event akan muncul di sini</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($events->hasPages())
                        <div class="mt-6">
                            {{ $events->withQueryString()->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
