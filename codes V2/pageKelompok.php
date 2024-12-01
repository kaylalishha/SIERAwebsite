<?php
// Ambil data dari file JSON
$jsonData = file_get_contents('kelompok.json');
$kelompokData = json_decode($jsonData, true);
$namaMentor = $kelompokData['nama_mentor'];
$temanKelompok = $kelompokData['anggota'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Daftar Teman Kelompok</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }
        h1 {
            color: #333;
            margin-bottom: 30px;
        }
        .container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }
        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 
                4px 4px 6px rgba(0, 128, 0, 0.3), /* Shadow kanan bawah berwarna hijau */
                -4px 4px 6px rgba(0, 128, 0, 0.3), /* Shadow kiri bawah berwarna hijau */
                0 4px 6px rgba(0, 128, 0, 0.3); /* Shadow bawah berwarna hijau */
            padding: 15px;
            text-align: center;
            width: 250px;
            transition: transform 0.3s ease;
            cursor: pointer;
        }        
        .card:hover {
            transform: scale(1.05);
        }
        .card p {
            margin: 10px 0;
        }
        .card p:first-child {
            font-weight: bold;
            font-size: 1.2em; /* Ukuran font nama diperbesar */
        }

        /* Pop-up Styles */
        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.7); /* Warna latar belakang lebih gelap */
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        .popup-card {
            position: relative;
            background-color: #ffffff;
            border-radius: 10px;
            padding: 30px; /* Padding diperbesar */
            width: 500px; /* Lebar popup diperbesar */
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2); /* Bayangan lebih tebal */
            display: flex;
            align-items: center;
        }
        .popup-card img {
            width: 150px; /* Ukuran gambar diperbesar */
            height: 225px; /* Ukuran gambar diperbesar */
            border-radius: 10px;
            margin-right: 20px;
        }
        .popup-card .info {
            display: flex;
            flex-direction: column;
        }
        .popup-card .info h2 {
            margin: 0;
            font-size: 24px; /* Ukuran font nama diperbesar */
            font-weight: bold;
        }
        .popup-card .info p {
            margin: 5px 0;
            font-size: 16px; /* Ukuran font detail diperbesar */
        }
        .popup-card .info p span {
            font-weight: normal;
        }
        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px; /* Ukuran font close button diperbesar */
            font-weight: bold;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Daftar Teman Kelompok</h1>
    <h2>Mentor: <?php echo htmlspecialchars($namaMentor); ?></h2>
    
    <div class="container">
        <?php
        foreach ($temanKelompok as $teman) {
            echo "<div class='card' onclick='showPopup(`" . 
                htmlspecialchars($teman['nama']) . "`, `" . 
                htmlspecialchars($teman['nim']) . "`, `" . 
                htmlspecialchars($teman['foto']) . "`, `" . 
                htmlspecialchars($teman['fakultas']) . "`, `" . 
                htmlspecialchars($teman['jurusan']) . "`, `" . 
                htmlspecialchars($teman['nomor_hp']) . "`, `" . 
                htmlspecialchars($teman['instagram']) . "`, `" . 
                htmlspecialchars($teman['id_line']) . "`, `" . 
                htmlspecialchars($namaMentor) . "`)'>";
            echo "<p>" . htmlspecialchars($teman['nama']) . "</p>";
            echo "<p>" . htmlspecialchars($teman['nim']) . "</p>";
            echo "</div>";
        }
        ?>
    </div>

    <!-- Pop-up Container -->
    <div id="popup" ```php
    class="popup">
        <div class="popup-card">
            <div class="close-btn" onclick="closePopup()">&times;</div>
            <img id="popup-foto" alt="Profile picture" height="225" width="150"/>
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
            // Periksa apakah yang diklik adalah area popup (bukan popup-card)
            if (event.target === this) {
                closePopup();
            }
        });

    </script>
</body>
</html>