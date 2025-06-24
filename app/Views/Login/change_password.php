<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/forget_password.css">
  <title>TIBRA</title>
</head>
<body>
  <div class="title1">
    <p>TIBRA HARDWARE</p>
  </div>

  <div class="title2">
    <p>Pusatnya<br>Hardware<br>Terlengkap<br>di Indonesia</p>
  </div>

  <div class="card">
    <div class="login-form">
        <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
          <?= session()->getFlashdata('error') ?>
        </div>
        <?php endif; ?>
        <p class="title-login" style="color: black;">CHANGE PASSWORD</p>
            <form action="<?= base_url('reset-password') ?>" method="post">
              <div class="field" style="color: black; margin-bottom: 10%;">
                <label>New Password</label>
                <input type="password" name="password" placeholder="Masukkan Password Baru" required>
              </div>
              <div class="field" style="color: black;">
                <label>Re-New Password</label>
                <input type="password" name="re_password" placeholder="Masukkan Password Baru" required>
              </div>
              <input type="submit" value="CHANGE PASSWORD">
            </form>
            <div class="sign">
                <a href="login" style="color:blue; text-decoration:none;">Back to login</a></span>
            </div>
    </div>
    </div>


  <div class="image"></div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>