<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Sample data for display
        $clients = [
            [
                'id' => 1,
                'company_name' => 'PT Maju Bersama',
                'client_code' => 'CLI-001',
                'category' => 'Technology',
                'status' => 'active',
                'contact_person' => 'John Doe',
                'email' => 'john@majubersama.com',
                'phone' => '+62 812-3456-7890'
            ],
            [
                'id' => 2,
                'company_name' => 'Pemda Jakarta',
                'client_code' => 'CLI-002',
                'category' => 'Government',
                'status' => 'active',
                'contact_person' => 'Jane Smith',
                'email' => 'jane@pemda-jakarta.go.id',
                'phone' => '+62 812-3456-7891'
            ],
            [
                'id' => 3,
                'company_name' => 'Bank Indonesia',
                'client_code' => 'CLI-003',
                'category' => 'Finance',
                'status' => 'active',
                'contact_person' => 'Mike Johnson',
                'email' => 'mike@bi.go.id',
                'phone' => '+62 812-3456-7892'
            ]
        ];
        
        return view('client.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('client.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Simple validation
        $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
        ]);

        // For now, just redirect with success message
        // In real application, you would save to database here
        return redirect()->route('client.index')
            ->with('success', 'Client created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Sample client data
        $client = [
            'id' => $id,
            'company_name' => 'PT Maju Bersama',
            'client_code' => 'CLI-001',
            'category' => 'Technology',
            'status' => 'active',
            'contact_person' => 'John Doe',
            'position' => 'Project Manager',
            'email' => 'john@majubersama.com',
            'phone' => '+62 812-3456-7890',
            'website' => 'https://www.majubersama.com',
            'address' => 'Jl. Sudirman No. 123, Jakarta Pusat',
            'city' => 'Jakarta',
            'state' => 'DKI Jakarta',
            'country' => 'Indonesia'
        ];
        
        return view('client.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Sample client data for editing
        $client = [
            'id' => $id,
            'company_name' => 'PT Maju Bersama',
            'client_code' => 'CLI-001',
            'category' => 'Technology',
            'status' => 'active',
            'contact_person' => 'John Doe',
            'position' => 'Project Manager',
            'email' => 'john@majubersama.com',
            'phone' => '+62 812-3456-7890',
            'website' => 'https://www.majubersama.com',
            'address' => 'Jl. Sudirman No. 123, Jakarta Pusat',
            'city' => 'Jakarta',
            'state' => 'DKI Jakarta',
            'country' => 'Indonesia'
        ];
        
        return view('client.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Simple validation
        $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
        ]);

        // For now, just redirect with success message
        // In real application, you would update database here
        return redirect()->route('client.index')
            ->with('success', 'Client updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // For now, just redirect with success message
        // In real application, you would delete from database here
        return redirect()->route('client.index')
            ->with('success', 'Client deleted successfully!');
    }
} 