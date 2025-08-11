<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index()
{
    $employee = auth()->user()->employee;

    if (!$employee) {
        return redirect()->back()->withErrors('Employee record not found.');
    }

    $today = Carbon::today()->toDateString();

    // Ambil absensi hari ini
    $absen = Attendance::where('employee_id', $employee->id)
        ->where('date', $today)
        ->first();

    // Ambil riwayat absensi karyawan ini (10 terakhir)
    $riwayat = Attendance::where('employee_id', $employee->id)
        ->orderBy('date', 'desc')
        ->take(10)
        ->get();

    return view('attendances.index', compact('absen', 'riwayat'));
}


    public function proses(Request $request)
    {
        $employee = auth()->user()->employee;

        if (!$employee) {
            return redirect()->back()->withErrors('Employee record not found.');
        }

        $now = Carbon::now();
        $today = $now->toDateString();

        $absen = Attendance::where('employee_id', $employee->id)
            ->where('date', $today)
            ->first();

        // Jika belum check-in → Check In
        if (!$absen) {
            $bonus = 0;
            $status = 'Present';

            if ($now->greaterThan(Carbon::createFromTime(8, 15, 0))) {
                $status = 'Late';
            } else {
                $bonus = 10000;
            }

            Attendance::create([
                'employee_id' => $employee->id,
                'date'        => $today,
                'check_in'    => $now->format('H:i:s'),
                'status'      => $status,
                'bonus'       => $bonus,
            ]);

            return redirect()->route('attendances.index')->with('success', 'Check in recorded successfully.');
        }

        // Jika sudah check-in tapi belum check-out → Check Out
        if (!$absen->check_out) {
            $absen->update([
                'check_out' => $now->format('H:i:s')
            ]);

            return redirect()->route('attendances.index')->with('success', 'Check out recorded successfully.');
        }

        // Kalau sudah check-in dan check-out → tidak bisa absen lagi
        return redirect()->route('attendances.index')->with('error', 'You have completed attendance for today.');
    }
}
