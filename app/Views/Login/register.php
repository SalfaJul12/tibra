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
  <div class="title1">
    <p>TIBRA HARDWARE</p>
  </div>

  <div class="title2">
    <p>Pusatnya<br>Hardware<br>Terlengkap<br>di Indonesia</p>
  </div>

  <div class="card">
    <div class="login-form">
        <p class="title-login" style="color: black;">REGISTER</p>
        <form method="post" action="/register/save">
            <div class="field" style="color: black;">
                <label>Email Address</label>
                <input type="email" placeholder="Masukkan Email" name="email" required>
            </div>
            <div class="field" style="color: black;">
                <label>Fullname</label>
                <input type="text" placeholder="Masukkan Fullname" name="fullname" required>
            </div>

            <div class="field" style="color: black;">
                <label>Password</label>
                <input type="password" placeholder="Masukkan Password" name="password" required>
            </div>
            <div class="sign">
                <span style="color: black;">Already Have Account? <a href="login" style="color:blue; text-decoration:none;">Login Here</a></span>
            </div><br>

        <input type="submit" value="REGISTER">
        </form>
    </div>
   </div>


  <div class="image"></div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
