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

$nama = $_POST['nama'];
$domisili = $_POST['domisili'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$asalsma = $_POST['asalsma'];
$bio = $_POST['bio'];
$instagram = $_POST['instagram'];
$id_line = $_POST['id_line'];


$sql = "UPDATE mahasiswa SET nama = '$nama', domisili = '$domisili', tanggal_lahir = '$tanggal_lahir', asal_sma = '$asalsma', bio = '$bio', instagram = '$instagram', id_line = '$id_line' WHERE nim_mhs = '$resform[nim_user]'";
if ($conn->query($sql) === TRUE) {
    header("Location: profile.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>
