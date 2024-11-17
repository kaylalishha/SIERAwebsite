<?php
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'mahasiswa') {
    header("Location: login.php");
    exit();
}

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbase_siera";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id_user = $_SESSION['id_user'];
$nim_mhs = $_POST['nim_mhs'];
$nama = $_POST['nama'];
$domisili = $_POST['domisili'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$fakultas = $_POST['fakultas'];
$jurusan = $_POST['jurusan'];
$asalsma = $_POST['asalsma'];
$kelompok = $_POST['kelompok'];
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

$conn->close();
?>
