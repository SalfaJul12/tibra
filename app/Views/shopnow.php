<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Checkout - TIBRA HARDWARE</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
      overflow-x: hidden;
    }
    .navbar { background-color: white; box-shadow: 0 2px 4px rgba(0,0,0,.1); padding: 10px 0; }
    .navbar-brand h4 { color: #2c3e50; font-weight: 700; }
    .menu-bar { background-color: #55778E; color: white; padding: 10px 0; }
    .menu-bar ul { list-style: none; display: flex; align-items: center; padding: 0; margin: 0; }
    .menu-bar li { margin-right: 20px; }
    .menu-bar a { color: white; text-decoration: none; }
    .menu-bar input { padding: 5px 10px; border-radius: 4px; border: none; }
    .checkout-container { background: #fff; padding: 30px; margin: 30px 0; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,.1); }
    .checkout-header { color: #55778E; font-weight: 700; text-align: center; margin-bottom: 30px; }
    .product-img { width: 80px; height: 80px; object-fit: cover; border-radius: 4px; }
    .sidebar-box { background: #e9ecef; padding: 15px; border-radius: 8px; margin-bottom: 20px; }
    .sidebar-title { color: #55778E; font-weight: 600; }
    .payment-methods { list-style: none; padding: 0; }
    .payment-methods li { margin-bottom: 5px; }
    .finish-btn { background: #55778E; color: #fff; border: none; padding: 10px 25px; border-radius: 4px; font-weight: 600; }
    .finish-btn:hover { background: #3a5a6e; }
    footer { background: #55778E; color: #fff; padding: 20px 0; }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg px-4">
  <a class="navbar-brand fw-bold" href="<?= base_url() ?>">TIBRA <span>HARDWARE</span></a>
  <div class="ms-auto d-flex align-items-center">
    <ul class="navbar-nav flex-row gap-3">
      <?php $session = \Config\Services::session(); ?>
      <?php if (!$session->get('logged_in')): ?>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('login') ?>">Login</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('register') ?>">Register</a></li>
      <?php else: ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
            <?= esc($session->get('fullname')) ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="<?= base_url('profile') ?>">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="<?= base_url('logout') ?>">Logout</a></li>
          </ul>
        </li>
      <?php endif; ?>
    </ul>
  </div>
</nav>

<!-- Menu Bar -->
<div class="menu-bar">
  <div class="container">
    <ul class="d-flex align-items-center w-100">
      <li><a href="<?= base_url() ?>">Beranda</a></li>
      <li><a href="<?= base_url('kategori') ?>">Kategori</a></li>
      <li><a href="<?= base_url('about') ?>">Tentang</a></li>
      <li class="ms-auto d-flex align-items-center">
      </li>
    </ul>
  </div>
</div>

<!-- Checkout Content -->
<div class="container">
  <div class="checkout-container">
    <h3 class="checkout-header">SHOPPING</h3>

    <div class="row">
      <div class="col-md-8">
        <?php $grandTotal = 0; ?>
        <?php foreach ($cartItems as $item): ?>
          <div class="d-flex mb-3">
            <img src="/uploads/<?= esc($item['photo_produk']) ?>" class="product-img me-3">
            <div>
              <p class="fw-bold mb-1"><?= esc($item['nama_produk']) ?></p>
              <p>Qty: <?= esc($item['qty']) ?> x Rp<?= number_format($item['harga_produk']) ?></p>
              <p>Total: Rp<?= number_format($item['harga_total']) ?></p>
            </div>
          </div>
          <?php $grandTotal += $item['harga_total']; ?>
        <?php endforeach; ?>
        <hr>
        <p class="fw-bold">Grand Total: Rp<?= number_format($grandTotal) ?></p>
      </div>
      <div class="col-md-4">
        <div class="sidebar-box mb-3">
          <h6 class="sidebar-title">Payment Methods</h6>
          <ul class="payment-methods">
            <li>BCA</li>
            <li>BNI</li>
            <li>OCBC</li>
            <li>MANDIRI</li>
          </ul>
        </div>

        <div class="sidebar-box mb-3">
          <h6 class="sidebar-title">Shipping Options</h6>
          <ul class="payment-methods">
            <li>JNE Express</li>
            <li>J&T Express</li>
            <li>SiCepat</li>
          </ul>
        </div>
      </div>
    </div>
    <hr class="my-4">
    <form action="<?= base_url('home/finishPayment') ?>" method="post">
      <div class="row">
        <div class="col-md-6">
          <!-- PILIH PENGIRIMAN & PEMBAYARAN -->
          <div class="mb-3">
            <label class="form-label">Pilih Pengiriman</label>
            <select class="form-select" name="shipping" required>
              <option value="" disabled selected>Pilih Pengiriman</option>
              <option value="jne">JNE Express</option>
              <option value="jnt">JNT Express</option>
              <option value="sicepat">SiCepat</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Pilih Metode pembayaran</label>
            <select class="form-select" name="payment" required>
              <option value="" disabled selected>Pilih Metode pembayaran</option>
              <option value="bca">BCA</option>
              <option value="bni">BNI</option>
              <option value="ocbc">OCBC</option>
              <option value="mandiri">Mandiri</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">No. Rekening</label>
            <input type="text" class="form-control" name="norek" pattern="\d{8,16}" required>
          </div>

          <div class="mb-3">
            <label class="form-label">No. Kartu</label>
            <input type="text" class="form-control" name="nokartu" pattern="\d{12,16}" required>
          </div>

          <div class="mb-3">
            <label class="form-label">PIN</label>
            <input type="password" class="form-control" name="pin" pattern="\d{4,6}" required>
          </div>
        </div>

        <div class="col-md-6">
          <!-- ADDRESS -->
          <div class="sidebar-box">
            <h6 class="sidebar-title">Shipping Address</h6>
            <div class="mb-2">
              <input 
                type="text" 
                name="address" 
                class="form-control" 
                placeholder="Masukkan alamat pengiriman"
                value="<?= esc($session->get('address')) !== 'empty' ? esc($session->get('address')) : '' ?>"
                required>
            </div>
          </div>

          <div class="d-flex align-items-end justify-content-end">
            <button type="submit" class="finish-btn">
              <i class="fas fa-check-circle"></i> Finish payment
            </button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<footer class="text-center">
  <p>© 2025 TIBRA HARDWARE. Seluruh hak cipta dilindungi undang-undang.</p>
  <p>Alamat: Jl. Karapitan No. 116, Bandung | Email: tibra@technology.id | Telp: +62 812 3456 7890</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>