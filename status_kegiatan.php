<?php
session_start();
include 'config.php';

// Mengambil data kegiatan yang diterima
$nim = $_SESSION['nim']; // Asumsikan NIM disimpan di sesi saat login
$result = $conn->prepare("SELECT kegiatan, status FROM pendaftaran_kegiatan WHERE nim = ? AND status = 'Diterima'");
$result->bind_param("s", $nim);
$result->execute();
$data = $result->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Status Pendaftaran</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
    <?php include 'header_user.php'; ?> <!-- Header navbar -->
    
    <div class="container mt-5">
        <h2>Status Pendaftaran Kegiatan</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Kegiatan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($data->num_rows > 0): ?>
                    <?php while ($row = $data->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['kegiatan']); ?></td>
                            <td>Aktif</td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2">Belum ada kegiatan yang diterima.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
