<x-layouts.app title="Salary List">
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Salary & Bonus List</h1>

        <table class="table-auto border-collapse border border-gray-300 w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2">Employee ID</th>
                    <th class="border border-gray-300 px-4 py-2">Base Salary</th>
                    <th class="border border-gray-300 px-4 py-2">Bonus</th>
                    <th class="border border-gray-300 px-4 py-2">Total Salary</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($salaries as $salary)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $salary->employee_id }}</td>
                        <td class="border border-gray-300 px-4 py-2">Rp {{ number_format($salary->base_salary, 0, ',', '.') }}</td>
                        <td class="border border-gray-300 px-4 py-2">Rp {{ number_format($salary->total_bonus, 0, ',', '.') }}</td>
                        <td class="border border-gray-300 px-4 py-2 font-bold">
                            Rp {{ number_format($salary->base_salary + $salary->total_bonus, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.app>
