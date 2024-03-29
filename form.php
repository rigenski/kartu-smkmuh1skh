<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
}

include 'functions/function.php';

$id = $_SESSION['key'];
$data = read("SELECT * FROM siswa WHERE id = $id")[0];
$tanggal_lahir = explode('/', $data['tanggal_lahir']);

// if ($data['foto'] !== "") {
//   header('Location: home.php');
// }


if (isset($_POST['cetak'])) {
  if (updateCard($_POST) > 0) {
    echo "<script>alert('Berhasil Menyimpan');
    document.location.href = 'home.php';</script>";
  } else {
    echo "<script>alert('Berhasil Menyimpan');
    document.location.href = 'home.php';</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Form Biodata Siswa</title>
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/bootstrap-datepicker.min.css" />
  <link rel="stylesheet" href="css/croppie.css" />
  <link rel="shortcut icon" href="img/icon.ico">
  <style>
    * {
      color: #2D3748;
      font-family: "Segoe UI";
    }

    body {
      background-color: #E2E8F0;
    }

    #nav {
      background-color: #2D3748;
    }

    #form {
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, .1), 0 4px 6px -2px rgba(0, 0, 0, .05);
      border-radius: .8rem;
    }

    #img {
      height: 200px;
      height: 200px;
    }
  </style>
</head>

