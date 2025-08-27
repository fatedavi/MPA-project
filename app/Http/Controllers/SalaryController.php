<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
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
    public function index(Request $request)
    {
        $now = Carbon::now();
        $month = $now->month;
        $year  = $now->year;

        $search = $request->input('search');

        $employees = Employee::query()
            ->when($search, function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        $salaryData = collect($employees->items())->map(function ($employee) use ($month, $year) {
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

            // Jumlah cuti bulan ini
            $totalCutiDays = Cuti::where('employee_id', $employee->id)
                ->whereYear('tanggal', $year)
                ->whereMonth('tanggal', $month)
                ->where('status', 'approve')
                ->sum('day');

            // Total cuti setahun berjalan
            $totalCutiYear = Cuti::where('employee_id', $employee->id)
                ->whereYear('tanggal', $year)
                ->where('status', 'approve')
                ->sum('day');

            // Hitung cuti yang melebihi kuota 12 hari
            $lebihCuti = max(0, $totalCutiYear - 12);

            // Potongan hanya untuk cuti yang melebihi 12 hari
            $potonganCuti = ($baseSalary / 26) * $lebihCuti;

            $totalSalary = $baseSalary + $totalBonus + $totalEventReward - $potonganCuti;

            return [
                'employee'            => $employee,
                'base_salary'         => $baseSalary,
                'total_bonus'         => $totalBonus,
                'total_event_reward'  => $totalEventReward,
                'total_cuti_days'     => $totalCutiDays,
                'total_cuti_year'     => $totalCutiYear,
                'lebih_cuti'          => $lebihCuti,
                'potongan_cuti'       => $potonganCuti,
                'total_salary'        => $totalSalary,
            ];
        });

        return view('salary.index', compact('salaryData', 'employees'));
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
                ->sum(fn($ea) => $ea->event->reward);

            $totalCutiDays = Cuti::where('employee_id', $employee->id)
                ->whereYear('tanggal', $year)
                ->whereMonth('tanggal', $month)
                ->where('status', 'approve')
                ->sum('day');

            $totalCutiYear = Cuti::where('employee_id', $employee->id)
                ->whereYear('tanggal', $year)
                ->where('status', 'approve')
                ->sum('day');

            $lebihCuti = max(0, $totalCutiYear - 12);

            $potonganCuti = ($baseSalary / 26) * $lebihCuti;

            $totalSalary = $baseSalary + $totalBonus + $totalEventReward - $potonganCuti;

            Salary::updateOrCreate(
                [
                    'employee_id' => $employee->id,
                    'month' => $month,
                    'year' => $year,
                ],
                [
                    'base_salary'        => $baseSalary,
                    'total_bonus'        => $totalBonus,
                    'total_event_reward' => $totalEventReward,
                    'total_cut'          => $totalCutiDays,
                    'potongan_cuti'      => $potonganCuti,
                    'total_salary'       => $totalSalary,
                    'status'             => 'pending',
                ]
            );
        }

        return redirect()->route('salary.index')->with('success', 'Gaji berhasil disimpan untuk bulan ini.');
    }

    public function history(Request $request)
    {
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);

        $salaries = Salary::with('employee')
            ->where('month', $month)
            ->where('year', $year)
            ->orderBy('employee_id')
            ->get();

        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        $years = range(now()->year - 5, now()->year);

        return view('salary.history', compact('salaries', 'month', 'year', 'months', 'years'));
    }

    public function exportPdf(Request $request)
    {
        $month = $request->month ?? now()->format('m');
        $year = $request->year ?? now()->format('Y');

        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        $salaries = Salary::with('employee')
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->get();

        $pdf = Pdf::loadView('salary.history_pdf', [
            'salaries' => $salaries,
            'month'    => $month,
            'year'     => $year,
            'months'   => $months
        ]);

        return $pdf->download("riwayat-gaji-{$month}-{$year}.pdf");
    }

    public function mySalary()
    {
        $user = Auth::user();
        $employee = $user->employee;

        if (!$employee) {
            return redirect()->back()->with('error', 'Data karyawan tidak ditemukan.');
        }

        $salaries = Salary::where('employee_id', $employee->id)
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->get();

        return view('salary.my', compact('salaries', 'employee'));
    }
}
