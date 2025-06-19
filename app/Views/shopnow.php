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

    .checkout-container {
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      padding: 30px;
      margin-top: 30px;
      margin-bottom: 30px;
    }

    .checkout-header {
      color: #55778E;
      font-weight: 700;
      margin-bottom: 30px;
      text-align: center;
    }

    .product-img {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 4px;
    }

    .sidebar-box {
      background-color: #e9ecef;
      border-radius: 8px;
      padding: 15px;
      margin-bottom: 20px;
    }

    .sidebar-title {
      color: #55778E;
      font-weight: 600;
      margin-bottom: 10px;
    }

    .payment-methods {
      list-style: none;
      padding-left: 0;
    }

    .payment-methods li {
      margin-bottom: 5px;
    }

    .finish-btn {
      background-color: #55778E;
      color: white;
      border: none;
      padding: 10px 25px;
      border-radius: 4px;
      font-weight: 600;
      transition: background-color 0.3s;
    }

    .finish-btn:hover {
      background-color: #3a5a6e;
    }

    footer {
      background-color: #55778E;
      color: white;
      padding: 20px 0;
      margin-top: 40px;
    }

    @media (max-width: 768px) {
      .checkout-container {
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
        <li><a href="#">Beranda</a></li>
        <li><a href="kategori">Kategori</a></li>
        <li><a href="about">Tentang</a></li>
        <li class="ms-auto d-flex align-items-center">
          <input type="text" placeholder="Search .." />
          <button class="btn btn-link text-white ms-2" id="hamburgerBtn">
            <i class="fas fa-bars"></i>
          </button>
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
          <div class="d-flex mb-4">
            <img src="/uploads/<?= esc($produk['photo_produk']) ?>" class="product-img me-4" alt="<?= esc($produk['nama_produk']) ?>">
            <div>
              <p class="fw-bold mb-1"><?= esc($produk['type_produk']) ?></p>
              <p class="fw-bold mb-1"><?= esc($produk['nama_produk']) ?></p>
              <p class="mb-1">Quantity: 1x</p>
              <p class="fw-bold text-primary">Rp. <?= number_format($produk['harga_produk'], 0, ',', '.') ?></p>
            </div>
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="sidebar-box">
            <h6 class="sidebar-title">Payment Methods</h6>
            <ul class="payment-methods">
              <li>BCA</li>
              <li>BNI</li>
              <li>OCBC</li>
              <li>MANDIRI</li>
            </ul>
          </div>
          
          <div class="sidebar-box">
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
              <label for="norek" class="form-label">No. Rekening:</label>
              <input type="text" id="norek" name="norek" class="form-control" required>
            </div>
            
            <div class="mb-3">
              <label for="nokartu" class="form-label">No. Kartu:</label>
              <input type="text" id="nokartu" name="nokartu" class="form-control" required>
            </div>
            
            <div class="mb-3">
              <label for="pin" class="form-label">PIN:</label>
              <input type="password" id="pin" name="pin" class="form-control" required>
            </div>
          </div>
          
          <div class="col-md-6 d-flex align-items-end justify-content-end">
            <button type="submit" class="finish-btn">Finish payment</button>
          </div>
        </div>
      </form>
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