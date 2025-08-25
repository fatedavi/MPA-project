<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="bg-gradient-to-r from-[#8D0907] to-[#B91C1C] rounded-lg shadow-lg mb-6">
                <div class="px-6 py-8">
                    <div class="flex items-center justify-between">
                        <div class="text-white">
                            <h1 class="text-3xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}!</h1>
                            <p class="text-lg opacity-90">Overview sistem MPA hari ini - {{ now()->format('d F Y') }}</p>
                        </div>
                        <div class="hidden md:block">
                            <div class="w-24 h-24 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <!-- Invoice Stats -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Invoices</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ number_format($totalInvoices ?? 0) }}</p>
                                <p class="text-xs {{ ($invoiceGrowth ?? 0) >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ ($invoiceGrowth ?? 0) >= 0 ? '+' : '' }}{{ number_format($invoiceGrowth ?? 0, 1) }}% from last month
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Revenue Stats -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Revenue</p>
                                <p class="text-2xl font-semibold text-gray-900">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</p>
                                <p class="text-xs {{ ($revenueGrowth ?? 0) >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ ($revenueGrowth ?? 0) >= 0 ? '+' : '' }}{{ number_format($revenueGrowth ?? 0, 1) }}% from last month
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Client Stats -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-purple-500 rounded-md flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Active Clients</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ number_format($totalClients ?? 0) }}</p>
                                <p class="text-xs text-green-600">+{{ $newClientsThisMonth ?? 0 }} new this month</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Employee Stats -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-yellow-500 rounded-md flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Employees</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ number_format($totalEmployees ?? 0) }}</p>
                                <p class="text-xs text-blue-600">{{ $todayAttendance ?? 0 }} present today</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Secondary Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <!-- Pending Invoices -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-orange-500 rounded-md flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Pending Invoices</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ number_format($pendingInvoices ?? 0) }}</p>
                                <p class="text-xs text-orange-600">Awaiting payment</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Events -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-indigo-500 rounded-md flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Events</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ number_format($totalEvents ?? 0) }}</p>
                                <p class="text-xs text-indigo-600">{{ $upcomingEvents ?? 0 }} upcoming</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cuti -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-pink-500 rounded-md flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Pending Cuti</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ number_format($pendingCuti ?? 0) }}</p>
                                <p class="text-xs text-pink-600">Awaiting approval</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Salary -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-emerald-500 rounded-md flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Monthly Salary</p>
                                <p class="text-2xl font-semibold text-gray-900">Rp {{ number_format($totalSalaryThisMonth ?? 0, 0, ',', '.') }}</p>
                                <p class="text-xs {{ ($salaryGrowth ?? 0) >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ ($salaryGrowth ?? 0) >= 0 ? '+' : '' }}{{ number_format($salaryGrowth ?? 0, 1) }}% from last month
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts and Analytics -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Invoice Status Chart -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Invoice Status Overview</h3>
                        <div class="space-y-4">
                            @foreach($invoiceStatusData as $status => $count)
                                @if(($count ?? 0) > 0)
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-600">{{ $status }}</span>
                                        <div class="flex items-center">
                                            <div class="w-32 bg-gray-200 rounded-full h-2 mr-3">
                                                @php
                                                    $percentage = ($totalInvoices ?? 0) > 0 ? (($count ?? 0) / ($totalInvoices ?? 1)) * 100 : 0;
                                                    $color = match($status) {
                                                        'Paid' => 'bg-green-500',
                                                        'Draft' => 'bg-blue-500',
                                                        'Sent' => 'bg-yellow-500',
                                                        'Overdue' => 'bg-red-500',
                                                        'Cancelled' => 'bg-gray-500',
                                                        default => 'bg-blue-500'
                                                    };
                                                @endphp
                                                <div class="h-2 rounded-full {{ $color }}" style="width: {{ $percentage }}%"></div>
                                            </div>
                                            <span class="text-sm font-medium text-gray-900">{{ $count ?? 0 }}</span>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Monthly Revenue Chart -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Monthly Revenue (Last 6 Months)</h3>
                        <div class="space-y-4">
                            @foreach($monthlyRevenue as $data)
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">{{ $data['month'] ?? 'N/A' }}</span>
                                    <div class="flex items-center">
                                        <div class="w-32 bg-gray-200 rounded-full h-2 mr-3">
                                            @php
                                                $maxRevenue = max(array_column($monthlyRevenue, 'revenue'));
                                                $percentage = $maxRevenue > 0 ? (($data['revenue'] ?? 0) / $maxRevenue) * 100 : 0;
                                            @endphp
                                            <div class="bg-green-500 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                                        </div>
                                        <span class="text-sm font-medium text-gray-900">Rp {{ number_format($data['revenue'] ?? 0, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <a href="{{ route('events.index') }}" class="flex flex-col items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-2">
                                <i class="fas fa-calendar-alt text-blue-600 text-xl"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-900">Manage Events</span>
                        </a>
                        
                        <a href="{{ route('clients.index') }}" class="flex flex-col items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-2">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-900">Manage Clients</span>
                        </a>
                        
                        <a href="{{ route('employees.index') }}" class="flex flex-col items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-2">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-900">Manage Employees</span>
                        </a>
                        
                        <a href="{{ route('invoice.mpa') }}" class="flex flex-col items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mb-2">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-900">Manage Invoices</span>
                        </a>
                    </div>
                </div>
            </div> -->

            <!-- Recent Activities -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Recent Invoices -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Recent Invoices</h3>
                            <a href="{{ route('invoice.mpa') }}" class="text-sm text-[#8D0907] hover:text-[#B91C1C]">View all</a>
                        </div>
                        <div class="space-y-4">
                            @forelse($recentInvoices as $invoice)
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm text-gray-900">{{ $invoice->no_invoice ?? 'N/A' }} - {{ $invoice->nama_client ?? 'N/A' }}</p>
                                        <p class="text-xs text-gray-500">{{ $invoice->tgl_invoice ? $invoice->tgl_invoice->format('d M Y') : 'N/A' }} - {{ ucfirst($invoice->status ?? 'N/A') }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-medium text-gray-900">Rp {{ number_format($invoice->total_invoice ?? 0, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500 text-center py-4">No recent invoices</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Recent Events -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Recent Events</h3>
                            <a href="{{ route('events.index') }}" class="text-sm text-[#8D0907] hover:text-[#B91C1C]">View all</a>
                        </div>
                        <div class="space-y-4">
                            @forelse($recentEvents as $event)
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm text-gray-900">{{ $event->name ?? 'N/A' }}</p>
                                        <p class="text-xs text-gray-500">{{ $event->date ? $event->date->format('d M Y') : 'N/A' }} - {{ $event->status ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500 text-center py-4">No recent events</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- System Overview -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">System Overview</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <p class="text-2xl font-semibold text-gray-900">{{ $totalVendors ?? 0 }}</p>
                            <p class="text-sm text-gray-500">Vendors</p>
                        </div>
                        
                        <div class="text-center">
                            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                            </div>
                            <p class="text-2xl font-semibold text-gray-900">{{ $totalBanks ?? 0 }}</p>
                            <p class="text-sm text-gray-500">Banks</p>
                        </div>
                        
                        <div class="text-center">
                            <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <p class="text-2xl font-semibold text-gray-900">{{ $paidInvoices ?? 0 }}</p>
                            <p class="text-sm text-gray-500">Paid Invoices</p>
                        </div>
                        
                        <div class="text-center">
                            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <p class="text-2xl font-semibold text-gray-900">{{ $overdueInvoices ?? 0 }}</p>
                            <p class="text-sm text-gray-500">Overdue</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>