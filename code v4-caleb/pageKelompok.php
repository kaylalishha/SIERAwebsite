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
    <link rel="stylesheet" href="page_kelompok.css">
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
                    <a href="profile.php"><img src="<?php echo $profile_image; ?>" alt="Profile" width="65" height="65" style="border-radius: 50%;"></a>
                </div>
            </nav>
        </header>
        
        <h1 class="section-title">Mentor</h1>
        
        <div class="mentor-section">
            <div class="mentor-card">
                <img src="Assets/profile_mhs/<?php echo htmlspecialchars($fotoMentor); ?>" alt="Foto Mentor" />
                <div class="mentor-info">
                    <h2><?php echo htmlspecialchars($namaMentor); ?></h2>
                    <p><strong>NIM:</strong> <?php echo htmlspecialchars($nimMentor); ?></p>
                    <p><strong>Fakultas:</strong> <?php echo htmlspecialchars($fakultasMentor); ?></p>
                    <p><strong>Jurusan:</strong> <?php echo htmlspecialchars($jurusanMentor); ?></p>
                    <p><strong>No. Telepon:</strong> <?php echo htmlspecialchars($noTelpMentor); ?></p>
                    <p><strong>Instagram:</strong> <?php echo htmlspecialchars($instagramMentor); ?></p>
                    <p><strong>ID Line:</strong> <?php echo htmlspecialchars($idLineMentor); ?></p>
                </div>
            </div>
        </div>
        
        <h1 class="section-title">Anggota Kelompok</h1>
        
        <div class="member-section">
            <?php foreach ($temanKelompok as $teman): ?>
                <div class="member-card-wrapper">
                    <div class="card" onclick="showPopup(
                        '<?php echo htmlspecialchars($teman['nama']); ?>', 
                        '<?php echo htmlspecialchars($teman['nim_mhs']); ?>', 
                        'Assets/profile_mhs/<?php echo htmlspecialchars($teman['profile_mhs']); ?>', 
                        '<?php echo htmlspecialchars($teman['fakultas']); ?>', 
                        '<?php echo htmlspecialchars($teman['jurusan']); ?>', 
                        '<?php echo htmlspecialchars($teman['no_telp']); ?>', 
                        '<?php echo htmlspecialchars($teman['instagram']); ?>', 
                        '<?php echo htmlspecialchars($teman['id_line']); ?>'
                    )">
                        <img src="Assets/profile_mhs/<?php echo htmlspecialchars($teman['profile_mhs']); ?>" alt="Foto Mahasiswa" width="100" />
                        <p><strong><?php echo htmlspecialchars($teman['nama']); ?></strong></p>
                        <p><?php echo htmlspecialchars($teman['nim_mhs']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- Pop-up Container -->
        <div id="popup" class="popup" style="display: none;">
            <div class="popup-card">
                <div class="close-btn" onclick="closePopup()">&times;</div>
                <img id="popup-foto" alt="Profile picture" />
                <div class="info">
                    <h2 id="popup-nama"></h2>
                    <p><span>NIM</span>: <span id="popup-nim"></span></p>
                    <p><span>Fakultas</span>: <span id="popup-fakultas"></span></p>
                    <p><span>Jurusan</span>: <span id="popup-jurusan"></span></p>
                    <p><span>No. HP</span>: <span id="popup-hp"></span></p>
                    <p><span>Instagram</span>: <span id="popup-instagram"></span></p>
                    <p><span>ID Line</span>: <span id="popup-line"></span></p>
                </div>
            </div>
        </div>

        
        <footer>
      <div class="footer-content">
        <div class="footer-logo">
          <img src="Assets/patribera-logo.png" alt="Logo" />
          <div class="footer-info">
          <h1 class="siera-title">SIERA</h1>
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
        function showPopup(nama, nim, foto, fakultas, jurusan, hp, instagram, line) {
            document.getElementById('popup-foto').src = foto;
            document.getElementById('popup-nama').textContent = nama;
            document.getElementById('popup-nim').textContent = nim;
            document.getElementById('popup-fakultas').textContent = fakultas;
            document.getElementById('popup-jurusan').textContent = jurusan;
            document.getElementById('popup-hp').textContent = hp;
            document.getElementById('popup-instagram').textContent = instagram;
            document.getElementById('popup-line').textContent = line;

            document.getElementById('popup').style.display = 'flex';
        }

        function closePopup() {
            document.getElementById('popup').style.display = 'none';
        }

        document.getElementById('popup').addEventListener('click', function(event) {
            if (event.target === this) {
                closePopup();
            }
        });
    </script>
</body>
</html>