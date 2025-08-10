<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Sample data for display
        $invoices = [
            [
                'id' => 1,
                'invoice_number' => 'INV-001',
                'client_name' => 'PT Maju Bersama',
                'project_name' => 'MPA System Development',
                'amount' => 15000,
                'status' => 'paid',
                'due_date' => '2024-02-15',
                'issue_date' => '2024-01-15'
            ],
            [
                'id' => 2,
                'invoice_number' => 'INV-002',
                'client_name' => 'Pemda Jakarta',
                'project_name' => 'Jakarta Smart City Portal',
                'amount' => 25000,
                'status' => 'pending',
                'due_date' => '2024-03-15',
                'issue_date' => '2024-02-15'
            ],
            [
                'id' => 3,
                'invoice_number' => 'INV-003',
                'client_name' => 'Bank Indonesia',
                'project_name' => 'Bank Indonesia Mobile App',
                'amount' => 30000,
                'status' => 'overdue',
                'due_date' => '2024-01-31',
                'issue_date' => '2024-01-01'
            ]
        ];
        
        return view('invoice.mpa', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('invoice.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Simple validation
        $request->validate([
            'invoice_number' => 'required|string|max:255',
            'client_id' => 'required',
            'project_id' => 'required',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
        ]);

        // For now, just redirect with success message
        // In real application, you would save to database here
        return redirect()->route('invoice.index')
            ->with('success', 'Invoice created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Sample invoice data
        $invoice = [
            'id' => $id,
            'invoice_number' => 'INV-001',
            'client_name' => 'PT Maju Bersama',
            'project_name' => 'MPA System Development',
            'amount' => 15000,
            'status' => 'paid',
            'due_date' => '2024-02-15',
            'issue_date' => '2024-01-15',
            'description' => 'Development services for MPA System',
            'items' => [
                ['description' => 'System Analysis', 'quantity' => 40, 'rate' => 100, 'amount' => 4000],
                ['description' => 'Development', 'quantity' => 80, 'rate' => 100, 'amount' => 8000],
                ['description' => 'Testing', 'quantity' => 20, 'rate' => 100, 'amount' => 2000],
                ['description' => 'Documentation', 'quantity' => 10, 'rate' => 100, 'amount' => 1000]
            ]
        ];
        
        return view('invoice.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Sample invoice data for editing
        $invoice = [
            'id' => $id,
            'invoice_number' => 'INV-001',
            'client_id' => 1,
            'project_id' => 1,
            'amount' => 15000,
            'status' => 'paid',
            'due_date' => '2024-02-15',
            'issue_date' => '2024-01-15',
            'description' => 'Development services for MPA System'
        ];
        
        return view('invoice.edit', compact('invoice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Simple validation
        $request->validate([
            'invoice_number' => 'required|string|max:255',
            'client_id' => 'required',
            'project_id' => 'required',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
        ]);

        // For now, just redirect with success message
        // In real application, you would update database here
        return redirect()->route('invoice.index')
            ->with('success', 'Invoice updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // For now, just redirect with success message
        // In real application, you would delete from database here
        return redirect()->route('invoice.index')
            ->with('success', 'Invoice deleted successfully!');
    }

    /**
     * Display MPA invoice page.
     */
    public function mpa()
    {
        return view('invoice.mpa');
    }
} 