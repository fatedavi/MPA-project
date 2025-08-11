<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuti;
use Illuminate\Support\Facades\Auth;

class CutiController extends Controller
{
    /**
     * Menampilkan daftar pengajuan cuti
     */
    public function index()
    {
        $employee = Auth::user()->employee;

        if (!$employee) {
            return redirect()->back()->withErrors('Data karyawan tidak ditemukan.');
        }

        $cuti = Cuti::where('employee_id', $employee->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('cuti.index', compact('cuti'));
    }

    public function create()
    {
        return view('cuti.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'day' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ], [
            'tanggal.required' => 'Tanggal cuti wajib diisi.',
            'day.required' => 'Jumlah hari cuti wajib diisi.',
            'day.integer' => 'Jumlah hari cuti harus berupa angka.',
            'day.min' => 'Jumlah hari cuti minimal 1.',
        ]);

        $employee = Auth::user()->employee;

        if (!$employee) {
            return redirect()->back()->withErrors('Data karyawan tidak ditemukan.');
        }

        Cuti::create([
            'employee_id' => $employee->id,
            'tanggal' => $request->tanggal,
            'day' => $request->day,
            'description' => $request->description,
            'status' => 'requested',
        ]);

        return redirect()->route('cuti.index')->with('success', 'Pengajuan cuti berhasil diajukan.');
    }
}
