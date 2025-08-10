<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display settings page.
     */
    public function index()
    {
        // Sample settings data
        $settings = [
            'company' => [
                'name' => 'MPA Solutions',
                'email' => 'info@mpasolutions.com',
                'phone' => '+62 21 1234 5678',
                'address' => 'Jl. Sudirman No. 123, Jakarta Pusat',
                'website' => 'https://www.mpasolutions.com'
            ],
            'system' => [
                'timezone' => 'Asia/Jakarta',
                'date_format' => 'd/m/Y',
                'time_format' => 'H:i',
                'currency' => 'IDR',
                'language' => 'id'
            ],
            'notifications' => [
                'email_notifications' => true,
                'sms_notifications' => false,
                'invoice_reminders' => true,
                'project_updates' => true,
                'task_assignments' => true
            ]
        ];
        
        return view('settings.index', compact('settings'));
    }

    /**
     * Update settings.
     */
    public function update(Request $request)
    {
        // Simple validation
        $request->validate([
            'company_name' => 'required|string|max:255',
            'company_email' => 'required|email|max:255',
            'timezone' => 'required|string|max:100',
            'currency' => 'required|string|max:10',
        ]);

        // For now, just redirect with success message
        // In real application, you would update database here
        return redirect()->route('settings.index')
            ->with('success', 'Settings updated successfully!');
    }
} 