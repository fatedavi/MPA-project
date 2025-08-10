<?php

namespace App\Http\Controllers;

use App\Models\EventAttendance;
use App\Models\Event;
use App\Models\Employee;
use Illuminate\Http\Request;

class EventAttendanceController extends Controller
{
    public function index()
    {
        $attendances = EventAttendance::with(['employee', 'event'])->get();
        return view('attendances.index', compact('attendances'));
    }

    public function create()
    {
        $events = Event::all();
        $employees = Employee::all();
        return view('attendances.create', compact('events', 'employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'event_id'    => 'required|exists:events,id',
            'status'      => 'required|in:present,absent',
            'notes'       => 'nullable|string',
        ]);

        EventAttendance::create($validated);

        return redirect()->route('attendances.index')->with('success', 'Attendance recorded successfully.');
    }

    public function show(EventAttendance $attendance)
    {
        return view('attendances.show', compact('attendance'));
    }

    public function edit(EventAttendance $attendance)
    {
        $events = Event::all();
        $employees = Employee::all();
        return view('attendances.edit', compact('attendance', 'events', 'employees'));
    }

    public function update(Request $request, EventAttendance $attendance)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'event_id'    => 'required|exists:events,id',
            'status'      => 'required|in:present,absent',
            'notes'       => 'nullable|string',
        ]);

        $attendance->update($validated);

        return redirect()->route('attendances.index')->with('success', 'Attendance updated successfully.');
    }

    public function destroy(EventAttendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('attendances.index')->with('success', 'Attendance deleted successfully.');
    }
}
