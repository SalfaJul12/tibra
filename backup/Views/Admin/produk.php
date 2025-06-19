<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TIBRA - PRODUCT</title>

    <!-- Custom fonts for this template-->
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard">
                <div class="sidebar-brand-text mx-3">TIBRA <sup>v0.01</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
                    aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Data Setting</span>
                </a>
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">List Data:</h6>
                        <a class="collapse-item active" href="">Produk</a>
                        <a class="collapse-item" href="diskon">Discount</a>
                        <a class="collapse-item" href="user">User</a>
                        <a class="collapse-item" href="report">Report</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Web Menu</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Web Menu:</h6>
                        <a class="collapse-item" href="">Coming Soon</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= session()->get('fullname'); ?></span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="dashboard">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="login" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Daftar Produk</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="container my-5">
                            <?php if(session()->getFlashdata('success')): ?>
                                <p style="color:green;"><?= session()->getFlashdata('success') ?></p>
                            <?php endif; ?>
                            <div class="d-flex justify-content-between mb-3">
                                <a href="tambah_produk.php" class="btn btn-success" data-toggle="modal" data-target="#modalProduk">
                                    <i class="fas fa-plus-circle"></i> Tambah Produk
                                </a>
                            </div>

                            <div class="card shadow-lg">
                            <div class="card-body">
                                <table class="table table-bordered table-hover table-striped align-middle">
                                <thead class="table-primary">
                                    <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Tipe</th>
                                    <th scope="col">Merek</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Tahun Pembuatan</th>
                                    <th scope="col" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($produk as $p): ?>
                                        <tr>
                                            <td><?= $p['id_produk'] ?></td>
                                            <td><?= esc($p['nama_produk']) ?></td>
                                            <td>Rp <?= number_format($p['harga_produk'], 0, ',', '.') ?></td>
                                            <td><?= esc($p['deskripsi_produk']) ?></td>
                                            <td><?= esc($p['type_produk']) ?></td>
                                            <td><?= esc($p['merk_produk']) ?></td>
                                            <td><?= esc($p['jumlah']) ?> pcs</td>
                                            <td>
                                                <?php if($p['photo_produk']): ?>
                                                    <img src="/uploads/<?= esc($p['photo_produk']) ?>" width="80">
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </td>
                                            <td><?= esc($p['tahun_pembuatan']) ?></td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalEditProduk<?= $p['id_produk'] ?>">Edit</button>
                                                <a href="delete/<?= $p['id_produk'] ?>" onclick="return confirm('Hapus produk ini?')">
                                                    <button class="btn btn-sm btn-danger">Hapus</button></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; TIBRA HARDWARE 2025</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!--- MODAL -->
<div class="modal fade" id="modalProduk" tabindex="-1" role="dialog" aria-labelledby="modalProdukLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
        <form action="store" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="modal-header">
            <h5 class="modal-title" id="modalProdukLabel">Tambah Produk</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                    <label for="nama_produk">Nama Produk</label>
                    <input type="text" class="form-control" name="nama_produk" value="<?= old('nama_produk') ?>" id="nama_produk" required>
                </div>
                <div class="form-group">
                    <label for="harga_produk">Harga</label>
                    <input type="number" class="form-control" name="harga_produk" value="<?= old('harga_produk') ?>" id="harga_produk" required>
                </div>
                <div class="form-group">
                    <label for="type_produk">Tipe Produk</label>
                    <select class="form-control" name="type_produk" id="type_produk" required>
                    <option value="" disabled selected>Pilih Kategori</option>
                    <option value="Keyboard">Keyboard</option>
                    <option value="Mouse">Mouse</option>
                    <option value="Monitor">Monitor</option>
                    <option value="CPU">CPU</option>
                    <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="merk_produk">Merk</label>
                    <input type="text" class="form-control" name="merk_produk" value="<?= old('merk_produk') ?>" id="merk_produk" required>
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                    <label for="deskripsi_produk">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi_produk" id="deskripsi_produk" required><?= old('deskripsi_produk') ?></textarea>
                </div>
                <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" class="form-control" name="jumlah" value="<?= old('jumlah') ?>" id="jumlah" required>
                </div>
                <div class="form-group">
                    <label for="tahun_pembuatan">Tahun Pembuatan</label>
                    <input type="number" class="form-control" name="tahun_pembuatan" value="<?= old('tahun_pembuatan') ?>" id="tahun_pembuatan" required>
                </div>
                <div class="form-group">
                    <label for="photo_produk">Image</label>
                    <input type="file" class="form-control" name="photo_produk" id="photo_produk">
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
    </div>
    </div>
  </div>
