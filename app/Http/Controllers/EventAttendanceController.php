<?php

namespace App\Http\Controllers;

use App\Models\EventAttendance;
use App\Models\Employee;
use App\Models\Event;
use Illuminate\Http\Request;

class EventAttendanceController extends Controller
{
    public function index()
    {
        $attendances = EventAttendance::with(['employee', 'event'])->get();

        if (request()->expectsJson()) {
            return response()->json($attendances);
        }

        return view('event_attendance.index', compact('attendances'));
    }

    public function create()
    {
        $employees = Employee::all();
        $events = Event::all();

        return view('event_attendance.create', compact('employees', 'events'));
    }

        public function store(Request $request)
{
    $request->validate([
        'employee_id' => 'required|array',
        'employee_id.*' => 'exists:employees,id',
        'event_id' => 'required|exists:events,id',
    ]);

    foreach ($request->employee_id as $employeeId) {
        \App\Models\EventAttendance::create([
            'employee_id' => $employeeId,
            'event_id' => $request->event_id,
        ]);
    }

    return redirect()->route('event-attendances.index')->with('success', 'Data berhasil disimpan');
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
