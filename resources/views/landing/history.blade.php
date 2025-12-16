<h2>Riwayat Transaksi {{ $customer->name }}</h2>

<h3>Service Terakhir</h3>
@if($lastService)
    <p>Tanggal: {{ $lastService->tanggal_servis }}</p>
    <p>Jenis: {{ $lastService->jenis_servis }}</p>
    <p>Keluhan: {{ $lastService->keluhan }}</p>
    <p>Total Biaya: Rp {{ number_format($lastService->total_biaya) }}</p>
@else
    <p>Belum pernah service</p>
@endif

<h3>Pembelian Sparepart Terakhir</h3>
@if($lastPurchase)
    <p>Sparepart: {{ $lastPurchase->sparepart->name }}</p>
    <p>Jumlah: {{ $lastPurchase->quantity }}</p>
    <p>Total: Rp {{ number_format($lastPurchase->total_price) }}</p>
    <p>Tanggal: {{ $lastPurchase->created_at->format('d-m-Y') }}</p>
@else
    <p>Belum pernah membeli sparepart</p>
@endif
