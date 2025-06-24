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
    .btn-home {
      background: #5e84a2;
      color: white;
      border: none;
      padding: 10px 25px;
      border-radius: 5px;
      font-weight: bold;
      text-decoration: none;
    }
    .btn-home:hover {
      background: #46677f;
    }
  </style>
</head>
<body>

<div class="container my-5">
  <h3 class="fw-bold mb-4 text-center">Riwayat Pembelian Anda</h3>

  <?php if (isset($checkout['cartItems']) && is_array($checkout['cartItems'])): ?>
    <?php foreach ($checkout['cartItems'] as $item): ?>
      <div class="history-box mb-3">
        <div class="d-flex align-items-center">
          <img src="/uploads/<?= esc($item['photo_produk']) ?>" class="img-thumb me-4" alt="Produk">
          <div>
            <p class="mb-1"><strong><?= esc($item['nama_produk']) ?></strong></p>
            <p class="mb-1">Rp. <?= number_format($item['harga_produk'], 0, ',', '.') ?></p>
            <p class="mb-1">Status: <span class="text-success fw-bold">Selesai</span></p>
            <p class="mb-1">
              Dikirim via <?= strtoupper($checkout['pengiriman']) ?> -
              Dibayar melalui <?= strtoupper($checkout['metode_pembayaran']) ?>
            </p>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p>Tidak ada riwayat pembelian.</p>
  <?php endif; ?>

  <!-- Tombol Kembali ke Beranda -->
  <div class="text-center mt-4">
    <a href="<?= base_url('/') ?>" class="btn-home">Kembali ke Beranda</a>
  </div>

</div>

</body>
</html>
