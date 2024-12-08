<?php
session_start();

// Koneksi ke database
include 'connectdb.php';

// Periksa apakah data yang diperlukan telah dikirimkan
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_tugas'], $_POST['file_path'])) {
    $id_tugas = $_POST['id_tugas'];
    $file_path = $_POST['file_path'];

    // Ambil nim mahasiswa dari sesi
    $id_user = $_SESSION['id_user'];
    $queryMahasiswa = "SELECT nim_mhs FROM mahasiswa WHERE id_user = ?";
    $stmt = $conn->prepare($queryMahasiswa);
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();
    $nim_mhs = $result->fetch_assoc()['nim_mhs'];

    // Hapus file dari direktori Uploads/
    if (file_exists($file_path)) {
        unlink($file_path);
    }

    // Hapus record dari tabel penilaian_tugas
    $queryDelete = "DELETE FROM penilaian_tugas WHERE id_tugas = ? AND nim_mhs = ?";
    $stmt = $conn->prepare($queryDelete);
    $stmt->bind_param("is", $id_tugas, $nim_mhs);
    if ($stmt->execute()) {
        $_SESSION['message'] = "File berhasil dihapus.";
    } else {
        $_SESSION['message'] = "Terjadi kesalahan saat menghapus file.";
    }
} else {
    $_SESSION['message'] = "Permintaan tidak valid.";
}

// Redirect kembali ke halaman tugas
header("Location: tugas.php");
exit();
?>
