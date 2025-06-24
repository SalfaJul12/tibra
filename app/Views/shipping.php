<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Status Pengiriman - TIBRA HARDWARE</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f0f4f8;
    }
    .card-box {
      background: #ffffff;
      border-radius: 15px;
      padding: 25px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      margin-bottom: 30px;
    }
    .status-line {
      display: flex;
      justify-content: space-between;
      margin-top: 20px;
    }
    .status-step {
      text-align: center;
      flex: 1;
      position: relative;
    }
    .status-step::after {
      content: "";
      position: absolute;
      top: 12px;
      right: -50%;
      height: 4px;
      background: #5e84a2;
      width: 100%;
      z-index: -1;
    }
    .status-step:last-child::after {
      content: none;
    }
    .circle {
      width: 25px;
      height: 25px;
      background: #5e84a2;
      border-radius: 50%;
      margin: 0 auto;
    }
    .btn-selesai {
      background: #5e84a2;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 20px;
      font-weight: bold;
    }
  </style>
</head>
<body>

<div class="container my-5">
  <div class="card-box">
    <h4 class="text-center fw-bold mb-4">Status Pengiriman Anda</h4>

    <div class="row">
      <div class="col-md-6">
        <p><strong>Daftar Produk:</strong></p>
        <ul>
          <?php if (isset($checkout['cartItems']) && is_array($checkout['cartItems'])): ?>
            <?php foreach ($checkout['cartItems'] as $item): ?>
              <li>
                <?= esc($item['nama_produk']) ?>
                <?php if (isset($item['type_produk'])): ?>
                  (<?= esc($item['type_produk']) ?>)
                <?php endif; ?>
                - Rp <?= number_format($item['harga_produk']) ?>
              </li>
            <?php endforeach; ?>
          <?php else: ?>
            <li>Tidak ada data produk.</li>
          <?php endif; ?>
        </ul>
        <p><strong>Metode Pembayaran:</strong> <?= strtoupper(esc($checkout['metode_pembayaran'] ?? '-')) ?></p>
        <p><strong>Ekspedisi:</strong> <?= strtoupper(esc($checkout['pengiriman'] ?? '-')) ?></p>
      </div>
      <div class="col-md-6 text-center">
        <?php if (isset($checkout['cartItems'][0]['photo_produk'])): ?>
          <img src="/uploads/<?= esc($checkout['cartItems'][0]['photo_produk']) ?>" class="img-fluid rounded" style="width: 120px;" alt="Produk">
        <?php else: ?>
          <p>Gambar produk tidak tersedia.</p>
        <?php endif; ?>
      </div>
    </div>

    <!-- Garis Status -->
    <div class="status-line mt-5">
      <div class="status-step">
        <div class="circle"></div>
        <p class="mt-2">Dikemas</p>
      </div>
      <div class="status-step">
        <div class="circle"></div>
        <p class="mt-2">Dikirim</p>
      </div>
    </div>

    <!-- Tombol -->
    <div class="text-end mt-4">
      <a href="<?= base_url('home/history') ?>" class="btn btn-selesai">Sudah Diterima</a>
    </div>
  </div>
</div>

</body>
</html>
