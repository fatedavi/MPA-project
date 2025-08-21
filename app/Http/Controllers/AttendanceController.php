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

    $now = Carbon::now(); // waktu sekarang
    $today = $now->toDateString();

    $absen = Attendance::where('employee_id', $employee->id)
        ->where('date', $today)
        ->first();

    if (!$absen) {
        $cutoffTime = Carbon::createFromTime(8, 5, 0); // 08:05:00

        // Debug
        // dd('now: '.$now->format('H:i:s'), 'cutoff: '.$cutoffTime->format('H:i:s'), $now->lessThanOrEqualTo($cutoffTime));

        $bonus = 0;
        $status = 'Late';

        if ($now->lessThanOrEqualTo($cutoffTime)) {
            $bonus = 10000;
            $status = 'Present';
        }

        Attendance::create([
            'employee_id' => $employee->id,
            'date' => $today,
            'check_in' => $now->format('H:i:s'),
            'status' => $status,
            'bonus' => $bonus,
        ]);

        return redirect()->route('attendances.index')->with('success', 'Check in recorded successfully.');
    }

    if (!$absen->check_out) {
        $checkoutTime = Carbon::createFromTime(17, 0, 0); // 17:00:00
        if ($now->greaterThanOrEqualTo($checkoutTime)) {
            $absen->update([
                'check_out' => $now->format('H:i:s')
            ]);
            return redirect()->route('attendances.index')->with('success', 'Check out recorded successfully.');
        }
        return redirect()->route('attendances.index')->with('error', 'Check out only allowed after 17:00.');
    }

    return redirect()->route('attendances.index')->with('error', 'You have completed attendance for today.');
}
public function todayAttendance()
{
    $today = Carbon::today()->toDateString();

    $attendances = Attendance::where('date', $today)
        ->whereNotNull('check_in') // sudah absen
        ->with('employee') // kalau ada relasi ke Employee
        ->get();

    return view('attendances.today', compact('attendances'));
}



}
