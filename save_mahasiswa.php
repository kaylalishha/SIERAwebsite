<?php
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'mahasiswa') {
    header("Location: login.php");
    exit();
}

// Koneksi ke database
include 'connectdb.php';

$id_user = $_SESSION['id_user'];
$sql = "SELECT nim_user, kelompok FROM user WHERE id_user = '$id_user'";
$result = $conn->query($sql);


$resform = $result->fetch_assoc();

$nim_mhs = $resform['nim_user'];
$nama = $_POST['nama'];
$domisili = $_POST['domisili'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$fakultas = $_POST['fakultas'];
$jurusan = $_POST['jurusan'];
$asalsma = $_POST['asalsma'];
$kelompok = $resform['kelompok'];
$bio = $_POST['bio'];
$no_telp = $_POST['no_telp'];
$instagram = $_POST['instagram'];
$id_line = $_POST['id_line'];


$sql = "INSERT INTO mahasiswa (id_user, nim_mhs, nama, domisili, tanggal_lahir, fakultas, jurusan, asal_sma, kelompok, bio, no_telp, instagram, id_line) 
        VALUES ('$id_user', '$nim_mhs', '$nama', '$domisili', '$tanggal_lahir', '$fakultas', '$jurusan', '$asalsma', '$kelompok', '$bio', '$no_telp', '$instagram', '$id_line')";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>
