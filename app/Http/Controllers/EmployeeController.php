<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('user')->get();
        return view('employees.index', compact('employees'));
    }

        public function create()
    {
        $users = User::all(); // Ambil semua user
        $positions = ['Manager', 'Staff', 'Intern']; // Contoh posisi, bisa dari tabel juga

        return view('employees.create', compact('users', 'positions',));
    }

    
public function store(Request $request)
{
    $request->validate([
        'user_id'     => 'required|exists:users,id',
        'nik'         => 'required|string|max:20|unique:employees,nik',
        'position'    => 'required|string|max:255',
        'base_salary' => 'required|numeric|min:0',
        'photo'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $photoPath = null;
    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('photos', 'public');
    }

    Employee::create([
        'user_id'     => $request->user_id,
        'nik'         => $request->nik,
        'position'    => $request->position,
        'base_salary' => $request->base_salary,
        'photo'       => $photoPath,
    ]);

    return redirect()->route('employees.index')->with('success', 'Karyawan berhasil ditambahkan');
}

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

public function update(Request $request, Employee $employee)
{
    $request->validate([
        'nik'         => 'required|string|max:20|unique:employees,nik,' . $employee->id,
        'position'    => 'required|string|max:255',
        'base_salary' => 'required|numeric|min:0',
        'photo'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('photos', 'public');
        $employee->photo = $photoPath;
    }

    $employee->nik = $request->nik;
    $employee->position = $request->position;
    $employee->base_salary = $request->base_salary;
    $employee->save();

    return redirect()->route('employees.index')->with('success', 'Karyawan berhasil diperbarui');
}

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
