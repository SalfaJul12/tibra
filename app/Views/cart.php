<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Shopping Cart</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container my-5">
  <h2><i class="fas fa-shopping-cart"></i> Keranjang Belanja</h2>
  <table class="table table-bordered table-striped mt-3">
    <thead class="thead-dark">
      <tr>
        <th>Produk</th>
        <th>Harga</th>
        <th>Jumlah</th>
        <th>Total</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <!-- Contoh item -->
      <tr>
        <td>Produk A</td>
        <td>Rp10.000</td>
        <td>2</td>
        <td>Rp20.000</td>
        <td>
          <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Hapus</button>
        </td>
      </tr>
      <tr>
        <td>Produk B</td>
        <td>Rp15.000</td>
        <td>1</td>
        <td>Rp15.000</td>
        <td>
          <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Hapus</button>
        </td>
      </tr>
    </tbody>
  </table>

  <div class="text-right">
    <h4>Total: <strong>Rp35.000</strong></h4>
    <button class="btn btn-success"><i class="fas fa-credit-card"></i> Checkout</button>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>