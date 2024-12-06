<?php
session_start();
include 'config.php';

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];
    $kegiatan = $_POST['kegiatan'];

    // Prepare SQL to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO pendaftaran_kegiatan 
        (nama, nim, prodi, kegiatan, status) VALUES (?, ?, ?, ?, 'Menunggu')");
    $stmt->bind_param("ssss", $nama, $nim, $prodi, $kegiatan);

    if ($stmt->execute()) {
        // Redirect with success message
        $_SESSION['message'] = "Pendaftaran berhasil dilakukan!";
        header("Location: pendaftaran_kegiatan.php");
    } else {
        // Redirect with error message
        $_SESSION['error'] = "Gagal mendaftar. Silakan coba lagi.";
        header("Location: pendaftaran_kegiatan.php");
    }
    $stmt->close();
    $conn->close();
    exit();
} else {
    // If accessed directly without POST
    header("Location: pendaftaran_kegiatan.php");
    exit();
}
?>