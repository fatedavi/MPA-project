<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Riwayat Gaji</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Riwayat Gaji - {{ $months[$month] ?? $month }} {{ $year }}</h2>
    <table>
        <thead>
            <tr>
                <th>Nama Karyawan</th>
                <th>Base Salary</th>
                <th>Bonus Attendance</th>
                <th>Reward Event</th>
                <th>Cuti</th>
                <th>Potongan Cuti</th>
                <th>Total Gaji</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($salaries as $salary)
                <tr>
                    <td>{{ $salary->employee->name }}</td>
                    <td>{{ number_format($salary->base_salary, 0, ',', '.') }}</td>
                    <td>{{ number_format($salary->total_bonus, 0, ',', '.') }}</td>
                    <td>{{ number_format($salary->total_event_reward, 0, ',', '.') }}</td>
                    <td>{{ $salary->total_cut }}</td>
                    <td>{{ number_format($salary->potongan_cuti, 0, ',', '.') }}</td>
                    <td>{{ number_format($salary->total_salary, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($salary->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
