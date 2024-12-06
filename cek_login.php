<?php 
// Mengaktifkan session pada PHP
session_start();

// Menghubungkan PHP dengan koneksi database
require_once('koneksi.php');

// Membuat objek koneksi dan mendapatkan koneksi
$koneksiObj = new Koneksi();
$koneksi = $koneksiObj->getKoneksi();

// Menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// Menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");

// Menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);

// Cek apakah username dan password ditemukan pada database
if ($cek > 0) {
    $data = mysqli_fetch_assoc($login);

    // Simpan data pengguna ke dalam sesi
    $_SESSION['username'] = $data['username'];
    $_SESSION['nim'] = $data['nim']; // Pastikan kolom 'nim' ada di tabel users
    $_SESSION['level'] = $data['level']; // Menyimpan level (admin/user)

    // Cek level pengguna dan arahkan ke dashboard sesuai level
    if ($data['level'] == "admin") {
        header("Location: dashboard_admin.php");
    } else if ($data['level'] == "user") {
        header("Location: dashboard.php");
    } else {
        header("Location: index.php?pesan=gagal");
    }
} else {
    // Jika login gagal, alihkan ke halaman login dengan pesan error
    header("Location: index.php?pesan=gagal");
}
?>
