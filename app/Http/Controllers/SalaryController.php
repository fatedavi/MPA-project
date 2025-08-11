<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller
{
    public function index()
    {
        $data = Employee::select(
                'employees.id',
                'employees.name',
                'employees.base_salary',
                DB::raw('COALESCE(SUM(attendance.bonus), 0) as total_bonus')
            )
            ->leftJoin('attendance', 'employees.id', '=', 'attendance.employee_id')
            ->groupBy('employees.id', 'employees.name', 'employees.base_salary')
            ->get();

        return view('salary.index', compact('data'));
    }
}
