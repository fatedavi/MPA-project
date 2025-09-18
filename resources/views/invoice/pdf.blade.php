<!DOCTYPE html>
<html lang="id">

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

        /* Header */
        .header {
            width: 100%;
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
            padding-bottom: 15px;
        }

        .header td {
            vertical-align: top;
        }

        .company-info {
            font-size: 11px;
            color: #666;
            line-height: 1.3;
        }

        .company-info img {
            height: 60px;
            margin-bottom: 5px;
        }

        .invoice-title {
            text-align: right;
        }

        .invoice-title h1 {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin: 0;
            letter-spacing: 2px;
        }

        /* Invoice Meta */
        .invoice-meta {
            width: 100%;
            margin-bottom: 20px;
        }

        .invoice-meta td {
            vertical-align: top;
        }

        .client-section {
            font-size: 11px;
        }

        .section-label {
            font-weight: bold;
            margin-bottom: 5px;
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

        .invoice-details {
            font-size: 11px;
            text-align: right;
        }

        .meta-row {
            margin-bottom: 5px;
        }

        .meta-label {
            font-weight: bold;
            display: inline-block;
            width: 100px;
        }

        /* Table Items */
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

        /* Total */
        .total-section {
            margin-top: 20px;
            text-align: right;
        }

        /* Payment */
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
            font-size: 11px;
        }

        .contact-info {
            font-size: 11px;
            text-align: center;
            margin-bottom: 50px;
            /* jarak antara tanggal dan tanda tangan */
        }

        .signature-section {
            text-align: center;
            font-size: 11px;
        }

        .signature-line {
            width: 150px;
            height: 60px;
            border-bottom: 1px solid #333;
            margin: 0 auto 5px auto;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            font-size: 16px;
            font-weight: bold;
        }

        .signature-line img {
            height: 40px;
            margin-bottom: 5px;
        }


        .contact-info {
            font-size: 10px;
            color: #666;
        }


        .terbilang {

            font-size: 10px;
            text-align: center;
            margin: 10px 0;
            color: #666;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <table class="header">
        <tr>
            <td style="width: 60%;">
                <div class="company-info">
                    <img src="{{ public_path('assets/images/mpalogo.png') }}" alt="Logo">
                    <div>
                        Jl. Gunung Anyar Tambak IV No. 50<br>
                        Kelurahan Gunung Anyar Kec. Gunung Anyar Kota Surabaya Jawa Timur 50249<br>
                        Email : multipowerabadi@gmail.com<br>
                        Telp: 031-5913774 & Hp : 0811272825<br>
                        NPWP :71 425 962 5 606 000
                    </div>
                </div>
            </td>
            <td style="width: 40%;" class="invoice-title">
                <h1>INVOICE</h1>
            </td>
        </tr>
    </table>

    <!-- Invoice Meta -->
    <table class="invoice-meta">
        <tr>
            <td style="width: 60%;">
                <div class="client-section">
                    <div class="section-label">Kepada :</div>
                    <div class="client-name">{{ $invoice->nama_client }}</div>
                    <div class="client-address">
                        {{ $invoice->alamat_client }}<br>
                        @if ($invoice->up)
                            Up. {{ $invoice->up }}
                        @endif
                    </div>
                </div>
            </td>
            @php
                \Carbon\Carbon::setLocale('id');
            @endphp

            <td style="width: 40%; padding-top: 6px;" class="invoice-details">
                <div class="meta-row">
                    <span class="meta-label">No. Invoice :</span>
                    <span>{{ $invoice->no_invoice }}</span>
                </div>
                <div class="meta-row">
                    <span class="meta-label">Tgl. Invoice :</span>
                    <span>{{ $invoice->tgl_invoice->locale('id')->translatedFormat('d F Y') }}</span>
                </div>
                <div class="meta-row">
                    <span class="meta-label">Due Date Inv :</span>
                    <span>{{ $invoice->due_date->locale('id')->translatedFormat('d F Y') }}</span>
                </div>
            </td>

        </tr>
    </table>

    {{-- Cek apakah ada data BAST atau FPB --}}
    @if (
        $invoice->nbast ||
            $invoice->nbast2 ||
            $invoice->nbast3 ||
            $invoice->nbast4 ||
            $invoice->nbast5 ||
            $invoice->no_fpb ||
            $invoice->no_fpb2 ||
            $invoice->no_fpb3 ||
            $invoice->no_fpb4 ||
            $invoice->no_fpb5)

        <!-- Referensi BAST & FPB -->
        <table border="0" cellspacing="0" cellpadding="4" width="100%"
            style="border-collapse: collapse; font-size: 12px;">
            <tr>
                <td colspan="2" style="font-weight: bold; text-align: left; padding-bottom: 6px;">
                    Referensi
                </td>
            </tr>
            <tr>
                <!-- Tabel BAST -->
                @if ($invoice->nbast || $invoice->nbast2 || $invoice->nbast3 || $invoice->nbast4 || $invoice->nbast5)
                    <td width="50%" valign="top">
                        <table border="0" cellspacing="0" cellpadding="4" width="50%"
                            style="border-collapse: collapse;">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">No.</th>
                                    <th style="text-align: left;">BAST</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @if ($invoice->nbast)
                                        <td>1.</td>
                                        <td>{{ $invoice->nbast }}</td>
                                    @endif
                                    @if ($invoice->nbast3)
                                        <td>3.</td>
                                        <td>{{ $invoice->nbast3 }}</td>
                                    @endif
                                    @if ($invoice->nbast5)
                                        <td>5.</td>
                                        <td>{{ $invoice->nbast5 }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    @if ($invoice->nbast2)
                                        <td>2.</td>
                                        <td>{{ $invoice->nbast2 }}</td>
                                    @endif
                                    @if ($invoice->nbast4)
                                        <td>4.</td>
                                        <td>{{ $invoice->nbast4 }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                @endif

                <!-- Tabel FPB -->
                @if ($invoice->no_fpb || $invoice->no_fpb2 || $invoice->no_fpb3 || $invoice->no_fpb4 || $invoice->no_fpb5)
                    <td width="100%" valign="top">
                        <table border="0" cellspacing="0" cellpadding="4" width="50%"
                            style="border-collapse: collapse;">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">No.</th>
                                    <th style="text-align: left;">FPB</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @if ($invoice->no_fpb)
                                        <td>1.</td>
                                        <td>{{ $invoice->no_fpb }}</td>
                                    @endif
                                    @if ($invoice->no_fpb3)
                                        <td>3.</td>
                                        <td>{{ $invoice->no_fpb3 }}</td>
                                    @endif
                                    @if ($invoice->no_fpb5)
                                        <td>5.</td>
                                        <td>{{ $invoice->no_fpb5 }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    @if ($invoice->no_fpb2)
                                        <td>2.</td>
                                        <td>{{ $invoice->no_fpb2 }}</td>
                                    @endif
                                    @if ($invoice->no_fpb4)
                                        <td>4.</td>
                                        <td>{{ $invoice->no_fpb4 }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                @endif
            </tr>
        </table>
    @endif

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
            @foreach ($invoice->detail_invoice_array as $index => $item)
                <tr>
                    <td class="center-col">{{ $index + 1 }}</td>
                    <td class="desc-col">{{ $item['deskripsi'] }}</td>
                    <td class="center-col">{{ number_format($item['qty'], 2) }}</td>
                    <td class="center-col">{{ $item['satuan'] ?? 'LS' }}</td>
                    <td class="num-col">Rp. {{ number_format($item['harga'], 0, ',', '.') }}</td>
                    <td class="num-col">Rp. {{ number_format($item['total'] ?? 0, 0, ',', '.') }}</td>
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
                <span style="font-weight: bold;">Rp.
                    {{ number_format($invoice->total_invoice * 0.11, 0, ',', '.') }}</span>
            </div>
            <div style="border-top: 2px solid #333; padding-top: 8px; margin-top: 8px;">
                <span style="font-weight: bold; margin-right: 30px; font-size: 13px;">TOTAL HARGA</span>
                <span style="font-weight: bold; font-size: 13px;">Rp.
                    {{ number_format($invoice->total_invoice * 1.11, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <div class="terbilang">
        Terbilang:
        <em>{{ ucwords(\Riskihajar\Terbilang\Facades\Terbilang::make((int) round($invoice->total_invoice * 1.11))) }}
            Rupiah</em>
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
    <table class="footer" style="width:100%; margin-top:40px; page-break-inside: avoid;">
        <tr>
            <!-- Kolom kiri kosong atau bisa isi keterangan tambahan -->
            <td style="width:60%;"></td>

            <!-- Kolom kanan untuk tanggal & tanda tangan -->
            <td style="width:40%; text-align:center; vertical-align:top;">
                <!-- Tanggal -->
                <div class="contact-info" style="margin-bottom:80px; font-weight: bold;">
                    @php
                        \Carbon\Carbon::setLocale('id');
                        $tanggal = \Carbon\Carbon::now()->translatedFormat('d F Y');
                    @endphp
                    Surabaya, {{ $tanggal }}
                </div>

                <!-- Tanda tangan -->
                <div class="signature-section">
                    {{-- <div class="signature-line">

                        <img src="{{ public_path('assets/images/mpa_logo.png') }}" alt="ttd">

                    </div> --}}
                    <div> <u>( Mariyadi, ST, MM )</u> </div>
                    <div>Direktur</div>
                </div>
            </td>
        </tr>
    </table>

    <!-- Kop Surat di pojok kanan bawah -->
    <img src="{{ public_path('assets/images/kopsuratmpa.png') }}" alt="kop-surat"
        style="position: absolute; bottom: 10px; right: 10px; height: 40px;" />


<!-- Biar kwitansi mulai di halaman baru -->
<div style="page-break-after: always;"></div>
@php
    // Pisahkan nomor invoice by "/"
    $parts = explode('/', $invoice->no_invoice);

    // Ambil prefix (contoh: "MPA002")
    $prefix = $parts[0] ?? $invoice->no_invoice;

    // Ambil bulan dan tahun dari created_at
    $monthNumber = date('n', strtotime($invoice->created_at ?? now()));
    $tahun = date('Y', strtotime($invoice->created_at ?? now()));

    // Mapping bulan ke romawi
    $bulanRomawi = [
        1 => 'I',
        2 => 'II',
        3 => 'III',
        4 => 'IV',
        5 => 'V',
        6 => 'VI',
        7 => 'VII',
        8 => 'VIII',
        9 => 'IX',
        10 => 'X',
        11 => 'XI',
        12 => 'XII',
    ];
    $bulan = $bulanRomawi[$monthNumber];
@endphp

    <!-- ========== KWITANSI ========== -->
    <div class="kwitansi">
        <table style="width:100%; border:1px solid #000; border-collapse:collapse; font-size:12px;">
            <!-- Header -->
            <tr>
                <td style="width:70%; padding:8px; vertical-align:top; border-bottom:1px solid #000;">
                    <img src="{{ public_path('assets/images/mpalogo.png') }}" style="height:60px;">
                    {{-- <div style="font-size:11px; font-weight:bold;">PT. MULTI POWER ABADI</div> --}}
                    <div style="font-size:10px;">Jl. Gunung Anyar Tambak IV No.50 Surabaya</div>
                </td>
                <td
                    style="width:30%; padding:8px; text-align:right; vertical-align:top; border-bottom:1px solid #000; font-size:24px; font-weight:bold; text-decoration:underline;">
                    KUITANSI
                </td>
            </tr>

            <!-- Isi -->
            <tr>
                <td colspan="2" style="padding:8px;">
                    <table style="width:100%; border-collapse:collapse; font-size:12px;">
                        <tr>
                            <td style="width:25%; padding:4px;">No. Kuitansi</td>
                            <td style="width:75%; padding:4px;">
                                : {{ $prefix }}/KUI/{{ $bulan }}/{{ $tahun }}
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:4px;">Sudah terima dari</td>
                            <td style="padding:4px;">: {{ $invoice->nama_client }}</td>
                        </tr>
                        <tr>
                            <td style="padding:4px; vertical-align:top;">Untuk Pembayaran</td>
                            <td style="padding:4px;">
                                :
                                @foreach ($invoice->detail_invoice_array as $index => $item)
                                    {{ $item['deskripsi'] }}@if ($index < count($invoice->detail_invoice_array) - 1)
                                        ,
                                    @endif
                                @endforeach
                            </td>

                        </tr>


                        <tr>
                            <td style="padding:4px;">Terbilang</td>
                            <td style="padding:4px;">:
                                <em style="text-transform: capitalize;">
                                    {{ \Riskihajar\Terbilang\Facades\Terbilang::make((int) round($invoice->total_invoice * 1.11)) }}
                                </em> <i>Rupiah</i>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:4px;">Jumlah</td>
                            <td style="padding:4px; font-weight:bold; text-decoration: underline;">: Rp.
                                {{ number_format($invoice->total_invoice * 1.11, 0, ',', '.') }}
                            </td>
                        </tr>

                    </table>
                </td>
            </tr>

            <!-- Footer -->
            <tr>
                <td colspan="2" style="padding:12px; text-align:right; vertical-align:bottom;">
                    <div style="text-align:center; font-size:12px; display:inline-block; min-width:220px;">
                        <div class="contact-info" style="margin-bottom:50px; font-weight: bold;">
                            @php
                                \Carbon\Carbon::setLocale('id');
                                $tanggal = \Carbon\Carbon::now()->translatedFormat('d F Y');
                            @endphp
                            Surabaya, {{ $tanggal }}
                        </div>


                        <!-- Materai + Tanda tangan -->
                        <div style="height:20px; margin-bottom:5px; position:relative;">
                            {{-- <img style="text-align: center; height:40px;"
                                src="{{ public_path('assets/images/mpa_logo.png') }}"
                                style="height:50px; position:absolute; left:10px; top:10px;"> --}}
                            {{-- @if ($invoice->ttd)
                                <img src="{{ public_path('assets/images/ttd.png') }}"
                                    style="height:50px; margin-top:15px;">
                            @endif --}}
                        </div>

                        <u>( Mariyadi, ST, MM )</u><br>
                        Direktur
                    </div>
                </td>
            </tr>
        </table>
    </div>


</body>

</html>
