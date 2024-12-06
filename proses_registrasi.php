<?php
// Sambungkan ke database
include 'koneksi.php';

// Ambil data dari form
$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = $_POST['password'];
$konfirmasi_password = $_POST['konfirmasi_password'];

// Validasi password
if ($password !== $konfirmasi_password) {
    header("Location: registrasi.php?pesan=konfirmasi_gagal");
    exit();
}

// Periksa apakah username sudah ada
$cek_username = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
if (mysqli_num_rows($cek_username) > 0) {
    header("Location: registrasi.php?pesan=username_terpakai");
    exit();
}

// Enkripsi password (gunakan password_hash untuk keamanan)
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Tambahkan user baru dengan level default 'user'
$query = "INSERT INTO users (username, password, level) VALUES ('$username', '$password_hash', 'user')";
$result = mysqli_query($koneksi, $query);

if ($result) {
    header("Location: registrasi.php?pesan=berhasil");
} else {
    header("Location: registrasi.php?pesan=gagal");
}

mysqli_close($koneksi);
?>
