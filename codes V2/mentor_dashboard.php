<?php

include 'profileAdd.php';
// Cek apakah user sudah login dan role adalah mentor
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'mentor') {
    header("Location: index.php?error=" . urlencode("Anda harus login sebagai mentor!"));
    exit();
}

// Ambil id_user dan nim_mentor dari session
$id_user = $_SESSION['id_user'];
$nim_mentor = $_SESSION['nim_mentor'];

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbase_siera";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data mentor


// Ambil data kelompok mentor
$kelompok = null;
$mentor_query = "SELECT kelompok, nama FROM mentor WHERE nim_mentor = '$nim_mentor'";
$mentor_result = $conn->query($mentor_query);

if ($mentor_result->num_rows > 0) {
    $mentor_data = $mentor_result->fetch_assoc();
    $kelompok = $mentor_data['kelompok'];
    $nama_mentor = $mentor_data['nama'];
}

// Ambil data mahasiswa berdasarkan kelompok yang sama
$mahasiswa_list = [];
if ($kelompok !== null) {
    $mahasiswa_query = "SELECT nama, nim_mhs, jurusan, no_telp, instagram, id_line FROM mahasiswa WHERE kelompok = '$kelompok'";
    $mahasiswa_result = $conn->query($mahasiswa_query);

    if ($mahasiswa_result->num_rows > 0) {
        while ($row = $mahasiswa_result->fetch_assoc()) {
            $mahasiswa_list[] = $row;
        }
    }
}

// Ambil data katalog tugas
$tugas_list = [];
$tugas_query = "SELECT id_tugas, nama_tugas, deskripsi, tanggal_deadline FROM katalog_tugas ORDER BY tanggal_deadline DESC";
$tugas_result = $conn->query($tugas_query);

if ($tugas_result->num_rows > 0) {
    while ($row = $tugas_result->fetch_assoc()) {
        $tugas_list[] = $row;
    }
}

// Fungsi untuk mengambil daftar mahasiswa yang mengumpulkan tugas
function getPenilaianTugas($conn, $id_tugas, $nim_mentor) {
    $penilaian_list = [];
    $penilaian_query = "SELECT nim_mhs, nilai, komentar FROM penilaian_tugas WHERE id_tugas = '$id_tugas' AND nim_mentor = '$nim_mentor'";
    $penilaian_result = $conn->query($penilaian_query);

    if ($penilaian_result->num_rows > 0) {
        while ($row = $penilaian_result->fetch_assoc()) {
            $penilaian_list[] = $row;
        }
    }
    return $penilaian_list;
}

