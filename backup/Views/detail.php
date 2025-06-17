<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Produk - TIBRA HARDWARE</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f4f4f4;
      font-family: 'Segoe UI', sans-serif;
    }
    .navbar {
      background: linear-gradient(to right, #7da8c4, #5e84a2);
      color: white;
    }
    .navbar-brand span {
      color: #ccc;
    }
    .nav-link {
      color: white !important;
      margin: 0 10px;
    }
    .nav-link:hover {
      text-decoration: underline;
    }
    .product-container {
      background: linear-gradient(to bottom, #7da8c4, #5e84a2);
      padding: 40px;
      border-radius: 15px;
      margin-top: 30px;
      color: black;
    }
    .product-img {
      width: 100px;
      height: 100px;
      object-fit: contain;
      border-radius: 10px;
      box-shadow: 0 0 5px #444;
    }
    .shop-btn {
      background: white;
      border: none;
      padding: 8px 20px;
      border-radius: 20px;
      font-weight: bold;
      margin-top: 10px;
    }
    .desc-box {
      background: rgba(255, 255, 255, 0.15);
      border-radius: 10px;
      padding: 15px;
      color: #000;
      margin-left: 30px;
      min-height: 140px;
      max-width: 500px;
    }
    footer {
      background-color: #2c3e50;
      color: white;
      text-align: center;
      padding: 20px 0;
      margin-top: 40px;
    }
  </style>
</head>
<body>


  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#">TIBRA <span>HARDWARE</span></a>
      <div class="ms-auto d-flex">
        <a class="nav-link" href="#">Beranda</a>
        <a class="nav-link" href="#">Kategori</a>
        <a class="nav-link" href="#">Tentang</a>
        <a class="nav-link" href="#">Account</a>
        <a class="nav-link" href="#">Logout</a>
      </div>
    </div>
  </nav>


  <div class="container">
    <div class="product-container d-flex justify-content-between align-items-start flex-wrap">
      <div class="d-flex align-items-start flex-wrap">
        <img src="/Assets/img/cpu.png" class="product-img me-4" alt="CPU">
        <div>
          <p class="mb-1">Procecor</p>
          <h5 class="fw-bold">Procecor Intel 1911</h5>
          <p class="mb-1">Rp. 750.000</p>
          <a href="<?= base_url('home/shopnow') ?>" class="shop-btn">Shop Now</a>
        </div>
      </div>
      <div class="desc-box">
        <h6 class="fw-bold">Deskripsi</h6>
        <p>
          Procecor Intel 1911 adalah salah satu inovasi terbaru dari Intel yang dirancang untuk memenuhi kebutuhan komputasi modern dengan performa tinggi dan efisiensi daya maksimal. Dibekali dengan arsitektur generasi terbaru, Intel 1911 menghadirkan kecepatan pemrosesan luar biasa yang sangat cocok untuk keperluan multitasking berat, gaming, desain grafis, serta pekerjaan profesional lainnya.
        </p>
        <p>
          Dengan jumlah core dan thread yang ditingkatkan, prosesor ini mampu menangani beban kerja berat tanpa mengalami penurunan performa. Dukungan teknologi Intel Turbo Boost membuatnya mampu mencapai frekuensi clock yang tinggi ketika dibutuhkan, sehingga pengguna dapat merasakan pengalaman komputasi yang cepat dan responsif.
        </p>
        <p>
          Tak hanya itu, Intel 1911 juga mendukung integrasi dengan kartu grafis terbaru serta teknologi memori DDR5, menjadikannya solusi ideal bagi pengguna yang ingin membangun sistem PC yang future-proof. Dilengkapi dengan sistem pendingin canggih dan efisiensi termal yang ditingkatkan, prosesor ini mampu bekerja dengan suhu yang stabil bahkan dalam penggunaan intensif.
        </p>
      </div>
    </div>
  </div>


  <footer>
    <p class="mb-1">© 2025 TIBRA HARDWARE. Seluruh hak cipta dilindungi undang-undang.</p>
    <p>Alamat: Jl. Karapitan No. 116, Bandung, Indonesia</p>
    <p>Email: tibra@technology.id | Telp: +62 812 3456 7890</p>
  </footer>

</body>
</html>
