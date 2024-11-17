<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbase_siera";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim_mhs = $_POST['nim_mhs'];
    $id_tugas = $_POST['id_tugas'];
    $nilai = $_POST['nilai'];
    $komentar = $_POST['komentar'];

    // Validasi input
    if (empty($nim_mhs) || empty($id_tugas)) {
        echo "Data NIM atau ID Tugas tidak valid!";
        exit;
    }

    // Update hanya nilai dan komentar di tabel penilaian_tugas
    $sql = "UPDATE penilaian_tugas SET nilai = ?, komentar = ? WHERE nim_mhs = ? AND id_tugas = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("dssi", $nilai, $komentar, $nim_mhs, $id_tugas);

    if ($stmt->execute()) {
        // Redirect ke mentor_dashboard.php dengan pesan sukses
        header("Location: mentor_dashboard.php?update=success");
        exit();
    } else {
        // Redirect ke mentor_dashboard.php dengan pesan error
        header("Location: mentor_dashboard.php?update=failed");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
