<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $invoice->no_invoice }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #8D0907;
            padding-bottom: 20px;
        }
        .company-name {
            font-size: 24px;
            font-weight: bold;
            color: #8D0907;
            margin-bottom: 5px;
        }
        .company-info {
            font-size: 12px;
            color: #666;
        }
        .invoice-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .invoice-info {
            flex: 1;
        }
        .client-info {
            flex: 1;
            text-align: right;
        }
        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #8D0907;
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        .info-row {
            margin-bottom: 8px;
        }
        .label {
            font-weight: bold;
            display: inline-block;
            width: 120px;
        }
        .value {
            display: inline-block;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .items-table th {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            font-weight: bold;
        }
        .items-table td {
            border: 1px solid #ddd;
            padding: 10px;
        }
        .text-right {
            text-align: right;
        }
        .total-section {
            margin-top: 30px;
            text-align: right;
        }
        .total-row {
            margin-bottom: 10px;
        }
        .grand-total {
            font-size: 18px;
            font-weight: bold;
            color: #8D0907;
            border-top: 2px solid #8D0907;
            padding-top: 10px;
        }
        .bank-info {
            margin-top: 30px;
            padding: 20px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
        }
        .signatures {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }
        .signature-box {
            text-align: center;
            flex: 1;
            margin: 0 20px;
        }
        .signature-line {
            border-top: 1px solid #333;
            margin-top: 50px;
            padding-top: 10px;
        }
        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="company-name">MPA PROJECT</div>
        <div class="company-info">
            Professional Project Management & Consulting Services<br>
            Jakarta, Indonesia
        </div>
    </div>

    <!-- Invoice Details -->
    <div class="invoice-details">
        <div class="invoice-info">
            <div class="section-title">INVOICE</div>
            <div class="info-row">
                <span class="label">Invoice No:</span>
                <span class="value">{{ $invoice->no_invoice }}</span>
            </div>
            <div class="info-row">
                <span class="label">Date:</span>
                <span class="value">{{ $invoice->tgl_invoice->format('d M Y') }}</span>
            </div>
            <div class="info-row">
                <span class="label">Due Date:</span>
                <span class="value">{{ $invoice->due_date->format('d M Y') }}</span>
            </div>
            <div class="info-row">
                <span class="label">Status:</span>
                <span class="value">{{ ucfirst($invoice->status) }}</span>
            </div>
        </div>
        
        <div class="client-info">
            <div class="section-title">BILL TO</div>
            <div class="info-row">
                <strong>{{ $invoice->nama_client }}</strong>
            </div>
            <div class="info-row">
                {{ $invoice->alamat_client }}
            </div>
            <div class="info-row">
                <span class="label">UP:</span>
                <span class="value">{{ $invoice->up }}</span>
            </div>
        </div>
    </div>

    <!-- Project Information -->
    <div class="section-title">PROJECT INFORMATION</div>
    <div class="info-row">
        <span class="label">Admin Code:</span>
        <span class="value">{{ $invoice->kd_admin }}</span>
    </div>
    
    @if($invoice->nbast)
    <div class="info-row">
        <span class="label">NBAST:</span>
        <span class="value">{{ $invoice->nbast }}</span>
    </div>
    @endif
    
    @if($invoice->nbast2)
    <div class="info-row">
        <span class="label">NBAST 2:</span>
        <span class="value">{{ $invoice->nbast2 }}</span>
    </div>
    @endif
    
    @if($invoice->nbast3)
    <div class="info-row">
        <span class="label">NBAST 3:</span>
        <span class="value">{{ $invoice->nbast3 }}</span>
    </div>
    @endif
    
    @if($invoice->nbast4)
    <div class="info-row">
        <span class="label">NBAST 4:</span>
        <span class="value">{{ $invoice->nbast4 }}</span>
    </div>
    @endif
    
    @if($invoice->nbast5)
    <div class="info-row">
        <span class="label">NBAST 5:</span>
        <span class="value">{{ $invoice->nbast5 }}</span>
    </div>
    @endif

    <!-- Items Table -->
    <div class="section-title">SERVICES / ITEMS</div>
    <table class="items-table">
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 45%">Description</th>
                <th style="width: 15%">Qty</th>
                <th style="width: 15%">Unit Price</th>
                <th style="width: 20%">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->detail_invoice as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item['deskripsi'] }}</td>
                <td class="text-right">{{ number_format($item['qty'], 2) }} {{ $item['satuan'] ?? 'pcs' }}</td>
                <td class="text-right">Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($item['total'], 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Total Section -->
    <div class="total-section">
        <div class="total-row">
            <span style="font-weight: bold; margin-right: 20px;">Total Amount:</span>
            <span style="font-weight: bold;">Rp {{ number_format($invoice->total_invoice, 0, ',', '.') }}</span>
        </div>
    </div>

    <!-- Bank Information -->
    <div class="bank-info">
        <div class="section-title">PAYMENT INFORMATION</div>
        <div class="info-row">
            <span class="label">Bank:</span>
            <span class="value">{{ $invoice->nama_bank }}</span>
        </div>
        <div class="info-row">
            <span class="label">Account Name:</span>
            <span class="value">{{ $invoice->an }}</span>
        </div>
        <div class="info-row">
            <span class="label">Account Number:</span>
            <span class="value">{{ $invoice->ac }}</span>
        </div>
    </div>

    <!-- Signatures -->
    <div class="signatures">
        <div class="signature-box">
            @if($invoice->ttd)
            <div class="signature-line">✓</div>
            @else
            <div class="signature-line">_____________</div>
            @endif
            <div>Invoice</div>
        </div>
        
        <div class="signature-box">
            @if($invoice->ttdkwitansi)
            <div class="signature-line">✓</div>
            @else
            <div class="signature-line">_____________</div>
            @endif
            <div>Kwitansi</div>
        </div>
        
        <div class="signature-box">
            @if($invoice->ttdbast)
            <div class="signature-line">✓</div>
            @else
            <div class="signature-line">_____________</div>
            @endif
            <div>BAST</div>
        </div>
        
        <div class="signature-box">
            @if($invoice->ttdbakn)
            <div class="signature-line">✓</div>
            @else
            <div class="signature-line">_____________</div>
            @endif
            <div>BAKN</div>
        </div>
    </div>

    <!-- Footer -->
    <div style="margin-top: 50px; text-align: center; font-size: 12px; color: #666;">
        <p>Thank you for your business!</p>
        <p>This is a computer generated document. No signature required.</p>
    </div>
</body>
</html>