<body>
  <nav id="nav" class="navbar navbar-expand-lg navbar-light py-2 shadow">
    <div class="container">
      <a class="navbar-brand text-white font-weight-bold " href="home.php">
        <img src="img/logo-white.svg" alt="" width="100px">
      </a>
      <div>
        <div class="ml-auto">
          <a href="logout.php">
            <button type="button" class="btn btn-danger">
              <svg xmlns="http://www.w3.org/2000/svg" height="20" fill="currentColor" class="bi bi-box-arrow-right " viewBox="0 0 16 16" style="margin-bottom: 3px;">
                <path fill-rule="evenodd" class="text-white" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"></path>
                <path fill-rule="evenodd" class="text-white" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"></path>
              </svg>
              <span class="visually-hidden text-white">Keluar</span>
            </button>
          </a>
        </div>
      </div>
    </div>
  </nav>

  <div class="content">
    <div class="container">
      <div id="form" class=" py-2 my-4 white-box bg-white p-4">
        <div class="header text-center py-3">
          <h3 class="m-0">Formulir Kartu Pelajar</h3>
          <h3>SMK Muhammadiyah 1 Sukoharjo</h3>
        </div>
        <form action="" method="post" class="m-0" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?= $_SESSION['key'] ?>">
          <!-- <input type="hidden" name="foto-lama" value="<?= $data['foto'] ?>"> -->
          <h4 class="my-2">NISN: <?= $data['nisn'] ?></h4>
          <div class="form-row">
            <div class="form-group col-md-8">
              <label for="nama">Nama Lengkap</label>
              <input type="text" class="form-control" id="nama" name="nama" value="<?php if ($data['nama'] !== null) {
                                                                                      echo ucwords(strtolower($data['nama']));
                                                                                    } ?>" />
            </div>
            <div class="form-group col-md-4">
              <label for="nisn">NISN</label>
              <input type="text" class="form-control" id="nisn" name="nisn" value="<?php if ($data['nisn'] !== null) {
                                                                                      echo ucwords(strtolower($data['nisn']));
                                                                                    } ?>" />
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-8">
              <label for="tempat-lahir">Tempat Lahir</label>
              <input type="text" class="form-control" id="tempat-lahir" name="tempat-lahir" value="<?php if ($data['tempat_lahir'] !== null) {
                                                                                                      echo ucwords(strtolower($data['tempat_lahir']));
                                                                                                    } ?>" />
              <small>contoh : Sukoharjo</small>
            </div>
            <div class="form-group col-md-4">
              <label for="jenis-kelamin">Jenis Kelamin</label>
              <select class="custom-select" id="jenis-kelamin" name="jenis-kelamin" required>
                <?php
                if ($data['jenis_kelamin'] == "L") {
                  echo "<option selected value='L'>Laki-Laki</option>
                  <option value='P'>Perempuan</option>";
                } else if ($data['jenis_kelamin'] == "P") {
                  echo "<option selected value='P'>Perempuan</option>
                  <option value='L'>Laki-Laki</option>";
                } else {
                  echo "<option selected value=''>-- Pilih --</option>
                  <option value='L'>Laki-Laki</option>
                  <option value='P'>Perempuan</option>";
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-8">
              <label for="alamat">Alamat</label>
              <input type="text" class="form-control" id="alamat" name="alamat" value="<?php if ($data['alamat'] !== null) {
                                                                                          echo ucwords(strtolower($data['alamat']));
                                                                                        } ?>" />
              <small>contoh : Purworejo 02/03, Lorog, Tawangsari, Sukoharjo, Jawa Tengah</small>
            </div>
            <div class="form-group col-md-4">
              <label for="tanggal-lahir">Tanggal Lahir</label>
              <input type="date" class="form-control" id="tanggal-lahir" name="tanggal-lahir" value="<?php if ($data['tanggal_lahir'] !== null) {
                                                                                                        echo $data['tanggal_lahir'];
                                                                                                      } ?>" />
              <small>contoh : 05/15/2004 (Bulan/Tanggal/Tahun)</small>
            </div>
          </div>
          <?php

          if ($data['foto'] == null) {
            echo "<div class='row'>
            <div class='form-group col-md-8'>
              <label for=''>Foto</label>
              <div class='col-12 px-0 mt-2'>
                <div class='alert alert-danger ' role='alert'>
                  <b class='text-danger'>WARNING!!!</b> Upload Foto hanya bisa dilakukan <b class='text-danger'>1x</b> , Silahkan gunakan Foto Formal seperti contoh di bawah. Jika sudah upload foto, maka <b class='text-danger'>tidak bisa dirubah kembali</b>.
                </div>
              </div>
              <div class='custom-file'>
                <input type='file' class='custom-file-input' accept='image/x-png,image/jpg,image/jpeg' id='foto' name='foto' />
                <label class='custom-file-label' for='foto'>-- Pilih Foto --</label>
                <small>max. 6 MB</small>
              </div>
            </div>
            <div class='col-md-4 text-center' id='uploaded_image'>
              <img src='img/sample-photo.jpg' class='img-thumbnail mt-4 ' />
            </div>
          </div>";
          }
          ?>
          <button type="submit" class="btn btn-primary col-12 my-4" name="cetak">
            Simpan Kartu
          </button>
        </form>
      </div>
    </div>
  </div>

  <div id="uploadimageModal" class="modal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Crop &amp; Upload Gambar</h4>
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12 text-center">
              <div id="image_demo"></div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-success crop_image">Crop &amp; Upload</button>
        </div>
      </div>
    </div>
  </div>

  <script src="js/jquery-3.5.1.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/croppie.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/bootstrap-datepicker.id.min.js"></script>
  <script type="text/javascript">
    $(function() {
      $(".datepicker").datepicker({
        format: "dd mm yyyy",
        autoclose: true,
        todayHighlight: true,
      });
    });

    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#img').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
      }
    }

    // $("#foto").change(function() {
    //   $('#img').show();
    //   readURL(this);
    // });

    $(document).ready(function() {
      $image_crop = $('#image_demo').croppie({
        enableExif: true,
        viewport: {
          width: 225,
          height: 300,
          type: 'square' //circle
        },
        boundary: {
          width: 300,
          height: 300
        }
      });

      $('#foto').on('change', function() {
        var reader = new FileReader();
        reader.onload = function(event) {
          $image_crop.croppie('bind', {
            url: event.target.result
          }).then(function() {
            console.log('jQuery bind complete');
          });
        }
        reader.readAsDataURL(this.files[0]);
        $('#uploadimageModal').modal('show');
      });

      $('.crop_image').click(function(event) {
        $image_crop.croppie('result', {
          type: 'canvas',
          size: 'viewport'
        }).then(function(response) {
          $.ajax({
            url: "img/profile/upload.php",
            type: "POST",
            data: {
              "image": response,
              "id": <?= $id ?>
            },
            success: function(data) {
              $('#uploadimageModal').modal('hide');
              $('#uploaded_image').html(data);
            }
          });
        })
      });
    });
  </script>
</body>

</html>