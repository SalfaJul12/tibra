<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Riwayat Pembelian - TIBRA HARDWARE</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f4f8fb;
    }
    .history-box {
      background: white;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      margin-top: 30px;
    }
    .img-thumb {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 10px;
    }
  </style>
</head>
<body>

<div class="container my-5">
  <h3 class="fw-bold mb-4 text-center">Riwayat Pembelian Anda</h3>
  <div class="history-box">
    <div class="d-flex align-items-center">
      <img src="/uploads/<?= esc($produk['photo_produk']) ?>" class="img-thumb me-4" alt="Produk">
      <div>
        <p class="mb-1"><strong><?= esc($produk['nama_produk']) ?></strong></p>
        <p class="mb-1">Rp. <?= number_format($produk['harga_produk'], 0, ',', '.') ?></p>
        <p class="mb-1">Status: <span class="text-success fw-bold">Selesai</span></p>
        <p class="mb-1">Dikirim via <?= strtoupper($pengiriman) ?> - Dibayar melalui <?= strtoupper($metode_pembayaran) ?></p>
      </div>
    </div>
  </div>
</div>

</body>
</html>
