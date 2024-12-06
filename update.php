<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
<script type="text/javascript" src="assets/js/jquery.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

<div class="container">
<?php
    require_once('koneksi.php');
    $koneksiObj = new Koneksi();
    $koneksi = $koneksiObj->getKoneksi();

    if($koneksi->connect_error){
        echo "Gagal Koneksi : ". $koneksi->connect_error;
    } 
    
    $nim           = $_POST['nim'];
    $nama          = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $semester      = $_POST['semester'];    
    $prodi         = $_POST['prodi'];
    $alamat        = $_POST['alamat'];
    $no_hp         = $_POST['no_hp'];

    if($nim=='' || $nama=='' || $jenis_kelamin=='' || $semester=='' || $prodi=='' || $alamat=='' || $no_hp==''){
        echo "Gagal update, pastikan semua kolom di form telah terisi!<br>";
        echo '<a href="dashboard_admin.php">kembali</a>';
        return;
    }

    $query = "update mahasiswa set nama='$nama', jenis_kelamin='$jenis_kelamin', semester='$semester', prodi='$prodi', alamat='$alamat', no_hp='$no_hp' where nim='$nim'";
    
    if($koneksi->query($query)===true){
        echo '<br><div class="alert alert-success alert-dismissable">Data '.$nama.' berhasil diupdate. <a href="dashboard_admin.php">  Lihat Data</a></div>';
    } else{
        echo '<br><div class="alert alert-danger alert-dismissable">Data gagal diupdate! Kembali ke <a href="dashboard_admin.php">  Halaman Awal</a></div>';
    }
    
    $koneksi->close();
?>
</div>