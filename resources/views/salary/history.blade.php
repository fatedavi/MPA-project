<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Gaji') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Filter dan Export PDF -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">

                <!-- Filter Form -->
                <form method="GET" action="{{ route('salary.history') }}" class="flex flex-wrap gap-3">
                    <select name="month"
                        class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition">
                        @foreach ($months as $num => $name)
                            <option value="{{ $num }}" {{ $month == $num ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>

                    <select name="year"
                        class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition">
                        @for ($y = date('Y'); $y >= 2020; $y--)
                            <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>
                                {{ $y }}
                            </option>
                        @endfor
                    </select>

                    <button type="submit"
                        class="flex items-center gap-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white px-4 py-2 rounded-xl shadow hover:from-blue-600 hover:to-blue-800 hover:shadow-lg transition-all">
                        <i class="fas fa-filter"></i>
                        Filter
                    </button>
                </form>

                <!-- Export PDF -->
                <a href="{{ route('salary.history.pdf', ['month' => $month, 'year' => $year]) }}"
                    class="flex items-center gap-2 bg-gradient-to-r from-red-500 to-red-700 text-white px-4 py-2 rounded-xl shadow hover:from-red-600 hover:to-red-800 hover:shadow-lg transition-all">
                    <i class="fas fa-file-pdf"></i>
                    Export PDF
                </a>
            </div>

            <!-- Tabel Riwayat Gaji -->
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="w-full text-sm text-left border-collapse">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border">Nama Karyawan</th>
                            <th class="px-4 py-2 border">Base Salary</th>
                            <th class="px-4 py-2 border">Bonus Attendance</th>
                            <th class="px-4 py-2 border">Reward Event</th>
                            <th class="px-4 py-2 border">Cuti</th>
                            <th class="px-4 py-2 border">Potongan Cuti</th>
                            <th class="px-4 py-2 border">Total Gaji</th>
                            <th class="px-4 py-2 border">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($salaries as $salary)
                            <tr>
                                <td class="px-4 py-2 border">{{ $salary->employee->name }}</td>
                                <td class="px-4 py-2 border">{{ number_format($salary->base_salary, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-2 border">{{ number_format($salary->total_bonus, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-2 border">
                                    {{ number_format($salary->total_event_reward, 0, ',', '.') }}</td>
                                <td class="px-4 py-2 border">{{ $salary->total_cut }}</td>
                                <td class="px-4 py-2 border">{{ number_format($salary->potongan_cuti, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-2 border">{{ number_format($salary->total_salary, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-2 border">{{ ucfirst($salary->status) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-2 border text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</x-app-layout>
