<?php
session_start();
include 'config.php'; // Pastikan config.php mendefinisikan variabel $conn (koneksi database)

// Tangani aksi terima/tolak
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $action = $_GET['action'];

    // Validasi action untuk mencegah aksi ilegal
    if ($action === 'terima' || $action === 'tolak') {
        // Tentukan status berdasarkan aksi
        $status = ($action == 'terima') ? 'Diterima' : 'Ditolak';

        // Update status pendaftaran
        $stmt = $conn->prepare("UPDATE pendaftaran_kegiatan SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $id);
        if ($stmt->execute()) {
            header("Location: kegiatan_mahasiswa.php?pesan=success");
        } else {
            error_log("Error executing query: " . $stmt->error);
            header("Location: kegiatan_mahasiswa.php?pesan=error");
        }
        $stmt->close();
    } else {
        error_log("Invalid action received: " . $action);
        header("Location: kegiatan_mahasiswa.php?pesan=error");
    }
    exit();
}

// Ambil data pendaftaran kegiatan
$result = $conn->query("SELECT * FROM pendaftaran_kegiatan ORDER BY id DESC");
if (!$result) {
    error_log("Error fetching data: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kegiatan Mahasiswa</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
    <?php include 'header.php'; ?> <!-- Pastikan file header.php tersedia -->

    <div class="container mt-5">
        <h2>Daftar Pendaftaran Kegiatan</h2>
        
        <!-- Pesan Notifikasi -->
        <?php if (isset($_GET['pesan'])): ?>
            <div class="alert alert-<?php echo ($_GET['pesan'] == 'success') ? 'success' : 'danger'; ?>">
                <?php echo ($_GET['pesan'] == 'success') ? 'Aksi berhasil!' : 'Terjadi kesalahan.'; ?>
            </div>
        <?php endif; ?>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Prodi</th>
                    <th>Kegiatan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                        <td><?php echo htmlspecialchars($row['nim']); ?></td>
                        <td><?php echo htmlspecialchars($row['prodi']); ?></td>
                        <td><?php echo htmlspecialchars($row['kegiatan']); ?></td>
                        <td><?php echo htmlspecialchars($row['status']); ?></td>
                        <td>
                            <?php if ($row['status'] == 'Menunggu'): ?>
                                <a href="?action=terima&id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Terima</a>
                                <a href="?action=tolak&id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Tolak</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
