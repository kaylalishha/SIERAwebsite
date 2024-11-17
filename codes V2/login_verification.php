<?php
session_start();
session_unset();
session_destroy();

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

// Ambil data dari form login
$email = $_POST['email'];
$password = $_POST['password'];

// Query untuk mengecek data login
$sql = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $_SESSION['id_user'] = $user['id_user'];
    $_SESSION['role'] = $user['role'];
    
    // Cek apakah data ada di tabel mahasiswa atau mentor
    if ($user['role'] == 'mahasiswa') {
        $checkMahasiswa = "SELECT * FROM mahasiswa WHERE id_user = " . $user['id_user'];
        $resultMahasiswa = $conn->query($checkMahasiswa);
        
        if ($resultMahasiswa->num_rows > 0) {
            header("Location: index.php");
        } else {
            // Arahkan ke halaman form mahasiswa jika data tidak ditemukan
            header("Location: form_mahasiswa.php");
        }
    } elseif ($user['role'] == 'mentor') {
        $checkMentor = "SELECT * FROM mentor WHERE id_user = " . $user['id_user'];
        $resultMentor = $conn->query($checkMentor);
        
        if ($resultMentor->num_rows > 0) {
            $mentor_data = $resultMentor->fetch_assoc();
            $_SESSION['nim_mentor'] = $mentor_data['nim_mentor'];
            header("Location: mentor_dashboard.php");
        } else {
            // Arahkan ke halaman form mentor jika data tidak ditemukan
            header("Location: form_mentor.php");
        }
    }
} else {
    // Jika email atau password salah, redirect kembali ke login.php dengan pesan kesalahan
    $error_message = "Email atau password salah!";
    header("Location: login.php?error=" . urlencode($error_message));
}

$conn->close();
?>
