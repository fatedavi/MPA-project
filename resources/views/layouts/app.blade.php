<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EPower') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-xl border-r border-gray-200 transform transition-transform duration-300 ease-in-out"
            :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }" x-data="{ sidebarOpen: true }">

            <!-- Sidebar Header -->
            <div class="flex items-center justify-between h-16 px-6 border-b border-gray-200">
                <div class="flex items-center">
                    <div
                        class="w-8 h-8 bg-gradient-to-r from-[#8D0907] to-[#B91C1C] rounded-lg mr-3 flex items-center justify-center">
                        <i class="fas fa-bolt text-white text-lg"></i>
                    </div>
                    <span class="text-xl font-bold text-gray-900">EPower</span>
                </div>

                <!-- Mobile close button -->
                <button @click="sidebarOpen = false"
                    class="lg:hidden p-1 rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-100">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Sidebar Navigation -->
            <nav class="mt-6 px-3 overflow-y-auto h-[calc(100vh-4rem)]">
                <div class="space-y-2">
                    <!-- Dashboard -->
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'bg-[#8D0907] text-white shadow-lg' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
                        <i class="fas fa-tachometer-alt w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-400' }}"></i>
                        Dashboard
                    </a>
                    
                    <!-- Master Data Section -->
                    <div class="pt-4">
                        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3 px-3">Master Data
                        </h3>
                                                @auth
                            @if (in_array(auth()->user()->role, ['admin', 'super_admin']))
                                <!-- Perusahaan Management -->
                                <a href="{{ route('perusahaan.index') }}"
                                    class="flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('perusahaan.*') ? 'bg-[#8D0907] text-white shadow-lg' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
                                    <i class="fas fa-building w-5 h-5 mr-3 {{ request()->routeIs('perusahaan.*') ? 'text-white' : 'text-gray-400' }}"></i>
                                    Perusahaan
                                </a>
                            @endif
                        @endauth
                        @auth
                            @if (in_array(auth()->user()->role, ['admin', 'super_admin']))
                                <!-- Clients Management -->
                                <a href="{{ route('clients.index') }}"
                                    class="flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('clients.*') ? 'bg-[#8D0907] text-white shadow-lg' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
                                    <i class="fas fa-users w-5 h-5 mr-3 {{ request()->routeIs('clients.*') ? 'text-white' : 'text-gray-400' }}"></i>
                                    Clients
                                </a>
                            @endif
                        @endauth
                            @auth
                            @if (in_array(auth()->user()->role, ['admin', 'super_admin']))
                                <!-- Bank Management -->
                                <a href="{{ route('bank.index') }}"
                                    class="flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('bank.*') ? 'bg-[#8D0907] text-white shadow-lg' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
                                    <i class="fas fa-university w-5 h-5 mr-3 {{ request()->routeIs('bank.*') ? 'text-white' : 'text-gray-400' }}"></i>
                                    Bank
                                </a>
                            @endif
                        @endauth
                        @auth
                            @if (in_array(auth()->user()->role, ['admin', 'super_admin']))
                                <!-- Vendor Management -->
                                <a href="{{ route('vendors.index') }}"
                                    class="flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('vendors.*') ? 'bg-[#8D0907] text-white shadow-lg' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
                                    <i class="fas fa-users w-5 h-5 mr-3 {{ request()->routeIs('vendors.*') ? 'text-white' : 'text-gray-400' }}"></i>
                                    Vendor
                                </a>
                            @endif
                        @endauth
                        
                        </div>
                    
                    <!-- HR Management Section -->
                    <div class="pt-4">
                        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3 px-3">HR Management
                        </h3>
{{-- 
                        @auth
                            @if (in_array(auth()->user()->role, ['admin', 'super_admin']))
                                <!-- Admin Management -->
                                <a href="{{ route('admin.index') }}"
                                    class="flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.*') ? 'bg-[#8D0907] text-white shadow-lg' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
                                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.*') ? 'text-white' : 'text-gray-400' }}"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                    </svg>
                                    Admin
                                </a>
                            @endif
                        @endauth --}}

                        @auth
                            @if (in_array(auth()->user()->role, ['admin', 'super_admin']))
                                <!-- Employee Management -->
                                <a href="{{ route('employees.index') }}"
                                    class="flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('employees.*') ? 'bg-[#8D0907] text-white shadow-lg' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
                                    <i class="fas fa-user-tie w-5 h-5 mr-3 {{ request()->routeIs('employees.*') ? 'text-white' : 'text-gray-400' }}"></i>
                                    Employee
                                </a>
                            @endif
                        @endauth

                        @auth
                            @if (auth()->user()->role === 'karyawan')
                                <!-- Cuti Management -->
                                <a href="{{ route('cuti.index') }}"
                                    class="flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('cuti.index') ? 'bg-[#8D0907] text-white shadow-lg' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
                                    <i class="fas fa-calendar-alt w-5 h-5 mr-3 {{ request()->routeIs('cuti.index') ? 'text-white' : 'text-gray-400' }}"></i>
                                    Cuti
                                </a>
                            @endif
                        @endauth

                        @auth
                            @if (in_array(auth()->user()->role, ['admin', 'super_admin']))
                                <!-- Daftar Cuti Management -->
                                <a href="{{ route('cuti.admin.index') }}"
                                    class="flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('cuti.admin.*') ? 'bg-[#8D0907] text-white shadow-lg' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
                                    <i class="fas fa-list-alt w-5 h-5 mr-3 {{ request()->routeIs('cuti.admin.*') ? 'text-white' : 'text-gray-400' }}"></i>
                                    Daftar Cuti
                                </a>
                            @endif
                        @endauth

                        @auth
                            @if (in_array(auth()->user()->role, ['admin', 'super_admin']))
                                <!-- Gaji Management -->
                                <a href="{{ route('salary.index') }}"
                                    class="flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('salary.*') ? 'bg-[#8D0907] text-white shadow-lg' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
                                    <i class="fas fa-money-bill-wave w-5 h-5 mr-3 {{ request()->routeIs('salary.*') ? 'text-white' : 'text-gray-400' }}"></i>
                                    Gaji
                                </a>
                            @endif
                        @endauth

                        @auth
                            @if (auth()->user()->role === 'karyawan')
                                <!-- Absen Karyawan Management -->
                                <a href="{{ route('attendances.index') }}"
                                    class="flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('attendances.*') ? 'bg-[#8D0907] text-white shadow-lg' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
                                    <i class="fas fa-clock w-5 h-5 mr-3 {{ request()->routeIs('attendances.*') ? 'text-white' : 'text-gray-400' }}"></i>
                                    Absen Karyawan
                                </a>
                            @endif
                        @endauth

                        @auth
                            @if (auth()->user()->role === 'karyawan')
                                <!-- Slip Gaji Management -->
                                <a href="{{ route('salary.my') }}"
                                    class="flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('salary.my') ? 'bg-[#8D0907] text-white shadow-lg' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
                                    <i class="fas fa-file-invoice-dollar w-5 h-5 mr-3 {{ request()->routeIs('salary.my') ? 'text-white' : 'text-gray-400' }}"></i>
                                    Slip Gaji
                                </a>
                            @endif
                        @endauth

                        @auth
                            @if (in_array(auth()->user()->role, ['admin']))
                                <!-- Event Management -->
                                <a href="{{ route('events.index') }}"
                                    class="flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200
                                            {{ request()->routeIs('events.*') && !request()->routeIs('events.admin') ? 'bg-[#8D0907] text-white shadow-lg' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
                                    <i class="fas fa-calendar w-5 h-5 mr-3 {{ request()->routeIs('events.*') && !request()->routeIs('events.admin') ? 'text-white' : 'text-gray-400' }}"></i>
                                    Event
                                </a>
                            @endif
                        @endauth

                        @auth
                            @if (in_array(auth()->user()->role, ['admin', 'super_admin']))
                                <!-- Event Attendances Management -->
                                <a href="{{ route('event-attendances.index') }}"
                                    class="flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('event-attendances.*') ? 'bg-[#8D0907] text-white shadow-lg' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
                                    <i class="fas fa-user-check w-5 h-5 mr-3 {{ request()->routeIs('event-attendances.*') ? 'text-white' : 'text-gray-400' }}"></i>
                                    Event Attendances
                                </a>
                            @endif
                        @endauth

                        @auth
                            @if (auth()->user()->role === 'super_admin')
                                <!-- Event Approve Management -->
                                <a href="{{ route('events.admin') }}"
                                    class="flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200
                                            {{ request()->routeIs('events.admin') ? 'bg-[#8D0907] text-white shadow-lg' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
                                    <i class="fas fa-check-double w-5 h-5 mr-3 {{ request()->routeIs('events.admin') ? 'text-white' : 'text-gray-400' }}"></i>
                                    Event Approve
                                </a>
                            @endif
                        @endauth




                        @auth
                            @if (in_array(auth()->user()->role, ['admin', 'super_admin']))
                                <!-- Users Management -->
                                <a href="{{ route('users.index') }}"
                                    class="flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('users.*') ? 'bg-[#8D0907] text-white shadow-lg' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
                                    <i class="fas fa-users-cog w-5 h-5 mr-3 {{ request()->routeIs('users.*') ? 'text-white' : 'text-gray-400' }}"></i>
                                    Users
                                </a>
                            @endif
                        @endauth

                    </div>




                    <!-- Invoice Section -->
                    <div class="pt-4">
                        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3 px-3">Invoice
                            Management</h3>

                        <!-- MPA Invoice -->
                        <a href="{{ route('invoice.mpa') }}"
                            class="flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('invoice.mpa') ? 'bg-[#8D0907] text-white shadow-lg' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
                            <i class="fas fa-file-invoice w-5 h-5 mr-3 {{ request()->routeIs('invoice.mpa') ? 'text-white' : 'text-gray-400' }}"></i>
                            MPA Invoice
                        </a>

                        <!-- Rajata Invoice -->
                        {{-- <a href="#"
                            class="flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Rajata Invoice
                        </a> --}}
                        <!-- Ramada Invoice -->
                        {{-- <a href="#"
                            class="flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Ramada Invoice
                        </a> --}}

                        <!-- Nains Media Invoice -->
                        {{-- <a href="#"
                            class="flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Nains Media Invoice
                        </a> --}}
                        <!-- Crafttime Invoice -->
                        {{-- <a href="#"
                            class="flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Crafttime Invoice
                        </a> --}}
                        <!-- Archico Invoice -->
                        {{-- <a href="#"
                            class="flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Archico Invoice
                        </a> --}}
                        <!-- Multi Creative Invoice -->
                        {{-- <a href="#"
                            class="flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Multi Creative Invoice
                        </a> --}}

                    </div>

                    <!-- Purchase Order Section -->
                    <div class="pt-4">
                        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3 px-3">Purchase
                            Order</h3>

                        <!-- Current PO -->
                        <a href="#"
                            class="flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                            <i class="fas fa-shopping-cart w-5 h-5 mr-3 text-gray-400"></i>
                            Purchase Order
                        </a>

                        <!-- PO 2019 -->
                        {{-- <a href="#"
                            class="flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            PO 2019
                        </a> --}}
                    </div>

                    <!-- SPH Section -->
                    <div class="pt-4">
                        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3 px-3">Surat
                            Penawaran Harga</h3>

                        <!-- SPH All -->
                        <a href="#"
                            class="flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                            <i class="fas fa-file-contract w-5 h-5 mr-3 text-gray-400"></i>
                            SPH All
                        </a>

                        <!-- SPH Rajata -->
                        {{-- <a href="#"
                            class="flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            SPH Rajata
                        </a> --}}
                    </div>

                    <!-- Realisasi Section -->
                    <div class="pt-4">
                        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3 px-3">Realisasi &
                            Justifikasi</h3>

                        <!-- Realisasi -->
                        <a href="#"
                            class="flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                            <i class="fas fa-check-circle w-5 h-5 mr-3 text-gray-400"></i>
                            Realisasi
                        </a>

                        <!-- Justifikasi -->
                        <a href="#"
                            class="flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                            <i class="fas fa-question-circle w-5 h-5 mr-3 text-gray-400"></i>
                            Justifikasi
                        </a>
                    </div>

                    <!-- BA Section -->
                    <div class="pt-4">
                        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3 px-3">Berita Acara
                        </h3>

                        <!-- BAST -->
                        <a href="#"
                            class="flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                            <i class="fas fa-file-signature w-5 h-5 mr-3 text-gray-400"></i>
                            BAST
                        </a>

                        <!-- BAKN -->
                        <a href="#"
                            class="flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                            <i class="fas fa-file-alt w-5 h-5 mr-3 text-gray-400"></i>
                            BAKN
                        </a>
                    </div>

                    <!-- Reports Section -->
                    <div class="pt-4">
                        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3 px-3">Reports &
                            Analytics</h3>

                        <!-- Financial Reports -->
                        {{-- <a href="#"
                            class="flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            Financial Reports
                        </a> --}}

                        <!-- Project Reports -->
                        <a href="#"
                            class="flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                            <i class="fas fa-chart-bar w-5 h-5 mr-3 text-gray-400"></i>
                            Project Reports
                        </a>

                        <!-- Entity Reports -->
                        <a href="#"
                            class="flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                            <i class="fas fa-chart-pie w-5 h-5 mr-3 text-gray-400"></i>
                            Entity Reports
                        </a>
                    </div>

                    <!-- Settings Section -->
                    <div class="pt-4">
                        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3 px-3">System</h3>

                        <!-- Settings -->
                        <a href="{{ route('settings.index') }}"
                            class="flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                            <i class="fas fa-cog w-5 h-5 mr-3 text-gray-400"></i>
                            Settings
                        </a>

                        <!-- Digital Signature -->
                        <a href="#"
                            class="flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                            <i class="fas fa-signature w-5 h-5 mr-3 text-gray-400"></i>
                            Digital Signature
                        </a>
                    </div>
                </div>

                <!-- Divider -->
                <div class="border-t border-gray-200 my-6"></div>

                <!-- Quick Stats -->
                {{-- <div class="px-3">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Quick Stats</h3>
                    <div class="space-y-3">
                        <div class="bg-gray-50 rounded-lg p-3">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Today's Sales</span>
                                <span class="text-sm font-semibold text-green-600">$2,847</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-1.5 mt-2">
                                <div class="bg-green-500 h-1.5 rounded-full" style="width: 70%"></div>
                            </div>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-3">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">New Users</span>
                                <span class="text-sm font-semibold text-blue-600">+24</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-1.5 mt-2">
                                <div class="bg-blue-500 h-1.5 rounded-full" style="width: 45%"></div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </nav>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 lg:ml-64">
            <!-- Top Navigation Bar -->
            <div class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-40">
                <div class="flex items-center justify-between h-16 px-6">
                    <!-- Left side - Mobile menu button and breadcrumb -->
                    <div class="flex items-center">
                        <!-- Mobile menu button -->
                        <button @click="sidebarOpen = true"
                            class="lg:hidden p-2 rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-100 mr-3">
                            <i class="fas fa-bars text-xl"></i>
                        </button>

                        <!-- Breadcrumb -->
                        <nav class="flex" aria-label="Breadcrumb">
                            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                                <li class="inline-flex items-center">
                                    <a href="{{ route('dashboard') }}"
                                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-[#8D0907]">
                                        <i class="fas fa-home mr-2"></i>
                                        Home
                                    </a>
                                </li>
                                @if (request()->routeIs('dashboard'))
                                    <li>
                                        <div class="flex items-center">
                                            <i class="fas fa-chevron-right w-6 h-6 text-gray-400"></i>
                                            <span
                                                class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Dashboard</span>
                                        </div>
                                    </li>
                                @endif
                            </ol>
                        </nav>
                    </div>

                    <!-- Right side - Search and user menu -->
                    <div class="flex items-center space-x-4">
                        <!-- Search -->
                        <div class="hidden md:block relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search h-5 w-5 text-gray-400"></i>
                            </div>
                            <input type="text" placeholder="Search..."
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                        </div>

                        <!-- Notifications -->
                        <button class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-md relative">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="absolute top-1 right-1 block h-2 w-2 rounded-full bg-red-400"></span>
                        </button>

                        <!-- User dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#8D0907]">
                                <div
                                    class="w-8 h-8 bg-gradient-to-r from-[#8D0907] to-[#B91C1C] rounded-full flex items-center justify-center text-white font-semibold">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span class="ml-2 text-gray-700 hidden md:block">{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down ml-1 h-4 w-4 text-gray-400"></i>
                            </button>

                            <div x-show="open" @click.away="open = false"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                                <a href="{{ route('profile.edit') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Your Profile</a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                                <div class="border-t border-gray-100"></div>
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sign
                                        out</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto">
                @if (isset($header))
                    <header class="bg-white shadow-sm border-b border-gray-200">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <div class="py-6">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    <!-- Overlay for mobile -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false"
        class="fixed inset-0 z-40 lg:hidden bg-gray-600 bg-opacity-75 transition-opacity"
        x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>
</body>

</html>
