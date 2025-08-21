<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Invoice Management - Historical Data 2019') }}
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
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Historical Invoice 2019</span>
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
                            <p class="text-2xl font-bold">{{ $invoices->pluck('nama_client')->unique()->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="p-3 bg-yellow-400 rounded-full">
                            <i class="fas fa-calendar text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-yellow-100 text-sm font-medium">Year Period</p>
                            <p class="text-2xl font-bold">2019</p>
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
                            <p class="text-lg font-bold">IDR
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
                            <i class="fas fa-archive text-[#8D0907]"></i>
                            Historical Invoice Data 2019
                        </h3>
                        <div class="mt-2 sm:mt-0">
                            <span class="text-sm text-gray-500">
                                <i class="fas fa-info-circle mr-1"></i>
                                Archive data from invoice_all_19 table
                            </span>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <!-- Header with Search -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                        <div class="mb-4 sm:mb-0">
                            <h3 class="text-lg font-medium text-gray-900">Invoice Archive 2019</h3>
                            <p class="text-sm text-gray-500">Browse historical invoice records from 2019</p>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3">
                            <!-- Search -->
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search h-5 w-5 text-gray-400"></i>
                                </div>
                                <input type="text" id="searchInput" placeholder="Search invoices..."
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#8D0907] focus:border-[#8D0907] transition-colors">
                            </div>
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="flex flex-wrap gap-3 mb-6">
                        <select id="clientFilter"
                            class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#8D0907] focus:border-[#8D0907] transition-colors">
                            <option value="">All Clients</option>
                            @foreach ($invoices->pluck('nama_client')->unique()->sort() as $client)
                                <option value="{{ $client }}">{{ Str::limit($client, 30) }}</option>
                            @endforeach
                        </select>

                        <select id="typeFilter"
                            class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#8D0907] focus:border-[#8D0907] transition-colors">
                            <option value="">All Types</option>
                            @foreach ($invoices->pluck('jenis_no')->unique()->filter()->sort() as $jenis)
                                <option value="{{ $jenis }}">{{ $jenis }}</option>
                            @endforeach
                        </select>

                        <input type="date" id="dateFilter"
                            class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#8D0907] focus:border-[#8D0907] transition-colors">

                        <button id="resetFilter"
                            class="px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-sm text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-[#8D0907] focus:border-[#8D0907] transition-colors">
                            Reset Filters
                        </button>
                    </div>

                    <!-- Invoice Table -->
                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200" id="invoiceTable">
                            <thead class="bg-gray-50">
                                <tr>

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
                                        <i class="fas fa-list mr-2"></i>Document Details
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
                                    <tr class="hover:bg-gray-50 transition-colors duration-200 invoice-row"
                                        data-client="{{ $invoice->nama_client }}"
                                        data-type="{{ $invoice->jenis_no }}"
                                        data-date="{{ $invoice->tgl_invoice }}">

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-12 h-12 rounded-lg bg-gradient-to-r from-[#8D0907] to-[#B91C1C] flex items-center justify-center text-white font-bold text-sm">
                                                    {{ substr($invoice->kd_invoice, -3) }}
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-bold text-gray-900">
                                                        {{ $invoice->kd_invoice }}
                                                    </div>
                                                    <div class="text-xs text-gray-500">
                                                        Admin: {{ $invoice->kd_admin }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-gray-900 max-w-xs">
                                                <i class="fas fa-building mr-1 text-[#8D0907]"></i>
                                                <div class="font-semibold truncate"
                                                    title="{{ $invoice->nama_client }}">
                                                    {{ Str::limit($invoice->nama_client, 35) }}
                                                </div>
                                            </div>
                                            @if ($invoice->alamat_client)
                                                <div class="text-xs text-gray-500 max-w-xs mt-1"
                                                    title="{{ $invoice->alamat_client }}">
                                                    <i class="fas fa-map-marker-alt mr-1"></i>
                                                    {{ Str::limit($invoice->alamat_client, 50) }}
                                                </div>
                                            @endif
                                            @if ($invoice->up && $invoice->up !== '-')
                                                <div class="text-xs text-blue-600 mt-1">
                                                    <i class="fas fa-user-tie mr-1"></i>
                                                    UP: {{ Str::limit($invoice->up, 20) }}
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="space-y-1">
                                                @if ($invoice->jenis_no)
                                                    <div
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                        @if (str_contains(strtolower($invoice->jenis_no), 'po')) bg-blue-100 text-blue-800
                                                        @elseif(str_contains(strtolower($invoice->jenis_no), 'fpb')) bg-green-100 text-green-800
                                                        @elseif(str_contains(strtolower($invoice->jenis_no), 'kontrak')) bg-purple-100 text-purple-800
                                                        @elseif(str_contains(strtolower($invoice->jenis_no), 'sppk') || str_contains(strtolower($invoice->jenis_no), 'spk')) bg-orange-100 text-orange-800
                                                        @else bg-gray-100 text-gray-800 @endif">
                                                        {{ $invoice->jenis_no }}
                                                    </div>
                                                @endif
                                                @if ($invoice->no_fpb && $invoice->no_fpb !== '-')
                                                    <div class="text-xs text-gray-600 max-w-xs truncate"
                                                        title="{{ $invoice->no_fpb }}">
                                                        <i class="fas fa-file-alt mr-1"></i>
                                                        {{ Str::limit($invoice->no_fpb, 25) }}
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($invoice->total_invoice > 0)
                                                <div class="text-lg font-bold text-[#8D0907]">
                                                    IDR {{ number_format($invoice->total_invoice, 0, ',', '.') }}
                                                </div>
                                                <div class="text-xs text-gray-500">
                                                    <i class="fas fa-calculator mr-1"></i>
                                                    Total Invoice
                                                </div>
                                            @else
                                                <div class="text-sm text-gray-400">
                                                    <i class="fas fa-minus mr-1"></i>
                                                    No Amount
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900 max-w-xs">
                                                <i class="fas fa-university mr-1 text-[#8D0907]"></i>
                                                <div class="font-medium truncate" title="{{ $invoice->nama_bank }}">
                                                    {{ Str::limit($invoice->nama_bank, 25) }}
                                                </div>
                                            </div>
                                            @if ($invoice->an)
                                                <div class="text-xs text-gray-600 max-w-xs mt-1 truncate"
                                                    title="{{ $invoice->an }}">
                                                    <i class="fas fa-user mr-1"></i>
                                                    A/N: {{ Str::limit($invoice->an, 20) }}
                                                </div>
                                            @endif
                                            @if ($invoice->ac)
                                                <div class="text-xs text-gray-600 mt-1">
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
                                            @if ($invoice->due_date && $invoice->due_date !== '0000-00-00')
                                                <div class="text-sm text-gray-900 mt-2">
                                                    <i class="fas fa-calendar-day mr-1 text-yellow-600"></i>
                                                    <div class="font-medium">
                                                        {{ \Carbon\Carbon::parse($invoice->due_date)->format('M d, Y') }}
                                                    </div>
                                                    <div class="text-xs text-gray-500">Due Date</div>
                                                    @php
                                                        $dueDate = \Carbon\Carbon::parse($invoice->due_date);
                                                        $invoiceDate = \Carbon\Carbon::parse($invoice->tgl_invoice);
                                                        $daysDiff = $invoiceDate->diffInDays($dueDate);
                                                    @endphp
                                                    <div
                                                        class="text-xs
                                                        @if ($daysDiff <= 30) text-red-600
                                                        @elseif($daysDiff <= 60) text-yellow-600
                                                        @else text-green-600 @endif">
                                                        {{ $daysDiff }} days term
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center text-gray-500">
                                                <i class="fas fa-archive text-4xl mb-3 text-gray-300"></i>
                                                <p class="text-lg font-medium">No historical data found</p>
                                                <p class="text-sm">No invoice records available in archive</p>
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

                    <!-- Summary Statistics -->
                    <div class="mt-6 bg-gray-50 rounded-lg p-4">
                        <h4 class="text-md font-semibold text-gray-700 mb-3">
                            <i class="fas fa-chart-bar mr-2"></i>Summary Statistics
                        </h4>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                            <div>
                                <span class="text-gray-500">Total Records:</span>
                                <span class="font-medium text-gray-900">{{ $invoices->total() }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Non-zero Amounts:</span>
                                <span
                                    class="font-medium text-gray-900">{{ $invoices->where('total_invoice', '>', 0)->count() }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Unique Clients:</span>
                                <span
                                    class="font-medium text-gray-900">{{ $invoices->pluck('nama_client')->unique()->count() }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Document Types:</span>
                                <span
                                    class="font-medium text-gray-900">{{ $invoices->pluck('jenis_no')->unique()->filter()->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const clientFilter = document.getElementById('clientFilter');
            const typeFilter = document.getElementById('typeFilter');
            const dateFilter = document.getElementById('dateFilter');
            const resetButton = document.getElementById('resetFilter');
            const selectAll = document.getElementById('selectAll');
            const rowCheckboxes = document.querySelectorAll('.row-checkbox');

            // Filter functionality
            function filterTable() {
                const searchTerm = searchInput.value.toLowerCase();
                const clientValue = clientFilter.value;
                const typeValue = typeFilter.value;
                const dateValue = dateFilter.value;
                const rows = document.querySelectorAll('.invoice-row');

                rows.forEach(row => {
                    const client = row.dataset.client.toLowerCase();
                    const type = row.dataset.type;
                    const date = row.dataset.date;
                    const text = row.textContent.toLowerCase();

                    const matchesSearch = text.includes(searchTerm);
                    const matchesClient = !clientValue || client.includes(clientValue.toLowerCase());
                    const matchesType = !typeValue || type === typeValue;
                    const matchesDate = !dateValue || date === dateValue;

                    if (matchesSearch && matchesClient && matchesType && matchesDate) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            // Event listeners for filters
            searchInput.addEventListener('input', filterTable);
            clientFilter.addEventListener('change', filterTable);
            typeFilter.addEventListener('change', filterTable);
            dateFilter.addEventListener('change', filterTable);

            // Reset filters
            resetButton.addEventListener('click', function() {
                searchInput.value = '';
                clientFilter.value = '';
                typeFilter.value = '';
                dateFilter.value = '';
                filterTable();
            });

            // Select all functionality
            selectAll.addEventListener('change', function() {
                const visibleCheckboxes = Array.from(rowCheckboxes).filter(cb =>
                    cb.closest('.invoice-row').style.display !== 'none'
                );
                visibleCheckboxes.forEach(cb => cb.checked = this.checked);
            });
        });
    </script>
</x-app-layout>