$conn->close();
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
                    <a href="#" class="nav-item flex items-center px-6 py-4 text-gray-600 text-lg border-b" data-page="kelompok">
                        Kelompok
                    </a>
                    <a href="#" class="nav-item flex items-center px-6 py-4 text-gray-600 text-lg" data-page="tugas">
                        Tugas
                    </a>
                </nav>
            </div>
            <br>
            <br>
            <div>
                <a href="logout.php" class="bg-red-500 text-white px-4 py-2 rounded">Logout</a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 main-content p-8">
            <!-- Kelompok Section -->
            <div id="content-kelompok">
                <h1 class="text-3xl font-bold text-white mb-6">Data Kelompok</h1>
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-semibold mb-4">Daftar Anggota Kelompok</h2>
                    
                    <?php if (!empty($mahasiswa_list)): ?>
                        <table class="min-w-full bg-white border rounded-lg shadow">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b">Nama</th>
                                    <th class="py-2 px-4 border-b">NIM</th>
                                    <th class="py-2 px-4 border-b">Program Studi</th>
                                    <th class="py-2 px-4 border-b">No. Telp</th>
                                    <th class="py-2 px-4 border-b">Instagram</th>
                                    <th class="py-2 px-4 border-b">ID Line</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($mahasiswa_list as $mahasiswa): ?>
                                    <tr>
                                        <td class="py-2 px-4 border-b"><?php echo $mahasiswa['nama']; ?></td>
                                        <td class="py-2 px-4 border-b"><?php echo $mahasiswa['nim_mhs']; ?></td>
                                        <td class="py-2 px-4 border-b"><?php echo $mahasiswa['jurusan']; ?></td>
                                        <td class="py-2 px-4 border-b"><?php echo $mahasiswa['no_telp']; ?></td>
                                        <td class="py-2 px-4 border-b"><?php echo $mahasiswa['instagram']; ?></td>
                                        <td class="py-2 px-4 border-b"><?php echo $mahasiswa['id_line']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>Tidak ada anggota kelompok yang terdaftar.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Tugas Section -->
            <div id="content-tugas">
                <h1 class="text-3xl font-bold text-white mb-6">Daftar Tugas</h1>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php if (!empty($tugas_list)): ?>
                        <?php foreach ($tugas_list as $tugas): ?>
                            <div class="bg-white rounded-lg shadow p-6">
                                <h2 class="text-xl font-semibold"><?php echo $tugas['nama_tugas']; ?></h2>
                                <p class="text-gray-600 mt-2"><?php echo $tugas['deskripsi']; ?></p>
                                <p class="text-sm text-red-500 mt-2">Deadline: <?php echo date('d-m-Y', strtotime($tugas['tanggal_deadline'])); ?></p>
                                <button onclick="showDetail(<?php echo $tugas['id_tugas']; ?>)" class="bg-green-600 text-white px-4 py-2 rounded mt-4">
                                    Detail
                                </button>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Tidak ada tugas yang tersedia.</p>
                    <?php endif; ?>
                </div>

                <!-- Modal untuk Detail Penilaian -->
                <div id="detailModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex justify-center items-center z-50">
                <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md">
                    <h3 class="text-2xl font-bold mb-4">Daftar Mahasiswa</h3>
                    <div id="detailContent"></div>
                    <button onclick="closeModal()" class="bg-red-500 text-white px-4 py-2 rounded mt-4">Tutup</button>
                </div>
                <!-- Modal untuk Edit Nilai -->
                <div id="editModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex justify-center items-center z-50">
                    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                        <h3 class="text-2xl font-bold mb-4">Edit Nilai Mahasiswa</h3>
                        <form id="editForm" action="save_nilai.php" method="POST">
                            <div class="mb-4">
                                <label class="block text-gray-700">NIM:</label>
                                <p id="editNimMhs" class="font-semibold"></p>
                                <input type="hidden" name="nim_mhs" id="nimMhsInput">
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700">ID Tugas:</label>
                                <p id="editIdTugas" class="font-semibold"></p>
                                <input type="hidden" name="id_tugas" id="idTugasInput">
                            </div>
                            <div class="mb-4">
                                <label for="editNilai" class="block text-gray-700">Nilai:</label>
                                <input type="number" id="editNilai" name="nilai" class="w-full border rounded px-3 py-2" required min="0" max="100">
                            </div>
                            <div class="mb-4">
                                <label for="editKomentar" class="block text-gray-700">Komentar:</label>
                                <textarea id="editKomentar" name="komentar" class="w-full border rounded px-3 py-2"></textarea>
                            </div>
                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
                            <button type="button" onclick="closeEditModal()" class="bg-red-500 text-white px-4 py-2 rounded ml-2">Batal</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Handle navigation
        const navItems = document.querySelectorAll('.nav-item');
        const contents = document.querySelectorAll('[id^="content-"]');

        // Show Kelompok page by default
        document.querySelector('[data-page="kelompok"]').classList.add('active');
        document.getElementById('content-kelompok').classList.remove('hidden');

        navItems.forEach(item => {
            item.addEventListener('click', (e) => {
                e.preventDefault();

                // Remove active class from all items
                navItems.forEach(nav => nav.classList.remove('active'));

                // Add active class to clicked item
                item.classList.add('active');

                // Hide all contents
                contents.forEach(content => content.classList.add('hidden'));

                // Show selected content
                const page = item.getAttribute('data-page');
                document.getElementById(`content-${page}`).classList.remove('hidden');
            });
        });
        function showDetail(id_tugas) {
            fetch(`get_penilaian.php?id_tugas=${id_tugas}`)
                .then(response => response.json())
                .then(data => {
                    let content = '';
                    if (data.length > 0) {
                        content += '<table class="min-w-full bg-white border rounded-lg">';
                        content += '<thead><tr><th class="py-2 px-4 border">NIM</th><th class="py-2 px-4 border">Nilai</th><th class="py-2 px-4 border">Komentar</th><th class="py-2 px-4 border">Aksi</th></tr></thead><tbody>';
                        data.forEach(item => {
                            content += `<tr>
                            <td class="py-2 px-4 border">${item.nim_mhs}</td>
                            <td class="py-2 px-4 border">${item.nilai ?? '-'}</td>
                            <td class="py-2 px-4 border">${item.komentar ?? '-'}</td>
                            <td class="py-2 px-4 border">
                            <button onclick="showEditModal('${item.nim_mhs}', ${id_tugas}, ${item.nilai ?? ''}, '${item.komentar ?? ''}')" class="bg-blue-500 text-white px-2 py-1 rounded">Edit</button>
                            </td>
                            </tr>`;
                        });
                        content += '</tbody></table>';
                    } else {
                        content = '<p>Belum ada mahasiswa yang mengumpulkan tugas ini.</p>';
                    }
                    document.getElementById('detailContent').innerHTML = content;
                    document.getElementById('detailModal').classList.remove('hidden');
                });
        }
        // Fungsi untuk menampilkan modal edit
        function showEditModal(nim_mhs, id_tugas, nilai, komentar) {
            // Menampilkan NIM dan ID Tugas sebagai teks
            document.getElementById('editNimMhs').textContent = nim_mhs;
            document.getElementById('editIdTugas').textContent = id_tugas;

            // Mengisi input hidden dengan data untuk dikirim ke server
            document.getElementById('nimMhsInput').value = nim_mhs;
            document.getElementById('idTugasInput').value = id_tugas;

            // Mengisi kolom nilai dan komentar yang dapat diedit
            document.getElementById('editNilai').value = nilai || '';
            document.getElementById('editKomentar').value = komentar || '';

            // Menampilkan modal edit
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('detailModal').classList.add('hidden');
        }
    </script>
</body>
</html>
