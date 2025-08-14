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
    // use di atas file pastikan sudah ada:
    // use Illuminate\Http\Request;
    // use Carbon\Carbon;

    public function index(Request $request)
    {
        $now = Carbon::now();
        $month = $now->month;
        $year  = $now->year;

        // Ambil keyword search (nama karyawan)
        $search = $request->input('search');

        // Paginate data employee + filter pencarian
        $employees = Employee::query()
            ->when($search, function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })
            ->orderBy('name')
            ->paginate(10)              // jumlah per halaman
            ->withQueryString();        // agar ?search=... tetap ada saat pindah halaman

        // Hitung komponen gaji hanya untuk item pada halaman saat ini
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

            $totalCutiDays = Cuti::where('employee_id', $employee->id)
                ->whereYear('tanggal', $year)
                ->whereMonth('tanggal', $month)
                ->where('status', 'approve')
                ->sum('day');

            $potonganCuti = ($baseSalary / 26) * $totalCutiDays;

            $totalSalary = $baseSalary + $totalBonus + $totalEventReward - $potonganCuti;

            return [
                'employee'            => $employee,
                'base_salary'         => $baseSalary,
                'total_bonus'         => $totalBonus,
                'total_event_reward'  => $totalEventReward,
                'total_cuti_days'     => $totalCutiDays,
                'potongan_cuti'       => $potonganCuti,
                'total_salary'        => $totalSalary,
            ];
        });

        // Kirim salaryData (untuk tabel) & employees (untuk links pagination)
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
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        // Tahun misal dari 5 tahun terakhir sampai sekarang
        $years = range(now()->year - 5, now()->year);

        return view('salary.history', compact('salaries', 'month', 'year', 'months', 'years'));
    }
    public function exportPdf(Request $request)
    {
        // Ambil data filter dari request
        $month = $request->month ?? now()->format('m');
        $year = $request->year ?? now()->format('Y');

        $months = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        // Ambil data gaji
        $salaries = Salary::with('employee')
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->get();

        // Load view PDF
        $pdf = Pdf::loadView('salary.history_pdf', [
            'salaries' => $salaries,
            'month' => $month,
            'year' => $year,
            'months' => $months
        ]);

        // Download PDF
        return $pdf->download("riwayat-gaji-{$month}-{$year}.pdf");
    }



    public function mySalary()
    {
        $user = Auth::user();
        $employee = $user->employee; // pastikan relasi user->employee sudah ada di model User

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
