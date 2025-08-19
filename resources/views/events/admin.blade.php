<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-gradient-to-r from-[#8D0907] to-[#B91C1C] rounded-lg flex items-center justify-center shadow-lg">
                <i class="fas fa-calendar-alt text-white text-sm"></i>
            </div>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">Event Management</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-[#8D0907] transition-colors">
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
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-200">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-400 rounded-xl shadow-lg">
                            <i class="fas fa-calendar text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-blue-100 text-sm font-medium">Total Event</p>
                            <p class="text-3xl font-bold">{{ $events->total() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-200">
                    <div class="flex items-center">
                        <div class="p-3 bg-yellow-400 rounded-xl shadow-lg">
                            <i class="fas fa-clock text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-yellow-100 text-sm font-medium">Coming Soon</p>
                            <p class="text-3xl font-bold">{{ $events->where('status', 'comingsoon')->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-200">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-400 rounded-xl shadow-lg">
                            <i class="fas fa-check-circle text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-green-100 text-sm font-medium">Disetujui</p>
                            <p class="text-3xl font-bold">{{ $events->where('status', 'approve')->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-200">
                    <div class="flex items-center">
                        <div class="p-3 bg-red-400 rounded-xl shadow-lg">
                            <i class="fas fa-times-circle text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-red-100 text-sm font-medium">Ditolak</p>
                            <p class="text-3xl font-bold">{{ $events->where('status', 'reject')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="bg-white shadow-xl rounded-2xl border border-gray-100 overflow-hidden">
                <div class="px-8 py-6 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <h3 class="text-xl font-semibold text-gray-700 flex items-center gap-3">
                            <i class="fas fa-check-double text-[#8D0907] text-2xl"></i>
                            Daftar Persetujuan Event
                        </h3>
                        <div class="mt-3 sm:mt-0">
                            <span class="text-sm text-gray-600 bg-white px-3 py-2 rounded-lg border border-gray-200">
                                <i class="fas fa-info-circle mr-2 text-[#8D0907]"></i>
                                Kelola persetujuan event karyawan
                            </span>
                        </div>
                    </div>
                </div>

                <div class="p-8">
                    <!-- Notifikasi sukses -->
                    @if (session('success'))
                        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-xl flex items-center shadow-sm">
                            <i class="fas fa-check-circle mr-3 text-green-500 text-lg"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Search Form -->
                    <div class="mb-8">
                        <form method="GET" action="{{ route('events.admin') }}" class="flex flex-col sm:flex-row gap-4">
                            <div class="flex-1 max-w-md">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-search text-gray-400"></i>
                                    </div>
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        placeholder="Cari nama atau deskripsi event..."
                                        class="block w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#8D0907] focus:border-[#8D0907] transition-all duration-200 text-gray-700 placeholder-gray-500">
                                </div>
                            </div>
                            <button type="submit" 
                                class="px-8 py-3 bg-gradient-to-r from-[#8D0907] to-[#B91C1C] hover:from-[#B91C1C] hover:to-[#8D0907] text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105 flex items-center justify-center">
                                <i class="fas fa-search mr-2"></i>
                                Cari
                            </button>
                        </form>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto rounded-xl border border-gray-200 shadow-sm">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                                <tr>
                                    <th class="px-8 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                        <div class="flex items-center space-x-2">
                                            <i class="fas fa-calendar text-[#8D0907]"></i>
                                            <span>Nama Event</span>
                                        </div>
                                    </th>
                                    <th class="px-8 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                        <div class="flex items-center space-x-2">
                                            <i class="fas fa-comment text-[#8D0907]"></i>
                                            <span>Deskripsi</span>
                                        </div>
                                    </th>
                                    <th class="px-8 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                        <div class="flex items-center space-x-2">
                                            <i class="fas fa-calendar-day text-[#8D0907]"></i>
                                            <span>Tanggal</span>
                                        </div>
                                    </th>
                                    <th class="px-8 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                        <div class="flex items-center space-x-2">
                                            <i class="fas fa-gift text-[#8D0907]"></i>
                                            <span>Reward</span>
                                        </div>
                                    </th>
                                    <th class="px-8 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                        <div class="flex items-center space-x-2">
                                            <i class="fas fa-info-circle text-[#8D0907]"></i>
                                            <span>Status</span>
                                        </div>
                                    </th>
                                    <th class="px-8 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                        <div class="flex items-center space-x-2">
                                            <i class="fas fa-cogs text-[#8D0907]"></i>
                                            <span>Aksi</span>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($events as $event)
                                    <tr class="hover:bg-gray-50 transition-all duration-200 group">
                                        <td class="px-8 py-6">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-10 h-10 bg-gradient-to-r from-[#8D0907] to-[#B91C1C] rounded-xl flex items-center justify-center text-white font-semibold text-sm shadow-md">
                                                    {{ substr($event->name, 0, 1) }}
                                                </div>
                                                <div>
                                                    <div class="text-sm font-semibold text-gray-900 group-hover:text-[#8D0907] transition-colors">
                                                        {{ $event->name }}
                                                    </div>
                                                    <div class="text-xs text-gray-500">ID: {{ $event->id }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-8 py-6">
                                            <div class="text-sm text-gray-700 max-w-xs truncate" title="{{ $event->description ?? 'Tidak ada deskripsi' }}">
                                                {{ $event->description ?? '-' }}
                                            </div>
                                        </td>
                                        <td class="px-8 py-6">
                                            <div class="text-sm text-gray-700">
                                                <div class="font-medium flex items-center">
                                                    <i class="fas fa-calendar-day mr-2 text-[#8D0907]"></i>
                                                    {{ $event->date->format('d M Y') }}
                                                </div>
                                                <div class="text-xs text-gray-500">
                                                    {{ $event->date->format('H:i') }} WIB
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-8 py-6">
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                                <i class="fas fa-gift mr-1.5"></i>
                                                Rp {{ number_format($event->reward, 0, ',', '.') }}
                                            </span>
                                        </td>
                                        <td class="px-8 py-6">
                                            @if ($event->status === 'approve')
                                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-green-100 text-green-800 border border-green-200">
                                                    <i class="fas fa-check-circle mr-1.5 text-green-600"></i>
                                                    Disetujui
                                                </span>
                                            @elseif($event->status === 'reject')
                                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-red-100 text-red-800 border border-red-200">
                                                    <i class="fas fa-times-circle mr-1.5 text-red-600"></i>
                                                    Ditolak
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">
                                                    <i class="fas fa-clock mr-1.5 text-yellow-600"></i>
                                                    Coming Soon
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-8 py-6">
                                            @if ($event->status === 'comingsoon')
                                                <form action="{{ route('events.updateStatus', $event->id) }}" method="POST"
                                                    class="flex gap-2">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" name="status" value="approve"
                                                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white text-sm font-medium rounded-lg shadow-md hover:shadow-lg transition-all duration-200 transform hover:scale-105">
                                                        <i class="fas fa-check mr-1.5"></i>
                                                        Approve
                                                    </button>
                                                    <button type="submit" name="status" value="reject"
                                                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white text-sm font-medium rounded-lg shadow-md hover:shadow-lg transition-all duration-200 transform hover:scale-105">
                                                        <i class="fas fa-times mr-1.5"></i>
                                                        Reject
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-sm text-gray-500 italic bg-gray-100 px-3 py-2 rounded-lg">
                                                    Tidak ada aksi
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-8 py-12 text-center">
                                            <div class="flex flex-col items-center space-y-4">
                                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center">
                                                    <i class="fas fa-calendar-times text-gray-400 text-2xl"></i>
                                                </div>
                                                <div class="text-gray-500">
                                                    <div class="text-lg font-medium mb-1">Belum ada data event</div>
                                                    <div class="text-sm">Data event akan muncul di sini</div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($events->hasPages())
                        <div class="mt-8 px-8 py-6 bg-gray-50 border-t border-gray-200 rounded-b-2xl">
                            <div class="flex items-center justify-between">
                                <div class="text-sm text-gray-700">
                                    Menampilkan {{ $events->firstItem() ?? 0 }} - {{ $events->lastItem() ?? 0 }} dari {{ $events->total() }} event
                                </div>
                                <div class="flex items-center space-x-2">
                                    {{ $events->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
