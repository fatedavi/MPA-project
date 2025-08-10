<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Sample data for display
        $tasks = [
            [
                'id' => 1,
                'title' => 'Design Database Schema',
                'project_name' => 'MPA System Development',
                'assigned_to' => 'John Doe',
                'priority' => 'high',
                'status' => 'in_progress',
                'due_date' => '2024-02-15',
                'progress' => 75
            ],
            [
                'id' => 2,
                'title' => 'Create User Interface',
                'project_name' => 'MPA System Development',
                'assigned_to' => 'Jane Smith',
                'priority' => 'medium',
                'status' => 'pending',
                'due_date' => '2024-02-28',
                'progress' => 0
            ],
            [
                'id' => 3,
                'title' => 'API Development',
                'project_name' => 'Jakarta Smart City Portal',
                'assigned_to' => 'Mike Johnson',
                'priority' => 'high',
                'status' => 'completed',
                'due_date' => '2024-01-31',
                'progress' => 100
            ]
        ];
        
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Simple validation
        $request->validate([
            'title' => 'required|string|max:255',
            'project_id' => 'required',
            'assigned_to' => 'required|string|max:255',
            'due_date' => 'required|date',
        ]);

        // For now, just redirect with success message
        // In real application, you would save to database here
        return redirect()->route('tasks.index')
            ->with('success', 'Task created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Sample task data
        $task = [
            'id' => $id,
            'title' => 'Design Database Schema',
            'description' => 'Create comprehensive database schema for MPA system including all necessary tables and relationships',
            'project_name' => 'MPA System Development',
            'assigned_to' => 'John Doe',
            'priority' => 'high',
            'status' => 'in_progress',
            'due_date' => '2024-02-15',
            'progress' => 75,
            'created_at' => '2024-01-01 00:00:00'
        ];
        
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Sample task data for editing
        $task = [
            'id' => $id,
            'title' => 'Design Database Schema',
            'description' => 'Create comprehensive database schema for MPA system including all necessary tables and relationships',
            'project_id' => 1,
            'assigned_to' => 'John Doe',
            'priority' => 'high',
            'status' => 'in_progress',
            'due_date' => '2024-02-15'
        ];
        
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Simple validation
        $request->validate([
            'title' => 'required|string|max:255',
            'project_id' => 'required',
            'assigned_to' => 'required|string|max:255',
            'due_date' => 'required|date',
        ]);

        // For now, just redirect with success message
        // In real application, you would update database here
        return redirect()->route('tasks.index')
            ->with('success', 'Task updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // For now, just redirect with success message
        // In real application, you would delete from database here
        return redirect()->route('tasks.index')
            ->with('success', 'Task deleted successfully!');
    }
} 