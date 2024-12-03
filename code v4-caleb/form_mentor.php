<?php
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'mentor') {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Data Mentor</title>
    <link rel="stylesheet" href="mentor.css">
    <style>
        body {
            zoom: 0.8; /* Untuk Chrome */
        }
    </style>
</head>
<body>
    <!-- Navbar with logo -->
    <div class="navbar">
        <img src="Assets/patribera-logo.png" alt="Logo" class="logo">
    </div>

    <!-- Main content (Form data mentor) -->
    <div class="mentor-container">
    <?php
// Define the faculties and their corresponding majors
$faculties = [
    "Ekonomi dan Bisnis" => [
        "Perbankan dan Keuangan - D3",
        "Akuntansi - D3",
        "Manajemen - S1",
        "Akuntansi - S1",
        "Ekonomi Pembangunan - S1",
        "Ekonomi Syariah - S1"
    ],
    "Kedokteran" => [
        "Kedokteran - S1",
        "Farmasi - S1"
    ],
    "Teknik" => [
        "Teknik Mesin - S1",
        "Teknik Industri - S1",
        "Teknik Perkapalan - S1",
        "Teknik Elektro - S1"
    ],
    "Ilmu Sosial dan Ilmu Politik" => [
        "Ilmu Komunikasi - S1",
        "Hubungan Internasional - S1",
        "Ilmu Politik - S1",
        "Sains Informasi - S1"
    ],
    "Ilmu Komputer" => [
        "Sistem Informasi - D3",
        "Informatika - S1",
        "Sistem Informasi - S1"
    ],
    "Hukum" => [
        "Hukum - S1"
    ],
    "Ilmu Kesehatan" => [
        "Keperawatan - D3",
        "Fisioterapi - D3",
        "Keperawatan - S1",
        "Kesehatan Masyarakat - S1",
        "Gizi - S1",
        "Fisioterapi - S1"
    ]
];
?>
        <h2>Isi Data <span class="highlight">Mentor</span></h2>
        <form id="mentor-form" method="post" action="save_mentor.php">
            
            <input type="text" id="nama" name="nama" placeholder="Nama Mentor" required>
            
            <select id="fakultas" name="fakultas" required onchange="populateJurusan()">
                <option value="" disabled selected>Pilih Fakultas</option>
                <?php foreach (array_keys($faculties) as $faculty): ?>
                    <option value="<?= htmlspecialchars($faculty) ?>"><?= htmlspecialchars($faculty) ?></option>
                <?php endforeach; ?>
            </select>

            <select id="jurusan" name="jurusan" required>
                <option value="" disabled selected>Pilih Jurusan</option>
            </select>

            <input type="text" id="no_telp" name="no_telp" placeholder="No Telepon">

            <input type="text" id="instagram" name="instagram" placeholder="Instagram">

            <input type="text" id="id_line" name="id_line" placeholder="ID Line">

            <button class="mentor-btn" type="submit">Simpan Data</button>
        </form>
    </div>

    <!-- Footer (sama seperti sebelumnya) -->

    <footer>
        <div class="footer-content">
            <div class="footer-logo">
                <img src="Assets/patribera-logo.png" alt="Logo">
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
                        <li>Cari Pengguna</li>
                        <li>Tugas</li>
                        <li>Profile</li>
                    </ul>
                </div>
                <div class="footer-contact">
                    <h3>Contact Us</h3>
                    <ul>
                        <li><img src="Assets/call.png" alt="Phone"> 081234567899 (chat only)</li>
                        <li><img src="Assets/mesages.png" alt="Email"> PATRIBERAUPNVJ@gmail.com</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>Copyright © Kelompok 7. Made at FIK UPNVJ for Praktikum Pemrograman Web</p>
        </div>
    </footer>

    <script>
    const faculties = <?= json_encode($faculties) ?>;

    function populateJurusan() {
        const fakultasSelect = document.getElementById('fakultas');
        const jurusanSelect = document.getElementById('jurusan');
        
        // Clear existing options
        jurusanSelect.innerHTML = '<option value="" disabled selected>Pilih Jurusan</option>';
        
        const selectedFaculty = fakultasSelect.value;
        
        if (selectedFaculty && faculties[selectedFaculty]) {
            faculties[selectedFaculty].forEach(jurusan => {
                const option = document.createElement('option');
                option.value = jurusan;
                option.textContent = jurusan;
                jurusanSelect.appendChild(option);
            });
        }
    }
</script>

</body>
</html>

