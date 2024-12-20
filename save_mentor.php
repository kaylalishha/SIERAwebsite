<?php
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'mentor') {
    header("Location: login.php");
    exit();
}

// Koneksi ke database
include 'connectdb.php';

// Ambil data dari form
$id_user = $_SESSION['id_user'];
$sql = "SELECT nim_user, kelompok FROM user WHERE id_user = '$id_user'";
$result = $conn->query($sql);


$resform = $result->fetch_assoc();

$nim_mentor = $resform['nim_user'];
$nama = $_POST['nama'];
$fakultas = $_POST['fakultas'];
$jurusan = $_POST['jurusan'];
$kelompok = $resform['kelompok'];
$no_telp = $_POST['no_telp'];
$instagram = $_POST['instagram'];
$id_line = $_POST['id_line'];

$_SESSION['nim_mentor'] = $nim_mentor;
// Query untuk menyimpan data mentor
$sql = "INSERT INTO mentor (id_user, nim_mentor, nama, fakultas, jurusan, kelompok, no_telp, instagram, id_line) 
        VALUES ('$id_user', '$nim_mentor', '$nama', '$fakultas', '$jurusan', '$kelompok', '$no_telp', '$instagram', '$id_line')";

if ($conn->query($sql) === TRUE) {
    // Redirect ke dashboard setelah berhasil menyimpan data
    header("Location: mentor_dashboard.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
