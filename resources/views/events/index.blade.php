<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-red-700 rounded-lg flex items-center justify-center shadow-lg">
                <i class="fas fa-calendar-alt text-white text-sm"></i>
            </div>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">Event Management</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Daftar Event</h1>
                        <p class="text-gray-600 text-base md:text-lg">Kelola semua event perusahaan dalam satu tempat
                        </p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('events.create') }}"
                            class="inline-flex items-center justify-center px-4 md:px-6 py-2 md:py-3 bg-red-700 hover:bg-red-800 text-white font-semibold rounded-lg md:rounded-xl shadow-lg hover:shadow-xl transition-all duration-200">
                            <i class="fas fa-plus mr-2"></i>
                            Tambah Event
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main Content Card -->
            <div class="bg-white shadow-lg rounded-lg md:rounded-2xl border border-gray-200 overflow-hidden">
                <!-- Search Bar -->
                <div class="px-4 md:px-6 lg:px-8 py-4 md:py-6 bg-gray-50 border-b border-gray-200">
                    <form method="GET" action="{{ route('events.index') }}"
                        class="flex flex-col sm:flex-row gap-3 md:gap-4">
                        <div class="flex-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-3 md:pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari event berdasarkan nama atau deskripsi..."
                                class="w-full pl-10 md:pl-12 pr-4 py-2 md:py-3 border border-gray-300 rounded-lg md:rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-700 placeholder-gray-500">
                        </div>
                        <button type="submit"
                            class="px-6 md:px-8 py-2 md:py-3 bg-red-700 hover:bg-red-800 text-white font-semibold rounded-lg md:rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 flex items-center justify-center">
                            <i class="fas fa-search mr-2"></i>
                            Cari
                        </button>
                    </form>
                </div>

                <!-- Success Message -->
                @if (session('success'))
                    <div
                        class="mx-4 md:mx-6 lg:mx-8 mt-4 md:mt-6 px-4 py-3 bg-green-50 border border-green-200 rounded-lg md:rounded-xl text-green-700 flex items-center">
                        <i class="fas fa-check-circle mr-2 text-green-500"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Desktop Table - Hidden on Mobile -->
                <div class="hidden lg:block overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    <div class="flex items-center space-x-2">
                                        <i class="fas fa-calendar text-red-700"></i>
                                        <span>Nama Event</span>
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    <div class="flex items-center space-x-2">
                                        <i class="fas fa-align-left text-red-700"></i>
                                        <span>Deskripsi</span>
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    <div class="flex items-center space-x-2">
                                        <i class="fas fa-clock text-red-700"></i>
                                        <span>Tanggal & Waktu</span>
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-4 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    <div class="flex items-center justify-end space-x-2">
                                        <i class="fas fa-gift text-red-700"></i>
                                        <span>Reward</span>
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    <div class="flex items-center justify-center space-x-2">
                                        <i class="fas fa-info-circle text-red-700"></i>
                                        <span>Status</span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($events as $event)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="w-10 h-10 bg-red-700 rounded-lg flex items-center justify-center shadow-md">
                                                <i class="fas fa-calendar text-white text-sm"></i>
                                            </div>
                                            <div>
                                                <div class="text-sm font-semibold text-gray-900">
                                                    {{ $event->name }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-700 max-w-xs">
                                            <div title="{{ $event->description ?? 'Tidak ada deskripsi' }}"
                                                class="truncate">
                                                {{ $event->description ?? 'Tidak ada deskripsi' }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-700">
                                            <div class="font-medium">{{ $event->date->format('d M Y') }}</div>
                                            <div class="text-gray-500">{{ $event->date->format('H:i') }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="text-sm font-semibold text-gray-900">
                                            Rp {{ number_format($event->reward, 0, ',', '.') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if ($event->status === 'approve')
                                            <span
                                                class="inline-flex items-center px-2.5 py-1.5 rounded-full text-xs font-semibold bg-green-100 text-green-800 border border-green-200">
                                                <i class="fas fa-check-circle mr-1.5 text-green-600"></i>
                                                Disetujui
                                            </span>
                                        @elseif($event->status === 'reject')
                                            <span
                                                class="inline-flex items-center px-2.5 py-1.5 rounded-full text-xs font-semibold bg-red-100 text-red-800 border border-red-200">
                                                <i class="fas fa-times-circle mr-1.5 text-red-600"></i>
                                                Ditolak
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-1.5 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800 border border-yellow-200">
                                                <i class="fas fa-clock mr-1.5 text-yellow-600"></i>
                                                Coming Soon
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center space-y-4">
                                            <div
                                                class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center">
                                                <i class="fas fa-calendar-times text-gray-400 text-2xl"></i>
                                            </div>
                                            <div class="text-gray-500">
                                                <div class="text-lg font-medium mb-1">Belum ada data event</div>
                                                <div class="text-sm">Mulai dengan menambahkan event pertama Anda</div>
                                            </div>
                                            <a href="{{ route('events.create') }}"
                                                class="inline-flex items-center px-4 py-2 bg-red-700 text-white text-sm font-medium rounded-lg hover:bg-red-800 transition-colors">
                                                <i class="fas fa-plus mr-2"></i>
                                                Tambah Event Pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Mobile & Tablet View -->
                <div class="lg:hidden">
                    <div class="divide-y divide-gray-200">
                        @forelse ($events as $event)
                            <div class="p-4 md:p-6 hover:bg-gray-50 transition-colors duration-150">
                                <!-- Event Header -->
                                <div class="flex items-center space-x-3 mb-4">
                                    <div
                                        class="w-12 h-12 bg-red-700 rounded-lg flex items-center justify-center shadow-md">
                                        <i class="fas fa-calendar text-white"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-lg font-semibold text-gray-900 truncate">
                                            {{ $event->name }}
                                        </h3>
                                    </div>
                                    <!-- Status Badge -->
                                    <div class="flex-shrink-0">
                                        @if ($event->status === 'approve')
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800 border border-green-200">
                                                <i class="fas fa-check-circle mr-1 text-green-600"></i>
                                                <span class="hidden sm:inline">Disetujui</span>
                                                <span class="sm:hidden">OK</span>
                                            </span>
                                        @elseif($event->status === 'reject')
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800 border border-red-200">
                                                <i class="fas fa-times-circle mr-1 text-red-600"></i>
                                                <span class="hidden sm:inline">Ditolak</span>
                                                <span class="sm:hidden">NO</span>
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800 border border-yellow-200">
                                                <i class="fas fa-clock mr-1 text-yellow-600"></i>
                                                <span class="hidden sm:inline">Coming Soon</span>
                                                <span class="sm:hidden">Wait</span>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Event Details -->
                                <div class="space-y-3">
                                    <div class="flex items-start space-x-3">
                                        <i class="fas fa-align-left text-red-700 mt-1 text-sm flex-shrink-0"></i>
                                        <div class="flex-1 text-sm text-gray-700">
                                            {{ $event->description ?? 'Tidak ada deskripsi' }}
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-3">
                                            <i class="fas fa-clock text-red-700 text-sm"></i>
                                            <div class="text-sm text-gray-700">
                                                <span class="font-medium">{{ $event->date->format('d M Y') }}</span>
                                                <span
                                                    class="text-gray-500 ml-2">{{ $event->date->format('H:i') }}</span>
                                            </div>
                                        </div>

                                        <div class="flex items-center space-x-2">
                                            <i class="fas fa-gift text-red-700 text-sm"></i>
                                            <div class="text-sm font-semibold text-gray-900">
                                                Rp {{ number_format($event->reward, 0, ',', '.') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-8 text-center">
                                <div class="flex flex-col items-center space-y-4">
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-calendar-times text-gray-400 text-2xl"></i>
                                    </div>
                                    <div class="text-gray-500">
                                        <div class="text-lg font-medium mb-1">Belum ada data event</div>
                                        <div class="text-sm">Mulai dengan menambahkan event pertama Anda</div>
                                    </div>
                                    <a href="{{ route('events.create') }}"
                                        class="inline-flex items-center px-4 py-2 bg-red-700 text-white text-sm font-medium rounded-lg hover:bg-red-800 transition-colors">
                                        <i class="fas fa-plus mr-2"></i>
                                        Tambah Event Pertama
                                    </a>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Pagination -->
                @if ($events->hasPages())
                    <div class="px-4 md:px-6 lg:px-8 py-4 md:py-6 bg-gray-50 border-t border-gray-200">
                        <div class="flex flex-col sm:flex-row items-center justify-between space-y-3 sm:space-y-0">
                            <div class="text-sm text-gray-700 text-center sm:text-left">
                                Menampilkan {{ $events->firstItem() ?? 0 }} - {{ $events->lastItem() ?? 0 }} dari
                                {{ $events->total() }} event
                            </div>
                            <div class="flex items-center space-x-2">
                                {{ $events->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
