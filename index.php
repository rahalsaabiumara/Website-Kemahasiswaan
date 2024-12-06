<!DOCTYPE html>
<html>
<head>
    <title>Login - Sistem Multi User</title>
    <link rel="stylesheet" type="text/css" href="style_login.css">
</head>
<body>
<div class="header">
    <img src="logo-uny.png" alt="Logo UNY" style="height: 100px; display: block; margin: 0 auto;">
    <h1>Selamat Datang di Website Data Mahasiswa JPTEI UNY</h1>
</div>

<?php
if (isset($_GET['pesan'])) {
    if ($_GET['pesan'] == "gagal") {
        echo "<div class='alert'>Username dan Password tidak sesuai!</div>";
    }
}
?>

<div class="kotak_login">
    <p class="tulisan_login">Silahkan login</p>

    <form action="cek_login.php" method="post">
        <label>Username</label>
        <input type="text" name="username" class="form_login" placeholder="Username ..." required="required">

        <label>Password</label>
        <input type="password" name="password" class="form_login" placeholder="Password ..." required="required">

        <input type="submit" class="tombol_login" value="LOGIN">

        <br/><br/>
        <center>
            <a class="link" href="dashboard_admin.php">Kembali</a> | 
            <a class="link" href="registrasi.php">Daftar Akun Baru</a>
        </center>
    </form>
</div>

</body>
</html>