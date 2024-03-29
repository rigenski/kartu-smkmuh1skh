<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
}

require('lib/fpdf.php');
$conn = mysqli_connect("localhost", "root", "", "kartumu");

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

$id = $_SESSION['key'];
$data = read("SELECT * FROM siswa WHERE id = $id")[0];

if ($data['foto'] == "") {
    header('Location: home.php');
}

$jenis_kelamin;

if ($data['jenis_kelamin'] == 'L') {
    $jenis_kelamin = "Laki-Laki";
} else {
    $jenis_kelamin = "Perempuan";
}

$tanggal_lahir = explode('-', $data['tanggal_lahir']);


$pdf = new FPDF('P', 'cm', 'A4');
$pdf->AddPage();
$pdf->Image('./img/card-03.png', 1.4, 1.4, 18);
// FRONT PAGE
$pdf->Image('./img/logo-smk.png', 1.8, 1.6, 0.8);
$pdf->Image('./img/logo-dikdasmen.png', 8.72, 1.54, 1.6);
$pdf->Image("./img/profile/" . $data['foto'], 1.8, 3.5, 1.6);
$pdf->Image("./img/tanda-tangan.png", 8.25, 5.75, 1);
$pdf->Image("./img/cap.png", 7.1, 5.2, 1);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetXY(2.6, 1.6);
$pdf->MultiCell(6.4, 0.4, 'KARTU PELAJAR', 0, 'C');
$pdf->SetFont('Arial', 'B', 9);
$pdf->SetXY(2.6, 2);
$pdf->MultiCell(6.4, 0.4, 'SMK MUHAMMADIYAH 1 SUKOHARJO', 0, 'C');
$pdf->SetFont('Arial', '', 4.8);
$pdf->SetXY(3.8, 2.36);
$pdf->MultiCell(4, 0.2, 'Jl. Anggrek No.2, Denokan, Jetis, Kec. Sukoharjo, Kabupaten Sukoharjo, Jawa Tengah 57511', 0, 'C');
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetXY(3.5, 3.45);
$pdf->MultiCell(6.8, 0.4, strtoupper($data['nama']), 0, 'L');
$pdf->SetFont('Arial', '', 6.2);
$pdf->SetXY(3.5, 3.82);
$pdf->MultiCell(2, 0.3, 'NISN', 0, 'L');
$pdf->SetXY(5.2, 3.82);
$pdf->MultiCell(0.3, 0.3, ':', 0, 'L');
$pdf->SetXY(5.4, 3.82);
$pdf->MultiCell(4.4, 0.3, $data['nisn'], 0, 'L');
$pdf->SetXY(3.5, 4.09);
$pdf->MultiCell(2, 0.3, 'Jurusan', 0, 'L');
$pdf->SetXY(5.2, 4.09);
$pdf->MultiCell(0.3, 0.3, ':', 0, 'L');
$pdf->SetXY(5.4, 4.09);
$pdf->MultiCell(4.4, 0.3, ucwords(strtolower($data['jurusan'])), 0, 'L');
$pdf->SetXY(3.5, 4.36);
$pdf->MultiCell(2, 0.3, 'Jenis Kelamin', 0, 'L');
$pdf->SetXY(5.2, 4.36);
$pdf->MultiCell(0.3, 0.3, ':', 0, 'L');
$pdf->SetXY(5.4, 4.36);
$pdf->MultiCell(4.4, 0.3, $jenis_kelamin, 0, 'L');
$pdf->SetXY(3.5, 4.62);
$pdf->MultiCell(2, 0.3, 'TTL', 0, 'L');
$pdf->SetXY(5.2, 4.62);
$pdf->MultiCell(0.3, 0.3, ':', 0, 'L');
$pdf->SetXY(5.4, 4.62);
$pdf->MultiCell(4.4, 0.3, ucwords(strtolower($data['tempat_lahir'])) . ', ' . $tanggal_lahir[2] . '-' . $tanggal_lahir[1] . '-' . $tanggal_lahir[0], 0, 'L');
$pdf->SetXY(3.5, 4.89);
$pdf->MultiCell(2, 0.3, 'Alamat', 0, 'L');
$pdf->SetXY(5.2, 4.89);
$pdf->MultiCell(0.3, 0.3, ':', 0, 'L');
$pdf->SetXY(5.4, 4.89);
$pdf->MultiCell(4.4, 0.26, ucwords(strtolower($data['alamat'])), 0, 'L');
$pdf->SetFont('Arial', '', 4.8);
$pdf->SetXY(7.5, 5.4);
$pdf->MultiCell(2.5, 0.2, 'Sukoharjo, 04 Januari 2021', 0, 'C');
$pdf->SetXY(7.5, 5.6);
$pdf->MultiCell(2.5, 0.2, 'Kepala Sekolah', 0, 'C');
$pdf->SetFont('Arial', 'B', 4.8);
$pdf->SetXY(7.5, 6.2);
$pdf->MultiCell(2.5, 0.2, 'Drs. Bambang Sahana, M.Pd', 0, 'C');
$pdf->SetFont('Arial', '', 4.8);
$pdf->SetXY(7.5, 6.4);
$pdf->MultiCell(2.5, 0.2, 'NBM. 770 164', 0, 'C');

