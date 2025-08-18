<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

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
        $clients = \App\Models\Client::all();
        $banks = \App\Models\Bank::all();
        $nextInvoiceNumber = \App\Models\Invoice::generateInvoiceNumber();
        return view('invoice.create', compact('clients', 'banks', 'nextInvoiceNumber'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'tgl_invoice' => 'required|date',
                'client_id' => 'required|exists:clients,id_client',
                'alamat_client' => 'required|string|max:400',
                'up' => 'required|string|max:50',
                'nbast' => 'nullable|string|max:50',
                'nbast2' => 'nullable|string|max:50',
                'nbast3' => 'nullable|string|max:50',
                'nbast4' => 'nullable|string|max:50',
                'nbast5' => 'nullable|string|max:50',
                'jenis_no' => 'nullable|string|max:50',
                'no_fpb' => 'nullable|string|max:50',
                'no_fpb2' => 'nullable|string|max:50',
                'no_fpb3' => 'nullable|string|max:50',
                'no_fpb4' => 'nullable|string|max:50',
                'no_fpb5' => 'nullable|string|max:50',
                'due_date' => 'required|date',
                'nama_bank' => 'required|string|max:100',
                'an' => 'required|string|max:100',
                'ac' => 'required|string|max:25',
                'no_fp' => 'nullable|string|max:30',
                'status' => 'required|string|max:15',
                'tgl_paid' => 'nullable|date',
                'detail_invoice' => 'required|array|min:1',
                'detail_invoice.*.deskripsi' => 'required|string|max:255',
                'detail_invoice.*.qty' => 'required|numeric|min:1',
                'detail_invoice.*.satuan' => 'nullable|string|max:20',
                'detail_invoice.*.harga' => 'required|numeric|min:0',
                'ttd' => 'nullable|string|max:225',
                'ttdkwitansi' => 'nullable|string|max:225',
                'ttdbast' => 'nullable|string|max:225',
                'ttdbakn' => 'nullable|string|max:225',
            ]);

        $data = $request->all();

        // Remove client_id from data since it's not in fillable fields
        unset($data['client_id']);

        // Process detail_invoice items
        $detailItems = [];
        foreach ($request->detail_invoice as $item) {
            $detailItems[] = [
                'deskripsi' => $item['deskripsi'],
                'qty' => (float) $item['qty'],
                'satuan' => $item['satuan'] ?? 'pcs',
                'harga' => (float) $item['harga'],
                'total' => round((float) $item['qty'] * (float) $item['harga'], 2)
            ];
        }

        $data['detail_invoice'] = json_encode($detailItems);
        
        // Set nama_client from hidden field
        $data['nama_client'] = $data['nama_client'] ?? $data['up'];
        
        // Set kd_admin from current user if not provided
        if (!isset($data['kd_admin']) || empty($data['kd_admin'])) {
            $data['kd_admin'] = (int) Auth::user()->id;
        }
        
        // Calculate total from items
        $data['total_invoice'] = round(collect($detailItems)->sum('total'), 2);

        // Handle signature checkboxes (set to empty string if not checked)
        $signatureFields = ['ttd', 'ttdkwitansi', 'ttdbast', 'ttdbakn'];
        foreach ($signatureFields as $field) {
            $data[$field] = $request->has($field) ? '1' : '';
        }

        $invoice = Invoice::create($data);

        // Flash session data
        session()->flash('success', '🎉 Invoice berhasil dibuat! Data telah tersimpan ke database.');
        session()->flash('invoice_id', $invoice->id);
        
        return redirect()->route('invoice.mpa');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            session()->flash('error', '❌ Validasi gagal! Silakan periksa data yang dimasukkan.');
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            session()->flash('error', '💥 Terjadi kesalahan! ' . $e->getMessage());
            return redirect()->back()
                ->withInput();
        }
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
    public function edit(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);
        
        $clients = \App\Models\Client::all();
        $banks = \App\Models\Bank::all();
        return view('invoice.edit', compact('invoice', 'clients', 'banks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        try {
            $request->validate([
                'tgl_invoice' => 'required|date',
                'client_id' => 'required|string|max:50',
                'alamat_client' => 'required|string|max:400',
                'up' => 'required|string|max:50',
                'nbast' => 'nullable|string|max:50',
                'nbast2' => 'nullable|string|max:50',
                'nbast3' => 'nullable|string|max:50',
                'nbast4' => 'nullable|string|max:50',
                'nbast5' => 'nullable|string|max:50',
                'jenis_no' => 'nullable|string|max:50',
                'no_fpb' => 'nullable|string|max:50',
                'no_fpb2' => 'nullable|string|max:50',
                'no_fpb3' => 'nullable|string|max:50',
                'no_fpb4' => 'nullable|string|max:50',
                'no_fpb5' => 'nullable|string|max:50',
                'due_date' => 'required|date',
                'nama_bank' => 'required|string|max:100',
                'an' => 'required|string|max:100',
                'ac' => 'required|string|max:25',
                'no_fp' => 'nullable|string|max:30',
                'status' => 'required|string|max:15',
                'tgl_paid' => 'nullable|date',
                'detail_invoice' => 'required|array|min:1',
                'detail_invoice.*.deskripsi' => 'required|string|max:255',
                'detail_invoice.*.qty' => 'required|numeric|min:1',
                'detail_invoice.*.satuan' => 'nullable|string|max:20',
                'detail_invoice.*.harga' => 'required|numeric|min:0',
                'ttd' => 'nullable|string|max:225',
                'ttdkwitansi' => 'nullable|string|max:225',
                'ttdbast' => 'nullable|string|max:225',
                'ttdbakn' => 'nullable|string|max:225',
            ]);

        $data = $request->all();
        
        // Remove client_id from data since it's not in fillable fields
        unset($data['client_id']);
        
        // Process detail_invoice items
        $detailItems = [];
        foreach ($request->detail_invoice as $item) {
            $detailItems[] = [
                'deskripsi' => $item['deskripsi'],
                'qty' => (float) $item['qty'],
                'satuan' => $item['satuan'] ?? 'pcs',
                'harga' => (float) $item['harga'],
                'total' => round((float) $item['qty'] * (float) $item['harga'], 2)
            ];
        }
        
        $data['detail_invoice'] = json_encode($detailItems);
        
        // Set nama_client from hidden field
        $data['nama_client'] = $data['nama_client'] ?? $data['up'];
        
        // Set kd_admin from current user if not provided
        if (!isset($data['kd_admin']) || empty($data['kd_admin'])) {
            $data['kd_admin'] = (int) Auth::user()->id;
        }
        
        // Calculate total from items
        $data['total_invoice'] = round(collect($detailItems)->sum('total'), 2);

        // Handle signature checkboxes (set to empty string if not checked)
        $signatureFields = ['ttd', 'ttdkwitansi', 'ttdbast', 'ttdbakn'];
        foreach ($signatureFields as $field) {
            $data[$field] = $request->has($field) ? '1' : '';
        }

        $invoice->update($data);

        // Flash session data
        session()->flash('success', '✅ Invoice berhasil diperbarui! Data telah tersimpan ke database.');
        
        return redirect()->back();
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            session()->flash('error', '❌ Validasi gagal! Silakan periksa data yang dimasukkan.');
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            session()->flash('error', '💥 Terjadi kesalahan! ' . $e->getMessage());
            return redirect()->back()
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $invoice = Invoice::findOrFail($id);
            
            // Delete signature files
            $uploadFields = ['ttd', 'ttdkwitansi', 'ttdbast', 'ttdbakn'];
            foreach ($uploadFields as $field) {
                if ($invoice->$field) {
                    Storage::delete('public/signatures/' . $invoice->$field);
                }
            }
            
            $invoice->delete();

            // Flash session data
            session()->flash('success', '🗑️ Invoice berhasil dihapus! Data telah dihapus dari database.');
            
            return redirect()->route('invoice.mpa');
                
        } catch (\Exception $e) {
            session()->flash('error', '💥 Gagal menghapus invoice! ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display MPA invoice page.
     */
    public function mpa()
    {
        $invoices = Invoice::latest()->paginate(10);
        return view('invoice.mpa', compact('invoices'));
    }

    /**
     * View invoice as PDF in browser
     */
    public function viewPdf($id)
    {
        $invoice = Invoice::findOrFail($id);
        $pdf = Pdf::loadView('invoice.pdf', compact('invoice'));
        
        // Clean filename - remove invalid characters
        $cleanFilename = preg_replace('/[^a-zA-Z0-9\-_\.]/', '_', $invoice->no_invoice);
        return $pdf->stream('invoice-' . $cleanFilename . '.pdf');
    }

    /**
     * Download invoice as PDF
     */
    public function downloadPdf($id)
    {
        $invoice = Invoice::findOrFail($id);
        $pdf = Pdf::loadView('invoice.pdf', compact('invoice'));
        
        // Clean filename - remove invalid characters
        $cleanFilename = preg_replace('/[^a-zA-Z0-9\-_\.]/', '_', $invoice->no_invoice);
        return $pdf->download('invoice-' . $cleanFilename . '.pdf');
    }
} 