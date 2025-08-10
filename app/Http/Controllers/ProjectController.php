<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Sample data for display
        $projects = [
            [
                'id' => 1,
                'project_name' => 'MPA System Development',
                'project_code' => 'PRJ-001',
                'client_name' => 'PT Maju Bersama',
                'status' => 'in_progress',
                'priority' => 'high',
                'start_date' => '2024-01-01',
                'end_date' => '2024-06-30',
                'progress' => 65
            ],
            [
                'id' => 2,
                'project_name' => 'Jakarta Smart City Portal',
                'project_code' => 'PRJ-002',
                'client_name' => 'Pemda Jakarta',
                'status' => 'planning',
                'priority' => 'medium',
                'start_date' => '2024-03-01',
                'end_date' => '2024-12-31',
                'progress' => 15
            ],
            [
                'id' => 3,
                'project_name' => 'Bank Indonesia Mobile App',
                'project_code' => 'PRJ-003',
                'client_name' => 'Bank Indonesia',
                'status' => 'completed',
                'priority' => 'high',
                'start_date' => '2023-09-01',
                'end_date' => '2024-02-28',
                'progress' => 100
            ]
        ];
        
        return view('project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('project.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Simple validation
        $request->validate([
            'project_name' => 'required|string|max:255',
            'client_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        // For now, just redirect with success message
        // In real application, you would save to database here
        return redirect()->route('project.index')
            ->with('success', 'Project created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Sample project data
        $project = [
            'id' => $id,
            'project_name' => 'MPA System Development',
            'project_code' => 'PRJ-001',
            'client_name' => 'PT Maju Bersama',
            'status' => 'in_progress',
            'priority' => 'high',
            'start_date' => '2024-01-01',
            'end_date' => '2024-06-30',
            'description' => 'Development of comprehensive MPA management system',
            'budget' => 50000,
            'estimated_hours' => 800,
            'progress' => 65
        ];
        
        return view('project.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Sample project data for editing
        $project = [
            'id' => $id,
            'project_name' => 'MPA System Development',
            'project_code' => 'PRJ-001',
            'client_id' => 1,
            'status' => 'in_progress',
            'priority' => 'high',
            'start_date' => '2024-01-01',
            'end_date' => '2024-06-30',
            'description' => 'Development of comprehensive MPA management system',
            'budget' => 50000,
            'estimated_hours' => 800
        ];
        
        return view('project.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Simple validation
        $request->validate([
            'project_name' => 'required|string|max:255',
            'client_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        // For now, just redirect with success message
        // In real application, you would update database here
        return redirect()->route('project.index')
            ->with('success', 'Project updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // For now, just redirect with success message
        // In real application, you would delete from database here
        return redirect()->route('project.index')
            ->with('success', 'Project deleted successfully!');
    }
} 