<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('MPA Invoice Management') }}
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
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">MPA Invoice</span>
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
                            <i class="fas fa-check-circle text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-green-100 text-sm font-medium">Paid</p>
                            <p class="text-2xl font-bold">{{ $invoices->where('status', 'paid')->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="p-3 bg-yellow-400 rounded-full">
                            <i class="fas fa-clock text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-yellow-100 text-sm font-medium">Pending</p>
                            <p class="text-2xl font-bold">{{ $invoices->where('status', 'pending')->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="p-3 bg-purple-400 rounded-full">
                            <i class="fas fa-money-bill-wave text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-purple-100 text-sm font-medium">Total Amount</p>
                            <p class="text-2xl font-bold">IDR
                                {{ number_format($invoices->sum('total_invoice'), 0, ',', '.') }}</p>
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
                            MPA Invoice List
                        </h3>
                        <div class="mt-2 sm:mt-0">
                            <span class="text-sm text-gray-500">
                                <i class="fas fa-info-circle mr-1"></i>
                                Manage MPA invoices, payments, and billing information
                            </span>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <!-- Success Notifications -->
                    @if (session('success'))
                        <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle mr-3 text-green-500"></i>
                                <div>
                                    <p class="text-sm font-medium text-green-800">
                                        {{ session('success') }}
                                    </p>
                                    @if (session('invoice_id'))
                                        <p class="text-xs text-green-600 mt-1">
                                            Invoice ID: {{ session('invoice_id') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Error Notifications -->
                    @if (session('error'))
                        <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-circle mr-3 text-red-500"></i>
                                <p class="text-sm font-medium text-red-800">
                                    {{ session('error') }}
                                </p>
                            </div>
                        </div>
                    @endif

                    <!-- Header with Search and Add Button -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                        <div class="mb-4 sm:mb-0">
                            <h3 class="text-lg font-medium text-gray-900">MPA Invoice List</h3>
                            <p class="text-sm text-gray-500">Manage MPA invoices, payments, and billing information</p>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3">
                            <!-- Search -->
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search h-5 w-5 text-gray-400"></i>
                                </div>
                                <input type="text" placeholder="Search invoices..."
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#8D0907] focus:border-[#8D0907] transition-colors">
                            </div>

                            <!-- Add Invoice Button -->
                            <a href="{{ route('invoice.create') }}"
                                class="inline-flex items-center px-6 py-2 bg-[#8D0907] text-white rounded-lg hover:bg-[#6B0705] transition-colors shadow-md hover:shadow-lg">
                                <i class="fas fa-plus mr-2"></i>
                                Create Invoice
                            </a>
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="flex flex-wrap gap-3 mb-6">
                        <select
                            class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#8D0907] focus:border-[#8D0907] transition-colors">
                            <option>All Status</option>
                            <option>Draft</option>
                            <option>Sent</option>
                            <option>Paid</option>
                            <option>Overdue</option>
                            <option>Cancelled</option>
                        </select>

                        <select
                            class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#8D0907] focus:border-[#8D0907] transition-colors">
                            <option>All Clients</option>
                            @foreach ($invoices->pluck('nama_client')->unique() as $client)
                                <option>{{ $client }}</option>
                            @endforeach
                        </select>

                        <input type="date"
                            class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#8D0907] focus:border-[#8D0907] transition-colors">

                        <button
                            class="px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-sm text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-[#8D0907] focus:border-[#8D0907] transition-colors">
                            Reset Filters
                        </button>
                    </div>

                    <!-- Invoice Table -->
                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                      
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-file-invoice mr-2"></i>Invoice
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-user mr-2"></i>Client
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-money-bill-wave mr-2"></i>Amount
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-info-circle mr-2"></i>Status
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-calendar mr-2"></i>Due Date
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-cogs mr-2"></i>Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($invoices as $invoice)
                                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                                        
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-10 h-10 rounded-lg bg-gradient-to-r from-[#8D0907] to-[#B91C1C] flex items-center justify-center text-white font-semibold">
                                                    <i class="fas fa-file-invoice text-lg"></i>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $invoice->no_invoice }}</div>
                                                    <div class="text-sm text-gray-500 max-w-xs truncate"
                                                        title="{{ $invoice->deskripsi ?? 'No description' }}">
                                                        {{ Str::limit($invoice->deskripsi ?? 'No description', 30) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                <i class="fas fa-user mr-1 text-[#8D0907]"></i>
                                                {{ $invoice->nama_client }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">IDR
                                                {{ number_format($invoice->total_invoice, 0, ',', '.') }}</div>
                                            <div class="text-sm text-gray-500">
                                                <i class="fas fa-university mr-1"></i>
                                                {{ $invoice->nama_bank }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                                $statusColors = [
                                                    'draft' => 'bg-gray-100 text-gray-800 border-gray-200',
                                                    'sent' => 'bg-blue-100 text-blue-800 border-blue-200',
                                                    'paid' => 'bg-green-100 text-green-800 border-green-200',
                                                    'overdue' => 'bg-red-100 text-red-800 border-red-200',
                                                    'cancelled' => 'bg-red-100 text-red-800 border-red-200',
                                                ];
                                                $statusColor =
                                                    $statusColors[$invoice->status] ??
                                                    'bg-gray-100 text-gray-800 border-gray-200';
                                                $statusIcon = [
                                                    'draft' => 'fas fa-edit',
                                                    'sent' => 'fas fa-paper-plane',
                                                    'paid' => 'fas fa-check-circle',
                                                    'overdue' => 'fas fa-exclamation-triangle',
                                                    'cancelled' => 'fas fa-times-circle',
                                                ];
                                                $icon = $statusIcon[$invoice->status] ?? 'fas fa-info-circle';
                                            @endphp
                                            <span
                                                class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium border {{ $statusColor }}">
                                                <i class="{{ $icon }} mr-1.5"></i>
                                                {{ ucfirst($invoice->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                <i class="fas fa-calendar-day mr-1 text-[#8D0907]"></i>
                                                {{ \Carbon\Carbon::parse($invoice->due_date)->format('M d, Y') }}
                                            </div>
                                            @if ($invoice->status === 'paid' && $invoice->tgl_paid)
                                                <div class="text-sm text-green-600">
                                                    <i class="fas fa-check mr-1"></i>
                                                    Paid on
                                                    {{ \Carbon\Carbon::parse($invoice->tgl_paid)->format('M d, Y') }}
                                                </div>
                                            @elseif($invoice->status === 'overdue')
                                                @php
                                                    $daysOverdue = \Carbon\Carbon::parse(
                                                        $invoice->due_date,
                                                    )->diffInDays(now());
                                                @endphp
                                                <div class="text-sm text-red-600">
                                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                                    Overdue by {{ $daysOverdue }} days
                                                </div>
                                            @else
                                                @php
                                                    $daysUntilDue = \Carbon\Carbon::parse(
                                                        $invoice->due_date,
                                                    )->diffInDays(now());
                                                @endphp
                                                @if ($daysUntilDue > 0)
                                                    <div class="text-sm text-yellow-600">
                                                        <i class="fas fa-clock mr-1"></i>
                                                        Due in {{ $daysUntilDue }} days
                                                    </div>
                                                @else
                                                    <div class="text-sm text-red-600">
                                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                                        Due today
                                                    </div>
                                                @endif
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('invoice.show', $invoice->id) }}"
                                                    class="inline-flex items-center px-3 py-1.5 bg-blue-500 text-white text-sm rounded-lg hover:bg-blue-600 transition-colors"
                                                    title="View Details">
                                                    <i class="fas fa-eye mr-1"></i>
                                                    View
                                                </a>
                                                {{-- <a href="{{ route('invoice.edit', $invoice->id) }}"
                                                    class="inline-flex items-center px-3 py-1.5 bg-yellow-500 text-white text-sm rounded-lg hover:bg-yellow-600 transition-colors"
                                                    title="Edit Invoice">
                                                    <i class="fas fa-edit mr-1"></i>
                                                    Edit
                                                </a> --}}
                                                <a href="{{ route('invoice.pdf', $invoice->id) }}" target="_blank"
                                                    class="inline-flex items-center px-3 py-1.5 bg-red-500 text-white text-sm rounded-lg hover:bg-red-600 transition-colors"
                                                    title="View PDF">
                                                    <i class="fas fa-file-pdf mr-1"></i>
                                                    PDF
                                                </a>
                                                <a href="{{ route('invoice.download', $invoice->id) }}"
                                                    class="inline-flex items-center px-3 py-1.5 bg-green-500 text-white text-sm rounded-lg hover:bg-green-600 transition-colors"
                                                    title="Download PDF">
                                                    <i class="fas fa-download mr-1"></i>
                                                    Download
                                                </a>
                                                <form action="{{ route('invoice.destroy', $invoice->id) }}"
                                                    method="POST" class="inline"
                                                    onsubmit="return confirm('Are you sure you want to delete this invoice?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-sm rounded-lg hover:bg-red-700 transition-colors">
                                                        <i class="fas fa-trash mr-1"></i>
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center text-gray-500">
                                                <i class="fas fa-file-invoice text-4xl mb-3 text-gray-300"></i>
                                                <p class="text-lg font-medium">No invoices found</p>
                                                <p class="text-sm">Create your first invoice to get started</p>
                                                <a href="{{ route('invoice.create') }}"
                                                    class="mt-4 inline-flex items-center px-4 py-2 bg-[#8D0907] text-white rounded-lg hover:bg-[#6B0705] transition-colors">
                                                    <i class="fas fa-plus mr-2"></i>
                                                    Create First Invoice
                                                </a>
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
                            {{ $invoices->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
