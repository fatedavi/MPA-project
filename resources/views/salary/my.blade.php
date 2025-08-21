<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Salary History') }}
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
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Salary History</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Employee Info Card -->
            <div class="bg-gradient-to-r from-[#8D0907] to-[#B91C1C] rounded-lg shadow-lg p-6 text-white mb-6">
                <div class="flex items-center">
                    <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center text-2xl font-bold">
                        {{ substr($employee->name, 0, 2) }}
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-bold">{{ $employee->name }}</h3>
                        <p class="text-red-100">
                            <i class="fas fa-id-badge mr-2"></i>
                            Employee ID: {{ $employee->id }}
                        </p>
                        <p class="text-red-100">
                            <i class="fas fa-calendar mr-2"></i>
                            Riwayat Gaji Karyawan
                        </p>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-400 rounded-full">
                            <i class="fas fa-plus-circle text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-green-100 text-sm font-medium">Total Bonus Absen</p>
                            <p class="text-xl font-bold">Rp {{ number_format($salaries->sum('total_bonus') / 1000000, 1) }}M</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-400 rounded-full">
                            <i class="fas fa-gift text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-blue-100 text-sm font-medium">Total Event Reward</p>
                            <p class="text-xl font-bold">Rp {{ number_format($salaries->sum('total_event_reward') / 1000000, 1) }}M</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="p-3 bg-red-400 rounded-full">
                            <i class="fas fa-minus-circle text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-red-100 text-sm font-medium">Total Potongan Cuti</p>
                            <p class="text-xl font-bold">Rp {{ number_format($salaries->sum('potongan_cuti') / 1000000, 1) }}M</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="p-3 bg-purple-400 rounded-full">
                            <i class="fas fa-calculator text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-purple-100 text-sm font-medium">Total Gaji</p>
                            <p class="text-xl font-bold">Rp {{ number_format($salaries->sum('total_salary') / 1000000, 1) }}M</p>
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
                            Riwayat Gaji {{ $employee->name }}
                        </h3>
                        <div class="mt-2 sm:mt-0">
                            <span class="text-sm text-gray-500">
                                <i class="fas fa-info-circle mr-1"></i>
                                Detail pembayaran gaji bulanan
                            </span>
                        </div>
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
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-calendar mr-2"></i>Periode
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-money-bill mr-2"></i>Gaji Pokok
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-plus-circle mr-2"></i>Bonus Absen
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-gift mr-2"></i>Reward Event
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
                                @forelse ($salaries as $salary)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-gradient-to-r from-[#8D0907] to-[#B91C1C] rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                                {{ substr($salary->month, 0, 3) }}
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $salary->month }} {{ $salary->year }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    <i class="fas fa-calendar-alt mr-1 text-[#8D0907]"></i>
                                                    Periode Gaji
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="text-sm font-medium text-gray-900">
                                            Rp {{ number_format($salary->base_salary, 0, ',', '.') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-plus mr-1"></i>
                                            Rp {{ number_format($salary->total_bonus, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            <i class="fas fa-gift mr-1"></i>
                                            Rp {{ number_format($salary->total_event_reward, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <i class="fas fa-minus mr-1"></i>
                                            Rp {{ number_format($salary->potongan_cuti, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="text-lg font-bold text-green-700 bg-green-50 px-3 py-1 rounded-lg inline-block">
                                            Rp {{ number_format($salary->total_salary, 0, ',', '.') }}
                                        </div>
                                    </td>
                                   
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center text-gray-500">
                                            <i class="fas fa-money-bill-wave text-4xl mb-3 text-gray-300"></i>
                                            <p class="text-lg font-medium">Belum ada data gaji</p>
                                            <p class="text-sm">Riwayat gaji akan muncul di sini</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Summary Card -->
                    @if($salaries->count() > 0)
                        <div class="mt-6 bg-gradient-to-r from-gray-50 to-gray-100 rounded-lg p-6 border border-gray-200">
                            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center">
                                <i class="fas fa-chart-line mr-2 text-[#8D0907]"></i>
                                Ringkasan Gaji
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-green-600">
                                        Rp {{ number_format($salaries->sum('total_salary'), 0, ',', '.') }}
                                    </div>
                                    <div class="text-sm text-gray-600">Total Diterima</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-blue-600">
                                        Rp {{ number_format($salaries->avg('total_salary'), 0, ',', '.') }}
                                    </div>
                                    <div class="text-sm text-gray-600">Rata-rata Gaji</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-purple-600">
                                        {{ $salaries->count() }} Bulan
                                    </div>
                                    <div class="text-sm text-gray-600">Total Periode</div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Pagination -->
                    @if(method_exists($salaries, 'hasPages') && $salaries->hasPages())
                        <div class="mt-6">
                            {{ $salaries->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>