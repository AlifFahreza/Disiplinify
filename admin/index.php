<?php

include '../config.php';
error_reporting(0);
session_start();

if (isset($_SESSION['username'])) {
  header("Location: dashboard.php");
}

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = md5($_POST['password']);

  $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
  $result = mysqli_query($conn, $sql);
  if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['username'] = $row['username'];
    $_SESSION['namalengkap'] = $row['namalengkap'];
    header("Location: dashboard.php");
  } else { ?>
    <div class="alert">
      <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
      Username dan Password Anda Salah! Mohon Periksa Kembali!
    </div>
    <?php
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Disiplinify.</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
  <link rel="stylesheet" href="../css/bootstrap.min.css" />
  <link rel="stylesheet" href="../css/style.css" />
</head>

<body>

  <section class="vh-100" style="background-color: #F0F0F0;">
    <div class="container py-10 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block shadow-lg" style="border-radius: 1rem;">
                <img src="../image/login.jpg" alt="login form" class="img-fluid"
                  style="border-radius: 1rem 0 0 1rem;" />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center shadow" style="border-radius: 1rem;">
                <div class="card-body p-4 p-lg-5 text-black">
                  <form action="" method="POST" class="login-admin">
                    <div class="d-flex align-items-center mb-3 pb-1">
                      <span class="h1 fw-bold mb-0">Disiplinify.</span>
                    </div>
                    <h7 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Website Sistem Informasi Penanganan
                      Pelanggaran Siswa</h7><br><br>
                    <div class="form-outline mb-3">
                      <input class="form-control form-control-lg" style="font-size: 17px"
                        placeholder="Masukkan Username" name="username" required>
                    </div>
                    <div class="input-group form-outline mb-4">
                      <input type="password" class="form-control form-control-lg" style="font-size: 17px"
                        placeholder="Masukkan Password" name="password" id="password" required>
                      <span class="input-group-text" id="showHide">
                        <i class="fas fa-eye"></i>
                      </span>
                    </div>
                    <div class="d-grid">
                      <input name="submit" class="btn btn-dark" type="submit" value="LOGIN" />
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Section: Design Block -->
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/script.js"></script>
</body>

</html>