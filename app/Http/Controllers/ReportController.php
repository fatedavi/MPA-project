<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display reports dashboard.
     */
    public function index()
    {
        // Sample data for reports
        $reports = [
            'financial' => [
                'total_revenue' => 1250000,
                'total_expenses' => 850000,
                'net_profit' => 400000,
                'pending_invoices' => 8,
                'overdue_invoices' => 3
            ],
            'projects' => [
                'total_projects' => 18,
                'active_projects' => 12,
                'completed_projects' => 6,
                'on_time_delivery' => 85,
                'average_project_duration' => 45
            ],
            'clients' => [
                'total_clients' => 25,
                'active_clients' => 22,
                'new_clients_this_month' => 3,
                'client_satisfaction' => 92
            ]
        ];
        
        $monthly_data = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            'revenue' => [150000, 180000, 200000, 220000, 250000, 280000],
            'expenses' => [100000, 120000, 140000, 160000, 180000, 200000]
        ];
        
        return view('reports.index', compact('reports', 'monthly_data'));
    }
} 