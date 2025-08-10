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
        $baseSalaries = [5000000, 3000000, 1500000]; // Contoh gaji dasar

        return view('employees.create', compact('users', 'positions', 'baseSalaries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'position' => 'required|string|max:255',
            'base_salary' => 'required|numeric|min:0',
        ]);

        Employee::create([
            'user_id' => $request->user_id,
            'position' => $request->position,
            'base_salary' => $request->base_salary,
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee berhasil ditambahkan');
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
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:employees,email,' . $employee->id,
            'phone'      => 'nullable|string|max:20',
            'position'   => 'nullable|string|max:100',
        ]);

        $employee->update($validated);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
