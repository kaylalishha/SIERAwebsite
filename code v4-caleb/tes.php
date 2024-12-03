<?php
session_start();
include 'connectdb.php';
include 'profileAdd.php';
// Pastikan pengguna sudah login
if (!isset($_SESSION['id_user'])) {
    header('Location: login.php');
    exit();
}

$id_user = $_SESSION['id_user'];

// Ambil data kelompok berdasarkan id_user yang login
$query_kelompok = "SELECT kelompok FROM mahasiswa WHERE id_user = ?";
$stmt_kelompok = $conn->prepare($query_kelompok);
$stmt_kelompok->bind_param("i", $id_user);
$stmt_kelompok->execute();
$stmt_kelompok->bind_result($kelompok);
$stmt_kelompok->fetch();
$stmt_kelompok->close();

// Ambil data mentor berdasarkan kelompok
$query_mentor = "SELECT nama, nim_mentor, fakultas, jurusan, id_line, no_telp, instagram, profile_mtr 
                 FROM mentor WHERE kelompok = ?";
$stmt_mentor = $conn->prepare($query_mentor);
$stmt_mentor->bind_param("i", $kelompok);
$stmt_mentor->execute();
$stmt_mentor->bind_result($namaMentor, $nimMentor, $fakultasMentor, $jurusanMentor, $idLineMentor, $noTelpMentor, $instagramMentor, $fotoMentor);
$stmt_mentor->fetch();
$stmt_mentor->close();

// Ambil data anggota kelompok berdasarkan kelompok
$query_mahasiswa = "SELECT nama, nim_mhs, fakultas, jurusan, no_telp, instagram, id_line, profile_mhs 
                    FROM mahasiswa WHERE kelompok = ?";
$stmt_mahasiswa = $conn->prepare($query_mahasiswa);
$stmt_mahasiswa->bind_param("i", $kelompok);
$stmt_mahasiswa->execute();
$result_mahasiswa = $stmt_mahasiswa->get_result();
$temanKelompok = [];
while ($row = $result_mahasiswa->fetch_assoc()) {
    $temanKelompok[] = $row;
}
$stmt_mahasiswa->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Kelompok</title>
    <link rel="stylesheet" href="tes.css">
</head>
<body>
    <div class='page-container'>
        <header>
            <nav>
                <div class="logo">
                    <img src="Assets/patribera-logo.png" alt="Logo" />
                </div>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#">Kelompok</a></li>
                    <li><a href="tugas.php">Tugas</a></li>
                </ul>
                <div class="profile">
                    <a href="profile.php"><img src="<?php echo $profile_image; ?>" alt="Profile" width="65" height="65" style="border-radius: 50%;">
                </a>
                </div>
            </nav>
        </header>
        
        <h1>Mentor</h1>
        <footer>
      <div class="footer-content">
        <div class="footer-logo">
          <img src="Assets/patribera-logo.png" alt="Logo" />
          <div class="footer-info">
            <h1>SIERA</h1>
            <p>Sistem Informasi PATRIBERA</p>
          </div>
        </div>
        <div class="footer-links">
          <div class="footer-pages">
            <h3>Pages</h3>
            <ul>
              <li>Home</li>
              <li>Kelompok</li>
              <li>Tugas</li>
              <li>Profile</li>
            </ul>
          </div>
          <div class="footer-contact">
            <h3>Contact Us</h3>
            <ul>
              <li>
                <img src="Assets/call.png" alt="Phone" /> 081234567899 (chat only)
              </li>
              <li>
                <img src="Assets/mesages.png" alt="Email" />
                PATRIBERAUPNVJ@gmail.com
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <p>
          Copyright © Kelompok 7. Made at FIK UPNVJ for Praktikum Pemrograman
          Web
        </p>
      </div>
    </footer>
    </div>

    <script>
        function openUploadPopup(idTugas) {
            document.getElementById('upload-popup').style.display = 'block';
            document.getElementById('id_tugas').value = idTugas;
        }

        function closeUploadPopup() {
            document.getElementById('upload-popup').style.display = 'none';
        }
    </script>
</body>
</html>
