<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('user')->get();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $users = User::all(); // Ambil semua user untuk relasi
        $positions = ['Manager', 'Staff', 'Admin', 'karyawan']; // Bisa dari DB kalau mau dinamis
        return view('employees.create', compact('users', 'positions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'         => 'required|exists:users,id',
            'name'            => 'required|string|max:255',
            'phone'           => 'nullable|string|max:20',
            'emergency_phone' => 'nullable|string|max:20',
            'address'         => 'nullable|string',
            'nik'             => 'required|string|max:20|unique:employees,nik',
            'ktp'             => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'kk'              => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'ijazah'          => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'cv'              => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'position'        => 'required|string|max:255',
            'base_salary'     => 'required|numeric|min:0',
            'email'           => 'required|email|unique:employees,email',
        ]);

        // Simpan file jika ada
        $data = $request->only([
            'user_id',
            'name',
            'phone',
            'emergency_phone',
            'address',
            'nik',
            'position',
            'base_salary',
            'email'
        ]);

        foreach (['ktp', 'kk', 'ijazah', 'cv'] as $fileField) {
            if ($request->hasFile($fileField)) {
                $data[$fileField] = $request->file($fileField)->store("employees/{$fileField}", 'public');
            }
        }

        Employee::create($data);

        return redirect()->route('employees.index')->with('success', 'Karyawan berhasil ditambahkan');
    }

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $users = User::all();
        $positions = ['Manager', 'Staff', 'Admin', 'karyawan']; // Bisa dari DB kalau mau dinamis
        return view('employees.edit', compact('employee', 'users', 'positions'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name'            => 'required|string|max:255',
            'phone'           => 'nullable|string|max:20',
            'emergency_phone' => 'nullable|string|max:20',
            'address'         => 'nullable|string',
            'nik'             => 'required|string|max:20|unique:employees,nik,' . $employee->id,
            'ktp'             => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'kk'              => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'ijazah'          => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'cv'              => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'position'        => 'required|string|max:255',
            'base_salary'     => 'required|numeric|min:0',
            'email'           => 'required|email|unique:employees,email,' . $employee->id,
        ]);

        $data = $request->only([

            'name',
            'phone',
            'emergency_phone',
            'address',
            'nik',
            'position',
            'base_salary',
            'email'
        ]);

        foreach (['ktp', 'kk', 'ijazah', 'cv'] as $fileField) {
            if ($request->hasFile($fileField)) {
                // Hapus file lama jika ada
                if ($employee->$fileField && Storage::disk('public')->exists($employee->$fileField)) {
                    Storage::disk('public')->delete($employee->$fileField);
                }
                $data[$fileField] = $request->file($fileField)->store("employees/{$fileField}", 'public');
            }
        }

        $employee->update($data);

        return redirect()->route('employees.index')->with('success', 'Karyawan berhasil diperbarui');
    }

    public function destroy(Employee $employee)
    {
        // Hapus file yang terkait
        foreach (['ktp', 'kk', 'ijazah', 'cv'] as $fileField) {
            if ($employee->$fileField && Storage::disk('public')->exists($employee->$fileField)) {
                Storage::disk('public')->delete($employee->$fileField);
            }
        }

        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Karyawan berhasil dihapus');
    }
}
