<?php

namespace App\Http\Controllers;

use App\Models\EventAttendance;
use App\Models\Employee;
use App\Models\Event;
use Illuminate\Http\Request;

class EventAttendanceController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $attendances = EventAttendance::with(['employee', 'event'])
            ->when($search, function ($query) use ($search) {
                $query->whereHas('employee', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })->orWhereHas('event', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5)
            ->appends(['search' => $search]); // agar query search tetap di pagination

        if ($request->expectsJson()) {
            return response()->json($attendances);
        }

        return view('event_attendance.index', compact('attendances', 'search'));
    }


    public function create()
    {
        $events = Event::all();
        $employees = Employee::all(); // Nanti bisa difilter setelah event dipilih di frontend
        return view('event_attendance.create', compact('employees', 'events'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|array',
            'employee_id.*' => 'exists:employees,id',
            'event_id' => 'required|exists:events,id',
        ]);

        // Cek karyawan yang sudah ikut event
        $sudahTerdaftar = EventAttendance::where('event_id', $request->event_id)
            ->whereIn('employee_id', $request->employee_id)
            ->pluck('employee_id')
            ->toArray();

        if (!empty($sudahTerdaftar)) {
            $namaKaryawan = Employee::whereIn('id', $sudahTerdaftar)
                ->pluck('name')
                ->implode(', ');

            return redirect()->back()
                ->withInput()
                ->with('error', "Karyawan berikut sudah terdaftar di event ini: {$namaKaryawan}");
        }

        foreach ($request->employee_id as $employeeId) {
            EventAttendance::create([
                'employee_id' => $employeeId,
                'event_id' => $request->event_id,
            ]);
        }

        return redirect()->route('event-attendances.index')
            ->with('success', 'Data berhasil disimpan');
    }





    public function show(EventAttendance $eventAttendance)
    {
        $eventAttendance->load(['employee', 'event']);

        if (request()->expectsJson()) {
            return response()->json($eventAttendance);
        }

        return view('event-attendance.show', compact('eventAttendance'));
    }

    public function edit(EventAttendance $eventAttendance)
    {
        return view('event-attendance.edit', compact('eventAttendance'));
    }

    public function update(Request $request, EventAttendance $eventAttendance)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'event_id' => 'required|exists:events,id',
        ]);

        $eventAttendance->update($request->only('employee_id', 'event_id'));

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Kehadiran berhasil diupdate',
                'data' => $eventAttendance
            ]);
        }

        return redirect()->route('event_attendances.index')->with('success', 'Kehadiran berhasil diupdate');
    }

    public function destroy(EventAttendance $eventAttendance)
    {
        $eventAttendance->delete();

        if (request()->expectsJson()) {
            return response()->json(['message' => 'Kehadiran berhasil dihapus']);
        }

        return redirect()->route('event-attendances.index')->with('success', 'Kehadiran berhasil dihapus');
    }
}
