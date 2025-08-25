<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    public function index()
    {
        $perusahaan = Perusahaan::orderBy('nama_perusahaan')->paginate(10);
        return view('perusahaan.index', compact('perusahaan'));
    }

    public function create()
    {
        return view('perusahaan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'pemilik' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            // 'gambar' => 'required|string|max:255',
            'email' => 'required|email|max:255'
        ]);

        Perusahaan::create($request->all());

        return redirect()->route('perusahaan.index')
            ->with('success', 'Perusahaan berhasil ditambahkan');
    }

    public function show(Perusahaan $perusahaan)
    {
        return view('perusahaan.show', compact('perusahaan'));
    }

    public function edit(Perusahaan $perusahaan)
    {
        return view('perusahaan.edit', compact('perusahaan'));
    }

    public function update(Request $request, Perusahaan $perusahaan)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'pemilik' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            // 'gambar' => 'required|string|max:255',
            'email' => 'required|email|max:255'
        ]);

        $perusahaan->update($request->all());

        return redirect()->route('perusahaan.index')
            ->with('success', 'Perusahaan berhasil diperbarui');
    }

    public function destroy(Perusahaan $perusahaan)
    {
        $perusahaan->delete();

        return redirect()->route('perusahaan.index')
            ->with('success', 'Perusahaan berhasil dihapus');
    }
}
