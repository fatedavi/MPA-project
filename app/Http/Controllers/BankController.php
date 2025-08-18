<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banks = Bank::orderBy('nama_bank')->paginate(10);
        return view('bank.index', compact('banks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bank.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_bank' => 'required|string|max:100',
            'an' => 'required|string|max:100',
            'ac' => 'required|string|max:50',
        ]);

        Bank::create($request->all());

        return redirect()->route('bank.index')
            ->with('success', 'Bank created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bank $bank)
    {
        return view('bank.show', compact('bank'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bank $bank)
    {
        return view('bank.edit', compact('bank'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bank $bank)
    {
        $request->validate([
            'nama_bank' => 'required|string|max:100',
            'an' => 'required|string|max:100',
            'ac' => 'required|string|max:50',
        ]);

        $bank->update($request->all());

        return redirect()->route('bank.index')
            ->with('success', 'Bank updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bank $bank)
    {
        // Check if bank is used in invoices
        if ($bank->invoices()->count() > 0) {
            return redirect()->route('bank.index')
                ->with('error', 'Cannot delete bank. It is being used in invoices.');
        }

        $bank->delete();

        return redirect()->route('bank.index')
            ->with('success', 'Bank deleted successfully.');
    }
}
