<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="/css/style.css" />
  <title>TIBRA - Login</title>
</head>
<body>
  <div class="title1" style="color:white;">
    <p>TIBRA HARDWARE</p>
  </div>

  <div class="title2">
    <p style="color:white;">Pusatnya<br>Hardware<br>Terlengkap<br>di Indonesia</p>
  </div>
  
  <div class="image">

  </div>

  <div class="card">
    <div class="login-form">
        <p class="title-login" style="color: black;">LOGIN</p>
        <form method="post" action="/check">
        <div class="field" style="color: black;">
            <label>Email Adress</label>
            <input type="email" placeholder="Masukkan Email" name="email">
        </div>

        <div class="field" style="color: black;">
            <label>Password</label>
            <input type="password" placeholder="Masukkan Password" name="password">
        </div>

        <div class="forgot-register">
            <span><a href="kanjut" style="color: black;">Forgot Password?</a></span>
        </div>

        <input type="submit" value="LOGIN">

        <div class="sign">
            <span style="color: black;">Don't Have Account? <a href="register" style="color:blue; text-decoration:none;">Register Now</a></span>
        </div>
        </form>
    </div>
    </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
