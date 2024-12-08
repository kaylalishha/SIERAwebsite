<?php
session_start();
include 'connectdb.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION['id_user'])) {
    header('Location: login.php');
    exit();
}

$id_user = $_SESSION['id_user'];
// Ambil nama file lama
$query = "SELECT profile_mtr FROM mentor WHERE id_user = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['id_user']);
$stmt->execute();
$result = $stmt->get_result();
$mentor = $result->fetch_assoc();

$upload_dir = __DIR__ . '/Assets/profile_mtr/';
$oldFilePath = $upload_dir . $mentor['profile_mtr'];

// Hapus file lama jika bukan file default
if ($mentor['profile_mtr'] !== 'default.png' && file_exists($oldFilePath)) {
    unlink($oldFilePath);
}

if (isset($_POST['hapus_foto'])) {
    // Path direktori foto profil
    $upload_dir = 'Assets/profile_mtr/';
    $default_image = 'default.png';

    // Update foto profil di database menjadi default
    $query = "UPDATE mentor SET profile_mtr = ? WHERE id_user = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $default_image, $id_user);

    if ($stmt->execute()) {
        // Redirect ke halaman profil setelah berhasil
        header('Location: mentor_profile.php?foto_terhapus=1');
        exit();
    } else {
        echo "Gagal menghapus foto profil.";
    }
}
?>
