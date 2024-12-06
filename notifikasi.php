<?php
session_start();
include 'config.php';

// Mengambil data notifikasi yang belum dibaca
$nim = $_SESSION['nim']; // Asumsikan NIM disimpan di sesi saat login
$result = $conn->prepare("SELECT kegiatan, status FROM pendaftaran_kegiatan WHERE nim = ? AND is_read = 0");
$result->bind_param("s", $nim);
$result->execute();
$data = $result->get_result();

// Tandai semua notifikasi sebagai sudah dibaca jika halaman dibuka
$mark_read = $conn->prepare("UPDATE pendaftaran_kegiatan SET is_read = 1 WHERE nim = ? AND is_read = 0");
$mark_read->bind_param("s", $nim);
$mark_read->execute();
$mark_read->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Notifikasi</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
    <?php include 'header_user.php'; ?> <!-- Header navbar -->

    <div class="container mt-5">
        <h2>Notifikasi Kegiatan</h2>
        <ul class="list-group">
            <?php if ($data->num_rows > 0): ?>
                <?php while ($row = $data->fetch_assoc()): ?>
                    <li class="list-group-item">
                        <?php if ($row['status'] == 'Diterima'): ?>
                            Selamat Anda diterima untuk mengikuti organisasi "<?php echo htmlspecialchars($row['kegiatan']); ?>".
                        <?php else: ?>
                            Anda ditolak untuk mengikuti organisasi "<?php echo htmlspecialchars($row['kegiatan']); ?>".
                        <?php endif; ?>
                    </li>
                <?php endwhile; ?>
            <?php else: ?>
                <li class="list-group-item">Tidak ada notifikasi saat ini.</li>
            <?php endif; ?>
        </ul>
    </div>
</body>
</html>