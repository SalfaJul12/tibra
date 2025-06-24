<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>TIBRA HARDWARE</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
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

    .profile-sidebar {
      position: fixed;
      top: 0;
      right: -350px;
      width: 350px;
      height: 100%;
      background-color: white;
      box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1);
      z-index: 1050;
      transition: right 0.3s ease;
      padding: 20px;
      overflow-y: auto;
    }

    .profile-sidebar.open {
      right: 0;
    }

    .overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 1040;
      display: none;
    }

    .overlay.show {
      display: block;
    }

    .close-btn {
      position: absolute;
      top: 10px;
      right: 10px;
      font-size: 1.5rem;
      cursor: pointer;
      color: #6c757d;
    }

    .promo-card {
      background-color: #e9ecef;
      border-radius: 8px;
      padding: 15px;
      height: 100%;
    }

    .promo-img {
      max-height: 100px;
      object-fit: contain;
    }

    .scrolling-wrapper {
      overflow-x: auto;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }

    .card {
      display: inline-block;
      margin-right: 15px;
      border: none;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    footer {
      background-color: #55778E;
      color: white;
      padding: 20px 0;
      margin-top: 40px;
    }

    @media (max-width: 768px) {
      .profile-sidebar {
        width: 300px;
      }

      .menu-bar ul {
        flex-wrap: wrap;
      }

      .menu-bar li {
        margin-bottom: 5px;
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
        <form class="d-flex" action="<?= base_url('kategori') ?>" method="get">
          <input type="text" class="form-control me-2" placeholder="Search .." name="q">
          <button class="btn btn-light" type="submit"><i class="fas fa-search"></i></button>
        </form>
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

 <!-- Produk Stok Terbatas -->
<div class="container my-5">
  <h4 class="mb-4 fw-bold">🔥 Best Collection: Stok Terbatas</h4>
  <div class="row g-3">
    <?php if (!empty($produkTerbatas)) : ?>
      <?php foreach ($produkTerbatas as $promo) : ?>
        <div class="col-md-6">
          <div class="card d-flex flex-row shadow h-100">
            <!-- Kiri: Teks -->
            <div class="card-body d-flex flex-column justify-content-between w-100">
              <div>
                <h5 class="card-title fw-bold text-primary"><?= esc($promo['nama_produk']) ?></h5>
                <p class="mb-1"><?= esc($promo['merk_produk']) ?> • <?= esc($promo['type_produk']) ?></p>
                <p class="text-danger">Sisa Stok: <?= esc($promo['jumlah']) ?> pcs</p>
              </div>
              <a href="<?= base_url('home/detail/' . $promo['id_produk']) ?>" class="btn btn-sm btn-outline-primary mt-2">Lihat Detail</a>
            </div>
            <!-- Kanan: Gambar -->
            <div class="p-2">
              <img src="<?= base_url('uploads/' . $promo['photo_produk']) ?>" alt="<?= esc($promo['nama_produk']) ?>" class="img-fluid rounded-end" style="width: 100%; max-width: 120px; height: auto; object-fit: cover;">
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else : ?>
      <div class="col-12">
        <p class="text-muted">Tidak ada produk dengan stok terbatas saat ini.</p>
      </div>
    <?php endif; ?>
  </div>
</div>



<!-- Daftar Semua Produk -->
<div class="container my-5">
  <h4 class="mb-4">Semua Produk</h4>
  <div class="row">
    <?php foreach ($produk as $item) : ?>
      <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
        <div class="card h-100 d-flex flex-column">
          <img src="<?= base_url('uploads/' . $item['photo_produk']) ?>" class="card-img-top img-fluid" alt="<?= esc($item['nama_produk']) ?>" style="object-fit: cover; height: 200px;">
          <div class="card-body d-flex flex-column">
            <h6 class="card-title mb-1"><?= esc($item['nama_produk']) ?></h6>
            <p class="card-text text-muted mb-1"><?= esc($item['merk_produk']) ?> - <?= esc($item['type_produk']) ?></p>
            <p class="card-text fw-bold text-primary">Rp <?= number_format($item['harga_produk'], 0, ',', '.') ?></p>
            <a href="<?= base_url('home/detail/' . $item['id_produk']) ?>" class="btn btn-sm btn-outline-primary mt-auto">Lihat Detail</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
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
              <table>
                <tr>
                  <td><h7>Alamat : <?= esc($session->get('address')) ?> <a href="<?= base_url('profile') ?>" style="text-decoration:none;">
                    Ubah
                  </a></h7></td>
                </tr>
                <tr>
                  <td><h5 class="text-right">Total: Rp<?= number_format($grand_total) ?></h5></td>
                </tr>
              </table>
              <a href="<?= base_url('home/shopnow/') ?>"><button class="btn btn-success btn-block"><i class="fas fa-credit-card">
              </i> Checkout</button></a>
          <?php else : ?>
              <p>Keranjang kosong.</p>
          <?php endif; ?>
      </div>
  </div>


  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  <script>
    function toggleCart() {
      document.getElementById('cartSidebar').classList.toggle('open');
    }
  </script>
  <?php if (session()->getFlashdata('error')): ?>
  <script>
      alert("<?= esc(session()->getFlashdata('error')) ?>");
  </script>
  <?php endif; ?>

  <script>
    function toggleProfileSidebar() {
      const sidebar = document.getElementById('profileSidebar');
      const overlay = document.getElementById('overlay');
      sidebar.classList.toggle('open');
      overlay.classList.toggle('show');
      document.body.style.overflow = sidebar.classList.contains('open') ? 'hidden' : 'auto';
    }

    document.getElementById("hamburgerBtn").addEventListener("click", function (e) {
      e.stopPropagation();
      toggleProfileSidebar();
    });

    document.addEventListener("click", function (e) {
      const sidebar = document.getElementById('profileSidebar');
      const overlay = document.getElementById('overlay');
      if (
        !sidebar.contains(e.target) &&
        !document.getElementById('hamburgerBtn').contains(e.target) &&
        sidebar.classList.contains('open')
      ) {
        toggleProfileSidebar();
      }
    });
  </script>
</body>
</html>