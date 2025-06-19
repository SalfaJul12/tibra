<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Checkout - TIBRA HARDWARE</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>

    body {
      font-family: 'Segoe UI', sans-serif;
      background: #e3ecf3;
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
    .checkout-box {
      background: linear-gradient(to bottom, #7da8c4, #5e84a2);
      border-radius: 15px;
      padding: 30px;
      color: #000;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
    .checkout-img {
      width: 80px;
      height: 80px;
      object-fit: contain;
      border-radius: 10px;
    }
    .finish-btn {
      background-color: white;
      border: none;
      padding: 10px 25px;
      border-radius: 20px;
      font-weight: bold;
    }
    footer {
      background-color: #55778E;
      color: white;
      padding: 20px 0;
      margin-top: 40px;
      text-align: center;
    }
    .sidebar-box {
      background: rgba(255, 255, 255, 0.2);
      border-radius: 10px;
      padding: 15px;
      margin-top: 15px;
    }
    label {
      font-weight: 500;
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
      </div>
    </div>
  </nav>
  

  <div class="container mt-5 mb-4">
    <div class="checkout-box">
      <h3 class="text-center mb-4 fw-bold">SHOPPING</h3>
      <div class="row">
        <div class="col-md-8 d-flex">
          <div class="me-3">
            <p>1x</p>
            <img src="/uploads/<?= esc($produk['photo_produk']) ?>" class="product-img me-4" alt="<?= esc($produk['nama_produk']) ?>">

<p class="fw-bold"><?= esc($produk['type_produk']) ?></p>
<p class="fw-bold"><?= esc($produk['nama_produk']) ?></p>
<p>Rp. <?= number_format($produk['harga_produk'], 0, ',', '.') ?></p>

          </div>
        </div>
        <div class="col-md-4">
          <div class="sidebar-box">
            <p class="fw-bold">Payment</p>
            <ul class="mb-2">
              <li>BCA</li>
              <li>BNI</li>
              <li>OCBC</li>
              <li>MANDIRI</li>
            </ul>
            <p class="fw-bold">Shipping</p>
            <ul>
              <li>JNE Expresss</li>
              <li>J&T Express</li>
              <li>SiCepatt</li>
            </ul>
          </div>
        </div>
      </div>

      <hr class="my-4">

      <form action="<?= base_url('home/finishPayment') ?>" method="post">
        <div class="row">
          <div class="col-md-6">
         <div class="mb-3">
          <select class="form-select" name="shipping" required>
            <option value="" disabled selected>Pilih Pengiriman</option>
            <option value="jne">JNE Express</option>
            <option value="jnt">JNT Express</option>
            <option value="sicepat">SiCepat</option>
  </select>
  </div>
  <div class="mb-3">
          <select class="form-select" name="payment" required>
            <option value="" disabled selected>Pilih Metode pembayaran</option>
            <option value="bca">BCA</option>
            <option value="bni">BNI</option>
            <option value="ocbc">OCBC</option>
            <option value="mandiri">Mandiri</option>
  </select>
  </div>

            <p>Payment: <strong>BCA</strong></p>
            <div class="mb-3">
              <label for="norek">No. Rekening:</label>
              <input type="text" id="norek" name="norek" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="nokartu">No. Kartu:</label>
              <input type="text" id="nokartu" name="nokartu" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="pin">PIN:</label>
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

  <footer>
    <p class="mb-1">© 2025 TIBRA HARDWARE. Seluruh hak cipta dilindungi undang-undang.</p>
    <p>Alamat: Jl. Karapitan No. 116, Bandung, Indonesia</p>
    <p>Email: tibra@technology.id | Telp: +62 812 3456 7890</p>
  </footer>

</body>
</html>
