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
            padding: 15px;
            color: #333;
            font-size: 12px;
            line-height: 1.4;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 15px;
        }
        .company-info {
            flex: 1;
        }
        .company-name {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }
        .company-details {
            font-size: 11px;
            color: #666;
            line-height: 1.3;
        }
        .invoice-title {
            flex: 1;
            text-align: right;
        }
        .invoice-title h1 {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin: 0;
            letter-spacing: 2px;
        }
        .invoice-meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .client-section {
            flex: 1;
            margin-right: 30px;
        }
        .invoice-details {
            flex: 1;
            text-align: right;
        }
        .section-label {
            font-weight: bold;
            margin-bottom: 8px;
            font-size: 11px;
            text-transform: uppercase;
            color: #666;
        }
        .client-name {
            font-weight: bold;
            font-size: 13px;
            margin-bottom: 5px;
        }
        .client-address {
            font-size: 11px;
            line-height: 1.3;
            margin-bottom: 8px;
        }
        .reference-section {
            margin: 20px 0;
        }
        .reference-row {
            display: flex;
            margin-bottom: 8px;
            font-size: 11px;
        }
        .reference-label {
            font-weight: bold;
            width: 80px;
            margin-right: 10px;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 11px;
        }
        .items-table th {
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            font-weight: bold;
            font-size: 10px;
        }
        .items-table td {
            border: 1px solid #ddd;
            padding: 8px;
            vertical-align: top;
        }
        .items-table .desc-col {
            text-align: left;
        }
        .items-table .num-col {
            text-align: right;
        }
        .items-table .center-col {
            text-align: center;
        }
        .total-section {
            margin-top: 20px;
            text-align: right;
        }
        .payment-info {
            margin-top: 30px;
            font-size: 11px;
        }
        .payment-label {
            font-weight: bold;
            margin-bottom: 8px;
        }
        .bank-details {
            line-height: 1.4;
        }
        .footer {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }
        .signature-section {
            text-align: center;
            font-size: 11px;
        }
        .signature-line {
            width: 150px;
            height: 60px;
            border-bottom: 1px solid #333;
            margin-bottom: 5px;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            font-size: 16px;
            font-weight: bold;
        }
        .contact-info {
            font-size: 10px;
            color: #666;
            text-align: right;
        }
        .terbilang {
            font-style: italic;
            font-size: 10px;
            text-align: center;
            margin: 10px 0;
            color: #666;
        }
        .meta-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
            font-size: 11px;
        }
        .meta-label {
            font-weight: bold;
            width: 100px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="company-info">
            <div class="company-name">MPA</div>
            <div class="company-details">
                PT. Multi Power Abadi<br>
                Jl. Ahmad Yani, Tambak IV No. 80<br>
                Kecamatan Gayungan Kota Surabaya Jawa Timur 60235<br>
                Email : multipowerabadi@gmail.com<br>
                Telp: 031-5913774 ✦ Fax: 031127845<br>
                WA/HP: +1.829.963.3.038.036
            </div>
        </div>
        <div class="invoice-title">
            <h1>INVOICE</h1>
        </div>
    </div>

    <!-- Invoice Meta Information -->
    <div class="invoice-meta">
        <div class="client-section">
            <div class="section-label">Kepada :</div>
            <div class="client-name">{{ $invoice->nama_client }}</div>
            <div class="client-address">
                {{ $invoice->alamat_client }}<br>
                @if($invoice->up)
                Up. {{ $invoice->up }}
                @endif
            </div>
        </div>
        
        <div class="invoice-details">
            <div class="meta-row">
                <span class="meta-label">No. Invoice :</span>
                <span>{{ $invoice->no_invoice }}</span>
            </div>
            <div class="meta-row">
                <span class="meta-label">Tgl. Invoice :</span>
                <span>{{ $invoice->tgl_invoice->format('d M Y') }}</span>
            </div>
            <div class="meta-row">
                <span class="meta-label">Due Date Inv :</span>
                <span>{{ $invoice->due_date->format('d M Y') }}</span>
            </div>
        </div>
    </div>

    <!-- Reference Section -->
    <div class="reference-section">
        <div class="reference-row">
            <span class="reference-label">Referensi</span>
            <span>:</span>
        </div>
        <div class="reference-row">
            <span class="reference-label">No.</span>
            <span class="reference-label" style="width: 100px;">No. BAST</span>
        </div>
        
        @if($invoice->nbast)
        <div class="reference-row">
            <span class="reference-label">1.</span>
            <span>{{ $invoice->nbast }}</span>
        </div>
        @endif
        
        @if($invoice->nbast2)
        <div class="reference-row">
            <span class="reference-label">2.</span>
            <span>{{ $invoice->nbast2 }}</span>
        </div>
        @endif
        
        @if($invoice->nbast3)
        <div class="reference-row">
            <span class="reference-label">3.</span>
            <span>{{ $invoice->nbast3 }}</span>
        </div>
        @endif
        
        @if($invoice->nbast4)
        <div class="reference-row">
            <span class="reference-label">4.</span>
            <span>{{ $invoice->nbast4 }}</span>
        </div>
        @endif
        
        @if($invoice->nbast5)
        <div class="reference-row">
            <span class="reference-label">5.</span>
            <span>{{ $invoice->nbast5 }}</span>
        </div>
        @endif
    </div>

    <!-- Items Table -->
    <table class="items-table">
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 45%">Deskripsi</th>
                <th style="width: 10%">Qty</th>
                <th style="width: 10%">Satuan</th>
                <th style="width: 15%">Harga</th>
                <th style="width: 15%">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->detail_invoice_array as $index => $item)
            <tr>
                <td class="center-col">{{ $index + 1 }}</td>
                <td class="desc-col">{{ $item['deskripsi'] }}</td>
                <td class="center-col">{{ number_format($item['qty'], 2) }}</td>
                <td class="center-col">{{ $item['satuan'] ?? 'LS' }}</td>
                <td class="num-col">Rp. {{ number_format($item['harga'], 0, ',', '.') }}</td>
                <td class="num-col">Rp. {{ number_format($item['total'], 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Total Section -->
    <div class="total-section">
        <div style="text-align: right; margin-bottom: 10px;">
            <div style="margin-bottom: 8px;">
                <span style="font-weight: bold; margin-right: 50px;">JUMLAH</span>
                <span style="font-weight: bold;">Rp. {{ number_format($invoice->total_invoice, 0, ',', '.') }}</span>
            </div>
            <div style="margin-bottom: 8px;">
                <span style="font-weight: bold; margin-right: 50px;">PPN 11%</span>
                <span style="font-weight: bold;">Rp. {{ number_format($invoice->total_invoice * 0.11, 0, ',', '.') }}</span>
            </div>
            <div style="border-top: 2px solid #333; padding-top: 8px; margin-top: 8px;">
                <span style="font-weight: bold; margin-right: 30px; font-size: 13px;">TOTAL HARGA</span>
                <span style="font-weight: bold; font-size: 13px;">Rp. {{ number_format($invoice->total_invoice * 1.11, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

<div class="terbilang">
    Terbilang: {{ \Illuminate\Support\Str::title(\Riskihajar\Terbilang\Facades\Terbilang::make((int) round($invoice->total_invoice * 1.11))) }} Rupiah
</div>



    <!-- Payment Information -->
    <div class="payment-info">
        <div class="payment-label">Pembayaran dapat dilakukan berupa Transfer ke:</div>
        <div class="bank-details">
            Bank : {{ $invoice->nama_bank ?? 'BNI Cabang Surabaya' }}<br>
            A/n : {{ $invoice->an ?? 'PT. Multi Power Abadi' }}<br>
            A/c : {{ $invoice->ac ?? '8112728253' }}
        </div>
        <br>
        <div style="font-size: 10px;">
            Jika sudah di lakukan pembayaran mohon konfirmasi ke <strong>multipowerabadi@gmail.com</strong><br>
            atau ke 08112728253 / 081024272825
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="contact-info">
            <div>Surabaya, {{ date('d M Y') }}</div>
        </div>
        <div class="signature-section">
            <div class="signature-line">
                @if($invoice->ttd)
                <span style="font-size: 24px;">MPA</span>
                @endif
            </div>
            <div>( Mariyadi, ST, MM )</div>
            <div>Direktur</div>
        </div>
    </div>

    <!-- Footer URL -->
    <div style="margin-top: 30px; font-size: 9px; color: #999; text-align: center;">
        https://erpower.multipowerabadi.co.id/invoice/cetak-invoice/ebook.php?invoice=MPA0638
    </div>
</body>
</html>