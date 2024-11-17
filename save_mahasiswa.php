<?php
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'mahasiswa') {
    header("Location: index.html");
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

$sql = "INSERT INTO mahasiswa (id_user, nim_mhs, nama, domisili, tanggal_lahir, fakultas, jurusan) 
        VALUES ('$id_user', '$nim_mhs', '$nama', '$domisili', '$tanggal_lahir', '$fakultas', '$jurusan')";

if ($conn->query($sql) === TRUE) {
    header("Location: index.html");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
