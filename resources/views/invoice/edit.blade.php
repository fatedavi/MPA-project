<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Invoice') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <div class="mb-6">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('invoice.index') }}"
                                class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-[#8D0907]">
                                <i class="fas fa-home mr-2"></i>
                                Invoices
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                                <span class="text-sm font-medium text-gray-500">Edit Invoice</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Form Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Error Notifications -->
                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">
                                        Terdapat {{ $errors->count() }} error yang perlu diperbaiki:
                                    </h3>
                                    <div class="mt-2 text-sm text-red-700">
                                        <ul class="list-disc pl-5 space-y-1">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Success Notifications -->
                    @if (session('success'))
                        <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-green-800">
                                        {{ session('success') }}
                                    </p>
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
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.586 9L9.293 8.293a1 1 0 00-1.414-1.414L8 8.586 6.707 7.293a1 1 0 00-1.414 1.414L8 8.586z"
                                            clip-rule="evenodd" />
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

                    <form method="POST" action="{{ route('invoice.update', $invoice->id) }}" class="space-y-8"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Basic Information -->
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                            <h3 class="text-xl font-semibold text-blue-900 mb-4 flex items-center">
                                <i class="fas fa-file-invoice text-blue-600 mr-3 text-xl"></i>
                                Basic Information
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="no_invoice" class="block text-sm font-medium text-gray-700">Invoice
                                        Number</label>
                                    <input type="text" name="no_invoice" id="no_invoice"
                                        value="{{ $invoice->no_invoice }}"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm"
                                        readonly>
                                    <p class="mt-1 text-xs text-gray-500">Invoice number cannot be changed</p>
                                </div>

                                <div>
                                    <label for="tgl_invoice" class="block text-sm font-medium text-gray-700">Invoice
                                        Date *</label>
                                    <input type="date" name="tgl_invoice" id="tgl_invoice"
                                        value="{{ $invoice->tgl_invoice }}" required
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                </div>
                            </div>
                        </div>

                        <!-- Client Information -->
                        <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                            <h3 class="text-xl font-semibold text-green-900 mb-4 flex items-center">
                                <i class="fas fa-users text-green-600 mr-3 text-xl"></i>
                                Client Information
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="client_id" class="block text-sm font-medium text-gray-700">Select Client
                                        *</label>
                                    <select name="client_id" id="client_id" required
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm"
                                        onchange="fillClientData()">
                                        <option value="">Choose a client...</option>
                                        @foreach ($clients as $client)
                                            <option value="{{ $client->id_client }}"
                                                data-nama="{{ $client->nama_client }}"
                                                data-alamat="{{ $client->alamat_client }}"
                                                data-up="{{ $client->up ?? $client->nama_client }}"
                                                {{ $client->nama_client === $invoice->nama_client ? 'selected' : '' }}>
                                                {{ $client->nama_client }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label for="up" class="block text-sm font-medium text-gray-700">UP *</label>
                                    <input type="text" name="up" id="up" value="{{ $invoice->up }}"
                                        required
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm"
                                        placeholder="UP will be auto-filled from client name" readonly>
                                    <p class="mt-1 text-xs text-gray-500">Auto-filled from selected client name</p>
                                </div>

                                <div class="md:col-span-2">
                                    <label for="alamat_client" class="block text-sm font-medium text-gray-700">Client
                                        Address *</label>
                                    <textarea name="alamat_client" id="alamat_client" rows="2" required
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm"
                                        placeholder="Client address will be auto-filled" readonly>{{ $invoice->alamat_client }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Admin Information -->
                        <div class="bg-purple-50 border border-purple-200 rounded-lg p-6">
                            <h3 class="text-xl font-semibold text-purple-900 mb-4 flex items-center">
                                <i class="fas fa-user-tie text-purple-600 mr-3 text-xl"></i>
                                Admin Information
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="kd_admin"
                                        class="block text-sm font-medium text-gray-700">Admin</label>
                                    <input type="text" name="kd_admin_display" id="kd_admin_display"
                                        value="{{ auth()->user()->name }}"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 sm:text-sm"
                                        readonly>
                                    <input type="hidden" name="kd_admin" value="{{ $invoice->kd_admin }}">
                                    <p class="mt-1 text-xs text-gray-500">Current user: {{ auth()->user()->name }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Invoice Items - Moved to top -->
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
                            <h3 class="text-xl font-semibold text-yellow-900 mb-4 flex items-center">
                                <i class="fas fa-list-alt text-yellow-600 mr-3 text-xl"></i>
                                Invoice Items
                            </h3>
                            <div id="invoice-items" class="space-y-4">
                                @if ($invoice->detail_invoice_array && count($invoice->detail_invoice_array) > 0)
                                    @foreach ($invoice->detail_invoice_array as $index => $item)
                                        <div
                                            class="invoice-item bg-white border border-yellow-300 rounded-lg p-4 shadow-sm {{ $index === 0 ? 'bg-yellow-50' : '' }}">
                                            <div class="space-y-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Description
                                                        *</label>
                                                    <input type="text"
                                                        name="detail_invoice[{{ $index }}][deskripsi]"
                                                        value="{{ $item['deskripsi'] }}" required
                                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm"
                                                        placeholder="Item description">
                                                </div>
                                                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700">Qty
                                                            *</label>
                                                        <input type="number"
                                                            name="detail_invoice[{{ $index }}][qty]"
                                                            min="0.01" step="0.01"
                                                            value="{{ $item['qty'] }}" required
                                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm"
                                                            placeholder="1" onchange="calculateItemTotal(this)">
                                                    </div>
                                                    <div>
                                                        <label
                                                            class="block text-sm font-medium text-gray-700">Satuan</label>
                                                        <input type="text"
                                                            name="detail_invoice[{{ $index }}][satuan]"
                                                            value="{{ $item['satuan'] ?? 'pcs' }}"
                                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm"
                                                            placeholder="pcs, jam, hari">
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700">Harga
                                                            *</label>
                                                        <input type="number"
                                                            name="detail_invoice[{{ $index }}][harga]"
                                                            min="0" step="0.01"
                                                            value="{{ $item['harga'] }}" required
                                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm"
                                                            placeholder="0" onchange="calculateItemTotal(this)"
                                                            onblur="formatHarga(this)">
                                                        <p class="mt-1 text-xs text-gray-500">Contoh: 5321.50</p>
                                                    </div>
                                                    <div>
                                                        <label
                                                            class="block text-sm font-medium text-gray-700">Total</label>
                                                        <input type="text"
                                                            name="detail_invoice[{{ $index }}][total]"
                                                            value="{{ 'Rp ' . number_format($item['total'], 2, ',', '.') }}"
                                                            readonly
                                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 sm:text-sm"
                                                            placeholder="Rp 0">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <!-- Default item jika tidak ada data -->
                                    <div
                                        class="invoice-item bg-white border border-yellow-300 rounded-lg p-4 shadow-sm bg-yellow-50">
                                        <div class="space-y-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Description
                                                    *</label>
                                                <input type="text" name="detail_invoice[0][deskripsi]" required
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm"
                                                    placeholder="Item description">
                                            </div>
                                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Qty
                                                        *</label>
                                                    <input type="number" name="detail_invoice[0][qty]"
                                                        min="0.01" step="0.01" required
                                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm"
                                                        placeholder="1" onchange="calculateItemTotal(this)">
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700">Satuan</label>
                                                    <input type="text" name="detail_invoice[0][satuan]"
                                                        value="pcs"
                                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm"
                                                        placeholder="pcs, jam, hari">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Harga
                                                        *</label>
                                                    <input type="number" name="detail_invoice[0][harga]"
                                                        min="0" step="0.01" required
                                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm"
                                                        placeholder="0" onchange="calculateItemTotal(this)"
                                                        onblur="formatHarga(this)">
                                                    <p class="mt-1 text-xs text-gray-500">Contoh: 5321.50</p>
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700">Total</label>
                                                    <input type="text" name="detail_invoice[0][total]" readonly
                                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 sm:text-sm"
                                                        placeholder="Rp 0">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="mt-4 flex space-x-3">
                                <button type="button" id="add-item"
                                    class="inline-flex items-center px-4 py-2 border border-yellow-300 shadow-sm text-sm leading-4 font-medium rounded-md text-yellow-700 bg-white hover:bg-yellow-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors">
                                    <i class="fas fa-plus mr-2"></i>
                                    Add Item
                                </button>
                                <button type="button" id="remove-item"
                                    class="inline-flex items-center px-4 py-2 border border-red-300 shadow-sm text-sm leading-4 font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                    <i class="fas fa-trash mr-2"></i>
                                    Remove Last Item
                                </button>
                            </div>
                        </div>

                        <!-- NBAST Information - Collapsible -->
                        <div class="bg-orange-50 border border-orange-200 rounded-lg">
                            <button type="button" id="nbast-toggle"
                                class="w-full p-6 text-left focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-inset">
                                <h3 class="text-xl font-semibold text-orange-900 flex items-center justify-between">
                                    <span class="flex items-center">
                                        <i class="fas fa-file-contract text-orange-600 mr-3 text-xl"></i>
                                        NBAST Information
                                    </span>
                                    <i id="nbast-icon"
                                        class="fas fa-chevron-down transform transition-transform duration-200"></i>
                                </h3>
                            </button>
                            <div id="nbast-content" class="px-6 pb-6 hidden">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label for="nbast" class="block text-sm font-medium text-gray-700">NBAST
                                            1</label>
                                        <input type="text" name="nbast" id="nbast"
                                            value="{{ $invoice->nbast }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm"
                                            placeholder="NBAST 1">
                                    </div>
                                    <div>
                                        <label for="nbast2" class="block text-sm font-medium text-gray-700">NBAST
                                            2</label>
                                        <input type="text" name="nbast2" id="nbast2"
                                            value="{{ $invoice->nbast2 }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm"
                                            placeholder="NBAST 2">
                                    </div>
                                    <div>
                                        <label for="nbast3" class="block text-sm font-medium text-gray-700">NBAST
                                            3</label>
                                        <input type="text" name="nbast3" id="nbast3"
                                            value="{{ $invoice->nbast3 }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm"
                                            placeholder="NBAST 3">
                                    </div>
                                    <div>
                                        <label for="nbast4" class="block text-sm font-medium text-gray-700">NBAST
                                            4</label>
                                        <input type="text" name="nbast4" id="nbast4"
                                            value="{{ $invoice->nbast4 }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm"
                                            placeholder="NBAST 4">
                                    </div>
                                    <div>
                                        <label for="nbast5" class="block text-sm font-medium text-gray-700">NBAST
                                            5</label>
                                        <input type="text" name="nbast5" id="nbast5"
                                            value="{{ $invoice->nbast5 }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm"
                                            placeholder="NBAST 5">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- FPB Information - Collapsible -->
                        <div class="bg-indigo-50 border border-indigo-200 rounded-lg">
                            <button type="button" id="fpb-toggle"
                                class="w-full p-6 text-left focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-inset">
                                <h3 class="text-xl font-semibold text-indigo-900 flex items-center justify-between">
                                    <span class="flex items-center">
                                        <i class="fas fa-file-alt text-indigo-600 mr-3 text-xl"></i>
                                        FPB Information
                                    </span>
                                    <i id="fpb-icon"
                                        class="fas fa-chevron-down transform transition-transform duration-200"></i>
                                </h3>
                            </button>
                            <div id="fpb-content" class="px-6 pb-6 hidden">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label for="jenis_no" class="block text-sm font-medium text-gray-700">Jenis
                                            No</label>
                                        <input type="text" name="jenis_no" id="jenis_no"
                                            value="{{ $invoice->jenis_no }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm"
                                            placeholder="Jenis No">
                                    </div>
                                    <div>
                                        <label for="no_fpb" class="block text-sm font-medium text-gray-700">No FPB
                                            1</label>
                                        <input type="text" name="no_fpb" id="no_fpb"
                                            value="{{ $invoice->no_fpb }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm"
                                            placeholder="No FPB 1">
                                    </div>
                                    <div>
                                        <label for="no_fpb2" class="block text-sm font-medium text-gray-700">No FPB
                                            2</label>
                                        <input type="text" name="no_fpb2" id="no_fpb2"
                                            value="{{ $invoice->no_fpb2 }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm"
                                            placeholder="No FPB 2">
                                    </div>
                                    <div>
                                        <label for="no_fpb3" class="block text-sm font-medium text-gray-700">No FPB
                                            3</label>
                                        <input type="text" name="no_fpb3" id="no_fpb3"
                                            value="{{ $invoice->no_fpb3 }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm"
                                            placeholder="No FPB 3">
                                    </div>
                                    <div>
                                        <label for="no_fpb4" class="block text-sm font-medium text-gray-700">No FPB
                                            4</label>
                                        <input type="text" name="no_fpb4" id="no_fpb4"
                                            value="{{ $invoice->no_fpb4 }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm"
                                            placeholder="No FPB 4">
                                    </div>
                                    <div>
                                        <label for="no_fpb5" class="block text-sm font-medium text-gray-700">No FPB
                                            5</label>
                                        <input type="text" name="no_fpb5" id="no_fpb5"
                                            value="{{ $invoice->no_fpb5 }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm"
                                            placeholder="No FPB 5">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Information -->
                        <div class="bg-emerald-50 border border-emerald-200 rounded-lg p-6">
                            <h3 class="text-xl font-semibold text-emerald-900 mb-4 flex items-center">
                                <i class="fas fa-credit-card text-emerald-600 mr-3 text-xl"></i>
                                Payment Information
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date
                                        *</label>
                                    <input type="date" name="due_date" id="due_date"
                                        value="{{ $invoice->due_date }}" required
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                </div>

                                <div>
                                    <label for="total_invoice" class="block text-sm font-medium text-gray-700">Total
                                        Invoice</label>
                                    <input type="text" name="total_invoice" id="total_invoice"
                                        value="{{ 'Rp ' . number_format($invoice->total_invoice, 2, ',', '.') }}"
                                        readonly
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 sm:text-sm"
                                        placeholder="Rp 0">
                                    <p class="mt-1 text-xs text-gray-500">Auto-calculated from items</p>
                                </div>

                                <div>
                                    <label for="nama_bank" class="block text-sm font-medium text-gray-700">Bank Name
                                        *</label>
                                    <select name="nama_bank" id="nama_bank" required
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm"
                                        onchange="fillBankData()">
                                        <option value="">Choose a bank...</option>
                                        @foreach ($banks as $bank)
                                            <option value="{{ $bank->nama_bank }}" data-an="{{ $bank->an }}"
                                                data-ac="{{ $bank->ac }}"
                                                {{ $bank->nama_bank === $invoice->nama_bank ? 'selected' : '' }}>
                                                {{ $bank->nama_bank }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label for="an" class="block text-sm font-medium text-gray-700">Account Name
                                        *</label>
                                    <input type="text" name="an" id="an" value="{{ $invoice->an }}"
                                        required
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm"
                                        placeholder="Account name will be auto-filled" readonly>
                                </div>

                                <div>
                                    <label for="ac" class="block text-sm font-medium text-gray-700">Account
                                        Number *</label>
                                    <input type="text" name="ac" id="ac" value="{{ $invoice->ac }}"
                                        required
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm"
                                        placeholder="Account number will be auto-filled" readonly>
                                </div>

                                <div>
                                    <label for="tgl_paid" class="block text-sm font-medium text-gray-700">Payment
                                        Date</label>
                                    <input type="date" name="tgl_paid" id="tgl_paid"
                                        value="{{ $invoice->tgl_paid }}"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                </div>
                            </div>
                        </div>

                        <!-- Status & Additional Information -->
                        <div class="bg-slate-50 border border-slate-200 rounded-lg p-6">
                            <h3 class="text-xl font-semibold text-slate-900 mb-4 flex items-center">
                                <i class="fas fa-check-circle text-slate-600 mr-3 text-xl"></i>
                                Status & Additional Information
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status
                                        *</label>
                                    <select name="status" id="status" required
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                        <option value="">Select status</option>
                                        <option value="draft" {{ $invoice->status === 'draft' ? 'selected' : '' }}>
                                            Draft</option>
                                        <option value="sent" {{ $invoice->status === 'sent' ? 'selected' : '' }}>
                                            Sent</option>
                                        <option value="paid" {{ $invoice->status === 'paid' ? 'selected' : '' }}>
                                            Paid</option>
                                        <option value="overdue"
                                            {{ $invoice->status === 'overdue' ? 'selected' : '' }}>Overdue</option>
                                        <option value="cancelled"
                                            {{ $invoice->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="no_fp" class="block text-sm font-medium text-gray-700">FP
                                        Number</label>
                                    <input type="text" name="no_fp" id="no_fp"
                                        value="{{ $invoice->no_fp }}"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm"
                                        placeholder="FP number">
                                </div>
                            </div>
                        </div>

                        <!-- Document Signatures Checklist -->
                        {{-- <div class="bg-rose-50 border border-rose-200 rounded-lg p-6">
                            <h3 class="text-xl font-semibold text-rose-900 mb-4 flex items-center">
                                <i class="fas fa-check-square text-rose-600 mr-3 text-xl"></i>
                                Document Signatures Checklist
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="flex items-center">
                                    <input type="checkbox" name="ttd" id="ttd" value="1" {{ $invoice->ttd ? 'checked' : '' }} class="h-4 w-4 text-[#8D0907] focus:ring-[#8D0907] border-gray-300 rounded">
                                    <label for="ttd" class="ml-3 block text-sm font-medium text-gray-700">
                                        <i class="fas fa-signature mr-2 text-rose-600"></i>
                                        Signature Approved
                                    </label>
                                </div>

                                <div class="flex items-center">
                                    <input type="checkbox" name="ttdkwitansi" id="ttdkwitansi" value="1" {{ $invoice->ttdkwitansi ? 'checked' : '' }} class="h-4 w-4 text-[#8D0907] focus:ring-[#8D0907] border-gray-300 rounded">
                                    <label for="ttdkwitansi" class="ml-3 block text-sm font-medium text-gray-700">
                                        <i class="fas fa-receipt mr-2 text-rose-600"></i>
                                        Receipt Signature Approved
                                    </label>
                                </div>

                                <div class="flex items-center">
                                    <input type="checkbox" name="ttdbast" id="ttdbast" value="1" {{ $invoice->ttdbast ? 'checked' : '' }} class="h-4 w-4 text-[#8D0907] focus:ring-[#8D0907] border-gray-300 rounded">
                                    <label for="ttdbast" class="ml-3 block text-sm font-medium text-gray-700">
                                        <i class="fas fa-file-contract mr-2 text-rose-600"></i>
                                        BAST Signature Approved
                                    </label>
                                </div>

                                <div class="flex items-center">
                                    <input type="checkbox" name="ttdbakn" id="ttdbakn" value="1" {{ $invoice->ttdbakn ? 'checked' : '' }} class="h-4 w-4 text-[#8D0907] focus:ring-[#8D0907] border-gray-300 rounded">
                                    <label for="ttdbakn" class="ml-3 block text-sm font-medium text-gray-700">
                                        <i class="fas fa-file-alt mr-2 text-rose-600"></i>
                                        BAKN Signature Approved
                                    </label>
                                </div>
                            </div>
                            <p class="mt-4 text-sm text-gray-600">
                                <i class="fas fa-info-circle mr-2"></i>
                                Check the boxes above to indicate which signatures have been approved for this invoice.
                            </p>
                        </div> --}}

                        <!-- Form Actions -->
                        <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                            <a href="{{ route('invoice.index') }}"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#8D0907] transition-colors">
                                Cancel
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-[#8D0907] hover:bg-[#B91C1C] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#8D0907] transition-colors">
                                <i class="fas fa-save mr-2"></i>
                                Update Invoice
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let itemCount = {{ $invoice->detail_invoice_array ? count($invoice->detail_invoice_array) : 1 }};

        document.addEventListener('DOMContentLoaded', function() {
            // Setup client selection
            const clientSelect = document.getElementById('client_id');

            clientSelect.addEventListener('change', function() {
                fillClientData(); // Call the same function
            });

            // Calculate initial total
            calculateTotal();

            // Setup collapsible sections
            setupCollapsibleSections();
        });

        // Setup collapsible sections
        function setupCollapsibleSections() {
            // NBAST toggle
            document.getElementById('nbast-toggle').addEventListener('click', function() {
                const content = document.getElementById('nbast-content');
                const icon = document.getElementById('nbast-icon');
                content.classList.toggle('hidden');
                icon.classList.toggle('fa-chevron-down');
                icon.classList.toggle('fa-chevron-up');
            });

            // FPB toggle
            document.getElementById('fpb-toggle').addEventListener('click', function() {
                const content = document.getElementById('fpb-content');
                const icon = document.getElementById('fpb-icon');
                content.classList.toggle('hidden');
                icon.classList.toggle('fa-chevron-down');
                icon.classList.toggle('fa-chevron-up');
            });
        }

        // Add new item
        document.getElementById('add-item').addEventListener('click', function() {
            const newItem = document.createElement('div');
            newItem.className = 'invoice-item bg-white border border-yellow-300 rounded-lg p-4 shadow-sm';
            newItem.innerHTML = `
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Description *</label>
                        <input type="text" name="detail_invoice[${itemCount}][deskripsi]" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="Item description">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Qty *</label>
                            <input type="number" name="detail_invoice[${itemCount}][qty]" min="0.01" step="0.01" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="1" onchange="calculateItemTotal(this)">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Satuan</label>
                            <input type="text" name="detail_invoice[${itemCount}][satuan]" value="pcs" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="pcs, jam, hari">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Harga *</label>
                            <input type="number" name="detail_invoice[${itemCount}][harga]" min="0" step="0.01" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="0" onchange="calculateItemTotal(this)" onblur="formatHarga(this)">
                            <p class="mt-1 text-xs text-gray-500">Contoh: 5321.50</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Total</label>
                            <input type="text" name="detail_invoice[${itemCount}][total]" readonly class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 sm:text-sm" placeholder="Rp 0">
                        </div>
                    </div>
                </div>
            `;

            document.getElementById('invoice-items').appendChild(newItem);
            itemCount++;
        });

        // Remove last item
        document.getElementById('remove-item').addEventListener('click', function() {
            const items = document.querySelectorAll('.invoice-item');
            if (items.length > 1) {
                items[items.length - 1].remove();
                itemCount--;
                calculateTotal();
            }
        });

        // Format harga dengan 2 decimal places
        function formatHarga(input) {
            const value = parseFloat(input.value) || 0;
            input.value = value.toFixed(2);
        }

        // Calculate item total
        function calculateItemTotal(input) {
            const itemDiv = input.closest('.invoice-item');
            const qty = parseFloat(itemDiv.querySelector('input[name*="[qty]"]').value) || 0;
            const harga = parseFloat(itemDiv.querySelector('input[name*="[harga]"]').value) || 0;
            const total = qty * harga;

            // Format total dengan format IDR
            const formattedTotal = formatIDR(total);
            itemDiv.querySelector('input[name*="[total]"]').value = formattedTotal;
            calculateTotal();
        }

        // Calculate total invoice
        function calculateTotal() {
            let total = 0;
            const items = document.querySelectorAll('.invoice-item');

            items.forEach(item => {
                const totalInput = item.querySelector('input[name*="[total]"]');
                const totalText = totalInput.value.replace(/[^\d.,]/g, '').replace(',', '.');
                const itemTotal = parseFloat(totalText) || 0;
                total += itemTotal;
            });

            const formattedTotal = formatIDR(total);
            document.getElementById('total_invoice').value = formattedTotal;
        }

        // Format number to IDR format
        function formatIDR(amount) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }).format(amount);
        }

        function fillClientData() {
            const clientSelect = document.getElementById('client_id');
            const selectedOption = clientSelect.options[clientSelect.selectedIndex];

            if (selectedOption.value) {
                const namaClient = selectedOption.getAttribute('data-nama');
                const alamatClient = selectedOption.getAttribute('data-alamat');
                const upClient = selectedOption.getAttribute('data-up');

                // Fill the UP field
                document.getElementById('up').value = upClient || namaClient || '';

                // Fill the address field
                document.getElementById('alamat_client').value = alamatClient || '';
            } else {
                // Clear fields if no client selected
                document.getElementById('up').value = '';
                document.getElementById('alamat_client').value = '';
            }
        }

        // Function to fill bank data from select dropdown
        function fillBankData() {
            const selectElement = document.getElementById('nama_bank');
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            const anInput = document.getElementById('an');
            const acInput = document.getElementById('ac');

            if (selectedOption.value) {
                anInput.value = selectedOption.dataset.an;
                acInput.value = selectedOption.dataset.ac;
            } else {
                anInput.value = '';
                acInput.value = '';
            }
        }
    </script>
</x-app-layout>
