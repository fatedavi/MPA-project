{{-- resources/views/salary/my.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Salary History') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Gaji {{ $employee->name }}</h3>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Gaji Pokok</th>
                            <th>Bonus</th>
                            <th>Reward Event</th>
                            <th>Potongan Cuti</th>
                            <th>Total Gaji</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($salaries as $salary)
                            <tr>
                                <td>{{ $salary->month }}</td>
                                <td>{{ $salary->year }}</td>
                                <td>Rp{{ number_format($salary->base_salary, 0, ',', '.') }}</td>
                                <td>Rp{{ number_format($salary->total_bonus, 0, ',', '.') }}</td>
                                <td>Rp{{ number_format($salary->total_event_reward, 0, ',', '.') }}</td>
                                <td>Rp{{ number_format($salary->potongan_cuti, 0, ',', '.') }}</td>
                                <td class="font-bold">Rp{{ number_format($salary->total_salary, 0, ',', '.') }}</td>
                                <td>{{ ucfirst($salary->status) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-gray-500">Belum ada data gaji.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
