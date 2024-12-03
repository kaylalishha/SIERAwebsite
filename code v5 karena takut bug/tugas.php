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

// Ambil id_user dari sesi
$id_user = $_SESSION['id_user'];

// Cari nim mahasiswa berdasarkan id_user
$queryMahasiswa = "SELECT nim_mhs FROM mahasiswa WHERE id_user = ?";
$stmt = $conn->prepare($queryMahasiswa);
$stmt->bind_param("i", $id_user);
$stmt->execute();
$resultMahasiswa = $stmt->get_result();
$nim_mhs = $resultMahasiswa->fetch_assoc()['nim_mhs'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIERA - Tugas</title>
    <link rel="stylesheet" href="tugas.css">
</head>
<body>
  
    <div class="page-container">
        <div class="content-wrap">
            <!-- Header -->
            <header>
                <nav>
                    <div class="logo">
                        <img src="Assets/patribera-logo.png" alt="Logo">
                    </div>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="pageKelompok.php">Kelompok</a></li>
                        <li><a href="tugas.php">Tugas</a></li>
                    </ul>
                    <div class="profile">
                        <a href="profile.php">
                          <img src="<?php echo $profile_image; ?>" alt="Profile" width="65px" height="65px" style="border-radius: 50%; object-fit: cover;"/>
                        </a>
                    </div>
                </nav>
            </header>
           
            <!-- Container Utama -->
            <div class="container">
                <div class="content">
                    <h1>Daftar Tugas</h1>

                    <!-- Daftar Tugas -->
                    <div id="tugas-content">
                    <?php
                    // Query untuk mengambil data dari katalog_tugas dan penilaian_tugas
                    $query = "
                    SELECT kt.id_tugas, kt.nama_tugas, kt.deskripsi, kt.tanggal_deadline, kt.tipe,
                           pt.file_path
                    FROM katalog_tugas kt
                    LEFT JOIN penilaian_tugas pt ON kt.id_tugas = pt.id_tugas AND pt.nim_mhs = ?
                    ";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("s", $nim_mhs);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    // Modifikasi bagian yang menampilkan data tugas:
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="card">';
                            echo '<div class="card-title">' . htmlspecialchars($row['nama_tugas']) . '</div>';
                            echo '<div class="card-info">';

                            echo '<p>' . htmlspecialchars($row['deskripsi']) . '</p>';
                            echo '<span><img src="Assets/date.png" alt="Calendar Icon" class="icon" width=25 height=auto> Deadline: ' . htmlspecialchars($row['tanggal_deadline']) . '</span>';
                            echo '<span><img src="Assets/type.png" alt="Calendar Icon" class="icon" width=25 height=auto> Tipe File: ' . htmlspecialchars($row['tipe']) . '</span>';
                            echo '</div>';

                            // Jika file_path tersedia, tampilkan sebagai tautan dan tombol hapus
                            if (!empty($row['file_path'])) {
                                echo '<a href="Uploads/' . htmlspecialchars($row['file_path']) . '" class="upload-link" target="_blank">Lihat File</a>';
                                echo '<form action="delete_tugas.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="id_tugas" value="' . htmlspecialchars($row['id_tugas']) . '">
                                        <input type="hidden" name="file_path" value="' . htmlspecialchars($row['file_path']) . '">
                                        <button type="submit" class="delete-button" onclick="return confirm(\'Apakah Anda yakin ingin menghapus file ini?\')">Hapus File</button>
                                    </form>';
                            } else {
                                // Jika file belum diunggah, tampilkan tombol upload
                                echo '<button class="upload-button" onclick="openUploadPopup(' . $row['id_tugas'] . ')">Upload File</button>';
                            }
                            echo '</div>';
                        }
                    }
                    ?>
                    </div>

                    <!-- Popup untuk Upload File -->
                    <div id="upload-popup" class="popup" style="display:none;">
                        <div class="popup-content">
                            <h2>Unggah File Tugas</h2>
                            <form id="upload-form" action="upload.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id_tugas" id="id_tugas">
                                <label for="file">Pilih File:</label>
                                <input type="file" name="file" required>
                                <button type="submit">Upload</button>
                                <button type="button" onclick="closeUploadPopup()">Batal</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
 
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
