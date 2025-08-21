<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Event Management') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-red-700">
                            <i class="fas fa-home mr-2"></i>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right w-6 h-6 text-gray-400"></i>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Event Management</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Search and Filters -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-700 flex items-center gap-2">
                        <i class="fas fa-search text-red-700"></i>
                        Search & Filters
                    </h3>
                </div>
                <div class="p-6">
                    <form method="GET" action="{{ route('events.index') }}">
                        <div
                            class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                            <!-- Search -->
                            <div class="flex-1 max-w-md">
                                <label for="search" class="sr-only">Search events</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-search text-gray-400"></i>
                                    </div>
                                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-red-700 focus:border-red-700 transition-colors"
                                        placeholder="Cari event berdasarkan nama atau deskripsi...">
                                </div>
                            </div>

                            <!-- Filters -->
                            <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                                <select name="status"
                                    class="block w-full sm:w-auto border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-red-700 focus:border-red-700 transition-colors">
                                    <option value="">All Status</option>
                                    <option value="approve" {{ request('status') == 'approve' ? 'selected' : '' }}>
                                        Disetujui</option>
                                    <option value="reject" {{ request('status') == 'reject' ? 'selected' : '' }}>Ditolak
                                    </option>
                                    <option value="coming_soon"
                                        {{ request('status') == 'coming_soon' ? 'selected' : '' }}>Coming Soon</option>
                                </select>

                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-700 transition-colors">
                                    <i class="fas fa-filter mr-2"></i>
                                    Filter
                                </button>

                                <a href="{{ route('events.create') }}"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600 transition-colors">
                                    <i class="fas fa-plus mr-2"></i>
                                    Tambah Event
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div
                    class="mb-6 px-4 py-3 bg-green-50 border border-green-200 rounded-lg text-green-700 flex items-center">
                    <i class="fas fa-check-circle mr-2 text-green-500"></i>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Events Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <h3 class="text-lg font-semibold text-gray-700 flex items-center gap-2">
                            <i class="fas fa-calendar-alt text-red-700"></i>
                            Daftar Event
                        </h3>
                        <div class="mt-2 sm:mt-0">
                            <span class="text-sm text-gray-500">
                                <i class="fas fa-info-circle mr-1"></i>
                                Total: {{ $events->total() }} events
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Desktop Table -->
                <div class="hidden lg:block overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-calendar mr-2"></i>Nama Event
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-align-left mr-2"></i>Deskripsi
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-clock mr-2"></i>Tanggal & Waktu
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-gift mr-2"></i>Reward
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-info-circle mr-2"></i>Status
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($events as $event)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="w-10 h-10 bg-red-700 rounded-lg flex items-center justify-center text-white font-semibold">
                                                <i class="fas fa-calendar text-sm"></i>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
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
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            <i class="fas fa-calendar-day mr-1 text-red-700"></i>
                                            {{ $event->date->format('d M Y') }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $event->date->format('H:i') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <div class="text-sm font-semibold text-gray-900">
                                            Rp {{ number_format($event->reward, 0, ',', '.') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if ($event->status === 'approve')
                                            <span
                                                class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium border bg-green-100 text-green-800 border-green-200">
                                                <i class="fas fa-check-circle mr-1.5 text-green-600"></i>
                                                Disetujui
                                            </span>
                                        @elseif($event->status === 'reject')
                                            <span
                                                class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium border bg-red-100 text-red-800 border-red-200">
                                                <i class="fas fa-times-circle mr-1.5 text-red-600"></i>
                                                Ditolak
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium border bg-yellow-100 text-yellow-800 border-yellow-200">
                                                <i class="fas fa-clock mr-1.5 text-yellow-600"></i>
                                                Coming Soon
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center text-gray-500">
                                            <i class="fas fa-calendar-times text-4xl mb-3 text-gray-300"></i>
                                            <p class="text-lg font-medium">Belum ada data event</p>
                                            <p class="text-sm mb-4">Data event akan muncul di sini</p>
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
                <div class="lg:hidden divide-y divide-gray-200">
                    @forelse ($events as $event)
                        <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
                            <!-- Event Header -->
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-3">
                                    <div
                                        class="w-12 h-12 bg-red-700 rounded-lg flex items-center justify-center text-white font-semibold">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <h3 class="text-lg font-semibold text-gray-900 truncate">
                                            {{ $event->name }}
                                        </h3>
                                    </div>
                                </div>
                                <!-- Status Badge -->
                                <div class="flex-shrink-0">
                                    @if ($event->status === 'approve')
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium border bg-green-100 text-green-800 border-green-200">
                                            <i class="fas fa-check-circle mr-1 text-green-600"></i>
                                            <span class="hidden sm:inline">Disetujui</span>
                                            <span class="sm:hidden">OK</span>
                                        </span>
                                    @elseif($event->status === 'reject')
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium border bg-red-100 text-red-800 border-red-200">
                                            <i class="fas fa-times-circle mr-1 text-red-600"></i>
                                            <span class="hidden sm:inline">Ditolak</span>
                                            <span class="sm:hidden">NO</span>
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium border bg-yellow-100 text-yellow-800 border-yellow-200">
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
                                            <span class="text-gray-500 ml-2">{{ $event->date->format('H:i') }}</span>
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
                            <div class="flex flex-col items-center text-gray-500">
                                <i class="fas fa-calendar-times text-4xl mb-3 text-gray-300"></i>
                                <p class="text-lg font-medium">Belum ada data event</p>
                                <p class="text-sm mb-4">Data event akan muncul di sini</p>
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
                <div class="mt-6">
                    {{ $events->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
