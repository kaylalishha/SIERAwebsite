<?php
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'mentor') {
    header("Location: login.php");
    exit();
}

// Koneksi ke database
include 'connectdb.php';

$id_user = $_SESSION['id_user'];
$sql = "SELECT nim_user FROM user WHERE id_user = '$id_user'";
$result = $conn->query($sql);


$resform = $result->fetch_assoc();

$nama = $_POST['nama'];
$no_telp = $_POST['no_telp'];
$instagram = $_POST['instagram'];
$id_line = $_POST['id_line'];


$sql = "UPDATE mentor SET nama = '$nama', no_telp = '$no_telp', instagram = '$instagram', id_line = '$id_line' WHERE nim_mentor = '$resform[nim_user]'";
if ($conn->query($sql) === TRUE) {
    header("Location: mentor_profile.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>
