<?php
include 'connectdb.php';
include 'profileAdd.php';

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'mentor') {
    header("Location: login.php");
    exit();
}

// Ambil id_user dan nim_mentor dari session
$id_user = $_SESSION['id_user'];
$nim_mentor = $_SESSION['nim_mentor'];

$mentor_query = "SELECT nama FROM mentor WHERE nim_mentor = '$nim_mentor'";
$mentor_result = $conn->query($mentor_query);

if ($mentor_result->num_rows > 0) {
    $mentor_data = $mentor_result->fetch_assoc();
    $nama_mentor = $mentor_data['nama'];
}

// Ambil data mentor berdasarkan id_user dari sesi
$query = "SELECT * FROM mentor WHERE id_user = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $mentor = $result->fetch_assoc();
} else {
    echo "Data tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIERA - Dashboard Mentor</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        .main-content {
            background-color: #72BF78; /* Mengubah background main content menjadi hijau muda */
        }
        label {
    font-weight: bold;
    margin-bottom: 5px;
}

input,
textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 14px;
}

textarea {
    resize: none;
    height: 100px;
}

button {
    display: block;
    width: 100%;
    padding: 10px;
    margin-top: 20px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
}

button:disabled {
    background-color: #ccc;
    cursor: not-allowed;
}

#edit-button {
    background-color: #007bff;
    color: #fff;
}
        /* Overlay background */
.overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

/* Konten overlay */
.overlay-content {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 8px;
    width: 90%;
    max-width: 400px;
    text-align: center;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.25);
}

/* Tombol di overlay */
.save-photo-button,
.cancel-photo-button {
    margin: 10px;
    padding: 10px 20px;
    font-size: 14px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.save-photo-button {
    background-color: #007bff;
    color: white;
}

.cancel-photo-button {
    background-color: #e74c3c;
    color: white;
}
.button-width {
        width: 200px; /* Atur lebar sesuai kebutuhan */
    }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-80 bg-white shadow-lg p-6">
            <!-- Logo -->
            <div class="mb-6">
                <img src="Assets/patribera-logo.png" alt="SIERA Logo" class="w-32 mx-auto mb-4">
                <div class="text-3xl font-bold text-green-600 text-center">S I E R A</div>
            </div>

            <!-- Profile Card -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-6 border">
                <div class="flex items-center space-x-4">
                    <img src="<?php echo $profile_image; ?>" alt="Profile" class="rounded-full w-14 h-14">
                    <div>
                        <div class="font-medium text-lg"><?php echo $nama_mentor; ?></div>
                        <div class="font-medium text-lg"><?php echo $nim_mentor; ?></div>
                    </div>
                </div>
            </div>

            <!-- Navigation Card -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden border">
                <nav class="flex flex-col">
                    <a href="mentor_dashboard.php" class="nav-item flex items-center px-6 py-4 text-gray-600 text-lg border-b">
                        Dashboard
                    </a>
                </nav>
            </div>
        </div>
        <!-- Main Content -->
<div class="flex-grow main-content p-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-white">Profil mentor</h1>
    </div>

    <!-- Profile Container -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <!-- Foto Profil -->
        <div class="profile-container">
            <div class="profile-picture flex flex-col items-center mb-6">
            <img src="Assets/profile_mtr/<?php echo htmlspecialchars($mentor['profile_mtr']); ?>" alt="Foto Profil" class="w-32 h-32 rounded-full object-cover border">
                <button type="button" onclick="openEditPhotoModal()" class="edit-photo-button mt-4 bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-600 button-width" id='edit-photo-button'>Edit Foto Profil</button>
                
                <form action="hapus_foto_mentor.php" method="POST" class="mt-2">
                    <button type="submit" name="hapus_foto" class="btn btn-danger bg-red-500 text-white px-4 py-2 rounded shadow hover:bg-red-600 button-width">Hapus Foto Profil</button>
                </form>
            </div>

            <!-- Form Profil -->
            <form id="profile-form" action="edit_profile_mentor.php" method="POST" enctype="multipart/form-data">
                <div class="profile-fields grid grid-cols-1 gap-4">
                    <div>
                        <label for="nama">Nama:</label>
                        <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($mentor['nama']); ?>" required class="form-input">
                    </div>

                    <div>
                        <label for="nim_mentor">NIM:</label>
                        <input type="text" id="nim_mentor" name="nim_mentor" value="<?php echo htmlspecialchars($mentor['nim_mentor']); ?>" readonly class="form-input">
                    </div>

                    <div>
                        <label for="fakultas">Fakultas:</label>
                        <input type="text" id="fakultas" name="fakultas" value="<?php echo htmlspecialchars($mentor['fakultas']); ?>" readonly class="form-input">
                    </div>

                    <div>
                        <label for="jurusan">Jurusan:</label>
                        <input type="text" id="jurusan" name="jurusan" value="<?php echo htmlspecialchars($mentor['jurusan']); ?>" readonly class="form-input">
                    </div>

                    <div>
                        <label for="no_telp">No. Telepon:</label>
                        <input type="text" id="no_telp" name="no_telp" value="<?php echo htmlspecialchars($mentor['no_telp']); ?>" class="form-input">
                    </div>

                    <div>
                        <label for="instagram">Instagram:</label>
                        <input type="text" id="instagram" name="instagram" value="<?php echo htmlspecialchars($mentor['instagram']); ?>" class="form-input">
                    </div>

                    <div>
                        <label for="id_line">ID Line:</label>
                        <input type="text" id="id_line" name="id_line" value="<?php echo htmlspecialchars($mentor['id_line']); ?>" class="form-input">
                    </div>
                </div>

                <!-- Tombol Edit Profile -->
                <div class="mt-6">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded shadow hover:bg-green-600">Edit Profile</button>
                </div>
            </form>
            <!-- Tombol Logout -->
            <div class="mt-6">
            <button onclick="window.location.href='logout.php'" class="bg-red-500 text-white px-4 py-2 rounded shadow hover:bg-red-600">Logout</button>
            </div>
        </div>
    </div>
</div>
<div id="upload-overlay" class="overlay">
    <div class="overlay-content">
        <h2>Upload Foto Profil</h2>
        <form id="upload-form" action="edit_foto_mentor.php" method="POST" enctype="multipart/form-data">
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