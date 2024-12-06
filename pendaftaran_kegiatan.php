<?php
session_start();
include 'config.php'; // Assuming you have a database connection file

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pendaftaran Kegiatan</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
    <?php include 'header_user.php'; ?>

    <div class="container mt-5">
        <h2 class="mb-4">Pendaftaran Kegiatan</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Kegiatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $kegiatan = [
                    'Infinite', 'Himanika', 'Unity', 
                    'Garuda UNY', 'Unitech'
                ];
                
                foreach ($kegiatan as $nama_kegiatan): 
                ?>
                    <tr>
                        <td><?php echo $nama_kegiatan; ?></td>
                        <td>
                            <a href="form_daftar.php?kegiatan=<?php echo urlencode($nama_kegiatan); ?>" 
                               class="btn btn-primary">Daftar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>