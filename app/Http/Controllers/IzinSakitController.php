<?php

namespace App\Http\Controllers;

use App\Models\IzinSakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class IzinSakitController extends Controller
{
    // List izin sakit (admin view)
    public function index()
    {
        $izin = IzinSakit::with('employee')->latest()->get();
        return view('izin_sakit.index', compact('izin'));
    }

    // Form pengajuan izin sakit
    public function create()
    {
        return view('izin_sakit.create');
    }

    // Simpan pengajuan izin sakit
    public function store(Request $request)
    {
        $request->validate([
            'dokter_surat' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'alasan' => 'nullable|string',
        ]);

        $employee = Auth::user()->employee;
        if (!$employee) {
            return back()->withErrors('Data karyawan tidak ditemukan.');
        }

        // Upload file surat dokter
        $path = $request->file('dokter_surat')->store('dokter_surat', 'public');

        IzinSakit::create([
            'employee_id' => $employee->id,
            'dokter_surat' => $path,
            'alasan' => $request->alasan,
            'status' => 'pending',
        ]);

        return redirect()->route('izin-sakit.index')->with('success', 'Pengajuan izin sakit berhasil diajukan.');
    }

    // Approve izin sakit (hanya admin/super_admin)
    public function approve($id)
    {
        $izin = IzinSakit::findOrFail($id);
        $izin->status = 'approved';
        $izin->approved_by = auth()->id();
        $izin->rejected_by = null; // reset jika sebelumnya ditolak
        $izin->save();

        return redirect()->back()->with('success', 'Izin sakit disetujui.');
    }


    // Reject izin sakit
    public function reject(Request $request, $id)
{
    $request->validate([
        'keterangan_admin' => 'required|string|max:255',
    ]);

    $izin = IzinSakit::findOrFail($id);
    $izin->status = 'rejected';
    $izin->rejected_by = auth()->id();
    $izin->approved_by = null; // reset jika sebelumnya disetujui
    $izin->keterangan_admin = $request->keterangan_admin;
    $izin->save();

    return redirect()->back()->with('error', 'Izin sakit ditolak.');
}

}
