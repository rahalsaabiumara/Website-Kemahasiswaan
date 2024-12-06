<!DOCTYPE html>
<html>
<head>
    <title>Registrasi - Sistem Multi User</title>
    <link rel="stylesheet" type="text/css" href="style_login.css">
</head>
<body>
<div class="header">
    <img src="logo-uny.png" alt="Logo UNY" style="height: 100px; display: block; margin: 0 auto;">
    <h1>Registrasi Akun Baru</h1>
</div>

<?php
if (isset($_GET['pesan'])) {
    if ($_GET['pesan'] == "gagal") {
        echo "<div class='alert'>Registrasi gagal. Username sudah ada!</div>";
    } elseif ($_GET['pesan'] == "berhasil") {
        echo "<div class='alert' style='background-color: green; color: white;'>Registrasi berhasil. Silakan login.</div>";
    }
}
?>

<div class="kotak_login">
    <p class="tulisan_login">Buat Akun Baru</p>

    <form action="proses_registrasi.php" method="post">
        <label>Username</label>
        <input type="text" name="username" class="form_login" placeholder="Masukkan Username ..." required="required">

        <label>Password</label>
        <input type="password" name="password" class="form_login" placeholder="Masukkan Password ..." required="required">

        <label>Konfirmasi Password</label>
        <input type="password" name="konfirmasi_password" class="form_login" placeholder="Konfirmasi Password ..." required="required">

        <input type="submit" class="tombol_login" value="DAFTAR">

        <br/><br/>
        <center>
            <a class="link" href="index.php">Kembali ke Login</a>
        </center>
    </form>
</div>

</body>
</html>