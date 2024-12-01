<?php
session_start();

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbase_siera";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mendapatkan id_user dan role dari session
$id_user = $_SESSION['id_user'] ?? null;
$role = $_SESSION['role'] ?? null;

$profile_image = 'Assets/default.png'; // Default profile image

// Cek apakah user sudah login dan memiliki id_user serta role
if ($id_user && $role) {
    if ($role == 'mahasiswa') {
        // Ambil data dari tabel mahasiswa
        $query = "SELECT profile_mhs AS profile FROM mahasiswa WHERE id_user = $id_user";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $profile_image = !empty($row['profile']) ? "Assets/profile_mhs/" . $row['profile'] : $profile_image;
        }
    } elseif ($role == 'mentor') {
        // Ambil data dari tabel mentor
        $query = "SELECT profile_mtr AS profile FROM mentor WHERE id_user = $id_user";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $profile_image = !empty($row['profile']) ? "Assets/profile_mtr/" . $row['profile'] : $profile_image;
        }
    }
}

$conn->close();
?>