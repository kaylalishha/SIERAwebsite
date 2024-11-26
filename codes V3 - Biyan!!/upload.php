<?php
session_start();
include 'connectdb.php'; // Koneksi ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $id_user = $_SESSION['id_user']; // Ambil id_user dari sesi
    $id_tugas = $_POST['id_tugas'];
    $file = $_FILES['file'];

    // Query untuk mendapatkan nim_mhs dan kelompok dari tabel mahasiswa
    $queryMahasiswa = "SELECT nim_mhs, kelompok FROM mahasiswa WHERE id_user = '$id_user'";
    $resultMahasiswa = $conn->query($queryMahasiswa);

    if ($resultMahasiswa->num_rows > 0) {
        $dataMahasiswa = $resultMahasiswa->fetch_assoc();
        $nim_mhs = $dataMahasiswa['nim_mhs'];
        $kelompok = $dataMahasiswa['kelompok'];

        // Query untuk mendapatkan nim_mentor berdasarkan kelompok
        $queryMentor = "SELECT nim_mentor FROM mentor WHERE kelompok = '$kelompok'";
        $resultMentor = $conn->query($queryMentor);

        if ($resultMentor->num_rows > 0) {
            $dataMentor = $resultMentor->fetch_assoc();
            $nim_mentor = $dataMentor['nim_mentor'];

            // Proses upload file
            $targetDir = "Uploads/";
            $fileName = basename($file["name"]);
            $targetFile = $targetDir . $fileName;

            if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                // Simpan informasi file ke database
                $queryInsert = "INSERT INTO penilaian_tugas (nim_mhs, nim_mentor, id_tugas, file_path) 
                                VALUES ('$nim_mhs', '$nim_mentor', '$id_tugas', '$targetFile')";
                if ($conn->query($queryInsert)) {
                    echo "File berhasil diupload dan disimpan ke database!";
                } else {
                    echo "Error: " . $conn->error;
                }
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "Tidak ditemukan mentor untuk kelompok ini.";
        }
    } else {
        echo "Data mahasiswa tidak ditemukan untuk id_user ini.";
    }
} else {
    echo "Request tidak valid atau file tidak ditemukan.";
}
?>