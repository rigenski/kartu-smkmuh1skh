<?php
session_start();
include 'functions/connection.php';

if (isset($_SESSION["login"])) {
  header("Location: home.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="shortcut icon" href="img/icon.ico">
  <style>
    * {
      color: #2D3748;
      font-family: "Segoe UI";
    }

    body {
      background-color: #2D3748;
    }

    #form {
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, .1), 0 4px 6px -2px rgba(0, 0, 0, .05);
      border-radius: .8rem;
    }
  </style>
</head>

<body>
  <div class="wrapper" style="height: 100vh">
    <div class="container" style="height: 100vh">
      <div class="row justify-content-center my-auto align-content-center" style="height: 100vh">
        <div class="col-md-8 col-lg-6 col-12">
          <div id="form" class="white-box bg-white p-2 p-sm-4">
            <div class="p-2">
              <div class="header-login text-center py-2">
                <img src="img/logo-dark.svg" class="mb-2" alt="" width="200px">
                <h5>Let's start print your siswa card!</h5>
              </div>
              <div class="content-login py-2">
                <!-- FORM LOGIN -->
                <form action="" method="post">
                  <div class="form-group">
                    <label for="nisn" class="mb-0">NISN</label>
                    <input type="text" class="form-control mb-2" id="nisn" name="nisn" autofocus style="
                          border: none;
                          border-bottom: 1px solid #2d3748;
                          border-radius: 0;
                        " />
                    <small>Contoh : 0071910597</small>
                  </div>
                  <div class="form-group">
                    <label for="password" class="mb-0">Password</label>
                    <input type="password" class="form-control mb-2" id="password" name="password" style="
                          border: none;
                          border-bottom: 1px solid #2d3748;
                          border-radius: 0;
                        " />
                    <small>Contoh : 5/10/2020 (Bulan/Tanggal/Tahun)</small>
                  </div>

                  <button type="submit" class="btn btn-primary col-12 my-4 rounded-pill py-2" name="login">
                    Masuk
                  </button>
                  <?php
                  if (isset($_POST["login"])) {
                    $nisn = htmlspecialchars($_POST["nisn"], ENT_QUOTES);
                    $password = $_POST["password"];
                    $err_login = "<div class = 'alert alert-success'role = 'alert' >Masukkan NIS dan password dengan Benar </div>";

                    $result = mysqli_query($conn, "SELECT * FROM siswa WHERE nisn = '$nisn'");

                    //cek nis
                    if (mysqli_num_rows($result) === 1) {
                      // cek password
                      $row = mysqli_fetch_assoc($result);
                      if ($password == $row['tanggal_lahir']) {

                        // set session
                        $_SESSION["login"] = true;
                        $_SESSION["key"] = $row['id'];

                        if ($row['foto'] == null) {
                          header("Location: form.php");
                        } else {
                          header("Location: home.php");
                        }
                      }
                    }

                    echo "<div></div><div class = 'alert alert-danger'role = 'alert' >NIS atau Password Salah </div></div>";
                  }
                  ?>
                </form>
                <!-- FORM LOGIN -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>