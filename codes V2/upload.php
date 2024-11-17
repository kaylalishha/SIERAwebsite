<?php
include 'db.php'; // Koneksi ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $id_tugas = $_POST['id_tugas'];
    $file = $_FILES['file'];
    
    // Proses upload file
    $targetDir = "uploads/";
    $fileName = basename($file["name"]);
    $targetFile = $targetDir . $fileName;
    
    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        // Simpan informasi file ke database
        $query = "INSERT INTO tugas_pengumpulan (id_tugas, file_path) VALUES ('$id_tugas', '$targetFile')";
        if ($conn->query($query)) {
            echo "File berhasil diupload!";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Error uploading file.";
    }
}
?>
