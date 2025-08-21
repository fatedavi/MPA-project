<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Attendance Management') }}
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
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Attendance</span>
                        </div>
                    </li>
                </ol>
            </nav>

          

            <!-- Main Content -->
            <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <h3 class="text-lg font-semibold text-gray-700 flex items-center gap-2">
                            <i class="fas fa-clock text-[#8D0907]"></i>
                            Data Attendance Hari Ini
                        </h3>
                        <div class="mt-2 sm:mt-0">
                            <span class="text-sm text-gray-500">
                                <i class="fas fa-calendar mr-1"></i>
                                {{ date('d F Y') }}
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
                                        <i class="fas fa-user mr-2"></i>Nama Karyawan
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-calendar mr-2"></i>Tanggal
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-clock mr-2"></i>Check In
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-clock mr-2"></i>Check Out
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-info-circle mr-2"></i>Status
                                    </th>

                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($attendances as $attendance)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-gradient-to-r from-[#8D0907] to-[#B91C1C] rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                                {{ substr($attendance->employee->name ?? 'N', 0, 2) }}
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $attendance->employee->name ?? '-' }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    <i class="fas fa-id-badge mr-1 text-[#8D0907]"></i>
                                                    ID: {{ $attendance->employee->id ?? '-' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                            <i class="fas fa-calendar-alt mr-1 text-[#8D0907]"></i>
                                            {{ $attendance->date ? \Carbon\Carbon::parse($attendance->date)->format('d M Y') : '-' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($attendance->check_in)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-clock mr-1"></i>
                                                {{ $attendance->check_in }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                <i class="fas fa-minus mr-1"></i>
                                                Belum Check In
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($attendance->check_out)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                <i class="fas fa-clock mr-1"></i>
                                                {{ $attendance->check_out }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                <i class="fas fa-minus mr-1"></i>
                                                Belum Check Out
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @php
                                            $statusColors = [
                                                'Hadir' => 'bg-green-100 text-green-800',
                                                'On Time' => 'bg-green-100 text-green-800',
                                                'Terlambat' => 'bg-yellow-100 text-yellow-800',
                                                'Tidak Hadir' => 'bg-red-100 text-red-800',
                                                'Izin' => 'bg-blue-100 text-blue-800',
                                                'Sakit' => 'bg-purple-100 text-purple-800'
                                            ];
                                            $statusClass = $statusColors[$attendance->status] ?? 'bg-gray-100 text-gray-800';
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusClass }}">
                                            @if($attendance->status == 'Hadir' || $attendance->status == 'On Time')
                                                <i class="fas fa-check mr-1"></i>
                                            @elseif($attendance->status == 'Terlambat')
                                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                            @elseif($attendance->status == 'Tidak Hadir')
                                                <i class="fas fa-times mr-1"></i>
                                            @else
                                                <i class="fas fa-info mr-1"></i>
                                            @endif
                                            {{ $attendance->status }}
                                        </span>
                                    </td>

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center text-gray-500">
                                            <i class="fas fa-clock text-4xl mb-3 text-gray-300"></i>
                                            <p class="text-lg font-medium">Belum ada yang absen hari ini</p>
                                            <p class="text-sm">Data attendance akan muncul di sini</p>
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