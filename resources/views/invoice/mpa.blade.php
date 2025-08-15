<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('MPA Invoice Management') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                                    <i class="fas fa-file-invoice text-white text-lg"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Invoices</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $invoices->total() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                                    <i class="fas fa-check-circle text-white text-lg"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Paid</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $invoices->where('status', 'paid')->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-yellow-500 rounded-md flex items-center justify-center">
                                    <i class="fas fa-clock text-white text-lg"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Pending</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $invoices->where('status', 'pending')->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-red-500 rounded-md flex items-center justify-center">
                                    <i class="fas fa-money-bill-wave text-white text-lg"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Amount</p>
                                <p class="text-2xl font-semibold text-gray-900">IDR {{ number_format($invoices->sum('total_invoice'), 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Success Notifications -->
                    @if (session('success'))
                        <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
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
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.586 9L9.293 8.293a1 1 0 00-1.414-1.414L8 8.586 6.707 7.293a1 1 0 00-1.414 1.414L8 8.586z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-red-800">
                                        {{ session('error') }}
                                    </p>
                                </div>
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
                                <input type="text" placeholder="Search invoices..." class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                            </div>
                            
                            <!-- Add Invoice Button -->
                            <a href="{{ route('invoice.create') }}" class="inline-flex items-center px-4 py-2 bg-[#8D0907] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#B91C1C] focus:bg-[#B91C1C] active:bg-[#8D0907] focus:outline-none focus:ring-2 focus:ring-[#8D0907] focus:ring-offset-2 transition ease-in-out duration-150">
                                <i class="fas fa-plus w-4 h-4 mr-2"></i>
                                Create Invoice
                            </a>
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="flex flex-wrap gap-3 mb-6">
                        <select class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-1 focus:ring-[#8D0907] focus:border-[#8D0907]">
                            <option>All Status</option>
                            <option>Draft</option>
                            <option>Sent</option>
                            <option>Paid</option>
                            <option>Overdue</option>
                            <option>Cancelled</option>
                        </select>
                        
                        <select class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-1 focus:ring-[#8D0907] focus:border-[#8D0907]">
                            <option>All Clients</option>
                            @foreach($invoices->pluck('nama_client')->unique() as $client)
                                <option>{{ $client }}</option>
                            @endforeach
                        </select>
                        
                        <input type="date" class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-1 focus:ring-[#8D0907] focus:border-[#8D0907]">
                        
                        <button class="px-4 py-2 bg-gray-100 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-[#8D0907] focus:border-[#8D0907]">
                            Reset Filters
                        </button>
                    </div>

                    <!-- Invoice Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <input type="checkbox" class="rounded border-gray-300 text-[#8D0907] focus:ring-[#8D0907]">
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Invoice</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($invoices as $invoice)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="checkbox" class="rounded border-gray-300 text-[#8D0907] focus:ring-[#8D0907]">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div class="h-10 w-10 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center text-white font-semibold">
                                                    <i class="fas fa-file-invoice text-lg"></i>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $invoice->no_invoice }}</div>
                                                <div class="text-sm text-gray-500">{{ Str::limit($invoice->deskripsi ?? 'No description', 30) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $invoice->nama_client }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">IDR {{ number_format($invoice->total_invoice, 0, ',', '.') }}</div>
                                        <div class="text-sm text-gray-500">{{ $invoice->nama_bank }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusColors = [
                                                'draft' => 'bg-gray-100 text-gray-800',
                                                'sent' => 'bg-blue-100 text-blue-800',
                                                'paid' => 'bg-green-100 text-green-800',
                                                'overdue' => 'bg-red-100 text-red-800',
                                                'cancelled' => 'bg-red-100 text-red-800'
                                            ];
                                            $statusColor = $statusColors[$invoice->status] ?? 'bg-gray-100 text-gray-800';
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColor }}">
                                            {{ ucfirst($invoice->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($invoice->due_date)->format('M d, Y') }}</div>
                                        @if($invoice->status === 'paid' && $invoice->tgl_paid)
                                            <div class="text-sm text-green-600">Paid on {{ \Carbon\Carbon::parse($invoice->tgl_paid)->format('M d, Y') }}</div>
                                        @elseif($invoice->status === 'overdue')
                                            @php
                                                $daysOverdue = \Carbon\Carbon::parse($invoice->due_date)->diffInDays(now());
                                            @endphp
                                            <div class="text-sm text-red-600">Overdue by {{ $daysOverdue }} days</div>
                                        @else
                                            @php
                                                $daysUntilDue = \Carbon\Carbon::parse($invoice->due_date)->diffInDays(now());
                                            @endphp
                                            @if($daysUntilDue > 0)
                                                <div class="text-sm text-yellow-600">Due in {{ $daysUntilDue }} days</div>
                                            @else
                                                <div class="text-sm text-red-600">Due today</div>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('invoice.show', $invoice->id) }}" class="text-[#8D0907] hover:text-[#B91C1C]" title="View Details">
                                                <i class="fas fa-eye w-4 h-4"></i>
                                            </a>
                                            <a href="{{ route('invoice.edit', $invoice->id) }}" class="text-[#8D0907] hover:text-[#B91C1C]" title="Edit Invoice">
                                                <i class="fas fa-edit w-4 h-4"></i>
                                            </a>
                                            <a href="{{ route('invoice.pdf', $invoice->id) }}" target="_blank" class="text-blue-600 hover:text-blue-900" title="View PDF">
                                                <i class="fas fa-file-pdf w-4 h-4"></i>
                                            </a>
                                            <a href="{{ route('invoice.download', $invoice->id) }}" class="text-green-600 hover:text-green-900" title="Download PDF">
                                                <i class="fas fa-download w-4 h-4"></i>
                                            </a>
                                            <form action="{{ route('invoice.destroy', $invoice->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this invoice?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                        No invoices found. <a href="{{ route('invoice.create') }}" class="text-[#8D0907] hover:text-[#B91C1C]">Create your first invoice</a>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($invoices->hasPages())
                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center text-sm text-gray-700">
                            <span>Showing {{ $invoices->firstItem() }} to {{ $invoices->lastItem() }} of {{ $invoices->total() }} results</span>
                        </div>
                        
                        <div class="flex items-center space-x-2">
                            {{ $invoices->links() }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 