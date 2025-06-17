<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TIBRA HARDWARE</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

    .about {
      padding: 40px 0;
    }

    .tab {
      background-color: white;
      border-radius: 8px;
      padding: 30px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      max-width: 800px;
      margin: 0 auto;
    }

    .tab h3 {
      color: #2c3e50;
      margin-bottom: 20px;
      font-weight: 600;
    }

    .tab p {
      color: #555;
      line-height: 1.6;
      margin-bottom: 15px;
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

      .tab {
        padding: 20px;
      }
    }
  </style>
</head>
<body>
  <!-- Navbar -->
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
        <li><a href="/">Beranda</a></li>
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

  <!-- About Content -->
  <div class="about">
    <div class="container">
      <div class="tab">
        <h3>About US</h3>
        <p>TIBRA ini adalah sebuah website untuk menjual barang-barang bla bla bla bla nla</p>
        <p>Kami adalah perusahaan yang berdedikasi untuk menyediakan produk hardware berkualitas tinggi dengan harga terjangkau. Dengan pengalaman lebih dari 10 tahun di industri ini, kami bangga dapat melayani kebutuhan pelanggan kami dengan baik.</p>
        <p>Visi kami adalah menjadi penyedia perangkat keras terkemuka di Indonesia, sementara misi kami adalah memberikan pengalaman berbelanja yang mudah, aman, dan menyenangkan bagi semua pelanggan kami.</p>
      </div>
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

  <!-- Overlay -->
  <div class="overlay" id="overlay" onclick="toggleProfileSidebar()"></div>

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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