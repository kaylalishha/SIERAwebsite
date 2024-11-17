<?php
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'mahasiswa') {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Isi Data Mahasiswa</title>
</head>
<body>
    <h2>Form Data Mahasiswa</h2>
    <form action="save_mahasiswa.php" method="POST">
        <input type="text" name="nim_mhs" placeholder="NIM" required><br>
        <input type="text" name="nama" placeholder="Nama" required><br>
        <input type="text" name="domisili" placeholder="Domisili"><br>
        <input type="date" name="tanggal_lahir" placeholder="Tanggal Lahir"><br>
        <input type="text" name="fakultas" placeholder="Fakultas"><br>
        <input type="text" name="jurusan" placeholder="Jurusan"><br>
        <input type="text" name="asalsma" placeholder="Asal SMA"><br>
        <input type="number" name="kelompok" placeholder="Kelompok"><br>
        <input type="text" name="bio" placeholder="Bio"><br>
        <input type="number" name="no_telp" placeholder="Nomor Telepon"><br>
        <input type="text" name="instagram" placeholder="Instagram"><br>
        <input type="text" name="id_line" placeholder="ID Line"><br>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>
