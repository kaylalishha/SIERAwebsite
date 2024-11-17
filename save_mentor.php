<?php
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'mentor') {
    header("Location: index.php");
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

// Ambil data dari form
$id_user = $_SESSION['id_user'];
$nim_mentor = $_POST['nim_mentor'];
$nama = $_POST['nama'];
$fakultas = $_POST['fakultas'];
$jurusan = $_POST['jurusan'];
$kelompok = $_POST['kelompok'];
$no_telp = $_POST['no_telp'];
$instagram = $_POST['instagram'];
$id_line = $_POST['id_line'];

// Query untuk menyimpan data mentor
$sql = "INSERT INTO mentor (id_user, nim_mentor, nama, fakultas, jurusan, kelompok, no_telp, instagram, id_line) 
        VALUES ('$id_user', '$nim_mentor', '$nama', '$fakultas', '$jurusan', '$kelompok', '$no_telp', '$instagram', '$id_line')";

if ($conn->query($sql) === TRUE) {
    // Redirect ke dashboard setelah berhasil menyimpan data
    header("Location: dashboard.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
