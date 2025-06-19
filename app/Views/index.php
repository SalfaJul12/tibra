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
      <ul class="d-flex align-items-center">
        <li><a href="#">Beranda</a></li>
        <li><a href="kategori">Kategori</a></li>
        <li><a href="about">Tentang</a></li>
        <li class="ms-auto d-flex align-items-center">
          <form action="<?= base_url('kategori') ?>"></form>
          <input type="text" placeholder="Search .." />
          <button class="btn btn-link text-white ms-2" id="hamburgerBtn">
            <?php 
              $session = \Config\Services::session();
              if (!$session->get('logged_in')): ?>
                <!-- Jika belum login -->
              <?php else: ?>
                <!-- Jika sudah login -->
                 <button class="dropdown-item" onclick="toggleCart()" style="width:10px;"><i class="fas fa-shopping-cart"></i></button>
              <?php endif; ?>
          </button>
        </li>
      </ul>
    </div>
  </div>

  <!-- Main Content -->
  <div class="container my-4">
    <div class="row g-3">
      <div class="col-md-6 col-lg-6">
        <div class="promo-card d-flex align-items-center">
          <div class="flex-grow-1">
            <h5><strong>Best Seller</strong></h5>
            <p>Get Your Lightning MSi Graphics Cards</p>
            <a href="shopnow" class="btn btn-light btn-sm">Shop Now</a>
          </div>
          <img src="/Assets/img/produk1.jpg" class="promo-img" alt="photo" />
        </div>
      </div>
      <div class="col-md-6 col-lg-6">
        <div class="promo-card d-flex align-items-center">
          <div class="flex-grow-1">
            <h5><strong>Best Collections</strong></h5>
            <p>Get Your Lightning MSi Graphics Cards</p>
            <a href="shopnow" class="btn btn-light btn-sm">Shop Now</a>
          </div>
          <img src="/Assets/img/produk1.jpg" class="promo-img" alt="photo" />
        </div>
      </div>
      <div class="col-md-6 col-lg-6">
        <div class="promo-card small d-flex align-items-center">
          <div class="flex-grow-1" style="margin: 10px;">
            <h6><strong>Best Rating</strong></h6>
            <p>Get Your Lightning MSi Graphics Cards</p>
            <a href="shopnow" class="btn btn-light btn-sm">Shop Now</a>
          </div>
          <img src="/Assets/img/produk1.jpg" class="promo-img" alt="photo" style="max-height: 80px;" />
        </div>
      </div>
      <div class="col-md-6 col-lg-6">
        <div class="promo-card small d-flex align-items-center">
          <div class="flex-grow-1" style="margin: 10px;">
            <h6><strong>Best Product</strong></h6>
            <p>Get Your Lightning MSi Graphics Cards</p>
            <a href="shopnow" class="btn btn-light btn-sm">Shop Now</a>
          </div>
          <img src="/Assets/img/produk1.jpg" class="promo-img" alt="photo" style="max-height: 80px;" />
        </div>
      </div>
    </div>
  </div>

  <!-- Best Seller Section -->
  <div class="container my-4">
    <h4 class="mb-3">Best Seller</h4>
    <div class="scrolling-wrapper d-flex flex-nowrap py-3">
      <div class="card me-3" style="min-width: 50px;">
        <a href="#" style="text-decoration: none; color: black;">
          <img src="/Assets/img/produk1.jpg" class="card-img-top" alt="" />
          <div class="card-body">
            <p class="card-text">Judul Produk<br /><strong>Rp100.000</strong></p>
          </div>
        </a>
      </div>

      <div class="card me-3" style="min-width: 50px;">
        <a href="#" style="text-decoration: none; color: black;">
          <img src="/Assets/img/produk1.jpg" class="card-img-top" alt="" />
          <div class="card-body">
            <p class="card-text">Judul Produk<br /><strong>Rp100.000</strong></p>
          </div>
        </a>
      </div>

      <div class="card me-3" style="min-width: 50px;">
        <a href="#" style="text-decoration: none; color: black;">
          <img src="/Assets/img/produk1.jpg" class="card-img-top" alt="" />
          <div class="card-body">
            <p class="card-text">Judul Produk<br /><strong>Rp100.000</strong></p>
          </div>
        </a>
      </div>
      
    </div>
  </div>

  <!-- Popular Item Section -->
  <div class="container my-4">
    <h4 class="mb-3">Popular Item</h4>
    <div class="scrolling-wrapper d-flex flex-nowrap py-3">
      <div class="card me-3" style="min-width: 200px;">
        <a href="#" style="text-decoration: none; color: black;">
          <img src="/Assets/img/produk1.jpg" class="card-img-top" alt="" />
          <div class="card-body">
            <p class="card-text">Judul Produk<br /><strong>Rp100.000</strong></p>
          </div>
        </a>
      </div>

      <div class="card me-3" style="min-width: 200px;">
        <a href="#" style="text-decoration: none; color: black;">
          <img src="/Assets/img/produk1.jpg" class="card-img-top" alt="" />
          <div class="card-body">
            <p class="card-text">Judul Produk<br /><strong>Rp100.000</strong></p>
          </div>
        </a>
      </div>

            <div class="card me-3" style="min-width: 200px;">
        <a href="#" style="text-decoration: none; color: black;">
          <img src="/Assets/img/produk1.jpg" class="card-img-top" alt="" />
          <div class="card-body">
            <p class="card-text">Judul Produk<br /><strong>Rp100.000</strong></p>
          </div>
        </a>
      </div>

      <div class="card me-3" style="min-width: 200px;">
        <a href="#" style="text-decoration: none; color: black;">
          <img src="/Assets/img/produk1.jpg" class="card-img-top" alt="" />
          <div class="card-body">
            <p class="card-text">Judul Produk<br /><strong>Rp100.000</strong></p>
          </div>
        </a>
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

  <div id="cartSidebar">
    <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
      <strong><i class="fas fa-shopping-cart"></i> Cart</strong>
      <button class="btn btn-sm btn-danger" onclick="toggleCart()">&times;</button>
    </div>
    <div class="p-3">
      <p>Produk A - Rp10.000 x 2</p>
      <p>Produk B - Rp15.000 x 1</p>
      <hr>
      <h5>Total: Rp35.000</h5>
      <button class="btn btn-success btn-block"><i class="fas fa-credit-card"></i> Checkout</button>
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
