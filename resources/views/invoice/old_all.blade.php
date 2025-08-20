<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Invoice Management - Old Data') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-[#8D0907]">
                            <i class="fas fa-home mr-2"></i>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right w-6 h-6 text-gray-400"></i>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Old Invoice Data</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-400 rounded-full">
                            <i class="fas fa-file-invoice text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-blue-100 text-sm font-medium">Total Invoices</p>
                            <p class="text-2xl font-bold">{{ $invoices->total() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-400 rounded-full">
                            <i class="fas fa-users text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-green-100 text-sm font-medium">Unique Clients</p>
                            <p class="text-2xl font-bold">
                                @php
                                    $uniqueClients = collect($invoices->items())
                                        ->pluck('nama_client')
                                        ->unique()
                                        ->count();
                                @endphp
                                {{ $uniqueClients }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="p-3 bg-yellow-400 rounded-full">
                            <i class="fas fa-calendar text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-yellow-100 text-sm font-medium">Latest Invoice</p>
                            <p class="text-2xl font-bold">
                                @if (count($invoices->items()) > 0)
                                    {{ \Carbon\Carbon::parse($invoices->items()[0]->tgl_invoice)->format('M Y') }}
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="p-3 bg-purple-400 rounded-full">
                            <i class="fas fa-money-bill-wave text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-purple-100 text-sm font-medium">Total Value</p>
                            <p class="text-2xl font-bold">IDR
                                {{ number_format($totalValue, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Main Content -->
            <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <h3 class="text-lg font-semibold text-gray-700 flex items-center gap-2">
                            <i class="fas fa-file-invoice text-[#8D0907]"></i>
                            Old Invoice Data
                        </h3>
                        <div class="mt-2 sm:mt-0">
                            <span class="text-sm text-gray-500">
                                <i class="fas fa-info-circle mr-1"></i>
                                Historical invoice data from previous system
                            </span>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <!-- Header with Search -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                        <div class="mb-4 sm:mb-0">
                            <h3 class="text-lg font-medium text-gray-900">Invoice History</h3>
                            <p class="text-sm text-gray-500">Browse historical invoice records</p>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3">
                            <!-- Search Form -->
                            <form method="GET" action="{{ route('invoice.old_all') }}" class="flex gap-3">
                                <!-- Search -->
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-search h-5 w-5 text-gray-400"></i>
                                    </div>
                                    <input type="text" name="search" placeholder="Search invoices..."
                                        value="{{ request('search') }}"
                                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#8D0907] focus:border-[#8D0907] transition-colors">
                                </div>

                                <!-- Filters -->
                                @php
                                    $uniqueClients = collect($invoices->items())->pluck('nama_client')->unique();
                                    $uniqueTypes = collect($invoices->items())->pluck('jenis_no')->unique()->filter();
                                @endphp

                                <select name="client"
                                    class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#8D0907] focus:border-[#8D0907] transition-colors">
                                    <option value="">All Clients</option>
                                    @foreach ($uniqueClients as $client)
                                        <option value="{{ $client }}"
                                            {{ request('client') == $client ? 'selected' : '' }}>{{ $client }}
                                        </option>
                                    @endforeach
                                </select>

                                <select name="type"
                                    class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#8D0907] focus:border-[#8D0907] transition-colors">
                                    <option value="">All Types</option>
                                    @foreach ($uniqueTypes as $jenis)
                                        <option value="{{ $jenis }}"
                                            {{ request('type') == $jenis ? 'selected' : '' }}>{{ $jenis }}
                                        </option>
                                    @endforeach
                                </select>

                                <input type="date" name="date" value="{{ request('date') }}"
                                    class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#8D0907] focus:border-[#8D0907] transition-colors">

                                <button type="submit"
                                    class="px-4 py-2 bg-[#8D0907] text-white rounded-lg text-sm hover:bg-[#6a0706] focus:outline-none focus:ring-2 focus:ring-[#8D0907] transition-colors">
                                    Apply
                                </button>

                                @if (request()->hasAny(['search', 'client', 'type', 'date']))
                                    <a href="{{ route('invoice.old_all') }}"
                                        class="px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-sm text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-[#8D0907] transition-colors">
                                        Reset
                                    </a>
                                @endif
                            </form>
                        </div>
                    </div>

                    <!-- Invoice Table -->
                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <input type="checkbox"
                                            class="rounded border-gray-300 text-[#8D0907] focus:ring-[#8D0907]">
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-file-invoice mr-2"></i>Invoice Code
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-user mr-2"></i>Client Info
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-list mr-2"></i>Description
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-money-bill-wave mr-2"></i>Amount
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-university mr-2"></i>Bank Info
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-calendar mr-2"></i>Dates
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($invoices as $invoice)
                                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <input type="checkbox"
                                                class="rounded border-gray-300 text-[#8D0907] focus:ring-[#8D0907]">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-10 h-10 rounded-lg bg-gradient-to-r from-[#8D0907] to-[#B91C1C] flex items-center justify-center text-white font-semibold">
                                                    <i class="fas fa-file-invoice text-lg"></i>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $invoice->kd_invoice }}
                                                    </div>
                                                    @if ($invoice->no_fpb)
                                                        <div class="text-xs text-gray-500">
                                                            FPB: {{ $invoice->no_fpb }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                <i class="fas fa-user mr-1 text-[#8D0907]"></i>
                                                {{ $invoice->nama_client }}
                                            </div>
                                            @if ($invoice->alamat_client)
                                                <div class="text-xs text-gray-500 max-w-xs truncate"
                                                    title="{{ $invoice->alamat_client }}">
                                                    <i class="fas fa-map-marker-alt mr-1"></i>
                                                    {{ Str::limit($invoice->alamat_client, 40) }}
                                                </div>
                                            @endif
                                            @if ($invoice->up)
                                                <div class="text-xs text-gray-600">
                                                    <i class="fas fa-user-tie mr-1"></i>
                                                    UP: {{ $invoice->up }}
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900 max-w-xs">
                                                <div class="font-medium truncate" title="{{ $invoice->hdeskripsi }}">
                                                    {{ Str::limit($invoice->hdeskripsi, 30) }}
                                                </div>
                                                @if ($invoice->jenis_no)
                                                    <div
                                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mt-1">
                                                        {{ $invoice->jenis_no }}
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                IDR {{ number_format($invoice->total_invoice, 0, ',', '.') }}
                                            </div>
                                            <div class="text-xs text-gray-500">Total Amount</div>
                                            <div class="text-sm font-semibold text-[#8D0907] mt-1">
                                                Status:
                                                <span
                                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                                    {{ $invoice->status === 'paid'
                                                        ? 'bg-green-100 text-green-800'
                                                        : ($invoice->status === 'pending'
                                                            ? 'bg-yellow-100 text-yellow-800'
                                                            : 'bg-red-100 text-red-800') }}">
                                                    {{ ucfirst($invoice->status) }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">
                                                <i class="fas fa-university mr-1 text-[#8D0907]"></i>
                                                {{ $invoice->nama_bank }}
                                            </div>
                                            @if ($invoice->an)
                                                <div class="text-xs text-gray-600">
                                                    <i class="fas fa-user mr-1"></i>
                                                    A/N: {{ $invoice->an }}
                                                </div>
                                            @endif
                                            @if ($invoice->ac)
                                                <div class="text-xs text-gray-600">
                                                    <i class="fas fa-credit-card mr-1"></i>
                                                    {{ $invoice->ac }}
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                <i class="fas fa-calendar-plus mr-1 text-[#8D0907]"></i>
                                                <div class="font-medium">
                                                    {{ \Carbon\Carbon::parse($invoice->tgl_invoice)->format('M d, Y') }}
                                                </div>
                                                <div class="text-xs text-gray-500">Invoice Date</div>
                                            </div>
                                            @if ($invoice->due_date)
                                                <div class="text-sm text-gray-900 mt-2">
                                                    <i class="fas fa-calendar-day mr-1 text-yellow-600"></i>
                                                    <div class="font-medium">
                                                        {{ \Carbon\Carbon::parse($invoice->due_date)->format('M d, Y') }}
                                                    </div>
                                                    <div class="text-xs text-gray-500">Due Date</div>
                                                </div>
                                            @endif
                                            @if ($invoice->tgl_paid)
                                                <div class="text-sm text-green-900 mt-2">
                                                    <i class="fas fa-check-circle mr-1 text-green-600"></i>
                                                    <div class="font-medium">
                                                        {{ \Carbon\Carbon::parse($invoice->tgl_paid)->format('M d, Y') }}
                                                    </div>
                                                    <div class="text-xs text-green-500">Paid Date</div>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center text-gray-500">
                                                <i class="fas fa-file-invoice text-4xl mb-3 text-gray-300"></i>
                                                <p class="text-lg font-medium">No old invoice data found</p>
                                                <p class="text-sm">No historical records available</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if ($invoices->hasPages())
                        <div class="mt-6">
                            {{ $invoices->appends(request()->query())->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
