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

    public function adminIndex(Request $request)
    {
        $query = Cuti::with('employee')->orderBy('created_at', 'desc');

        // Fitur Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('employee', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })
                ->orWhere('tanggal', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        }

        // Pagination (10 data per halaman)
        $cuti = $query->paginate(10);

        return view('daftarcuti.index', compact('cuti'));
    }


    public function create()
    {
        $employee = Auth::user()->employee;

        if (!$employee) {
            return redirect()->back()->with('error', 'Data karyawan tidak ditemukan.');
        }

        $year = now()->year;

        // Hitung total cuti yang sudah diambil tahun ini
        $totalCutiYear = Cuti::where('employee_id', $employee->id)
            ->whereYear('tanggal', $year)
            ->where('status', 'approve')
            ->sum('day');

        $jatahCuti = 12;
        $sisaCuti = max(0, $jatahCuti - $totalCutiYear);

        return view('cuti.create', compact('sisaCuti', 'totalCutiYear', 'jatahCuti'));
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

    public function approve($id)
    {
        $cuti = Cuti::findOrFail($id);

        if ($cuti->status !== 'requested') {
            return redirect()->back()->withErrors('Pengajuan cuti sudah diproses.');
        }

        $cuti->update(['status' => 'approve']);

        return redirect()->back()->with('success', 'Pengajuan cuti disetujui.');
    }

    public function reject($id)
    {
        $cuti = Cuti::findOrFail($id);

        if ($cuti->status !== 'requested') {
            return redirect()->back()->withErrors('Pengajuan cuti sudah diproses.');
        }

        $cuti->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Pengajuan cuti ditolak.');
    }
}
