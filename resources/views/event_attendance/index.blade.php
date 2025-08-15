<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Kehadiran Event</h2>
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
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Event Attendance</span>
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
                            <p class="text-blue-100 text-sm font-medium">Total Kehadiran</p>
                            <p class="text-2xl font-bold">{{ $attendances->total() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-400 rounded-full">
                            <i class="fas fa-calendar text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-green-100 text-sm font-medium">Total Event</p>
                            <p class="text-2xl font-bold">{{ $attendances->groupBy('event.name')->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="p-3 bg-purple-400 rounded-full">
                            <i class="fas fa-users text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-purple-100 text-sm font-medium">Total Karyawan</p>
                            <p class="text-2xl font-bold">{{ $attendances->groupBy('employee.name')->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="p-3 bg-orange-400 rounded-full">
                            <i class="fas fa-clock text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-orange-100 text-sm font-medium">Hari Ini</p>
                            <p class="text-2xl font-bold">{{ $attendances->where('created_at', '>=', now()->startOfDay())->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <h3 class="text-lg font-semibold text-gray-700 flex items-center gap-2">
                            <i class="fas fa-user-check text-[#8D0907]"></i>
                            Daftar Kehadiran Event Karyawan
                        </h3>
                        <div class="mt-2 sm:mt-0">
                            <span class="text-sm text-gray-500">
                                <i class="fas fa-info-circle mr-1"></i>
                                Kelola kehadiran karyawan di berbagai event
                            </span>
                        </div>
                    </div>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Notifikasi -->
                    @if (session('success'))
                        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center">
                            <i class="fas fa-check-circle mr-2 text-green-500"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Action Buttons & Search -->
                    <div class="flex flex-col sm:flex-row sm:justify-between items-center gap-4">
                        <!-- Search Form -->
                        <form method="GET" action="{{ route('event-attendances.index') }}" class="flex gap-3">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                                <input type="text" name="search" value="{{ $search ?? '' }}"
                                    placeholder="Cari nama pegawai atau event..."
                                    class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8D0907] focus:border-[#8D0907] transition-colors">
                            </div>
                            <button type="submit" 
                                class="bg-[#8D0907] text-white px-4 py-2 rounded-lg hover:bg-[#6B0705] transition-colors flex items-center gap-2">
                                <i class="fas fa-search"></i>
                                Cari
                            </button>
                        </form>

                        <!-- Add Button -->
                        <a href="{{ route('event-attendances.create') }}"
                            class="inline-flex items-center px-6 py-2 bg-[#8D0907] text-white rounded-lg hover:bg-[#6B0705] transition-colors shadow-md hover:shadow-lg">
                            <i class="fas fa-plus mr-2"></i>
                            Tambah Kehadiran
                        </a>
                    </div>

                    @php
                        $groupedAttendances = $attendances->groupBy('event.name');
                    @endphp

                    <!-- List Event -->
                    @forelse ($groupedAttendances as $eventName => $eventAttendances)
                        <div class="rounded-lg overflow-hidden border border-gray-200 shadow-sm">
                            <div class="px-6 py-4 bg-gradient-to-r from-[#8D0907] to-[#B91C1C] text-white">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg font-semibold flex items-center gap-2">
                                        <i class="fas fa-calendar mr-2"></i>
                                        {{ $eventName }}
                                    </h3>
                                    <span class="text-sm bg-white bg-opacity-20 px-3 py-1 rounded-full">
                                        {{ $eventAttendances->count() }} peserta
                                    </span>
                                </div>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                <i class="fas fa-hashtag mr-2"></i>#
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                <i class="fas fa-user mr-2"></i>Pegawai
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                <i class="fas fa-calendar-day mr-2"></i>Tanggal Daftar
                                            </th>
                                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                <i class="fas fa-cogs mr-2"></i>Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($eventAttendances as $index => $attendance)
                                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                                <td class="px-6 py-4">
                                                    <span class="inline-flex items-center justify-center w-6 h-6 bg-gray-100 text-gray-600 text-xs font-medium rounded-full">
                                                        {{ $index + 1 }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center">
                                                        <div class="w-8 h-8 bg-gradient-to-r from-[#8D0907] to-[#B91C1C] rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                                            {{ substr($attendance->employee->name, 0, 1) }}
                                                        </div>
                                                        <div class="ml-3">
                                                            <div class="text-sm font-medium text-gray-900">{{ $attendance->employee->name }}</div>
                                                            <div class="text-sm text-gray-500">{{ $attendance->employee->email ?? 'N/A' }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="text-sm text-gray-900">
                                                        <i class="fas fa-calendar-day mr-1 text-[#8D0907]"></i>
                                                        {{ $attendance->created_at->format('d M Y') }}
                                                    </div>
                                                    <div class="text-xs text-gray-500">
                                                        {{ $attendance->created_at->format('H:i') }} WIB
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 text-right">
                                                    <form action="{{ route('event-attendances.destroy', $attendance->id) }}"
                                                        method="POST" onsubmit="return confirm('Hapus data kehadiran ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="inline-flex items-center px-3 py-1.5 text-xs text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors">
                                                            <i class="fas fa-trash mr-1"></i>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12 bg-gray-50 rounded-lg border-2 border-dashed border-gray-300">
                            <div class="flex flex-col items-center text-gray-500">
                                <i class="fas fa-calendar-times text-4xl mb-3 text-gray-300"></i>
                                <h3 class="text-lg font-medium text-gray-900">Belum ada data kehadiran</h3>
                                <p class="text-sm text-gray-500 mt-1">Mulai dengan menambahkan data kehadiran baru.</p>
                                <a href="{{ route('event-attendances.create') }}" 
                                    class="mt-4 inline-flex items-center px-4 py-2 bg-[#8D0907] text-white rounded-lg hover:bg-[#6B0705] transition-colors">
                                    <i class="fas fa-plus mr-2"></i>
                                    Tambah Kehadiran Pertama
                                </a>
                            </div>
                        </div>
                    @endforelse

                    <!-- Pagination -->
                    @if($attendances->hasPages())
                        <div class="mt-6">
                            {{ $attendances->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