// BACK PAGE
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetXY(11.8, 2);
$pdf->MultiCell(6.4, 0.4, 'VISI DAN MISI', 0, 'C');
$pdf->SetXY(11.8, 2.36);
$pdf->MultiCell(6.4, 0.4, 'SMK MUHAMMADIYAH 1 SUKOHARJO', 0, 'C');
$pdf->SetFont('Arial', 'B', 7);
$pdf->SetXY(10.8, 3);
$pdf->MultiCell(2, 0.3, 'VISI', 0, 'L');
$pdf->SetFont('Arial', '', 5.4);
$pdf->SetXY(10.8, 3.35);
$pdf->MultiCell(8, 0.2, ' "Sekolah unggul yang menghasilkan lulusan beriman, bertaqwa, berakhlaq mulia, kompeten, mandiri dan tangguh menghadapi era global."', 0, 'L');
$pdf->SetFont('Arial', 'B', 7);
$pdf->SetXY(10.8, 3.9);
$pdf->MultiCell(2, 0.3, 'MISI', 0, 'L');
$pdf->SetFont('Arial', '', 5.4);
$pdf->SetXY(10.8, 4.25);
$pdf->MultiCell(8, 0.2, '1.     Menumbuhkan karakter melalui pembiasaan nilai-nilai islam.', 0, 'L');
$pdf->SetXY(10.8, 4.46);
$pdf->MultiCell(8, 0.2, '2.     Menguatkan pendidikan ketarunaan.', 0, 'L');
$pdf->SetXY(10.8, 4.67);
$pdf->MultiCell(8, 0.2, '3.     Menerapkan budaya industri dilingkungan sekolah.', 0, 'L');
$pdf->SetXY(10.8, 4.88);
$pdf->MultiCell(8, 0.2, '4.     Menerapkan pembelajaran berbasis Industri.', 0, 'L');
$pdf->SetXY(10.8, 5.09);
$pdf->MultiCell(8, 0.2, '5.     Melaksanakan uji kompetensi melalui industri dan lembaga sertifikasi profesi.', 0, 'L');
$pdf->SetXY(10.8, 5.30);
$pdf->MultiCell(8, 0.2, '6.     Menerapkan system management mutu secara konsisten dan berkelanjutan.', 0, 'L');
$pdf->SetXY(10.8, 5.51);
$pdf->MultiCell(8, 0.2, '7.     Menerapkan system management mutu dan pelayanan prima secara konsisten dan', 0, 'L');
$pdf->SetXY(10.8, 5.72);
$pdf->MultiCell(8, 0.2, '        berkelanjutan.', 0, 'L');
$pdf->SetXY(10.8, 5.93);
$pdf->MultiCell(8, 0.2, '8.     Membangun SDM yang berkualitas dan professional.', 0, 'L');

$pdf->Output('I', 'kartu pelajar.pdf');
