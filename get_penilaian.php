<?php
session_start();

$nim_mentor = $_SESSION['nim_mentor'];
$id_tugas = $_GET['id_tugas'];

include 'connectdb.php';

$penilaian_query = "SELECT * FROM penilaian_tugas WHERE id_tugas = '$id_tugas' AND nim_mentor = '$nim_mentor'";
$penilaian_result = $conn->query($penilaian_query);

$result = [];
if ($penilaian_result->num_rows > 0) {
    while ($row = $penilaian_result->fetch_assoc()) {
        $result[] = $row;
    }
}

echo json_encode($result);

$conn->close();
?>
