<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Sample data for display
        $events = [
            [
                'id' => 1,
                'title' => 'Project Kickoff Meeting',
                'type' => 'meeting',
                'start_date' => '2024-01-20 09:00:00',
                'end_date' => '2024-01-20 10:00:00',
                'project_name' => 'MPA System Development',
                'attendees' => ['John Doe', 'Jane Smith', 'Mike Johnson']
            ],
            [
                'id' => 2,
                'title' => 'Client Presentation',
                'type' => 'presentation',
                'start_date' => '2024-01-22 14:00:00',
                'end_date' => '2024-01-22 15:30:00',
                'project_name' => 'Jakarta Smart City Portal',
                'attendees' => ['Jane Smith', 'Client Representative']
            ],
            [
                'id' => 3,
                'title' => 'Code Review Session',
                'type' => 'development',
                'start_date' => '2024-01-24 16:00:00',
                'end_date' => '2024-01-24 17:00:00',
                'project_name' => 'MPA System Development',
                'attendees' => ['Mike Johnson', 'John Doe']
            ]
        ];
        
        return view('calendar.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('calendar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Simple validation
        $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'type' => 'required|string|max:100',
        ]);

        // For now, just redirect with success message
        // In real application, you would save to database here
        return redirect()->route('calendar.index')
            ->with('success', 'Event created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Sample event data for editing
        $event = [
            'id' => $id,
            'title' => 'Project Kickoff Meeting',
            'description' => 'Initial meeting to discuss project requirements and timeline',
            'type' => 'meeting',
            'start_date' => '2024-01-20 09:00:00',
            'end_date' => '2024-01-20 10:00:00',
            'project_id' => 1,
            'attendees' => 'John Doe, Jane Smith, Mike Johnson'
        ];
        
        return view('calendar.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Simple validation
        $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'type' => 'required|string|max:100',
        ]);

        // For now, just redirect with success message
        // In real application, you would update database here
        return redirect()->route('calendar.index')
            ->with('success', 'Event updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // For now, just redirect with success message
        // In real application, you would delete from database here
        return redirect()->route('calendar.index')
            ->with('success', 'Event deleted successfully!');
    }
} 