</div>

<?php foreach ($produk as $p): ?>
    <!--- MODAL -->
<div class="modal fade" id="modalEditProduk<?= $p['id_produk'] ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditProduk<?= $p['id_produk'] ?>Label" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <form action="<?= site_url('update/' . $p['id_produk']) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="modal-header">
          <h5 class="modal-title" id="modalEditProduk<?= $p['id_produk'] ?>Label">Edit Produk</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <?php if(session()->getFlashdata('errors')): ?>
              <ul style="color:red;">
                <?php foreach(session()->getFlashdata('errors') as $error): ?>
                  <li><?= esc($error) ?></li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nama_produk<?= $p['id_produk'] ?>">Nama Produk</label>
                  <input type="text" class="form-control" name="nama_produk" id="nama_produk<?= $p['id_produk'] ?>" value="<?= esc($p['nama_produk']) ?>" required>
                </div>
                <div class="form-group">
                  <label for="harga_produk<?= $p['id_produk'] ?>">Harga</label>
                  <input type="number" class="form-control" name="harga_produk" id="harga_produk<?= $p['id_produk'] ?>" value="<?= esc($p['harga_produk']) ?>" required>
                </div>
                <div class="form-group">
                  <label for="type_produk<?= $p['id_produk'] ?>">Tipe Produk</label>
                  <select class="form-control" name="type_produk" id="type_produk<?= $p['id_produk'] ?>" required>
                    <option value="" disabled>Pilih Kategori</option>
                    <option value="Keyboard" <?= ($p['type_produk'] ?? '') == 'Keyboard' ? 'selected' : '' ?>>Keyboard</option>
                    <option value="Mouse" <?= ($p['type_produk'] ?? '') == 'Mouse' ? 'selected' : '' ?>>Mouse</option>
                    <option value="Monitor" <?= ($p['type_produk'] ?? '') == 'Monitor' ? 'selected' : '' ?>>Monitor</option>
                    <option value="CPU" <?= ($p['type_produk'] ?? '') == 'CPU' ? 'selected' : '' ?>>CPU</option>
                    <option value="Lainnya" <?= ($p['type_produk'] ?? '') == 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="merk_produk<?= $p['id_produk'] ?>">Merk</label>
                  <input type="text" class="form-control" name="merk_produk" id="merk_produk<?= $p['id_produk'] ?>" value="<?= esc($p['merk_produk']) ?>" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="deskripsi_produk<?= $p['id_produk'] ?>">Deskripsi</label>
                  <textarea class="form-control" name="deskripsi_produk" id="deskripsi_produk<?= $p['id_produk'] ?>" required><?= esc($p['deskripsi_produk']) ?></textarea>
                </div>
                <div class="form-group">
                  <label for="jumlah<?= $p['id_produk'] ?>">Jumlah</label>
                  <input type="number" class="form-control" name="jumlah" id="jumlah<?= $p['id_produk'] ?>" value="<?= esc($p['jumlah']) ?>" required>
                </div>
                <div class="form-group">
                  <label for="tahun_pembuatan<?= $p['id_produk'] ?>">Tahun Pembuatan</label>
                  <input type="number" class="form-control" name="tahun_pembuatan" id="tahun_pembuatan<?= $p['id_produk'] ?>" value="<?= esc($p['tahun_pembuatan']) ?>" required>
                </div>
                <div class="form-group">
                  <label for="photo_produk<?= $p['id_produk'] ?>">Image</label>
                  <input type="file" class="form-control" name="photo_produk" id="photo_produk<?= $p['id_produk'] ?>">
                </div>
              </div>
            </div>
          </div>
        </div>
        <input type="hidden" name="old_photo_produk" value="<?= esc($p['photo_produk'] ?? '') ?>">
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endforeach ?>



    <!-- Bootstrap core JavaScript-->
    <script src="admin/vendor/jquery/jquery.min.js"></script>
    <script src="admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="admin/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="admin/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="admin/js/demo/chart-area-demo.js"></script>
    <script src="admin/js/demo/chart-pie-demo.js"></script>

</body>

</html>