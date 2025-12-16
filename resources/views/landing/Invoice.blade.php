<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice Servis</title>
    <link rel="stylesheet" href="{{ asset('css/invoice.css') }}">
</head>
<body>

<div class="invoice-container">

    <!-- HEADER -->
    <div class="invoice-header">
        <div>
            <h2>D’ Delfar Bengkel Motor</h2>
            <small>Depok, Jawa Barat</small>
        </div>
        <div class="invoice-id">
            <strong>INVOICE</strong><br>
            #INV-{{ str_pad($invoice->id, 5, '0', STR_PAD_LEFT) }}
        </div>
    </div>

    <!-- INFO -->
    <div class="invoice-info">
        <div>
            <strong>Customer</strong><br>
            {{ $invoice->customer->nama_customer }}<br>
            {{ $invoice->customer->no_hp }}
        </div>
        <div>
            <strong>Kendaraan</strong><br>
            Plat: {{ $invoice->kendaraan->plat_nomor }}<br>
            KM Servis: {{ $invoice->km_servis }} km
        </div>
    </div>

    <!-- DETAIL -->
    <table class="invoice-table">
        <tr>
            <th>Jenis Servis</th>
            <td>{{ $invoice->jenis_servis }}</td>
        </tr>
        <tr>
            <th>Keluhan</th>
            <td>{{ $invoice->keluhan }}</td>
        </tr>
        <tr>
            <th>Catatan Mekanik</th>
            <td>{{ $invoice->catatan_mekanik }}</td>
        </tr>
        <tr>
            <th>Mekanik</th>
            <td>{{ $invoice->mekanik->nama_mekanik }}</td>
        </tr>
        <tr>
            <th>Tanggal Servis</th>
            <td>{{ $invoice->tanggal_servis }}</td>
        </tr>
    </table>

    <!-- TOTAL -->
    <div class="invoice-total">
        <span>Total Biaya</span>
        <span>Rp {{ number_format($invoice->total_biaya, 0, ',', '.') }}</span>
    </div>

    <!-- STATUS -->
    <div class="invoice-footer">
        <span class="badge {{ $invoice->status }}">
            {{ strtoupper($invoice->status) }}
        </span>
    </div>

</div>

</body>
</html>