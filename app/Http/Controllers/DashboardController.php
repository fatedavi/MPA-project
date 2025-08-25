<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Event;
use App\Models\Attendance;
use App\Models\Cuti;
use App\Models\Salary;
use App\Models\Vendor;
use App\Models\Bank;
use App\Models\Perusahaan;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            // Get current month and year
            $currentMonth = Carbon::now()->month;
            $currentYear = Carbon::now()->year;
            $lastMonth = Carbon::now()->subMonth()->month;
            $lastYear = Carbon::now()->subMonth()->year;

            // Invoice Statistics
            $totalInvoices = Invoice::count() ?? 0;
            $totalInvoicesThisMonth = Invoice::whereMonth('tgl_invoice', $currentMonth)
                ->whereYear('tgl_invoice', $currentYear)
                ->count() ?? 0;
            $totalInvoicesLastMonth = Invoice::whereMonth('tgl_invoice', $lastMonth)
                ->whereYear('tgl_invoice', $lastYear)
                ->count() ?? 0;
            $invoiceGrowth = $totalInvoicesLastMonth > 0 ? (($totalInvoicesThisMonth - $totalInvoicesLastMonth) / $totalInvoicesLastMonth) * 100 : 0;

            $pendingInvoices = Invoice::where('status', 'draft')->orWhere('status', 'sent')->count() ?? 0;
            $paidInvoices = Invoice::where('status', 'paid')->count() ?? 0;
            $overdueInvoices = Invoice::where('status', 'overdue')->count() ?? 0;

            $totalRevenue = Invoice::where('status', 'paid')->sum('total_invoice') ?? 0;
            $revenueThisMonth = Invoice::where('status', 'paid')
                ->whereMonth('tgl_paid', $currentMonth)
                ->whereYear('tgl_paid', $currentYear)
                ->sum('total_invoice') ?? 0;
            $revenueLastMonth = Invoice::where('status', 'paid')
                ->whereMonth('tgl_paid', $lastMonth)
                ->whereYear('tgl_paid', $lastYear)
                ->sum('total_invoice') ?? 0;
            $revenueGrowth = $revenueLastMonth > 0 ? (($revenueThisMonth - $revenueLastMonth) / $revenueLastMonth) * 100 : 0;

            // Client Statistics
            $totalClients = Client::count() ?? 0;
            $activeClients = Client::count() ?? 0;
            $newClientsThisMonth = Client::whereMonth('created_at', $currentMonth)
                ->whereYear('created_at', $currentYear)
                ->count() ?? 0;

            // Employee Statistics
            $totalEmployees = Employee::count() ?? 0;
            $activeEmployees = Employee::count() ?? 0;

            // Event Statistics
            $totalEvents = Event::count() ?? 0;
            $upcomingEvents = Event::where('date', '>=', Carbon::now())->count() ?? 0;
            $eventsThisMonth = Event::whereMonth('date', $currentMonth)
                ->whereYear('date', $currentYear)
                ->count() ?? 0;

            // Attendance Statistics
            $todayAttendance = Attendance::whereDate('date', Carbon::today())->count() ?? 0;
            $thisMonthAttendance = Attendance::whereMonth('date', $currentMonth)
                ->whereYear('date', $currentYear)
                ->count() ?? 0;

            // Cuti Statistics
            $pendingCuti = Cuti::where('status', 'requested')->count() ?? 0;
            $approvedCuti = Cuti::where('status', 'approve')->count() ?? 0;
            $rejectedCuti = Cuti::where('status', 'rejected')->count() ?? 0;

            // Salary Statistics
            $totalSalaryThisMonth = Salary::where('month', $currentMonth)
                ->where('year', $currentYear)
                ->sum('total_salary') ?? 0;
            $totalSalaryLastMonth = Salary::where('month', $lastMonth)
                ->where('year', $lastYear)
                ->sum('total_salary') ?? 0;
            $salaryGrowth = $totalSalaryLastMonth > 0 ? (($totalSalaryThisMonth - $totalSalaryLastMonth) / $totalSalaryLastMonth) * 100 : 0;

            // Vendor & Bank Statistics
            $totalVendors = Vendor::count() ?? 0;
            $totalBanks = Bank::count() ?? 0;

            // Recent Activities
            $recentInvoices = Invoice::latest()->take(5)->get() ?? collect();
            $recentClients = Client::latest()->take(3)->get() ?? collect();
            $recentEvents = Event::latest()->take(3)->get() ?? collect();
            $recentEmployees = Employee::latest()->take(3)->get() ?? collect();

            // Monthly Revenue Chart Data (Last 6 months)
            $monthlyRevenue = [];
            for ($i = 5; $i >= 0; $i--) {
                $month = Carbon::now()->subMonths($i);
                $revenue = Invoice::where('status', 'paid')
                    ->whereMonth('tgl_paid', $month->month)
                    ->whereYear('tgl_paid', $month->year)
                    ->sum('total_invoice') ?? 0;
                
                $monthlyRevenue[] = [
                    'month' => $month->format('M Y'),
                    'revenue' => $revenue
                ];
            }

            // Invoice Status Distribution
            $invoiceStatusData = [
                'Draft' => Invoice::where('status', 'draft')->count() ?? 0,
                'Sent' => Invoice::where('status', 'sent')->count() ?? 0,
                'Paid' => Invoice::where('status', 'paid')->count() ?? 0,
                'Overdue' => Invoice::where('status', 'overdue')->count() ?? 0,
                'Cancelled' => Invoice::where('status', 'cancelled')->count() ?? 0,
            ];

            return view('dashboard', compact(
                'totalInvoices', 'totalInvoicesThisMonth', 'invoiceGrowth',
                'pendingInvoices', 'paidInvoices', 'overdueInvoices',
                'totalRevenue', 'revenueThisMonth', 'revenueGrowth',
                'totalClients', 'activeClients', 'newClientsThisMonth',
                'totalEmployees', 'activeEmployees',
                'totalEvents', 'upcomingEvents', 'eventsThisMonth',
                'todayAttendance', 'thisMonthAttendance',
                'pendingCuti', 'approvedCuti', 'rejectedCuti',
                'totalSalaryThisMonth', 'totalSalaryLastMonth', 'salaryGrowth',
                'totalVendors', 'totalBanks',
                'recentInvoices', 'recentClients', 'recentEvents', 'recentEmployees',
                'monthlyRevenue', 'invoiceStatusData'
            ));

        } catch (\Exception $e) {
            // Log error
            Log::error('Dashboard error: ' . $e->getMessage());
            
            // Return default values if there's an error
            return view('dashboard', [
                'totalInvoices' => 0,
                'totalInvoicesThisMonth' => 0,
                'invoiceGrowth' => 0,
                'pendingInvoices' => 0,
                'paidInvoices' => 0,
                'overdueInvoices' => 0,
                'totalRevenue' => 0,
                'revenueThisMonth' => 0,
                'revenueGrowth' => 0,
                'totalClients' => 0,
                'activeClients' => 0,
                'newClientsThisMonth' => 0,
                'totalEmployees' => 0,
                'activeEmployees' => 0,
                'totalEvents' => 0,
                'upcomingEvents' => 0,
                'eventsThisMonth' => 0,
                'todayAttendance' => 0,
                'thisMonthAttendance' => 0,
                'pendingCuti' => 0,
                'approvedCuti' => 0,
                'rejectedCuti' => 0,
                'totalSalaryThisMonth' => 0,
                'totalSalaryLastMonth' => 0,
                'salaryGrowth' => 0,
                'totalVendors' => 0,
                'totalBanks' => 0,
                'recentInvoices' => collect(),
                'recentClients' => collect(),
                'recentEvents' => collect(),
                'recentEmployees' => collect(),
                'monthlyRevenue' => [],
                'invoiceStatusData' => []
            ]);
        }
    }
}
