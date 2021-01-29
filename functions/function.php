<?php

include 'connection.php';

function read($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}


function updateCard($data)
{
    global $conn;

    $id = $data['id'];
    $nama = htmlspecialchars(strtoupper($data['nama']));
    $jenis_kelamin = htmlspecialchars($data['jenis-kelamin']);
    $tempat_lahir = htmlspecialchars(strtoupper($data['tempat-lahir']));
    // $tanggal_lahir = $data['tanggal-lahir'];
    $alamat = htmlspecialchars(strtoupper($data['alamat']));
    // $foto_lama = $data['foto-lama'];

    // if ($_FILES['foto']['error'] == 4) {
    //     $foto = $foto_lama;
    // } else {
    //     $foto = uploadImage();
    // }

    $query = "UPDATE siswa SET nama = '$nama', jenis_kelamin = '$jenis_kelamin', tempat_lahir = '$tempat_lahir', alamat = '$alamat' WHERE id = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


// function uploadImage()
// {

//     $namaFile = $_FILES['foto']['name'];
//     $ukuranFile = $_FILES['foto']['size'];
//     $error = $_FILES['foto']['error'];
//     $tmpName = $_FILES['foto']['tmp_name'];

//     // cek apakah tidak ada gambar yang di upload
//     // if ($error === 4) {
//     //     echo "<script>
//     //             alert('pilih gambar terlebih dahulu);
//     //         </script>";
//     //     return false;
//     // }

//     // cek apakah yang diupload adalah gambar
//     // $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
//     $ekstensiGambar = explode('.', $namaFile);
//     $ekstensiGambar = strtolower(end($ekstensiGambar));
//     // if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
//     //     echo "<script>
//     //                 alert('yang anda upload bukan gambar!');
//     //             </script>";
//     //     return false;
//     // }

//     // cek jika ukuranya terlalu besar
//     // if ($ukuranFile > 100000) {
//     //     echo "<script>
//     //                 alert('ukuran gambar terlalu besar!');
//     //             </script>";
//     //     return false;
//     // }

//     // lolos pengecekan, gambar siap diupload
//     $namaFileBaru = uniqid();
//     $namaFileBaru .= '.';
//     $namaFileBaru .= $ekstensiGambar;


//     move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

//     return $namaFileBaru;
// }
