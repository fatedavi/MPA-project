<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Attendance;
use App\Models\EventAttendance;
use App\Models\Cuti;
use App\Models\Salary;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SalaryController extends Controller
{
    /**
     * Menampilkan daftar gaji karyawan bulan ini dengan detail perhitungan
     */
    public function index()
    {
        $now = Carbon::now();
        $month = $now->month;
        $year = $now->year;

        $employees = Employee::all();

        $salaryData = $employees->map(function ($employee) use ($month, $year) {
            $baseSalary = $employee->base_salary;

            $totalBonus = Attendance::where('employee_id', $employee->id)
                ->whereYear('date', $year)
                ->whereMonth('date', $month)
                ->sum('bonus');

            $totalEventReward = EventAttendance::where('employee_id', $employee->id)
                ->whereHas('event', function ($query) use ($year, $month) {
                    $query->whereYear('date', $year)
                        ->whereMonth('date', $month)
                        ->where('status', 'approve');
                })
                ->with('event')
                ->get()
                ->sum(fn($ea) => $ea->event->reward);

            $totalCutiDays = Cuti::where('employee_id', $employee->id)
                ->whereYear('tanggal', $year)
                ->whereMonth('tanggal', $month)
                ->where('status', 'approve')
                ->sum('day');

            $potonganCuti = ($baseSalary / 26) * $totalCutiDays;

            $totalSalary = $baseSalary + $totalBonus + $totalEventReward - $potonganCuti;

            return [
                'employee' => $employee,
                'base_salary' => $baseSalary,
                'total_bonus' => $totalBonus,
                'total_event_reward' => $totalEventReward,
                'total_cuti_days' => $totalCutiDays,
                'potongan_cuti' => $potonganCuti,
                'total_salary' => $totalSalary,
            ];
        });

        return view('salary.index', compact('salaryData'));
    }

    /**
     * Simpan data gaji karyawan bulan ini ke tabel salaries
     */
    public function saveSalaries()
    {
        $now = Carbon::now();
        $month = $now->month;
        $year = $now->year;

        $employees = Employee::all();

        foreach ($employees as $employee) {
            $baseSalary = $employee->base_salary;

            $totalBonus = Attendance::where('employee_id', $employee->id)
                ->whereYear('date', $year)
                ->whereMonth('date', $month)
                ->sum('bonus');

            $totalEventReward = EventAttendance::where('employee_id', $employee->id)
                ->whereHas('event', function ($query) use ($year, $month) {
                    $query->whereYear('date', $year)
                        ->whereMonth('date', $month)
                        ->where('status', 'approve');
                })
                ->with('event')
                ->get()
                ->sum(fn ($ea) => $ea->event->reward);

            $totalCutiDays = Cuti::where('employee_id', $employee->id)
                ->whereYear('tanggal', $year)
                ->whereMonth('tanggal', $month)
                ->where('status', 'approve')
                ->sum('day');

            $potonganCuti = ($baseSalary / 26) * $totalCutiDays;

            $totalSalary = $baseSalary + $totalBonus + $totalEventReward - $potonganCuti;

            Salary::updateOrCreate(
                [
                    'employee_id' => $employee->id,
                    'month' => $month,
                    'year' => $year,
                ],
                [
                    'base_salary' => $baseSalary,
                    'total_bonus' => $totalBonus,
                    'total_event_reward' => $totalEventReward,
                    'total_cut' => $totalCutiDays,
                    'potongan_cuti' => $potonganCuti,
                    'total_salary' => $totalSalary,
                    'status' => 'pending',
                ]
            );
        }

        return redirect()->route('salary.index')->with('success', 'Gaji berhasil disimpan untuk bulan ini.');
    }
    public function history(Request $request)
{
    // Ambil filter bulan dan tahun dari request, default ke bulan & tahun sekarang
    $month = $request->input('month', now()->month);
    $year = $request->input('year', now()->year);

    // Query data salary dengan filter bulan & tahun dan eager load employee
    $salaries = Salary::with('employee')
        ->where('month', $month)
        ->where('year', $year)
        ->orderBy('employee_id')
        ->get();

    // Buat array bulan untuk dropdown
    $months = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni',
        7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];

    // Tahun misal dari 5 tahun terakhir sampai sekarang
    $years = range(now()->year - 5, now()->year);

    return view('salary.history', compact('salaries', 'month', 'year', 'months', 'years'));
}

}
