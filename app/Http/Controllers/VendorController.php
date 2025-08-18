<?php
namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        $vendors = Vendor::orderBy('nama_vendor')->paginate(10);
        return view('vendors.index', compact('vendors'));
    }

    public function create()
    {
        return view('vendors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_vendor' => 'required|max:100',
            'alamat_vendor' => 'required|max:500',
            'kota' => 'required|max:30',
            'up_vendor' => 'required|max:30',
            'no_telp' => 'required|max:20',
            'email_vendor' => 'required|max:50|email',
        ]);

        Vendor::create($request->all());
        return redirect()->route('vendors.index')->with('success', 'Vendor created successfully.');
    }

    public function show(Vendor $vendor)
    {
        return view('vendors.show', compact('vendor'));
    }

    public function edit(Vendor $vendor)
    {
        return view('vendors.edit', compact('vendor'));
    }

    public function update(Request $request, Vendor $vendor)
    {
        $request->validate([
            'nama_vendor' => 'required|max:100',
            'alamat_vendor' => 'required|max:500',
            'kota' => 'required|max:30',
            'up_vendor' => 'required|max:30',
            'no_telp' => 'required|max:20',
            'email_vendor' => 'required|max:50|email',
        ]);

        $vendor->update($request->all());
        return redirect()->route('vendors.index')->with('success', 'Vendor updated successfully.');
    }

    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        return redirect()->route('vendors.index')->with('success', 'Vendor deleted successfully.');
    }
}