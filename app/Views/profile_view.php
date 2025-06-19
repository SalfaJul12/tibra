<?php 
$session = \Config\Services::session();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Profile - TIBRA HARDWARE</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
    }
    .profile-card {
      max-width: 800px;
      margin: 30px auto;
      padding: 20px;
      background: white;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold" href="<?= base_url() ?>">TIBRA HARDWARE</a>
    </div>
  </nav>

  <!-- Profile Content -->
  <div class="container">
    <?php if(session()->getFlashdata('message')): ?>
      <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        <?= session()->getFlashdata('message') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>
    
    <div class="profile-card">
      <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Profile Information</h3>
      </div>
      <div class="mb-4">
        <p><strong>Member since:</strong> 
          <?= $session->get('created_at') ? date('F Y', strtotime($session->get('created_at'))) : 'N/A' ?>
        </p>
        <p><strong>Last Login:</strong> 
          <?= $session->get('last_login') ? date('M d, Y H:i', strtotime($session->get('last_login'))) : 'N/A' ?>
        </p>
      </div>
      
      <form action="<?= base_url('profile/update') ?>" method="post">
        <?= csrf_field() ?>
        
        <div class="mb-3">
          <label class="form-label">Full Name</label>
          <input type="text" class="form-control" name="fullname" value="<?= esc($session->get('fullname') ?? '') ?>">
        </div>
        
        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="<?= esc($session->get('email') ?? '') ?>" readonly>
            <small class="text-muted">Email cannot be changed</small>
          </div>
          <div class="col-md-6">
            <label class="form-label">Phone Number</label>
            <input type="text" class="form-control" name="phone" value="<?= esc($session->get('no_telepon') ?? '') ?>">
          </div>
        </div>
        
        <div class="mb-3">
          <label class="form-label">Address</label>
          <textarea class="form-control" name="address" rows="3"><?= esc($session->get('address') ?? '') ?></textarea>
        </div>
        
        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label">Current Password</label>
            <input type="password" class="form-control" name="current_password" placeholder="Enter current password">
          </div>
          <div class="col-md-6">
            <label class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm password">
          </div>
        </div>
        
        <div class="mb-4">
          <label class="form-label">New Password (optional)</label>
          <input type="password" class="form-control" name="new_password" placeholder="Enter new password">
          <small class="text-muted">Leave blank if you don't want to change password</small>
        </div>
        
        <div class="d-grid">
          <button type="submit" class="btn btn-primary">Save Changes</button><br> 
        </div>
      </form>
      <a href="<?= base_url('/') ?>">
        <button class="btn btn-primary btn-danger w-100">BACK</button>
      </a>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-dark text-white text-center p-3 mt-5">
    <p>© 2025 TIBRA HARDWARE. All rights reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>