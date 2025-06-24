<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kategori - TIBRA HARDWARE</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="css/popup.css">
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
      overflow-x: hidden;
    }

    .navbar {
      background-color: white;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      padding: 10px 0;
    }

    .navbar-brand h4 {
      color: #2c3e50;
      font-weight: 700;
    }

    .menu-bar {
      background-color: #55778E;
      color: white;
      padding: 10px 0;
    }

    .menu-bar ul {
      list-style: none;
      padding: 0;
      margin: 0;
      display: flex;
      align-items: center;
    }

    .menu-bar li {
      margin-right: 20px;
    }

    .menu-bar a {
      color: white;
      text-decoration: none;
    }

    .menu-bar input {
      padding: 5px 10px;
      border-radius: 4px;
      border: none;
    }

    .kategori-content {
      padding: 20px 0;
    }

    .kategori-menu {
      background-color: #e9ecef;
      border-radius: 8px;
      padding: 15px;
      margin-bottom: 20px;
    }

    .kategori-menu h2 {
      margin-bottom: 15px;
    }

    .kategori-menu input {
      width: 100%;
      padding: 8px;
      border-radius: 4px;
      border: 1px solid #ced4da;
    }

    .card {
      border: none;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    .card-img-top {
      border-top-left-radius: 8px;
      border-top-right-radius: 8px;
      height: 180px;
      object-fit: cover;
    }

    .card-body {
      padding: 15px;
    }

    footer {
      background-color: #55778E;
      color: white;
      padding: 20px 0;
      margin-top: 40px;
    }

    @media (max-width: 768px) {
      .menu-bar ul {
        flex-wrap: wrap;
      }

      .menu-bar li {
        margin-bottom: 5px;
      }

      .col-md-3 {
        flex: 0 0 50%;
        max-width: 50%;
      }
    }

    @media (max-width: 576px) {
      .col-md-3 {
        flex: 0 0 100%;
        max-width: 100%;
      }
    }
  </style>
</head>
<body>

 <!-- Navbar -->
 <nav class="navbar navbar-expand-lg px-4">
    <a class="navbar-brand fw-bold" href="<?= base_url() ?>">TIBRA <span>HARDWARE</span></a>
    <div class="ms-auto d-flex align-items-center">
      <ul class="navbar-nav flex-row gap-3">
        <?php 
        $session = \Config\Services::session();
        if (!$session->get('logged_in')): ?>
          <!-- Jika belum login -->
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('login') ?>">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('register') ?>">Register</a>
          </li>
        <?php else: ?>
          <!-- Jika sudah login -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
              <i class="bi bi-person-circle me-1"></i>
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
    <div class="row align-items-center">
      <div class="col-12 col-md-auto mb-2 mb-md-0">
        <ul class="d-flex flex-wrap align-items-center mb-0">
          <li class="me-3"><a href="#">Beranda</a></li>
          <li class="me-3"><a href="<?= base_url('kategori') ?>">Kategori</a></li>
          <li class="me-3"><a href="<?= base_url('about') ?>">Tentang</a></li>
        </ul>
      </div>
      <div class="col">
      </div>
      <div class="col-auto d-flex align-items-center">
        <?php if ($session->get('logged_in')): ?>
          <button class="btn btn-outline-light" onclick="toggleCart()">
            <i class="fas fa-shopping-cart"></i>
          </button>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<!-- Kategori Content -->
<div class="container kategori-content">
  <div class="kategori-menu">
    <h2>Daftar Produk</h2>

    <form action="<?= base_url('kategori') ?>" method="get" class="mb-3">
        <input type="text" name="keyword" class="form-control" placeholder="Cari produk..." value="<?= esc($keyword ?? '') ?>">
    </form>

    <div class="row">
    <?php if (!empty($produk)) : ?>
        <?php foreach ($produk as $item) : ?>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="<?= base_url('uploads/' . $item['photo_produk']) ?>" class="card-img-top" alt="<?= esc($item['nama_produk']) ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= esc($item['nama_produk']) ?></h5>
                        <p class="card-text"><?= esc($item['merk_produk']) ?> - <?= esc($item['type_produk']) ?></p>
                        <p class="card-text"><strong>Rp. <?= number_format($item['harga_produk'], 0, ',', '.') ?></strong></p>
                        <a href="<?= base_url('home/detail/' . $item['id_produk']) ?>" class="btn btn-primary">Detail</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <div class="alert alert-warning">Produk tidak ditemukan.</div>
    <?php endif; ?>
</div>
</div>
</div>

<div id="cartSidebar">
    <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
        <strong><i class="fas fa-shopping-cart"></i> Cart <?= esc($session->get('fullname')) ?></strong>
        <button class="btn btn-sm btn-danger" onclick="toggleCart()">&times;</button>
    </div>
      <div class="p-2">
          <?php if (!empty($cart)) : ?>
              <?php $grand_total = 0; ?>
              <?php foreach ($cart as $item) : ?>
                  <div class="daftar mb-2 border p-2 rounded">
                      <div class="d-flex justify-content-between align-items-center">
                          <p class="mb-0">
                              <i class="fas fa-box-open"></i> 
                              <?= esc($item['nama_produk']) ?> - 
                              Rp<?= number_format($item['harga_produk']) ?> x <?= $item['qty'] ?> <br>
                              <strong>Total = Rp<?= number_format($item['harga_produk'] * $item['qty']) ?></strong>
                          </p>
                          <a href="<?= base_url('/cart/delete/' . $item['id_cart']) ?>">
                              <button class="btn btn-sm btn-danger">
                                  <i class="fas fa-trash-alt"></i>
                              </button>
                          </a>
                      </div>
                      <div class="mt-1 text-right">
                          <a href="<?= base_url('/home/detail/' . $item['id_produk']) ?>" class="btn btn-sm btn-primary">
                              <i class="fas fa-info-circle"></i> Detail
                          </a>
                      </div>
                  </div>
                  <?php $grand_total += $item['harga_total']; ?>
              <?php endforeach; ?>
              <hr>
              <h5 class="text-right">Total: Rp<?= number_format($grand_total) ?></h5>
              <a href="<?= base_url('home/shopnow/') ?>"><button class="btn btn-success btn-block"><i class="fas fa-credit-card">
              </i> Checkout</button></a>
          <?php else : ?>
              <p>Keranjang kosong.</p>
          <?php endif; ?>
      </div>
  </div>


<!-- Footer -->
<footer class="text-white text-center p-4">
  <p>©️ 2025 TIBRA HARDWARE. Seluruh hak cipta dilindungi undang-undang.</p>
  <p>
    Alamat: Jl. Karapitan No. 116, Bandung, Indonesia<br />
    Email: tibra@technology.id | Telp: +62 812 3456 7890
  </p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  <script>
    function toggleCart() {
      document.getElementById('cartSidebar').classList.toggle('open');
    }
  </script>
</body>
</html>
