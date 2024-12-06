<?php
session_start();
include 'config.php';

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Check if kegiatan is selected
if (!isset($_GET['kegiatan'])) {
    header("Location: pendaftaran_kegiatan.php");
    exit();
}

$kegiatan = urldecode($_GET['kegiatan']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Pendaftaran</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
    <?php include 'header_user.php'; ?>

    <div class="container mt-5">
        <h2 class="mb-4">Pendaftaran <?php echo htmlspecialchars($kegiatan); ?></h2>
        <form action="proses_daftar.php" method="POST">
            <input type="hidden" name="kegiatan" value="<?php echo htmlspecialchars($kegiatan); ?>">
            
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            
            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" class="form-control" id="nim" name="nim" required>
            </div>
            
            <div class="form-group">
                <label for="prodi">Program Studi</label>
                <input type="text" class="form-control" id="prodi" name="prodi" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Daftar Sekarang</button>
        </form>
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>