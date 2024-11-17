<?php
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'mentor') {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Isi Data Mentor</title>
</head>
<body>
    <h2>Form Data Mentor</h2>
    <form action="save_mentor.php" method="POST">
        <input type="text" name="nim_mentor" placeholder="NIM Mentor" required><br>
        <input type="text" name="nama" placeholder="Nama Mentor" required><br>
        <input type="text" name="fakultas" placeholder="Fakultas"><br>
        <input type="text" name="jurusan" placeholder="Jurusan"><br>
        <input type="text" name="kelompok" placeholder="Kelompok"><br>
        <input type="text" name="no_telp" placeholder="No Telepon"><br>
        <input type="text" name="instagram" placeholder="Instagram"><br>
        <input type="text" name="id_line" placeholder="ID Line"><br>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>
