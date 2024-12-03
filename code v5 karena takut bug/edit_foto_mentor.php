<?php 
    include 'connectdb.php';
    session_start();

    $upload_dir = __DIR__ . '/Assets/profile_mtr/';

if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $fileType = $_FILES['profile_picture']['type'];
    $fileSize = $_FILES['profile_picture']['size'];

    // Ambil nama file lama
    $query = "SELECT profile_mtr FROM mentor WHERE id_user = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $_SESSION['id_user']);
    $stmt->execute();
    $result = $stmt->get_result();
    $mentor = $result->fetch_assoc();

    $oldFilePath = $upload_dir . $mentor['profile_mtr'];

    // Hapus file lama jika bukan file default
    if ($mentor['profile_mtr'] !== 'default.png' && file_exists($oldFilePath)) {
        unlink($oldFilePath);
    }
    

    if (in_array($fileType, $allowedTypes) && $fileSize <= 2000000) { // Maksimal 2MB
        $fileTmpPath = $_FILES['profile_picture']['tmp_name'];
        $fileName = $_FILES['profile_picture']['name'];

        // Buat nama unik untuk file
        $newFileName = uniqid() . '-' . $fileName;

        // Pindahkan file ke folder tujuan
        $destPath = $upload_dir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $destPath)) {
            // Update nama file di database
            $query = "UPDATE mentor SET profile_mtr = ? WHERE id_user = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("si", $newFileName, $_SESSION['id_user']);
            $stmt->execute();
        } else {
            echo "Gagal mengunggah file.";
        }
    } else {
        echo "File harus berupa gambar (JPEG, PNG, GIF) dan maksimal 2MB.";
 
   }
}
header("Location: mentor_profile.php");
?>