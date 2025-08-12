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
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'role' => 'required|string',
        'password' => 'required|string|min:8|confirmed',
    ]);

    User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'role' => $validated['role'],
        'password' => Hash::make($validated['password']),
    ]);

    return redirect()->route('users.index')->with('success', 'User berhasil dibuat.');
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
