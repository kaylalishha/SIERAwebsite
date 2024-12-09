<?php
session_start();
include 'connectdb.php';
include 'profileAdd.php';

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'mahasiswa') {
    header("Location: login.php");
    exit();
}

// Ambil data mahasiswa berdasarkan id_user dari sesi
$id_user = $_SESSION['id_user'];
$query = "SELECT * FROM mahasiswa WHERE id_user = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $mahasiswa = $result->fetch_assoc();
} else {
    echo "Data tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya</title>
    <link rel="stylesheet" href="style_profile.css">
</head>

<body>
<header>
      <nav>
        <div class="logo">
          <img src="Assets/patribera-logo.png" alt="Logo" />
        </div>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="pageKelompok.php">Kelompok</a></li>
          <li><a href="tugas.php">Tugas</a></li>
        </ul>
        <div class="profile">
          <a href="profile.php"><img src="<?php echo $profile_image; ?>" alt="Profile" width="65" height="65" style="border-radius: 50%; object-fit: cover;">
        </a>
        </div>
      </nav>
    </header>
    <div class="profile-container">
        <!-- Foto Profil -->
        <div class="profile-picture">
            <img src="Assets/profile_mhs/<?php echo htmlspecialchars($mahasiswa['profile_mhs']); ?>" id="profile-preview">
            <div class="pic-button" style="display: flex; justify-content: center;">
                <button type="button" class="edit-photo-button" id="edit-photo-button">Edit Foto Profil</button>
            </div>
            <div class="pic-button" style="display: flex; justify-content: center;">
                <!-- Tombol Hapus Foto Profil -->
                <form action="hapus_foto.php" method="POST">
                    <button type="submit" name="hapus_foto" class="delete-photo-button">Hapus Foto Profil</button>
                </form>
            </div>
        </div>

        <!-- Form Profil -->
        <form id="profile-form" action="edit_profile.php" method="POST" enctype="multipart/form-data">
            <div class="profile-fields">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($mahasiswa['nama']); ?>" required>

                <label for="nim_mhs">NIM:</label>
                <input type="text" id="nim_mhs" name="nim_mhs" value="<?php echo htmlspecialchars($mahasiswa['nim_mhs']); ?>" readonly>

                <label for="domisili">Domisili:</label>
                <input type="text" id="domisili" name="domisili" value="<?php echo htmlspecialchars($mahasiswa['domisili']); ?>">

                <label for="tanggal_lahir">Tanggal Lahir:</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo htmlspecialchars($mahasiswa['tanggal_lahir']); ?>">

                <label for="fakultas">Fakultas:</label>
                <input type="disable" id="fakultas" name="fakultas" value="<?php echo htmlspecialchars($mahasiswa['fakultas']); ?>" readonly>

                <label for="jurusan">Jurusan:</label>
                <input type="disable" id="jurusan" name="jurusan" value="<?php echo htmlspecialchars($mahasiswa['jurusan']); ?>" readonly>

                <label for="no_telp">No. Telepon:</label>
                <input type="text" id="no_telp" name="no_telp" value="<?php echo htmlspecialchars($mahasiswa['no_telp']); ?>">

                <label for="instagram">Instagram:</label>
                <input type="text" id="instagram" name="instagram" value="<?php echo htmlspecialchars($mahasiswa['instagram']); ?>">

                <label for="id_line">ID Line:</label>
                <input type="text" id="id_line" name="id_line" value="<?php echo htmlspecialchars($mahasiswa['id_line']); ?>">

                <label for="bio">Bio:</label>
                <textarea id="bio" name="bio"><?php echo htmlspecialchars($mahasiswa['bio']); ?></textarea>
            </div>

            <!-- Tombol Edit Profile -->
            <button type="submit" id="edit-button" disabled>Edit Profile</button>
        </form>

        <!-- Tombol Logout -->
        <form action="logout.php" method="POST">
            <button type="submit" class="logout-button">Logout</button>
        </form>
    </div>

    <div id="upload-overlay" class="overlay">
    <div class="overlay-content">
        <h2>Upload Foto Profil</h2>
        <form id="upload-form" action="edit_foto.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="profile_picture" id="profile_picture" accept="image/*" required>
            <button type="submit" class="save-photo-button">Simpan</button>
            <button type="button" class="cancel-photo-button" id="cancel-photo-button">Batal</button>
        </form>
    </div>
</div>


    <script>
        // Aktifkan tombol edit hanya jika ada perubahan di form
        const form = document.getElementById('profile-form');
        const editButton = document.getElementById('edit-button');

        form.addEventListener('input', () => {
            editButton.disabled = false;
        });
    const editPhotoButton = document.getElementById('edit-photo-button');
    const uploadOverlay = document.getElementById('upload-overlay');
    const cancelPhotoButton = document.getElementById('cancel-photo-button');

    // Tampilkan overlay
    editPhotoButton.addEventListener('click', () => {
        uploadOverlay.style.display = 'flex';
    });

    // Sembunyikan overlay
    cancelPhotoButton.addEventListener('click', () => {
        uploadOverlay.style.display = 'none';
    });

    // Sembunyikan overlay saat klik di luar area konten
    uploadOverlay.addEventListener('click', (event) => {
        if (event.target === uploadOverlay) {
            uploadOverlay.style.display = 'none';
        }
    });
    </script>
</body>

</html>
