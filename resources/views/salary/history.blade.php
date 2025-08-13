<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Gaji') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Filter dan Export PDF -->
            <div class="flex items-center justify-between mb-4">
                <!-- Filter Form -->
                <form method="GET" action="{{ route('salary.history') }}" class="flex space-x-2">
                    <select name="month" class="border-gray-300 rounded-md">
                        @foreach ($months as $num => $name)
                            <option value="{{ $num }}" {{ $month == $num ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                    <select name="year" class="border-gray-300 rounded-md">
                        @for ($y = date('Y'); $y >= 2020; $y--)
                            <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>
                                {{ $y }}
                            </option>
                        @endfor
                    </select>
                    <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                        Filter
                    </button>
                </form>

                <!-- Export PDF -->
                <a href="{{ route('salary.history.pdf', ['month' => $month, 'year' => $year]) }}" 
                   class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
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
                                <td class="px-4 py-2 border">{{ number_format($salary->base_salary, 0, ',', '.') }}</td>
                                <td class="px-4 py-2 border">{{ number_format($salary->total_bonus, 0, ',', '.') }}</td>
                                <td class="px-4 py-2 border">{{ number_format($salary->total_event_reward, 0, ',', '.') }}</td>
                                <td class="px-4 py-2 border">{{ $salary->total_cut }}</td>
                                <td class="px-4 py-2 border">{{ number_format($salary->potongan_cuti, 0, ',', '.') }}</td>
                                <td class="px-4 py-2 border">{{ number_format($salary->total_salary, 0, ',', '.') }}</td>
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
