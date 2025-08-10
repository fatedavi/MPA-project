<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display admin dashboard.
     */
    public function index()
    {
        // Sample data for admin dashboard
        $stats = [
            'total_clients' => 25,
            'total_projects' => 18,
            'total_invoices' => 45,
            'total_revenue' => 1250000,
            'pending_invoices' => 8,
            'overdue_invoices' => 3,
            'active_projects' => 12,
            'completed_projects' => 6
        ];
        
        $recent_activities = [
            [
                'type' => 'client_created',
                'message' => 'New client PT Maju Bersama added',
                'time' => '2 hours ago'
            ],
            [
                'type' => 'invoice_sent',
                'message' => 'Invoice INV-001 sent to PT Maju Bersama',
                'time' => '4 hours ago'
            ],
            [
                'type' => 'project_completed',
                'message' => 'Project "MPA System Development" completed',
                'time' => '1 day ago'
            ]
        ];
        
        return view('admin.index', compact('stats', 'recent_activities'));
    }
} 