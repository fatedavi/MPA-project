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
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <div class="bg-blue-500 rounded-lg shadow p-4 text-white">
                    <div class="flex items-center">
                        <div class="p-2 bg-blue-400 rounded">
                            <i class="fas fa-calendar text-lg"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-blue-100 text-sm">Total Event</p>
                            <p class="text-2xl font-bold">{{ isset($events) ? $events->total() : 0 }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-yellow-500 rounded-lg shadow p-4 text-white">
                    <div class="flex items-center">
                        <div class="p-2 bg-yellow-400 rounded">
                            <i class="fas fa-clock text-lg"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-yellow-100 text-sm">Coming Soon</p>
                            <p class="text-2xl font-bold">{{ isset($events) ? $events->where('status', 'comingsoon')->count() : 0 }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-green-500 rounded-lg shadow p-4 text-white">
                    <div class="flex items-center">
                        <div class="p-2 bg-green-400 rounded">
                            <i class="fas fa-check-circle text-lg"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-green-100 text-sm">Disetujui</p>
                            <p class="text-2xl font-bold">{{ isset($events) ? $events->where('status', 'approve')->count() : 0 }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-red-500 rounded-lg shadow p-4 text-white">
                    <div class="flex items-center">
                        <div class="p-2 bg-red-400 rounded">
                            <i class="fas fa-times-circle text-lg"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-red-100 text-sm">Ditolak</p>
                            <p class="text-2xl font-bold">{{ isset($events) ? $events->where('status', 'reject')->count() : 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="bg-white shadow rounded-lg border overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <h3 class="text-lg font-medium text-gray-700 flex items-center gap-2">
                            <i class="fas fa-list-check text-blue-600"></i>
                            Daftar Persetujuan Event
                        </h3>
                        <div class="mt-2 sm:mt-0">
                            <span class="text-sm text-gray-600 bg-white px-3 py-1 rounded border">
                                <i class="fas fa-info-circle mr-1 text-blue-600"></i>
                                Kelola persetujuan event karyawan
                            </span>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <!-- Notifikasi sukses -->
                    @if (session('success'))
                        <div class="mb-4 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded flex items-center">
                            <i class="fas fa-check-circle mr-2 text-green-500"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-4 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded flex items-center">
                            <i class="fas fa-exclamation-circle mr-2 text-red-500"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Search Form -->
                    <div class="mb-6">
                        <form method="GET" action="{{ route('events.admin') }}" class="flex flex-col sm:flex-row gap-3">
                            <div class="flex-1 max-w-md">
                                <div class="relative">
                                    <input type="text" name="search" value="{{ request('search') ?? '' }}"
                                        placeholder="Cari nama atau deskripsi event..."
                                        class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-search text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" 
                                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                                <i class="fas fa-search mr-2"></i>
                                Cari
                            </button>
                        </form>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto border border-gray-200 rounded">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <div class="flex items-center space-x-1">
                                            <i class="fas fa-calendar text-blue-600"></i>
                                            <span>Nama Event</span>
                                        </div>
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <div class="flex items-center space-x-1">
                                            <i class="fas fa-comment text-blue-600"></i>
                                            <span>Deskripsi</span>
                                        </div>
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <div class="flex items-center space-x-1">
                                            <i class="fas fa-calendar-day text-blue-600"></i>
                                            <span>Tanggal</span>
                                        </div>
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <div class="flex items-center space-x-1">
                                            <i class="fas fa-gift text-blue-600"></i>
                                            <span>Reward</span>
                                        </div>
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <div class="flex items-center space-x-1">
                                            <i class="fas fa-info-circle text-blue-600"></i>
                                            <span>Status</span>
                                        </div>
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <div class="flex items-center space-x-1">
                                            <i class="fas fa-cogs text-blue-600"></i>
                                            <span>Aksi</span>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @if(isset($events) && $events->count() > 0)
                                    @foreach ($events as $event)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center space-x-2">
                                                    <div class="w-8 h-8 bg-blue-600 rounded flex items-center justify-center text-white font-medium text-sm">
                                                        {{ isset($event->name) && !empty($event->name) ? strtoupper(substr($event->name, 0, 1)) : 'E' }}
                                                    </div>
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $event->name ?? 'Event Tanpa Nama' }}
                                                        </div>
                                                        <div class="text-xs text-gray-500">ID: {{ $event->id ?? '-' }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-700 max-w-xs truncate" title="{{ $event->description ?? 'Tidak ada deskripsi' }}">
                                                    {{ $event->description ?? '-' }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-700">
                                                    @if(isset($event->date))
                                                        <div class="font-medium flex items-center">
                                                            <i class="fas fa-calendar-day mr-1 text-blue-600"></i>
                                                            {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}
                                                        </div>
                                                        <div class="text-xs text-gray-500">
                                                            {{ \Carbon\Carbon::parse($event->date)->format('H:i') }} WIB
                                                        </div>
                                                    @else
                                                        <span class="text-gray-400">Tanggal tidak tersedia</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                @if(isset($event->reward) && $event->reward > 0)
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        <i class="fas fa-gift mr-1"></i>
                                                        Rp {{ number_format($event->reward, 0, ',', '.') }}
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                        <i class="fas fa-minus mr-1"></i>
                                                        Tidak ada
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                @if (($event->status ?? '') === 'approve')
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        <i class="fas fa-check-circle mr-1 text-green-600"></i>
                                                        Disetujui
                                                    </span>
                                                @elseif(($event->status ?? '') === 'reject')
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                        <i class="fas fa-times-circle mr-1 text-red-600"></i>
                                                        Ditolak
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                        <i class="fas fa-clock mr-1 text-yellow-600"></i>
                                                        Coming Soon
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-8 py-6">
                                                @if (($event->status ?? 'comingsoon') === 'comingsoon')
                                                    <div class="flex space-x-2">
                                                        <!-- Form Approve -->
                                                        <form action="{{ route('events.updateStatus', $event->id ?? $event->event_id ?? '') }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="approve">
                                                            <button type="submit" 
                                                                class="px-3 py-1 bg-green-600 hover:bg-green-700 text-white text-xs font-medium rounded border-0"
                                                                onclick="return confirm('Apakah Anda yakin ingin menyetujui event ini?')">
                                                                <i class="fas fa-check mr-1"></i>
                                                                Setuju
                                                            </button>
                                                        </form>
                                                        <!-- Form Reject -->
                                                        <form action="{{ route('events.updateStatus', $event->id ?? $event->event_id ?? '') }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="reject">
                                                            <button type="submit" 
                                                                class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded border-0"
                                                                onclick="return confirm('Apakah Anda yakin ingin menolak event ini?')">
                                                                <i class="fas fa-times mr-1"></i>
                                                                Tolak
                                                            </button>
                                                        </form>
                                                    </div>
                                                @else
                                                    <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">
                                                        {{ ucfirst($event->status ?? 'processed') }}
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="px-6 py-8 text-center">
                                            <div class="flex flex-col items-center space-y-2">
                                                <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center">
                                                    <i class="fas fa-calendar-times text-gray-400 text-xl"></i>
                                                </div>
                                                <div class="text-gray-500">
                                                    <div class="text-base font-medium mb-1">Belum ada data event</div>
                                                    <div class="text-sm">Data event akan muncul di sini</div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if(isset($events) && method_exists($events, 'hasPages') && $events->hasPages())
                        <div class="mt-6 px-6 py-4 bg-gray-50 border-t">
                            <div class="flex items-center justify-between">
                                <div class="text-sm text-gray-700">
                                    Menampilkan {{ $events->firstItem() ?? 0 }} - {{ $events->lastItem() ?? 0 }} dari {{ $events->total() ?? 0 }} event
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