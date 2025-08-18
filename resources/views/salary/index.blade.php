<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Laporan Gaji Karyawan Bulan
            {{ \Carbon\Carbon::now()->format('F Y') }}</h2>
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
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Gaji</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-400 rounded-full">
                            <i class="fas fa-users text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-green-100 text-sm font-medium">Total Karyawan</p>
                            <p class="text-2xl font-bold">{{ $employees->total() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-400 rounded-full">
                            <i class="fas fa-money-bill-wave text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-blue-100 text-sm font-medium">Total Gaji</p>
                            <p class="text-2xl font-bold">Rp {{ number_format(collect($salaryData)->sum('total_salary'), 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="p-3 bg-yellow-400 rounded-full">
                            <i class="fas fa-calendar-check text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-yellow-100 text-sm font-medium">Bulan</p>
                            <p class="text-2xl font-bold">{{ \Carbon\Carbon::now()->format('M Y') }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="p-3 bg-purple-400 rounded-full">
                            <i class="fas fa-chart-line text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-purple-100 text-sm font-medium">Rata-rata Gaji</p>
                            <p class="text-2xl font-bold">Rp {{ number_format(collect($salaryData)->avg('total_salary'), 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <h3 class="text-lg font-semibold text-gray-700 flex items-center gap-2">
                            <i class="fas fa-money-bill-wave text-[#8D0907]"></i>
                            Daftar Gaji Karyawan
                        </h3>
                        <div class="mt-2 sm:mt-0">
                            <span class="text-sm text-gray-500">
                                <i class="fas fa-info-circle mr-1"></i>
                                Periode: {{ \Carbon\Carbon::now()->format('F Y') }}
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

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                        <div class="flex flex-wrap gap-3">
                            <!-- Tombol Simpan Gaji -->
                            <a href="{{ route('salary.save') }}"
                                class="flex items-center gap-2 bg-gradient-to-r from-green-500 to-green-700 text-white px-6 py-3 rounded-lg shadow-md hover:shadow-lg hover:from-green-600 hover:to-green-800 transition-all duration-300 ease-in-out">
                                <i class="fas fa-save text-lg"></i>
                                <span class="font-medium">Simpan Gaji Bulan Ini</span>
                            </a>

                            <!-- Tombol Lihat Riwayat -->
                            <a href="{{ route('salary.history') }}"
                                class="flex items-center gap-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white px-6 py-3 rounded-lg shadow-md hover:shadow-lg hover:from-blue-600 hover:to-blue-800 transition-all duration-300 ease-in-out">
                                <i class="fas fa-history text-lg"></i>
                                <span class="font-medium">Lihat Riwayat Gaji</span>
                            </a>
                        </div>

                        <!-- Search Form -->
                        <form method="GET" action="{{ route('salary.index') }}" class="flex items-center gap-3">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                                <input type="text" name="search" value="{{ request('search') }}" 
                                    placeholder="Cari nama karyawan..."
                                    class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8D0907] focus:border-[#8D0907] transition-colors" />
                            </div>
                            <button type="submit" 
                                class="bg-[#8D0907] text-white px-4 py-2 rounded-lg hover:bg-[#6B0705] transition-colors flex items-center gap-2">
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
                                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-dollar-sign mr-2"></i>Base Salary
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-gift mr-2"></i>Bonus Attendance
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-star mr-2"></i>Reward Event
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-calendar mr-2"></i>Cuti (Hari)
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-minus-circle mr-2"></i>Potongan Cuti
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-calculator mr-2"></i>Total Gaji
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($salaryData as $data)
                                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-gradient-to-r from-[#8D0907] to-[#B91C1C] rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                                    {{ substr($data['employee']->name, 0, 1) }}
                                                </div>
                                                <div class="ml-3">
                                                    <div class="text-sm font-medium text-gray-900">{{ $data['employee']->name }}</div>
                                                    <div class="text-sm text-gray-500">{{ $data['employee']->email ?? 'N/A' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <span class="text-sm font-medium text-gray-900">
                                                Rp {{ number_format($data['base_salary'], 0, ',', '.') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                <i class="fas fa-plus mr-1"></i>
                                                Rp {{ number_format($data['total_bonus'], 0, ',', '.') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <i class="fas fa-star mr-1"></i>
                                                Rp {{ number_format($data['total_event_reward'], 0, ',', '.') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <i class="fas fa-calendar mr-1"></i>
                                                {{ $data['total_cuti_days'] }} hari
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <span class="text-sm font-medium text-red-600">
                                                - Rp {{ number_format($data['potongan_cuti'], 0, ',', '.') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-green-100 text-green-800 border border-green-200">
                                                <i class="fas fa-check-circle mr-1.5"></i>
                                                Rp {{ number_format($data['total_salary'], 0, ',', '.') }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center text-gray-500">
                                                <i class="fas fa-inbox text-4xl mb-3 text-gray-300"></i>
                                                <p class="text-lg font-medium">Belum ada data gaji</p>
                                                <p class="text-sm">Data gaji karyawan akan muncul di sini</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($employees->hasPages())
                        <div class="mt-6">
                            {{ $employees->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
