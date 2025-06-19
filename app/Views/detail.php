<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Detail Produk - TIBRA HARDWARE</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
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

    .product-container {
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      padding: 30px;
      margin-top: 30px;
    }

    .product-img {
      width: 200px;
      height: 200px;
      object-fit: contain;
      border-radius: 8px;
      margin-right: 30px;
    }

    .product-info {
      flex: 1;
    }

    .product-type {
      color: #6c757d;
      margin-bottom: 5px;
    }

    .product-name {
      color: #2c3e50;
      font-weight: 700;
      margin-bottom: 10px;
    }

    .product-price {
      color: #55778E;
      font-weight: 600;
      font-size: 1.2rem;
      margin-bottom: 15px;
    }

    .shop-btn {
      background-color: #55778E;
      color: white;
      border: none;
      padding: 8px 20px;
      border-radius: 4px;
      font-weight: 600;
      transition: background-color 0.3s;
    }

    .shop-btn:hover {
      background-color: #3a5a6e;
    }

    .desc-box {
      background-color: #e9ecef;
      border-radius: 8px;
      padding: 20px;
      margin-top: 20px;
    }

    .desc-title {
      color: #55778E;
      font-weight: 600;
      margin-bottom: 15px;
    }

    footer {
      background-color: #55778E;
      color: white;
      padding: 20px 0;
      margin-top: 40px;
    }

    @media (max-width: 768px) {
      .product-img {
        width: 100%;
        height: auto;
        margin-right: 0;
        margin-bottom: 20px;
      }
      
      .product-container {
        padding: 20px;
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
      <ul class="d-flex align-items-center">
        <li><a href="<?= base_url() ?>">Beranda</a></li>
        <li><a href="<?= base_url('kategori') ?>">Kategori</a></li>
        <li><a href="<?= base_url('about') ?>">Tentang</a></li>
        <li class="ms-auto d-flex align-items-center">
          <input type="text" placeholder="Search .." />
          <button class="btn btn-link text-white ms-2" id="hamburgerBtn">
            <i class="fas fa-bars"></i>
          </button>
        </li>
      </ul>
    </div>
  </div>

  <!-- Product Detail Content -->
  <div class="container my-4">
    <div class="product-container">
      <div class="d-flex flex-wrap">
        <img src="/uploads/<?= esc($produk['photo_produk']) ?>" class="product-img" alt="<?= esc($produk['nama_produk']) ?>">
        
        <div class="product-info">
          <p class="product-type"><?= esc($produk['type_produk']) ?></p>
          <h3 class="product-name"><?= esc($produk['nama_produk']) ?></h3>
          <p class="product-price">Rp. <?= number_format($produk['harga_produk'], 0, ',', '.') ?></p>
          <a href="<?= base_url('home/shopnow/' . $produk['id_produk']) ?>" class="shop-btn">Shop Now</a>
        </div>
      </div>
      
      <div class="desc-box">
        <h5 class="desc-title">Deskripsi Produk</h5>
        <p><?= esc($produk['deskripsi_produk']) ?></p>
        <div class="row mt-3">
          <div class="col-md-4">
            <p><strong>Merk:</strong> <?= esc($produk['merk_produk']) ?></p>
          </div>
          <div class="col-md-4">
            <p><strong>Tahun Pembuatan:</strong> <?= esc($produk['tahun_pembuatan']) ?></p>
          </div>
          <div class="col-md-4">
            <p><strong>Stok Tersedia:</strong> <?= esc($produk['jumlah']) ?> unit</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="text-white text-center p-4">
    <p>© 2025 TIBRA HARDWARE. Seluruh hak cipta dilindungi undang-undang.</p>
    <p>
      Alamat: Jl. Karapitan No. 116, Bandung, Indonesia<br />
      Email: tibra@technology.id | Telp: +62 812 3456 7890
    </p>
  </footer>

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>