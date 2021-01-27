<?php

session_start();

if (isset($_SESSION["login"])) {
    header("Location: home.php");
}

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
    @font-face {
        font-family: "Montserrat";
        src: url("fonts/Montserrat-Regular.ttf")
    }

    * {
        color: #2D3748;
        font-family: "Montserrat";
    }

    body {
        background-color: #E2E8F0;
    }

    #nav {
        background-color: #2D3748;
    }

    .step {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, .1), 0 4px 6px -2px rgba(0, 0, 0, .05);
        border-radius: 1rem;
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
                    <a href="login.php">
                        <button type="button" class="btn btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16" style="margin-bottom: 3px;">
                                <path class="text-white" fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z" />
                                <path class="text-white" fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                            </svg>
                            <span class="visually-hidden text-white" style="font-family: Segoe UI;">Masuk</span>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div id="content">
        <div class="container my-4">
            <div class="row py-4">
                <div class="col-md-6 order-md-2 my-3">
                    <img src="img/illust1.svg" class="img-fluid p-4" alt="">
                </div>
                <div class="col-md-6 d-flex justify-content-center align-items-center pr-5 my-3">
                    <div>
                        <h1 class="font-weight-bold">KARTU PELAJAR</h1>
                        <h5 class="">Isi data dirimu dan Cetak sekarang juga !</h5>
                        <a href="login.php">
                            <button type="submit" class="btn btn-primary col-6 my-4  rounded-pill py-2 font-weight-bold shadow" name="login">
                                Masuk
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 text-center mt-4">
                <h1 class="font-weight-bold">TUTORIAL</h1>
            </div>
            <div class="row py-4">
                <div class="col-12 col-md-6 col-lg-3 text-center">
                    <img src="img/step1.png" class="img-fluid my-2 step" alt="">
                </div>
                <div class="col-12 col-md-6 col-lg-3 text-center">
                    <img src="img/step2.png" class="img-fluid my-2 step" alt="">
                </div>
                <div class="col-12 col-md-6 col-lg-3 text-center">
                    <img src="img/step3.png" class="img-fluid my-2 step" alt="">
                </div>
                <div class="col-12 col-md-6 col-lg-3 text-center">
                    <img src="img/step4.png" class="img-fluid my-2 step" alt="">
                </div>
            </div>
        </div>
    </div>



</body>
<html>