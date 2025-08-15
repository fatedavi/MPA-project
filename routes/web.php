<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventAttendanceController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\SalaryController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\VendorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    // Project Routes
    Route::get('/projects', [ProjectController::class, 'index'])->name('project.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('project.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('project.store');
    Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('project.show');
    Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('project.edit');
    Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('project.update');
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('project.destroy');

    // Invoice Routes
    Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoice.index');
    Route::get('/invoices/mpa', [InvoiceController::class, 'mpa'])->name('invoice.mpa');
    Route::get('/invoices/create', [InvoiceController::class, 'create'])->name('invoice.create');
    Route::post('/invoices', [InvoiceController::class, 'store'])->name('invoice.store');
    Route::get('/invoices/{id}', [InvoiceController::class, 'show'])->name('invoice.show');
    Route::get('/invoices/{id}/edit', [InvoiceController::class, 'edit'])->name('invoice.edit');
    Route::put('/invoices/{id}', [InvoiceController::class, 'update'])->name('invoice.update');
    Route::delete('/invoices/{id}', [InvoiceController::class, 'destroy'])->name('invoice.destroy');

    Route::middleware(['auth', RoleMiddleware::class . ':admin,super_admin'])->group(function () {
        // User Management Routes
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    // Task Management Routes
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');
    Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    // Calendar Routes
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
    Route::get('/calendar/create', [CalendarController::class, 'create'])->name('calendar.create');
    Route::post('/calendar', [CalendarController::class, 'store'])->name('calendar.store');
    Route::get('/calendar/{id}/edit', [CalendarController::class, 'edit'])->name('calendar.edit');
    Route::put('/calendar/{id}', [CalendarController::class, 'update'])->name('calendar.update');
    Route::delete('/calendar/{id}', [CalendarController::class, 'destroy'])->name('calendar.destroy');

    // Reports Routes
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    // Settings Routes
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
});

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
/*
|--------------------------------------------------------------------------
| ADMIN & SUPER_ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', RoleMiddleware::class . ':admin,super_admin'])->group(function () {

    // Event
    Route::resource('clients', ClientController::class);

    
    Route::resource('vendors', VendorController::class);
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::patch('/events/{event}/status', [EventController::class, 'updateStatus'])->name('events.updateStatus');

    // Users (contoh kalau ada)
    // Route::resource('users', UserController::class);

    // Gaji
    Route::get('/salary/save', [SalaryController::class, 'saveSalaries'])->name('salary.save');
    Route::get('/salary/history', [SalaryController::class, 'history'])->name('salary.history');
    Route::resource('salary', SalaryController::class)->only(['index']);

    // Daftar cuti admin
    Route::get('/daftarcuti-admin', [CutiController::class, 'adminIndex'])->name('cuti.admin.index');
    Route::patch('/cuti/{id}/approve', [CutiController::class, 'approve'])->name('cuti.approve');
    Route::patch('/cuti/{id}/reject', [CutiController::class, 'reject'])->name('cuti.reject');

    // Employees
    Route::resource('employees', EmployeeController::class);

    // Perusahaan Routes
    Route::resource('perusahaan', PerusahaanController::class);

    // Event Attendance
    Route::get('/event-attendances', [EventAttendanceController::class, 'index'])->name('event-attendances.index');
    Route::get('/event-attendances/create', [EventAttendanceController::class, 'create'])->name('event-attendances.create');
    Route::post('/event-attendances', [EventAttendanceController::class, 'store'])->name('event-attendances.store');
    Route::get('/event-attendances/{id}/edit', [EventAttendanceController::class, 'edit'])->name('event-attendances.edit');
    Route::put('/event-attendances/{id}', [EventAttendanceController::class, 'update'])->name('event-attendances.update');
    Route::delete('/event-attendances/{eventAttendance}', [EventAttendanceController::class, 'destroy'])->name('event-attendances.destroy');
    Route::resource('event-attendances', EventAttendanceController::class);
    Route::get('/salary/history/pdf', [SalaryController::class, 'exportPdf'])->name('salary.history.pdf');
});
Route::middleware(['auth', RoleMiddleware::class . ':super_admin'])->group(function () {
    Route::get('/events/admin', [EventController::class, 'admin'])->name('events.admin');
});

/*
|--------------------------------------------------------------------------
| KARYAWAN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', RoleMiddleware::class . ':karyawan'])->group(function () {

    // Pengajuan cuti
    Route::get('/pengajuan-cuti', [CutiController::class, 'index'])->name('cuti.index');
    Route::post('/pengajuan-cuti', [CutiController::class, 'store'])->name('cuti.store');
    Route::get('/pengajuan-cuti/create', [CutiController::class, 'create'])->name('cuti.create');

    // Absen
    Route::resource('attendances', AttendanceController::class)->only(['index', 'create', 'store', 'edit', 'update']);
    Route::post('/attendances/proses', [AttendanceController::class, 'proses'])->name('attendance.proses');
});

Route::middleware(['auth', RoleMiddleware::class . ':karyawan'])->group(function () {
    // ...existing code...
    Route::get('/my-salary', [SalaryController::class, 'mySalary'])->name('salary.my');
});
