<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Sample data for display
        $users = [
            [
                'id' => 1,
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'role' => 'admin',
                'status' => 'active',
                'last_login' => '2024-01-15 10:30:00'
            ],
            [
                'id' => 2,
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'role' => 'manager',
                'status' => 'active',
                'last_login' => '2024-01-14 15:45:00'
            ],
            [
                'id' => 3,
                'name' => 'Mike Johnson',
                'email' => 'mike@example.com',
                'role' => 'developer',
                'status' => 'active',
                'last_login' => '2024-01-15 09:15:00'
            ]
        ];
        
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Simple validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role' => 'required|string|max:100',
        ]);

        // For now, just redirect with success message
        // In real application, you would save to database here
        return redirect()->route('users.index')
            ->with('success', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Sample user data
        $user = [
            'id' => $id,
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'role' => 'admin',
            'status' => 'active',
            'last_login' => '2024-01-15 10:30:00',
            'created_at' => '2024-01-01 00:00:00'
        ];
        
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Sample user data for editing
        $user = [
            'id' => $id,
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'role' => 'admin',
            'status' => 'active'
        ];
        
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Simple validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role' => 'required|string|max:100',
        ]);

        // For now, just redirect with success message
        // In real application, you would update database here
        return redirect()->route('users.index')
            ->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // For now, just redirect with success message
        // In real application, you would delete from database here
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully!');
    }
} 