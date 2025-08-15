<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::latest()->paginate(10);
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
        $request->validate([
            'tgl_invoice' => 'required|date',
            'hdeskripsi' => 'required|string|max:400',
            'nama_client' => 'required|string|max:50',
            'alamat_client' => 'required|string|max:400',
            'kd_admin' => 'required|integer',
            'up' => 'required|string|max:25',
            'due_date' => 'required|date',
            'nama_bank' => 'required|string|max:70',
            'an' => 'required|string|max:70',
            'ac' => 'required|string|max:25',
            'total_invoice' => 'required|numeric|min:0',
            'status' => 'required|string|max:15',
            'ttd' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ttdkwitansi' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ttdbast' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ttdbakn' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        
        // Handle file uploads
        $uploadFields = ['ttd', 'ttdkwitansi', 'ttdbast', 'ttdbakn'];
        foreach ($uploadFields as $field) {
            if ($request->hasFile($field)) {
                $filename = time() . '_' . $field . '.' . $request->file($field)->getClientOriginalExtension();
                $path = $request->file($field)->storeAs('public/signatures', $filename);
                $data[$field] = $filename;
            } else {
                $data[$field] = 'blank.png';
            }
        }

        // Create invoice
        Invoice::create($data);

        return redirect()->route('invoice.index')
            ->with('success', 'Invoice created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('invoice.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('invoice.edit', compact('invoice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);
        
        $request->validate([
            'tgl_invoice' => 'required|date',
            'hdeskripsi' => 'required|string|max:400',
            'nama_client' => 'required|string|max:50',
            'alamat_client' => 'required|string|max:400',
            'kd_admin' => 'required|integer',
            'up' => 'required|string|max:25',
            'due_date' => 'required|date',
            'nama_bank' => 'required|string|max:70',
            'an' => 'required|string|max:70',
            'ac' => 'required|string|max:25',
            'total_invoice' => 'required|numeric|min:0',
            'status' => 'required|string|max:15',
            'ttd' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ttdkwitansi' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ttdbast' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ttdbakn' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        
        // Handle file uploads
        $uploadFields = ['ttd', 'ttdkwitansi', 'ttdbast', 'ttdbakn'];
        foreach ($uploadFields as $field) {
            if ($request->hasFile($field)) {
                // Delete old file if exists
                if ($invoice->$field && $invoice->$field !== 'blank.png') {
                    Storage::delete('public/signatures/' . $invoice->$field);
                }
                
                $filename = time() . '_' . $field . '.' . $request->file($field)->getClientOriginalExtension();
                $path = $request->file($field)->storeAs('public/signatures', $filename);
                $data[$field] = $filename;
            }
        }

        $invoice->update($data);

        return redirect()->route('invoice.index')
            ->with('success', 'Invoice updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        
        // Delete signature files
        $uploadFields = ['ttd', 'ttdkwitansi', 'ttdbast', 'ttdbakn'];
        foreach ($uploadFields as $field) {
            if ($invoice->$field && $invoice->$field !== 'blank.png') {
                Storage::delete('public/signatures/' . $invoice->$field);
            }
        }
        
        $invoice->delete();

        return redirect()->route('invoice.index')
            ->with('success', 'Invoice deleted successfully!');
    }

    /**
     * Display MPA invoice page.
     */
    public function mpa()
    {
        $invoices = Invoice::latest()->paginate(10);
        return view('invoice.mpa', compact('invoices'));
    }
} 