<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
}


include 'functions/function.php';

$id = $_SESSION['key'];
$data = read("SELECT * FROM siswas WHERE id = $id")[0];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Form Biodata Siswa</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
</head>

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

    #informasi {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, .1), 0 4px 6px -2px rgba(0, 0, 0, .05);
        border-radius: .8rem;
    }
</style>

<body>
    <nav id="nav" class="navbar navbar-expand-lg navbar-light py-2 shadow">
        <div class="container">
            <a class="navbar-brand text-white font-weight-bold " href=" #">
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

    <div id="content">
        <div class="container my-4">
            <div class="row">
                <div class="col-md-8  mb-4">
                    <div id="informasi" class="p-4 bg-white">
                        <h3 class="font-weight-bold mb-2 ml-2">Informasi</h3>
                        <table style="width: 100%;" cellspacing="0" cellpadding="10">
                            <tr>
                                <td>NIS</td>
                                <td class="font-weight-bold"><?= $data['nis'] ?></td>
                            </tr>
                            <tr>
                                <td class="field">Nama</td>
                                <td class="font-weight-bold"><?= $data['nama'] ?></td>
                            </tr>
                            <tr>
                                <td class="field">Jenis Kelamin</td>
                                </td>
                                <td class="font-weight-bold"><?= $data['jenis_kelamin'] ?></td>
                            </tr>
                            <tr>
                                <td class="field">Tempat, Tanggal Lahir </td>
                                <td class="font-weight-bold"><?= $data['tempat_lahir'] . ',' . $data['tanggal_lahir'] ?></td>
                            </tr>
                            <tr>
                                <td class="field">Alamat</td>
                                <td class="font-weight-bold"><?= $data['alamat'] ?></td>
                            </tr>
                            <tr>
                                <td class="field">Foto</td>
                                <td><img src="img/<?= $data['foto'] ?>" alt="" height="200px" class="rounded"></td>
                            </tr>

                        </table>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <a href="form.php" class="col-12 my-2">
                            <button type="button" class="btn btn-primary col-12 font-weight-bold py-2">
                                Ubah Kartu
                            </button>
                        </a>
                        <a href="print.php" class="col-12  my-2">
                            <button type="button" class="btn btn-success col-12 font-weight-bold py-2">
                                Cetak Kartu
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>