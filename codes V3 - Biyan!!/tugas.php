<?php
session_start();

// Koneksi ke database
include 'connectdb.php';

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
                        <li><a href="#">Cari Pengguna</a></li>
                        <li><a href="tugas.php">Tugas</a></li>
                    </ul>
                    <div class="profile">
                        <img src="Assets/Ellipse 30.png" alt="Profile">
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
                        // Query untuk mengambil data dari tabel katalog_tugas
                        $query = "SELECT * FROM katalog_tugas";
                        $result = $conn->query($query);


                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<div class="card">';
                                echo '<div class="card-title">' . htmlspecialchars($row['nama_tugas']) . '</div>';
                                echo '<div class="card-info">';

                                echo '<p>' . htmlspecialchars($row['deskripsi']) . '</p>';
                                echo '<span><img src="Assets/date.png" alt="Calendar Icon" class="icon" width=25 height=auto> Deadline: ' . htmlspecialchars($row['tanggal_deadline']) . '</span>';
                                echo '<span><img src="Assets/type.png" alt="Calendar Icon" class="icon" width=25 height=auto> Tipe File: ' . htmlspecialchars($row['tipe']) . '</span>';
                                echo '</div>';
                                echo '<button class="upload-button" onclick="openUploadPopup(' . $row['id_tugas'] . ')">Upload File</button>';
                                echo '</div>';
                            }
                        } else {
                            echo '<p>Tidak ada tugas yang tersedia.</p>';
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

        <!-- Footer -->
        <footer>
            <div class="footer-content">
                <div class="footer-logo">
                    <img src="Assets/patribera-logo.png" alt="Logo">
                    <div class="footer-info">
                        <h1>SIERA</h1>
                        <p>Sistem Informasi PATRIBERA</p>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>Copyright © Kelompok 7. Made at FIK UPNVJ for Praktikum Pemrograman Web</p>
            </div>
        </footer>
    </div>

    <script>
        function openUploadPopup(idTugas) {
            // Menampilkan popup untuk upload
            document.getElementById('upload-popup').style.display = 'block';
            document.getElementById('id_tugas').value = idTugas;
        }

        function closeUploadPopup() {
            // Menutup popup
            document.getElementById('upload-popup').style.display = 'none';
        }

        // Menangani form upload sukses
        document.getElementById('upload-form').onsubmit = function (e) {
            e.preventDefault();

            var formData = new FormData(this);

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "upload.php", true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    alert(xhr.responseText);
                    closeUploadPopup(); // Tutup popup
                } else {
                    alert("Terjadi kesalahan saat mengunggah file.");
                }
            };
            xhr.send(formData);
        };
    </script>
</body>

</html>
