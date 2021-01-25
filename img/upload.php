<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
}

include '../functions/connection.php';

//upload.php

if (isset($_POST["image"])) {
    $data = $_POST["image"];
    $id = $_POST["id"];
    // $id = $_SESSION['key'];

    $image_array_1 = explode(";", $data);

    $image_array_2 = explode(",", $image_array_1[1]);

    $data = base64_decode($image_array_2[1]);

    $imageName = time() . '.png';

    $query = "UPDATE siswas SET foto = '$imageName' WHERE id = $id";

    mysqli_query($conn, $query);

    file_put_contents($imageName, $data);

    echo '<img src="img/' . $imageName . '" class="img-thumbnail mt-4 mx-4" />';
}
